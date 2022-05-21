<?php
    include 'connection.php';
    include 'calculator.php';
    use PHPMailer\PHPMailer\PHPMailer;

    require_once 'phpmailer/Exception.php';
    require_once 'phpmailer/PHPMailer.php';
    require_once 'phpmailer/SMTP.php';

    $error='';
    date_default_timezone_set('Asia/Dhaka');
    $time = date('d-m-Y');
    if(isset($_POST['submit'])){
        $subject = mysqli_escape_string($conn,$_POST['subject']); 
        date_default_timezone_set('Asia/Dhaka');
        $cost_no = date('dmyHis'); 
        $details = mysqli_escape_string($conn,$_POST['details']); 
        $category = mysqli_escape_string($conn,$_POST['category']); 
        $cdate = mysqli_escape_string($conn,$_POST['cdate']); 
        if($category==0){
            $error="Please Select your category";
        }
        $gmail = "mdmasum228928@gmail.com";
        $amount = mysqli_escape_string($conn,$_POST['amount']); 
        $month = date('M-y');
        $year = date('Y');

        $sql="INSERT INTO cost(cost_no,subject,details,category,amount,date,month,year)VALUES('$cost_no','$subject','$details','$category','$amount','$cdate','$month','$year')";
        
        $query=mysqli_query($conn,$sql);
            if($query){
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'club3637@gmail.com';
                $mail->Password = '01866921240';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = '587';

                $mail->setFrom('club3637@gmail.com');
                $mail->addAddress($gmail);
                $mail->isHTML(true);
                $mail->Subject = 'Your Daily Cost';
                $mail->Body = "<p>Hello, </p><span><b>Md Masum<b></span> <p>your cost entry successful.</p><br><p><b>Cost No : <b><span>$cost_no</span></p><br>
                <p><b>Subject : <b><span>$subject</span></p><br>
                <p><b>Details : <b><span>$details</span></p><br>
                <p><b>Category : <b><span>$category</span></p><br>
                <p><b>Amount : <b><span>$amount</span></p><br>";
                if(!$mail->send()){
                    echo "Mailer Error".$mail->ErrorInfo;
                }
                else{
                    echo "<script>alert('Verification has been sent successfully')</script>";
                }
                header("location:success.php");
            }
            else{
                echo mysqli_error($conn);
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
                            <input type="text" value="<?=$time;?>" name="cdate" required>
                        </div>
                        <div class="single_div">
                            <input type="text" placeholder="Subject" name="subject" required>
                        </div>
                        <div class="single_div">
                            <textarea name="details" rows="5" placeholder="Details" name="details" required></textarea>
                        </div>
                        <div class="single_div">
                            <select name="category">
                                    <?php
                                    $sql = "SELECT * FROM cback";
                                    $query = mysqli_query($conn,$sql);
                                    if($query){
                                        if(mysqli_num_rows($query)>0){
                                            while($row=mysqli_fetch_assoc($query)){
                                                
                                      
                                ?>
                                <option value="<?=$row['cost'];?>"><?=$row['cost'];?></option>
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
                        <p id="c_m">Cost: <span><?=$cost_value;?></span> TK</p>
                    </div>
                    <div class="single_history">
                        <p id="c_m">Deposit: <span><?=$deposit_value;?></span> TK</p>
                    </div>
                    <div class="single_history">
                        <p style="background:black;" id="c_m">Your Balance : <span><?=$extra;?></span> TK</p>
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
                    <th>Recipt</th>
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
                    <td><a href="cprint.php?c_id=<?=$row['c_id'];?>" style="background:#3498db;padding:5px 10px;color:#fff;" target="blank">Print</a></td>
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


