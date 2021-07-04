<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $dbname = "hipo";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (mysqli_connect_error()) {
        die("Can't connect to the database");
    }

    $conn->query("SET NAMES 'utf8'");
?>