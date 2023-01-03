import pandas as pd
import numpy as np
import math
import datetime as dt

import matplotlib.pyplot as plt
from itertools import cycle
# import plotly.graph_objects as go
# import plotly.express as px
# from plotly.subplots import make_subplots
# import seaborn as sns
from xgboost import XGBRegressor
from sklearn.metrics import mean_squared_error, mean_absolute_error, explained_variance_score, r2_score 
from sklearn.metrics import mean_poisson_deviance, mean_gamma_deviance, accuracy_score
from sklearn.preprocessing import MinMaxScaler

# from plotly.offline import plot, iplot, init_notebook_mode
# init_notebook_mode(connected=True)

# Loading Dataset and remainig its columns

data=pd.read_csv('../CPS/historical-price/BTC-USD.csv')
data = data.rename(columns={'Date': 'date','Open':'open','High':'high','Low':'low','Close':'close',
                                'Adj Close':'adj_close','Volume':'volume'})

# print(data.head())

# print(data.tail())

# print(data.shape)

# # describe() is used to view some basic statistical details like percentile, mean, std etc. of a data frame or a series of numeric values
# print(data.describe())

# # Check for null values
# print(data.isnull().sum())

data['date'] = pd.to_datetime(data.date)
# print(data.head())

# print("Starting date: ",data.iloc[0][0])
# print("Ending date: ", data.iloc[-1][0])
# print("Duration: ", data.iloc[-1][0]-data.iloc[0][0])

y_2022 = data.loc[(data['date'] >= '2022-01-01')
                     & (data['date'] < '2023-01-01')]

y_2022.drop(y_2022[['adj_close','volume']],axis=1)

monthvise= y_2022.groupby(y_2022['date'].dt.strftime('%B'))[['open','close']].mean()
new_order = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
             'September', 'October', 'November', 'December']
monthvise = monthvise.reindex(new_order, axis=0)
# print(monthvise)

# # Show Crypto Open and Close Price
# fig = go.Figure()

# fig.add_trace(go.Bar(
#     x=monthvise.index,
#     y=monthvise['open'],
#     name='Crypto Open Price',
#     marker_color='red'
# ))
# fig.add_trace(go.Bar(
#     x=monthvise.index,
#     y=monthvise['close'],
#     name='Crypto Close Price',
#     marker_color='green'
# ))

# fig.update_layout(barmode='group', xaxis_tickangle=-45, 
#                   title='Monthwise comparision between Stock open and close price')
# fig.show()

# #Show Crypto High and Low Price

# y_2022.groupby(y_2022['date'].dt.strftime('%B'))['low'].min()
# monthvise_high = y_2022.groupby(data['date'].dt.strftime('%B'))['high'].max()
# monthvise_high = monthvise_high.reindex(new_order, axis=0)

# monthvise_low = y_2022.groupby(y_2022['date'].dt.strftime('%B'))['low'].min()
# monthvise_low = monthvise_low.reindex(new_order, axis=0)

# fig = go.Figure()
# fig.add_trace(go.Bar(
#     x=monthvise_high.index,
#     y=monthvise_high,
#     name='Crypto high Price',
#     marker_color='rgb(0, 153, 204)'
# ))
# fig.add_trace(go.Bar(
#     x=monthvise_low.index,
#     y=monthvise_low,
#     name='Crypto low Price',
#     marker_color='rgb(255, 128, 0)'
# ))

# fig.update_layout(barmode='group', 
#                   title=' Monthwise High and Low stock price')
# fig.show()

# # Crypto Analysis Chart
# names = cycle(['Crypto Open Price','Crypto Close Price','Crypto High Price','Crypto Low Price'])

# fig = px.line(y_2022, x=y_2022.date, y=[y_2022['open'], y_2022['close'], 
#                                           y_2022['high'], y_2022['low']],
#              labels={'Date': 'Date','value':'Crypto value'})
# fig.update_layout(title_text='Crypto analysis chart', font_size=15, font_color='black',legend_title_text='Crypto Parameters')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))
# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)

# fig.show()

# # Overall Data
# y_overall=data
# y_overall.drop(y_overall[['adj_close','volume']],axis=1)

# monthvise= y_overall.groupby(y_overall['date'].dt.strftime('%B'))[['open','close']].mean()
# new_order = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 
#              'September', 'October', 'November', 'December']
# monthvise = monthvise.reindex(new_order, axis=0)

