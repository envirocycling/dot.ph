<?php
session_start();

?>
<?php
@$p=$_POST['plate'];
{ 
header("Location: truck_reassignment2.php?p=$p");
 } ?>