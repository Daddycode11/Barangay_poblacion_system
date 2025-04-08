

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
  <link rel="stylesheet" href="assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <link rel="stylesheet" href="assets/plugins/phone code/intlTelInput.min.css">
  <link rel="stylesheet" href="assets/plugins/sweetalert2/css/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/plugins/step-wizard/css/smart_wizard_all.min.css">

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
    .double {
  background-color:  rgb(0, 0, 0);
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
<body  class="hold-transition layout-top-nav dark-mode">


<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md" style="background-color: #006400;">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="assets/logo/pob icon.png" alt="logo" class="brand-image img-circle " >
        <span class="brand-text  text-white"  style="font-weight: 700">BARANGAY POBLAACION PORTAL</span>
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
          
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper double" id="backGround">
    <!-- Content Header (Page header) -->
 
    
  
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" >

  



    
  <div class="container-fluid py-5">
  <form id="registerResidentForm" method="POST" enctype="multipart/form-data" autocomplete="off">
    <div class="row">
      <!-- Profile Column -->
      <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
          <div class="card-body text-center">
            <img src="assets/logo/profiles icon.png" class="img-fluid img-thumbnail mb-3" id="image_residence" alt="Profile Picture" style="cursor: pointer; max-height: 200px;">
            <input type="file" name="add_image_residence" id="add_image_residence" hidden>

            <h4 class="mb-1"><span id="keyup_first_name"></span> <span id="keyup_last_name"></span></h4>

            <div class="form-group text-left">
              <label>Voter Status</label>
              <select class="form-control" name="add_voters" id="add_voters">
                <option value="">Select</option>
                <option>NO</option>
                <option>YES</option>
              </select>
            </div>

            <div class="form-group text-left">
              <label>Gender</label>
              <select class="form-control" name="add_gender" id="add_gender">
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>

            <div class="form-group text-left">
              <label>Date of Birth</label>
              <input type="date" class="form-control" name="add_birth_date" id="add_birth_date">
            </div>

            <div class="form-group text-left">
              <label>Place of Birth</label>
              <input type="text" class="form-control" name="add_birth_place" id="add_birth_place">
            </div>

            <div class="form-group text-left">
              <label>PWD</label>
              <select class="form-control" name="add_pwd" id="add_pwd">
                <option value="">Select</option>
                <option>NO</option>
                <option>YES</option>
              </select>
            </div>

            <div class="form-group text-left" id="pwd_check" style="display:none;">
              <label>Type of PWD</label>
              <input type="text" class="form-control" name="add_pwd_info" id="add_pwd_info">
            </div>

            <div class="form-group text-left">
              <label>Single Parent</label>
              <select class="form-control" name="add_single_parent" id="add_single_parent">
                <option value="">Select</option>
                <option>NO</option>
                <option>YES</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabbed Content Column -->
      <div class="col-md-8">
        <div class="card shadow h-100 border-primary">
          <div class="card-header p-0 border-bottom-0 bg-primary">
            <ul class="nav nav-tabs nav-fill text-white" id="tabs" role="tablist">
              <li class="nav-item"><a class="nav-link active" id="basic-info-tab" data-toggle="pill" href="#basic-info">Basic Info</a></li>
              <li class="nav-item"><a class="nav-link" id="other-info-tab" data-toggle="pill" href="#other-info">Other Info</a></li>
              <li class="nav-item"><a class="nav-link" id="guardian-tab" data-toggle="pill" href="#guardian">Guardian</a></li>
              <li class="nav-item"><a class="nav-link" id="account-tab" data-toggle="pill" href="#account">Account</a></li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="tabContent">
    
      <div class="card-body" >
        <div class="tab-content" id="custom-tabs-one-tabContent">
          <div class="tab-pane fade active show" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab">
              <p class="lead text-center">Personal Details</p>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group ">
                    <label>First Name </label>
                    <input type="text" class="form-control" id="add_first_name" name="add_first_name" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group ">
                    <label>Middle Name</label>
                    <input type="text" class="form-control" id="add_middle_name" name="add_middle_name" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group ">
                    <label>Last Name </label>
                    <input type="text" class="form-control" id="add_last_name" name="add_last_name" >
                  </div>  
                </div>
              </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group ">
                      <label >Suffix</label>
                      <input type="text" class="form-control" id="add_suffix" name="add_suffix" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group ">
                      <label >Civil Status</label>
                      <select name="add_civil_status" id="add_civil_status" class="form-control">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group ">
                      <label >Religion</label>
                      <input type="text" class="form-control" id="add_religion" name="add_religion">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group ">
                      <label >Nationality</label>
                      <input type="text" class="form-control" id="add_nationality" name="add_nationality">
                    </div>
                  </div>                              
                </div>
          </div>
          <div class="tab-pane fade" id="other-info" role="tabpanel" aria-labelledby="other-info-tab">
                <p class="lead text-center">Address</p>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Municipality</label>
                      <input type="text" class="form-control" id="add_municipality" name="add_municipality">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Zip</label>
                      <input type="text" class="form-control" id="add_zip" name="add_zip" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Barangay</label>
                      <input type="text" class="form-control" id="add_barangay" name="add_barangay" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>House Number</label>
                      <input type="text" class="form-control" id="add_house_number" name="add_house_number" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label>Street</label>
                    <input type="text" class="form-control" id="add_street" name="add_street" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Address</label>
                      <input type="text" class="form-control" id="add_address" name="add_address" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label >Contact Number</label>
                      <input type="text" maxlength="11" class="form-control" id="add_contact_number" name="add_contact_number" >
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" class="form-control" id="add_email_address" name="add_email_address" >
                    </div>
                  </div>
                </div>
          </div>
          <div class="tab-pane fade" id="guardian" role="tabpanel" aria-labelledby="guardian-tab">
           
              <p class="lead text-center">Guardian</p>
              <div class="row">

                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Father's Name</label>
                    <input type="text" class="form-control" id="add_fathers_name" name="add_fathers_name" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Mother's Name</label>
                    <input type="text" class="form-control" id="add_mothers_name" name="add_mothers_name" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Guardian</label>
                    <input type="text" class="form-control" id="add_guardian" name="add_guardian" >
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Guardian Contact</label>
                    <input type="text" class="form-control" maxlength="11" id="add_guardian_contact" name="add_guardian_contact" >
                  </div>
                </div>

              </div>
            
          </div>
          <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
           
              <p class="lead text-center">Account</p>
                          <div class="row">
                            
                            <div class="col-sm-12 ">
                              <div class="form-group">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input type="text" id="add_username" name="add_username" class="form-control" placeholder="USERNAME" >
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 ">
                              <div  class="form-group">
                                <div class="input-group mb-3" id="show_hide_password">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-key"></i></span>
                                  </div>
                                  <input type="password"  id="add_password" name="add_password" class="form-control" placeholder="PASSWORD"  style="border-right: none;" >
                                  <div class="input-group-append bg">
                                    <span class="input-group-text bg-transparent"> <a href="" style=" text-decoration:none;"><i class="fas fa-eye-slash" aria-hidden="true"></i></a></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 ">
                              <div  class="form-group">
                                <div class="input-group mb-3" id="show_hide_password_confirm">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent"><i class="fas fa-key"></i></span>
                                  </div>
                                  <input type="password"  id="add_confirm_password" name="add_confirm_password" class="form-control" placeholder="CONFIRM PASSWORD"  style="border-right: none;" >
                                  <div class="input-group-append bg">
                                    <span class="input-group-text bg-transparent"> <a href="" style=" text-decoration:none;"><i class="fas fa-eye-slash" aria-hidden="true"></i></a></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
            
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit"  class="btn btn-success px-4 elevation-3"> <i class="fas fa-user-plus"></i> REGISTERD</button>
      </div> 
      <!-- /.card -->
    </div>

  </div>
</div>
</form>
    


</div><!--/. container-fluid -->
          
     
          

     
          
               
      
     
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
<script src="assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<script src="assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="assets/plugins/phone code/intlTelInput.js"></script>
<script src="assets/plugins/sweetalert2/js/sweetalert2.all.min.js"></script>
<script src="assets/plugins/step-wizard/js/jquery.smartWizard.min.js"></script>
<script>
  $(document).ready(function(){
 
    $("#add_pwd").change(function(){
      var pwd_check = $(this).val();

      if(pwd_check == 'YES'){
        $("#pwd_check").css('display', 'block');
        $("#add_pwd_info").prop('disabled', false);
      }else{
        $("#pwd_check").css('display', 'none');
        $("#add_pwd_info").prop('disabled', true);
      }

    })
 $(function () {
        $.validator.setDefaults({
          submitHandler: function (form) {

            $.ajax({
                    url: 'signup/newResidence.php',
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success:function(data){

                      if(data == 'errorPassword'){
                          Swal.fire({
                            title: '<strong class="text-danger">ERROR</strong>',
                            type: 'error',
                            html: '<b>Password not Match<b>',
                            width: '400px',
                            confirmButtonColor: '#6610f2',
                          })
                      }else if(data == 'errorUsername'){

                        Swal.fire({
                            title: '<strong class="text-danger">ERROR</strong>',
                            type: 'error',
                            html: '<b>Username is Already Taken<b>',
                            width: '400px',
                            confirmButtonColor: '#6610f2',
                          })

                      }else{

                        Swal.fire({
                          title: '<strong class="text-success">SUCCESS</strong>',
                          type: 'success',
                          html: '<b>Registered Residence has Successfully<b>',
                          width: '400px',
                          confirmButtonColor: '#6610f2',
                          allowOutsideClick: false,
                          showConfirmButton: false,
                          timer: 2000,
                        }).then(()=>{
                          window.location.reload();
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
        });
      $('#registerResidentForm').validate({
       ignore:'',
        rules: {
          add_first_name: {
            required: true,
            minlength: 2
          },
          add_last_name: {
            required: true,
            minlength: 2
          },
          add_birth_date: {
            required: true,
          },
          add_gender: {
            required: true,
          },
          add_contact_number: {
            required: true,
            minlength: 11
          },
          add_voters: {
            required: true,
          },
          add_pwd: {
            required: true,
          },
        
          add_username:{
            required: true,
            minlength: 8
          },
          add_password:{
            required: true,
            minlength: 8
          },
          add_confirm_password:{
            required: true,
            minlength: 8
          },
          add_pwd:{
            required: true,
          },
          add_voters:{
            required: true,
          },
          add_single_parent:{
            required: true,
          },
          add_pwd_info:{
            required: true,
          },
          add_address: {
            required: true,
          },
        
        },
        messages: {
          add_first_name: {
            required: "This Field is required",
            minlength: "First Name must be at least 2 characters long"
          },
          add_last_name: {
            required: "This Field is required",
            minlength: "Last Name must be at least 2 characters long"
          },
        
          add_contact_number: {
            required: "This Field is required",
            minlength: "Input Exact Contact Number"
          },
            add_birth_date: {
            required: "This Field is required",
          },
          add_gender: {
            required: "This Field is required",
          },
          add_voters: {
            required: "This Field is required",
          },
         
          add_pwd: {
            required: "This Field is required",
          },
       
       
         
          add_username: {
            required: "This Field is required",
            minlength: "Username must be at least 8 characters long"
          },
          add_password: {
            required: "This Field is required",
            minlength: "Password must be at least 8 characters long"
          },
          add_password: {
            required: "This Field is required",
            minlength: "Confirm Password must be at least 8 characters long"
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

    $("#image_residence").click(function(){
          $("#add_image_residence").click();
      });


      function displayImge(input){
      if(input.files && input.files[0]){
        var reader = new FileReader();
        var add_image = $("#add_image_residence").val().split('.').pop().toLowerCase();

        if(add_image != ''){
          if(jQuery.inArray(add_image,['gif','png','jpg','jpeg']) == -1){
            Swal.fire({
              title: '<strong class="text-danger">ERROR</strong>',
              type: 'error',
              html: '<b>Invalid Image File<b>',
              width: '400px',
              confirmButtonColor: '#6610f2',
            })
            $("#add_image_residence").val('');
            $("#image_residence").attr('src', 'assets/dist/img/blank_image.png');
            return false;
          }
        }

        reader.onload = function(e){
          $("#image_residence").attr('src',e.target.result);
          $("#image_residence").hide();
          $("#image_residence").fadeIn(650);
        }

        reader.readAsDataURL(input.files[0]);

      }
    }  

    $("#add_image_residence").change(function(){
      displayImge(this);
    })




  });

</script>

<script>
// Restricts input for each element in the set of matched elements to the given inputFilter.
(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

 
  $("#add_contact_number,#add_zip, #add_guardian_contact, #add_age").inputFilter(function(value) {
  return /^-?\d*$/.test(value); 
  
  });


  $("#add_first_name, #add_middle_name, #add_last_name, #add_suffix, #add_religion, #add_nationality, #add_municipality, #add_fathers_name, #add_mothers_name, #add_guardian").inputFilter(function(value) {
  return /^[a-z, ]*$/i.test(value); 
  });
  
  $("#add_street, #add_birth_place, #add_house_number").inputFilter(function(value) {
  return /^[0-9a-z, ,-]*$/i.test(value); 
  });

</script>

</body>
</html>
