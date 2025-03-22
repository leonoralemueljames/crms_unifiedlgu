<?php
include('../connection.php');
session_start(); // Start the session to access session variables

// Debugging: Check session variables
if (!isset($_SESSION['email'])) {
    echo "Email not set in session.";   
}


// Check if the email is stored in the session
if (!isset($_SESSION['email'])) {
    die("Invalid request.");
}

$email = $_SESSION['email']; // Get the email from session


$token = bin2hex(random_bytes(16)); // This line may be unnecessary if you're using session token
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30); // Token expiry set to 30 minutes

$sql = "UPDATE user_accounts
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $conn->prepare($sql); // Use $conn instead of $mysqli

if ($stmt === false) {
    die("MySQL prepare failed: " . $conn->error);
}

$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt->execute();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPmailer/src/Exception.php';
require '../PHPmailer/src/PHPMailer.php';
require '../PHPmailer/src/SMTP.php';

// Check if the update was successful
if ($stmt->affected_rows > 0) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mail.crms.unifiedlgu@gmail.com'; // Your SMTP username
    $mail->Password = 'cblflapnrppuijol'; // Your SMTP password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Set up the email
    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);

    $mail->Subject = 'Password Reset';

       // Set email format to HTML
       $mail->isHTML(true);
   
       // Email body content
       $mail->Body = <<<END
       <html>
       <head>
           <style>
               body {
                   font-family: Arial, sans-serif;
                   background-color: #f4f4f4;
                   margin: 0;
                   padding: 20px;
               }
               .container {
                   max-width: 600px;
                   margin: auto;
                   background: white;
                   padding: 20px;
                   border-radius: 5px;
                   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
               }
               h2 {
                   color: #333;
               }
               p {
                   font-size: 16px;
                   color: #555;
               }
               .button {
                   display: inline-block;
                   padding: 10px 15px;
                   margin-top: 10px;
                   background-color: #007BFF;
                   color: white;
                   text-decoration: none;
                   border-radius: 5px;
               }
               .button:hover {
                   background-color: #0056b3;
               }
           </style>
       </head>
       <body>
           <div class="container">
               <h2>Password Reset Request</h2>
               <p>We received a request to reset your password for your account. To proceed with resetting your password, 
               Click the button below to reset your password. This will take you to a secure page where you can create a new password.</p>
               <a style="color: white;" class="button" href="http://localhost:3306/reset/reset-password.php?token=$token">Reset Your Password</a>
               <p>If you did not request a password reset, please ignore this email.</p>
               <p>This password reset request is valid for <strong>30 minutes</strong>. If you do not reset your password within this time frame, 
               you will need to submit another request.</p>
               <p>Thank you!</p>
           </div>
       </body>
       </html>
   END;

    // Try to send the email
    try {
        $mail->send();
        echo '<script>
            window.location.href = "../reset/send-email-confirm.php?status=success";
              </script>';
        session_destroy();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
} else {
    echo "No account found with that email address.";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>