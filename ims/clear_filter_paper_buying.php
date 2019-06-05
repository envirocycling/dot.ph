<?php
session_start();

$_SESSION['paper_buying_date']=date('Y/m');
$_SESSION['paper_buying_grade']='';
header("Location: ".$_SERVER['HTTP_REFERER']);
?>