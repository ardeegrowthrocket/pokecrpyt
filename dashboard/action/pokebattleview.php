﻿<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$id = $_GET['id'];
$query = "SELECT * FROM tbl_battle WHERE id ='$id'";
$q = mysql_query_md($query);
$count = mysql_num_rows_md($q);
$row = mysql_fetch_md_assoc($q);


$logs = json_decode($row['logs'],true);


if(!empty($_GET['v']))
{
	if($_GET['v']==1){

		mysql_query_md("UPDATE tbl_battle SET v1='1' WHERE id ='$id'");
	}else{
		 mysql_query_md("UPDATE tbl_battle SET v2='1' WHERE id ='$id'");
	}
	
	
	
	
	
}


	$p1 = loadpokev2($logs[0]['dealer']);
	
	if($logs[0]['dealer']==$row['p1poke']){
		$p2play = $row['p2poke'];
	}
	if($logs[0]['dealer']==$row['p2poke']){
		$p2play = $row['p1poke'];
	}
	
	$p2 = loadpokev2($p2play);

$winmsg = "You Lose";
if($_SESSION['accounts_id']==$row['p1user']){
	mysql_query_md("UPDATE tbl_battle SET v1='1' WHERE id ='$id'");
	
	if($row['winner']==$row['p1poke']){
		$winmsg = "You Win";
	}	
	
}
if($_SESSION['accounts_id']==$row['p2user']){
	mysql_query_md("UPDATE tbl_battle SET v2='1' WHERE id ='$id'");
	
	if($row['winner']==$row['p2poke']){
		$winmsg = "You Win";
	}	
	
}

?>

<?php

	
	
	

?>


<h2>Battle View ID#: <?php echo md5($_GET['id']); ?></h2>
<style>
body {
  font-family: "helvetica neue", helvetica, arial, sans-serif;
  font-size: 16px;
  padding-top: 30px;
}

header {
  text-align: center;
}
header img {
  max-height: 100px;
  cursor: pointer;
}

strong {
  font-weight: 600;
  line-height: 1.5em;
}

.type {
  display: inline-block;
  height: 30px;
  width: 30px;
  margin: 10px;
  background-image: url("http://orig15.deviantart.net/24d8/f/2011/057/3/5/ge___energy_type_icons_by_aschefield101-d3agp02.png");
  background-repeat: no-repeat;
  background-size: 500% 400%;
}
.type.electric {
  background-position: 100% 0;
}
.type.fire {
  background-position: 25% 33%;
}
.type.water {
  background-position: 63% 100%;
}
.type.grass {
  background-position: 100% 33%;
}
.type.fighting {
  background-position: 0 33%;
}

.row {
  display: block;
  min-height: 50px;
}

.instructions {
  text-align: center;
  padding: 20px 0;
}
.instructions p {
  font-size: 2em;
}

.characters {
  display: flex;
  justify-content: space-around;
  transition: visibility 0.3s ease, opacity 0.3s ease, height 0.3s ease;
}
.characters.hidden {
  visibility: hidden;
  opacity: 0;
  height: 0;
}

.char-container {
  width: 25%;
  text-align: center;
  padding: 25px 0;
  cursor: pointer;
}
.char-container img {
  max-height: 100px;
  margin-bottom: 13px;
  transition: transform 0.3s ease, margin 0.3s ease;
}
.char-container h2 {
  text-transform: capitalize;
  font-size: 1.5em;
  font-weight: 600;
  transition: font-size 0.3s ease;
}
.char-container:hover img {
  transform: scale(1.3);
  margin-bottom: 17px;
}
.char-container:hover h2 {
  font-size: 1.2em;
}

