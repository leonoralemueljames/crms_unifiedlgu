<?php
include('../connection.php');
  // Clear all notifications from database
  $stmt = $conn->prepare("TRUNCATE TABLE notifications");
  $stmt->execute();
  $stmt->close();
?>