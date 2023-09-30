<?php

    $serverName = "localhost";
    $serverUser = "root";
    $serverPassword = "Musical+1937";
    $dbName = "crsema";

    $connector = mysqli_connect($serverName, $serverUser, $serverPassword, $dbName);
    if(!$connector) {
        die("Server connection failed " . mysqli_error());
    }
    

