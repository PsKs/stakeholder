<?php    
    // These variables define the connection information for your MySQL database 
    $db_username = "root";
    $db_password = "tua878faeff";
    $host = "localhost";
    $db_name = "stakeholder";
    $dbcon = @mysqli_connect($host, $db_username, $db_password);
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    @mysqli_set_charset($dbcon, "utf8");
    @mysqli_select_db($dbcon, $db_name);
?> 