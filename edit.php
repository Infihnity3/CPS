<?php
session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<body>
    <h1>
        Edit Profile
   </h1>

    <form action="editProfile.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <button type="submit" value="Submit" name="edit">Edit</button>
    </form>
    <a href="home.php"><input type="Submit" value="Home"></input></a>
</body>
