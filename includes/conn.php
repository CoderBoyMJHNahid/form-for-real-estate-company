<?php 

    $host = "localhost";
    $username = "root";
    $pwd = "";
    $db_name = "cadastre";


    $conn = mysqli_connect($host,$username,$pwd,$db_name) or die("Couldn't connect to".mysqli_connect_error());


?>