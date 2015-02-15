<?php    
    // These variables define the connection information for your MySQL database 
    $username = "root"; 
    $password = "tua878faeff"; 
    $host = "localhost"; 
    $dbname = "stakeholder"; 
    
    $dbcon = mysqli_connect($host, $username, $password);
    mysqli_set_charset($dbcon, "utf8");
    mysqli_select_db($dbcon, $dbname);  
?> 