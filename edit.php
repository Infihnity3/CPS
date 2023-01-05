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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="p-3 mb-2 bg-light text-dark">
<?php include 'components/navbar.php' ?>

<script>
var check = function() {
  if (document.getElementById('password').value.length < 8) {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password must be at least 8 characters';
      
  } else {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'You are good to go';

  }
}
</script>
<div class="container">
<h1>Edit Profile</h1>
    <form action="editProfile.php" class="container" method="post">
        <div class="form-group">
          <label for="username">Email</label>
          <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?php echo $user['username']; ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeyup='check()' required>
        </div>
        <div id="message"></div>
        <button type="submit" class="btn btn-dark" value="Submit" name="edit">Edit Profile</button>
    </form>
</div>
</body>
