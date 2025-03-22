<?php
include('../session/check_session.php');
    $name = $_SESSION["fullname"];
$course = $_SESSION["course"];

$fullname1 = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Guest';
$fullname = strtoupper($fullname1);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6">
    <style>
        table {
            width: 100%;
        }
        footer {
            text-align: center;
            font-style: italic;
        }
        /* Container holding the image and the text */
.container {
  position: relative;
  text-align: center;
  color: white;
}

/* Bottom left text */
.bottom-left {
  position: absolute;
  bottom: 180px;
  left: 118px;
}

/* Top left text */
.top-left {
  position: absolute;
  bottom: 70px;
  left: 120px;
}

.top-left1 {
  position: absolute;
  bottom: -20px;
  left: 40px;
}
/* Top right text */
.top-right {
  position: absolute;
  bottom: 70px;
  left: 450px;
}

.top-right1 {
  position: absolute;
  bottom: 75px;
  left: 430px;
}

/* Bottom right text */
.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

/* Centered text */
.centered {
  position: absolute;
  top: 45%;
  left: 20%;
  transform: translate(-25%, -50%);
  
}

    </style>
</head>
<body>
    <div>
    <img class="centered1" src="certificate.png" height="700" width="1030">
</div>
    <div class="centered" style="text-align: left;"><h1 style="color: #004f98; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif
    ; text-align: left;"><?php echo $fullname; ?></h1></div>
    <div class="bottom-left">
        <p style="font-size: 20px;">
            For successfully completing the 
            <br><strong>"<?php  echo $course;   ?>"</strong>
            <br>
            conducted by UNIFIED LGU. This comprehensive program provided the
            <br>
            participants with a deep understanding of the essential frameworks,
            <br>
            regulations, and best practices
            necessary for effective compliance
            <br> management within local governance and
            community development.
    </p></div>
  <div class="top-left"><h2 style="color: #00416a;">Lorem Ipsum</h2></div>
  <div class="top-left1"><img src="sig1.png" alt="" height="300"></div>
  <div class="top-right"><h2 style="color: #00416a;">Jane Doe</h2></div>
  <div class="top-right1"><img src="sig2.png" alt="" height="80"></div>


    
</body>
</html>