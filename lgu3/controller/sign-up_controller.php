<?php
include ('connection.php');

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => 'crms.unifiedlgu.com', // Set your domain here
    'secure' => true, // Ensure the cookie is sent over HTTPS
    'httponly' => true, // Prevent JavaScript access to session cookies
    'samesite' => 'Strict' // Helps prevent CSRF
]);

session_start(); // Start the session


if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Create a secure random token
}

// Check for error message
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    unset($_SESSION['error_message']); // Clear the message after displaying
}


// Initialize variables and error messages
$firstname = $lastname = $email = $phone_number = $address = $password = $confirm_password = 
$job_title = $department = $employee_id = $date_of_hire = $job_function = $supervisor_name = 
$supervisor_email = $location = "";

$firstnameerr = $lastnameerr = $emailerr = $phone_numbererr = $addresserr = $passworderr =
 $confirm_passworderr = $job_titleerr = $departmenterr = $employee_iderr = $date_of_hireerr = 
 $job_functionerr = $supervisor_nameerr = $supervisor_emailerr = $locationerr = "";

// Function to send notifications
function sendAdminNotification($firstname, $lastname, $email) {
    include ('connection.php');
    $stmt = $conn->prepare("INSERT INTO notifications (firstname, lastname, email, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $message);
    $message = "New user registered: ($email) <br> Name: $firstname $lastname";
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    // Validate form fields
    if (empty($_POST["firstname"])) {
        $firstnameerr = "First name is required!";
    } else {
        $firstname = htmlspecialchars(trim($_POST["firstname"])); // Sanitize input
    }

    if (empty($_POST["lastname"])) {
        $lastnameerr = "Last name is required!";
    } else {
        $lastname = htmlspecialchars(trim($_POST["lastname"])); // Sanitize input
    }

    if (empty($_POST["email"])) {
        $emailerr = "Email is required!";
    } else {
        $email = htmlspecialchars(trim($_POST["email"])); // Sanitize input
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Invalid email format!";
        }
    }

    if (empty($_POST["phone_number"])) {
        $phone_numbererr = "Phone number is required!";
    } else {
        $phone_number = htmlspecialchars(trim($_POST["phone_number"])); // Sanitize input
    }

    if (empty($_POST["address"])) {
        $addresserr = "Address is required!";
    } else {
        $address = htmlspecialchars(trim($_POST["address"])); // Sanitize input
    }

    if (empty($_POST["job_title"])) {
        $job_titleerr = "Job title is required!";
    } else {
        $job_title = htmlspecialchars(trim($_POST["job_title"])); // Sanitize input
    }

    if (empty($_POST["department"])) {
        $departmenterr = "Department is required!";
    } else {
        $department = htmlspecialchars(trim($_POST["department"])); // Sanitize input
    }
    
    if (empty($_POST["employee_id"])) {
        $employee_iderr = "Employee ID is required!";
    } else {
        $employee_id = htmlspecialchars(trim($_POST["employee_id"])); // Sanitize input
    }

    if (empty($_POST["date_of_hire"])) {
        $date_of_hireerr = "Date of hire is required!";
    } else {
        $date_of_hire = htmlspecialchars(trim($_POST["date_of_hire"])); // Sanitize input
    }

    if (empty($_POST["job_function"])) {
        $job_functionerr = "Job function is required!";
    } else {
        $job_function = htmlspecialchars(trim($_POST["job_function"])); // Sanitize input
    }

    if (empty($_POST["supervisor_name"])) {
        $supervisor_nameerr = "Supervisor's name is required!";
    } else {
        $supervisor_name = htmlspecialchars(trim($_POST["supervisor_name"])); // Sanitize input
    }

    if (empty($_POST["supervisor_email"])) {
        $supervisor_emailerr = "Supervisor's email is required!";
    } else {
        $supervisor_email = htmlspecialchars(trim($_POST["supervisor_email"])); // Sanitize input
    }

    if (empty($_POST["location"])) {
        $locationerr = "Location is required!";
    } else {
        $location = htmlspecialchars(trim($_POST["location"])); // Sanitize input
    }

    if (empty($_POST["terms"])) {
        $termserr = "Please check if you agree.";
    } else {
        $terms = $_POST["terms"];
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passworderr = "Password is required!";
    } else {
        $password = $_POST["password"];

        // Check password requirements
        if (strlen($password) < 8) {
            $passworderr = "Password must be at least 8 characters.";
        } elseif (!preg_match('/[A-Za-z]/', $password) || 
                  !preg_match('/[0-9]/', $password) || 
                  !preg_match('/[\W_]/', $password)) {
            $passworderr = "Password must contain at least one letter, one number, and one special character.";
        }
    }

    // Validate confirm password
    if (empty($_POST["confirm_password"])) {
        $confirm_passworderr = "Confirm password is required!";
    } else {
        $confirm_password = $_POST["confirm_password"];
        if ($password !== $confirm_password) {
            $confirm_passworderr = "Passwords do not match!";
        }
    }

    // Check if the email already exists
    if (empty($emailerr) && empty($firstnameerr) && empty($lastnameerr) && empty($passworderr) && empty($confirm_passworderr)) {
        $checkEmailSql = "SELECT email FROM user_accounts WHERE email = ?";
        $checkStmt = $conn->prepare($checkEmailSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $emailerr = "Email is already registered!";
        }
        $checkStmt->close();
    }

    // If there are no validation errors, proceed to insert the user into the database
    if (empty($firstnameerr) && empty($lastnameerr) && empty($emailerr) && empty($phone_numbererr) && empty($addresserr) && empty($passworderr) && empty($confirm_passworderr) && empty($job_titleerr) && empty($departmenterr) && empty($employee_iderr) && empty($date_of_hireerr) && empty($job_functionerr) && empty($supervisor_nameerr) && empty($supervisor_emailerr) && empty($locationerr)) {
        
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert the new user
        $sql = "INSERT INTO user_accounts (firstname, lastname, email, phone_number, address, job_title, department, employee_id, date_of_hire, job_function, supervisor_name, supervisor_email, location, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssss", $firstname, $lastname, $email, $phone_number, $address, $job_title, $department, $employee_id, $date_of_hire, $job_function, $supervisor_name, $supervisor_email, $location, $hashedPassword);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            // Trigger SweetAlert on successful registration
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
                  <script>
                  document.addEventListener("DOMContentLoaded", function() {
                      Swal.fire({
                          icon: "success",
                          title: "Account Registered!",
                          text: "You can now log in.",
                          showConfirmButton: true,
                          confirmButtonText: "OK",
                          allowOutsideClick: false,
                          allowEscapeKey: false,
                          willClose: () => {
                              document.querySelectorAll("#registrationForm input").forEach(input => input.value = "");
                              window.location.href = "sign-in.php"; 
                          }
                      });
                  });
                  </script>';

            // Send notification to admin
            sendAdminNotification($firstname, $lastname, $email);
        } else {
            // Log the error for debugging
            error_log("Database error: " . $stmt->error);
            // Show user-friendly error message
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Failed to register! Please try again.",
                        showConfirmButton: true
                    });
                });
            </script>';
        }
        $stmt->close(); 
    }
}

$conn->close(); 
?>
