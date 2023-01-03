<?php

session_start();


if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
}
    
    $json_data = file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum%2Cbitcoin-cash%2Clitecoin%2Cripple%2Cuniswap%2Ccardano%2Csolana%2Cchainlink&vs_currencies=myr&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="p-3 mb-2 bg-light text-dark">
,    <?php include 'components/navbar.php' ?>
    <p class="container">Please click the edit button to update your cryptocurrency holdings</p>
    <table class="table container">
        
    <thead class="thead-dark">
        <tr>
            <th scope="col">Cryptocurrency</td>
            <th scope="col">Price(MYR)</td>
            <th scope="col">Amount</td>
            <th scope="col">Actions</td>
        </tr>
    </thead>
    <form action="editHoldings.php" method="POST">
        <tr>
            <td><label>Ripple<input type="hidden" id ="coin" name="coin" value="Ripple"></label></td>
            <td><?php echo $data['ripple']['myr'] ?></td>
            <td></td>
            <td>
                <button class="btn btn-dark" type="submit" value="Add" name="Add">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    
    
    <form action="editHoldings.php" method="POST">
        <tr> 
        <td><label>Bitcoin Cash<input type="hidden" id ="coin1" name="coin1" value="Bitcoin Cash"></label></td>
            <td><?php echo $data['bitcoin-cash']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add1" name="Add1">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    
    <form action="editHoldings.php" method="POST">
       <tr> 
       <td><label>Bitcoin<input type="hidden" id ="coin2" name="coin2" value="Bitcoin"></label></td>
            <td><?php echo $data['bitcoin']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add2" name="Add2">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    
    <form action="editHoldings.php" method="POST">
        <tr>
        <td><label>Uniswap<input type="hidden" id ="coin3" name="coin3" value="Uniswap"></label></td>
            <td><?php echo $data['uniswap']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add3" name="Add3">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    

    <form action="editHoldings.php" method="POST">
        <tr>
        <td><label>Ethereum<input type="hidden" id ="coin4" name="coin4" value="Ethereum"></label></td>
            <td><?php echo $data['ethereum']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add4" name="Add4">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    
    <form action="editHoldings.php" method="POST">
        <tr>
        <td><label>Litecoin<input type="hidden" id ="coin5" name="coin5" value="Litecoin"></label></td>
            <td><?php echo $data['litecoin']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add5" name="Add5">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
   
    <form action="editHoldings.php" method="POST">
        <tr>
        <td><label>Solana<input type="hidden" id ="coin6" name="coin6" value="Solana"></label></td>
            <td><?php echo $data['solana']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add6" name="Add6">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    
    <form action="editHoldings.php" method="POST">
        <tr>
        <td><label>ChainLink<input type="hidden" id ="coin7" name="coin7" value="ChainLink"></label></td>
            <td><?php echo $data['chainlink']['myr'] ?></td>
            <td></td>

            <td>
                <button class="btn btn-dark" type="submit" value="Add7" name="Add7">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
    
    <form action="editHoldings.php" method="POST">
        <tr>
        <td><label>Cardano<input type="hidden" id ="coin8" name="coin8" value="Cardano"></label></td>
            <td><?php echo $data['cardano']['myr'] ?></td>
            <td></td>
            <td>
                <button class="btn btn-dark" type="submit" value="Add8" name="Add8">Add/Edit Holdings</button>
            </td>
        </tr>
    </form>
</table>
</body>
</html>