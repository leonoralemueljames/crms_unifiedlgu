<?php
session_start();

// Check if the user is authenticated
if (isset($_SESSION['LAST_ACTIVITY'])) {
    // Update the last activity time
    $_SESSION['LAST_ACTIVITY'] = time();
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User  not authenticated']);
}
?>