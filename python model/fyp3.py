# pip install streamlit prophet yfinance plotly
import streamlit as st
import datetime
from datetime import date, timedelta

import yfinance as yf
from plotly import graph_objs as g_obj

import math
import numpy as np
import pandas as pd
import altair as alt
from sklearn.preprocessing import MinMaxScaler
from keras.models import Sequential   # deep learning 
from keras.layers import Dense,Dropout,LSTM 
import matplotlib.pyplot as plt
plt.style.use('fivethirtyeight')


st.title('Crypto Prediction System')
# Take stock input from user and store in variable 'stock_name'
default_crypto = 'BTC'
stock_name = st.text_input("Enter Crypto Counter", default_crypto)

default_start_date = date.today()-timedelta(days=365*2)
start_date = st.date_input("Enter Start Date: ", default_start_date)
today = date.today()
today_date = st.date_input("Enter End Date: ", today)


# This slide bar is used to select the prediction periods
no_of_days = st.slider('Select next prediction period:', 1, 30)

if st.button('Start Prediction'):
        with st.spinner("Training ongoing"):
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

        stock_data_ = stock_data.set_index('Date')
        fig = plt.figure(figsize=(16,8))
        plt.title('Close Price History')
        plt.plot(stock_data_['Close'])
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

        model_training = st.text('Please Wait.!!! Model is training...')
        #copile the model
        model.compile(optimizer='adam',loss='mean_squared_error')
        #train the model
        model.fit(X_train,Y_train,batch_size=32,epochs=32)

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

        model_training.text('Model Training... done!')
        #Get the root mean squared error(RMSE)
        rmse=np.sqrt( np.mean((prediction_values - Y_test)**2))
        st.write('Root Mean Square Error: ', rmse)

        train=stock_data[:train_data_len]
        valid=stock_data[train_data_len:]
        valid['Predictions']=prediction_values

        # visualize the data
        train_ = train.set_index('Date')
        valid_ = valid.set_index('Date')
        fig = plt.figure(figsize=(16,8))
        plt.title('Model')
        plt.xlabel('Date',fontsize=18)
        plt.ylabel('Close Price INR',fontsize=18)
        plt.plot(train_['Close'])
        plt.plot(valid_[['Close','Predictions']])
        plt.legend(['Train','Val','Predictions'],loc='lower right')
        st.pyplot(fig)

        #show the valid and predicted prices
        st.write('show the valid and predicted prices')
        st.write(valid)

        # next prediction code
        def next_days_forecasting(next_days):
          data=valid.filter(['Predictions'])
          dataset=data.values

          #scale the data
          scaler=MinMaxScaler(feature_range=(0,1))
          scaled_data=scaler.fit_transform(dataset)
          test_data=scaled_data
          #create the data sets x_test and y_test
          x_test=[]
          for i in range(60,len(test_data)):
            x_test.append(test_data[i-60:i,0])
          #convert the data to a numpy array
          x_test=np.array(x_test)
          #reshape
          x_test=np.reshape(x_test,(x_test.shape[0],x_test.shape[1],1))  
          #get the models predicted price values
          predictions=model.predict(x_test)
          predictions=scaler.inverse_transform(predictions)

          date_list = []
          new_list = []
          for i in range(next_days):
            default_start_date = date.today()+timedelta(days=i)
            date_list.append(default_start_date.strftime('%m/%d/%Y'))
            new_list.append(int(predictions[i]))

          dict_ = {'date':date_list,'prediction':new_list}
          df = pd.DataFrame(dict_)
          return df

        future_pred = next_days_forecasting(no_of_days)
        st.write(future_pred)

        new_df = future_pred 
       
    
        # future_pred['date'] = pd.to_datetime(future_pred['date'])
        # df = future_pred.set_index('date')
      
        # fig = plt.figure(figsize=(20,8))
        # plt.title('Forecasting...')
        # plt.xlabel('Date',fontsize=18)
        # plt.ylabel('Prediction Value',fontsize=18)
        # plt.plot(df['prediction'], color = 'red')
        # st.pyplot(fig)

        new_df.reset_index(inplace=True)
        fig = g_obj.Figure()
        fig.add_trace(g_obj.Scatter(x=new_df['date'], y=new_df['prediction'], name="Prediction",marker_color='red'))
        fig.layout.update(title_text='Forecasting...', xaxis_rangeslider_visible=True)
        st.plotly_chart(fig)