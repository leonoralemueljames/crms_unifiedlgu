<?php
// notification.php
include ('../connection.php');

// Check for new notifications
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM notifications WHERE read = 0");
$stmt->execute();
$result = $stmt->get_result();
$count = $result->fetch_assoc()['count'];

// Send notification to client
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
echo "event: notification\n";
echo "data: $count\n\n";
flush();

// Check for new notifications every 5 seconds
while (true) {
  $stmt = $conn->prepare("SELECT COUNT(*) as count FROM notifications WHERE read = 0");
  $stmt->execute();
  $result = $stmt->get_result();
  $newCount = $result->fetch_assoc()['count'];

  if ($newCount > $count) {
    echo "event: notification\n";
    echo "data: $newCount\n\n";
    flush();
    $count = $newCount;
  }

  sleep(5);
}