# names = cycle(['Stock Open Price','Stock Close Price','Stock High Price','Stock Low Price'])

# fig = px.line(y_overall, x=y_overall.date, y=[y_overall['open'], y_overall['close'], 
#                                           y_overall['high'], y_overall['low']],
#              labels={'Date': 'Date','value':'Stock value'})
# fig.update_layout(title_text='Stock analysis chart', font_size=15, font_color='black',legend_title_text='Stock Parameters')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))
# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)

# fig.show()

# New DF with only date and close
closedf = data[['date','close']]
# print("Shape of close dataframe:", closedf.shape)

closedf = closedf[closedf['date'] > '2022-01-02']
close_stock = closedf.copy()
# print("Total data for prediction: ",closedf.shape[0])

# Normalising Close Price Value
del closedf['date']
scaler=MinMaxScaler(feature_range=(0,1))
closedf=scaler.fit_transform(np.array(closedf).reshape(-1,1))
# print(closedf.shape)

# Separate Test and Train Data
training_size=int(len(closedf)*0.70)
test_size=len(closedf)-training_size
train_data,test_data=closedf[0:training_size,:],closedf[training_size:len(closedf),:1]
# print("train_data: ", train_data.shape)
# print("test_data: ", test_data.shape)

# # Visaulise Test and Train Data in a graph
# fig, ax = plt.subplots(figsize=(15, 6))
# sns.lineplot(x = close_stock['date'][:241], y = close_stock['close'][:241], color = 'black')
# sns.lineplot(x = close_stock['date'][241:], y = close_stock['close'][241:], color = 'red')

# # Formatting
# ax.set_title('Train & Test data', fontsize = 20, loc='center', fontdict=dict(weight='bold'))
# ax.set_xlabel('Date', fontsize = 16, fontdict=dict(weight='bold'))
# ax.set_ylabel('Weekly Price', fontsize = 16, fontdict=dict(weight='bold'))
# plt.tick_params(axis='y', which='major', labelsize=16)
# plt.tick_params(axis='x', which='major', labelsize=16)
# plt.legend(loc='upper right' ,labels = ('train', 'test'))
# plt.show()

# convert an array of values into a dataset matrix
def create_dataset(dataset, time_step=1):
    dataX, dataY = [], []
    for i in range(len(dataset)-time_step-1):
        a = dataset[i:(i+time_step), 0]   
        dataX.append(a)
        dataY.append(dataset[i + time_step, 0])
    return np.array(dataX), np.array(dataY)

time_step = 21
X_train, y_train = create_dataset(train_data, time_step)
X_test, y_test = create_dataset(test_data, time_step)

# print("X_train: ", X_train.shape)
# print("y_train: ", y_train.shape)
# print("X_test: ", X_test.shape)
# print("y_test", y_test.shape)

# Biulding Model

my_model = XGBRegressor(n_estimators=1000)
my_model.fit(X_train, y_train, verbose=False)

predictions = my_model.predict(X_test)
# print("Mean Absolute Error - MAE : " + str(mean_absolute_error(y_test, predictions)))
# print("Root Mean squared Error - RMSE : " + str(math.sqrt(mean_squared_error(y_test, predictions))))

train_predict=my_model.predict(X_train)
test_predict=my_model.predict(X_test)

train_predict = train_predict.reshape(-1,1)
test_predict = test_predict.reshape(-1,1)

# print("Train data prediction:", train_predict.shape)
# print("Test data prediction:", test_predict.shape)

# Transform back to original form

train_predict = scaler.inverse_transform(train_predict)
test_predict = scaler.inverse_transform(test_predict)
original_ytrain = scaler.inverse_transform(y_train.reshape(-1,1)) 
original_ytest = scaler.inverse_transform(y_test.reshape(-1,1)) 

# shift train predictions for plotting

look_back=time_step
trainPredictPlot = np.empty_like(closedf)
trainPredictPlot[:, :] = np.nan
trainPredictPlot[look_back:len(train_predict)+look_back, :] = train_predict
# print("Train predicted data: ", trainPredictPlot.shape)

