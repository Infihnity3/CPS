# pip install streamlit prophet yfinance plotly
import streamlit as st
from datetime import date

import yfinance as yf
from prophet import Prophet
from prophet.plot import plot_plotly
from plotly import graph_objs as g_obj

import math
import numpy as np
import pandas as pd
from sklearn.preprocessing import MinMaxScaler
from keras.models import Sequential
from keras.layers import Dense,LSTM
import matplotlib.pyplot as plt
plt.style.use('fivethirtyeight')


# default start date set '2010-01-01' (Note: Its mean data load from start date to today date)
start_date = "2010-01-01"
today_date = date.today().strftime("%Y-%m-%d")

st.title('Crypto Prediction App')
# Take stock input from user and store in variable 'stock_name'
default_crypto = 'BTC'
stock_name = st.text_input("Enter Stock Name", default_crypto)

# This slide bar is used to select year of prediction  
no_of_years = st.slider('Years of prediction:', 1, 4)
days = no_of_years * 365


@st.cache
def load_stock_data(ticker_name):
    stock_data = yf.download(ticker_name, start_date, today_date)
    stock_data.reset_index(inplace=True)
    return stock_data

	
loading_data = st.text('Please Wait.!!! data is loading...')
stock_data = load_stock_data(stock_name)
loading_data.text('Loading data... done!')

st.subheader('Stock data last 5  records..')
st.write(stock_data.tail())

# ploting data information
def plot_raw_data_info():
	fig = g_obj.Figure()
	fig.add_trace(g_obj.Scatter(x=stock_data['Date'], y=stock_data['Open'], name="stock_open"))
	fig.add_trace(g_obj.Scatter(x=stock_data['Date'], y=stock_data['Close'], name="stock_close"))
	fig.layout.update(title_text='Time Series data with Rangeslider', xaxis_rangeslider_visible=True)
	st.plotly_chart(fig)
	
plot_raw_data_info()

fig = plt.figure(figsize=(16,8))
plt.title('Close Price History')
plt.plot(stock_data['Close'])
plt.xlabel('Date',fontsize=18)
plt.ylabel('Close Price INR',fontsize=18)
st.pyplot(fig)

st_data=stock_data.filter(['Close'])
stock_dataset=st_data.values
train_data_len= math.ceil(len(stock_dataset) * .8)

#scale the data
scaler=MinMaxScaler(feature_range=(0,1))
stock_scaled_data=scaler.fit_transform(stock_dataset)


#Create training data set

train_data=stock_scaled_data[0:train_data_len,:]

#split the data into x_train and y_train data sets

X_train =[]
Y_train=[]


for i in range(60,len(train_data)):
  X_train.append(train_data[i-60:i,0])
  Y_train.append(train_data[i,0])

  #convert train data to numpy arrays
X_train,Y_train=np.array(X_train),np.array(Y_train)

# build LSTM model(Sequential Model)
model=Sequential()
model.add(LSTM(50,return_sequences=True,input_shape=(X_train.shape[1],1)))
model.add(LSTM(50,return_sequences=False))
model.add(Dense(25))
model.add(Dense(1))

#copile the model
model.compile(optimizer='adam',loss='mean_squared_error')
#train the model
model.fit(X_train,Y_train,batch_size=1,epochs=1)

model.save('keras_model.h5')

#create the testing data set
#create a new array containing scaled values from index 1543 to 2003
test_data=stock_scaled_data[train_data_len - 60:,:]
#create the data sets x_test and y_test
X_test=[]
Y_test=stock_dataset[train_data_len:,:]
for i in range(60,len(test_data)):
  X_test.append(test_data[i-60:i,0])


#convert the data to a numpy array
X_test=np.array(X_test)
#reshape
X_test=np.reshape(X_test,(X_test.shape[0],X_test.shape[1],1))

#get the models predicted price values
prediction_values=model.predict(X_test)
prediction_values=scaler.inverse_transform(prediction_values)

#Get the root mean squared error(RMSE)
rmse=np.sqrt( np.mean((prediction_values - Y_test)**2))
st.write('Root Mean Square Error {rmse}')

train=stock_data[:train_data_len]
valid=stock_data[train_data_len:]
valid['Predictions']=prediction_values

#visualize the data
fig = plt.figure(figsize=(16,8))
plt.title('Model')
plt.xlabel('Date',fontsize=18)
plt.ylabel('Close Price INR',fontsize=18)
plt.plot(train['Close'])
plt.plot(valid[['Close','Predictions']])
plt.legend(['Train','Val','Predictions'],loc='lower right')
st.pyplot(fig)

#show the valid and predicted prices
st.write('show the valid and predicted prices')
st.write(valid)

	

    
