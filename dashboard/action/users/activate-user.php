﻿<?php
session_start();
require_once("./connect.php");
require_once("./function.php");

$usersubs = userdata($_GET['id']);


if(empty($usersubs['activated']) || empty($usersubs['rate'])) {
		$query = "SELECT * FROM tbl_rate";
		$q = mysql_query_md($query);
		$rate = array();
		while($row=mysql_fetch_md_array($q)){
			
				foreach($row as $key=>$val){

					$rate[$row['rate_id']][$key] = $val;
				}

		}

?>
<div class="callout callout-warning">
      <h5>Please activate your account below.</h5>

      <p>Purchase any of the plans below to use our exchange function for lifetime.</p>
</div>
<style>
	label.btn.btn-default.text-center.active {
    background-color: #b3b3b3;
}
#paymentproceed {
	display:none;
}
</style>
<script type="text/javascript">
	
	function triggercheckout(aa){
		jQuery('.choicescc').removeClass('active');
		
		jQuery(aa).addClass('active');
		jQuery('#pricecc').text(jQuery(aa).attr('data-price'));

		jQuery('#item_name').val(jQuery(aa).attr('data-rate_name')+" Complan");
		jQuery('#item_desc').val("Complan Payment for Account : <?php echo $usersubs['username']; ?>");
		jQuery('#item_number').val(jQuery(aa).attr('data-rate_id'));
		jQuery('#amountf').val(jQuery(aa).attr('data-rate_start'));

		jQuery('#referral').text(jQuery(aa).attr('data-rate_end')+"%");

		jQuery('#matrix').text(jQuery(aa).attr('data-rate_bonus')+" months");

		

    jQuery('#item_name2').val(jQuery(aa).attr('data-rate_name')+" Complan");
    jQuery('#item_desc2').val("Complan Payment for Account : <?php echo $usersubs['username']; ?>");
    jQuery('#item_number2').val(jQuery(aa).attr('data-rate_id'));
    jQuery('#amountf2').val(jQuery(aa).attr('data-rate_start'));

		
	}
</script>
<div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-12">
              <h3 class="my-3">Registration Fee</h3>
<!--               <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
 -->
              <hr>

              <h4 class="mt-3">Complan <small>Please select one</small></h4>
              <div class="btn-group btn-group-toggle">

              	<?php 
              	foreach($rate as $data) { 

              		$fields = array();

              		foreach($data as $k=>$v){
              			$v = addslashes($v);
              			$fields[]  = "data-{$k}='$v'";
              		}
              		$price = "$".number_format($data['rate_start'],2);
              		$fields[] = "data-price='$price'";
              	
              	?>
                <label id="dc<?php echo $data['rate_id']; ?>" <?php echo implode(" ", $fields); ?>  class="btn btn-default text-center choicescc" onclick="triggercheckout(this)">
                  <span class="text-xl">$<?php echo number_format($data['rate_start'],2); ?></span>
                  <br>
                  <?php echo ($data['rate_name']); ?>
                </label>
                <?php } ?>


              </div>
          <div class="row mt-4">

            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
              		Direct Referral Bonus: <span id='referral'>Bonus</span><br/>
              		Matrix Subscription Bonus: <span id='matrix'>Bonus</span><br/>

               </div>
            </div>
          </div>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 id="pricecc"class="mb-0">
                  $80.00
                </h2>
              </div>

              <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat" onclick="checkmeout()">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                   Mark as Paid
                </div>

              </div>


            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
<script type="text/javascript">
	<?php
		$current = current($rate);
	?>
	function start(){
	jQuery('#dc<?php echo $current['rate_id']; ?>').trigger('click');
	}
	function checkmeout(){
		jQuery('#paymentproceed').submit();
	}

</script>

<?php  $url = "http://".$_SERVER['HTTP_HOST']."/"; ?>



<form id='paymentproceed' action="<?php echo $url; ?>dashboard/ipnuser.php" method="post">
    <input type="hidden" name="cmd" value="_pay_simple">
    <input type="hidden" name="reset" value="1">
    <input type="hidden" name="merchant" value="<?php echo systemconfig('merchant_id'); ?>">
    <input type="hidden" name="ipn_mode" value="hmac">    
    <input type="hidden" name="currency" value="USD">  
    <input type="hidden" name="currency1" value="USD">   
    <input type="hidden" id='item_name2' name="item_name" value="Test">
    <input type="hidden"  name="txn_id" value="txn<?php echo rand(); ?>">
    <input type="hidden" id='item_desc2' name="item_desc" value="Test Description">
    <input type="hidden" id='item_number2' name="item_number" value="1">
    <input type="hidden" id='custom2' name="custom" value="<?php echo $usersubs['accounts_id']; ?>">
    <input type="hidden" id='invoice2' name="invoice" value="CP-<?php echo rand(); ?>">
    <input type="hidden" id='amountf2' name="amount1" value="1.00000000">
    <input type="hidden" name="want_shipping" value="0">
     <input type="hidden" name="status" value="100">
    <input type="hidden" name="success_url" value="<?php echo $url; ?>dashboard/index.php">
    <input type="hidden" name="cancel_url" value="<?php echo $url; ?>dashboard/index.php?pages=exchangerequest">
    <input type="hidden" name="ipn_url" value="<?php echo $url; ?>dashboard/ipn.php">
    <input type="image" src="https://www.coinpayments.net/images/pub/buynow-wide-blue.png" alt="Buy Now with CoinPayments.net">
</form>

<?php } else { 
  $ratedata = ratedata($usersubs['rate']);
  ?>
<div class="callout callout-success">
      <h5><?php echo $ratedata['rate_name']; ?></h5>

      <p>Fee: <?php echo $ratedata['rate_start'];?></p>

      <p>Direct Referral Percentage: <?php echo $ratedata['rate_end'];?>%</p>

      <p>Months of Free in Table Matrix: <?php echo $ratedata['rate_bonus'];?></p>
</div>
<?php } ?>