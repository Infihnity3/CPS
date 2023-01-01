<?php

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2'])) {
    echo "Please fill out all fields.";
}

if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
}

if (strlen($_POST["password"]) < 8) {
    echo "Password must be at least 8 characters.";
}

if(!preg_match("/^[a-zA-Z0-9]+$/", $_POST['password'])) {
    echo "Password must be alphanumeric";
}

if ($_POST['password'] != $_POST['password2']) {
    echo "Passwords do not match.";
}

$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . '/database.php';

$sql = "INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();
    
if (!$stmt->prepare($sql)){
    die("SQL Error: " . $stmt->error);
};

$stmt->bind_param("sss", $_POST['name'], $_POST['email'], $password_hash);

if ($stmt->execute()) {
    header("Location: signin.php");
    exit;
} else {

    if($mysqli->errno === 1062){
        die("Email already exists.");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}



?>