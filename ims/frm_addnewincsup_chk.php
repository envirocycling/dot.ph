
<?php
include('config.php');
$sql_supp = mysql_query("SELECT * from incentive_scheme WHERE sup_id='".$_POST['supplier_id']."' and wp_grade='".$_POST['wp_grade']."' and confirm='1' ORDER BY del_id Desc Limit 1");
$row_supp = mysql_fetch_array($sql_supp);

echo $row_supp['quota'].'~'.$row_supp['base_price'].'~'.$row_supp['incentive'].'~'.$row_supp['covered_incentive'].'~'.$row_supp['type'];

?>