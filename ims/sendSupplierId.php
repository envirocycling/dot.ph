
<?php
date_default_timezone_set('America/Los_Angeles');
session_start();
include('config.php');
$id=$_GET['id'];
$query="SELECT supplier_name from supplier_details where supplier_id='$id';";
$result=mysql_query($query);
$supplier_array=array();
$row = mysql_fetch_array($result);
$_SESSION['encoding_supplier_id']=$id;
if($_SESSION['encoding_supplier_name']=='') {
    $_SESSION['encoding_supplier_name']="<b>Unregistered Supplier ID</b>";
}else {
    if($row['supplier_name']=='') {
        $_SESSION['encoding_supplier_name']="<b>Unregistered Supplier ID</b>";

    }else {
        $_SESSION['encoding_supplier_name']=$row['supplier_name'];
        
    }
}

?>