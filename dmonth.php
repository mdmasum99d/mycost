<?php
    include 'connection.php';
    
    if(isset($_GET['month'])){
        $man=$_GET['month'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div id="other_header">
    <div class="other_first">
        <div class="other_menu">
            <div class="container">
            <?php
                include 'dmenu.php';
            ?>
            </div>
        </div>
        <div class="all_box">
            <div class="cost">
                <h1><?=$man;?> Month Data Show and Deposit History</h1>
            </div>
            <div class="deposit_history">
                    <div class="history_amount">
                        <div class="single_history">
                            <?php
                            $sql = "SELECT SUM(amount) AS value_sum FROM deposit WHERE month='$man'";
                                $query = mysqli_query($conn,$sql);
                                if($query){
                                    if(mysqli_num_rows($query)>0){
                                        while($cvalue=mysqli_fetch_assoc($query)){
                                ?>
                            <p id="c_m">Cost <?=$man;?> : <span><?=$cvalue["value_sum"];?> TK</span></p>
                            <?php
                                        }
                                    }
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alldata">
                    <div class="data_show">
                    <body>
                        <table id="customers">
                        <tr>
                            <th>Deposit No</th>
                            <th>Subject</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <?php
                                $sql="SELECT * FROM deposit WHERE month='$man' order By d_id DESC";
                                $query  = mysqli_query($conn,$sql);

                                if($query){
                                    if(mysqli_num_rows($query)>0){
                                        while($mon=mysqli_fetch_assoc($query)){

                                        
                            ?>
                            <td><?=$mon['deposit_no'];?></td>
                            <td><?=$mon['subject'];?></td>
                            <td><?=$mon['category'];?></td>
                            <td><?=$mon['amount'];?></td>
                            <td><?=$mon['time'];?></td>
                            <td><a href="delete.php?c_id=<?=$mon['d_id'];?>" style="background:red;padding:5px 10px;color:#fff;">Delete</a></td>
                        </tr>
                        <?php
                        }
                    }
                }
                        ?>
                        
                        </table>

                        </body>
                    </div>
                </div>
        </div>
</body>
</html>