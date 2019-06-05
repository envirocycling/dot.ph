<?php
include('config.php');
$branch=$_POST['branch'];
$from=$_POST['from'];
$to=$_POST['to'];
if($branch=='Pasay'){
    $branch='Makati';

}
if($branch=='Kaybiga'){

$query="DELETE FROM actual where (branch='Kaybiga' or branch='Novaliches') and date between '$from' and '$to' and dr_number!=''";
}else{
$query="DELETE FROM actual where branch='$branch' and date between '$from' and '$to' and dr_number!=''";

}

if(mysql_query($query)) {
    echo "<script>";
    echo "alert('Deleted successfully...');";
    echo "window.history.back();";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to delete records...');";
    echo "window.history.back();";
    echo "</script>";
}


?>