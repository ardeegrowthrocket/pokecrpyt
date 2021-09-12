<?php
session_start();
include("connect.php");
include("function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KringleExchange | Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src='logo.png'>
  </div>
<div id="notibar">

</div>
<?php
if($_GET['error']==1)
{
  ?>
<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i> Please login before accessing that page.</li></ul></div>
  <?php
}
?>
  <!-- /.login-logo -->
  <div class="card">



    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>


        <div class="input-group mb-3">
          <input id='email' type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="button" onclick="processemail()"  class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>


      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>



  <script>
  function processemail()
  {
    var email = $('#email').val();
    $('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Please wait.. Checking your acccount.</li></ul></div>');

    $.post("action/process-email.php",{email:email}, function(data, status){
    //alert(data);
    $('#notibar').html('');
    if(data=="0")
    {
      $('#notibar').html('<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i>Please check your email not exist.</li></ul></div>');
    }
    if(data=="1")
    {
      $('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i> Password sent to the email.</li></ul></div>');
    }
    });   
  }
  </script>
</body>
</html>
