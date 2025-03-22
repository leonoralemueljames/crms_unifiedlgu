<?php
include('../connection.php');
session_start();

$sessionTimeoutDuration = 1300; // 1300 sec = 10 minutes


if (isset($_SESSION['LAST_ACTIVITY'])) {
    $duration = time() - $_SESSION['LAST_ACTIVITY'];

   
    if ($duration > $sessionTimeoutDuration) {
        
        $_SESSION = [];
        session_destroy();
        header("Location: /sign-in.php?session_timeout=true");
        exit; // Ensure no further code is executed
    }
}
// Update the last activity time
$_SESSION['LAST_ACTIVITY'] = time();

// Check if the user is authenticated
if (!isset($_SESSION['token']) || !isset($_SESSION['email'])) {
  header("Location: /sign-in");
    exit; // Ensure no further code is executed
}

// Handle logout
if (isset($_GET['logout'])) {
    $_SESSION = []; 
    session_destroy(); 
    header("Location: /sign-in");
    exit;
}

?>
