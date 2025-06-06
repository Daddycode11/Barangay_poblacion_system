
<?php 
include_once 'connection.php';
session_start();

try{

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

}catch(Exception $e){
  echo $e->getMessage();
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
  <link rel="stylesheet" href="assets/plugins/sweetalert2/css/sweetalert2.min.css">
 

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
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
        height: 100%;
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
  <nav class="main-header navbar navbar-expand-md " style="background-color:rgb(0, 0, 0)">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="assets/logo/pob icon.png" alt="logo" class="brand-image img-circle " >
        <span class="brand-text  text-white" style="font-weight: 700">BARANGAY POBLACION PORTAL</span>
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
            <a href="index.php" class="nav-link text-white rightBar" >HOME</a>
          </li>
          <li class="nav-item">
            <a href="register.php" class="nav-link text-white rightBar"><i class="fas fa-user-plus"></i> REGISTER</a>
          </li>
          <li class="nav-item">
            <a href="login.php" class="nav-link text-white rightBar" ><i class="fas fa-user-alt"></i> LOGIN</a>
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
<div class="content px-4">
  <div class="container-fluid pt-5" style="background-color: rgba(0, 0, 0, 0.75); min-height: 100vh;">
    <br><br>
    <div class="row justify-content-center">
      <form id="recoverForm" method="post">
        <div class="card shadow-lg border-0" style="border-radius: 1rem; background-color: rgba(255,255,255,0.05); backdrop-filter: blur(10px);">
          <div class="card-body text-center text-white px-5 py-4">

            <!-- Logo -->
            <div class="mb-3">
              <img src="assets/LOGO/POB ICON.PNG" alt="logo" class="img-fluid" style="max-width: 90px;">
            </div>

            <!-- Heading -->
            <h1 class="mb-3" style="font-weight: 800; color:rgb(12, 216, 12); font-family: 'Segoe UI', sans-serif; letter-spacing: 1px;">FORGOT PASSWORD</h1>

            <!-- Username Input -->
            <div class="form-group">
              <div class="input-group mb-4 bg-white rounded shadow-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-transparent border-0"><i class="fas fa-user text-primary"></i></span>
                </div>
                <input type="text" id="username" name="username" class="form-control border-0" placeholder="Username or Resident Number" required>
              </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success btn-lg btn-block shadow-sm" style="border-radius: 30px; font-weight: 600;">Recover Account</button>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
<style>
  body {
    font-family: 'Poppins', sans-serif;
  }
</style>


  

       
 
  <footer class="main-footer text-white" style="background-color:rgb(0, 0, 0)">
    <div class="float-right d-none d-sm-block">
    
    </div>
  <i class="fas fa-map-marker-alt"></i> <?= $postal_address ?> 
  </footer>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


 


</div>
<!-- ./wrapper -->





<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<script src="assets/plugins/sweetalert2/js/sweetalert2.all.min.js"></script>
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
<div id="show_number"></div>

<script>
  $(document).ready(function(){



   



      $("#recoverForm").submit(function(e){
          e.preventDefault();
        var username = $("#username").val();

        $("#show_number").html('');
        
        if(username != ''){


    
          $.ajax({
            url: 'recoverAccount.php',
            type: 'POST',
            data:{username:username},
            cache: false,
            success:function(data){
              $("#show_number").html(data);
              $("#recoverModal").modal('show');

            }
          })
          
         

        }else{

          Swal.fire({
            title: '<strong class="text-warning">TYPE YOUR USERNAME</strong>',
            type: 'error',
            showConfirmButton: true,
          })

        }



      })
 


    
 



    


    


  })
</script>


</body>
</html>
