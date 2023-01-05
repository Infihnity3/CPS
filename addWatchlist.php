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
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    // $sql = mysqli_query($mysqli,$insert);

    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add1']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin1"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    // $sql = mysqli_query($mysqli,$insert);
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }

}
if(isset($_POST['Add2']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin2"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add3']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin3"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add4']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin4"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add5']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin5"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add6']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin6"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add7']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin7"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }
}

if(isset($_POST['Add8']))
{
    
    $email=$user['email'];
    $coin = $_POST["coin8"];
    $insert = "INSERT INTO watchlist (email, crypto_w) VALUES ('$email', '$coin')";
    $select = mysqli_query($mysqli, "SELECT * FROM watchlist WHERE email = '".$user['email']."' AND crypto_w = '$coin'");
    if(mysqli_num_rows($select)) {
        exit('<script>alert("This cryptocurrency exists in your watchlish");window.location.href="home.php";</script>');

    } else {
        $mysqli->query($insert);
        exit('<script>alert("Added Successfully");window.location.href="watchlist.php";</script>');
    }

}