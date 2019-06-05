<?php
include("config.php");

$chk = $_POST['chk'];
$error = 0;
$del = 0;
foreach ($chk as $selected){
	if(mysql_query("DELETE from bales WHERE log_id='$selected'") or die(mysql_error())){
		$del++;
	}else{
		$error++;
	}
}
?>
<script>
	alert("<?php echo $del;?>  Bales Successfully Deleted.");
	alert("<?php echo $error;?>  Bale/s Not Deleted.");
	location.replace("bm_prod_report.php");
</script>
