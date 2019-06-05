<?php
session_start();
include("config.php");
$file = $_FILES['attachment']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
$image_name = addslashes($_FILES['attachment']['name']);
$image_size = getimagesize($_FILES['attachment']['tmp_name']);
move_uploaded_file($_FILES["attachment"]["tmp_name"], "attachments/" . $_FILES["attachment"]["name"]);
$attachment = "attachments/" . $_FILES["attachment"]["name"];

$file = $_FILES['attachment2']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment2']['tmp_name']));
$image_name = addslashes($_FILES['attachment2']['name']);
$image_size = getimagesize($_FILES['attachment2']['tmp_name']);
move_uploaded_file($_FILES["attachment2"]["tmp_name"], "attachments/" . $_FILES["attachment2"]["name"]);
$attachment2 = "attachments/" . $_FILES["attachment2"]["name"];

$file = $_FILES['attachment3']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment3']['tmp_name']));
$image_name = addslashes($_FILES['attachment3']['name']);
$image_size = getimagesize($_FILES['attachment3']['tmp_name']);
move_uploaded_file($_FILES["attachment3"]["tmp_name"], "attachments/" . $_FILES["attachment3"]["name"]);
$attachment3 = "attachments/" . $_FILES["attachment3"]["name"];

if (mysql_query("UPDATE fund_req SET date_submitted='" . $_POST['date_submitted'] . "', payee='" . $_POST['payee'] . "', accnt_no='" . $_POST['accnt_no'] . "', amount='" . $_POST['amount'] . "', date_of_check='" . $_POST['date_of_check'] . "', breakdown='" . $_POST['breakdown'] . "', prepared_by='" . $_POST['prepared_by'] . "', audited_by='" . $_POST['audited_by'] . "', approved_by='" . $_POST['approved_by'] . "', submitted_by='" . $_POST['submitted_by'] . "', branch_submitted='" . $_SESSION['branch'] . "' WHERE log_id='" . $_POST['log_id'] . "'")) {
    if ($attachment != 'attachments/') {
        mysql_query("UPDATE fund_req SET attachment='$attachment' WHERE log_id='" . $_POST['log_id'] . "'");
    }
    if ($attachment2 != 'attachments/') {
        mysql_query("UPDATE fund_req SET attachment2='$attachment2' WHERE log_id='" . $_POST['log_id'] . "'");
    }
    if ($attachment3 != 'attachments/') {
        mysql_query("UPDATE fund_req SET attachment3='$attachment3' WHERE log_id='" . $_POST['log_id'] . "'");
    }
    echo "<script>";
    echo "alert('Submitted Updated...');";
    echo "location.replace('new_fund_requisition.php')";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Failed to update record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>