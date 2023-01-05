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

    $crypto = $_GET['a'];
    $amount = $_GET['b'];


}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio</title>
</head>
<body class="p-3 mb-2 bg-light text-dark">
<?php include 'components/navbar.php' ?>
<div class="container">
<form action="editAmount.php"method="POST">
    <div class="form-group">
        <label for="crypto">Cryptocurrency</label>
        <input type="text" class="form-control" id="crypto" name="crypto" value="<?php echo $crypto ?>" readonly>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $amount ?>" step="any" min="0">
    </div>
    <button type="submit" class="btn btn-dark" name="submit" id="submit">Edit Holdings</button>
</form>
</div>
</body>
</html>