<?php
include('../connection.php');

// Initialize error message variables
$errorMessage = "";
$expireMessage = "";
$successMessage = "";

// Get the token from the URL, or set it to null if not present
$token = $_GET["token"] ?? null;

if (!$token) {
    $expireMessage = "Token is required"; // Set error message
}

// Hash the token
$token_hash = hash("sha256", $token);

// Prepare SQL statement to select the user based on the reset token hash
$sql = "SELECT id, email, reset_token_expires_at FROM user_accounts WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    $expireMessage = "Database query failed: " . $conn->error; // Set error message
}

// Bind parameters and execute the statement
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Check if the user was found
if ($user === null) {
    $expireMessage = "The password reset link you provided is either 
    invalid or has already been used. Please request a new password reset link to proceed.."; // Set error message
}

// Check if the token has expired
if (isset($user) && strtotime($user["reset_token_expires_at"]) <= time()) {
    $expireMessage = "Token has expired"; // Set error message
}

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($expireMessage)) {
    // Validate the input
    if (strlen($_POST["password"]) < 8) {
        $errorMessage = "Password must be at least 8 characters"; // Set error message
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errorMessage = "Password must contain at least one letter"; // Set error message
    }

    if (!preg_match("/[0-9]/", $_POST["password"])) {
        $errorMessage = "Password must contain at least one number"; // Set error message
    }

    if ($_POST["password"] !== $_POST["password_confirmation"]) {
        $errorMessage = "Passwords must match"; // Set error message
    }

    // If there are no error messages, proceed with updating the password
    if (empty($errorMessage)) {
        // Hash the new password
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        // Update the user's password and reset the token
        $sql = "UPDATE user_accounts
                SET password = ?, 
                    reset_token_hash = NULL,
                    reset_token_expires_at = NULL
                WHERE id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $password_hash, $user["id"]);
        $stmt->execute();

        $successMessage = "Password updated successfully. You can now log in.";
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
    <title>Reset Password - ID: <?php echo htmlspecialchars($token); ?></title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="../css/simplebar.css">
    
    <!-- Fonts CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="../css/daterangepicker.css">
    <!-- App CSS --> 
     <link rel="stylesheet" href="../css/sign-up/sign-up.css">
  </head>
  <body>

    
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">

      <form method="post" action="" class="col-md-4 col-10 mx-auto text-center">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    
    <div>
        <div class="mx-auto text-center my-4">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="?">
        <?php if (!empty($successMessage)) { ?>
            <img src="../assets/images/password-change.png" width="70" alt="Success Logo">
        <?php } elseif (!empty($expireMessage)) { ?>
            <img src="../assets/images/expired.png" width="70" alt="Expired Token Logo">
        <?php } else { ?>
            <img src="../assets/images/unified-lgu-logo.png" width="70" alt="Unified LGU Logo">
        <?php } ?>
    </a>

            <?php if (!empty($expireMessage)) { ?>
                <h2 class="my-2 text-danger">Invalid or Expired Token</h2>
                <div class="alert alert-danger text-center">
                    <span style="top: 30px;" class="fa-solid fa-circle-exclamation fe-16 "></span>
                    <?php echo $expireMessage; ?>
                </div>
            <?php } elseif (!empty($successMessage)) { ?>
                <h2 class="my-2">Success!</h2>
                <div class="alert alert-success text-center">
                    <span style="top: 30px;" class="fa-solid fa-circle-check fe-16 "></span>
                    <?php echo $successMessage; ?>
                </div>
                <a href="../sign-in" class="btn btn-lg btn-primary btn-block" target="blank">Back to Sign in</a>
            <?php } else { ?>
                <h2 class="my-2">New Password</h2>
                <h5 class="my-1 h5-small">Account Email: <?php echo htmlspecialchars($user['email']); ?></h5>
                <div class="alert alert-info" role="alert">
                    Enter a new password and confirm it. Ensure it's unique and secure with letters, numbers, and special characters.
                </div>

                <?php if (!empty($errorMessage)) { ?>
                    <div class="alert alert-warning text-center">
                        <span style="top: 30px;" class="fa-solid fa-circle-exclamation fe-16 "></span>
                        <?php echo $errorMessage; ?>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="password" class="sr-only">New Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="New Password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="sr-only">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" required>
                </div>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
            <?php } ?>
        </div>
    </div>
</form>

      </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="..//js/moment.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/simplebar.min.js"></script>
    <script src='../js/daterangepicker.js'></script>
    <script src='../js/jquery.stickOnScroll.js'></script>
    <script src="../js/tinycolor-min.js"></script>
    <script src="../js/config.js"></script>
    <script src="../js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>
</body>
</html>