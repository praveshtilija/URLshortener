<!DOCTYPE html>
<html>
<head>
<title>My php page</title>
</head>
<body>
<h1>hi php page</h1>
<?php

$db = mysqli_connect('mars.cs.qc.cuny.edu' , 'tipr7564' , '23567564' , 'tipr7564') or die("could not connect to database" ) ;


        $query = "Select * from users";
        $results = mysqli_query($db , $query) ;

        if( mysqli_num_rows($results) ) 
        {
            echo "We connected to database and found user :)";			
			while($row = $results->fetch_assoc()) {
			echo " - Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
			}		
		}
        else
        {
			echo "We could not connect to database and find user";      
        }
 
mysqli_close($db);
?>
</body>
</html>