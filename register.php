

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="/js/validation.js" defer></script>
    
</head>
<body class="p-3 mb-2 bg-light text-dark">
<?php include 'components/navbar2.php' ?>
<script>
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('password2').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'You are good to go';
  }else if (document.getElementById('password').value.length < 8) {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password must be at least 8 characters';
      
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Password does not match';

  }
}
</script>
    <h1 class="container">Registration Form</h1>
    <form class="container" action="signup.php" method="post" id="register">
        <div class="form-group">
            <label for="name">Username</label>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Enter username">
          </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" onkeyup='check()'>
        </div>
        <div class="form-group">
            <label for="password2">Password</label>
            <input type="password" class="form-control" id="password2" name="password2" placeholder="Password" onkeyup='check()'>
          </div>
          <div id="message"></div>
        <button type="submit" class="btn btn-dark" value="Register">Register</button>
      </form>
</body>
</html>