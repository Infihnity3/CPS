<?php
session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
}

if(isset($_POST['Add']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}
?>