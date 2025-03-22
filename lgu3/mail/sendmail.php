<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST['success-button'])){

    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];



//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mail.crms@gmail.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit - TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mail.crms@gmail.com', 'CRMS');
    $mail->addAddress('mail.crms@gmail.com', 'CRMS'); 
    
    //Add a recipient
    /*$mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');*/

    //Attachments
    /*
    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    */


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Enquiry -CRMS';
    $mail->Body    = 'Greetings! you git a new mail
   <h4>Name: ' . $firstname . ' ' . $lastname . '</h4>
    <h4>Email: '.$email.'</h4>
    <h4>This is CRMS Team. You are now successfully registered. Please sign-in and verify your account.</h4>
    
    ';
    /*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/

    if( $mail->send()){
        $_SESSION['status'] = "Thankyou. CRMS Team.";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
    exit(0);

    }else{
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
    exit(0);

    }

   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}else{
    header('Location: index.php');
    exit(0);
}


?>

$mail->Body    = '

<html>
        <head>
            <title>Your Account Credentials</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    max-width: 600px;
                    margin: auto;
                    text-align: center;
                }
                h2 {
                    color: #333;
                    margin-top: 0;
                }
                p {
                    color: #555;
                    line-height: 1.6;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 12px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                    color: #333;
                }
                .footer {
                    margin-top: 20px;
                    font-size: 0.9em;
                    color: #777;
                }
                .header-image {
                    width: 100%;
                    max-width: 200px; /* Adjust as needed */
                    margin: 0 auto 20px;
                }
                .button {
                    display: inline-block;
                    background-color: #007BFF; /* Bootstrap primary color */
                    color: white;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-weight: bold;
                    margin-top: 20px;
                    transition: background-color 0.3s;
                }
                .button:hover {
                    background-color: #0056b3; /* Darker shade on hover */
                }
            </style>
        </head>
        <body>
            <div class="container">
                <img src="https://example.com/path/to/your/image.jpg" alt="CRMS Logo" class="header-image">
                <h2>Welcome to CRMS!</h2>
                <p>Greetings! ' . htmlspecialchars($firstname) . ' ' . htmlspecialchars($lastname) . ',</p>
                <p>I have created an account for you in the CRMS portal. Below are your account credentials:</p>
                <table>
                    <tr>
                        <th>Username</th>
                        <td>' . htmlspecialchars($username) . '</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td>' . htmlspecialchars($password) . '</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>' . htmlspecialchars($_POST["role"]) . '</td>
                    </tr>
                </table>
                <p>Note: Please keep your credentials safe and do not share them with anyone.</p>
                <p>If you have any questions or need assistance, feel free to contact our support team.</p>
                <a href="https://your-crms-portal-link.com" class="button">Access Your Portal</a>
                <p class="footer">Best regards,<br>CRMS Admin, L James</p>
            </div>
        </body>
        </html>
        ';

        