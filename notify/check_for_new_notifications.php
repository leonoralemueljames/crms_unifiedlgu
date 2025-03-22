<?php

include('../connection.php');
  // Get notification count from database
  $stmt = $conn->prepare("SELECT COUNT(*) as count FROM notifications WHERE read = 0");
  $stmt->execute();
  $result = $stmt->get_result();
  $count = $result->fetch_assoc()['count'];
  echo $count;
  $stmt->close();
?>