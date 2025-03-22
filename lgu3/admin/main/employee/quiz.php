<?php

include('../../../connection.php');
include('../../../session/security_config.php');

session_start();

// Check if the token is set and valid
if (!isset($_SESSION['token'])) {
  header('Location: ../../../admin/sign-in');
  exit;
}

// When the user logs out, destroy the session and redirect to the login page
if (isset($_GET['logout'])) {
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;url=../../../admin/sign-in'>";
  exit;
}


  //for notifications - so this is the code
  $stmt = $conn->prepare("SELECT * FROM notifications ORDER BY id DESC");
  $stmt->execute();
  $result = $stmt->get_result();
  $notifications = array();
  while ($row = $result->fetch_assoc()) {
    $notifications[] = $row;
  }
  $stmt->close();
  
  $notificationCount = count($notifications);


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../../../assets/images/unified-lgu-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Quiz List - CRMS PORTAL</title>

    <!-- Simple bar CSS (for scvrollbar)-->
    <link rel="stylesheet" href="../../../css/simplebar.css">

    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../../../css/feather.css">
    
    <!-- App CSS -->
    <link rel="stylesheet" href="../../../ui/main.css">   


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <style>
    .avatar-initials {
    width: 165px;
    height: 165px;
    border-radius: 50%;
    display: flex;
    margin-left: 8px;
    justify-content: center;
    align-items: center;
    font-size: 50px;
    font-weight: bold;
    color: #fff;
    background-color: #<?php echo substr(md5($_SESSION["firstname"] . $_SESSION["lastname"]), 0, 6); ?>;
    }

    .avatar-initials-min {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    margin-left: 8px;
    justify-content: center;
    align-items: center;
    font-size: 14px;
    font-weight: bold;
    color: #fff;
    background-color: #<?php echo substr(md5($_SESSION["firstname"] . $_SESSION["lastname"]), 0, 6); ?>;
  }

    .upload-icon {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  cursor: pointer;
  font-size: 24px;
  color: #fff;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
  background-color: #333;
  padding: 10px;
  border-radius: 50%;
  z-index: 1;
}

.avatar-img:hover .upload-icon {
  opacity: 1;
}

.avatar-img {
  position: relative;
  transition: background-color 0.3s ease-in-out;
}

.avatar-img:hover {
  background-color: rgba(0, 0, 0, 0.80);
}

</style>
  
  </head>

    <!--
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    -->
 

  <body class="vertical  light  ">
    <div class="wrapper">
      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control  bg-transparent border-0 pl-4 " type="search" placeholder="Type something....." aria-label="Search">
        </form>

        <ul class="nav">
    
          
          <li class="nav-item">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="fe fe-message-circle fe-16"></span>
            </section>
          </li>




          <li class="nav-item nav-notif">
  <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-notif">
    <span class="fe fe-bell fe-16"></span>
    <?php if ($notificationCount > 0) { ?>
      <span id="notification-count" style="
        position: absolute; 
        top: 5px; right: 1px; 
        font-size:13px; color: white;
        background-color: red;
        width:17px;
        height: 17px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50px;
      "><?php echo $notificationCount; ?></span>
    <?php } ?>
  </section>
</li>









          <li class="nav-item dropdown">
            <span class="nav-link text-muted pr-0 avatar-icon" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
  <div class="avatar-img rounded-circle avatar-initials-min text-center position-relative">
  
  <?php
$stmt = $conn->prepare("SELECT firstname, lastname FROM admin_accounts WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']); // Replace with the correct column name and value
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $_SESSION["firstname"] = $row['firstname'];
  $_SESSION["lastname"] = $row['lastname'];
  $name = $_SESSION["firstname"] . ' ' . $_SESSION["lastname"];
  
  
} else {
  echo "No name set";
}
?>
  </div>
