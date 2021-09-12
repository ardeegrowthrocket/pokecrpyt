<?php
session_start();
include("connect.php");
include("function.php");


/*
SELECT accounts_id as aid,path,email,level,(SELECT COUNT(accounts_id) FROM tbl_accounts WHERE parent=aid) as count,(CONCAT(level,"-",path)) as lvl FROM `tbl_accounts`  
HAVING count <= 1 AND path LIKE '0/20%'
ORDER BY `lvl` ASC LIMIT 1
*/
if(!empty($_POST['submit']))
{

$error = "";
  
$query_referx = mysql_query_md("SELECT accounts_id FROM tbl_accounts ORDER by accounts_id DESC LIMIT 1");
$rowreferx = mysql_fetch_md_assoc($query_referx);
$last_id = $rowreferx['accounts_id'];
$_POST['accounts_id'] = $last_id + 10;



if(!empty($_REQUEST['refer'])){




if(countfield("accounts_id",$_POST['refer'])==0)
{
  $error .= "Referral URL is incorrect kindly retry.<br/>";
}




$query_refer = mysql_query_md("SELECT path FROM tbl_accounts WHERE accounts_id = '{$_POST['refer']}'");
$rowrefer = mysql_fetch_md_assoc($query_refer);
$path = $rowrefer['path'];



 $q2xxx = "SELECT accounts_id as aid,path,email,level,(SELECT COUNT(accounts_id) FROM tbl_accounts WHERE parent=aid) as count,(CONCAT(level,\"-\",path)) as lvl FROM `tbl_accounts` HAVING count <= 1 AND path LIKE '{$path}%' ORDER BY `lvl` ASC LIMIT 1";



$query_refer2 = mysql_query_md($q2xxx);



$rowrefer2 = mysql_fetch_md_assoc($query_refer2);

$_POST['parent'] = $rowrefer2['aid'];
$_POST['path'] = $rowrefer2['path']."/".$_POST['accounts_id'];

$_POST['level'] = count(explode("/",$_POST['path']));



}
else{

$_POST['parent'] = 0;
$_POST['path'] = $rowrefer2['path']."/".$_POST['accounts_id'];
$_POST['level'] = 2;
}




if(countfield("email",$_POST['email'])==0)
{
  
}else{

  $error .= "Username/Email already taken.<br/>";
}

if($_POST['password']!=$_POST['password2']){
  $error .= "Passwords do not match.<br/>";
}

if(empty($_POST['email'])){
    $error .= "Email is required.<br/>";
}
if(empty($_POST['password'])){
    $error .= "Password is required.<br/>";
}


if($error==''){
  unset($_POST['submit']);
  unset($_POST['password2']);
  unset($_POST['task']);
  unset($_POST['terms']);
  $_POST['createdby'] = $_POST['email'];
  $_POST['username'] = $_POST['email'];
  $_POST['role'] = 2;
  $fields = formquery($_POST);
  $tbl = "tbl_accounts";
  $_POST['store'] = 1;
  mysql_query_md("INSERT INTO $tbl SET $fields");

$tablerowxxx = "tbl_accounts";
$queryrowxxx = "SELECT * FROM $tablerowxxx WHERE username='".$_POST['username']."'";
$qrowxxx = mysql_query_md($queryrowxxx);
$rowxxx = mysql_fetch_md_assoc($qrowxxx);
foreach($rowxxx as $key=>$val)
{
  //if($key!='stores'){
    $_SESSION[$key] = $val;
  //}
  
}


  ?>
  <script type="text/javascript">
    window.location = 'index.php';
  </script>
  <?php
  exit();
}








}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PokeCrpyto | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="login-logo">
    <img src='logo.png'>
  </div>
<?php
if(!empty($error))
{
  ?>
<div class="warning">
  <ul class="fa-ul">
    <li>
      <i class="fa fa-warning fa-li"></i><?php echo $error; ?>
    </li>
  </ul>
</div>
  <?php
}
?>
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="register.php" method="POST">

        <div class="input-group mb-3">
          <input name='fullname' type="text" required class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input name='email' type="email" required class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name='password' type="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name='password2' type="password"  required class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input required type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-primary">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input name='refer' type="hidden" value="<?php echo $_GET['refer']; ?>">
            <button type="submit" value="Submit" name="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="login.php" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

  <div class="modal fade" id="modal-primary" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo systemconfig("terms"); ?>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>            

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
