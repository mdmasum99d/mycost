<div class="menu">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="product.php">Product</a></li>
        <li><a href="index.php">Cost</a></li>
        <li><a href="deposit.php">Deposit</a></li>
        <li><a href="#">History</a>
            <ul>
                <li><a href="decategory.php?category=Salary">Salary</a></li>
                <li><a href="decategory.php?category=Covid">Covid</a></li>
                <li><a href="decategory.php?category=Extra_Fack">Extra_Fack</a></li>
                <li><a href="decategory.php?category=Abbu">Abbu</a></li>
                <li><a href="decategory.php?category=Relative">Relative</a></li>
                <li><a href="decategory.php?category=Cov_Bokul">Cov_Bokul</a></li>
                <li><a href="decategory.php?category=Cov_Rasel">Cov_Rasel</a></li>
                <li><a href="decategory.php?category=Fruit">Business</a></li>
                <li><a href="decategory.php?category=Covid_Hum">Covid_Hum</a></li>
                <li><a href="decategory.php?category=Covid_AZIZ">Covid_AZIZ</a></li>
                <li><a href="decategory.php?category=Covid_Nazrul">Covid_Nazrul</a></li>
                <li><a href="decategory.php?category=Covid_Jolil">Covid_Jolil</a></li>
                <li><a href="decategory.php?category=Deposit_Person">Deposit_Person</a></li>
                <li><a href="decategory.php?category=Other">Other</a></li>                 
            </ul>
        </li>
        <li><a href="#">Month</a>
        <ul>
                <li><a href="dmonth.php?month=Dec-21">Dec-21</a></li>
                <li><a href="dmonth.php?month=Jan-22">Jan-22</a></li>               
                <li><a href="dmonth.php?month=Feb-22">Feb-22</a></li>               
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
        top: 100%;
        left: 0;
        background-color: #ff793f;
        display: none;
        opacity: 0;
        transition: .3s;
    }
    .menu ul li:hover ul{
        display: block;
        opacity: 1;
    }
    .menu ul ul{
        width:110%;
    }
    .menu ul ul li{
        border-bottom:1px solid #ddd;
    }
</style>