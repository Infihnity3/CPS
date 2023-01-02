<?php

session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc(); 
    
    $email = $user['email'];

    $sql = "SELECT * FROM watchlist WHERE emailw = '$email'";
    $result = $mysqli->query($sql);
    $watchlist = $result->fetch_assoc();

}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Watchlist</title>
</head>
<body>
    <table>
        <tr>
            <th>Cryptocurrency</td>
            <!-- <th>Price(MYR)</td>
            <th>Market Cap(MYR)</td>
            <th>24 hr Volume</td> -->
        </tr>
        <tr>
            <?php
            foreach($watchlist as $info){
                echo "<td>" . $info['crypto'] . "</td>";
            }
            ?>
            <!-- <td></td>
            <td></td>
            <td></td> -->
        </tr>
    </table>
</body>
</html>