<?php
include('../connection.php');
include('../session/check_session.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../assets/images/unified-lgu-logo.png">

    <title>Course Catalog - CRMS</title>

    <!-- Simple bar CSS (for scvrollbar)-->
    <link rel="stylesheet" href="../css/simplebar.css">

    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../css/feather.css">
    
    <!-- App CSS -->
    <link rel="stylesheet" href="../ui/main.css">   


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
    background-color: #<?php echo substr(md5($_SESSION["name"]), 0, 6); ?>;
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
    background-color: #<?php echo substr(md5($_SESSION["name"]), 0, 6); ?>;
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
  background-color: rgba(0, 0, 0, 0.5);
}

.toast {
  position: absolute;
  top: 25px;
  right: 30px;
  border-radius: 12px;
  background: #fff;
  padding: 20px 35px 20px 25px;
  box-shadow: 0 6px 20px -5px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  transform: translateX(calc(100% + 30px));
  transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
}

.toast.active {
  transform: translateX(0%);
}

.toast .toast-content {
  display: flex;
  align-items: center;
}

.toast-content .check {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 35px;
  min-width: 35px;
  background-color: #4070f4;
  color: #fff;
  font-size: 20px;
  border-radius: 50%;
}

.toast-content .message {
  display: flex;
  flex-direction: column;
  margin: 0 20px;
}

.message .text {
  font-size: 16px;
  font-weight: 400;
  color: #666666;
}

.message .text.text-1 {
  font-weight: 600;
  color: #333;
}

.toast .close {
  position: absolute;
  top: 10px;
  right: 15px;
  padding: 5px;
  cursor: pointer;
  opacity: 0.7;
}

.toast .close:hover {
  opacity: 1;
}

.toast .progress {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 3px;
  width: 100%;

}

.toast .progress:before {
  content: "";
  position: absolute;
  bottom: 0;
  right: 0;
  height: 100%;
  width: 100%;
  background-color: #4070f4;
}

.progress.active:before {
  animation: progress 5s linear forwards;
}

@keyframes progress {
  100% {
    right: 100%;
  }
}

button {
  padding: 12px 20px;
  font-size: 20px;
  outline: none;
  border: none;
  background-color: #4070f4;
  color: #fff;
  border-radius: 6px;
  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  background-color: #0e4bf1;
}

.toast.active ~ button {
  pointer-events: none;
}


</style>
  
  </head>


   <!-- <div class="loader-mask">
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
             
            </section>
          </li>


          <li class="nav-item dropdown">
            <span class="nav-link text-muted pr-0 avatar-icon" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="avatar avatar-sm mt-2">
  <div class="avatar-img rounded-circle avatar-initials-min text-center position-relative">
    <?php
      $name = explode(" ", $_SESSION["name"]);
      $initials = strtoupper($name[0][0] . $name[count($name) - 1][0]);
      echo $initials;
    ?>
  </div>
