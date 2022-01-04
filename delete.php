<?php
    include 'connection.php';
    if(isset($_GET['c_id'])){
        $sql = "DELETE from cost where c_id =".$_GET['c_id'];
        $query = mysqli_query($conn,$sql);
        if($query){
            header('location:index.php');
        }
        else{
            echo "<script>alert('Something went wrong')</script>".mysqli_error($conn);
        }
    }
    if(isset($_GET['p_id'])){
        $sql = "DELETE from product where p_id =".$_GET['p_id'];
        $query = mysqli_query($conn,$sql);
        if($query){
            header('location:product.php');
        }
        else{
            echo "<script>alert('Something went wrong')</script>".mysqli_error($conn);
        }
    }
    if(isset($_GET['d_id'])){
        $sql = "DELETE from deposit where d_id =".$_GET['d_id'];
        $query = mysqli_query($conn,$sql);
        if($query){
            header('location:deposit.php');
        }
        else{
            echo "<script>alert('Something went wrong')</script>".mysqli_error($conn);
        }
    }
?>