.stadium {
  background: #7DCD79;
}
.stadium > section {
  display: block;
  box-sizing: border-box;
}
.stadium > section .char {
  height: 175px;
  position: relative;
}
.stadium > section .char > * {
  position: absolute;
  text-transform: capitalize;
}
.stadium > section .char img {
  height: 150px;
}
.stadium > section .char .data {
  background: #CCC;
  width: 20vw;
  padding: 15px 2%;
  box-sizing: border-box;
  top: 25px;
}
.stadium > section .char .data progress {
  width: 100%;
}
.stadium > section .char .data p {
  text-align: right;
}
.stadium .enemy img {
  right: 15vw;
}
.stadium .enemy .data {
  left: 15vw;
}
.stadium .hero img {
  left: 15vw;
}
.stadium .hero .data {
  right: 15vw;
}

.attack-list {
  display: flex;
  flex-wrap: wrap;
  background: #FFFAFA;
  position: initial;
  transtion: opacity 0.3s ease;
  text-transform: capitalize;
}
.attack-list.disabled {
  opacity: 0.5;
  position: relative;
  z-index: -1;
  cursor: initial;
}
.attack-list li {
  width: 50%;
  text-align: center;
  padding: 25px 0;
  box-sizing: border-box;
  border: 1px solid #666;
  cursor: pointer;
  transition: background 0.3s ease;
}
.attack-list li:hover {
  background: #EEE;
}

.modal-out {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background: rgba(33, 33, 33, 0.75);
  z-index: 900;
}
.modal-out .modal-in {
  position: fixed;
  top: 15vh;
  left: 0;
  right: 0;
  width: 50vw;
  height: 70vh;
  margin: 0 auto;
  background: #FFFAFA;
}
.modal-out .modal-in header {
  position: relative;
  min-height: 30px;
  text-align: center;
  padding: 10px 3%;
  box-sizing: border-box;
}
.modal-out .modal-in header h1 {
  font-size: 2.2em;
}
.modal-out .modal-in .close {
  cursor: pointer;
  position: absolute;
  top: 13px;
  right: 13px;
}
.modal-out .modal-in section {
  box-sizing: border-box;
  padding: 25px 3%;
}

div#battlelogs {
    border: 1px solid black;
    padding: 10px;
    margin-top: 14px;
	min-height:160px;

}

.btllogs {
    border: 1px solid red;
    padding: 2px;
    margin-top: 6px;
	display:none;
}

.battlemsg {
    width: 600px;
    padding: 20px;
    position: absolute;
    z-index: 999;
	display:none;
}

.btmsg {
    width: 50%;
    background: #b7b1b1;
    padding: 10px;
    height: 121px;
    margin-left: 611px;
    text-align: center;
    padding-top: 39px;
}

.fadebattle {
	opacity:0.3;
}
</style>

<audio controls autoplays loop>
    <source src="https://vgmsite.com/soundtracks/pokemon-gameboy-sound-collection/jucncspp/115-battle%20%28vs%20trainer%29.mp3" type="audio/mpeg">
</audio>




<section class="stadium">


   <section class="enemy" style="padding: 70px 0px;">
      <section class="char">
         <img class="" src="sprites/sprites/pokemon/<?php echo $p2['pokemon']; ?>.png" alt="charmander">
         <aside class="data">
            <h2>
			<?php echo $p2['pokename']; ?>
			</h2>
			<p><?php $x2= loadmember($p2['user']); echo $x2['fullname'];?></p>
            <div>
               <progress id='progressp1' max="<?php echo $p2['hp']; ?>" value="<?php echo $p2['hp']; ?>"></progress>
               <p><span id='progressp1txt'><?php echo $p2['hp']; ?></span>/<?php echo $p2['hp']; ?></p>
            </div>
         </aside>
      </section>
   </section>


<div class='battlemsg'>
	<div class='btmsg'><h2><?php echo $winmsg; ?></h2></div>