</span>
</span>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              
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
              
                
                <img src="../assets/images/unified-lgu-logo.png" width="45">
              

            <div class="brand-title">
            <br>
              <span>CRMS</span>
            </div>
                       
            </a>

          </div>

          <!--Sidebar ito-->

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a class="nav-link" href="../my/dashboard  ">
                <i class="fa-solid fa-house fe-16">&nbsp;</i>
                <span class="ml-3 item-text">Dashboard</span>

              </a>
            </li>
          </ul>
          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">MAIN COMPONENTS</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">


          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../courses/my-courses  ">
                <i class="fa-solid fa-book fe-16">&nbsp;&nbsp;</i>
              
                <span class="ml-3 item-text">My Courses</span>
              </a>
            </li> 
          </ul>

          <ul class="navbar-nav active flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../courses/course-catalog  ">
              <i class="fa-solid fa-folder-tree fe-16">&nbsp;</i>
                <span class="ml-3 item-text">Course Catalog</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../eval/my-evaluations  ">
              <i class="fa-solid fa-chart-pie fe-16">&nbsp;</i>
                <span class="ml-3 item-text">My Evaluations</span>
              </a>
            </li>
          </ul>


          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../points/points-center  ">
              <i class="fa-solid fa-trophy fe-16">&nbsp;</i>
                <span class="ml-3 item-text">Points Center</span>
              </a>
            </li>
          </ul>
          
 


          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">RESOURCES</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../help/help-&-support  ">
              <i class="fa-solid fa-circle-question fe-16">&nbsp;</i>
                <span class="ml-3 item-text">Help & Support</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../announce/announcements  ">
              <i class="fa-solid fa-bullhorn fe-16">&nbsp;</i>
                <span class="ml-3 item-text">Announcements</span>
              </a>
            </li>
          </ul>

          <p class="text-muted-nav nav-heading mt-4 mb-1">
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">SETTINGS</span>
          </p>

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../users/settings  ">
              <i class="fa-solid fa-gear fe-16">&nbsp;</i>
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
                  
                      <div class="col-auto">
                        
                      </div>
                      <div class="col-12 mb-4">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                          <strong>New courses available!</strong> You should check in on some of those fields below. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                            <span aria-hidden="true">&times;</span>
                            
                          </button>
                        </div>
                      </div> <!-- /. col -->
                
                  
  
                      <div class="col-12 mb-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Congratulations!</strong> You should check in on some of those fields below. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                            <span aria-hidden="true">&times;</span>
                            
                          </button>
                        </div>
                      </div> <!-- /. col -->

                      <div class="col-12 mb-4">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong><Ri:a>Pending course</Ri:a>!</strong> You should check in on some of those fields below. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                            <span aria-hidden="true">&times;</span>
                            
                          </button>
                        </div>
                      </div> <!-- /. col -->

                      <div class="col-12 mb-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Well Done!</strong> You should check in on some of those fields below. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            
                            <span aria-hidden="true">&times;</span>
                            
                          </button>
                        </div>
                      </div> <!-- /. col -->

          
                </div> <!-- / .list-group -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" aria-label="Close">Clear All</button>
              </div>
            </div>
          </div>
        </div>


       <!--
        <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body px-5">
                <div class="row align-items-center">
                  <div class="col-6 text-center">
                    <div class="squircle bg-success justify-content-center">
                      <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Settings</p>
                  </div>
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Activity</p>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Droplet</p>
                  </div>
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Upload</p>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-users fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Users</p>
                  </div>
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Settings</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
-->




      <!--CONTENT NA HERE-->

      <div class="col">
      <h2 class="h5 page-title">Course Catalog</h2>
      <div class="col-md-12 alert alert-info">These course descriptions aim to provide a clear understanding of the specific areas of compliance and regulation relevant to barangays.</div>
      
      <br>
</div>

<div class="container-fluid">
  
<div class="row justify">


                   <div class="col-md-4 mb-4">
                  <div class="card shadow" style="height: 330px;">
                    <div class="card-body" >
                      <p class="card-title"><strong>Understanding Compliance Requirements for Barangay Employees</strong></p>
                      <p class="card-text" style="display: flex;justify-content: center;">
                      <img src="../assets/images/compliance.png" width="250">
                      </p>
                      <!-- Button trigger modal -->

                      <?php
                        define('ENVIRONMENT', 'local'); // Change to 'production' when deploying

