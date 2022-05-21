<?php
  include 'connection.php';
    $sql = "SELECT SUM(amount) AS value_sum FROM cost";
    $query = mysqli_query($conn,$sql);
    if($query){
        if(mysqli_num_rows($query)>0){
            while($cvalue=mysqli_fetch_assoc($query)){

                $sql = "SELECT SUM(amount) AS value_sum FROM deposit";
                        $query = mysqli_query($conn,$sql);
                        if($query){
                            if(mysqli_num_rows($query)>0){
                                while($devalue=mysqli_fetch_assoc($query)){
                $cost_value = $cvalue['value_sum'];
                $deposit_value = $devalue['value_sum'];
                $extra =  $deposit_value - $cost_value;

            }
        }
    }    
                                }
                            }
                        }
?>
