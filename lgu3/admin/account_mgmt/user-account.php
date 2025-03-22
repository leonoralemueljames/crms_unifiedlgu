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
  $name_array = explode(" ", $name);
  $initials = strtoupper($name_array[0][0] . $name_array[count($name_array) - 1][0]);
  echo $initials;

  
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

          <ul class="navbar-nav flex-fill w-100 mb-2">
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
            <li class="nav-item w-100">
              <a class="nav-link" href="../../admin/main/compliance/comp-monitoring">
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
                  <a class="nav-link pl-3" href="../../admin/main/employee/quiz"><span class="ml-1 item-text">Quiz List</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="../../admin/main/employee/emp-results "><span class="ml-1 item-text">Employee Results</span></a>
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



          <ul class="navbar-nav active flex-fill w-100 mb-2">
            <li class="nav-item w-100">
            <a class="nav-link" href="../../admin/account_mgmt/user-account ">
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

      <div class="col flex-fill w-100 mb-2 nav-item">
      
      <h2 class="h5 page-title">User Account List</h2>
</div>

      <?php


$result = $conn->query("SELECT COUNT(*) as total_users FROM user_accounts");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row["total_users"];
} else {
    $total_users = 0;
}


// Query to get the number of active users
$result_active = $conn->query("SELECT COUNT(*) as active_users FROM user_accounts WHERE status = 'active'");

if ($result_active->num_rows > 0) {
    $row_active = $result_active->fetch_assoc();
    $active_users = $row_active["active_users"];
} else {
    $active_users = 0;
}


// Query to get the number of blocked users
$result_blocked = $conn->query("SELECT COUNT(*) as blocked_users FROM user_accounts WHERE status = 'blocked'");

if ($result_blocked->num_rows > 0) {
    $row_blocked = $result_blocked->fetch_assoc();
    $blocked_users = $row_blocked["blocked_users"];
} else {
    $blocked_users = 0;
}
?>


      

      <div class="container-fluid">
          <div class="row justify-content-center">
            
            
         
    </div>


    
    <div class="row my-4">

<div class="col-md-4">
  <div class="card  mb-4">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col">
          <small class="text-muted-show mb-1">Total Users</small>
          <h3 class="card-title" style="font-size:32px;"><?php
echo$total_users;
?></h3>
          
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
          <small class="text-muted-show mb-1">Active Users</small>
          <h3 class="card-title" style="font-size:32px;"><?php
echo$active_users;
?></h3>
         
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
          <small class="text-muted-show mb-1">Blocked Users</small>
          <h3 class="card-title" style="font-size:32px;"><?php
echo$blocked_users;
?></h3>
                                  
        </div>
       
        <div class="col-4 text-right">
          <span class="sparkline"><img src="../../assets/images/online-course.png" width="60"></span>
        </div>
      </div> <!-- /. row -->
    </div> <!-- /. card-body -->
  </div> <!-- /. card -->
</div> <!-- /. col -->
</div> <!-- end section -->






                      <!-- table -->
                      <table class="table datatables table-striped table-hover" id="dataTable-1" style="text-align:center;">
                        

<thead style="padding:20px">

          <th colspan="1">ID</th>
        <th>Last Name</th>
          <th>First Name</th>
          <th>Email</th>
          <th>Account Status</th>
          <th>Creation Date</th>
          <th>Action</th>
          
        </thead>
        
        <tbody>

        <?php




$search_query = '';
$search_params = array();
if (isset($_POST['search'])) {
  $search = $_POST['search'];
  $search_query = " WHERE lastname LIKE ? OR firstname LIKE ? OR email LIKE ?";
  $search_params = array("%$search%", "%$search%", "%$search%");
}

$sql = "SELECT * FROM user_accounts";
if ($search_query) {
  $sql .= $search_query;
}


