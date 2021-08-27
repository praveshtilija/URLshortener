<?php

//Login users
$db = mysqli_connect('mars.cs.qc.cuny.edu' , 'tipr7564' , '23567564' , 'tipr7564') or die("could not connect to database" ) ;


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$login = $_POST['login'];
$password = $_POST['password'] ;


$errors = array() ;

if( empty($first_name))
{
    array_push($errors , "First name is required" ) ;
}
if( empty($last_name))
{
    array_push($errors , "Last name is required" ) ;
}
if( empty($login))
{
    array_push($errors , "Login is required" ) ;
}
if( empty($password))
{
    array_push($errors , "Password is required" ) ;
}

if( count($errors) == 0 ) {
    $query = "Select * from users where login = '$login'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results)) {
        echo 'login already exist';
    } else {
        $query = "Insert into users (first_name,last_name, login, pwd) values ( '$first_name','$last_name', '$login' , '$password' )";
        mysqli_query($db, $query);
        $query = "Select * from users where login = '$login' ";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results)) {
            $_SESSION['user_id'] = mysqli_fetch_array($results)['user_id'];
            $_SESSION['login'] = mysqli_fetch_array($results)['login'];
            header("Location: register.html");
            echo 'you are now registered and logged in';
        }

    }
    mysqli_close($db);
}
else{

    mysqli_close($db);
    echo '<div>';
    foreach($errors as $error){
        echo '<p>' . $error . '</p>';
    }
    //   <?php header("Refresh:2; url= index.php");
    echo '</div>';
}