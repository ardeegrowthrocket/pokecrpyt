<?php
session_start();
include("connect.php");
include("function.php");
$main = getrow("tbl_logo"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PokeCrpyto | Log in</title>

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
  <!-- /.login-logo -->
  <div class="card">
</div>
<?php
if($_GET['error']==1)
{
  ?>
<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i> Please login before accessing that page.</li></ul></div>
  <?php
}
?>
<div id="notibar">

</div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>


        <div class="input-group mb-3">
          <input id="username"  type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
 
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="button" onclick="processlogin()"  class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>



      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgotpassword.php">I forgot my password</a>
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
  function processlogin()
  {
    var username = $('#username').val();
    var password = $('#password').val();
    var stores = $('#stores').val();
    $('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Please wait.. Checking your acccount.</li></ul></div>');
    $.post("action/process-login.php",{username: username,password:password,stores:stores}, function(data, status){
    //alert(data);
    $('#notibar').html('');
    if(data=="0")
    {
      $('#notibar').html('<div class="warning"><ul class="fa-ul"><li><i class="fa fa-warning fa-li"></i>Please check your username/password. or Account does not exist.</li></ul></div>');
    }
    if(data=="1")
    {
      $('#notibar').html('<div class="noti"><ul class="fa-ul"><li><i class="fa fa-cog fa-spin fa-li"></i> Loading.. Your Account.</li></ul></div>');
      window.location = 'index.php';
    }
    });   
  }
  </script>
</body>
</html>
