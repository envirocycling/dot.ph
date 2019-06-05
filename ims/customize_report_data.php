<?php
//include("config.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//$sql_sup = mysql_query("SELECT supplier_id,supplier_name FROM supplier_details WHERE branch like '%$filtering_branch%' and status!='inactive'");
//$outp = "[";
//while ($rs_sup = mysql_fetch_array($sql_sup)) {

$conn = new mysqli("localhost", "root", "", "efi_ims");

$result = $conn->query("SELECT supplier_id,supplier_name FROM supplier_details WHERE status!='inactive'");

$outp = "[";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "[") {
        $outp .= ",";
    }
    $outp .= '{"ID":"'  . $rs["supplier_id"] . '",';
    $outp .= '"Name":"'   . $rs["supplier_name"]        . '",';
    $outp .= '"Owner":"'. $rs["supplier_name"]     . '"}';
}
$outp .="]";

$conn->close();

echo($outp);
?>