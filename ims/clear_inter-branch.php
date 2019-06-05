<?php
session_start();
$_SESSION['inter-branch_from']=date('Y/m/01');
$_SESSION['inter-branch_to']=date('Y/m/t');
header("Location:".$_SERVER['HTTP_REFERER']);

?>