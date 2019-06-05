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

$acct = $_POST['payee_frm'];

if(!empty($_POST['payee_new'])){
	mysql_query("INSERT INTO sup_bank_accounts (account_name, account_number) VALUES('".$_POST['payee_new']."', '".$_POST['accnt_frm']."')") or die(mysql_error());
	$acct = $_POST['payee_new'];
}

$breakdown = mysql_real_escape_string($_POST["breakdown"]);

//die("INSERT INTO check_req (date_submitted,bank,payee_name,mode_of_payment,payee,accnt_no,amount,date_of_check,breakdown,prepared_by,audited_by,approved_by,submitted_by,branch_submitted,attachment,attachment2,attachment3, ref_no) VALUES ('" . $_POST['date_submitted'] . "', '".$_POST['bank']."', '".$_POST['payeeName']."', '".$_POST['modeOfPayment']."','$acct','" . $_POST['accnt_frm'] . "','" . $_POST['amount'] . "','" . $_POST['date_of_check'] . "','" . $_POST['breakdown'] . "','" . $_POST['prepared_by'] . "','" . $_POST['audited_by'] . "','" . @$_POST['approved_by'] . "','" . $_POST['submitted_by'] . "','" . $_SESSION['branch'] . "','$attachment','$attachment2','$attachment3','".$_POST['ref_no']."')"");


if (mysql_query("INSERT INTO check_req (date_submitted,bank,payee_name,mode_of_payment,payee,accnt_no,amount,date_of_check,breakdown,prepared_by,audited_by,approved_by,submitted_by,branch_submitted,attachment,attachment2,attachment3, ref_no)
                          VALUES('" . $_POST['date_submitted'] . "', '".$_POST['bank']."', '".$_POST['payeeName']."', '".$_POST['modeOfPayment']."','$acct','" . $_POST['accnt_frm'] . "','" . $_POST['amount'] . "','" . $_POST['date_of_check'] . "','" . $breakdown . "','" . $_POST['prepared_by'] . "','" . $_POST['audited_by'] . "','" . @$_POST['approved_by'] . "','" . $_POST['submitted_by'] . "','" . $_SESSION['branch'] . "','$attachment','$attachment2','$attachment3','".$_POST['ref_no']."')")) {
    echo "<script>";
    echo "alert('Submitted Successfully...');";
    echo "location.replace('new_check_requisition.php');";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Failed to submit record...');";
    echo "window.history.back();";
    echo "</script>";
}
?>