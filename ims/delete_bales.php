<?php
include('config.php');
$branch=$_POST['branch'];
$from=$_POST['from'];
$to=$_POST['to'];
//$code=$_POST['supervisor_code'];


if(!empty($from) || !empty($to)){
    if(mysql_query("DELETE FROM bales where branch='$branch' and date between '$from' and '$to' ") ) {
        echo "<script>";
        echo "alert('Deleted Successfully...');";
        echo "window.history.go(-3);";

        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to delete records...');";
        echo "window.history.go(-3);";

        echo "</script>";
    }

}else{
	echo "<script>";
        echo "alert('Please Enter Date Range to Delete.');";
        echo "window.history.go(-1);";

        echo "</script>";
}

?>