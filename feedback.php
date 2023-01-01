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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script type="text/javascript">
        function showRangeValue(c){
            document.getElementById('disp_range_value').innerHTML = c.value;
        }
    </script>
</head>
<body>
    <h1>
        Feedback Form 
   </h1>

    <form action="addFeedback.php" method="post">
        <label for="rating">Rating: </label>
        <input type="range" oninput="showRangeValue(this);"name="rating" id="rating" value ="<?php echo $slider_value?>" min ="1" max ="5" required>
        <span id="disp_range_value"><?php echo $slider_value?></span> Star
        </input>
        <br/>
        <br/>
        <label for="comment">Comment: </label>
        <textarea cols="32" name="comment" id="comment" rows="5"required>
        </textarea>
        <button type="submit" value="submit" name="submit">Submit</button>
    </form>
    <a href="home.php"><input type="Submit" value="Home"></input></a>
</body>
