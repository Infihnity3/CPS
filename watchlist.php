<?php

session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc(); 
    
    $email = $user['email'];

    $sql = "SELECT * FROM watchlist WHERE email = '$email'";
    $result = $mysqli->query($sql);
    $watchlist = $result->fetch_assoc();

    // var_dump($watchlist);    
    // foreach($watchlist as $crypto_w){
    //     $crypto = $crypto_w['crypto_w'];
    // }

    // if($result->num_rows > 0){
    //     while($row = $result->fetch_assoc()){
    //         $crypto = $row['crypto_w'];
    //     }
    // }
    // else{
    //     $crypto = "No Cryptocurrency";
    // }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<body>
    <a href="home.php"><input type="Submit" value="Home"></input></a>
    <table>
        <tr>
            <th>Cryptocurrency</td>
            <!-- <th>Price(MYR)</td>
            <th>Market Cap(MYR)</td>
            <th>24 hr Volume</td> -->
        </tr>
        <!-- <tr> -->
            <?php 
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "<tr><td>".$row['crypto_w']."</td></tr>"; 
                    }
                    echo "</table>";
                }
                else{
                    $crypto = "No Cryptocurrency";
                }
            
            ?>
            <!-- <td></td>
            <td></td>
            <td></td> --> 
        <!-- </tr> -->
    </table>
    

</body>
</html>