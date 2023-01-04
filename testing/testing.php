<?php

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pyscript.net/latest/pyscript.css" />
    <script defer src="https://pyscript.net/latest/pyscript.js"></script>
    <py-config>
    packages = ['pandas','numpy','matplotlib','plotly','seaborn','xgboost','scikit-learn']
    </py-config>

   <!-- <py-env>
    - pandas
    - numpy
    - matplotlib
    - xgboost
    - scikit-learn
    - seaborn
    - plotly

    </py-env>-->
</head>
  
<body class="p-3 mb-2 bg-light text-dark">
<py-script>
import pandas as pd
import numpy as np
import math
import datetime as dt

import matplotlib.pyplot as plt
from itertools import cycle
from xgboost import XGBRegressor
from sklearn.metrics import mean_squared_error, mean_absolute_error, explained_variance_score, r2_score 
from sklearn.metrics import mean_poisson_deviance, mean_gamma_deviance, accuracy_score
from sklearn.preprocessing import MinMaxScaler

from pyodide.http import open_url


crypto_input = Element('crypto').element.value
crypto_day = Element('days').element.value   


def my_function():
  if crypto_input == "1":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/BTC-USD.csv")
  elif crypto_input == "2":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/ETH-USD.csv")
  elif crypto_input == "3":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/LTC-USD.csv")
  elif crypto_input == "4":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/BCH-USD.csv")
  elif crypto_input == "5":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/ADA-USD.csv")
  elif crypto_input == "6":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/UNI-USD.csv")
  elif crypto_input == "7":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/XRP-USD.csv")
  elif crypto_input == "8":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/LINK-USD.csv")
  elif crypto_input == "9":
    loadData = open_url("https://raw.githubusercontent.com/Infihnity3/CPS/main/historical-price/SOL-USD.csv")    
  

  data=pd.read_csv(loadData)
  dh = data.head()
  pyscript.write("plot",dh)
  pyscript.write("no",crypto_day)

</py-script>
    <!-- <p class="container">Prediction Results of Bitcoin-USD</p> -->
    <div class="container">
    <div id="plot" class="container"></div>
    <div id="no">
    <!-- <form > -->
        <div class="form-group">
        <select name="crypto" id="crypto" class="form-select" aria-label="Default select example">
            <option value="1">Bitcoin-USD</option>
            <option value="2">Ethereum-USD</option>
            <option selected value="3">Litecoin-USD</option>
            <option value="4">Bitcoin Cash-USD</option>
            <option value="5">Cardano-USD</option>
            <option value="6">Uniswap-USD</option>
            <option value="7">Ripple Coin-USD</option>
            <option value="8">ChainLink-USD</option>
            <option value="9">Solana-USD</option>
        </select>
        </div>
        <div class="form-group">
            <label for="days">Please enter the number of days you like to predict</label>
            <input class="form-control" name="days" id="days" value="50"></div>
        </div>
        <button py-click="my_function()" id="submit" class="btn btn-dark" type="submit">Predict</button>
    <!-- </form> -->
    </div>

</body>
</html>

