
<?php
include('connect.php');

mysql_query("UPDATE tbl_truckrequest SET status='".$_GET['action']."' WHERE id='".$_GET['id']."'");