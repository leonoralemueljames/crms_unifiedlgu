<?php 
include('controller/sign-in_controller.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/images/unified-lgu-logo.png">
  <title>Sign In - CRMS</title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="css/simplebar.css">
  <!-- Fonts CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
    
  <!-- Icons CSS -->
  <link rel="stylesheet" href="css/feather.css">

  <link rel="stylesheet" href="css/log-in/app-light.css">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
  #eye-icon {
    position: absolute;
    color: #000;
    right: 20px; /* Adjust as necessary */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    display: none;
    z-index: 100;
 
}
  </style>

</head>
<body>
  <div class="wrapper vh-100">

    <div class="row align-items-center h-100">

      <div class="col-lg-6 d-none d-lg-flex">
      </div>
      <!-- ./col -->
      <div class="col-lg-6">

        <div class="w-50 mx-auto">

          <form method="POST" action="<?php echo htmlspecialchars(str_replace('.php', '', $_SERVER["PHP_SELF"])); ?>"
            class="mx-auto-wide">



            <a class="navbar-brand">

               <div class="crms-logo">
                <img class="c-vector" src="assets/images/unified-lgu-logo.png" width="100">
               

                <h3 class="sign-in-title" style="font-size:30px">Sign In</h3>

            </a>
          
            <div class="small-title">Compliance & Regulatory Management System (CRMS)

            </div>
            </div>

            
            <?php if (!empty($account_lockout_err)) { ?>
    <div style="font-size: 11.5px" class="alert alert-info text-center">
        <span class="fe fe-lock fe-14 "></span>
        <?php echo $account_lockout_err; ?>
    </div>
<?php } ?>

            
<?php if (!empty($email_valid_err) || !empty($password_valid_err)) { ?>
    <div class="alert alert-danger text-center">
    <span class="fe fe-x-circle fe-16 mr-2"></span> 
        <?php if (!empty($email_valid_err)) { ?>
            <span><?php echo $email_valid_err; ?></span>
        <?php } ?>
        <?php if (!empty($password_valid_err)) { ?>
            <span><?php echo $password_valid_err; ?></span>
        <?php } ?>
    </div>
<?php } ?>




<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
           
<div class="form-group">
    <span class="form-label">Email</span>
    <i class="fe fe-email"></i>
    <input type="text" id="email" class="form-control form-control-lg" name="email"
           value="<?php echo htmlspecialchars($email); ?>" oninput="clearEmailError()">
          
    <span id="email-error" style="padding-top: 2px; font-size: 12px; color:red; float: left;">
      <?php echo $emailerr; ?></span>
</div>

<script>
function clearEmailError() {
    const errorElement = document.getElementById('email-error');
    const emailInput = document.getElementById('email');

    if (emailInput.value.trim() === '') {
        errorElement.innerText = '<?php echo $emailerr; ?>';
    } else {
        errorElement.innerText = '';
    }
}
</script>


<div class="form-group">
    <span class="form-label">Password</span>
    
    <div class="input-group">
        <input type="password" id="password" class="form-control form-control-lg" name="password"
               value="<?php echo (!empty($password_valid_err) || !empty($account_lockout_err)) ? '' : htmlspecialchars($password); ?>"
               oninput="passwordError(); toggleEyeIcon();" 
               onfocus="toggleEyeIcon();"> <!-- Add onfocus event -->
 
        <span id="eye-icon" onclick="togglePasswordVisibility()">
            <i style="fa-eye{color:blue;" class="fa-solid fa-eye fe-16"></i>
        </span>
    </div>
    
    <span id="password-error" style="padding-top: 2px; font-size: 12px; color:red; float: left;"><?php echo $passworderr; ?></span>
</div>


<script>
    function passwordError() {
      const errorElement = document.getElementById('password-error');
    const emailInput = document.getElementById('password');

    if (emailInput.value.trim() === '') {
        errorElement.innerText = '<?php echo $passworderr; ?>';
    } else {
        errorElement.innerText = '';
    }
}


function toggleEyeIcon() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        // Show the eye icon if the input is not empty
        if (passwordInput.value.length > 0) {
            eyeIcon.style.display = 'block';
        } else {
            eyeIcon.style.display = 'none';
        }
    }

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        const eyeIconI = eyeIcon.querySelector('i');
        
        // Toggle the type of the input field
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIconI.classList.add('fa-eye-slash'); 
            eyeIconI.classList.remove('fa-eye'); 
        } else {
            passwordInput.type = 'password';
            eyeIconI.classList.add('fa-eye'); 
            eyeIconI.classList.remove('fa-eye-slash'); 
        }
    }
    
</script>

            <div class="mb-3">
              <label>
                <a href="reset/forgot-password" class="forgot-text text-center">Forgot Password?</a>
              </label>
            </div>
             
            <input type="hidden" name="token" value='<?php echo htmlspecialchars($_SESSION['token']); ?>'>
            <button class="btn btn-lg btn-primary btn-block" 
            data-loading-text="<i class='fa-solid fa-circle-notch fa-spin'></i>">Sign In</button>
            


            <div class="register-section">
              <h5>You don't have an account? <a class="#sign-up" href="sign-up"><strong>Sign
                    Up</strong></a></h5>
            </div>
          </form>

        </div>

        <!-- .card -->
      </div> <!-- ./col -->
      <div class="title">
        <div class="text-box">
        <div class="text-content">
        <h1>Compliance & Regulatory Management System (CRMS)</h1>
        <!--<img src="assets/images/rule-icon-vector.png" width="300">-->
        <h5 class="text-sign-up">* You don't have an account? <a class="text-sign-up-link" href="sign-up"><strong> Sign Up</strong></a>
        </h5>
            </div>
           </div>

      </div>
    </div> <!-- .row -->
  </div>


  <script>
    $(document).ready(function() {
        // Check if the timeout parameter is present in the URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('timeout')) {
            $('#sessionTimeoutModal').modal('show'); // Show the modal if timeout occurred
        }
    });
    </script>

<!-- Modal for session timeout -->
<div class="modal fade" id="sessionTimeoutModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Session Expired</h4>
            </div>
            <div class="modal-body">
                <p>Your session has expired due to inactivity. Please sign in again.</p>
                <a href="/sign-in" class="btn btn-primary">Go to Sign In</a>
            </div>
        </div>
    </div>
</div>


  
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/simplebar.min.js"></script>
  <script src='js/daterangepicker.js'></script>
  <script src='js/jquery.stickOnScroll.js'></script>
  <script src="js/tinycolor-min.js"></script>
   
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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

