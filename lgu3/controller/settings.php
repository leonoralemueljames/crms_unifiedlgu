
<?php
$stmt = $conn->prepare("SELECT job_title, job_function, location, address, phone_number FROM user_accounts WHERE email = ?");
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$stmt->bind_result($job_title, $job_function, $location, $address, $phone_number);
$stmt->fetch();

$_SESSION['job_title'] = $job_title;
$_SESSION['job_function'] = $job_function;
$_SESSION['location'] = $location;
$_SESSION['address'] = $address;
$_SESSION['phone_number'] = $phone_number;

?>