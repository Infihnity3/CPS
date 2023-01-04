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

if(isset($_POST['Add']))
{
    $email=$user['email'];
    $amount = $_POST["amount"];
    $coin = $_POST["coin"];

    if($portfolio['crypto'] == $coin){
        print_r($coin)
        // $amt = $portfolio['amount'] + $amount;
        // $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
        // $sql = mysqli_query($mysqli,$update);
        // if($sql){
        //     exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
        // }
    }
    else{
        print_r($amount)
        // $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
        // $sql = mysqli_query($mysqli,$insert);
        // if($sql){
        //     exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
        // }

    }

}

// if(isset($_POST['Add']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount"];
//     $coin = $_POST["coin"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add1']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount1"];
//     $coin = $_POST["coin1"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }
// if(isset($_POST['Add2']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount2"];
//     $coin = $_POST["coin2"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add3']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount3"];
//     $coin = $_POST["coin3"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add4']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount4"];
//     $coin = $_POST["coin4"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add5']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount5"];
//     $coin = $_POST["coin5"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add6']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount6"];
//     $coin = $_POST["coin6"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add7']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amount7"];
//     $coin = $_POST["coin7"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amount;
//         $update = "UPDATE portfolio SET amount = '$amt' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }

// if(isset($_POST['Add8']))
// {
//     $email=$user['email'];
//     $amount = $_POST["amoun81"];
//     $coin = $_POST["coin8"];

//     if($portfolio['crypto'] == $coin){
//         $amt = $portfolio['amount'] + $amt;
//         $update = "UPDATE portfolio SET amount = '$amount' WHERE email_p = '$email' AND crypto = '$coin'";
//         $sql = mysqli_query($mysqli,$update);
//         if($sql){
//             exit('<script>alert("Edited Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Editing Transactions");window.location.href="portfolio.php";</script>');
//         }
//     }
//     else{

//         $insert = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$coin', '$amount')";
//         $sql = mysqli_query($mysqli,$insert);
//         if($sql){
//             exit('<script>alert("Added Transactions");window.location.href="portfolio.php";</script>');
//         }
//         else{
//             exit('<script>alert("Error in Adding Transactions");window.location.href="portfolio.php";</script>');
//         }

//     }

// }