<?php
include ('controller/sign-up_controller.php')
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/unified-lgu-logo.png">
    <title>Sign Up - CRMS</title>
    <link rel="stylesheet" href="css/simplebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/sign-up/sign-up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

</head>
<body class="dark">
    <div class="wrapper vh-100">
        <div class="row align-items-center h-100">
            <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars(str_replace('.php', '', $_SERVER["PHP_SELF"])); ?>" 
            class="col-lg-6 col-md-8 col-10 mx-auto">
                <div class="mx-auto  my-4">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center">
                        <img src="assets/images/unified-lgu-logo.png" width="80">
                    </a>
                   
                </div>

              <!-- Section 1: User Information -->
<div id="section-1" class="section">
    <h3>Section 1: User Information</h3>
    <p style="font-weight: bold;">Registration</p>
    <br>


    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="firstname"><strong>First Name</label></strong>
            <input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
            <span style="color:red;"><?php echo $firstnameerr; ?></span>
        </div>
        <div class="form-group col-md-6">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
            <span style="color:red;"><?php echo $lastnameerr; ?></span>
        </div>
    </div>

    <div class="form-group">
        <label for="inputEmail">Email Address</label>
        <input class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span style="color:red;"><?php echo $emailerr; ?></span>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="job_title"><strong>Job Title</strong></label>
            <input type="text" class="form-control" name="job_title" value="<?php echo htmlspecialchars($job_title); ?>">
            <span style="color:red;"><?php echo $job_titleerr; ?></span>
        </div>
        <div class="form-group col-md-6">
            <label for="department"><strong>Barangay Department</strong></label>
            <input type="text" class="form-control" name="department" value="<?php echo htmlspecialchars($department); ?>">
            <span style="color:red;"><?php echo $departmenterr; ?></span>
        </div>
    </div>

    <hr class="my-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputPassword5"><strong>Create Password</strong></label>
                <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars($password); ?>">
                <span style="color:red;"><?php echo $passworderr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputPassword6"><strong>Confirm Password</strong></label>
                <input type="password" class="form-control" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>">
                <span style="color:red;"><?php echo $confirm_passworderr; ?></span>
            </div>
        </div>
        <div class="col-md-6">
            <p class="mb-2">Password requirements</p>
            <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
            <ul class="small text-muted pl-4 mb-0">
                <li> Minimum 8 characters </li>
                <li> At least one special character</li>
                <li> At least one number</li>
                <li> Can't be the same as a previous password </li>
            </ul>
        </div>
    </div>

    <br>

    <button class="btn btn-lg btn-primary btn-block" onclick="nextSection()">Next</button>
    <p style="margin-top:12px; font-size: 15.5px;" class="text-center">You already have an account?<a class="#sign-up" href="sign-in"><strong>  Sign In</strong></a></p>
    

    <p style="padding: 20px;" class="mt-5 mb-3 text-muted text-center"> 2024 - Compliance & Regulatory Management System</p>
</div>


<!-- Section 2: Employee Information -->
<div id="section-2" class="section d-none">
    <h3>Section 2: Employee Information</h3>
    <p style="font-weight: bold;">Registration</p>
    <br>
    <div class="form-group">
        <label for="inputEmployeeID"><Strong>Employee ID *</strong> </label>
        <p style="color: #333; font-size:13px;"><em>(Please enter your unique employee ID number.)</em></p>
        <input class="form-control" name="employee_id" value="<?php echo htmlspecialchars($employee_id); ?>">
        <span style="color:red;"><?php echo $employee_iderr; ?></span>
    </div>

    <div class="form-group">
        <label for="inputDateOfHire"><strong>Date of Hire *</strong></label>
        <p style="color: #333; font-size:13px;"><em>(Enter the date you were hired in a date format)</em></p>
        <input type="date" class="form-control" name="date_of_hire" value="<?php echo htmlspecialchars($date_of_hire); ?>">
        <span style="color:red;"><?php echo $date_of_hireerr; ?></span>
    </div>
    <div class="form-group">
        <label for="inputJobFunction"><strong>Job Function *</strong></label>
        <p style="color: #333; font-size:13px;"><em>(Enter a brief description of your job function.)</em></p>
        <input class="form-control" name="job_function" value="<?php echo htmlspecialchars($job_function); ?>">
        <span style="color:red;"><?php echo $job_functionerr; ?></span>
