<?php
// Include the connection file
include('connection.php');

// Set secure session parameters
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'crms.unifiedlgu.com', // Set your domain here
    'secure' => true, // Only send over HTTPS
    'httponly' => true, // Prevent JavaScript access
    'samesite' => 'Strict' // Prevent CSRF
]);

session_start();

// Initialize login attempts in session if not set


// Generate CSRF token and expiration if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_token_expiration'] = time() + 3600; // Token valid for 1 hour
}

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    header("Location: ./my/dashboard.php");
    exit();
}

// Set error reporting to display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$email = $password = "";
$emailerr = $passworderr = ""; // Single error variable
$account_lockout_err = ""; // Error for account lockout

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'] 
    || !isset($_SESSION['csrf_token_expiration']) || time() > $_SESSION['csrf_token_expiration']) {
        $csrf_err = "Invalid token or token has expired.";
    } else {
        // Check if login attempts exceed limit before validating email and password
        if ($_SESSION['login_attempts'] >= 5) {
            $account_lockout_err = "Your account has been temporarily locked due to too many failed login attempts. Please try again later.";
        } else {
            // Validate the email
            if (empty($_POST["email"])) {
                $emailerr = "Email is required!";
            } else {
                $email = htmlspecialchars(trim($_POST["email"])); // Sanitize input
            }

            // Validate the password
            if (empty($_POST["password"])) {
                $passworderr = "Password is required!";
            } else {
                $password = $_POST["password"];
            }

            // Check if there are any errors
            if (empty($emailerr) && empty($passworderr))  {
                // Prepare the SQL query
                $sql = "SELECT id, password, firstname, lastname, status FROM user_accounts WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                // Check if a user was found
                if ($stmt->num_rows > 0) {
                    // Bind the result
                    $stmt->bind_result($id, $hashedPassword, $firstname, $lastname, $status);
                    $stmt->fetch();

                    // Check if the user is blocked
                    if ($status == 'blocked') {
                        $account_lockout_err = "Your account has been blocked!";
                    } else {
                        // Verify the password
                        if (password_verify($password, $hashedPassword)) {
                            // Regenerate session ID to prevent session fixation
                            session_regenerate_id(true);

                            // Set the session variables
                            $_SESSION['email'] = $email;
                            $_SESSION['id'] = $id;
                            $_SESSION['name'] = $firstname . ' ' . $lastname;

                            // Generate a new CSRF token and reset its expiration
                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                            $_SESSION['csrf_token_expiration'] = time() + 3600; // Token valid for 1 hour

                            // Reset login attempts
                            $_SESSION['login_attempts'] = 0;

                            // Redirect to the dashboard
                            header("Location: ./my/dashboard.php");
                            exit();
                        } else {
                            $password_valid_err = "Invalid email or password!";
                            // Increment login attempts
                            $_SESSION['login_attempts']++;
                        }
                    }
                } else {
                    $email_valid_err = "Invalid email or password!";
                    // Increment login attempts
                    $_SESSION['login_attempts']++;
                }

                // Close the statement
                $stmt->close();

                // Check if login attempts exceed limit
                if ($_SESSION['login_attempts'] >= 5) {
                    // Update user status to 'blocked' in the database
                    $sql = "UPDATE user_accounts SET status='blocked' WHERE email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->close();

                    // Notify the user about the account lockout
                    $account_lockout_err = "Your account has been temporarily locked due to too many failed login attempts. Please try again later.";
                }
            }
        }
    }
}
?>











<?php


// Set secure session parameters
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'crms.unifiedlgu.com', // Set your domain here
    'secure' => true, // Only send over HTTPS
    'httponly' => true, // Prevent JavaScript access
    'samesite' => 'Strict' // Prevent CSRF
]);

// Start the session
session_start();

// Initialize login attempts if not set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Generate CSRF token and expiration if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['csrf_token_expiration'] = time() + 3600; // Token valid for 1 hour
}

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    header("Location: ./my/dashboard.php");
    exit();
}

