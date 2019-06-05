<?php
@session_start();
include 'config.php';
$num = 1;
$num2 = 8;
$res = 0;
$sql_pr = mysql_query("SELECT * from requests WHERE request_id='" . $_POST['request_number'] . "' ") or die (mysql_error());
$row_pr = mysql_fetch_array($sql_pr);

$sql_pr2 = mysql_query("SELECT * from requests WHERE justification LIKE '%tire%' and request_id='" . $_POST['request_number'] . "' ") or die (mysql_error());

if(mysql_num_rows($sql_pr2) > 0){
	$res++;
}

while($num <= $num2){
		 $desc ='desc'.$num;
				$sql_desc = mysql_query("SELECT * from requests WHERE $desc LIKE '%tire%' and request_id='" . $_POST['request_number'] . "' ") or die (mysql_error());
			if(mysql_num_rows($sql_desc) > 0){
				$res++;
			}
		
$num++;	
}


if (!isset($_SESSION['name'])) {
    echo "<script>
alert('Session Expired......');
window.location = 'index.php';
</script>";
} else if($res > 0 ){
	mysql_query("UPDATE requests SET status='pending to cris',date_verified='" . date("Y/m/d h:i a") . "',verified_signature='" . $_SESSION['name'] . "' WHERE request_id='" . $_POST['request_number'] . "'");	
	
		echo "<script>
alert('Submitted successfully...');
window.location = 'home.php';
</script>";
	
}else{
    if($row_pr['verified'] == $row_pr['approved'] && $row_pr['new'] == '1'){
        mysql_query("UPDATE requests SET status='approved',date_verified='" . date("Y/m/d h:i a") . "',verified_signature='" . $_SESSION['name'] . "',date_approved='" . date("Y/m/d h:i a") . "',approved_signature='" . $_SESSION['name'] . "' WHERE request_id='" . $_POST['request_number'] . "'");
    }else{
     mysql_query("UPDATE requests SET status='pending',date_verified='" . date("Y/m/d h:i a") . "',verified_signature='" . $_SESSION['name'] . "' WHERE request_id='" . $_POST['request_number'] . "'");   
    }
    echo "<script>
alert('Submitted successfully...');
window.location = 'home.php';
</script>";
}

?>