</div>

    <div class="form-group">
        <label for="inputSupervisorName"><strong>Supervisor's Name *</strong></label>
        <p style="color: #333; font-size:13px;"><em>(Enter the name of your supervisor.)</em></p>
        <input class="form-control" name="supervisor_name" value="<?php echo htmlspecialchars($supervisor_name); ?>">
        <span style="color:red;"><?php echo $supervisor_nameerr; ?></span>
    </div>
    <div class="form-group">
        <label for="inputSupervisorEmail"><strong>Supervisor's Email</strong></label>
        <p style="color: #333; font-size:13px;"><em>(Enter the email address of your supervisor.)</em></p>
        <input class="form-control" name="supervisor_email" value="<?php echo htmlspecialchars($supervisor_email); ?>">
        <span style="color:red;"><?php echo $supervisor_emailerr; ?></span>
    </div>
    <br>
    <button class="btn btn-lg btn-primary btn-block" onclick="nextSection()">Next</button>
    <button class="btn btn-lg btn-secondary btn-block" onclick="prevSection()">Back</button>
    <p style="margin-top:12px; font-size: 15.5px;" class="text-center">You already have an account?<a class="#sign-up" href="sign-in"><strong>  Sign In</strong></a></p>


    <p style="padding: 20px;" class="mt-5 mb-3 text-muted text-center"> 2024 - Compliance & Regulatory Management System</p>
</div>

<!-- Section 3: Additional Information -->
<div id="section-3" class="section d-none">
    <h3>Section 3: Additional Information</h3>
    <p style="font-weight: bold;">Registration</p>
    <br>
    <div class="form-group">
        <label for="inputPhoneNumber"><strong>Phone Number</strong></label>
        <p style="color: #333; font-size:13px;"><em>(Please enter your phone number, including area code.)</em></p>
        <input class="form-control" name="phone_number" value="<?php echo htmlspecialchars($phone_number); ?>">
        <span style="color:red;"><?php echo $phone_numbererr; ?></span>
    </div>
    <div class="form-group">
        <label for="inputLocation"><strong>City</strong></label>
        <p style="color: #333; font-size:13px;"><em>(Please enter the city where you are currently located. (e.g. Manila, Cebu, Davao))</em></p>
        <input class="form-control" name="location" value="<?php echo htmlspecialchars($location); ?>">
        <span style="color:red;"><?php echo $locationerr; ?></span>
    </div>
    <div class="form-group">
        <label for="inputAddress"><strong>Address</strong></label>
        <p style="color: #333; font-size:13px;"><em>( Enter your current mailing address, including street name and number, barangay, and city. (e.g. 456 EDSA, Brgy. Poblacion, Pasig City))</em></p>
        <input class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>">
        <span style="color:red;"><?php echo $addresserr; ?></span>
    </div>
    <br>
    <button class="btn btn-lg btn-primary btn-block" onclick="nextSection()">Next</button>
    <button class="btn btn-lg btn-secondary btn-block" onclick="prevSection()">Back</button>
    <p style="margin-top:12px; font-size: 15.5px;" class="text-center">You already have an account?<a class="#sign-up" href="sign-in"><strong>  Sign In</strong></a></p>
    <p style="padding: 20px;" class="mt-5 mb-3 text-muted text-center"> 2024 - Compliance & Regulatory Management System</p>
</div>

