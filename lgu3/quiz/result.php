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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/fontawesome.min.css">
    <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../css/feather.css">
    
    <!-- App CSS -->
    <link rel="stylesheet" href="../css/main.css">   


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



.container {
  width: 95%;
  max-width: 64rem;
  background: #fff;
  padding: 0.8rem;
  border-radius: 1rem; 
  overflow: auto; 
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  
  display: grid;
  gap: 1rem;
  grid-template-columns: 2fr 2fr 1.5fr;
  grid-template-rows: 0.1fr 2fr 1fr;
  grid-template-areas:
    "quiz-title quiz-title quiz-title"
    "question-section question-section questions-nav-section"
    "explanation-section explanation-section questions-nav-section"; 
}

.quiz-title {
  grid-area: quiz-title;
  font-weight: 800;
  font-size: 1rem; 
  text-align: center;
  margin-bottom: 1rem; 
}

.question-section {
  grid-area: question-section
}

.question {
  padding: 0.5rem;
  border: 2px solid #799efe;
  border-radius: 0.5rem;
  margin-bottom: 1rem;
  
}

.question .question-text {
  margin-bottom: 0.5rem;
}

.question .question-num {
  font-weight: 700; 
  font-size: 0.9rem;
  margin-bottom: 1rem; 
}

.answer-item {
  padding: 1rem 0;
  display:block;
  box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
  border-radius: 0.5rem;
  margin-bottom: 0.5rem;
  cursor: pointer;
}

.answer-item.checked {
  background: #aabdff;
  color: #fff;
}

.answer-item.wrong {
  background: #da4955;
  color: #fff;
}

.answer-item span {
  margin-left: 2rem;
}

.answer-item:hover,
.answer-item:active {
  background: #aabdff;
  color: #fff;
}

.answer-item input[type="radio"] {
  display: none;
} 

.action {
  margin-top: 1rem;
  margin-bottom: 1rem;
  text-align: center;
}

.btn {
  background: inherit;
  border: 0;
  border-radius: 0.5rem; 
  box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
  padding: 0.5rem 1rem;
  margin-bottom: -3rem;
  font-weight: 700;
  cursor: pointer;
}

.btn:hover,
.btn:active { 
  background: #1b4965;
  color: #fff;
} 

.explanation-section {
  grid-area: explanation-section;
  padding: 0.5rem; 
  border-radius: 0.5rem;
  box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
}

.explanation-section .section-title {
  font-weight: 700;
  font-size: 0.9rem;
  margin-bottom: 1rem; 
} 

.explanation-section .explanation-text {
  margin-right: 1rem;
  margin-left: 1rem;
  margin-bottom: 1.5rem;
}

.questions-nav-section {
  grid-area: questions-nav-section;
  padding: 1rem;
  box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
  border-radius: 0.5rem;
}

.questions-nav-section .question-nums-list {
  /* max-width: 100%; */
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-auto-rows: minmax(0, 1fr);
  gap: 10px;
  list-style: none;
  padding: 0;
  margin: 0;  
} 

.questions-nav-section .question-nums-list a {
  text-decoration: none;
  color: inherit;
  padding: 0.5rem; 
  background: #c4c4c4 ;
  border-radius: 50%;
  display: inline-block;
  width: 2.5rem; 
  height: 2.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  color: #fff;
} 

.questions-nav-section .question-nums-list a.done { 
  background: #aabdff;
}

.questions-nav-section .question-nums-list a.active { 
  background: #ffaaaf;
}

.question-context {
  margin-bottom: 2rem;
  display: flex;
  justify-content: space-between;
}

.question-context a { 
  font-weight: 700;
  font-size: 0.9rem;
  text-decoration: none;
  color: inherit;
}


.d-flex {
  display: flex;
  justify-content: center;
  width: 100%; 
} 
 
@media(max-width: 50rem) {
  .container {   
    grid-template-rows: 0.1fr 1fr 1fr;
    border-radius: 0;
    position: static;
    height: 100vh;
    width: 100%; 
    top: 0%;
    left: 0%;
    transform: translate(0%, 0%);  
   }
} 

@media (max-width: 38rem) {
  .container {
    position: static;
    width: 100%;
    padding: 0.8rem;
    border-radius: 0;
    top: 0%;
    left: 0%;
    transform: translate(0%, 0%);

    grid-template-columns: 1fr;
    grid-template-rows: 0.1fr 1fr 1fr auto;
    grid-template-areas:
      "quiz-title"
      "questions-nav-section"
      "question-section"
      "explanation-section";
  }
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
          <span style="font-size: 10.5px; font-weight: bold; font-family: 'Inter', sans-serif;">MAIN</span>
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

          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../courses/course-catalog  ">
              <i class="fa-solid fa-folder-tree fe-16">&nbsp;</i>
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


   




      <!--CONTENT NA HERE-->


      <div class="col-12">
              <h2 class="h3 mb-0 page-title">Evaluation Result</h2>
              <div class="row align-items-center my-4">
                <div class="col-md-6">
                  <div id="chart-box">
                  <div id="pie-chart"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row align-items-center my-2">
                    <div class="col">
                      
                      <p class="h5">Title: Introduction to Local Governance</p>
                      <strong>Remarks</strong><br / />
                      <span class="my-0 text-muted small">100</span>
                    </div>
                    <div class="col-auto">
                      <strong class="my-0">100</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong>Items</strong><br / />
                      <span class="my-0 text-muted small">5</span>
                    </div>
                    <div class="col-auto">
                      <strong>5</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong>Points Earned</strong>
                      <div class="my-0 text-muted small">25</div>
                    </div>
                    <div class="col-auto">
                      <strong>25</strong>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                  <div class="row align-items-center my-2">
                    <div class="col">
                      <strong>Status</strong>
                      <div class="my-0 text-muted small">Done</div>
                    </div>
                    <div class="col-3">
                      <div class="progress" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Done</div>
                      </div>
                    </div>
                  </div>





<script>
    const getChartOptions = () => {
    return {
        series: [5],
        colors: ["#16BDCA"],
        chart: {
            height: 420,
            width: "100%",
            type: "pie",
        },
        stroke: {
            colors: ["white"],
        },
        plotOptions: {
            pie: {
                labels: {
                    show: true,
                },
                size: "100%",
                dataLabels: {
                    offset: -25
                }
            },
        },
        labels: ["Correct Answer", "Wrong Answer"],
        dataLabels: {
            enabled: true,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
    }
}

if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
    chart.render();
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



    </script>



  
  </body>


</html>