# shift test predictions for plotting
testPredictPlot = np.empty_like(closedf)
testPredictPlot[:, :] = np.nan
testPredictPlot[len(train_predict)+(look_back*2)+1:len(closedf)-1, :] = test_predict
# print("Test predicted data: ", testPredictPlot.shape)

names = cycle(['Original close price','Train predicted close price','Test predicted close price'])

plotdf = pd.DataFrame({'date': close_stock['date'],
                       'original_close': close_stock['close'],
                      'train_predicted_close': trainPredictPlot.reshape(1,-1)[0].tolist(),
                      'test_predicted_close': testPredictPlot.reshape(1,-1)[0].tolist()})

# fig = px.line(plotdf,x=plotdf['date'], y=[plotdf['original_close'],plotdf['train_predicted_close'],
#                                           plotdf['test_predicted_close']],
#               labels={'value':'Close price','date': 'Date'})
# fig.update_layout(title_text='Comparision between original close price vs predicted close price',
#                   plot_bgcolor='white', font_size=15, font_color='black',legend_title_text='Close Price')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))

# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)
# fig.show()

# Next 10 days prediction

x_input=test_data[len(test_data)-time_step:].reshape(1,-1)
temp_input=list(x_input)
temp_input=temp_input[0].tolist()

from numpy import array

lst_output=[]
n_steps=time_step
i=0
pred_days = 11
while(i<=pred_days):
    
    if(len(temp_input)>time_step):
        
        x_input=np.array(temp_input[1:])
        #print("{} day input {}".format(i,x_input))
        x_input=x_input.reshape(1,-1)
        
        yhat = my_model.predict(x_input)
        #print("{} day output {}".format(i,yhat))
        temp_input.extend(yhat.tolist())
        temp_input=temp_input[1:]
       
        lst_output.extend(yhat.tolist())
        i=i+1
        
    else:
        yhat = my_model.predict(x_input)
        
        temp_input.extend(yhat.tolist())
        lst_output.extend(yhat.tolist())
        
        i=i+1
        
# print("Output of predicted next days: ", len(lst_output))

last_days=np.arange(1,time_step+1)
day_pred=np.arange(time_step+1,time_step+pred_days+1)
# print(last_days)
# print(day_pred)

# Compare last 15 days with predicted 10 days in a plot
temp_mat = np.empty((len(last_days)+pred_days+1,1))
temp_mat[:] = np.nan
temp_mat = temp_mat.reshape(1,-1).tolist()[0]

last_original_days_value = temp_mat
next_predicted_days_value = temp_mat

last_original_days_value[0:time_step+1] = scaler.inverse_transform(closedf[len(closedf)-time_step:]).reshape(1,-1).tolist()[0]
next_predicted_days_value[time_step+1:] = scaler.inverse_transform(np.array(lst_output).reshape(-1,1)).reshape(1,-1).tolist()[0]

new_pred_plot = pd.DataFrame({
    'last_original_days_value':last_original_days_value,
    'next_predicted_days_value':next_predicted_days_value
})

names = cycle(['Last 15 days close price','Predicted next 10 days close price'])

# fig = px.line(new_pred_plot,x=new_pred_plot.index, y=[new_pred_plot['last_original_days_value'],
#                                                       new_pred_plot['next_predicted_days_value']],
#               labels={'value': 'Close price','index': 'Timestamp'})
# fig.update_layout(title_text='Compare last 15 days vs next 10 days',
#                   plot_bgcolor='white', font_size=15, font_color='black',legend_title_text='Close Price')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))
# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)
# fig.show()


my_model=closedf.tolist()
my_model.extend((np.array(lst_output).reshape(-1,1)).tolist())
my_model=scaler.inverse_transform(my_model).reshape(1,-1).tolist()[0]

names = cycle(['Close Price'])

plt.plot(my_model,ls='solid')

plt.legend(['Closing Price'])
plt.title('Plotting whole closing price with prediction')
plt.xlabel('Days')
plt.ylabel('Price')
plt.show()
# fig = px.line(my_model,labels={'value': 'Close price','index': 'Timestamp'})
# fig.update_layout(title_text='Plotting whole closing price with prediction',
#                   plot_bgcolor='white', font_size=15, font_color='black',legend_title_text='Stock')
# fig.for_each_trace(lambda t:  t.update(name = next(names)))
# fig.update_xaxes(showgrid=False)
# fig.update_yaxes(showgrid=False)
# fig.show()