import pandas as pd
import numpy as np
import math
import datetime as dt
import matplotlib.pyplot as plt
from sklearn.metrics import mean_squared_error, mean_absolute_error, explained_variance_score, r2_score 
from sklearn.metrics import mean_poisson_deviance, mean_gamma_deviance, accuracy_score
from sklearn.preprocessing import MinMaxScaler
import tensorflow as tf
from keras.models import Sequential
from keras.layers import Dense, Dropout
from keras.layers import LSTM
from itertools import cycle
import plotly.graph_objects as go
import plotly.express as px
from plotly.subplots import make_subplots
# print('All good!')

import yfinance as yf
BTC_Ticker = yf.Ticker("BTC-USD")
df = BTC_Ticker.history(period="max")
for col in df.columns:
    print(col)
print(df.info())
# print(type(df))
# print(df.head())
# print(df.tail())
df.isna().sum()
print(df.loc['2016-01-01':'2021-01-01'])
# print(df.DatetimeIndex())

# df['Date'] = pd.to_datetime(df['Date'], format='%Y-%m-%d %H:%M:%S+00:00')
# year_2020 = df.loc[(df['Date'] >= '2020-01-01')
#                      & (df['Date'] < '2021-01-01')]
# year_2020.drop(year_2020[['High','Low','Volume','Market Cap']],axis=1)
# months_2020 = year_2020.groupby(year_2020['Date'].dt.strftime('%B'))[['Open','Close']].mean()
# month_order = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
#              'September', 'October', 'November', 'December']
# months_2020 = round(months_2020.reindex(month_order, axis=0),2)
# months_2020 = months_2020.reset_index()

# fig = px.bar(months_2020, x='Date', y=['Open','Close'], barmode='group', title = 'Monthly Average Open & Close Price - Year 2020')
# fig.show()

# fig = px.line(df, x="Date", y="Close", title='Bitcoin Close price over time')
# fig.show()

# model_data =df[['Date','Close']]

# del model_data['Date']
# scaler = MinMaxScaler(feature_range=(0,1))
# close_df = scaler.fit_transform(np.array(closedf).reshape(-1,1))
# close_df.info()

# training_size = int(len(close_df)*0.9)
# test_size = len(close_df)-training_size
# train_data,test_data = close_df[0:training_size,:],close_df[training_size:len(close_df),:1]
# print('train_data: ', train_data.shape)
# print('test_data: ', test_data.shape)

# # convert an array of values into a dataset matrix
# def create_dataset(dataset, time_step=1):
#     dataX, dataY = [], []
#     for i in range(len(dataset)-time_step-1):
#         a = dataset[i:(i+time_step), 0]  
#         dataX.append(a)
#         dataY.append(dataset[i + time_step, 0])
#     return np.array(dataX), np.array(dataY)

# time_step = 10 
# X_train, y_train = create_dataset(train_data, time_step)
# X_test, y_test = create_dataset(test_data, time_step)
# # reshape input to be [samples, time steps, features] which is required for LSTM
# X_train = X_train.reshape(X_train.shape[0],X_train.shape[1] , 1)
# X_test = X_test.reshape(X_test.shape[0],X_test.shape[1] , 1)
# print("X_train: ", X_train.shape)
# print("X_test: ", X_test.shape)

# model = Sequential() 
# # Adding a LSTM layer with 10 internal units
# model.add(LSTM(10,input_shape=(None,1),activation='relu'))
# # Adding a Dense layer with 1 units.
# model.add(Dense(1))
# # Loss function + optimizer
# model.compile(loss='mean_squared_error',optimizer='adam')

# history = model.fit(X_train,y_train,validation_data=(X_test,y_test),epochs=100,batch_size=10,verbose=1)

# loss = history.history['loss']
# val_loss = history.history['val_loss']
# epochs = range(len(loss))
# plt.plot(epochs, loss, 'r', label='Training loss')
# plt.plot(epochs, val_loss, 'b', label='Validation loss')
# plt.title('Training and validation loss')
# plt.legend(loc=0)
# plt.figure()
# plt.show()

