<?php
    include 'connection.php';
    if(isset($_POST['submit'])){
        $month = mysqli_escape_string($_POST['month']);

        $sql = "SELECT * FROM cost WHERE month = '$month'";
        $query = mysqli_query($conn,$sql);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost | Filter</title>
</head>
<body>
    <div class="filter">
        <div class="filter_area">
            <div class="filter_headline">
                <h1>Masum Filter Month</h1>
            </div>
            <div class="filter_body">
                <form action="?" method="POST">
                    <input type="text" name="month" placeholder="Jan-22">
                    <input type="submit" value="Submit" name="submit">
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>