<?php
include('connect.php');
$id =  $_GET['select'];
$select = mysql_query("SELECT * from tbl_input WHERE id='$id'") or die (mysql_error());
$row = mysql_fetch_array($select);
?>
<form action="change_input_new_pro.php?id=<?php echo $id;?>" method="post">
	<input type="text" value="<?php echo $row['con'];?>" name="con" style="width:50px">
	<input type="submit" value="Submit">
</form>