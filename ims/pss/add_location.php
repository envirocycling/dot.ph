<?php
session_start();
include './../config.php';


if(isset($_POST['locationSubmit'])) {

  $id = $_POST['log_id'];
  $location = $_POST['location'];

  $queryLocationStr = "UPDATE outgoing_pss set location='$location' WHERE id='$id';";
  mysql_query($queryLocationStr) or die(mysql_error());

  header('Location: index.php');
  
}

?>
