<?php
if(!empty($_GET['id'])){
   $primary = "id";
   $pid = $_GET['id'];
   $tbl = "tbl_members";
   $query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
   while($row=mysql_fetch_md_assoc($query))
   {
      foreach($row as $key=>$val)
      {
          $sdata[$key] = $val;
      }
   }

}



$field[] = array("type"=>"text","value"=>"name");
$field[] = array("type"=>"text","value"=>"age");
$field[] = array("type"=>"text","value"=>"address");
$field[] = array("type"=>"text","value"=>"contact");
$field[] = array("type"=>"text","value"=>"spouse");
$field[] = array("type"=>"text","value"=>"occupation");
$field[] = array("type"=>"text","value"=>"dependents");

$release = array();
$release['0'] = "No";
$release['1'] = "Yes";
$field[] = array("type"=>"select","value"=>"is_offset","label"=>"User Is Offset?","option"=>$release);

// $field[] = array("skip"=>"text","label"=>"CO MAKER 1");
// $field[] = array("type"=>"text","value"=>"name1","label"=>"Name");
// $field[] = array("type"=>"text","value"=>"occupation1","label"=>"Occupation");
// $field[] = array("type"=>"text","value"=>"address1","label"=>"Address");
// $field[] = array("type"=>"text","value"=>"contact1","label"=>"Contact Number");

// $field[] = array("skip"=>"text","label"=>"CO MAKER 2");
// $field[] = array("type"=>"text","value"=>"name2","label"=>"Name");
// $field[] = array("type"=>"text","value"=>"occupation2","label"=>"Occupation");
// $field[] = array("type"=>"text","value"=>"address2","label"=>"Address");
// $field[] = array("type"=>"text","value"=>"contact2","label"=>"Contact Number");

$field[] = array("skip"=>"text","label"=>"CUSTOM LABEL");
$field[] = array("type"=>"text","value"=>"custom_label","label"=>"Label");
?>
<h2>Members</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
         <?php echo loadform($field,$sdata); ?>

         <hr>

         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 
