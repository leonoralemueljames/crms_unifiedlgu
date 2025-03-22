<?php

include 'connection.php'; 

header('Content-Type: application/json');

// Set the start date to September 30, 2024
$startDate = new DateTime('2024-9-20');
$endDate = new DateTime(); // Current date
$endDate->setTime(0, 0, 0); // Set time to midnight

// Initialize arrays to hold data
$dates = [];
$total_users = [];
$total_admins = [];

// Generate the date range
$interval = new DateInterval('P1D'); // 1 day interval
$dateRange = new DatePeriod($startDate, $interval, $endDate->modify('+10 day')); // Include the end date

// Prepare the dates array
foreach ($dateRange as $date) {
    $formattedDate = $date->format('Y-m-d');
    $dates[] = $formattedDate;
    
    // Initialize counts to zero
    $total_users[$formattedDate] = 0;
    $total_admins[$formattedDate] = 0;
}

// Query to get daily user counts
$query_users = "
    SELECT 
        DATE(created_at) AS date,
        COUNT(*) AS total_users
    FROM user_accounts
    WHERE created_at >= '2024-10-1' AND created_at <= NOW()
    GROUP BY date
";

$result_users = $conn->query($query_users);
while ($row = $result_users->fetch_assoc()) {
    $total_users[$row['date']] = (int)$row['total_users']; // Store user count
}

// Query to get daily admin counts
$query_admins = "
    SELECT 
        DATE(created_at) AS date,
        COUNT(*) AS total_admins
    FROM admin_accounts
    WHERE created_at >= '2024-10-1' AND created_at <= NOW()
    GROUP BY date
";

$result_admins = $conn->query($query_admins);
while ($row = $result_admins->fetch_assoc()) {
    $total_admins[$row['date']] = (int)$row['total_admins']; // Store admin count
}

$conn->close();

// Prepare the data for the response
$users_totals = [];
$admins_totals = [];

foreach ($dates as $date) {
    $users_totals[] = $total_users[$date]; // Get user count
    $admins_totals[] = $total_admins[$date]; // Get admin count
}

// Return the data as JSON
echo json_encode([
    'dates' => $dates,
    'total_users' => $users_totals,
    'total_admins' => $admins_totals
]);
?>