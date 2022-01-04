<?php
    include 'connection.php';
    if(isset($_POST['submit'])){
        $name = mysqli_escape_string($conn,$_POST['name']); 
        date_default_timezone_set('Asia/Dhaka');
        $product_no = date('dmyHis'); 
        $details = mysqli_escape_string($conn,$_POST['details']); 
        $lot = mysqli_escape_string($conn,$_POST['lot']); 
        $amount = mysqli_escape_string($conn,$_POST['amount']); 
        $month = date('d-m-Y');

        $sql="INSERT INTO product(product_no,p_name,details,lot,amount,date)VALUES('$product_no','$name','$details','$lot','$amount','$month')";
        
        $query=mysqli_query($conn,$sql);
        if($query){
            header('location:product.php');
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
    <title>Calculation | Product</title>
</head>
<body>
    <div id="header">
        <div class="all_box">
            <?php include 'menu.php'; ?>
            <div class="cost">
                <h1>Masum Product Record Web</h1>
                <div class="masum_body">
                    <form action="?" method="POST">
                        <div class="single_div">
                            <input type="text" placeholder="Product Name" name="name" required>
                        </div>
                        <div class="single_div">
                            <textarea name="details" rows="5" placeholder="Details" name="details" required></textarea>
                        </div>
                        <div class="single_div">
                            <input type="text" placeholder="Lot" name="lot">
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
                        $sql = "SELECT SUM(amount) AS value_sum FROM product";
                        $query = mysqli_query($conn,$sql);
                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($cvalue=mysqli_fetch_assoc($query)){
                        ?>
                        <p id="c_m">Product Cost: <span><?=$cvalue["value_sum"];?></span> TK</p>
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
                    <th>Product No</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Lot</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <?php
                        $sql="SELECT * FROM product order By p_id DESC";
                        $query = mysqli_query($conn,$sql);

                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($pod=mysqli_fetch_assoc($query)){
                        
                    ?>
                    <td><?=$pod['product_no'];?></td>
                    <td><?=$pod['p_name'];?></td>
                    <td><?=$pod['amount'];?></td>
                    <td><?=$pod['lot'];?></td>
                    <td><?=$pod['details'];?></td>
                    <td><?=$pod['date'];?></td>
                    <td><a href="delete.php?p_id=<?=$pod['p_id'];?>" style="background:red;padding:5px 10px;color:#fff;">Delete</a></td>
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