$stmt = $conn->prepare($sql);
if ($search_query) {
  $stmt->bind_param("sss", $search_params[0], $search_params[1], $search_params[2]);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"]. "</td>";
    echo "<td >" . $row["lastname"]. "</td>";
    echo "<td>" . $row["firstname"]. "</td>";
    echo "<td style='max-width:150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>" . $row["email"]. "</td>";
    if ($row["status"] == "active") {
      echo "<td class='badge-status badge-success-active'>" . $row["status"] . "</td>";
  } 
  elseif ($row["status"] == "pending") {
    echo "<td class='badge-status badge-success-warning'>" . $row["status"] . "</td>";
} 
  else {
      echo "<td class='badge-status badge-danger-blocked'>" . $row["status"] . "</td>";
  }

  
    if (isset($row["created_at"])) {
      echo "<td style='max-width:150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;'>" . substr($row["created_at"], 0, 20) . "</td>";
    } else {
      echo "<td></td>";
    }
    echo "&nbsp &nbsp";
    echo "<td>
          <button type='button' class='list-button btn-primary' data-toggle='modal' data-target='#editModal" . $row["id"] . "'><i class='fa-solid fa-user-pen fe-14'></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
     
          ";
          if ($row["status"] == "blocked") {
            echo "<button type='button' class='list-button btn-success' data-toggle='modal' data-target='#unblockModal" . $row["id"] . "'><i class='fe fe-unlock fe-14'></i></button>&nbsp&nbsp ";
          } else {
            echo "<button type='button' class='list-button btn-danger' data-toggle='modal' data-target='#blockModal" . $row["id"] . "'><i class='fa-solid fa-lock fe-14'></i></button>&nbsp&nbsp ";
          }
          echo "</td>";
          echo "</tr>";

          // Modals
          echo "<div id='blockModal" . $row["id"] . "' class='modal fade' role='dialog'>";
          echo "<div class='modal-dialog modal-sm modal-dialog-centered'>";
          echo "<div class='modal-content'>";
          echo "<div class='modal-header'>";
          echo "<h5 class='modal-title'>Block User</h5>";
          echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
          echo "</div>";
          echo "<div class='modal-body text-center p-4'>";
          echo "<p class='font-weight-bold mb-4'>Are you sure you want to block the user <span class='text-danger'>" . $row["firstname"] . " " . $row["lastname"] . "</span> with ID " . $row["id"] . "?</p>";
          echo "<p class='text-muted'>This action will prevent the user from logging in.</p>";
          echo "<form action='' method='post'>";
          echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
          echo "<input type='hidden' name='block' value='block'>";
          echo "<div class='d-flex justify-content-center mt-4'>";
          echo "<button type='submit' class='btn btn-danger btn-lg mr-2'>Block</button>";
          echo "<button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Cancel</button>";
          echo "</div>";
          echo "</form>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";

          echo "<div id='unblockModal" . $row["id"] . "' class='modal fade' role='dialog'>";
          echo "<div class='modal-dialog modal-sm modal-dialog-centered'>";
          echo "<div class='modal-content'>";
          echo "<div class='modal-header'>";
          echo "<h5 class='modal-title'>Unblock User</h5>";
          echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
          echo "</div>";
          echo "<div class='modal-body text-center p-4'>";
          echo "<p class='font-weight-bold mb-4'>Are you sure you want to unblock the user <span class='text-danger'>" . $row["firstname"] . " " . $row["lastname"] . "</span> with ID " . $row["id"] . "?</p>";
          echo "<p class='text-muted'>This action will allow the user to log in.</p>";
          echo "<form action='' method='post'>";
          echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
          echo "<input type='hidden' name='unblock' value='unblock'>";
          echo "<div class='d-flex justify-content-center mt-4'>";
          echo "<button type='submit' class='btn btn-success btn-lg mr-2'>Unblock</button>";
          echo "<button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Cancel</button>";
          echo "</div>";
          echo "</form>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";

          echo "<div id='editModal" . $row["id"] . "' class='modal fade' role='dialog'>";
          echo "<div class='modal-dialog modal-dialog-centered'>";
          echo "<div class='modal-content'>";
          echo "<div class='modal-header'>";
          echo "<h5 class='modal-title'>Edit User</h5>";
          echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
          echo "</div>";
          echo "<div class='modal-body p-4'>";
          echo "<form id='updateForm" . $row["id"] . "' method='post'>";
          echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
          echo "<div class='form-group'>";
          echo "<label for='lastname'>Lastname:</label>";
          echo "<input type='text' name='lastname' value='" . $row["lastname"] . "' class='form-control'>";
          echo "</div>";
          echo "<div class='form-group'>";
          echo "<label for='firstname'>Firstname:</label>";
          echo "<input type='text' name='firstname' value='" . $row["firstname"] . "' class='form-control'>";
          echo "</div>";
          echo "<div class='form-group'>";
          echo "<label for='email'>Email:</label>";
          echo "<input type='email' name='email' value='" . $row["email"] . "' class='form-control'>";
          echo "</div>";
          echo "<div class='text-center mt-4'>";
          echo "<button type='submit' name='submit' class='btn btn-primary btn-lg'>Update</button>";
          echo "</div>";
          echo "</form>";
          echo "</div>";
          echo "</div>";
          echo "</div>";
          echo "</div>";

          if (isset($_POST['block'])) {
            // Get the form data
            $id = $_POST['id'];

            // Prepare the update query
            $sql = "UPDATE `user_accounts` SET `status` = 'blocked' WHERE `id` = '$id'";

            // Execute the query
            $query = mysqli_query($conn, $sql);

            if ($query == true) {
                echo "<script>
                        $(document).ready(function() {
                          toastr.success('User blocked successfully!');
                        });
                      </script>";
                echo "<script>window.location.href='../../admin/account_mgmt/user-account';</script>";
                echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>";
                echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>";
            } else {
                echo "<script>
                        $(document).ready(function() {
                          toastr.error('Error blocking user!');
                        });
                      </script>";
            }
          }

          if (isset($_POST['unblock'])) {
            // Get the form data
            $id = $_POST['id'];

            // Prepare the update query
            $sql = "UPDATE `user_accounts` SET `status` = 'active' WHERE `id` = '$id'";

            // Execute the query
            $query = mysqli_query($conn, $sql);

            if ($query == true) {
                echo "<script>
                        $(document).ready(function() {
                          toastr.success('User unblocked successfully!');
                        });
                      </script>";
                echo "<script>window.location.href='../../admin/account_mgmt/user-account';</script>";
                echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>";
                echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>";
                } else {
                    echo "<script>
                            $(document).ready(function() {
                              toastr.error('Error unblocking user!');
                            });
                          </script>";
                }
              }
      
              if (isset($_POST['submit'])) {
                // Get the form data
                $id = $_POST['id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
              
                // Prepare the update query
                $sql = "UPDATE `user_accounts` SET  `firstname`='$firstname' , `lastname`='$lastname', `email`='$email' WHERE id='$id' ";
              
                // Execute the query
                $query = mysqli_query($conn, $sql);
              
                if ($query == true) {
                    echo "<script>
                            $(document).ready(function() {
                              toastr.success('User  updated successfully!');
                            });
                          </script>";
                    echo "<script>window.location.href='../../admin/account_mgmt/user-account';</script>";
                    echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>";
                    echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js'></script>";
                    echo "<script>updateTable(data);</script>";
                } else {
                    echo "<script>
                            $(document).ready(function() {
                              toastr.error('Error updating user!');
                            });
                          </script>";
                }
              }
              
              echo "<script>";
              echo "function updateTable(data) {";
              echo "var table = document.getElementById('table');";
              echo "table.innerHTML = '';";
              echo "for (var i = 0; i < data.length; i++) {";
              echo "var row = table.insertRow(i);";
              echo "var cell1 = row.insertCell(0);";
              echo "var cell2 = row.insertCell(1);";
              echo "var cell3 = row.insertCell(2);";
              echo "var cell4 = row.insertCell(3);";
              echo "cell1.innerHTML = data[i].id;";
              echo "cell2.innerHTML = data[i].firstname;";
              echo "cell3.innerHTML = data[i].lastname;";
              echo "cell4.innerHTML = data[i].email;";
              echo "}";
              echo "}";
              echo "</script>";
              
              echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
            }
        }
      else {
        echo "<tr><td colspan='7' style='font-size: 15px; text-align: center; padding:20px;'>No data found.</td></tr>";
      }
      
     
      ?>
                      
                    </tbody>

                  </table>
                </div>
              </div>


            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> 


