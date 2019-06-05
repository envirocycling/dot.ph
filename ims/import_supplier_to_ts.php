<?php

ini_set('max_execution_time', 1000);
include 'config.php';
echo "<div align='center'>";
echo "<br><br><br>";
echo "<font color='Blue' size='30'>Getting data from IMS</font>";
echo "<br>";
echo "<font color='Blue' size='30'>Please Wait</font>";
echo "<br>";
echo "<img src='../images/ajax-loader.gif'>";
echo "</div>";
$url = $_POST['url'];
$que = preg_split("[/]", $url);
$count = 0;
$sql = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
while ($rs = mysql_fetch_array($sql)) {
    $count++;
}
$ctr = 0;
echo "<form action='http://$que[0]/ts/import.php?count=$count' method='POST' name='myForm'>";
$sql = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
while ($rs = mysql_fetch_array($sql)) {
    echo "<input type='hidden' name='supplier_id" . $ctr . "' value='" . $rs['supplier_id'] . "'>";
    echo "<input type='hidden' name='supplier_name" . $ctr . "' value='" . $rs['supplier_name'] . "'>";
    echo "<input type='hidden' name='branch" . $ctr . "' value='" . $rs['branch'] . "'>";
    echo "<input type='hidden' name='owner_name" . $ctr . "' value='" . $rs['owner'] . "'>";
    echo "<input type='hidden' name='owner_contact" . $ctr . "' value='" . $rs['owner_contact'] . "'>";
    echo "<input type='hidden' name='classification" . $ctr . "' value='" . $rs['classification'] . "'>";
    echo "<input type='hidden' name='street" . $ctr . "' value='" . $rs['street'] . "'>";
    echo "<input type='hidden' name='municipality" . $ctr . "' value='" . $rs['municipality'] . "'>";
    echo "<input type='hidden' name='province" . $ctr . "' value='" . $rs['province'] . "'>";
    echo "<input type='hidden' name='bank" . $ctr . "' value='" . $rs['bank'] . "'>";
    echo "<input type='hidden' name='account_name" . $ctr . "' value='" . $rs['account_name'] . "'>";
    echo "<input type='hidden' name='account_number" . $ctr . "' value='" . $rs['account_number'] . "'>";
    echo "<input type='hidden' name='date_added" . $ctr . "' value='" . $rs['date_added'] . "'>";
    echo "<br>";
    $ctr++;
}

echo "<input type='hidden' name='url' value='$que[0]'>";
echo "<input type='hidden' name='ctr' value='$ctr'>";
echo "</form>";
echo "
 <script>
     document.myForm.submit();
 </script>";
?>