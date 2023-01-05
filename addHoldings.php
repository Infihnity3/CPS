<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . '/database.php';

    $sql = "SELECT * FROM user WHERE id = " . $_SESSION['user_id'];

    $result = $mysqli-> query($sql);

    $user = $result->fetch_assoc();

    $email = $user['email'];
    $crypto = $_POST['crypto'];
    $amount = $_POST['amount'];
    $sql = "INSERT INTO portfolio (email_p, crypto, amount) VALUES ('$email', '$crypto', '$amount')";
    
    

    $select = mysqli_query($mysqli, "SELECT * FROM portfolio WHERE email_p = '".$user['email']."' AND crypto = '".$_POST['crypto']."'");
        if(mysqli_num_rows($select)) {
            exit('<script>alert("This cryptocurrency exists in your portfolio");window.location.href="portfolio.php";</script>');

        } else {
            $mysqli->query($sql);
            exit('<script>alert("Added Successfully");window.location.href="portfolio.php";</script>');
        }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Holdings</title>
</head>
<body class="p-3 mb-2 bg-light text-dark">
    <?php include 'components/navbar.php' ?>
<div class="container">
    <form method="POST">
    <div class="form-group">
        <label>Cryptocurrency</label>
        <select class="form-control" id="crypto" name="crypto">
            <option>Bitcoin</option>
            <option>Ethereum</option>
            <option>Bitcoin Cash</option>
            <option>Litecoin</option>
            <option>Ripple</option>
            <option>Cardano</option>
            <option>Solana</option>
            <option>Uniswap</option>
            <option>ChainLink</option>
        </select>
    </div>
    <div class="form-group">
        <label>Amount</label>
        <input type="number" class="form-control" name="amount" id="amount" required step="any" min="0">
    </div>
    <button type="submit" class="btn btn-dark" name="submit" id="submit">Add Holdings</button>
</form>
    <a><button class="btn btn-dark" onclick="window.location.href='portfolio.php'">Back</button></a>
</div>
</body>
</html>