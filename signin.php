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
            exit();
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
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="p-3 mb-2 bg-light text-dark">
    
    <?php if (isset($is_invalid)): ?>
        <em><script>
alert('Wrong Email/Password');;
</script></em>
    <?php endif; ?>

    <?php include 'components/navbar2.php' ?>
    <form class="container" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-dark" value="Signin">Sign In</button>
    </form>
    
</body>
