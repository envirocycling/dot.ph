<?php
include 'configPhp.php';
$payment_id = $_POST['payment_id'];
$bank_code = $_POST['bank_code'];
$cheque_no = $_POST['cheque_no'];
$voucher_no = $_POST['voucher_no'];
$cheque_name = $_POST['cheque_name'];
$supplier_name = $_POST['supplier_name'];
$sub_total = $_POST['sub_total'];
$ts_fee = $_POST['ts_fee'];
$adjustments = $_POST['adjustments'];
$grand_total = $_POST['grand_total'];
$account_name = $_POST['account_name'];
$account_number = $_POST['account_number'];
$ap = $_POST['ap'];
$verifier = $_POST['verifier'];
$signatory = $_POST['signatory'];
$url = $_POST['url'];

$pay_id_data = preg_split("[-]", $payment_id);
$que_url = preg_split("[/]", $url);

$sql_check = mysql_query("SELECT * FROM payment WHERE branch_code='$payment_id'");
$rs_num_row = mysql_num_rows($sql_check);

if ($pay_id_data[0] == 'Pampanga' || $pay_id_data[0] == 'PAMPANGA' || $pay_id_data[0] == 'pampanga') {
    $status = "approved";
    $url = $que_url[0];
} else {
    $status = "";
    $url = $que_url[0] . "/" . $que_url[1];
}

if ($rs_num_row == 0) {
    mysql_query("INSERT INTO `payment`(`branch_code`, `bank_code`, `cheque_no`, `voucher_no`, `cheque_name`, `supplier_name`, `sub_total`, `ts_fee`, `adjustments`, `grand_total`, `type`, `account_name`, `account_number`, `status`, `ap`, `verifier`, `signatory`,`date`,`time`)
        VALUES ('$payment_id','$bank_code','$cheque_no','$voucher_no','$cheque_name','$supplier_name','$sub_total','$ts_fee','$adjustments','$grand_total','Receiving','$account_name','$account_number','$status','$ap','$verifier','$signatory','" . date("Y/m/d") . "','" . date("h:i:s a") . "')");
    $ctr = 0;

    while ($ctr < $_POST['ctr_adj']) {
        $adj_type = $_POST['adj_type' . $ctr];
        $desc = $_POST['desc' . $ctr];
        $amount = $_POST['amount' . $ctr];
        mysql_query("INSERT INTO `payment_adjustment`(`payment_id`, `adj_type`, `desc`, `amount`)
        VALUES ('$payment_id','$adj_type','$desc','$amount')");
        $ctr++;
    }

    $ctr = 0;
    while ($ctr < $_POST['rec_det_adj']) {
        $wp_grade = $_POST['wp_grade' . $ctr];
        $net_weight = $_POST['net_weight' . $ctr];
        $price = $_POST['price' . $ctr];
        $amount = $_POST['amount2' . $ctr];
        $adj_price = $_POST['adj_price' . $ctr];
        $adj_amount = $_POST['adj_amount' . $ctr];
        mysql_query("INSERT INTO `payment_details`(`payment_id`, `wp_grade`, `net_weight`, `price`, `amount`, `adj_price`, `adj_amount`)
            VALUES ('$payment_id','$wp_grade','$net_weight','$price','$amount','$adj_price','$adj_amount')");
        $ctr++;
    }

    $que = preg_split("[-]", $payment_id);
    echo "<form action='http://" . $url . "/payment_approved.php' method='POST' name='myForm'>";
    echo "<input type='hidden' name='payment_id' value='$que[1]'>";
    echo "</form>";
    echo "<script>
    document.myForm.submit();
</script>";
} else {
    ?>
    <script>
        alert('This payment already submitted online.');
        location.replace('http://<?php echo $url; ?>/index.php');
    </script>
    <?php
}
?>