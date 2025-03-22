<?php
include('../connection.php');
session_start(); 

// Initialize error and success message variables
$errorMessage = '';
$notFound = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the form and trim whitespace
    $email = trim($_POST['email']);

    // Validate the email
    if (empty($email)) {
        $errorMessage = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Please enter a valid email address.';
    } else {
        // Prepare a statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM user_accounts WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the email exists
        if ($result->num_rows > 0) {
            // Generate a random token
            $token = bin2hex(random_bytes(16)); 

            // Store the token and email in the session to pass it to the next step
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;

            // Redirect to send-password-reset.php
            header("Location: ../mail/send-password-reset.php");
            exit();
        } else {
            // Email does not exist
            $notFound = "No account found with that email address.";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="../assets/images/unified-lgu-logo.png">
    <title>Forgot Password - CRMS</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="../css/simplebar.css">
    <!-- Fonts CSS -->
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

       

          <div class="mx-auto text-center my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="?">
            <img src="../assets/images/unified-lgu-logo.png" width="70">
              </svg>
            </a>
            <h2 class="my-3">Forgot Password</h2>
          </div>
          <p class="text-muted">Enter your email address and we'll send you an email with instructions to reset your password</p>

            <?php if (!empty($errorMessage)) { ?>
      <div class="alert alert-danger text-center">
          <span style="top: 30px;" class="fa-regular fa-circle-xmark fe-16 "></span>
          <?php echo $errorMessage; ?>
      </div>
  <?php } ?>

  <?php if (!empty($notFound)) { ?>
      <div class="alert alert-warning text-center">
          <span style="top: 30px;" class="fa-regular fa-question fe-16 "></span>
          <?php echo $notFound; ?>
      </div>
  <?php } ?>

          <div class="form-group">
            <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Email address">
          </div>
          <button class="btn btn-lg btn-primary btn-block" data-loading-text="<i class='fa-solid fa-spinner fa-spin'></i>">Send Email</button>
          <h5 class="mt-4 mb-3 text-muted"><a href="../sign-in">Back to Sign-in</a></h5>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js'></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js'></script>

  <script>
      $('.btn').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 8000);
});
  </script>

  </body>
</html>
</body>
</html>