<div class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="index.php">Cost</a></li>
        <li><a href="deposit.php">Deposit</a></li>
        <li><a href="#">Category</a>
            <ul>
            <?php
                $sql = "SELECT * FROM cback";
                $query = mysqli_query($conn,$sql);
                    if($query){
                        if(mysqli_num_rows($query)>0){
                          while($row=mysqli_fetch_assoc($query)){
            ?>
            <li><a href="category.php?category=<?=$row['cost'];?>"><?=$row['cost'];?></a></li>
            <?php
                }
                    }
                     }
            ?>
            </ul>
        </li>
        <li><a href="#">Month</a>
        <ul>
                <li><a href="month.php?month=Dec-21">Dec-21</a></li>
                <li><a href="month.php?month=Jan-22">Jan-22</a></li>               
                <li><a href="month.php?month=Feb-22">Feb-22</a></li>               
            </ul>
        </li>
        <li><a href="#">History</a>
            <ul>
                <li><a href="dailyCost.php">Cost History</a></li>
                <li><a href="dailyDeposit.php">Deposit History</a></li>
            </ul>
        </li>
        <li><a href="#">Backend</a>
            <ul>
                <li><a href="backend/cost_back.php">Cost Update</a></li>
                <li><a href="backend/deposit_back.php">Deposit Update</a></li>
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