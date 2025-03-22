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

    <title>Dashboard - CRMS</title>

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
            <a class="nav-link text-muted my-2 moon-icon" href="#" id="theme-toggle" >

              <i class="fe fe-sun fe-16"></i>
              
            </a>
           
          </li>
          
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
              <a class="dropdown-item" href="../users/user-profile  "> <i class="fe fe-user"></i>&nbsp;&nbsp;&nbsp;Profile</a>
              <a class="dropdown-item" href="../users/settings  "><i class="fe fe-settings"></i>&nbsp;&nbsp;&nbsp;Settings</a>
              <a class="dropdown-item" href="../users/preferences  "><i class="fe fe-list"></i>&nbsp;&nbsp;&nbsp;Preferences</a>
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

          <ul class="navbar-nav active flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../courses/my-courses  ">
                <i class="fa-solid fa-book fe-16">&nbsp;&nbsp;</i>
              
                <span class="ml-3 item-text">My Courses</span>
              </a>
            </li>
          </ul>

          <ul class="navbar-nav flex-fill w-100 mb-2">
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




<!--  Dito and content-->


<div class="col">
      <h2 class="h5 page-title">My Courses (Compliance Program)</h2>
      <br>
</div>

        <div class="container-fluid">
          <div class="row-course justify-content-center">
            <div class="col-12">
              <!-- <h2>Section title</h2> -->
             
              
           
              <!-- info small box -->
              <div class="row-course">

                <div class="col-md-4 mb-4">
                  <div class="card-course">
                    <div class="card-body-course">
                      <div class="row align-items-center">
                        <div class="col">
                          <span style="font-size: 20px; cursor: pointer;" class="h2 mb-0"><a style="color: #1b4965"
                          href="../module/view?id=1">Understanding Compliance Requirements for Barangay Employees</a> </span>
                          <br>
                          <br>
                          <span class="badge badge-pill badge-info h5-small">All Department</span>
                        </div>
                        <div class="col-auto">
                          <span class="text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="card-course">
                    <div class="card-body-course">
                      <div class="row align-items-center">
                        <div class="col">
                          <span style="font-size: 20px; cursor: pointer;" class="h2 mb-0">Ethics and Integrity in Public Service</span>
                          <br>
                          <br>
                          <span class="badge badge-pill badge-info h5-small">All department</span>
                        </div>
                        <div class="col-auto">
                          <span class="text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-4 mb-4">
                  <div class="card-course">
                    <div class="card-body-course">
                      <div class="row align-items-center">
                        <div class="col">
                          <span style="font-size: 20px; cursor: pointer;" class="h2 mb-0">Data Privacy and Protection for Barangay Employees</span>
                          <br>
                          <br>
                          <span class="badge badge-pill badge-info h5-small">All department</span>
                        </div>
                        <div class="col-auto">
                          <span class="text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4">
                  <div class="card-course">
                    <div class="card-body-course">
                      <div class="row align-items-center">
                        <div class="col">
                          <span style="font-size: 20px; cursor: pointer;" class="h2 mb-0">Anti-Red Tape Act Compliance for Barangay Employees</span>
                          <br>
                          <br>
                          <span class="badge badge-pill badge-info h5-small">All department</span>
                        </div>
                        <div class="col-auto">
                          <span class="text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div> <!-- end section -->
             



        <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/d3.min.js"></script>
    <script src="js/topojson.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src='js/jquery.mask.min.js'></script>
    <script src='js/select2.min.js'></script>
    <script src='js/jquery.steps.min.js'></script>
    <script src='../js/dropzone.min.js'></script>
    <script src='../js/uppy.min.js'></script>
    <script src='../js/quill.min.js'></script>
    <script src="../js/apps.js"></script>
    <script src="../js/preloader.js"></script>
 

    <script>
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