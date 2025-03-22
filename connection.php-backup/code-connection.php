//FOR LOCALHOST

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



// FOR DEPLOYMENT

<?php 
$servername = "localhost";
$username = 'crms_admin';
$passwordDB = "+o+fm+K@pI9s5kGy";
$dbname = "crms_system_db";

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>