// Set up the database connection based on the environment
if (ENVIRONMENT === 'local') {
    $conn = mysqli_connect("localhost", "root", "", "crms_system_db");
} else {
    $conn = mysqli_connect("localhost", "crms_admin", "+o+fm+K@pI9s5kGy", "crms_system_db");
}

                $db = mysqli_select_db($conn, "crms_system_db");
                $name = $_SESSION['name'];
                $retrieve_query = mysqli_query($conn, "SELECT DISTINCT * FROM evaluation WHERE employee_name = '$name' AND course_title = 'Understanding Compliance Requirements for Barangay Employees' LIMIT 1");
                        $check_rows = mysqli_num_rows($retrieve_query);
                        if($check_rows > 0){
                            while($row =mysqli_fetch_assoc($retrieve_query)){
                              $db_status = $row['status'];

                                if($db_status == "FAILED"){
                                  //ENROLL BUTTON IS ABLE IF STATUS IS NOT COMPLETED
                                    echo "<button type='button' class='btn mb-2 btn-danger' data-toggle='modal' data-target='#defaultModal1' disabled> Evaluation Failed </button>";
                                }else if($db_status == "FOR VERIFICATION"){

                                  echo "<button type='button' class='btn mb-2 btn-info' data-toggle='modal' data-target='#defaultModal1' disabled> For Verification</button>";

                                }else if($db_status == "STARTED"){

                                  echo "<button type='button' class='btn mb-2 btn-warning' data-toggle='modal' data-target='#defaultModal1' > Course Started </button>";

                                }else if($db_status == "COMPLETED"){
                                  // IF COURSE IS COMPLETED YOU CANNOT ENROLL THE COURSE AGAIN
                                  echo "<button type='button' class='btn mb-2 btn-success' style='color:black;' data-toggle='modal' data-target='#defaultModal1' disabled><b>Course Completed</b></button>";
                                }else{
                                  //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal1'> Enroll Course </button>";
                                }
                            }
                        }else{
                          //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal1'> Enroll Course </button>";
                        }

                      ?>
                      
                      


                      <!-- Modal -->
                      <div class="modal fade" id="defaultModal1" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="defaultModalLabel">About this Course</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              

                              This module can provide an overview of the roles and responsibilities of barangay officials, 
                              including the legal framework governing barangays and their functions within the local government system.

</div>

                            
                            <div class="modal-footer">
                              <form action="start-course-understanding.php" method="POST">
                              <input type="hidden" name="und" value="understanding">
                              
                              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>

                              <button type="submit" name="under" class="btn mb-2 btn-primary second">Start Course</button>
                            </form>
                            </div>

                            



                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="card shadow" style="height: 330px;">
                    <div class="card-body">
                      <p class="card-title"><strong>Ethics and Integrity in Public Service</strong></p>
                      <p class="card-text" style="display: flex;justify-content: center;">
                      <img src="../assets/images/ethics.jpg" width="250">
                      </p>
                      <!-- Button trigger modal -->
                      <?php
                        $conn = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($conn, "crms_system_db");
                $name = $_SESSION['name'];
                $retrieve_query = mysqli_query($conn, "SELECT DISTINCT * FROM evaluation WHERE employee_name = '$name' AND course_title = 'Ethics and Integrity in Public Service' LIMIT 1");
                        $check_rows = mysqli_num_rows($retrieve_query);
                        if($check_rows > 0){
                            while($row =mysqli_fetch_assoc($retrieve_query)){
                              $db_status = $row['status'];

                                if($db_status == "FAILED"){
                                  //ENROLL BUTTON IS ABLE IF STATUS IS NOT COMPLETED
                                    echo "<button type='button' class='btn mb-2 btn-danger' data-toggle='modal' data-target='#defaultModal2' disabled> Evaluation Failed </button>";
                                }else if($db_status == "FOR VERIFICATION"){

                                  echo "<button type='button' class='btn mb-2 btn-info' data-toggle='modal' data-target='#defaultModal2' disabled> For Verification</button>";

                                }else if($db_status == "STARTED"){

                                  echo "<button type='button' class='btn mb-2 btn-warning' data-toggle='modal' data-target='#defaultModal2'> Course Started </button>";

                                }else if($db_status == "COMPLETED"){
                                  // IF COURSE IS COMPLETED YOU CANNOT ENROLL THE COURSE AGAIN
                                  echo "<button type='button' class='btn mb-2 btn-success' data-toggle='modal' data-target='#defaultModal2' disabled> Course Completed </button>";
                                }else{
                                  //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal2'> Enroll Course </button>";
                                }
                            }
                        }else{
                          //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal2'> Enroll Course </button>";
                        }

                      ?>
                      <!-- Modal -->
                      <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="defaultModalLabel">About this Course</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">This module can provide an overview of the roles and responsibilities of barangay officials, 
                              including the legal framework governing barangays and their functions within the local government system.
                            </div>
                            <form action="start-course-ethics.php" method="POST">
                            <div class="modal-footer">
                              <input type="hidden" name="ethics" value="ethics">
                              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                              <button id="show-success" name="ethicsbtn" type="submit" class="btn mb-2 btn-primary second">Start Course</button>
                            </form>
                            </div>
                        


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="card" style="height: 330px;">
                    <div class="card-body">
                      <p class="card-text"><strong>Data Privacy and Protection for Barangay Employees</strong></p>
                      <p class="card-text" style="display: flex;justify-content: center;">
                      <img src="../assets/images/data-privacy.jpg" width="250">
                      </p>
                      <!-- Button trigger modal -->
                      <?php


