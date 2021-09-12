<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);

if(empty($accounts_id)){
	exit();
}
function trans()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 12; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

	if($_POST['withdraw']!='')
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
		$hp = rand(200,800) + 1000;
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
		
generatemoves($hash);		
randomskills($hash);		
		
		
		
		$x++;
}

///



		$row = mysql_fetch_md_assoc($q);		
		}
	}
?>
<?php
if($success!='')
{
	
	
?>

												<div id="poke-container" class="ui cards">

												<?php
												$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE hash='{$hash}'");		

													while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
												?>	
														<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card" style='width: 100%;'>
														<div class='typedataholder'>
															<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
																<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo ucfirst($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
															<?php } ?>	
														</div>
														
														   <div class="image"><img class='uipokeimg p1user' srcset="sprites/sprites/pokemon/other/official-artwork/<?php echo $rowqpokes['pokemon']; ?>.png"></div>
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
														   
														   </span><br/>	



															<span><input class="btn btn-info btn-lg btnbattle" type="button" onclick="window.location='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'" name="battle" value="View"></span>														   
														
														</div>
												<?php
													}
												?>	
														
														
												</div>									
											

<script>
jQuery('#pokeremain').text("<?php echo $row['pokeballs']; ?>");
</script>

<?php
}
?>
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>