</span>
</span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../../../admin/user/my-profile "> <i class="fe fe-user"></i>&nbsp;&nbsp;&nbsp;Profile</a>
              <a class="dropdown-item" href="../../../admin/user/settings "><i class="fe fe-settings"></i>&nbsp;&nbsp;&nbsp;Settings</a>
             
              <a class="dropdown-log-out" href="?logout=true"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Log Out</a>
            </div>
      

          </li>
        </ul>
      </nav>


      <aside class="sidebar-left border-right bg-white " id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>





        <nav class="vertnav navbar-side navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
              
                
                <img src="../../../assets/images/unified-lgu-logo.png" width="45">
              

            <div class="brand-title">
            <br>
              <span>PORTAL</span>
            </div>
                       
            </a>

          </div>

          <!--Sidebar ito-->

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a class="nav-link" href="../../../admin/main/dashboard">
              <i class="fas fa-chart-line"></i>
                <span class="ml-3 item-text">Admin Dashboard</span>

              </a>
            </li>
          </ul>
          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">MAIN COMPONENTS</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../../../admin/main/courses/course_mgmt">
              <i class="fa-solid fa-graduation-cap"></i>
                <span class="ml-3 item-text">Course Management</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../../../admin/main/compliance/comp-monitoring">
              <i class="fa-solid fa-shield-halved"></i>
                <span class="ml-3 item-text">Compliance Monitoring</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#tables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-clipboard-list"></i>
                <span class="ml-3 item-text">Employee Evaluation</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="tables">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="../../../admin/main/employee/quiz"><span class="ml-1 item-text">Quiz List</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="../../../admin/main/employee/emp-results "><span class="ml-1 item-text">Employee Results</span></a>
                </li>
             
              </ul>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
            <a class="nav-link" href="../../../admin/main/employee/emp-points">
            <i class="fa-solid fa-award"></i>
                <span class="ml-3 item-text">Employee Points</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa-solid fa-bullhorn"></i>
                <span class="ml-3 item-text">Announcements</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="pages">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="../../../admin/main/announcements/system-updates "><span class="ml-1 item-text">System Updates</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="../../../admin/main/announcements/reg-updates "><span class="ml-1 item-text">Regulatory Updates</span></a>
                </li>
             
              </ul>
            </li>
          </ul>

    
 
          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">ACCOUNT ROLE MANAGEMENT</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../../../admin/account_mgmt/admin-account ">
              <i class="fa-solid fa-user-tie"></i>
                <span class="ml-3 item-text">Portal Accounts</span>
              </a>
            </li>
          </ul>

    

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
            <a class="nav-link" href="../../../admin/account_mgmt/user-account ">
            <i class="fa-solid fa-users"></i>
                <span class="ml-3 item-text">User Accounts</span>
              </a>
            </li>
          </ul>

          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">SETTINGS</span>
          </p>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../../../admin/user/settings ">
              <i class="fa-solid fa-screwdriver-wrench"></i>
                <span class="ml-3 item-text">Settings</span>
              </a>
            </li>
          </ul>

  
      
        </nav>
      </aside>
      <main role="main" class="main-content">
        
        <!--For Notification header naman ito-->

        <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>


              <div class="modal-body">
  <div class="list-group list-group-flush my-n3">
    <?php foreach ($notifications as $notification) { ?>
      <div class="col-12 mb-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="notification-<?php echo $notification['id']; ?>">
          <img class="fade show" src="../../assets/images/unified-lgu-logo.png" width="35" height="35">
          <strong style="font-size:12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $notification['message']; ?></strong> 
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeNotification(<?php echo $notification['id']; ?>)">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div> <!-- /. col -->
    <?php } ?>
    <div id="no-notifications" style="display: none; text-align:center; margin-top:10px;">No notifications</div>
  </div> <!-- / .list-group -->
 
</div>



<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-block" onclick="clearAllNotifications()">Clear All</button>
              </div>
            </div>
          </div>
        </div>





      <!--CONTENT NA HERE-->

      <div class="col">
    <h2 class="h5 page-title">Quiz List Management</h2>
</div>

