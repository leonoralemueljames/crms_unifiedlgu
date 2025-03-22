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

    <title>Points Center - CRMS</title>

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
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="fe fe-message-circle fe-16"></span>
            </section>
          </li>
          <li class="nav-item nav-notif">
            <section class="nav-link text-muted my-2 circle-icon" href="#" data-toggle="#" data-target=".modal-notif">
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
              <a class="dropdown-log-out" href="https://smartbarangayconnect.com"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Back to Main Page</a>
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
              <a class="nav-link" href="../courses/course-catalog  ">
              <i class="fa-solid fa-book fe-16">&nbsp;</i>
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


          <ul class="navbar-nav active flex-fill w-100 mb-2">
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
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">BARANGAY PORTAL</span>
          </p>

        <div class="fbtn-box w-100 mt-4 mb-2">
        <li class="nav-item w-100">
            <a href="https://smartbarangayconnect.com" target="_blank" class="btn mb-4 btn-success btn-block">
              <i class="fa solid fa-user fe-16"></i>
              <span class="ml-3 item-text">Back to Main Portal</span>
            </a>
            </li>
          </div>


  

  
      
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
      <h2 class="h5 page-title">Points Center</h2>
      
      <br>
</div>
   


<div class="row ">

<div class="col-md-4">
  <div class="card mb-4">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col">
          <small class="text-muted-show mb-0">Current Points</small>
          <h3 class="card-title mb-1">
            <?php
               $conn = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($conn, "crms_system_db");
                $name = $_SESSION['name'];
              $retrieve_query = mysqli_query($conn, "SELECT DISTINCT * FROM employee_points WHERE employee_name = '$name' LIMIT 1");
                        $check_rows = mysqli_num_rows($retrieve_query);
                        if($check_rows > 0){
                          while($row =mysqli_fetch_assoc($retrieve_query)){

                            $db_points = $row['points'];


                          }
                          echo $db_points;

                        }else{
                          echo "0";
                        }


            ?>
          </h3>
          <a href="../courses/course-catalog"><p class="small mb-1"><span style="" class="badge badge-dark ">Take Courses</span></p></a>
         
        </div>
        <div class="col-4 text-right">
          <span class="sparkline "><img src="../assets/images/coin.png"  width="60"></span>
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
          <small class="text-muted-show mb-1">Redeem Vouchers</small>
          <h3 class="card-title mb-1">3</h3>
          <a href="#redeemVoucher"><p class="small mb-1"><span style="" class="badge badge-dark " 
          data-toggle="modal" data-target="#redeemVoucher">View</span></p></a>
         
        </div>
        <div class="col-4 text-right">
          <span class="sparkline"><img src="../assets/images/voucher.png" width="60"></span>
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
          <small class="text-muted-show mb-1">Redeem Incentives</small>
          <h3 class="card-title mb-1">2</h3>
          <a href="#redeemIncentives"><p class="small mb-1"><span style="" class="badge badge-dark " 
          data-toggle="modal" data-target="#redeemIncentives">View</span></p></a>
          
         
        </div>
       
        <div class="col-4 text-right">
          <span class="sparkline"><img src="../assets/images/employee-benefit.png" width="60"></span>
        </div>
      </div> <!-- /. row -->
    </div> <!-- /. card-body -->
  </div> <!-- /. card -->
</div> <!-- /. col -->
</div> <!-- end section -->
<!-- linechart -->
<hr>

<div class="col">
      <h2 class="h5 page-title">Earned Points History</h2>
      
      <br>
</div>
        
<div class="container-fluid">

         
         <div class="row align-items-center mb-3 border-bottom no-gutters">
              
                  <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Table list</a>
                    </li>
                   
                
                  </ul>
                </div>
               
              </div>
              <table class="table table-borderless table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th class="w-50">Title</th>
                    <th>Points</th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>


                    <?php
                      $conn = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($conn, "crms_system_db");

                    $name = $_SESSION['name'];

                    $retrieve_query = mysqli_query($conn, "SELECT * FROM evaluation WHERE employee_name = '$name' AND status = 'COMPLETED'");
                        $check_rows = mysqli_num_rows($retrieve_query);
                        if($check_rows > 0){
                            
                            while($row =mysqli_fetch_assoc($retrieve_query)){

                                  $db_course = $row['course_title'];
                                  $db_status = $row['status'];

                                  if($db_course == "Understanding Compliance Requirements for Barangay Employees"){
                          $points = 500;
                        }else if($db_course == "Ethics and Integrity in Public Service"){
                          $points = 1000;
                        }else if($db_course == "Data Privacy and Protection for Barangay Employees"){
                          $points = 1000;
                        }else if($db_course == "Anti-Red Tape Act Compliance for Barangay Employees"){
                          $points = 2000;
                        }
                                echo "
                                <tr>
                    <td class='text-center'>
                      <div class='circle circle-sm bg-light'>
                        <span class='ml-1 text-muted'><img src='../assets/images/voucher.png' width='25'></span>
                      </div>
                      <span class='dot dot-md bg-info mr-1'></span>
                    </td>
                    <th scope='row'>$db_course<br/>
                      
                      <span class='badge alert-warning h5-small'>$db_status</span>
                    </th>

                    <th scope='row'>
                    <span><img src='../assets/images/coin.png' width='15'></span>
                    <span class='badge h5-small'>$points</span>           
                   </th>

                    <td class='h5-small'><a href='#getVoucher'><p class='large mb-1'>
                      <span data-toggle='modal' data-target='#getVoucher' class='badge alert-info' >View</span></p></a></td>
                    <td></td>
                  </tr>

                                ";

                            }

                        }

                    ?>

                  

                
                  
                </tbody>
              </table>
            </div>

