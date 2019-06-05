<?php
session_start();
include('config.php');

foreach($_SESSION['receiving_del_ids'] as $del_id) {
    $query="SELECT is_highlighted FROM sup_deliveries where del_id=$del_id;";
    $result=mysql_query($query);
    if($row = mysql_fetch_array($result)) {
        $mark="";
        if($row['is_highlighted']!='yes') {
            $mark='yes';
        }else {
            $mark="";
        }
        mysql_query("UPDATE sup_deliveries set is_highlighted='$mark' where del_id=$del_id");
        header("Location:".$_SERVER['HTTP_REFERER']);

    }else {
        echo "<script>";
        echo "alert('Failed to highlight records...');";
        echo "window.history.back();";
        echo "</script>";
    }

}



?>