// Set error reporting to display all errors (consider disabling in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$email = $password = "";
$emailerr = $passworderr = ""; // Single error variable
$csrf_err = $account_lockout_err = ""; // Error messages

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token'] || (time() > $_SESSION['csrf_token_expiration'])) {
        $csrf_err = "Invalid token or token has expired.";
    } else {
        // Validate the email
        if (empty($_POST["email"])) {
            $emailerr = "Email is required!";
        } else {
            $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailerr = "Invalid email format!";
            }
        }

        // Validate the password
        if (empty($_POST["password"])) {
            $passworderr = "Password is required!";
        } else {
            $password = trim($_POST["password"]);
        }

        // Check if there are any errors
        if (empty($emailerr) && empty($passworderr)) {
            // Prepare the SQL query
            $sql = "SELECT id, password, firstname, lastname, status, blocked_at FROM user_accounts WHERE email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                // Check if a user was found
                if ($stmt->num_rows > 0) {
                    // Bind the result
                    $stmt->bind_result($id, $hashedPassword, $firstname, $lastname, $status, $blocked_at);
                    $stmt->fetch();

                    // Check if the user is blocked
                    if ($status === 'blocked') {
                        // Check if the block duration has expired
                        $blockDuration = 900; // 15 minutes in seconds
                        $currentTime = time();
                        $blockedTime = strtotime($blocked_at);

                        if (($currentTime - $blockedTime) < $blockDuration) {
                            $account_lockout_err = "Your account has been temporarily locked due to too many failed login attempts. Please try again later.";
                        } else {
                            // Unlock the account after the block duration
                            $updateSql = "UPDATE user_accounts SET status = 'active', blocked_at = NULL WHERE id = ?";
                            if ($updateStmt = $conn->prepare($updateSql)) {
                                $updateStmt->bind_param("i", $id);
                                $updateStmt->execute();
                                $updateStmt->close();
                            }
                        }
                    } else {
                        // Verify the password
                        if (password_verify($password, $hashedPassword)) {
                            // Regenerate session ID to prevent session fixation
                            session_regenerate_id(true);
                            
                            // Set session variables
                            $_SESSION['email'] = $email;
                            $_SESSION['id'] = $id;
                            $_SESSION['name'] = $firstname . ' ' . $lastname;
                        
                            // Redirect to the dashboard
                            header("Location: ./my/dashboard.php");
                            exit(); // Ensure you exit after header
                        } else {
                            $_SESSION['login_attempts']++;
                            if ($_SESSION['login_attempts'] < 5) {
                                $password_valid_err = "Invalid email or password!";
                            }
                        
                            // Check if login attempts reach 5 and block the account
                            if ($_SESSION['login_attempts'] >= 5) {
                                // Update the user status to 'blocked' and set the blocked_at timestamp
                                $updateSql = "UPDATE user_accounts SET status = 'blocked', blocked_at = NOW() WHERE id = ?";
                                if ($updateStmt = $conn->prepare($updateSql)) {
                                    $updateStmt->bind_param("i", $id);
                                    $updateStmt->execute();
                                    $updateStmt->close();
                                }
                        
                                $account_lockout_err = "Your account has been temporarily locked due to too many failed login attempts. Please try again later.";
                            }
                        }
                    }
                } else {
                    $email_valid_err = "Invalid email or password!";
                    $_SESSION['login_attempts']++;

                    // Check if login attempts reach 5 and block the account
                    if ($_SESSION['login_attempts'] >= 5) {
                        $updateSql = "UPDATE user_accounts SET status = 'blocked', blocked_at = NOW() WHERE email = ?";
                        if ($updateStmt = $conn->prepare($updateSql)) {
                            $updateStmt->bind_param("s", $email);
                            $updateStmt->execute();
                            $updateStmt->close();
                        }
                    }
                }
                $stmt->close();
            } else {
                $email_valid_err = "Database query failed.";
            }
        }
    }
}
?>



$mail->Subject = 'Password Reset';

       // Set email format to HTML
       $mail->isHTML(true);
   
       // Email body content
       $token = 'your_generated_token'; // Replace this with your actual token
       $resetLink = "http://localhost/reset/reset-password.php?token=" . urlencode($token);
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
               <p>We received a request to reset your password. Click the button below to reset it:</p>
               <a class="button" href="http://localhost/reset/reset-password.php?token=$token">Reset Your Password</a>
               <p>If you did not request a password reset, please ignore this email.</p>
               <p>Thank you!</p>
           </div>
       </body>
       </html>
   END;