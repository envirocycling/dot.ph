<?php
session_start();

unset($_SESSION['encoder_username']);

header('Location: ../index.php');

session_destroy();
?>