// Set up the database connection based on the environment
if (ENVIRONMENT === 'local') {
    $connections = mysqli_connect("localhost", "root", "", "crms_system_db");
} else {
    $connections = mysqli_connect("localhost", "crms_admin", "+o+fm+K@pI9s5kGy", "crms_system_db");
}
                $db = mysqli_select_db($conn, "crms_system_db");
                $name = $_SESSION['name'];
                $retrieve_query = mysqli_query($conn, "SELECT DISTINCT * FROM evaluation WHERE employee_name = '$name' AND course_title = 'Data Privacy and Protection for Barangay Employees' LIMIT 1");
                        $check_rows = mysqli_num_rows($retrieve_query);
                        if($check_rows > 0){
                            while($row =mysqli_fetch_assoc($retrieve_query)){
                              $db_status = $row['status'];

                                if($db_status == "FAILED"){
                                  //ENROLL BUTTON IS ABLE IF STATUS IS NOT COMPLETED
                                    echo "<button type='button' class='btn mb-2 btn-danger' data-toggle='modal' data-target='#defaultModal3' disabled> Evaluation Failed </button>";
                                }else if($db_status == "FOR VERIFICATION"){

                                  echo "<button type='button' class='btn mb-2 btn-info' data-toggle='modal' data-target='#defaultModal3' disabled> For Verification</button>";

                                }else if($db_status == "STARTED"){

                                  echo "<button type='button' class='btn mb-2 btn-warning' data-toggle='modal' data-target='#defaultModal3'> Course Started </button>";

                                }else if($db_status == "COMPLETED"){
                                  // IF COURSE IS COMPLETED YOU CANNOT ENROLL THE COURSE AGAIN
                                  echo "<button type='button' class='btn mb-2 btn-success' data-toggle='modal' data-target='#defaultModal3' disabled> Course Completed </button>";
                                }else{
                                  //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal3'> Enroll Course </button>";
                                }
                            }
                        }else{
                          //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal3'> Enroll Course </button>";
                        }

                      ?>
                      <!-- Modal -->
                      <div class="modal fade" id="defaultModal3" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="defaultModalLabel">About this Course</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">This module can provide an overview of the roles and responsibilities of barangay officials, 
                              including the legal framework governing barangays and their functions within the local government system.
                            </div>
                            <form action="start-course-privacy.php" method="POST">
                            <div class="modal-footer">
                              <input type="hidden" name="priv" value="privacy">
                              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                              <button id="show-success" name="privbtn" type="submit" class="btn mb-2 btn-primary second">Start Course</button>
                            </form>
                            </div>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="card" style="height: 330px;">
                    <div class="card-body">
                      <p class="card-text"><strong>Anti-Red Tape Act Compliance for Barangay Employees</strong></p>
                      <p class="card-text">
                      <img src="../assets/images/red-tape.jpg" width="250">
                      </p>
                      <!-- Button trigger modal -->
                      <?php


