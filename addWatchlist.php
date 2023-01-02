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

if(isset($_POST['Add1']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin1"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add2']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin2"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add3']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin3"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add4']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin4"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add5']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin5"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add6']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin6"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add7']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin7"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}

if(isset($_POST['Add8']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin8"];
    $insert = "INSERT INTO watchlist (emailw, crypto) VALUES ('$email', '$coin')";
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:watchlist.php');
    }
    else{
        header('location:home.php');
    }
}