<!-- Section 4: Terms and Conditions -->
<div id="section-4" class="section d-none">
    <h3>Section 4: Terms and Conditions</h3>
    <div class="form-group">
        <br>
        
                <h4>Welcome to Unified LGU - Compliance and Regulatory Management System (CRMS)</h4>
                <p>By registering for an account on the CRMS, you agree to the following terms and conditions:</p>
                <div class="terms-content">
                    <div class="term">
                        <h5>1. Purpose</h5>
                        <p>The CRMS is designed to facilitate compliance with regulatory requirements and to provide a platform for users to manage their compliance obligations.</p>
                    </div>
                    <div class="term">
                        <h5>2. Eligibility</h5>
                        <p>The CRMS is only available to authorized personnel of Unified LGU. By registering for an account, you represent and warrant that you are an authorized personnel of Unified LGU and that you have the authority to bind Unified LGU to these terms and conditions.</p>
                    </div>
                    <div class="term">
                        <h5>3. Account Security</h5>
                        <p>You are responsible for maintaining the confidentiality of your account login credentials and for ensuring that your account is used only for authorized purposes. You must notify Unified LGU immediately if you suspect any unauthorized use of your account.</p>
                    </div>
                    <div class="term">
                        <h5>4. Compliance Obligations</h5>
                        <p>You agree to comply with all applicable laws, regulations, and regulatory requirements in connection with your use of the CRMS.</p>
                    </div>
                    <div class="term">
                        <h5>5. Data Protection</h5>
                        <p>Unified LGU will take reasonable steps to protect the confidentiality, integrity, and availability of your data. However, Unified LGU cannot guarantee the security of your data and you agree to hold Unified LGU harmless for any losses or damages resulting from any security breaches.</p>

                        </div>
                    <div class="term">
                        <h5>6. Intellectual Property</h5>
                        <p>The CRMS and all content, software, and materials provided through the CRMS are the property of Unified LGU or its licensors. You agree not to reproduce, modify, or distribute any content, software, or materials provided through the CRMS without the prior written consent of Unified LGU.</p>
                    </div>
                    <div class="term">
                        <h5>7. Warranty Disclaimer</h5>
                        <p>The CRMS is provided on an "as is" and "as available" basis. Unified LGU disclaims all warranties, express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, and non-infringement.</p>
                    </div>
                    <div class="term">
                        <h5>8. Limitation of Liability</h5>
                        <p>In no event will Unified LGU be liable for any direct, indirect, incidental, special, or consequential damages arising out of or related to your use of the CRMS.</p>
                    </div>
                    <div class="term">
                        <h5>9. Governing Law</h5>
                        <p>These terms and conditions will be governed by and construed in accordance with the laws of [Jurisdiction]. Any disputes arising out of or related to these terms and conditions will be resolved through binding arbitration in accordance with the rules of the [Arbitration Association].</p>
                    </div>
                    <div class="term">
                        <h5>10. Changes to Terms and Conditions</h5>
                        <p>Unified LGU reserves the right to modify or update these terms and conditions at any time without notice. Your continued use of the CRMS will be deemed acceptance of any changes to these terms and conditions.</p>
                    </div>
                </div>
                <br>
                <p>By registering for an account on the CRMS, you acknowledge that you have read, understand, and agree to be bound by these terms and conditions.</p>
            
        
        <div class="checkbox-container">
            <input type="checkbox" name="terms" required>
            <label for="terms">I agree with the terms and conditions</label>
        </div>
       <!-- <span style="color:red;"><?php echo $termserr; ?></span>-->
    </div>

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <button class="btn btn-lg btn-primary btn-block" name="success-button" type="submit" >Sign Up</button>
    <button class="btn btn-lg btn-secondary btn-block" onclick="prevSection()">Back</button>
    <p style="padding: 20px;" class="mt-5 mb-3 text-muted text-center"> 2024 - Compliance & Regulatory Management System</p>
</div>
        </div>
    </div>

    <script>
    let currentSection = 1;

    function nextSection() {
        let section = document.getElementById('section-' + currentSection);
        section.classList.add('d-none');
        currentSection++;
        section = document.getElementById('section-' + currentSection);
        section.classList.remove('d-none');

        // Scroll to the top of the page
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function prevSection() {
        let section = document.getElementById('section-' + currentSection);
        section.classList.add('d-none');
        currentSection--;
        section = document.getElementById('section-' + currentSection);
        section.classList.remove('d-none');

        // Scroll to the top of the page
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

  
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
      
    </script>



  
   

  </body>
</html>
</body>
</html>