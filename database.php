<?php 
    // This file is responsible for establishing connection to the database

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "project";
    //$conn = "";


    try {
    // Create connection
    $conn = mysqli_connect($db_server, $db_user,$db_pass,$db_name);

    } 
    catch (mysqli_sql_exception) {
        echo "Could not connected to the database <br>";
    }

    if ($conn) {
        //echo "Connected successfully <br>";
    }


?>
