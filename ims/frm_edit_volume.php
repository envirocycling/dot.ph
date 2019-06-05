<center>
    <h2>Edit Start Volume</h2>
    <hr>
    <?php
    include("config.php");

    if (isset($_GET['del_id'])) {
        $supplier_id = $_GET['del_id'];
        mysql_query("DELETE FROM sup_starting_volume WHERE supplier_id='$supplier_id'");
        echo "<script>";
        echo "alert('Deleted successfully...');";
        echo "window.close();";
        echo "</script>";
    }



    $que = $_GET['id'];
    $details = preg_split("/[_]/", $que);
    $id = $details[0];
    $volume_date = $details[1];
    $volume_date = date("F", strtotime($volume_date));
    $volume = $details[2];
    $supplier_id = $details[0];
    $branch = $details[3];
    $breaker_date = $details[4];
    $supplier_name = $details[5];

    $count = 0;
    $total_l6m = 0;
    $l6_months = date('Y/m/d', strtotime("-6 months", strtotime($details[4])));
    while ($l6_months < $breaker_date) {
        $l6m_year = date('Y', strtotime($l6_months));
        $l6m_month = date('F', strtotime($l6_months));

        $sql_l6m = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE branch_delivered='$branch' and supplier_id='$supplier_id' and month_delivered='$l6m_month' and year_delivered='$l6m_year'");

        $rs_l6m = mysql_fetch_array($sql_l6m);
        if (!empty($rs_l6m['sum(weight)'])) {
            $total_l6m+=$rs_l6m['sum(weight)'] / 1000;
            $count++;
        }
        $l6_months = date('Y/m/d', strtotime("+1 month", strtotime($l6_months)));
    }
    if ($count == 1) {
        $avg_l6m = $total_l6m / 1;
    }
    if ($count == 2) {
        $avg_l6m = $total_l6m / 2;
    }
    if ($count == 3) {
        $avg_l6m = $total_l6m / 3;
    }
    if ($count == 4) {
        $avg_l6m = $total_l6m / 4;
    }
    if ($count == 5) {
        $avg_l6m = $total_l6m / 5;
    }
    if ($count == 6) {
        $avg_l6m = $total_l6m / 6;
    }
    $avg = round($avg_l6m, 2);
    ?>
    <h3>Starting Volume of <?php echo $supplier_id . "_" . $supplier_name; ?></h3>
    <h3><?php echo $volume_date; ?></h3>
    <h3>Starting Volume: <?php echo $volume; ?></h3>
    <h2>By Month</h2>
    <hr>

    <form action="update_volume_exec.php" method="POST">
        <input type="hidden" value="<?php echo $supplier_id; ?>" name="supplier_id">
        <input type="hidden" value="<?php echo $branch; ?>" name="branch">
        <select name="month">
            <option value="01/31">January</option>
            <option value="02/28">February</option>
            <option value="03/31">March</option>
            <option value="04/30">April</option>
            <option value="05/31">May</option>
            <option value="06/30">June</option>
            <option value="07/30">July</option>
            <option value="08/31">August</option>
            <option value="09/30">September</option>
            <option value="10/31">October</option>
            <option value="11/30">November</option>
            <option value="12/31">December</option>
        </select>

        <input type="submit" name="update" value="Update">

    </form>
    <h2>Last 6 Month Avg Start Volume</h2>
    <form action="update_volume_exec2.php" method="POST">
        <input type="hidden" value="<?php echo $supplier_id; ?>" name="supplier_id">
        <input type="hidden" value="<?php echo $branch; ?>" name="branch">
        <input type="text" value="<?php echo $avg; ?>" name="starting_volume" readonly>
        <input type="submit" name="update" value="Update">
    </form>

    <a href="frm_edit_volume.php?del_id=<?php echo $supplier_id; ?>"><button>Delete Starting Volume</button></a>

</center>
