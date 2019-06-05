<?php
session_start();

unset($_SESSION['a_username']);

header('Location: ../index.php');

session_destroy();
?>
