<?php
    include 'connection.php';
    if(isset($_GET['submit'])){
        $month = ['month'];
        $year = ['year'];
        $dtoday = $month.'-'.$year;
        $tmonth = $month.'-'.$year;
    }
    // date_default_timezone_set('Asia/Dhaka');
    //     $dtoday = date('F Y');
    //     $tmonth = date('m-Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="daily.css">
</head>
<body>
    <div class="daily_history">
        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php">Cost</a></li>
                <li><a href="deposit.php">Deposit</a></li>
                <li><a href="dailyCost.php">Cost History</a></li>
            </ul>
        </div>
        <div class="history_amount">
            <h2>Filter:</h2>
            <div class="filter_input">
                <form action="dailyDeposit.php" method="POST">
                    <select name="month" id="">
                        <option value="Jan">Jan</option>
                        <option value="Feb">Feb</option>
                        <option value="Mar">Mar</option>
                        <option value="Apr">Apr</option>
                        <option value="May">May</option>
                        <option value="Jun">Jun</option>
                        <option value="Jul">Jul</option>
                        <option value="Aug">Aug</option>
                        <option value="Sep">Sep</option>
                        <option value="Oct">Oct</option>
                        <option value="Nov">Nov</option>
                        <option value="Dec">Dec</option>
                    </select>
                    <select name="year" id="">
                        <option value="21">2021</option>
                        <option value="22">2022</option>
                        <option value="23">2023</option>
                        <option value="24">2024</option>
                    </select>
                    <input type="submit" value="Submit" name="submit">
                </form>
            </div>
            <h1>Deposit <?=$dtoday;?> History</h1>
            <div class="single_history">
                <?php
                    $i=1;
                    for($i=1;$i<=9;$i++){
                        $man='0'.$i.'-'.$tmonth;
                        $sql = "SELECT SUM(amount) AS value_sum FROM deposit WHERE time='$man'";
                            $query = mysqli_query($conn,$sql);
                            if($query){
                                if(mysqli_num_rows($query)>0){
                                    while($cvalue=mysqli_fetch_assoc($query)){
                                ?>
                            <p id="c_m"><?=$man;?><span><?=$cvalue["value_sum"];?> TK</span></p>
                            <?php
                                        }
                                    }
                                }
                            }
                            for($i=10;$i<=31;$i++){
                                $man=$i.'-'.$tmonth;
                                $sql = "SELECT SUM(amount) AS value_sum FROM deposit WHERE time='$man'";
                                    $query = mysqli_query($conn,$sql);
                                    if($query){
                                        if(mysqli_num_rows($query)>0){
                                            while($cvalue=mysqli_fetch_assoc($query)){
                                        ?>
                                    <div class="single_date">
                                        <p id="c_m"><?=$man;?><span><?=$cvalue["value_sum"];?> TK</span></p>
                                    </div>
                                    <?php
                                                }
                                            }
                                        }
                                    }
                            
                            ?>
            </div>
        </div>
    </div>
</body>
</html>
