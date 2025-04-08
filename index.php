

<?php
//index.php
include_once 'connection.php';
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_type']){


  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM users WHERE id = '$user_id'";
  $query = $con->query($sql) or die ($con->error);
  $row = $query->fetch_assoc();
  $account_type = $row['user_type'];
  if ($account_type == 'admin') {
  echo '<script>
          window.location.href="admin/dashboard.php";
      </script>';
  
  } elseif ($account_type == 'secretary') {
      echo '<script>
          window.location.href="secretary/dashboard.php";
      </script>';
  
  } else {
      echo '<script>
      window.location.href="resident/dashboard.php";
  </script>';
  
}





}
$sql = "SELECT * FROM `barangay_information`";
  $query = $con->prepare($sql) or die ($con->error);
  $query->execute();
  $result = $query->get_result();
  while($row = $result->fetch_assoc()){
      $barangay = $row['barangay'];
      $zone = $row['zone'];
      $district = $row['district'];
      $image = $row['image'];
      $image_path = $row['image_path'];
      $id = $row['id'];
      $postal_address = $row['postal_address'];
  }

  function make_query($con){

    $sql = "SELECT * FROM carousel";
    $query = $con->query($sql) or die ($con->error);
    return $query;
  }

function make_slide_indicators($con){

    $output = ''; 
    $count = 0;
    $result = make_query($con);
    while($row = $result->fetch_assoc()) {

      if($count == 0) {
     
      $output .= '
      <li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'" class="active"></li>
      ';
     
      }else{
      
      $output .= '
      <li data-target="#carouselExampleIndicators" data-slide-to="'.$count.'"></li>
      ';
      }
      $count = $count + 1;
    }
    return $output;
}

function make_slides($con){

      $output = '';
      $count = 0;
      $result = make_query($con);
      while($row = mysqli_fetch_array($result)) {
     
      if($count == 0)  {
      
        $output .= '<div class="carousel-item active">';
        
      }else{
        
        $output .= '<div class="carousel-item">';
      }
        $output .= '
        <img class="d-block w-100" src="'.$row["banner_image_path"].'" alt="'.$row["banner_title"].'" />
          <div class="carousel-caption">
            <h3>'.$row["banner_title"].'</h3>
          </div>
        </div>
        ';
        $count = $count + 1;
      }
      return $output;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
 

  <style>
    .rightBar:hover{
      border-bottom: 3px solid red;
     
    }
    


    
    #barangay_logo{
      height: 150px;
      width:auto;
      max-width:500px;
    }

    .logo{
      height: 150px;
      width:auto;
      max-width:500px;
    }
    .content-wrapper{
      background-image: url('assets/logo/coverbg.png');
      background-repeat:no-repeat;
background-size:contain;
background-size: cover;
background-position:center;
width: 100%;
  height: auto;
        animation-name: example;
        animation-duration: 5s;
       
       
    }


@keyframes example {
  from {opacity: 0;}
  to {opacity: 1.5;}
}





  </style>


</head>
<body  class="hold-transition layout-top-nav">


<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md" style="background-color: #006400;">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="assets/logo/pob icon.png" alt="logo" class="brand-image img-circle " >
        <span class="brand-text  text-white"  style="font-weight: 700">BARANGAY POBLACION PORTAL</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->


       
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto " >
          <li class="nav-item">
            <a href="#" class="nav-link text-white rightBar" style="  border-bottom: 3px solid red;">HOME</a>
          </li>
          
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
 
    
  
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content  " >
      <div class="container-fluid pt-5">
      <div class="card "  style=" background-color: rgba(170, 214, 197, 0.75);">
      
      <div class="card-body text-center text-green">
      <h1 class="card-text" style="font-weight: 1000">WELCOME</h1>
        <img src="assets/logo/pob icon.png" alt="logo" class="img-circle logo">
        
          <h1 class="card-text" style="font-weight: 1000; text-transform: uppercase; "><?= $barangay ?> <?= $zone ?>, <?= $district ?></h1>
          <br>
          <br>
          <a href="register.php" class="btn bg-red btn-lg px-3 " style="font-weight: 900">REGISTER NOW</a>
          <a href="login.php" class="btn btn-outline-info btn-lg px-3 text-white" style="font-weight: 900; border: 2px solid #fff">LOGIN</a>
      </div>
    </div>

      </div>

  



    

    <!-- <div class="container-fluid ">
      <div class="row pt-5">
        <div class="col-sm-7">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="4000">
                    <ol class="carousel-indicators">
                    <?php echo make_slide_indicators($con); ?>
          
                    </ol>
                <div class="carousel-inner">
                <?php echo make_slides($con); ?>
                  
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-left"></i>
                  </span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-right"></i>
                  </span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

        </div>
        <div class="col-sm-5">
          <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
              <h4 class="card-title">Title</h4>
              <p class="card-text">Body</p>
            </div>
          </div>
        </div>
      </div>
            
    </div> -->
 

     
          
               
      
     
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <!-- Footer Section -->
<footer class="bg-success text-white text-center text-md-left py-4" style="background-color: #06b903;">

<div class="container">
  <!-- Footer Top Section: Links and Info -->
  <div class="row">
    
    <!-- About Us Section -->
    <div class="col-md-4 mb-4">
      <h5 class="text-white">About Us</h5>
      <p>Barangay Poblacion Web Portal serves as the official online platform to access government services, announcements, and local information for the residents of Barangay Poblacion.</p>
    </div>
    
    <!-- Contact Us Section -->
    <div class="col-md-4 mb-4">
      <h5 class="text-white">Contact Us</h5>
      <p><i class="fas fa-phone"></i> +123 456 7890</p>
      <p><i class="fas fa-envelope"></i> info@barangaypoblacion.ph</p>
      <p><i class="fas fa-map-marker-alt"></i> Barangay Poblacion, City Name</p>
    </div>
    
    <!-- Quick Links Section -->
    <div class="col-md-4 mb-4">
      <h5 class="text-white">Quick Links</h5>
      <ul class="list-unstyled">
        <li><a href="about.php" class="text-white" style="text-decoration: none;">About Us</a></li>
        <li><a href="services.php" class="text-white" style="text-decoration: none;">Our Services</a></li>
        <li><a href="privacy.php" class="text-white" style="text-decoration: none;">Privacy Policy</a></li>
        <li><a href="terms.php" class="text-white" style="text-decoration: none;">Terms of Service</a></li>
      </ul>
    </div>

  </div>

  <!-- Footer Bottom Section: Social Icons and Copyright -->
  <div class="social-icons text-center mt-3">
    <a href="#" class="text-white mx-2" style="text-decoration: none; font-size: 20px;">
      <i class="fab fa-facebook"></i>
    </a>
    <a href="#" class="text-white mx-2" style="text-decoration: none; font-size: 20px;">
      <i class="fab fa-twitter"></i>
    </a>
    <a href="#" class="text-white mx-2" style="text-decoration: none; font-size: 20px;">
      <i class="fab fa-instagram"></i>
    </a>
  </div>

  <p class="text-center mt-3" style="font-size: 14px;">&copy; 2025 Barangay Poblacion Web Portal. All Rights Reserved.</p>
</div>

</footer>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</footer>
<style>
footer {
  background-color: #06b903; /* Bright green background */
}

footer .social-icons a:hover {
  color: #ffdf00; /* Gold color on hover */
}

footer p {
  font-size: 14px;
}

footer .social-icons i {
  transition: color 0.3s ease;
}
</style>
</div>
<!-- ./wrapper -->





<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>

</body>
</html>
