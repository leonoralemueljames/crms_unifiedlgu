<?php

include('../connection.php');
  // Remove notification from database
  $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
  $stmt->bind_param("i", $_POST['id']);
  $stmt->execute();
  $stmt->close();
?>