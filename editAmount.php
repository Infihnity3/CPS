
<?php
session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  

    $sql2 = "SELECT * FROM portfolio WHERE email_p = '" . $user['email'] . "'";
    $result2 = $mysqli->query($sql2);
    $portfolio = $result2->fetch_assoc();

}

if(isset($_POST['submit'])){
$amount = $_POST['amount'];
$crypto = $_POST['crypto'];
$email = $user['email'];

$sql = "UPDATE portfolio SET amount = '$amount' WHERE email_p = '$email' AND crypto = '$crypto'";

$result = $mysqli->query($sql);

if($result){
    exit('<script>alert("Edited Successfully");window.location.href="portfolio.php";</script>');

}else{
    exit('<script>alert("Problem in editing amount");window.location.href="portfolio.php";</script>');
}

    
}