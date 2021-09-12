<?php    

	include("connect.php");
	include("function.php");
	$x = 1;
	
//mysql_query_md();
	
		while($x<=898){
			

$json = file_get_contents('https://pokeapi.co/api/v2/pokemon/'.$x);
$obj = json_decode($json,true);	


foreach($obj['moves'] as $d){
	
	$str = "move";

	$name = $d[$str]['name'];
	$id = str_replace("https://pokeapi.co/api/v2/$str/","",$d[$str]['url']);
	
	$idd = str_replace("/","",$id);

	$q = "INSERT INTO tbl_moves SET id='$idd',name='$name' ON DUPLICATE KEY UPDATE id=VALUES(id)";
	
	echo $q."<br>";

	//echo $d['move']['name']."==".$d['move']['url']."<br>";
	 $q2 = "INSERT INTO tbl_relation SET pokemon='$x',relation_id='$idd',relation_type='$str'";
	
	echo $q2."<br>";
	
	
	mysql_query_md($q);
	mysql_query_md($q2);	
}


echo "<hr>";

foreach($obj['abilities'] as $d){


	$str = "ability";

	$name = $d[$str]['name'];
	$id = str_replace("https://pokeapi.co/api/v2/$str/","",$d[$str]['url']);
	
	$idd = str_replace("/","",$id);

	$q = "INSERT INTO tbl_ability SET id='$idd',name='$name' ON DUPLICATE KEY UPDATE id=VALUES(id)";
	
	echo $q."<br>";
	//echo $d['ability']['name']."==".$d['ability']['url']."<br>";
	 $q2 = "INSERT INTO tbl_relation SET pokemon='$x',relation_id='$idd',relation_type='$str'";
	
	echo $q2."<br>";	
	
	mysql_query_md($q);
	mysql_query_md($q2);
}



echo "<hr>";

foreach($obj['types'] as $d){

	$str = "type";

	$name = $d[$str]['name'];
	$id = str_replace("https://pokeapi.co/api/v2/$str/","",$d[$str]['url']);
	
	$idd = str_replace("/","",$id);

	$q = "INSERT INTO tbl_type SET id='$idd',name='$name' ON DUPLICATE KEY UPDATE id=VALUES(id)";
	
	echo $q."<br>";

	//echo $d['type']['name']."==".$d['type']['url']."<br>";
	
	 $q2 = "INSERT INTO tbl_relation SET pokemon='$x',relation_id='$idd',relation_type='$str'";
	
	echo $q2."<br>";	
	
	
	mysql_query_md($q);
	mysql_query_md($q2);	
}






echo "<hr>";

//front
echo $obj['sprites']['front_default'];
echo "<br>";
echo $obj['sprites']['back_default'];
echo "<br>";
echo $obj['sprites']['other']['official-artwork']['front_default'];
echo "<br>";
echo $obj['name'];
echo "<br>";
//mysql_query_md


echo $query = "INSERT INTO tbl_pokemon SET id='$x',name='{$obj['name']}',front='{$obj['sprites']['front_default']}',back='{$obj['sprites']['back_default']}',main='{$obj['sprites']['other']['official-artwork']['front_default']}'";



mysql_query_md($query);






$x++;

sleep(3);
		}	