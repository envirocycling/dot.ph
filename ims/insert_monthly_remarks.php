<?php
session_start();
include('config.php');
$date=$_POST['date'];
$remarks=$_POST['remarks'];
$supplier_id=$_POST['supplier_id'];
$user_id=$_POST['user_id'];
$date_inputed=date('Y/m/d');
$wp_grade=$_POST['wp_grade'];
$url="monthlyRemarks.php?id=".$_POST['url'];
$subject=$_POST['subject'];
if(mysql_query("INSERT INTO monthly_remarks(date,remarks,supplier_id,user_id,date_inputed,subject,wp_grade)
                                    VALUES('$date','$remarks','$supplier_id','$user_id','$date_inputed','$subject','$wp_grade')
")) {
    echo "<script>";
    echo "alert('Inserted successfully...');";
    echo "window.location='$url';";
    echo "</script>";
}else {
    echo "<script>";
    echo "alert('Failed to insert remarks...');";
    echo "window.history.back();";
    echo "</script>";
}
?>