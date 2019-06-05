<?php

session_start();
include("config.php");

$file = $_FILES['attachment']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
$image_name = addslashes($_FILES['attachment']['name']);
$image_size = getimagesize($_FILES['attachment']['tmp_name']);
move_uploaded_file($_FILES["attachment"]["tmp_name"], "attachments/" . $_FILES["attachment"]["name"]);
if (!empty($file)) {
    $attachment = "attachments/" . $_FILES["attachment"]["name"];
} else {
    $attachment = "attachments/";
}

$file = $_FILES['attachment2']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment2']['tmp_name']));
$image_name = addslashes($_FILES['attachment2']['name']);
$image_size = getimagesize($_FILES['attachment2']['tmp_name']);
move_uploaded_file($_FILES["attachment2"]["tmp_name"], "attachments/" . $_FILES["attachment2"]["name"]);
if (!empty($file)) {
    $attachment2 = "attachments/" . $_FILES["attachment2"]["name"];
} else {
    $attachment2 = "attachments/";
}

$file = $_FILES['attachment3']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment3']['tmp_name']));
$image_name = addslashes($_FILES['attachment3']['name']);
$image_size = getimagesize($_FILES['attachment3']['tmp_name']);
move_uploaded_file($_FILES["attachment3"]["tmp_name"], "attachments/" . $_FILES["attachment3"]["name"]);
if (!empty($file)) {
    $attachment3 = "attachments/" . $_FILES["attachment3"]["name"];
} else {
    $attachment3 = "attachments/";
}

if (mysql_query("INSERT INTO cash_req (date_submitted,payee,accnt_no,amount,date_of_check,breakdown,prepared_by,audited_by,audited_by2,approved_by,submitted_by,branch_submitted,attachment,attachment2,attachment3)
                          VALUES('" . $_POST['date_submitted'] . "','" . $_POST['payee'] . "','" . $_POST['accnt_no'] . "','" . $_POST['amount'] . "','" . $_POST['date_of_check'] . "','" . $_POST['breakdown'] . "','" . $_POST['prepared_by'] . "','" . $_POST['audited_by'] . "','" . $_POST['audited_by2'] . "','" . $_POST['approved_by'] . "','" . $_POST['submitted_by'] . "','" . $_SESSION['branch'] . "','$attachment','$attachment2','$attachment3')")) {
    echo "<script>";
    echo "alert('Submitted Successfully...');";
    echo "location.replace('new_cash_requisition.php');";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Failed to submit record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>