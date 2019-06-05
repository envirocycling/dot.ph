<?php
session_start();
include("config.php");
$file=$_FILES['attachment']['tmp_name'];
$image= addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
$image_name= addslashes($_FILES['attachment']['name']);
$image_size= getimagesize($_FILES['attachment']['tmp_name']);
move_uploaded_file($_FILES["attachment"]["tmp_name"],"attachments/" . $_FILES["attachment"]["name"]);
$attachment="attachments/" . $_FILES["attachment"]["name"];


if (!empty ($image)) {
    if(mysql_query("UPDATE fund_req SET date_submitted='".$_POST['date_submitted']."', payee='".$_POST['payee']."', amount='".$_POST['amount']."', date_of_check='".$_POST['date_of_check']."', breakdown='".$_POST['breakdown']."', prepared_by='".$_POST['prepared_by']."', audited_by='".$_POST['audited_by']."', approved_by='".$_POST['approved_by']."', submitted_by='".$_POST['submitted_by']."', branch_submitted='".$_SESSION['branch']."', attachment='$attachment' WHERE log_id='".$_POST['log_id']."'")) {
        echo "<script>";
        echo "alert('Submitted Updated...');";
        echo "window.history.go(-2);";
        echo "</script>";
    }
    else {
        echo "<script>";
        echo "alert('Failed to update record...');";
        echo "window.history.back();";
        echo "</script>";
    }
} else {
    if(mysql_query("UPDATE fund_req SET date_submitted='".$_POST['date_submitted']."', payee='".$_POST['payee']."', amount='".$_POST['amount']."', date_of_check='".$_POST['date_of_check']."', breakdown='".$_POST['breakdown']."', prepared_by='".$_POST['prepared_by']."', audited_by='".$_POST['audited_by']."', approved_by='".$_POST['approved_by']."', submitted_by='".$_POST['submitted_by']."', branch_submitted='".$_SESSION['branch']."' WHERE log_id='".$_POST['log_id']."'")) {
        echo "<script>";
        echo "alert('Submitted Updated...');";
        echo "window.history.go(-2);";
        echo "</script>";
    }
    else {
        echo "<script>";
        echo "alert('Failed to update record...');";
        echo "window.history.back();";
        echo "</script>";
    }
}
?>