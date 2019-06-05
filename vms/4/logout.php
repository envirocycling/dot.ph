<?php
session_start();

unset($_SESSION['public_username']);

header('Location: ../index.php');

session_destroy();
?>
