<?php
include("connect.php");
$ids = $_POST['id'];
$id=$_GET['ids'];

mysql_query("Delete from tbl_changeoil Where id='$id'") or die (mysql_error());
?>
  <script>
     alert("Successful.");
	 location.replace("m_changeoil.php?id=<?php echo $ids;?>");
    </script>
