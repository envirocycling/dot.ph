<?php

session_start();
include("config.php");

$file = $_FILES['attachment']['tmp_name'];
$image = addslashes(file_get_contents($_FILES['attachment']['tmp_name']));
$image_name = addslashes($_FILES['attachment']['name']);
$image_size = getimagesize($_FILES['attachment']['tmp_name']);
move_uploaded_file($_FILES["attachment"]["tmp_name"], "attachments/" . $_FILES["attachment"]["name"]);
$attachment = "attachments/" . $_FILES["attachment"]["name"];

if (mysql_query("INSERT INTO fund_req (date_submitted,payee,amount,date_of_check,breakdown,prepared_by,audited_by,approved_by,submitted_by,branch_submitted,attachment)
                          VALUES('" . $_POST['date_submitted'] . "','" . $_POST['payee'] . "','" . preg_replace("/,/", '', $_POST['amount']) . "','" . $_POST['date_of_check'] . "','" . $_POST['breakdown'] . "','" . $_POST['prepared_by'] . "','" . $_POST['audited_by'] . "','" . $_POST['approved_by'] . "','" . $_POST['submitted_by'] . "','" . $_SESSION['branch'] . "','$attachment')")) {
    echo "<script>";
    echo "alert('Submitted Successfully...');";
    echo "window.history.go(-2);";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Failed to submit record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>