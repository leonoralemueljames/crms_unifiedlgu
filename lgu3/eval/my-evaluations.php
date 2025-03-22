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

    <title>My Evaluations - CRMS</title>

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
              <a class="dropdown-log-out" href="#"><i class="fe fe-log-out"></i>&nbsp;&nbsp;&nbsp;Main Page</a>
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

          <ul class="navbar-nav active flex-fill w-100 mb-2">
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



  




      <!--CONTENT NA HERE-->

 <div class="col">
      <h2 class="h5 page-title">My Evaluations</h2>
      
      <br>
    </div>



<?php



        $connections = mysqli_connect("localhost","root","","crms_system_db");

        $fullname = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
        

        $retrieve_query = mysqli_query($conn, "SELECT * FROM evaluation WHERE employee_name = '$fullname'");
       $check_rows = mysqli_num_rows($retrieve_query);

    

       if($check_rows > 0){
          //then display the started/ ongoing courses
        while($row = mysqli_fetch_assoc($retrieve_query)) {
            $db_id = $row['id'];
            $db_course = $row["course_title"];
            $db_status = $row["status"];
            $db_started = $row["datetime_started"];

            echo "
            <div class='container-fluid'>
            <div class='row justify'>

            <div class='col-md-4 mb-4'>
                  <div class='card' style='height: 150px;'>
                    <div class='card-body'>
                      <p class='card-title'><strong>$db_course</strong></p>
                      <p class='card-text'>$db_started</p>
                      <!-- Button trigger modal -->
                        ";
if($db_status == "STARTED"){
  echo"<b>Status:</b> ";
          echo "<button class='btn btn-primary' data-toggle='modal' data-target='#quizModal$db_id'>Upload File Score</button>";
        }else if($db_status == "FOR VERIFICATION"){
          echo "<button class='btn btn-primary' disabled>Waiting for Verification</button>";
        }
        else if($db_status == "COMPLETED"){
          echo"<b>Status:</b> ";
          echo "<button class='btn btn-success' data-toggle='modal' data-target='#certificateModal$db_id'>View Certificate</button>";
        }
        else if($db_status == "FAILED"){
          echo"<b>Status:</b> ";
          echo "<button class='btn btn-danger'>COURSE FAILED</button>";
        }

         ?>

         
         <?php
        
        echo"               
                     
     
      

            <div id='quizModal$db_id' class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-sm modal-dialog-centered'> 
           <div class='modal-content'> 
           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Take Action</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 
           <div class='modal-body text-center p-4'> 
            <form action='' method='post' enctype='multipart/form-data'> 
           <p class='font-weight-bold mb-4'>If you have completed the course, you may upload the screenshot of your course completion here for admin review</p> 
           <input type='file' name='image'>
           
           
           <div class='d-flex justify-content-center mt-4'> 
           <button type='submit' name='submit' class='btn btn-primary btn-lg mr-1'>Upload File</button> 
           <button type='button' class='btn btn-secondary btn-lg' data-dismiss='modal'>Cancel</button> 
           </div> 
           </form> 


           </div> 
           </div> 
           </div> 
           </div> 

           <div id='certificateModal$db_id' class='modal fade' role='dialog'> 
           <div class='modal-dialog modal-xl modal-dialog-centered'> 
           <div class='modal-content'> 

           <div class='modal-header'> 
           <h5 class='modal-title text-muted'>Here's your certificate</h5> 
           <button type='button' class='close' data-dismiss='modal'>&times;</button> 
           </div> 

           <div class='modal-body text-center p-4'> 

           <span class='ml-1 text-muted'><img src='../assets/images/certificate.png' width='60%'></span>
           
           <div class='d-flex justify-content-center mt-4'> 
           <button type='submit' class='btn btn-primary btn-lg mr-1'>Download</button> 
           </div> 

           </form> 
           </div>

           </div>

           </div> 
           </div>
         </div>


                          
                          </div>
                        </div>
            
                    

         
        

      ";
            if(isset($_POST['submit'])) {
    
    $fileName = $_FILES["image"]["name"];
    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = array("jpg", "jpeg", "png", "gif");
    $tempName = $_FILES["image"]["tmp_name"];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . "/crmslgu3/uploads/" . $fileName;
    if(in_array($ext, $allowedTypes)){
        if(move_uploaded_file($tempName, $targetPath)){
            $query = "UPDATE evaluation SET status='FOR VERIFICATION', course_file ='$fileName' WHERE employee_name ='$fullname'";

            $query_exec = mysqli_query($conn,$query);

                echo "<script language='javascript'>alert('Uploaded Successfully. Please wait for verification.')</script>";
                echo "<script>window.location.href='my-evaluations.php';</script>";
            }else{
                echo "Something is wrong";
            }
        }

       }
     }
   }

                      
  



