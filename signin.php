<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . '/database.php';

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", $mysqli->real_escape_string($_POST['email']));

    $result = $mysqli-> query($sql);

    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($_POST['password'], $user['password_hash'])) {
            session_start();

            session_regenerate_id();

            $_SESSION['user_id'] = $user['id'];
            header("Location: home.php");
            exit;
        }
    }

    $is_invalid = true;
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
        Sign In
    </h1>
    <?php if (isset($is_invalid)): ?>
        <em>Invalid email or password.</em>
    <?php endif; ?>

    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit" value="Signin">Sign In</button>
    </form>
    <a href="register.html"><input type="Submit" value="Register"></input></a>
</body>
