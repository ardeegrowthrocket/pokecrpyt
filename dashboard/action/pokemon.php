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

$field[] = array("type"=>"select","value"=>"withdraw","label"=>"Number of Draw:","option"=>array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5"));
//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'));
?>
<!--
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Submit'></center>
      </form>
   </div>
</div> 

<hr>
-->
<h2>My Pokemons</h2>   
<?php
$current = date("Y-m-d");
$user = $_SESSION['accounts_id'];
$queryx = "SELECT * FROM tbl_battle WHERE (p1user='$user' OR p2user='$user') AND battledata LIKE '%$current%'";
$qx = mysql_query_md($queryx);
$countx = mysql_num_rows_md($qx);
?>
<div class='row'>
          <div class="col-lg-6 col-6">
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
		  
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $pokemons = mysql_num_rows_md(mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$user'"));; ?></h3>

                <p>Pokemons</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>		  
		  
</div>




<div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              You can battle 1 at a time only. Please wait to load again.
</div>

<div id='pokemonjs' style='display:none;'></div>
<div id="poke-container" class="ui cards">
<style>
#overlayx {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
</style>
<div id="overlayx">
</div>


<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$myuser'");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>	
		<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
		<div class='typedataholder'>
			<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
				
				<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo ucfirst($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
			<?php } ?>	
		</div>
		
		   <div class="image"><img class='uipokeimg' srcset="sprites/sprites/pokemon/other/official-artwork/<?php echo $rowqpokes['pokemon']; ?>.png"></div>
		   <h4><?php echo $rowqpokes['pokename']; ?></h4>
		   <p class='idsdata'>ID:#<?php echo $rowqpokes['hash']; ?></p>
		   <span>Level:<?php echo $rowqpokes['level']; ?></span>
		   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
		   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
		   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
		   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
		   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
		   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span><br/>	


		   <span>
		   
		   <?php 
		   $games = $rowqpokes['win'] + $rowqpokes['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$rowqpokes['win']."/".$games;
			}
		   echo "<br>";
		   
		   
		   ?>
		   
		   </span>
		   <br/>	
			<input class="btn btn-info btn-lg btnbattle" type="button" onclick="window.location='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'" name="battle" value="View">
			<br/>
		   <input class="btn btn-primary btn-lg btnbattle" type="button" onclick="battleme('<?php echo $rowqpokes['hash']; ?>')" name="battle" value="Battle!">
		   <br>
		   <input class="btn btn-secondary btn-lg btnbattle" type="button" onclick="window.location='index.php?pages=useitems&pokeid=<?php echo $rowqpokes['id']; ?>'" name="battle" value="Upgrade!">
		</div>
<?php
	}
?>	
		
		
</div>
<button id='battlenow' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary1">
                  Launch Primary Modal
                </button>
				
<div class="modal fade" id="modal-primary1" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Queue For Battle - <span class='hashbattle'></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>
			
            <div id='battlebody2' class="modal-body">
              <p>Loading…</p>
            </div>			
            <div id='battlebody' class="modal-body">
              <p>Loading…</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button id='savebattle' type="button" onclick="savebattle(this)" class="btn btn-primary">Lets Go!</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>				

<script>
	function battleme(battlehash){
		
		jQuery('.hashbattle').text(battlehash);
		jQuery('#battlenow').trigger('click');
		jQuery('#battlebody').html("");
		
		var htmlpoke = jQuery('#poke-'+battlehash).html();
		jQuery('#battlebody2').html("<div class=\"ui card\">"+htmlpoke+"</div>");
		
		jQuery('#savebattle').attr('battlehash',battlehash);

	
		
		
		//toastr.success("Your battle has done watch here <a href=''>Watch</a>");
		
	}
	
	
	function savebattle(id){
		
		var battlehash = jQuery(id).attr('battlehash');
		
		jQuery('#battlebody').html("<p>Loading..</p>");
		jQuery.post("action/savebattle.php", {battlehash: battlehash}, function(result){
			jQuery('#battlebody').html(result);
			jQuery('#overlayx').show();
			jQuery('#savebattle').hide();
		});				
	}
</script>