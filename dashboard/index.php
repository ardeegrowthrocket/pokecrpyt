<?php
session_start();
include("connect.php");
include("function.php");
if($_SESSION['accounts_id']=='')
{
exit("<script> window.location='login.php' </script>");
}
$main = getrow("tbl_logo");
$tablerowxxx = "tbl_accounts";
$queryrowxxx = "SELECT * FROM $tablerowxxx WHERE accounts_id='".$_SESSION['accounts_id']."'";
$qrowxxx = mysql_query_md($queryrowxxx);
$rowxxx = mysql_fetch_md_assoc($qrowxxx);
foreach($rowxxx as $key=>$val)
{
  if($key!='stores'){
    $_SESSION[$key] = $val;
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("inc/head.php"); ?>
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
  <style>
.user-panel .info {
    display: inline-block;
    padding: 5px 5px 5px 10px;
    white-space: normal;
}
aside.main-sidebar.sidebar-dark-primary.elevation-4 {
   
}
.noti {
    padding: 11px;
    font-size: 19px;
    color: green;
}

.card.card-primary {
    padding: 20px;
}
a.goback {
    font-size: 16px;
    text-decoration: underline;
}

li.paginate_button {
    margin-left: 6px;
}

a.brand-link {
    text-align: center;
}

.p1user{
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);	
}
  </style>
  

<style>
.ui.cards>.card {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: .875em .5em;
    float: none;
}
.ui.card, .ui.cards>.card {
    max-width: 100%;
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 290px;
    min-height: 0;
    background: #fff;
    padding: 0;
    border: none;
    border-radius: .28571429rem;
    -webkit-box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
    -webkit-transition: -webkit-box-shadow .1s ease,-webkit-transform .1s ease;
    transition: -webkit-box-shadow .1s ease,-webkit-transform .1s ease;
    transition: box-shadow .1s ease,transform .1s ease;
    transition: box-shadow .1s ease,transform .1s ease,-webkit-box-shadow .1s ease,-webkit-transform .1s ease;
    z-index: '';
}

.ui.cards {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin: -.875em -.5em;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}
.uipokeimg {
	width:100%;
}
.ui.card {
    padding: 16px!important;
}

.idsdata{
	
}
.typedataholder {
    position: absolute;
}
.typesdata {
    background: #212121;
    color: white;
    padding: 4px;
    font-size: 12px;
    float: left;
	margin-left:1px;

	text-transform: uppercase;
}
/*
.typesdata.water {
    background-color: skyblue;
}
.typesdata.rock {
    background-color: brown;
}
.typesdata.ground {
    background-color: #969191;
}
.typesdata.steel {
    background-color: silver;
}
.typesdata.bug {
    background-color: #3fdc3f;
}
.typesdata.grass {
    background-color: green;
}
*/
#battlenow {
	display:none;
}
#battlebody2 .btnbattle {
	display:none;
}

#battlebody2 .card {
    width: 206px;
    margin: 0 auto;
}

.typedataholder {
    z-index: 50;
}
</style>  
<div class="wrapper">

  <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<!--     <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">Kringle Cash</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fas fa-search fa-user" style='font-size: 33px;color: white;'></i>
        </div>
        <div class="info">
          <a href="index.php" class="d-block"><?php echo $_SESSION['fullname']; ?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <?php include("inc/menu.php"); ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <?php

    $currpage = $_GET['pages'];
    if($currpage=='')
    {
      $currpage = 'dashboard';
    }


    if($currpage=='exchangerequest' && $_SESSION['activated']==0){
      $currpage = "activate";
    }
    include("action/".$currpage.".php");
            ?>
      </div>
            
    </section>



          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2025 PokePesos</strong><br/>
	<span>PokePeso does not claim ownership of Pokemon or any associated content.<br/> All original characters, artwork and other media remain the property of their respective authors.</span>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="plugins/toastr/toastr.min.js"></script>


<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->


<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>


<script type="text/javascript">
  
 jQuery( document ).ready(function() {
      

      jQuery('.editor').summernote({
        height: 250
      });
      <?php if ($_GET['pages']=='subscription' || $_GET['pages']=='exchangerequest' || ($_GET['pages']=='users' && $_GET['task']=='edit')) { ?>
      start();
      <?php } ?>


      jQuery( ".nav-link" ).each(function( index ) {
              if(jQuery(this).attr('href')=='index.php?pages=<?php echo $_GET['pages']; ?>'){

                 jQuery(this).addClass('active');
              }
      });
	  
	  



setInterval(function() { 

		jQuery.post("action/aigenerate.php", {battlehash: <?php echo rand(); ?>}, function(result){

		});	

		jQuery.post("action/generatebattle.php", {battlehash: <?php echo rand(); ?>}, function(result){

		});	
		jQuery.post("action/generatebattlenoti.php", {battlehash: <?php echo rand(); ?>}, function(result){
			if(result!=''){
				toastr.success(result);

			}
			
		});	
}, 5000);




});
</script>




</body>
</html>
