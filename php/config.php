<?php 

    $conn = mysqli_connect('mars.cs.qc.cuny.edu' , 'tipr7564' , '23567564' , 'tipr7564');
    if(!$conn){
        echo "Database connection error".mysqli_connect_error();
    }
?>