</div>



    <section class="hero" style="padding: 70px 0px;">
      <section class="char">
         <img class="p1user" src="sprites/sprites/pokemon/<?php echo $p1['pokemon']; ?>.png" alt="squirtle">
         <aside class="data">
            <h2>
			<?php echo $p1['pokename']; ?>		
			</h2>
			<p><?php $x2= loadmember($p1['user']); echo $x2['fullname'];?></p>
            <div>
               <progress id='progressp2' max="<?php echo $p1['hp']; ?>" value="<?php echo $p1['hp']; ?>"></progress>
               <p><span id='progressp2txt'><?php echo $p1['hp']; ?></span>/<?php echo $p1['hp']; ?></p>
            </div>
         </aside>
      </section>
   </section> 	  
	  

   	  
	  
 
   <br style='clear:both;'/>
</section>


<script>
function p2atk(){
	
  $(".enemy .char img").animate(
    {
      "margin-right": "-30px",
      "margin-top": "-10px"
    },
    50,
    "swing"
  );
  $(".enemy .char img").animate(
    {
      "margin-right": "30px",
      "margin-top": "10px"
    },
    50,
    "swing"
  );
  $(".enemy .char img").animate(
    {
      "margin-right": "0px",
      "margin-top": "0px"
    },
    50,
    "swing"
  );	
}


function p1atk(){

    $(".hero .char img").animate(
      {
        "margin-left": "-30px",
        "margin-top": "10px"
      },
      50,
      "swing"
    );
    $(".hero .char img").animate(
      {
        "margin-left": "30px",
        "margin-top": "-10px"
      },
      50,
      "swing"
    );
    $(".hero .char img").animate(
      {
        "margin-left": "0px",
        "margin-top": "0px"
      },
      50,
      "swing"
    );	
	
}

function showfight(){
	jQuery('#showfight').hide();
	$( ".btllogs" ).each(function( index ) {
		setTimeout(function(){
			  var abc = "#blogs"+(index+1);
			  
			  var turn = jQuery(abc).attr('data-turn');
			  var dealer = jQuery(abc).attr('data-dealer');
			  var enemyhp = jQuery(abc).attr('data-enemyhp');
			  var dataturn = jQuery(abc).attr('data-turn');
			  var notes = jQuery(abc).attr('data-notes');
		      console.log(jQuery(abc).text());
			jQuery('#battlelogs').append("<br> Round"+jQuery(abc).attr('data-round')+" --"+notes);
			  
			  
			  if(turn==1){
				  		  
				p1atk(); 
				jQuery('#progressp1').attr('value',enemyhp);
				jQuery('#progressp1txt').text(enemyhp);				
			  }else{
				p2atk(); 
				jQuery('#progressp2').attr('value',enemyhp);
				jQuery('#progressp2txt').text(enemyhp);
			  }
		},2000 * (index+1)); 	  	  	    	    
	});	
	setTimeout(function(){
		jQuery('.battlemsg').fadeIn();
		jQuery('.hero').addClass('fadebattle');
		jQuery('.enemy').addClass('fadebattle');
	},2200 * (jQuery('.btllogs').length));
	
}
</script>


<?php
	
	$logc = 1;
	$round = 1;
	
	$turntime = 0;
	foreach($logs as $a){
		
		
		
		if($p1['id']==$a['dealer']){
			$turn = 1;
		}else{
			$turn = 2;
		}
	
		if($turntime % 2 == 0)  {
			$round++;
		}
	
		$turntime++;
	
	
		
	?>
	
	<div id='blogs<?php echo $logc ?>' class='btllogs' data-round='<?php echo $round - 1; ?>' data-turn='<?php echo $turn; ?>' data-dealer='<?php echo $a['dealer']; ?>' data-enemyhp='<?php echo $a['enemyhp']; ?>' data-damage='<?php echo $a['damage']; ?>' data-notes='<?php for ($x = 1; $x <= $round; $x++) { echo ">>>"; } ?><?php echo htmlentities(implode(",",$a['notes'])); ?>'>
	Turn <?php echo $logc ?>:
	</div>
	<?php
		$logc++;
	}
?>
<h2>Battle Logs:</h2>
<div id='battlelogs'>
</div>
<br style='clear:both;'/>
 <button id='showfight' type="button" onclick="showfight()" class="btn btn-primary">Show Fight!</button>