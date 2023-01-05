<?php

session_start();


if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
    $email = $user['email'];


    $sql2 = "SELECT * FROM portfolio WHERE email_p = '$email'";
    $result2 = $mysqli->query($sql2);
    
}
    
    $json_data = file_get_contents("https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Cethereum%2Cbitcoin-cash%2Clitecoin%2Cripple%2Cuniswap%2Ccardano%2Csolana%2Cchainlink&vs_currencies=myr&include_market_cap=true&include_24hr_vol=true&include_24hr_change=true");
    $data = json_decode($json_data, true);

    


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="p-3 mb-2 bg-light text-dark">
   <?php include 'components/navbar.php' ?>
  <div class="container">  
  <h1>My Portfolio</h1>  
  <p class="container">Please click the Edit Holdgins button to update your cryptocurrency holdings or Add Holdings button to add crypto into your portfolio</p>
    
    <a><button class="btn btn-dark" onclick="window.location.href='addHoldings.php'">Add Holdings</button></a>
    <br/>
    <br/>
    <table class="table container">
        
    <thead class="thead-dark">
        <tr>
            <th scope="col">Cryptocurrency</td>
            <!-- <th scope="col">Price(MYR)</td> -->
            <th scope="col">Amount</td>
            <th scope="col">Actions</td>
        </tr>
    </thead>
    <?php 
                    while($row = mysqli_fetch_array($result2)){
                        ?>
                        <tr>
                        <td> <input type="hidden" name="crypto" value="<?php echo $row['crypto']; ?>" /><?php echo $row['crypto'] ?> </td>
                        
                        <td><input type="hidden" name="amount" value="<?php echo $row['amount']; ?>" /> <?php echo $row['amount'] ?> </td>
                        <!-- // echo "<td>" . $data['$cryp']['myr'] . "</td>"; -->
                        
                        <td ><a href="editHoldings.php?a=<?php echo $row['crypto']?>&b=<?php echo $row['amount']?>"class='btn btn-dark'>Edit Holdings</button></td>

                        </tr>
                        <?php } ?>
                    </table>

        </tr>
    </div>
</table>
</body>
</html>