<div class="container-fluid">
    <div class="col-md-12 alert alert-success">Provide forms for adding, editing, and deleting quizzes, 
      along with a list of existing quizzes.</div>
    <button class="btn btn-primary bt-sm" id="new_quiz" data-toggle="modal" data-target="#manage_quiz">
        <i class="fa fa-plus"></i> Add New
    </button>
    <br><br>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id='table'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Items</th>
                        <th>Course Points</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Include database connection
                 $conn = mysqli_connect('localhost','root','');
       $db = mysqli_select_db($conn, 'crms_system_db');

                // Fetch quizzes from the database
                $query = "SELECT q.id, q.title, q.items, q.points_per_item, d.name AS department_name
                          FROM quizzes q
                          JOIN departments d ON q.department_id = d.id";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    $count = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$count}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['items']}</td>
                                <td>{$row['points_per_item']}</td>
                                <td>{$row['department_name']}</td>
                                <td>
                                    
                                    <button type='button' data-toggle='modal' data-target='#fail$count' name='delete$count' class='btn btn-danger'>Delete</button>
                                </td>
                              </tr>


                              <div id='fail$count' class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-sm modal-dialog-centered'> 
           <div class='modal-content'> 
           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Confirm Action</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 
           <div class='modal-body text-center p-4'> 
            <form action='' method='post' enctype='multipart/form-data'> 
           <h3 class='font-weight-bold mb-4'>Delete Course?</h3> 
            <input type='hidden' name='ctitle' value='{$row['title']}'>
           
           
           <div class='d-flex justify-content-center mt-4'> 
           <button type='submit' name='submit' class='btn btn-success btn-lg mr-1'>Confirm</button> 
           <button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Cancel</button> 
           </div> 
           </form> 


           </div> 
           </div> 
           </div> 
           </div> 

                              ";
                        $count++;



                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>No quizzes found.</td></tr>";
                }
                //DELETE COURSE
                 if(isset($_POST['submit'])) {
                    $db_course = $_POST['ctitle'];

                     $query = "DELETE FROM quizzes WHERE title='$db_course';";
                        $query_exec = mysqli_query($conn,$query);

                        if($query_exec){

                        echo "<script language='javascript'>alert('Course successfully deleted.')</script>";
                echo "<script>window.location.href='quiz.php';</script>";
              }
            }



                // Close the database connection
                $conn->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade dialog" id="manage_quiz" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModallabel">Add New Quiz</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id='quiz-frm' action="<?php echo htmlspecialchars(str_replace('.php', '', $_SERVER["PHP_SELF"])); ?>" method="POST">
                <div class="modal-body">
                    <div id="msg"></div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="hidden" name="id" />
                        <input type="text" name="title" required="required" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Points per question</label>
                        <input type="number" name="qpoints" required="" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select name="department_id" required="required" class="form-control">
                            <option value="" selected="" disabled="">Select Here</option>
                            <option value="1">Mathematics Department</option>
                            <option value="2">Science Department</option>
                            <option value="3">Literature Department</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
                    </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle form submission
    $('#quiz-frm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        $.ajax({
            type: 'POST',
            url: '../../../admin/employee/quiz.php', // Update this URL to the correct PHP file that processes the form
            data: $(this).serialize(), // Serialize the form data
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.error) {
                        $('#msg').html('<div class="alert alert-danger">' + result.error + '</div>');
                    } else {
                        // Redirect to question.php with quiz_id
                        window.location.href = '../../../admin/quizzes/question.php?quiz_id=' + result.quiz_id; // Use the correct key for quiz_id
                    }
                } catch (e) {
                    $('#msg').html('<div class="alert alert-danger">Invalid response from server.</div>');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#msg').html('<div class="alert alert-danger">An error occurred: ' + textStatus + ' - ' + errorThrown + '</div>');
            }
        });
    });
});
</script>

  
       
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../../js/jquery.min.js"></script>
  <script src="../../../js/popper.min.js"></script>
  <script src="../../../js/moment.min.js"></script>
  <script src="../../../js/bootstrap.min.js"></script>
  <script src="../../../js/simplebar.min.js"></script>
  <script src='../../../js/daterangepicker.js'></script>
  <script src='../../../js/jquery.stickOnScroll.js'></script>
  <script src="../../../js/tinycolor-min.js"></script>
  <script src="../../../js/config.js"></script>
  <script src="../../../js/d3.min.js"></script>
  <script src="../../../js/topojson.min.js"></script>
  <script src="../../../js/datamaps.all.min.js"></script>
  <script src="../../../js/datamaps-zoomto.js"></script>
  <script src="../../../js/datamaps.custom.js"></script>
  <script src="../../../js/Chart.min.js"></script>
  <script src="../../../js/gauge.min.js"></script>
  <script src="../../../js/jquery.sparkline.min.js"></script>
  <script src="../../../js/apexcharts.min.js"></script>
  <script src="../../../js/apexcharts.custom.js"></script>
  <script src='../../../js/jquery.mask.min.js'></script>
  <script src='../../../js/select2.min.js'></script>
  <script src='../../../js/jquery.steps.min.js'></script>
  <script src='../../../js/jquery.validate.min.js'></script>
  <script src='../../../js/jquery.timepicker.js'></script>
  <script src='../../../js/dropzone.min.js'></script>
  <script src='../../../js/uppy.min.js'></script>
  <script src='../../../js/quill.min.js'></script>
  <script src="../../../js/apps.js"></script>
  <script src="../../../js/preloader.js"></script>
  <script src="../../../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="../../../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src='../../../js/jquery.dataTables.min.js'></script>
    <script src='../../../js/dataTables.bootstrap4.min.js'></script>

    <script src="js/apps.js"></script>
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
    



