<?php
session_start();
 $slider_value = 3;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript">
        function showRangeValue(c){
            document.getElementById('disp_range_value').innerHTML = c.value;
        }
    </script>
</head>
<body class="p-3 mb-2 bg-light text-dark">

    <?php include 'components/navbar.php' ?>

    <h1 class="container">Please Rate your Experience with our App</h1>

    <form action="addFeedback.php" class="container" method="post">
        <div class="form-group">
          <label for="rating" class="form-label">Rating</label>
          <input class="form-range" type="range" oninput="showRangeValue(this);"name="rating" id="rating" value ="<?php echo $slider_value?>" min ="1" max ="5" required>
          <span id="disp_range_value"><?php echo $slider_value?></span> Stars
          </input>
        </div>
        <div class="form-group">
          <label for="comment">Comment</label>
          <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-dark" value="submit" name="submit">Submit Feedback</button>
    </form>
</body>
