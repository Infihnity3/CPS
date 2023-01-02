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
    <a href="portfolio.php"><input type="Submit" value="My Watchlist"></input></a>

<?php else: ?>
    <p>Sign In Failed</p>
    <p><a href="signin.php"><input type="Submit" value="Sign In"></a> or 
    <a href="register.html"><input type="Submit" value="Register"></a></p>
<?php endif; ?>

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
            <td id="coin" name="coin">Ripple</td>
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
            <td id="coin" name="coin">Bitcoin Cash</td>
            <td><?php echo $data['bitcoin-cash']['myr'] ?></td>
            <td><?php echo $data['bitcoin-cash']['myr_market_cap'] ?></td>
            <td><?php echo $data['bitcoin-cash']['myr_24h_vol'] ?></td>
            <td><?php echo $data['bitcoin-cash']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
       <tr> 
            <td id="coin" name="coin">Bitcoin</td>
            <td><?php echo $data['bitcoin']['myr'] ?></td>
            <td><?php echo $data['bitcoin']['myr_market_cap'] ?></td>
            <td><?php echo $data['bitcoin']['myr_24h_vol'] ?></td>
            <td><?php echo $data['bitcoin']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
            <td id="coin" name="coin">Uniswap</td>
            <td><?php echo $data['uniswap']['myr'] ?></td>
            <td><?php echo $data['uniswap']['myr_market_cap'] ?></td>
            <td><?php echo $data['uniswap']['myr_24h_vol'] ?></td>
            <td><?php echo $data['uniswap']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    

    <form action="addWatchlist.php" method="POST">
        <tr>
            <td id="coin" name="coin">Ethereum</td>
            <td><?php echo $data['ethereum']['myr'] ?></td>
            <td><?php echo $data['ethereum']['myr_market_cap'] ?></td>
            <td><?php echo $data['ethereum']['myr_24h_vol'] ?></td>
            <td><?php echo $data['ethereum']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
            <td id="coin" name="coin">Litecoin</td>
            <td><?php echo $data['litecoin']['myr'] ?></td>
            <td><?php echo $data['litecoin']['myr_market_cap'] ?></td>
            <td><?php echo $data['litecoin']['myr_24h_vol'] ?></td>
            <td><?php echo $data['litecoin']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
   
    <form action="addWatchlist.php" method="POST">
        <tr>
            <td id="coin" name="coin">Solana</td>
            <td><?php echo $data['solana']['myr'] ?></td>
            <td><?php echo $data['solana']['myr_market_cap'] ?></td>
            <td><?php echo $data['solana']['myr_24h_vol'] ?></td>
            <td><?php echo $data['solana']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
            <td id="coin" name="coin">ChainLink</td>
            <td><?php echo $data['chainlink']['myr'] ?></td>
            <td><?php echo $data['chainlink']['myr_market_cap'] ?></td>
            <td><?php echo $data['chainlink']['myr_24h_vol'] ?></td>
            <td><?php echo $data['chainlink']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
    
    <form action="addWatchlist.php" method="POST">
        <tr>
            <td id="coin" name="coin">Cardano</td>
            <td><?php echo $data['cardano']['myr'] ?></td>
            <td><?php echo $data['cardano']['myr_market_cap'] ?></td>
            <td><?php echo $data['cardano']['myr_24h_vol'] ?></td>
            <td><?php echo $data['cardano']['myr_24h_change'] ?></td>
            <td>
                <button type="submit" value="Add" name="Add">Add to Watchlist</button>
            </td>
        </tr>
    </form>
</table>
</body>
</html>