<?php
    include 'connection.php';
    $error='';
    if(isset($_POST['submit'])){
        $subject = mysqli_escape_string($conn,$_POST['subject']); 
        date_default_timezone_set('Asia/Dhaka');
        $cost_no = date('dmyHis'); 
        $details = mysqli_escape_string($conn,$_POST['details']); 
        $category = mysqli_escape_string($conn,$_POST['category']); 
        if($category==0){
            $error="Please Select your category";
        }
        $amount = mysqli_escape_string($conn,$_POST['amount']); 
        $time = date('d-m-Y');
        $month = date('M-y');
        $year = date('Y');

        $sql="INSERT INTO cost(cost_no,subject,details,category,amount,date,month,year)VALUES('$cost_no','$subject','$details','$category','$amount','$time','$month','$year')";
        
        $query=mysqli_query($conn,$sql);
        if($query){
            header('location:index.php');
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
    <title>Calculation | Cost</title>
</head>
<body>
    <div id="header">
        <div class="all_box">
            <?php
                include 'menu.php';
            ?>
            <div class="cost">
                <h1>Masum Cost Record Web</h1>
                <div class="masum_body">
                    <form action="?" method="POST">
                        <div class="single_div">
                            <input type="text" placeholder="Subject" name="subject" required>
                        </div>
                        <div class="single_div">
                            <textarea name="details" rows="5" placeholder="Details" name="details" required></textarea>
                        </div>
                        <div class="single_div">
                            <select name="category">
                                <option value="0">Please Select Category</option>
                                <option value="House">House</option>
                                <option value="Mes">Mes</option>
                                <option value="Vara">Vara</option>
                                <option value="Versity">Versity</option>
                                <option value="Education">Education</option>
                                <option value="Fast_Food">Fast Food</option>
                                <option value="Food">Food</option>
                                <option value="Fruit">Fruit</option>
                                <option value="Market">Market</option>
                                <option value="Family">Family</option>
                                <option value="Mobile_load">Mobile load</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Electic">Electic</option>
                                <option value="Course">Course</option>
                                <option value="Business">Business</option>
                                <option value="Other">Other</option>
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
                    <?php
                        $sql = "SELECT SUM(amount) AS value_sum FROM cost";
                        $query = mysqli_query($conn,$sql);
                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($cvalue=mysqli_fetch_assoc($query)){
                        ?>
                        <p id="c_m">Cost: <span><?=$cvalue["value_sum"];?></span> TK</p>
                        <?php
                                }
                            }
                        }
                       
                ?>
                    </div>
                    <div class="single_history">
                    <?php
                        $sql = "SELECT SUM(amount) AS value_sum FROM deposit";
                        $query = mysqli_query($conn,$sql);
                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($devalue=mysqli_fetch_assoc($query)){
                        ?>
                        <p id="c_m">Deposit: <span><?=$devalue["value_sum"];?></span> TK</p>
                        <?php
                                }
                            }
                        }
                       
                ?>
                    </div>
                    <div class="single_history">
                        <?php
                            date_default_timezone_set('Asia/Dhaka');
                            $tmonth = date('M-y');
                            $month = date('F');
                            $sql = "SELECT SUM(amount) AS value_sum FROM cost where month='$tmonth'";
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
                            $sql = "SELECT SUM(amount) AS value_sum FROM cost where date='$dtoday'";
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
                        $sql="SELECT * FROM cost order By c_id DESC";
                        $query = mysqli_query($conn,$sql);

                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($row=mysqli_fetch_assoc($query)){
                        
                    ?>
                    <td><?=$row['cost_no'];?></td>
                    <td><?=$row['subject'];?></td>
                    <td><?=$row['details'];?></td>
                    <td><?=$row['category'];?></td>
                    <td><?=$row['amount'];?></td>
                    <td><?=$row['date'];?></td>
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


