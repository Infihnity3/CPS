<?php

session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
}
    
    $json_data = file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum%2Cbitcoin-cash%2Clitecoin%2Cripple%2Cuniswap%2Csolana%2Ccardano%2Cchainlink&vs_currencies=myr&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true");
    $data = json_decode($json_data, true);
    // if (count($data) != 0){
    //     foreach($data as $info){

    //     }
    // }
    


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<body>
    <h1>
        Home
    </h1>
<?php if (isset($user)): ?>
    <p>Welcome, <?= htmlspecialchars($user['username']) ?></p>

    <a href="signout.php"><input type="Submit" value="Sign Out"></input></a>
    <a href="edit.php"><input type="Submit" value="Edit Profile"></input></a>
    <a href="feedback.php"><input type="Submit" value="Feedback Form"></input></a>
    <a href="watchlist.php"><input type="Submit" value="My Watchlist"></input></a>
    <a href="portfolio.php"><input type="Submit" value="Portfolio"></input></a>
    <a href="prediction.php"><input type="Submit" value="Prediction"></input></a>

<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" >
  <div id="tradingview_d72e6"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/BTCUSDT/?exchange=BINANCE" rel="noopener" target="_blank"><span class="blue-text">BTCUSDT chart</span></a> by TradingView</div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  "autosize": true,
  "symbol": "BINANCE:BTCUSDT",
  "interval": "D",
  "timezone": "Asia/Singapore",
  "theme": "dark",
  "style": "1",
  "locale": "en",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": false,
  "hide_side_toolbar": false,
  "allow_symbol_change": true,
  "details": true,
  "calendar": true,
  "container_id": "tradingview_d72e6"
}
  );
  </script>
</div>
<!-- TradingView Widget END -->
<table>
    <tr>
        <th>Cryptocurrency</td>
        <th>Price(MYR)</td>
        <th>Market Cap(MYR)</td>
        <th>24 hr Volume</td>
        <th>24 hr Change</td>
        <th>Actions</td>
    </tr>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
            <td><label>Ripple<input type="hidden" id ="coin" name="coin" value="Ripple"></label></td>
            <td><?php echo $data['ripple']['myr'] ?></td>
            <td><?php echo $data['ripple']['myr_market_cap'] ?></td>
            <td><?php echo $data['ripple']['myr_24h_vol'] ?></td>
            <td><?php echo $data['ripple']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    
    <form action="addWatchlist.php" method="POST">
        <tr> 
        <td><label>Bitcoin Cash<input type="hidden" id ="coin1" name="coin1" value="Bitcoin Cash"></label></td>
            <td><?php echo $data['bitcoin-cash']['myr'] ?></td>
            <td><?php echo $data['bitcoin-cash']['myr_market_cap'] ?></td>
            <td><?php echo $data['bitcoin-cash']['myr_24h_vol'] ?></td>
            <td><?php echo $data['bitcoin-cash']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add1" name="Add1">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
       <tr> 
       <td><label>Bitcoin<input type="hidden" id ="coin2" name="coin2" value="Bitcoin"></label></td>
            <td><?php echo $data['bitcoin']['myr'] ?></td>
            <td><?php echo $data['bitcoin']['myr_market_cap'] ?></td>
            <td><?php echo $data['bitcoin']['myr_24h_vol'] ?></td>
            <td><?php echo $data['bitcoin']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add2" name="Add2">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
        <td><label>Uniswap<input type="hidden" id ="coin3" name="coin3" value="Uniswap"></label></td>
            <td><?php echo $data['uniswap']['myr'] ?></td>
            <td><?php echo $data['uniswap']['myr_market_cap'] ?></td>
            <td><?php echo $data['uniswap']['myr_24h_vol'] ?></td>
            <td><?php echo $data['uniswap']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add3" name="Add3">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    

    <form action="addWatchlist.php" method="POST">
        <tr>
        <td><label>Ethereum<input type="hidden" id ="coin4" name="coin4" value="Ethereum"></label></td>
            <td><?php echo $data['ethereum']['myr'] ?></td>
            <td><?php echo $data['ethereum']['myr_market_cap'] ?></td>
            <td><?php echo $data['ethereum']['myr_24h_vol'] ?></td>
            <td><?php echo $data['ethereum']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add4" name="Add4">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
        <td><label>Litecoin<input type="hidden" id ="coin5" name="coin5" value="Litecoin"></label></td>
            <td><?php echo $data['litecoin']['myr'] ?></td>
            <td><?php echo $data['litecoin']['myr_market_cap'] ?></td>
            <td><?php echo $data['litecoin']['myr_24h_vol'] ?></td>
            <td><?php echo $data['litecoin']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add5" name="Add5">Add to Watchlist</button>
            </td>
        </tr>
    </form>
   
    <form action="addWatchlist.php" method="POST">
        <tr>
        <td><label>Solana<input type="hidden" id ="coin6" name="coin6" value="Solana"></label></td>
            <td><?php echo $data['solana']['myr'] ?></td>
            <td><?php echo $data['solana']['myr_market_cap'] ?></td>
            <td><?php echo $data['solana']['myr_24h_vol'] ?></td>
            <td><?php echo $data['solana']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add6" name="Add6">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
        <td><label>ChainLink<input type="hidden" id ="coin7" name="coin7" value="ChainLink"></label></td>
            <td><?php echo $data['chainlink']['myr'] ?></td>
            <td><?php echo $data['chainlink']['myr_market_cap'] ?></td>
            <td><?php echo $data['chainlink']['myr_24h_vol'] ?></td>
            <td><?php echo $data['chainlink']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add7" name="Add7">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
        <td><label>Cardano<input type="hidden" id ="coin8" name="coin8" value="Cardano"></label></td>
            <td><?php echo $data['cardano']['myr'] ?></td>
            <td><?php echo $data['cardano']['myr_market_cap'] ?></td>
            <td><?php echo $data['cardano']['myr_24h_vol'] ?></td>
            <td><?php echo $data['cardano']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add8" name="Add8">Add to Watchlist</button>
            </td>
        </tr>
    </form>
</table>


<?php else: ?>
    <p>Sign In Failed</p>
    <p><a href="signin.php"><input type="Submit" value="Sign In"></a> or 
    <a href="register.html"><input type="Submit" value="Register"></a></p>
<?php endif; ?>


</body>
</html>