</div>
</div>

</div>


<div id="getVoucher" class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-sm modal-dialog-centered'> 
           <div class='modal-content'> 
           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Confirm Voucher Retrieval</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 
           <div class='modal-body text-center p-10'> 
            <img src="../assets/images/voucher.png" width="100">
            <br>
           <p class='font-weight-bold mb-4'>Are you sure you want to retrieve this voucher? Please review 
            the details below before proceeding.</p> 
          
           <form action='' method='post'> 
           
           <div class='d-flex justify-content-center mt-5'> 
           <button type='submit' class='btn btn-primary btn-lg mr-1' formaction="../points/points-center">Get Voucher</button> 
           <button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Cancel</button> 
           </div> 
           </form> 
           </div> 
           </div> 
           </div> 
           </div> 

           

  
           <div id="redeemVoucher" class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-xl modal-dialog-centered'> 
           <div class='modal-content'> 
           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Redeem Voucher History</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 
           <div class='modal-body text-center p-10'> 
           <p class='font-weight-bold mb-4'>
           <table class="table table-borderless table-striped">
   
                <tbody>

                  <tr>
                    <td class="text-center">
                      <div class="circle circle-sm bg-light">
                        <span class="ml-1 text-muted"><img src="../assets/images/voucher.png" width="25"></span>
                      </div>
                      <span class="dot dot-md bg-danger mr-1"></span>
                    </td>
                    <th scope="row">Compliance Champion Voucher<br/>
                      <span class="badge badge-light h5-small">₱1,000 cash bonus</span>
                      <span class="badge alert-warning h5-small">Limited Time Only</span>
                    </th>

                    <th scope="row">
                    <span><img src="../assets/images/minus.png" width="15"></span>
                    <span class="badge h5-small">1000</span>           
                   </th>

                    <td class="h5-small"><a href=""><p class="large mb-1">
                      <span data-toggle="modal" data-target="#getVoucher" class="badge alert-info " >Received</span></p></a></td>
                    <td></td>
                  </tr>


                  <tr>
                    <td class="text-center">
                      <div class="circle circle-sm bg-light">
                      <span class="ml-1 text-muted"><img src="../assets/images/voucher.png" width="25"></span>
                      </div>
                      <span class="dot dot-md bg-danger mr-1"></span>
                    </td>
                    <th scope="row">Local Business Support Voucher<br />
                      <span class="badge badge-light h5-small mr-2">₱500 gift certificate</span>
                      
                    </th>
                    
                    <th scope="row">
                    <span><img src="../assets/images/minus.png" width="15"></span>
                    <span class="badge h5-small">&nbsp;500</span>           
                   </th>

                   <td class="h5-small"><a href=""><p class="large mb-1">
                      <span data-toggle="modal" data-target="#getVoucher" class="badge alert-info " >Received</span></p></a></td>
                    <td></td>
                  </tr>

                  </tr>

                               <tr>
                    <td class="text-center">
                      <div class="circle circle-sm bg-light">
                        <span class="ml-1 text-muted"><img src="../assets/images/voucher.png" width="25"></span>
                      </div>
                      <span class="dot dot-md bg-danger mr-1"></span>
                    </td>
                    <th scope="row">Retirement Benefits<br />
                      <span class="badge badge-light h5-small mr-2">A retirement plan scheme can encourage long-term commitment </span>
                      
                    </th>

                    <th scope="row">
                    <span><img src="../assets/images/minus.png" width="15"></span>
                    <span class="badge h5-small">&nbsp;200</span>           
                   </th>

                    <td class="h5-small"><a href=""><p class="large mb-1">
                      <span data-toggle="modal" data-target="#getVoucher" class="badge alert-info " >Received</span></p></a></td>
                    <td></td>
                  </tr>

                  
                 
                </tbody>
              </table>
          
         
    
           
           </div> 
           </form> 
           </div> 
           </div> 
           </div> 
           </div>



           <div id="getVoucher" class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-sm modal-dialog-centered'> 
           <div class='modal-content'> 
           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Start Quiz</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 
           <div class='modal-body text-center p-10'> 
           <p class='font-weight-bold mb-4'>Are you sure you want to finish the quiz? 
            Once you finish the quiz, your answers will be submitted, and you will not be able to go back to change them.</p> 
           <p class='text-muted'>If you are ready to submit your answers, please confirm your choice.</p> 
           <form action='' method='post'> 
           
           <div class='d-flex justify-content-center mt-5'> 
           <button type='submit' class='btn btn-primary btn-lg mr-1' formaction="../points/points-center">Get Voucher</button> 
           <button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Cancel</button> 
           </div> 
           </form> 
           </div> 
           </div> 
           </div> 
           </div> 

           

  
           <div id="redeemIncentives" class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-xl modal-dialog-centered'> 
           <div class='modal-content'> 
           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Redeem Incentives History</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 
           <div class='modal-body text-center p-10'> 
           <p class='font-weight-bold mb-4'>
           <table class="table table-borderless table-striped">
   
                <tbody>

                  <tr>
                    <td class="text-center">
                      <div class="circle circle-sm bg-light">
                        <span class="ml-1 text-muted"><img src="../assets/images/employee-benefit.png" width="25"></span>
                      </div>
                      <span class="dot dot-md bg-danger mr-1"></span>
                    </td>
                    <th scope="row">Performance-Based Leave Incentives<br/>
                      <span class="badge badge-light h5-small">Granting additional leave days</span>
                     
                    </th>

                    <th scope="row">
                    <span><img src="../assets/images/minus.png" width="15"></span>
                    <span class="badge h5-small">2000</span>           
                   </th>

                    <td class="h5-small"><a href=""><p class="large mb-1">
                      <span data-toggle="modal" data-target="#getVoucher" class="badge alert-info " >Received</span></p></a></td>
                    <td></td>
                  </tr>




                  
                 
                </tbody>
              </table>
          
          
         
    
           
           </div> 
           </form> 
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

  <style>
    /* Hero Styles */

