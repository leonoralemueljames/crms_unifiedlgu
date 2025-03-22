<?php

include('../../connection.php');
include('../../session/security_config.php');

session_start();

// Check if the token is set and valid
if (!isset($_SESSION['token'])) {
  header('Location: ../../admin/sign-in');
  exit;
}

// When the user logs out, destroy the session and redirect to the login page
if (isset($_GET['logout'])) {
  session_destroy();
  echo "<meta http-equiv='refresh' content='0;url=../../admin/sign-in'>";
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
    <link rel="icon" href="../../assets/images/unified-lgu-logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Admin Dashboard- CRMS PORTAL</title>

    <!-- Simple bar CSS (for scvrollbar)-->
    <link rel="stylesheet" href="../../css/simplebar.css">

    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../../css/feather.css">
    
    <!-- App CSS -->
    <link rel="stylesheet" href="../../ui/main.css">   


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
              <a class="dropdown-item" href="../../admin/user/my-profile "> <i class="fe fe-user"></i>&nbsp;&nbsp;&nbsp;Profile</a>
              <a class="dropdown-item" href="../../admin/user/settings "><i class="fe fe-settings"></i>&nbsp;&nbsp;&nbsp;Settings</a>
             
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
              
                
                <img src="../../assets/images/unified-lgu-logo.png" width="45">
              

            <div class="brand-title">
            <br>
              <span>PORTAL</span>
            </div>
                       
            </a>

          </div>

          <!--Sidebar ito-->

          <ul class="navbar-nav active flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a class="nav-link" href="../../admin/main/dashboard">
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
              <a class="nav-link" href="../../admin/main/courses/course_mgmt">
              <i class="fa-solid fa-graduation-cap"></i>
                <span class="ml-3 item-text">Course Management</span>
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
                  <a class="nav-link pl-3" href="../../admin/main/employee/quiz"><span class="ml-1 item-text">Quiz List</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="../../admin/main/employee/emp-results "><span class="ml-1 item-text">Compliance Monitoring</span></a>
                </li>
             
              </ul>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
            <a class="nav-link" href="../../admin/main/employee/emp-points">
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
                  <a class="nav-link pl-3" href="../../admin/main/announcements/system-updates "><span class="ml-1 item-text">System Updates</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="../../admin/main/announcements/reg-updates "><span class="ml-1 item-text">Regulatory Updates</span></a>
                </li>
             
              </ul>
            </li>
          </ul>

    
 
          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">ACCOUNT ROLE MANAGEMENT</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../../admin/account_mgmt/admin-account ">
              <i class="fa-solid fa-user-tie"></i>
                <span class="ml-3 item-text">Portal Accounts</span>
              </a>
            </li>
          </ul>



          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">SETTINGS</span>
          </p>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../../admin/user/settings ">
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

    <?php
    function getAdminInfo() {
      $stmt = $conn->prepare("SELECT firstname, lastname, role FROM admin_accounts WHERE id = ?");
      $stmt->bind_param("i", $_SESSION['id']); // Replace with the correct column name and value
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["firstname"] = $row['firstname'];
        $_SESSION["lastname"] = $row['lastname'];
        $_SESSION["role"] = $row['role'];
        $name = $_SESSION["firstname"] . ' ' . $_SESSION["lastname"];
        $name_array = explode(" ", $name);
        $initials = strtoupper($name_array[0][0] . $name_array[count($name_array) - 1][0]);
        return $initials;
      } else {
        return "No name set";
      }
    }
    ?>
      <div class="col">
      <h2 class="h5 page-title">Welcome <?php echo isset($_SESSION['role'])?>, <?php echo isset($_SESSION['firstname']) ? $_SESSION['lastname'] : 'Guest'; ?></h2>
      <h5 class="h5-small">Role: Super Admin</h5>

      <button class="btn mb-2 btn-primary second" data-toggle='modal' data-target='#defaultModal1'>ADD ANNOUNCEMENT</button>
</div>
       <?php
                $connections = mysqli_connect("localhost","root","","crms_system_db");
       echo "
      <!-- Modal -->
                      <div class='modal fade' id='defaultModal1' tabindex='-1' role='dialog' aria-labelledby='defaultModalLabel' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title' id='defaultModalLabel'>Add an Announcement</h5>
                              <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                             <form action='' method='POST' enctype='multipart/form-data'>
                            <div class='modal-body'>
                              

                              Announcement are published by uploading an image of the banner of the announcement and will be reflected to the employees accounts in dashboard.
                              <br>
                              <br>
                            <div class='form-group'>  
                              <input type='file' name='image'>
                            </div>
</div>

                            
                            <div class='modal-footer'>
                             
                              
                              
                              <button type='button' class='btn mb-2 btn-secondary' data-dismiss='modal'>Close</button>

                              <button type='submit' name='submit' class='btn btn-primary btn-lg mr-1'>Upload File</button> 
                            
                            </div>
                            </form>
               



                          </div>
                        </div>
                      </div>";

    if(isset($_POST['submit'])) {

      
    
    $fileName = $_FILES["image"]["name"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    $tempName = $_FILES["image"]["tmp_name"];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/crmslgu3/uploads/" . $fileName;

    
    if(in_array($ext, $allowedTypes)){
        if(move_uploaded_file($tempName, $targetPath)){
            $query = "INSERT INTO announcements(ann_image) VALUES ('$fileName')";

            $query_exec = mysqli_query($connections,$query);

                echo "<script language='javascript'>alert('Announcement published successfully.')</script>";
                echo "<script>window.location.href='dashboard.php';</script>";
            }else{
                echo "Something is wrong";
            }
        }

       }


                            ?>
                            


      <?php


$result = $conn->query("SELECT COUNT(*) as total_users FROM user_accounts");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row["total_users"];
} else {
    $total_users = 0;
}

