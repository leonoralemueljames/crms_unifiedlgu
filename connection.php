<?php 

// Tukuyin ang mga variable para sa koneksyon
$servername = "localhost";
$dbname = "crms_system_db";

// Tukuyin ang mga kredensyal batay sa kapaligiran
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $username = 'root';
    $passwordDB = "";
} else {
    $username = 'crms_admin';
    $passwordDB = "+o+fm+K@pI9s5kGy";
}

// Gumawa ng koneksyon
$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Suriin ang koneksyon
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ang iyong karagdagang code dito

?>




