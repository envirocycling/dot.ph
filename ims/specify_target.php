<?php
include("config.php");

$month=$_POST['year']."/".$_POST['month'];
$branch=$_POST['branch'];
$target=$_POST['target'];

$branch=preg_split("[_]",$branch);
$branch_id=$branch[0];
$branch_name=$branch[1];


if(mysql_query("INSERT INTO target_per_month (branch_id,branch_name,month,target)
                                    VALUES('$branch_id','$branch_name','$month','$target');

")) {
    echo "<script>";
    echo "alert('Target for $branch_name has been specified successfully...');";
    echo "window.history.back();";
    echo "</script>";

}else {
    echo "<script>";
    echo "alert('Failed to specify target for branch $branch_name ...');";
    echo "window.history.back();";
    echo "</script>";
    

}


?>