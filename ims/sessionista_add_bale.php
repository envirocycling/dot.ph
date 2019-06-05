<?php session_start();?>
<script>
    function closeMe(){
        window.close();
    }
</script>
<?php

include ('config.php');
$bale_id=$_GET['bale_id'];
$branch=$_SESSION['user_branch'];
if($bale_id=='select_all') {
    $query="SELECT log_id FROM bales where str_no=0  and branch='$branch'";
    $result=mysql_query($query);
    while($row = mysql_fetch_array($result)) {
        array_push($_SESSION['bales_to_pack'],$row['log_id']);
    }
    $_SESSION['isall']='yes';
    echo "<script>
    window.opener.location.href = 'bale_list.php' ;
    closeMe();
</script>";
}else {
    array_push($_SESSION['bales_to_pack'],$bale_id);
}


?>