?>
      
      



    






  
<script>
  // script.js
document.getElementById('openModal').onclick = function() {
    document.getElementById('certificateModal').style.display = "block";
}

document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('certificateModal').style.display = "none";
}

window.onclick = function(event) {
    if (event.target == document.getElementById('certificateModal')) {
        document.getElementById('certificateModal').style.display = "none";
    }
}
  </script>

    
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

  
// Update the rating
$('.course').each(function() {
  var progress = $(this).find('.progress').width() / $(this).find('.progress-bar').width() * 100;
  var rating = $(this).find('.rating');
  if (progress < 20) {
    rating.text('');
  } else if (progress < 60) {
    rating.text('');
  } else {
    rating.text('');
  }
});

// Simulate AI-powered evaluation
setInterval(function() {
  $('.course').each(function() {
    var progress = $(this).find('.progress').width() / $(this).find('.progress-bar').width() * 100;
    var rating = $(this).find('.rating');
    if (progress < 20) {
      rating.text('');
    } else if (progress < 60) {
      rating.text('');
    } else {
      rating.text('');
    }
    // Simulate progress update
    var newProgress = progress + Math.random() * 10;
    if (newProgress > 100) {
      newProgress = 100;
    }
    $(this).find('.progress').width(newProgress + '%');
  });
}, 1000);

    </script>



  
  </body>

  <style>

.my-evaluation {
  background-color: #e1e7ff;
  padding: 30px;
  border-radius: 10px;
  
}

.my-evaluation h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
  color: #000;
}

.evaluation-section {
  margin-bottom: 40px;
}

.evaluation-section h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #1b4965;
}

.evaluation-section h3 i {
  margin-right: 10px;
}

.course-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.course {
  width: 500px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  background-color: #f0f0f0;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
}

.course h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #040404;
}

.progress-container {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.progress-bar {
  width: 120%;
  height: 10px;
  background-color: #ddd;
  border-radius: 5px;
  margin-right: 10px;
}

.progress {
  width: 00px;
  height: 10px;
  background-color: #337ab7;
  border-radius: 5px;
}

.rating {
  font-size: 24px;
  color: #337ab7;
}

.rating.😐 {
  color: #666;
}

.rating.😊 {
  color: #337ab7;
}

.rating.😔 {
  color: #f00;
}

.reward-button {
  background-color: green;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.take-quiz-button {
  background-color: #1b4965;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.continue-button {
  background-color: orange;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.evaluation-history {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.history-item {
  width: 200px;
  margin: 20px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #f0f0f0;
}

.history-item h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
  color: #1b4965;
}

.history-item i {
  font-size: 24px;
  color: #1b4965;
  margin-top: 10px;
}

.evaluation-status {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  color: #1b4965;
 

}

.status-item {
  width: 200px;
  margin: 20px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #f0f0f0;

  
}

.status-item h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.status-item i {
  font-size: 24px;
  color: #337ab7;
  margin-top: 10px;
}

.regulatory-requirements {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.requirement-item {
  width: 200px;
  margin: 20px;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #f0f0f0;

}

.requirement-item h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.requirement-item i {
  font-size: 24px;
  color: #337ab7;
  margin-top: 10px;
}

@media only screen and (max-width: 768px) {
  .course {
    width: 500px;
  }
}

@media only screen and (max-width: 480px) {
  .course {
    width: 500px;
  }
}
    width: 
    </style>
</html>

