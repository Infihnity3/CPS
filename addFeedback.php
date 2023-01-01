<?php

session_start();
$mysqli = require __DIR__ . '/database.php';

;

if(isset($_SESSION['user_id'])){
    

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
    
    // print_r($user['email']);
}


// include "database.php";

if(isset($_POST['submit']))
{
    
    $email=$user['email'];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];

    // print_r($email);
    // print_r($rating);
    // print_r($comment);

    $insert = "INSERT INTO feedback (email_f, rating, comment) VALUES ('$email', '$rating', '$comment')";
    
    $sql = mysqli_query($mysqli,$insert);
    if($sql){
        header('location:home.php');
    }
    else{
        header('location:feedback.php');
    }

    // $stmt = $mysqli->stmt_init();

    // if (!$stmt->prepare($sql)){
    //     die("SQL Error: " . $stmt->error);
    // };
    
    // $stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password_hash);
    
    // if ($stmt->execute()) {
    //     header("Location: home.php");
    //     exit;
    // }
    // else {
    //     header("Location: feedback.php")
    // }
}