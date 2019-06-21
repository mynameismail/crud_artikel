<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "crud";

function getConnection() {
    $conn = new mysqli($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass']);
    if ($conn->connect_error) die("MySQL connection failed: " . $conn->connect_error);
    return $conn;
}

function getDBConnection() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "root";
    $dbname = "crud";
    
    $conn = new mysqli($GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
    if ($conn->connect_error) die("MySQL connection failed: " . $conn->connect_error);
    return $conn;
}

function closeConnection($conn) {
    $conn->close();
}
