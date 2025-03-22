<?php

include('connection.php');
include('session/security_config.php');  

session_start(); 

// Set a limit for login attempts
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOCKOUT_TIME', 15 * 60); // Lockout time in seconds

// Check if the user is already logged in
if (isset($_SESSION['email'])) {
    header("Location: ./my/dashboard.php");
    exit();
}

// Set error reporting to display all errors (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$email = $password = $status = "";
$emailerr = $passworderr = $statuserr = "";
$password_valid_err = "";

// Check for login attempts
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// Generate CSRF token if not set
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(16));
}

// Check if the user is locked out
if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
    if (time() - $_SESSION['last_attempt_time'] < LOCKOUT_TIME) {
        $account_lockout_err = "Too many login attempts. Please try again later.";
    } else {
        // Reset the attempts after lockout time
        $_SESSION['login_attempts'] = 0;
    }
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        die("CSRF token validation failed.");
    }

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
        $password = $_POST["password"];
    }

    // Check if there are any errors
    if (empty($emailerr) && empty($passworderr)) {
        // Prepare the SQL query
        $sql = "SELECT id, password, firstname, lastname, status FROM user_accounts WHERE email = ?";

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
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
                    $statuserr = "Your account has been blocked!";
                } else {
                    // Verify the password
                    if (password_verify($password, $hashedPassword)) {
                        // Set the session variables
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = htmlspecialchars($firstname . ' ' . $lastname); // XSS protection
                        
                        // Regenerate session ID to prevent session fixation
                        session_regenerate_id(true);

                        // Redirect to the dashboard
                        header("Location: ./my/dashboard.php");
                        exit();
                    } else {
                        $_SESSION['login_attempts']++;
                        $_SESSION['last_attempt_time'] = time();
                        $password_valid_err = "Incorrect username or password!";
                    }
                }
            } else {
                $emailerr = "Email not registered!";
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();
            }

            // Close the statement
            $stmt->close();
        } else {
            // If the statement could not be prepared
            $emailerr = "Database error: Unable to prepare statement.";
        }
    }
}
?>