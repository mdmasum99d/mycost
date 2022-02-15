<div class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="index.php">Cost</a></li>
        <li><a href="deposit.php">Deposit</a></li>
        <li><a href="#">Category</a>
            <ul>
                <li><a href="category.php?category=House">House</a></li>
                <li><a href="category.php?category=Mes">Mes</a></li>
                <li><a href="category.php?category=Vara">Vara</a></li>
                <li><a href="category.php?category=Versity">Versity</a></li>
                <li><a href="category.php?category=Education">Education</a></li>
                <li><a href="category.php?category=Fast_Food">Fast_Food</a></li>
                <li><a href="category.php?category=Food">Food</a></li>
                <li><a href="category.php?category=Fruit">Fruit</a></li>
                <li><a href="category.php?category=Market">Market</a></li>
                <li><a href="category.php?category=Family">Family</a></li>
                <li><a href="category.php?category=Mobile_load">Mobile_load</a></li>                  
                <li><a href="category.php?category=Medicine">Medicine</a></li>                  
                <li><a href="category.php?category=Electic">Electic</a></li>                  
                <li><a href="category.php?category=Course">Course</a></li>                  
                <li><a href="category.php?category=Business">Business</a></li>                  
                <li><a href="category.php?category=Other">Other</a></li>                  
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