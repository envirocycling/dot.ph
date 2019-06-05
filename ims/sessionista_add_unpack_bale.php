<script>
    function closeMe(){
        window.close();
    }
</script>
<?php
session_start();
include ('config.php');
$bale_id=$_GET['bale_id'];
if($bale_id=='select_all') {
    $query="SELECT log_id FROM bales where str_no!=0";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        array_push($_SESSION['bales_to_unpack'],$row['log_id']);
    }

    $_SESSION['isall']='yes';
    echo "<script>
    window.opener.location.href = 'out_bales.php' ;
    closeMe();
</script>";
}else {
    array_push($_SESSION['bales_to_unpack'],$bale_id);
}


?>