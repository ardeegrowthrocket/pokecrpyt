﻿<?php
$primary = "id";
$pid = $_GET['id'];
$tbl = "tbl_expenses";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
while($row=mysql_fetch_md_assoc($query))
{
	foreach($row as $key=>$val)
	{
		 $sdata[$key] = $val;
	}
}

$sdata['actual'] = date("Y-m-d",strtotime($sdata['actual']));


$field[] = array("type"=>"date","value"=>"actual","label"=>"Date");
$field[] = array("type"=>"number","value"=>"amount","label"=>"Amount");
$field[] = array("type"=>"textarea","value"=>"remarks","label"=>"Remarks");

?>
<h2>Edit Expenses - <?php echo $sdata['remarks']; ?> - <?php echo $sdata['amount']; ?></h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
	  <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $sdata[$primary];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 