<?php

$firstname = $lastname = $email = $password = $phone_num = $confirm_password = "";
$firstnameerr = $lastnameerr = $emailerr = $phone_numbererr = $passworderr = "";

include ('../../connection.php');

$conn = new mysqli($servername, $username, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty($_POST["firstname"])) {
      $firstnameerr = "First name is required!";
  } else {
      $firstname = $_POST["firstname"];
  }

  if (empty($_POST["lastname"])) {
      $lastnameerr = "Last name is required!";
  } else {
      $lastname = $_POST["lastname"];
  }

  if (empty($_POST["email"])) {
      $emailerr = "Email is required!";
  } else {
      $email = $_POST["email"];
  }

  if (empty($_POST["phone_number"])) {
    $phone_numbererr = "Phone Number is required!";
} else {
    $phone_number = $_POST["phone_number"];
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

  // If no errors, insert data into the database
  if (empty($firstnameerr) && empty($lastnameerr) && empty($emailerr) && empty($phone_numbererr) && empty($passworderr) && empty($confirm_passworderr)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user_accounts (firstname, lastname, email, phone_number, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone_number, $hashedPassword);

    if ($stmt->execute()) {
        // Trigger SweetAlert on successful registration
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
              <script>
  document.addEventListener("DOMContentLoaded", function() {
      Swal.fire({
          icon: "success",
          title: "Account Created!",
          text: "User can now sign in.",
          showConfirmButton: true,
          confirmButtonText: "OK",
          allowOutsideClick: false,  // Prevent closing by clicking outside
          allowEscapeKey: false,      // Prevent closing by pressing Escape
          willClose: () => {
              // Clear all input fields manually
              document.querySelectorAll("#registrationForm input").forEach(input => input.value = "");
              window.location.href = "../../admin/account_mgmt/user-account"; 
          }
      });
  });
  </script>';
    } else {
        // Log the error for debugging
        error_log("Database error: " . $stmt->error);
        // Show user-friendly error message
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Something went wrong! Please try again.",
                    showConfirmButton: true
                });
            });
        </script>';
    }
  }
} // This bracket was missing



  ?>

        <!-- Add user Modal -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add User Account</h5>

              </div>
              <div class="modal-body" style="padding: 30px;">
                <form id="addUser" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="mb-3 row">
                    <label for="addfistnameField" class="col-md-3 form-label">First name</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="addfirstnameField" name="firstname"
                        value="<?php echo htmlspecialchars($firstname); ?>">
                      <span style="color:red;"><?php echo $firstnameerr; ?></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="addEmailField" class="col-md-3 form-label">Last Name</label>
                    <div class="col-md-9">
                      <input type="text" class="form-control" id="addlastnameField" name="lastname"
                        value="<?php echo htmlspecialchars($lastname); ?>">
                      <span style="color:red;"><?php echo $lastnameerr; ?></span>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="addemailField" class="col-md-3 form-label">Email</label>
                    <div class="col-md-9">
                      <input type="email" class="form-control" name="email"
                        value="<?php echo htmlspecialchars($email); ?>">
                      <span style="color:red;"><?php echo $emailerr; ?></span>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="addemailField" class="col-md-3 form-label">Phone Number</label>
                    <div class="col-md-9">
                      <input type="number" class="form-control" name="phone_number"
                        value="<?php echo htmlspecialchars($phone_number); ?>">
                      <span style="color:red;"><?php echo $phone_numbererr; ?></span>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="addemailField" class="col-md-3 form-label">Password</label>
                    <div class="col-md-9">
                      <input type="password" class="form-control" name="password"
                        value="<?php echo htmlspecialchars($password); ?>">
                      <span style="color:red;"><?php echo $passworderr; ?></span>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>

    </main> <!-- main -->
  </div> <!-- .wrapper -->

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
    </script>








</body>

</html>