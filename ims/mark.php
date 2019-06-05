<?php
include('config.php');
$del_id=$_GET['del_id'];


$query="SELECT alert FROM sup_deliveries where del_id=$del_id;";
$result=mysql_query($query);
if($row = mysql_fetch_array($result)) {
    $mark="";
    if($row['alert']!='!') {
        $mark='!';
    }else {
        $mark="";
    }
    if(mysql_query("Update sup_deliveries set alert='$mark' where del_id=$del_id")) {
        header("Location:".$_SERVER['HTTP_REFERER']);
    }else {
        echo "<script>";
        echo "alert('Failed to mark record...');";
        echo "window.history.back();";
        echo "</script>";
    }

}else {
    echo "<script>";
    echo "alert('Failed to mark record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>