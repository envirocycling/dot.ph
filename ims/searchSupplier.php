<?php
session_start();
$_SESSION['supplier_id']=$_POST['supplier_id'];
$_SESSION['supplier_name']=$_POST['supplier_name'];
$_SESSION['supplier_branch']=$_POST['supplier_branch'];
$_SESSION['supplier_type']=$_POST['supplier_type'];
$_SESSION['yearcriteria']=$_POST['year'];
$_SESSION['bh_criteria']=$_POST['bh_in_charge'];
$_SESSION['criteria_wp_grade']=$_POST['wp_grade'];


?>
<script>
    window.history.back();
</script>