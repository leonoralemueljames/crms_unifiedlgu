<?php 
$servername = "localhost";
$username = 'root';
$passwordDB = "";
$dbname = "crms_system_db";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?> 




