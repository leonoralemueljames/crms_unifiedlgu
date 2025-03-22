<?php
session_start();

// Include the database connection
include('connection.php'); // Make sure the path is correct

// Initialize variables
$verificationCodeErr = "";
$email = "";

// Check if the user is logged in and has a verification code in the session
if (!isset($_SESSION['verification_email']) || !isset($_SESSION['verification_code'])) {
    header("Location: ../index.php"); // Redirect to your login form if not set
    exit();
}
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submittedCode = trim($_POST['verification_code']);
    
    // Check if the submitted code matches the stored code
    if ($submittedCode === $_SESSION['verification_code']) {
        // Verification successful
        // Update the user's status in the database
        $email = $_SESSION['verification_email'];
        $sql = "UPDATE user_accounts SET status = 'active', verification_code = NULL WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            // Clear the session variables
            unset($_SESSION['verification_email']);
            unset($_SESSION['verification_code']);
            // Redirect to a success page or dashboard
            header("Location: ./my/dashboard.php");
            exit();
        } else {
            $verificationCodeErr = "Error updating the account status.";
        }
    } else {
        $verificationCodeErr = "Invalid verification code. Please try again.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="../assets/images/unified-lgu-logo.png">
    <title>Account Verification - CRMS</title>
    <!-- Include your CSS files here -->
    <link rel="stylesheet" href="../css/sign-up/sign-up.css">
</head>
<body>
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" method="POST" action="">
                <div class="mx-auto text-center my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="?">
                        <img src="../assets/images/unified-lgu-logo.png" width="70">
                    </a>
                    <h2 class="my-3">Verify your account</h2>
                </div>
                <p class="text-muted">Please enter the verification code sent to your registered email address to confirm your identity and complete the account verification process.</p>
                
                <div class="form-group">
                    <label for="verification_code" class="sr-only">Verification Code</label>
                    <input type="text" id="verification_code" class="form-control form-control-lg" name="verification_code" placeholder="Enter your code" required autofocus>
                    <span style="color:red;"><?php echo $verificationCodeErr; ?></span>
                </div>
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Verify</button>
                <p class="mt-5 mb-3 text-muted">© 2020</p>
            </form>
        </div>
    </div>
    <!-- Include your JavaScript files here -->
</body>
</html>