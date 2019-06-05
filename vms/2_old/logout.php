<?php
session_start();

unset($_SESSION['bhead_username']);

header('Location: ../index.php');


?>
