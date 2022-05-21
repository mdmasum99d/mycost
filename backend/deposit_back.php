<?php
    include '../connection.php';
    $error = '';
    $emp = '';
    if(isset($_POST['submit'])){
        $deposit = mysqli_escape_string($conn,$_POST['deposit']);
        $exist = "SELECT deposit FROM dback WHERE deposit='$deposit'";
        $query = mysqli_query($conn,$exist);
        if(mysqli_num_rows($query)>0){
            $error = "This Category Alredy exist";
        }
        else if(empty($deposit)){
            $emp = "This column is required";
        }
        else{
            $sql = "INSERT INTO dback(deposit)VALUES('$deposit')";
            $query = mysqli_query($conn,$sql);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Backend | Deposit</title>
</head>
<body>
    <div id="header">
        <div class="all_box">
            <div class="menu">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../deposit.php">Deposit</a></li>
                    <li><a href="cost_back.php">Cost Back</a></li>
                    <li><a href="deposit_back.php">Deposit Back</a></li>                            
                </ul>
            </div>
            <div class="cost">
                <h1>Masum Backend Deposit Category</h1>
                <div class="masum_body">
                    <form action="?" method="POST">
                        <div class="single_div">
                            <input type="text" placeholder="Deposit" name="deposit">
                            <br><span><?=$error;?><?=$emp;?></span>
                        </div>
                        <div class="button">
                            <input type="submit" value="Submit" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="alldata">
            <div class="data_show">
                <table id="customers">
                <tr>
                    <th>ID</th>
                    <th>Deposit Category Name</th>
                    <th>Action</th>
                    
                </tr>
                <tr?>
                    <?php
                        $sql="SELECT * FROM dback order By id DESC";
                        $query = mysqli_query($conn,$sql);

                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($row=mysqli_fetch_assoc($query)){
                        
                    ?>
                    <td><?=$row['id'];?></td>
                    <td><?=$row['deposit'];?></td>
                    <td>Delete</td>
                </tr>
                <?php
                       }
                    }
                }
                ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


