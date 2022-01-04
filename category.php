<?php
    include 'connection.php';
    
    if(isset($_GET['category'])){
        $cat=$_GET['category'];
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
                include 'menu1.php';
            ?>
            </div>
        </div>
        <div class="all_box">
            <div class="cost">
                <h1><?=$cat;?> Category Data Show and Cost History</h1>
            </div>
            <div class="deposit_history">
                    <div class="history_amount">
                        <div class="single_history">
                            <?php
                            $sql = "SELECT SUM(amount) AS value_sum FROM cost WHERE category='$cat'";
                                $query = mysqli_query($conn,$sql);
                                if($query){
                                    if(mysqli_num_rows($query)>0){
                                        while($cvalue=mysqli_fetch_assoc($query)){
                                ?>
                            <p id="c_m">Cost <?=$cat;?> : <span><?=$cvalue["value_sum"];?> TK</span></p>
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
                            <th>Cost No</th>
                            <th>Subject</th>
                            <th>Details</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                    <?php
                         $sql="SELECT * FROM cost WHERE category='$cat' order By c_id DESC";
                         $query  = mysqli_query($conn,$sql);

                         if($query){
                             if(mysqli_num_rows($query)>0){
                                 while($cos=mysqli_fetch_assoc($query)){

                                 
                    ?>
                    <td><?=$cos['cost_no'];?></td>
                    <td><?=$cos['subject'];?></td>
                    <td><?=$cos['details'];?></td>
                    <td><?=$cos['category'];?></td>
                    <td><?=$cos['amount'];?></td>
                    <td><?=$cos['date'];?></td>
                    <td><a href="delete.php?c_id=<?=$row['c_id'];?>" style="background:red;padding:5px 10px;color:#fff;">Delete</a></td>
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