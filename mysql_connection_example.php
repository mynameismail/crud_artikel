<?php
function getConnection() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $dbname = "crud";
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) die("MySQL connection failed: " . $conn->connect_error);
    return $conn;
}

function closeConnection($conn) {
    $conn->close();
}