$result = $conn->query("SELECT COUNT(*) as total_admin FROM admin_accounts");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_admin = $row["total_admin"];
} else {
    $total_admin = 0;
}

$conn->close();
?>


      <div class="row my-4">

                <div class="col-md-4">
                  <div class="card  mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted-show mb-1">Total Employees</small>
                          <h3 class="card-title" style="font-size:32px;"><?php echo$total_users;
?></h3>
                          <a href="../../admin/account_mgmt/user-account "><p class="small mb-0"><span style="" class="badge badge-dark ">View</span></p></a> 
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline "><img src="../../assets/images/group.png"  width="70"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card  mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted-show mb-1">Portal Accounts</small>
                          <h3 class="card-title" style="font-size:32px;"><?php echo$total_admin;
?></h3>
                          <a href="../../admin/account_mgmt/admin-account "><p class="small mb-0"><span style="" class="badge badge-dark ">View</span></p></a>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline"><img src="../../assets/images/people.png" width="50"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted-show mb-1">Upload Courses</small>
                          <h3 class="card-title" style="font-size:32px;">3</h3>
                          
                          <a href="../../admin/main/courses/course_mgmt"><p class="small mb-0"><span style="" class="badge badge-dark ">View</span></p></a>
                        </div>
                       
                        <div class="col-4 text-right">
                          <span class="sparkline"><img src="../../assets/images/online-course.png" width="60"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                  
                </div> <!-- /. col -->
                
              </div> <!-- end section -->
              <!-- linechart -->

                     
              <div class="my-4">
                <div id="chart"></div>
              </div>

              <style>
                    #chart {
      max-width: 2050px;
      position: relative;
      margin: 10px auto;
      
    }

                </style>


  
       

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="../../js/apexchart.min.js"></script>
  <script src="../../js/apexcharts.js"></script>
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/popper.min.js"></script>
  <script src="../../js/moment.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/simplebar.min.js"></script>
  <script src='../../js/daterangepicker.js'></script>
  <script src='../../js/jquery.stickOnScroll.js'></script>
  <script src="../../js/tinycolor-min.js"></script>
  <script src="../../js/config.js"></script>
  <script src="../../js/d3.min.js"></script>
  <script src="../../js/topojson.min.js"></script>
  <script src="../../js/datamaps.all.min.js"></script>
  <script src="../../js/datamaps-zoomto.js"></script>
  <script src="../../js/datamaps.custom.js"></script>
  <script src="../../js/Chart.min.js"></script>
  <script src="../../js/gauge.min.js"></script>
  <script src="../../js/jquery.sparkline.min.js"></script>
  <script src="../../js/apexcharts.min.js"></script>
  <script src="../../js/apexcharts.custom.js"></script>
  <script src='../../js/jquery.mask.min.js'></script>
  <script src='../../js/select2.min.js'></script>
  <script src='../../js/jquery.steps.min.js'></script>
  <script src='../../js/jquery.validate.min.js'></script>
  <script src='../../js/jquery.timepicker.js'></script>
  <script src='../../js/dropzone.min.js'></script>
  <script src='../../js/uppy.min.js'></script>
  <script src='../../js/quill.min.js'></script>
  <script src="../../js/apps.js"></script>
  <script src="../../js/preloader.js"></script>
  <script src="../../js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="../../js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src='../../js/jquery.dataTables.min.js'></script>
    <script src='../../js/dataTables.bootstrap4.min.js'></script>
    <script>
      $('#dataTable-1').DataTable(
      {
        autoWidth: true,
        "lengthMenu": [
          [16, 32, 64, -1],
          [16, 32, 64, "All"]
        ]
      });
    </script>
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



<script>
async function fetchData() {
  const response = await fetch('../../get_data '); // Adjust the path as necessary
  const data = await response.json();
  console.log(data); // Log the fetched data for debugging
  return data;
}

async function initChart() {
  const totals = await fetchData();

  // Check if totals contain data
  if (!totals.dates || totals.dates.length === 0) {
    console.error("No data available for the chart.");
    return; // Exit if there's no data
  }

  // Prepare the data for the chart
  const seriesData = totals.dates.map((date, index) => {
    return {
      x: new Date(date).getTime(), // Convert date string to timestamp
      y: [totals.total_users[index] || 0, totals.total_admins[index] || 0] // Array of user and admin counts, default to 0 if undefined
    };
  });

  var options = {
    chart: {
      type: "bar",
      height: 360,
      stacked: false, // Set to false for a regular bar chart
      zoom: {
        enabled: true, // Enable zooming
        type: 'x', // Allow zooming on the x-axis
        autoScaleYaxis: true
      }
    },
    series: [
      {
        name: "Total Users",
        data: seriesData.map(data => [data.x, data.y[0]]) // Only user counts
      },
      {
        name: "Total Admins",
        data: seriesData.map(data => [data.x, data.y[1]]) // Only admin counts
      }
    ],
    xaxis: {
      type: 'datetime', // Set x-axis type to datetime
      labels: {
        formatter: function(value) {
          return new Date(value).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          });
        }
      },
    },
    yaxis: {
      title: {
        text: 'Count'
      },
      min: 0 // Start y-axis at zero
    },
    tooltip: {
      x: {
        format: 'dd MMM yyyy' // Format for tooltip date
      }
    }
  };

  var chart = new ApexCharts(document.querySelector("#chart"), options);
  chart.render();
}

// Initialize the chart
initChart();
</script>
  
  </body>
</html>

