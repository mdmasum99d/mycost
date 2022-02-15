<?php
    include 'connection.php';
    date_default_timezone_set('Asia/Dhaka');
        $dtoday = date('F Y');
        $tmonth = date('m-Y');
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
                <li><a href="deposit.php">Deposit</a></li>
                <li><a href="index.php">Cost</a></li>
                <li><a href="dailyDeposit.php">Deposit History</a></li>
            </ul>
        </div>
        <div class="history_amount">
            <h1>Cost <?=$dtoday;?> History</h1>
            <div class="single_history">
                <?php
                    $i=1;
                    for($i=1;$i<=9;$i++){
                        $man='0'.$i.'-'.$tmonth;
                        $sql = "SELECT SUM(amount) AS value_sum FROM cost WHERE date='$man'";
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
                                $sql = "SELECT SUM(amount) AS value_sum FROM cost WHERE date='$man'";
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