# train_predict=model.predict(X_train)
# test_predict=model.predict(X_test)
# look_back=time_step
# trainPredictPlot = np.empty_like(close_df)
# trainPredictPlot[:, :] = np.nan
# trainPredictPlot[look_back:len(train_predict)+look_back, :] = train_predict
# # shift test predictions for plotting
# testPredictPlot = np.empty_like(close_df)
# testPredictPlot[:, :] = np.nan
# testPredictPlot[len(train_predict)+(look_back*2)+1:len(close_df)-1, :] = test_predict
# names = cycle(['Original close price','Train predicted close price','Test predicted close price'])
# plotdf = pd.DataFrame({'date': df['Date'],
#                        'original_close': df['Close'],
#                       'train_predicted_close': trainPredictPlot.reshape(1,-1)[0].tolist(),
#                       'test_predicted_close': testPredictPlot.reshape(1,-1)[0].tolist()})
# fig = px.line(plotdf,x=plotdf['date'], y=[plotdf['original_close'],plotdf['train_predicted_close'],
#                                           plotdf['test_predicted_close']],
#               labels={'value':'Stock price','date': 'Date'})
# fig.update_layout(title_text='Comparision between original vs predicted close price',
#                   plot_bgcolor='white',legend_title_text='Close Price')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))
# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)
# fig.show()

# x_input=test_data[len(test_data)-time_step:].reshape(1,-1)
# temp_input=list(x_input)
# temp_input=temp_input[0].tolist()
# from numpy import array
# lst_output=[]
# n_steps=time_step
# i=0
# pred_days = 60
# while(i<pred_days):
    
#     if(len(temp_input)>time_step):
        
#         x_input=np.array(temp_input[1:])
#         #print("{} day input {}".format(i,x_input))
#         x_input = x_input.reshape(1,-1)
#         x_input = x_input.reshape((1, n_steps, 1))
        
#         yhat = model.predict(x_input, verbose=0)
#         #print("{} day output {}".format(i,yhat))
#         temp_input.extend(yhat[0].tolist())
#         temp_input=temp_input[1:]
#         #print(temp_input)
       
#         lst_output.extend(yhat.tolist())
#         i=i+1
        
#     else:
        
#         x_input = x_input.reshape((1, n_steps,1))
#         yhat = model.predict(x_input, verbose=0)
#         temp_input.extend(yhat[0].tolist())
        
#         lst_output.extend(yhat.tolist())
#         i=i+1
# temp_mat = np.empty(pred_days+1)
# temp_mat[:] = np.nan
# temp_mat = temp_mat.reshape(1,-1).tolist()[0]
# next_predicted_days_value = temp_mat
# next_predicted_days_value = scaler.inverse_transform(np.array(lst_output).reshape(-1,1)).reshape(1,-1).tolist()[0]
# new_pred_plot = pd.DataFrame({
#     'Predicted Close':next_predicted_days_value
# })
# names = cycle(['Predicted next 60 days close price'])
# fig = px.line(new_pred_plot,x=new_pred_plot.index, y= new_pred_plot['Predicted Close'],
#               labels={'value': 'Stock price','index': 'Timestamp'})
# fig.update_layout(title_text='Next 60 days Closing price prediction',
#                   plot_bgcolor='white',legend_title_text='Close Price')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))
# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)
# fig.show()

# train_predict = scaler.inverse_transform(train_predict)
# test_predict = scaler.inverse_transform(test_predict)
# original_ytrain = scaler.inverse_transform(y_train.reshape(-1,1)) 
# original_ytest = scaler.inverse_transform(y_test.reshape(-1,1))

# # Evaluation metrices RMSE and MAE
# print("Train data RMSE: ", math.sqrt(mean_squared_error(original_ytrain,train_predict)))
# print("Train data MSE: ", mean_squared_error(original_ytrain,train_predict))
# print("Train data MAE: ", mean_absolute_error(original_ytrain,train_predict))
# print("-------------------------------------------------------------------------------------")
# print("Test data RMSE: ", math.sqrt(mean_squared_error(original_ytest,test_predict)))
# print("Test data MSE: ", mean_squared_error(original_ytest,test_predict))
# print("Test data MAE: ", mean_absolute_error(original_ytest,test_predict))
# print("-------------------------------------------------------------------------------------")
# print("Train data R2 score:", r2_score(original_ytrain, train_predict))
# print("Test data R2 score:", r2_score(original_ytest, test_predict))