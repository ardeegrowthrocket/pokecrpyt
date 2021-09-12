<?php
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
						$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to Draw.<br>";
		}
		if($_POST['withdraw']>$row['pokeballs']) 
		{
			$error .= "<i class=\"fa fa-warning\"></i>Amount to summon(".$_POST['withdraw'].") is insufficient on current pokeballs numbers:(".$row['pokeballs']."). Please input valid amount.<br>";
		}
		
		if($error=='')
		{
		$sum  = $row['pokeballs'] - $_POST['withdraw'];
		mysql_query_md("UPDATE tbl_accounts SET pokeballs='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		$trans = trans();
		mysql_query_md("INSERT INTO tbl_pokebuy_history SET transnum='$trans',claimtype='".$_POST['claimtype']."',address='".$_POST['address']."',accounts_id='$accounts_id',new_balance='".$sum."',amount='".$_POST['withdraw']."',current_balance='".$row['balance']."'");
		$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");




///pokemon

$x = 1;
while($x<=ceil($_POST['withdraw']))
{
		$pokeid = rand(1,898);
		$attack = rand(50,150);
		$defense = rand(5,35);
		$hp = rand(200,500) + 1000;
		$user = $_SESSION['accounts_id'];
		$speed = rand(10,40);
		$critical = rand(1,30);
		$accuracy = rand(1,30);
		$rate = rand(1,10);
		
		$level = 1;
		
		$hash = $_SESSION['accounts_id']."-".trans();
		$pokeclass = array();
		
		
		
$qpoke = mysql_query_md("SELECT * FROM tbl_pokemon WHERE id='$pokeid'");		
$rowqpoke = mysql_fetch_md_assoc($qpoke);		



	$pokename = ucfirst($rowqpoke['name']);
	$front = ($rowqpoke['front']);
	$back = ($rowqpoke['back']);
	$main = ($rowqpoke['main']);
	


		
$poketype = mysql_query_md("SELECT * FROM `tbl_relation` as a LEFT JOIN tbl_type as b ON a.relation_id = b.id WHERE a.relation_type = 'type' AND pokemon='$pokeid'");		
while($rowpoketype = mysql_fetch_md_assoc($poketype)){
		$pokeclass[] = $rowpoketype['name'];
}	
		
		$pokeclassfin = implode("|",$pokeclass);
		


$pokeadd = "INSERT INTO tbl_pokemon_users SET user='$user',pokemon='$pokeid',attack='$attack',defense='$defense',hp='$hp',speed='$speed',critical='$critical',accuracy='$accuracy',level=1,rate='$rate',front='$front',back='$back',main='$main',pokename='$pokename',pokeclass='$pokeclassfin',hash='$hash'";
mysql_query_md($pokeadd);
		
		
		
		$x++;
}

///













		$row = mysql_fetch_md_assoc($q);		
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
<audio controls autoplays loop hidden>
    <source src="https://vgmsite.com/soundtracks/pokemon-gameboy-sound-collection/vdrfhwxr/104-oak%20research%20lab.mp3" type="audio/mpeg">
</audio>
<h2>Pokemon Catch - PokeBalls #:(<span id='pokeremain'><?php echo $row['pokeballs'];?></span>)</h2>   
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
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done requesting for withdrawal please see status <a href='?pages=withdrawhistory'>here</a> </li></ul></div>
<?php
}
?>
<?php

//echo rand(1,898);

$field = array();

//$field[] = array("type"=>"select","value"=>"claimtype","label"=>"Select Mode of Withdrawal","option"=>array("btc"=>"Bitcoin","SLP"=>"SLP"));
//$field[] = array("type"=>"text","value"=>"address","label"=>"BTC Address:");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
//$field[] = array("type"=>"number","value"=>"withdraw","label"=>"Number of Draw:");

//$field[] = array("type"=>"select","value"=>"withdraw","label"=>"Number of Draw:","option"=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5"));
//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'));
?>

<div class="panel panel-default">
   <div class="panel-body">
      <form id='catchpoke' method='POST' action='#'>
         <?php echo loadform($field,$sdata); ?>
		 <input type='hidden' name='withdraw' value='1'>
         
		 <center>
		 
		 <input class='btn btn-primary btn-lg' onclick="catchpokemon()"type='button' name='submit' value='Catch'></center>
		 
      </form>
   </div>
</div> 

<hr>


<script>
	function catchpokemon(){
		
		jQuery('#battlenow').trigger('click');
		jQuery('#battlebody').html("");
		jQuery('#battlebody').html("<p>Loading..</p>");
		jQuery.post("action/catchsave.php", jQuery( "#catchpoke" ).serialize(), function(result){
			jQuery('#battlebody').html(result);
		});				
	}
</script>

<button id='battlenow' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary1">
                  Launch Primary Modal
                </button>
				
<div class="modal fade" id="modal-primary1" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Catching a Pokemon</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>		
            <div id='battlebody' class="modal-body">
              <p>Loading…</p>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>	