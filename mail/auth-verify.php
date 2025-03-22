<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

function sendVerificationEmail($toEmail, $verificationCode) {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com'; // Your SMTP username
        $mail->Password = 'your_password'; // Your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($toEmail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Verification';
        $mail->Body    = "Your verification code is: $verificationCode";

        $mail->send();
        return true; // Indicate success
    } catch (Exception $e) {
        return false; // Indicate failure
    }
}

?>