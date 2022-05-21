<?php
    include 'connection.php';
    include 'calculator.php';
    $error='';
    date_default_timezone_set('Asia/Dhaka');
    $time = date('d-m-Y');
    if(isset($_POST['submit'])){
        $subject = mysqli_escape_string($conn,$_POST['subject']); 
        date_default_timezone_set('Asia/Dhaka');
        $deposit_no = date('dmyHis'); 
        $category = mysqli_escape_string($conn,$_POST['category']); 
        $amount = mysqli_escape_string($conn,$_POST['amount']); 
        $ddate = mysqli_escape_string($conn,$_POST['ddate']); 
        
        $month = date('M-y');
        $year = date('Y');

        $sql="INSERT INTO deposit(deposit_no,subject,category,amount,time,month,year)VALUES('$deposit_no','$subject','$category','$amount','$ddate','$month','$year')";
        
        $query=mysqli_query($conn,$sql);
        if($query){
            header('location:deposit.php');
            echo "<script>alert('You are successfully registed')</script>";
        }
        else{
            "<script>alert('Something went wrong')</script>".mysqli_error($conn);
        }
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Calculation | Deposit</title>
</head>
<body>
    <div id="header">
        <div class="all_box">
        <div class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="index.php">Cost</a></li>
        <li><a href="deposit.php">Deposit</a></li>
        <li><a href="#">Category</a>
        <ul>
            <?php
                $sql = "SELECT * FROM dback";
                $query = mysqli_query($conn,$sql);
                    if($query){
                        if(mysqli_num_rows($query)>0){
                          while($row=mysqli_fetch_assoc($query)){
            ?>
            <li><a href="decategory.php?category=<?=$row['deposit'];?>"><?=$row['deposit'];?></a></li>
            <?php
                }
                    }
                     }
            ?>
            </ul>
        </li>
        <li><a href="#">Month History</a>
            <ul>
                <li><a href="dmonth.php?month=Dec-21">Dec-21</a></li>
                <li><a href="dmonth.php?month=Jan-22">Jan-22</a></li>               
                <li><a href="dmonth.php?month=Feb-22">Feb-22</a></li>               
            </ul>
        </li>
        <li><a href="#">History</a>
            <ul>
                <li><a href="dailyCost.php">Cost History</a></li>
                <li><a href="dailyDeposit.php">Deposit History</a></li>
            </ul>
        </li>
    </ul>
</div>
<style>
    .menu ul li{
        position: relative;
    }
    .menu ul ul{
        position: absolute;
        top: 0;
        left: 100%;
        background-color: #2c3e50;
        display: none;
        opacity: 0;
        transition: .3s;
    }
    .menu ul li:hover ul{
        display: block;
        opacity: 1;
    }
    .menu ul ul{
        width:100%;
    }
</style>
            <div class="cost">
                <h1>Masum Deposit Record Web</h1>
                <div class="masum_body">
                    <form action="?" method="POST">
                    <div class="single_div">
                            <input type="text" value="<?=$time;?>" name="ddate" required>
                        </div>
                        <div class="single_div">
                            <input type="text" placeholder="Subject" name="subject" required>
                        </div>
                        <div class="single_div">
                            <select name="category">
                                    <?php
                                    $sql = "SELECT * FROM dback";
                                    $query = mysqli_query($conn,$sql);
                                    if($query){
                                        if(mysqli_num_rows($query)>0){
                                            while($row=mysqli_fetch_assoc($query)){
                                                
                                      
                                ?>
                                <option value="<?=$row['deposit'];?>"><?=$row['deposit'];?></option>
                                <?php
                                      }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="single_div">
                            <input type="amount" placeholder="Amount" name="amount" required>
                        </div>
                        <div class="button">
                            <input type="submit" value="Submit" name="submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="deposit_history">
                <h1>You Summar Cost and Deposit</h1>
                <div class="history_amount">
                    <div class="single_history">
                        <p id="c_m">Deposit: <span><?=$deposit_value;?></span> TK</p>
                    </div>
                    <div class="single_history">
                        <p id="c_m">Cost: <span><?=$cost_value;?></span> TK</p>
                    </div>
                    <div class="single_history">
                        <p style="background:black;" id="c_m">Your Balance : <span><?=$extra;?></span> TK</p>
                    </div>
                    <div class="single_history">
                        <?php
                            date_default_timezone_set('Asia/Dhaka');
                            $tmonth = date('M-y');
                            $month = date('F');
                            $sql = "SELECT SUM(amount) AS value_sum FROM deposit where month='$tmonth'";
                            $query = mysqli_query($conn,$sql);
                            if($query){
                            if(mysqli_num_rows($query)>0){
                                while($tmonth=mysqli_fetch_assoc($query)){
                        ?>
                        <p style="background:blue;">This <?=$month;?> : <span><?=$tmonth["value_sum"];?></span>TK</p>
                        <?php
                                }
                            }
                        }
                       
                ?>
                    </div>
                    <div class="single_history">
                        <?php
                            date_default_timezone_set('Asia/Dhaka');
                            $dtoday = date('d-m-Y');
                            $sql = "SELECT SUM(amount) AS value_sum FROM deposit where time='$dtoday'";
                            $query = mysqli_query($conn,$sql);
                            if($query){
                            if(mysqli_num_rows($query)>0){
                                while($dtoday=mysqli_fetch_assoc($query)){
                        ?>
                        <p style="background:blue;">Today : <span><?=$dtoday["value_sum"];?></span>TK</p>
                        <?php
                        
                                }
                            }
                        }
                       
                ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="alldata">
            <div class="data_menu" style="display:flex;">
                <h3>Filter Data : </h3>
                <div class="filter_area">
                    <div class="single_filter" style="display:flex;">
                        <h3>Month</h3>
                        <select name="fmonth"></select>
                    </div>
                </div>
            </div>
            <div class="data_show">
            <body>
                <table id="customers">
                <tr>
                    <th>Deposit No</th>
                    <th>Subject</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Action</th>
                    <th>Recipt</th>
                </tr>
                <tr>
                    <?php
                        $sql="SELECT * FROM deposit order By d_id DESC";
                        $query = mysqli_query($conn,$sql);

                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($row=mysqli_fetch_assoc($query)){
                        
                    ?>
                    <td><?=$row['deposit_no'];?></td>
                    <td><?=$row['subject'];?></td>
                    <td><?=$row['category'];?></td>
                    <td><?=$row['amount'];?></td>
                    <td><?=$row['time'];?></td>
                    <td><a href="delete.php?d_id=<?=$row['d_id'];?>" style="background:red;padding:5px 10px;color:#fff;">Delete</a>
                    </td>
                    <td><a href="print.php?d_id=<?=$row['d_id'];?>" style="background:#3498db;padding:5px 10px;color:#fff;" target="blank">Print</a></td>
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


