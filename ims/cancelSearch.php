<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
$_SESSION['supplier_branch']="";
$_SESSION['supplier_id']="";
$_SESSION['supplier_name']="";
$_SESSION['supplier_type']="";
$_SESSION['yearcriteria']=date('Y');
$_SESSION['bh_criteria']='';
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>