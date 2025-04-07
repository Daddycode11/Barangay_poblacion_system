
<?php 

include_once '../connection.php';
session_start();


try{
  if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'resident'){

    $user_id = $_SESSION['user_id'];
    $sql_user = "SELECT * FROM `users` WHERE `id` = ? ";
    $stmt_user = $con->prepare($sql_user) or die ($con->error);
    $stmt_user->bind_param('s',$user_id);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $row_user = $result_user->fetch_assoc();
    $username = $row_user['username'];
    $old_password = $row_user['password'];
    $first_name_user = $row_user['first_name'];
    $last_name_user = $row_user['last_name'];
    $user_type = $row_user['user_type'];
    $user_image = $row_user['image'];


    $sql_resident = "SELECT * FROM residence_information WHERE residence_id = '$user_id'";
    $query_resident = $con->query($sql_resident) or die ($con->error);
    $row_resident = $query_resident->fetch_assoc();


    if($row_resident['image'] != ''){
      $iamge_resident = '<img src="'.$row_resident['image_path'].'" alt="resident Image" id="residentImage">';
    }else{
      $iamge_resident = '<img src="../assets/dist/img/blank_image.png" alt="resident Image" id="residentImage">';
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


  }else{
   echo '<script>
          window.location.href = "../login.php";
        </script>';
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
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/plugins/sweetalert2/css/sweetalert2.min.css">

  <style>
    .rightBar:hover{
      border-bottom: 3px solid red;
     
    }
    


    
    #barangay_logo{
      height: 150px;
      width:auto;
      max-width:500px;
    }
    #residentImage{ 
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
      background-image: url('../assets/logo/coverbg.png');
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
<body class="hold-transition layout-top-nav">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md " style="background-color:rgb(3, 3, 3)">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="../assets/logo/pob icon.png" alt="logo" class="brand-image img-circle " >
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
            <a href="dashboard.php" class="nav-link text-white rightBar" ><i class="fas fa-home"></i> DASHOBARD</a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link text-white rightBar" style="text-transform:uppercase; border-bottom: 3px solid red;"><i class="fas fa-user-alt"></i> <?= $last_name_user ?>-<?= $user_id ?></a>
          </li>
          <li class="nav-item">
            <a href="../logout.php" class="nav-link text-white rightBar" style="text-transform:uppercase;"><i class="fas fa-sign-out-alt"></i> Logout</a>
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
<div class="content">
  <div class="container-fluid pt-5" style="background-color: rgba(0, 0, 0, 0.75); min-height: 100vh;">
    <br><br>
    <div class="row justify-content-center">
      <form id="changeProfile" method="post">
        <div class="card shadow-lg" style="border: 5px solid rgba(0, 175, 0, 0.75); border-radius: 1rem; background-color: rgba(255,255,255,0.05); backdrop-filter: blur(8px);">
          <div class="card-body text-white px-5 py-4">

            <!-- Profile Image -->
            <div class="col-sm-12 text-center mb-3">
              <?= $iamge_resident ?>
            </div>

            <!-- Resident ID -->
            <div class="col-sm-12 text-center mb-4">
              <h5 class="text-uppercase font-weight-bold" style="color: #0ecb37; font-family: 'Poppins', sans-serif;">
                RESIDENT NUMBER - <?= $user_id; ?>
              </h5>
            </div>

            <!-- Username Field -->
            <div class="form-group">
              <div class="input-group mb-3 bg-white rounded shadow-sm">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-transparent border-0"><i class="fas fa-user text-success"></i></span>
                </div>
                <input type="text" id="username" name="username" class="form-control border-0" placeholder="USERNAME" value="<?= $username ?>" required>
              </div>
            </div>

            <!-- Old Password -->
            <div class="form-group">
              <div class="input-group mb-3 bg-white rounded shadow-sm" id="show_hide_password_old">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-transparent border-0"><i class="fas fa-key text-danger"></i></span>
                </div>
                <input type="password" id="old_password" name="old_password" class="form-control border-0" placeholder="OLD PASSWORD" required>
                <div class="input-group-append">
                  <span class="input-group-text bg-transparent border-0"><a href="#"><i class="fas fa-eye-slash text-muted"></i></a></span>
                </div>
              </div>
            </div>

            <!-- New Password -->
            <div class="form-group">
              <div class="input-group mb-3 bg-white rounded shadow-sm" id="show_hide_password">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-transparent border-0"><i class="fas fa-key text-warning"></i></span>
                </div>
                <input type="password" id="new_password" name="new_password" class="form-control border-0" placeholder="NEW PASSWORD" required>
                <div class="input-group-append">
                  <span class="input-group-text bg-transparent border-0"><a href="#"><i class="fas fa-eye-slash text-muted"></i></a></span>
                </div>
              </div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
              <div class="input-group mb-4 bg-white rounded shadow-sm" id="show_hide_password_confirm">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-transparent border-0"><i class="fas fa-key text-info"></i></span>
                </div>
                <input type="password" id="edit_confirm_password" name="edit_confirm_password" class="form-control border-0" placeholder="CONFIRM PASSWORD" required>
                <div class="input-group-append">
                  <span class="input-group-text bg-transparent border-0"><a href="#"><i class="fas fa-eye-slash text-muted"></i></a></span>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
              <button type="submit" class="btn btn-success btn-lg btn-block font-weight-bold shadow-sm" style="border-radius: 30px;">CHANGE PROFILE</button>
            </div>
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
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<script src="../assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="../assets/plugins/sweetalert2/js/sweetalert2.all.min.js"></script>


<script>

  $(document).ready(function(){

    
 $(function () {
        $.validator.setDefaults({
          submitHandler: function (form) {

              var newPassword = $("#new_password").val();
              var edit_confirm_password = $("#edit_confirm_password").val();

              if(newPassword != edit_confirm_password){


                  
                        Swal.fire({
                            title: '<strong class="text-danger">ERROR</strong>',
                            type: 'error',
                            html: '<b>NEW PASSWORD AND CONFIRM PASSWORD NOT MATCH<b>',
                            width: '400px',
                            confirmButtonColor: '#6610f2',
                          })



              }else{


                $.ajax({
                    url: 'changeProfile.php',
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success:function(data){

                      if(data == 'error1'){
                          Swal.fire({
                            title: '<strong class="text-danger">ERROR</strong>',
                            type: 'error',
                            html: '<b>Username is Already Exist<b>',
                            width: '400px',
                            confirmButtonColor: '#6610f2',
                          })
                      }else if(data == 'error2'){

                        Swal.fire({
                            title: '<strong class="text-danger">ERROR</strong>',
                            type: 'error',
                            html: '<b>OLD PASSWORD IS WORNG<b>',
                            width: '400px',
                            confirmButtonColor: '#6610f2',
                          })

                      }else{
                        
                        Swal.fire({
                          title: '<strong class="text-success">SUCCESS</strong>',
                          type: 'success',
                          html: '<b>Updated Account has Successfully<b>',
                          width: '400px',
                          confirmButtonColor: '#6610f2',
                          allowOutsideClick: false,
                          showConfirmButton: false,
                          timer: 2000,
                        }).then(()=>{
                          $("#old_password").val('');
                          $("#new_password").val('');
                          $("#edit_confirm_password").val('');
                          
                       

                        })
                        

                      
                      }
                      
                    }
                }).fail(function(){
                    Swal.fire({
                      title: '<strong class="text-danger">Ooppss..</strong>',
                      type: 'error',
                      html: '<b>Something went wrong with ajax !<b>',
                      width: '400px',
                      confirmButtonColor: '#6610f2',
                    })
                })

              }

               

           
          }
        });
      $('#changeProfile').validate({
  
        rules: {
          username: {
            required: true,
            minlength: 6
          },
          old_password: {
            required: true,
         
          },
          new_password: {
            minlength: 6
         
          },
         
        
        
        },
        messages: {
          username: {
            required: "This Field is required",
            minlength: "Username must be at least 6 characters long"
          },
          old_password: {
            required: "This Field is required",
        
          },
          new_password: {
            minlength: "Minimum Characters 6",
        
          },
        
         
          
            
        },
   
     
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
      
      });
      
    })
    
   
$("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
    $("#show_hide_password_confirm a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password_confirm input').attr("type") == "text"){
            $('#show_hide_password_confirm input').attr('type', 'password');
            $('#show_hide_password_confirm i').addClass( "fa-eye-slash" );
            $('#show_hide_password_confirm i').removeClass( "fa-eye" );
        }else if($('#show_hide_password_confirm input').attr("type") == "password"){
            $('#show_hide_password_confirm input').attr('type', 'text');
            $('#show_hide_password_confirm i').removeClass( "fa-eye-slash" );
            $('#show_hide_password_confirm i').addClass( "fa-eye" );
        }
    });
    $("#show_hide_password_old a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password_old input').attr("type") == "text"){
            $('#show_hide_password_old input').attr('type', 'password');
            $('#show_hide_password_old i').addClass( "fa-eye-slash" );
            $('#show_hide_password_old i').removeClass( "fa-eye" );
        }else if($('#show_hide_password_old input').attr("type") == "password"){
            $('#show_hide_password_old input').attr('type', 'text');
            $('#show_hide_password_old i').removeClass( "fa-eye-slash" );
            $('#show_hide_password_old i').addClass( "fa-eye" );
        }
    });
  })
</script>


</body>
</html>
