﻿<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);
function trans()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 12; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

	if($_POST['submit']!='')
	{
		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}
		if($_POST['withdraw']==0 || $_POST['withdraw']<0)
		{
						//$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to withdraw.<br>";
		}
		if($_POST['withdraw']>$row['balance']) 
		{
			//$error .= "<i class=\"fa fa-warning\"></i>Amount to withdraw(".$_POST['withdraw'].") is insufficient on current balance(".$row['balance']."). Please input valid amount.<br>";
		}
		
		if($error=='')
		{
		// $sum  = $row['balance'] - $_POST['withdraw'];
		// mysql_query_md("UPDATE tbl_accounts SET balance='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		$trans = $_POST['transnum'];
		mysql_query_md("INSERT INTO tbl_exchange_history SET transnum='$trans',claimtype='".$_POST['claimtype']."',address='".$_POST['address']."',accounts_id='$accounts_id',new_balance='".$sum."',amount='".$_POST['withdraw']."',current_balance='".$row['balance']."'");		
		}
	}
	
$field[] = array("type"=>"text","value"=>"bank_name","label"=>"Bank Name");
$field[] = array("type"=>"text","value"=>"bank_accountname","label"=>"Account Name");
$field[] = array("type"=>"text","value"=>"bank_accountnumber","label"=>"Account Number");
//
$field[] = array("type"=>"text","value"=>"name","label"=>"Fullname");
$field[] = array("type"=>"text","value"=>"address","label"=>"Address");
$field[] = array("type"=>"text","value"=>"phone","label"=>"Phone Number");
//
$field[] = array("type"=>"number","value"=>"withdraw","label"=>"Amount to withraw");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password");
//
?>
<h2>Exchange Request</h2>   
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>

<style>
.bank,.remit,.remitmain,.smartpadala,.antibug
{
	display:none;
}
</style>
<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done requesting for exchange please see status <a href='?pages=exchangehistory'>here</a> </li></ul></div>
<?php
}
?>

<?php
$field = array();

$field[] = array("type"=>"select","value"=>"claimtype","label"=>"Select Mode of Exchange","option"=>array("btc"=>"Bitcoin","kc"=>"Kringle Coins","billc"=>"The Billion Coins"));
$field[] = array("type"=>"text","value"=>"address","label"=>"BTC Address:");

$field[] = array("type"=>"text","value"=>"transnum","label"=>"Txid / Hash");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'));
?>

<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Submit'></center>
      </form>
   </div>
</div> 
