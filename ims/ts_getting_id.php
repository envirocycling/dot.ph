<?php
include 'config.php';
$c = 0;
echo $ctr = $_POST['ctr'];
$branch = $_POST['branch'];
$bh = $_POST['bh'];
$url = $_POST['url'];
$que = preg_split("[/]",$url);
$sql = mysql_query("SELECT max(supplier_id) FROM supplier_details");
$rs = mysql_fetch_array($sql);
$supplier_id = $rs['max(supplier_id)'];
echo "<form action='http://$que[0]/ts/get.php' method='POST' name='myForm'>";
echo "<input type='hidden' name='url' value='$que[0]]'>";
echo "<input type='hidden' name='supplier_id' value='$supplier_id'>";
while ($c < $ctr) {
    $supplier_id++;
    $supplier_name = $_POST['supplier_name'.$c];
    $owner_name = $_POST['owner_name'.$c];
    $owner_contact = $_POST['owner_contact'.$c];
    $classification = $_POST['classification'.$c];
    $street = $_POST['street'.$c];
    $municipality = $_POST['municipality'.$c];
    $province = $_POST['province'.$c];
    $bank = $_POST['bank'.$c];
    $account_name = $_POST['account_name'.$c];
    $account_number = $_POST['account_number'.$c];
    $date_added = $_POST['date_added'.$c];
    $c++;
    mysql_query("INSERT INTO `supplier_details`
        (`supplier_id`,`supplier_name`, `classification`, `branch`, `bh_in_charge`, `bh_to_verified`, `street`, `municipality`, `province`, `owner`, `owner_contact`,`bank`, `acct_name`, `acct_no`, `date_added`)
        VALUES ('$supplier_id','$supplier_name','$classification','$branch','$bh','$bh','$street','$municipality','$province','$owner_name','$owner_contact','$bank','$account_name','$account_number','$date_added')");
}
echo "<input type='hidden' name='ctr' value='$c'>";
echo "</form>";
echo "<script>
    document.myForm.submit();
</script>";
?>