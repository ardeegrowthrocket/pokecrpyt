﻿<?php
session_start();
require_once("./connect.php");
require_once("./function.php");

  $is_active = 1;

  if(empty($_SESSION['deadline'])){
      $is_active = 0;
  }else

  {

$today = date("Y-m-d h:i:s");
$expire = $_SESSION['deadline']; //from database

$today_time = strtotime($today);
$expire_time = strtotime($expire);

if ($expire_time < $today_time) { 

     $is_active = 0;
 }

}

$countdown = strtotime($_SESSION['deadline']);


$cdtest =  date("M d, Y h:i:s",$countdown);


$levelimit = $_SESSION['level'] + 9;
$path = $_SESSION['path'];
$aid = $_SESSION['accounts_id'];
$query_dl = "SELECT COUNT(accounts_id) as c FROM `tbl_accounts` WHERE path LIKE '{$path}%' AND level <= $levelimit ORDER BY `accounts_id` ASC";
$rowdl = mysql_fetch_md_array(mysql_query_md($query_dl));



 $query_ob = "SELECT SUM(amount) as c FROM `tbl_bonus_history` WHERE sid='{$_SESSION['accounts_id']}'";
$rowob = mysql_fetch_md_array(mysql_query_md($query_ob));


$query_dr = "SELECT COUNT(accounts_id) as c FROM `tbl_accounts` WHERE refer='{$_SESSION['accounts_id']}'";
$rowdr = mysql_fetch_md_array(mysql_query_md($query_dr));



if(empty($rowob['c'])){
  $rowob['c'] = 0;
}

$rowob['c'] = number_format($rowob['c'],2);

$current = date("Y-m-d");
$user = $_SESSION['accounts_id'];
$queryx = "SELECT * FROM tbl_battle WHERE (p1user='$user' OR p2user='$user') AND battledata LIKE '%$current%'";
$qx = mysql_query_md($queryx);
$countx = mysql_num_rows_md($qx);


$pokemons = mysql_num_rows_md(mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$user'"));
?>





<div class="row">
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $pokemons; ?></h3>

                <p>Pokemons</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $rowdr['c']; ?></h3>

                <p>Direct Referrals</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $countx; ?> / <?php echo systemconfig("battlelimit"); ?></h3>

                <p>Battle Energy</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>





<div class="callout callout-success">
      <h5>Your Wallet:</h5>
<div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                 		<?php echo number_format($_SESSION['balance'],2); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
</div>
</div>


<div class="callout callout-warning">
      <h5>Your Referral Url:</h5>
<div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-link"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                    <?php echo $_SERVER['HTTP_HOST']; ?>/dashboard/register.php?refer=<?php echo $_SESSION['accounts_id']; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
</div>
</div>