function removeNotification(notificationId) {
  $.ajax({
    type: "POST",
    url: "../notify/remove_notification ",
    data: { id: notificationId },
    success: function() {
      $("#notification-" + notificationId).remove();
      updateNotificationCount();
    }
  });
}

function clearAllNotifications() {
  $.ajax({
    type: "POST",
    url: "../../notify/clear_all_notifications ",
    success: function() {
      $(".alert").remove();
      $("#no-notifications").show();
      updateNotificationCount();
    }
  });
}

function updateNotificationCount() {
  $.ajax({
    type: "POST",
    url: "../../notify/get_notification_count ",
    success: function(data) {
      $("#notification-count").text(data);
      if (data == 0) {
        $("#notification-count").hide();
      } else {
        $("#notification-count").show();
      }
    }
  });
}

function checkForNewNotifications() {
  $.ajax({
    type: "POST",
    url: "../../notify/check_for_new_notifications ",
    success: function(data) {
      if (data > 0) {
        // Show pop-up notification
        alert("New notification!");
        // Update notification count
        updateNotificationCount();
      }
    }
  });
}

// Check for new notifications every 5 seconds
setInterval(checkForNewNotifications, 5000);

function updateNotificationCount() {
  $.ajax({
    type: "POST",
    url: "../../notify/update_notification_count ",
    success: function(data) {
      $("#notification-count").text(data);
      if (data == 0) {
        $("#notification-count").hide();
      } else {
        $("#notification-count").show();
      }
    }
  });
}

// Create EventSource object
var source = new EventSource('../../notify/notification ');

// Listen for notification events
source.addEventListener('notification', function(event) {
  var count = event.data;
  if (count > 0) {
    // Show pop-up notification
    alert("New notification!");
    // Update notification count
    updateNotificationCount();
  }
});

// Update notification count
function updateNotificationCount() {
  $.ajax({
    type: "POST",
    url: "../../notify/update_notification_count ",
    success: function(data) {
      $("#notification-count").text(data);
      if (data == 0) {
        $("#notification-count").hide();
      } else {
        $("#notification-count").show();
      }
    }
  });
}



    </script>


  
  </body>
</html>

