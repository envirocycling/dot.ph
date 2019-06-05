<?php session_start();
$grade=$_POST['wp_grade'];
$_SESSION['weekly_wp_grade']=$grade;

$_SESSION['weekly_branch']=$_POST['branch'];

$_SESSION['weekly_month']=$_POST['weekly_month'];
$_SESSION['weekly_year']=$_POST['weekly_year'];


?>

<script>
window.history.back();
</script>