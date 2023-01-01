<?php

session_start();

if(isset($_SESSION['user_id'])){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();  
}
?>

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
        Home
    </h1>
<?php if (isset($user)): ?>
    <p>Welcome, <?= htmlspecialchars($user['username']) ?></p>

    <a href="signout.php"><input type="Submit" value="Sign Out"></input></a>
    <a href="edit.php"><input type="Submit" value="Edit Profile"></input></a>
    <a href="feedback.php"><input type="Submit" value="Feedback Form"></input></a>
    <a href="watchlist.php"><input type="Submit" value="My Watchlist"></input></a>

<?php else: ?>
    <p>Sign In Failed</p>
    <p><a href="signin.php"><input type="Submit" value="Sign In"></a> or 
    <a href="register.html"><input type="Submit" value="Register"></a></p>
<?php endif; ?>

</body>
</html>