/* Global Styles */


/* Hero Styles */

/* Global Styles */

/* Hero Styles */

.hero {
  background-color: #f7f7f;
  padding: 20px;
  text-align: center;
  background-image: linear-gradient(to bottom, #f7f7f7, #fff);
  background-size: 100% 200px;
  background-position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.hero h1 {
  font-size: 36px;
  margin-bottom: 10px;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.hero p {
  font-size: 18px;
  margin-bottom: 20px;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.hero button {
  background-color: #333;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s ease;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.hero button:hover {
  background-color: #555;
}

/* Compliance Points System Styles */

.compliance-points-system {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin: 20px auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: linear-gradient(to bottom, #fff, #f7f7f7);
  background-size: 100% 200px;
  background-position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.compliance-points-system h2 {
  font-size: 24px;
  margin-bottom: 10px;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.compliance-points-system .card {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-bottom: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: linear-gradient(to bottom, #fff, #f7f7f7);
  background-size: 100% 200px;
  background-position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.compliance-points-system .card .card-header {
  background-color: #f7f7f7;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.compliance-points-system .card .card-body {
  padding: 20px;
}

.compliance-points-system .card .card-body .table {
  border-collapse: collapse;
  width: 100%;
}

.compliance-points-system .card .card-body .table th, .compliance-points-system .card .card-body .table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

.compliance-points-system .card .card-body .table th {
  background-color: #f7f7f7;
}

/* Redeeming Points Styles */

.redeeming-points {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin: 20px auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: linear-gradient(to bottom, #fff, #f7f7f7);
  background-size: 100% 200px;
  background-position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.redeeming-points h2 {
  font-size: 24px;
  margin-bottom: 10px;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.redeeming-points .card {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-bottom: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: linear-gradient(to bottom, #fff, #f7f7f7);
  background-size: 100% 200px;
  background  -position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.redeeming-points .card .card-header {
  background-color: #f7f7f7;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.redeeming-points .card .card-body {
  padding: 20px;
}

.redeeming-points .card .card-body .table {
  border-collapse: collapse;
  width: 100%;
}

.redeeming-points .card .card-body .table th, .redeeming-points .card .card-body .table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
}

.redeeming-points .card .card-body .table th {
  background-color: #f7f7f7;
}

/* Leaderboard Styles */

.leaderboard {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin: 20px auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: linear-gradient(to bottom, #fff, #f7f7f7);
  background-size: 100% 200px;
  background-position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.leaderboard h2 {
  font-size: 24px;
  margin-bottom: 10px;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.leaderboard-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.leaderboard-card {
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  background-image: linear-gradient(to bottom, #fff, #f7f7f7);
  background-size: 100% 200px;
  background-position: 0% 100%;
  animation: gradient 10s ease infinite;
}

.leaderboard-card h3 {
  font-size: 18px;
  margin-bottom: 10px;
  font-weight: bold;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.leaderboard-card p {
  font-size: 16px;
  margin-bottom: 10px;
  text-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Responsive Design */

@media (max-width: 768px) {
  .search-bar {
    width: 80%;
  }
}

@media (max-width: 480px) {
  .search-bar {
    width: 90%;
  }
  .compliance-points-system .card {
    margin-bottom: 10px;
  }
  .redeeming-points .card {
    margin-bottom: 10px;
  }
  .leaderboard-card {
    margin: 10px;
  }
}
    </style>
</html>