// Set up the database connection based on the environment
if (ENVIRONMENT === 'local') {
    $connections = mysqli_connect("localhost", "root", "", "crms_system_db");
} else {
    $connections = mysqli_connect("localhost", "crms_admin", "+o+fm+K@pI9s5kGy", "crms_system_db");
}
                $name = $_SESSION['name'];
                $retrieve_query = mysqli_query($conn, "SELECT DISTINCT * FROM evaluation WHERE employee_name = '$name' AND course_title = 'Anti-Red Tape Act Compliance for Barangay Employees' LIMIT 1");
                        $check_rows = mysqli_num_rows($retrieve_query);
                        if($check_rows > 0){
                            while($row =mysqli_fetch_assoc($retrieve_query)){
                              $db_status = $row['status'];

                                if($db_status == "FAILED"){
                                  //ENROLL BUTTON IS ABLE IF STATUS IS NOT COMPLETED
                                    echo "<button type='button' class='btn mb-2 btn-danger' data-toggle='modal' data-target='#defaultModal4' disabled> Evaluation Failed </button>";
                                }else if($db_status == "FOR VERIFICATION"){

                                  echo "<button type='button' class='btn mb-2 btn-info' data-toggle='modal' data-target='#defaultModal4' disabled> For Verification</button>";

                                }else if($db_status == "STARTED"){

                                  echo "<button type='button' class='btn mb-2 btn-warning' data-toggle='modal' data-target='#defaultModal4'> Course Started </button>";

                                }else if($db_status == "COMPLETED"){
                                  // IF COURSE IS COMPLETED YOU CANNOT ENROLL THE COURSE AGAIN
                                  echo "<button type='button' class='btn mb-2 btn-success' data-toggle='modal' data-target='#defaultModal4' disabled> Course Completed </button>";
                                }else{
                                  //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal4'> Enroll Course </button>";
                                }
                            }
                        }else{
                          //ENROLL BUTTON IS ABLE IF NOT STARTED
                                    echo "<button type='button' class='btn mb-2 btn-primary' data-toggle='modal' data-target='#defaultModal4'> Enroll Course </button>";
                        }

                      ?>
                      <!-- Modal -->
                      <div class="modal fade" id="defaultModal4" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="defaultModalLabel">About this Course</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">This module can provide an overview of the roles and responsibilities of barangay officials, 
                              including the legal framework governing barangays and their functions within the local government system.
                            </div>
                            <form action="start-course-antired.php" method="POST">
                            <div class="modal-footer">
                              <input type="hidden" name="anti" value="antired">
                              <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
                              <button id="show-success" name="antibtn" type="submit" class="btn mb-2 btn-primary second">Start Course</button>
                            </form>
                            </div>
                          


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


               

                

      

                

               

    


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
    <script src="../js/d3.min.js"></script>
    <script src="../js/topojson.min.js"></script>
    <script src="../js/datamaps.all.min.js"></script>
    <script src="../js/datamaps-zoomto.js"></script>
    <script src="../js/datamaps.custom.js"></script>
    <script src="../js/Chart.min.js"></script>
    <script src="../js/gauge.min.js"></script>
    <script src="../js/jquery.sparkline.min.js"></script>
    <script src="../js/apexcharts.min.js"></script>
    <script src="../js/apexcharts.custom.js"></script>
    <script src='../js/jquery.mask.min.js'></script>
    <script src='../js/select2.min.js'></script>
    <script src='../js/jquery.steps.min.js'></script>
    <script src='../js/jquery.validate.min.js'></script>
    <script src='../js/jquery.timepicker.js'></script>
    <script src='../js/dropzone.min.js'></script>
    <script src='../js/uppy.min.js'></script>
    <script src='../js/quill.min.js'></script>
    <script src="../js/apps.js"></script>
    <script src="../js/preloader.js"></script>
   
    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.35.3/dist/apexcharts.min.js"></script>
 

    <script> /* THIS IS FOR DARK MODE */

      document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('theme-toggle');
    const currentTheme = localStorage.getItem('theme');

    if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        toggleButton.classList.add('active');
    }

    toggleButton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        toggleButton.classList.toggle('active');

        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});
    </script>



  
  </body>
</html>

