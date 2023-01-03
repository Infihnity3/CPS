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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="p-3 mb-2 bg-light text-dark">
<?php include 'components/navbar.php' ?>
    <table class="table container">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Cryptocurrency</td>
            <!-- <th>Price(MYR)</td>
            <th>Market Cap(MYR)</td>
            <th>24 hr Volume</td> -->
        </tr>
    </thead>
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