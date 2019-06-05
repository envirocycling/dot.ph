<?php

@session_start();
include 'config.php';
mysql_query("DELETE FROM suppliers_price WHERE material_id='" . $_POST['mat'] . "' and supplier_id='" . $_POST['supplier_id'] . "' and date='" . $_POST['date'] . "'");

mysql_query("INSERT INTO suppliers_price (`material_id`, `supplier_id`, `price`, `user_id`, `date`, `date_encode`)
    VALUES ('" . $_POST['mat'] . "','" . $_POST['supplier_id'] . "','" . $_POST['price'] . "','" . $_SESSION['user_id'] . "','" . $_POST['date'] . "', '" . date("Y/m/d") . "')");
?>