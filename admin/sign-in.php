<?php

if (isset($_SESSION['admin_logged_in'])) {
  // Redirect to the protected area
  header('Location: admin/sign-in.php');
  exit;
}

// Include the connection file
include ('../connection.php');

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
header("Location: ../../admin/main/dashboard.php");
exit();
}

// Set error reporting to display all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Initialize variables
$username = $password = $status= "";
$usernameerr = $passworderr = $statuserr = $username_valid_err = $password_valid_err = "";

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Validate the username
  if (empty($_POST["username"])) {
      $usernameerr = "Username is required!";
  } else {
      $username = $_POST["username"];
  }

  // Validate the password
  if (empty($_POST["password"])) {
      $passworderr = "Password is required!";
  } else {
      $password = $_POST["password"];
  }

  // Check if there are any errors
  if (empty($usernameerr) && empty($passworderr)) {
      // Prepare the SQL query
      $sql = "SELECT id, password, username, status FROM admin_accounts WHERE username = ?";

      // Prepare the statement
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $stmt->store_result();

      // Check if a user was found
      if ($stmt->num_rows > 0) {
          // Bind the result
          $stmt->bind_result($id, $hashedPassword, $username, $status);
          $stmt->fetch();

          // Check if the user is blocked
          if ($status == 'blocked') {
              $statuserr = "Your admin account has been blocked!";
          } else {
              // Verify the password
              if (password_verify($password, $hashedPassword)) {
                  // Set the session variables
                  $_SESSION['username'] = $username;
                  $_SESSION['id'] = $id;

                  // Generate a token
                  $_SESSION['token'] = bin2hex(random_bytes(16));

                  // Redirect to the dashboard
                  header("Location: ../../admin/main/dashboard.php");
                  exit();
              } else {
                  $password_valid_err = "Invalid username or password!";
              }
          }
      } else {
          $username_valid_err = "Invalid username or password!";
      }

      // Close the statement
      $stmt->close();
  }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../assets/images/unified-lgu-logo.png">
    <title>Admin Portal - Sign In (CRMS)</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="../../css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../../css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="../../css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="../../ui/main.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>


    <style>
    .error-box-admin {
    background-color: #fcedcd;
    color: #7c5502;
    border: 1px solid #fae5b8;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.error-box-admin span {
    color: #a94442;
}
    </style>

   
  </head>
  <body style="
  background-image: url(../../assets/images/lgu-bg-2.jpg);
   background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-color: rgba(0, 0, 0, 0.4); /* black with 50% opacity */
    background-blend-mode: multiply;
  ">
    <div class="wrapper vh-100">
      <div class="align-items-center h-100" style="display: flex;
    flex-wrap: wrap;">
 
        <form method="POST"  action="<?php echo htmlspecialchars(str_replace('.php', '', $_SERVER["PHP_SELF"])); ?>" class="col-lg-3 col-md-4 col-10 mx-auto text-center" style="background-color: #f0f0f0; border-radius: 10px; margin:10px;">
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" >
            
              <g>
                <img src="../../assets/images/unified-lgu-logo.png" width="100">
                <h1 class="h6 mb-3" style="font-size: 20px;"><br>CRMS Portal</h1>
              </g>
            </svg>
            
          </a>

          <?php if (!empty($username_valid_err) || !empty($password_valid_err)) { ?>
    <div class="error-box-admin">
        <?php if (!empty($username_valid_err)) { ?>
            <span><?php echo $username_valid_err; ?></span>
        <?php } ?>
        <?php if (!empty($password_valid_err)) { ?>
            <span><?php echo $password_valid_err; ?></span>
        <?php } ?>
    </div>
<?php } ?>

        
          <!--<h1 class="h6 mb-3"><br>Please Sign in</h1>-->
     

          <div class="form-group">
    <label class="sr-only">Username</label>
    <input type="text" id="inputUsername" name="username" class="form-control form-control-lg" placeholder="Username" 
    value="<?php echo (!empty($password_valid_err)) ? '' : htmlspecialchars($username); ?>">
    <span style="color:red; float: left; font-size: 12px;"><?php echo $usernameerr; ?></span>
</div>

<div class="form-group">
    <label for="inputPassword" class="sr-only">Password</label>
    <div class="input-group"> 
        <input type="password" id="inputPassword" class="form-control form-control-lg"  placeholder="Password"  name="password"
        value="<?php echo (!empty($password_valid_err)) ? '' : htmlspecialchars($password); ?>">
        <div class="input-group-append" style="cursor: pointer;">
            <span class="input-group-text" onclick="passwordToggle()" >
                <i id="password-icon" class="fe fe-eye"></i>
            </span>
        </div>
    </div>
    <span style="color:red; float: left; font-size: 12px;"><?php echo $passworderr; ?></span>
</div>
          <div class="checkbox mb-3">
            <label>
              <!-- <p>You don't have an  account? <a href="../../admin/sign-up/register.php">Register</a></p> -->
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" 
          data-loading-text="<i class='fa-solid fa-circle-notch fa-spin'></i>">Log In</button>
          <p class="mt-5 mb-3">© 2024 Copyright - Compliance & Regulatory Management System (CRMS)</p>
        </form>
      </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/moment.min.js"></script>
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
     function passwordToggle() {
    // Get the password input and the eye icon
    var passwordInput = document.getElementById('inputPassword');
    var passwordIcon = document.getElementById('password-icon');

    // Check the current type of the password input
    if (passwordInput.type === 'password') {
        // Change the type to text to show the password
        passwordInput.type = 'text';
        // Change the eye icon to a closed eye
        passwordIcon.classList.remove('fe-eye');
        passwordIcon.classList.add('fe-eye-off');
    } else {
        // Change the type back to password to hide the password
        passwordInput.type = 'password';
        // Change the eye icon back to an open eye
        passwordIcon.classList.remove('fe-eye-off');
        passwordIcon.classList.add('fe-eye');
    }
}
      </script>

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

