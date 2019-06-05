<h2>Notifications</h2>
<style>
    #sample{
        background-color: white;
    }
</style>
<?php
session_start();
include 'config.php';
$initial = $_SESSION['initial'];
if ($_SESSION['username']!='lorna_regala') {
    if ($_SESSION['username']=='lonlon') {
        $sql = mysql_query("SELECT * FROM  supplier_details WHERE verified = '0'");
    } else {
        $sql = mysql_query("SELECT * FROM  supplier_details WHERE verified = '0' and bh_to_verified='$initial'");
    }
    $count = mysql_num_rows($sql);
    if ($count>'0') {
        echo "<h5>New Suppliers Need to Verify</h5>";

        while ($rs = mysql_fetch_array($sql)) {
            echo "<table>";
            echo "<tr id='sample'>";
            echo "<td width='250'>".$rs['bh_in_charge']." add ".$rs['supplier_id']."_".$rs['supplier_name']." <br>(Date Added: ".$rs['date_added'].")</td>";
            echo "<td width='80'><a href='pending_suppliers.php'>Click here</a></td>";
            echo "</tr>";
            echo "</table>";
            echo "<hr>";
        }
    }
    echo "<br>";

    if ($_SESSION['username']=='lonlon') {
        $sql = mysql_query("SELECT * FROM supplier_details INNER JOIN sup_transfer ON supplier_details.supplier_id = sup_transfer.supplier_id WHERE  sup_transfer.confirm = '0'");
    } else {
        $sql = mysql_query("SELECT * FROM supplier_details INNER JOIN sup_transfer ON supplier_details.supplier_id = sup_transfer.supplier_id WHERE  sup_transfer.confirm = '0' and sup_transfer.bh_to_verified='$initial'");
    }
    $count = mysql_num_rows($sql);
    if ($count>'0') {
        echo "<h5>New Supplier Transfer Needs to Verify</h5>";

        while ($rs = mysql_fetch_array($sql)) {
            echo "<table>";
            echo "<tr id='sample'>";
            echo "<td width='250'>".$rs['bh_who_trans']." wants to transfer ".$rs['supplier_id']."_".$rs['supplier_name']." from ".$rs['branch']." to ".$rs['branch_trans']."  <br>(Date Request Transfer: ".$rs['date_transfer'].")</td>";
            echo "<td width='80'><a href='transfer_suppliers.php'>Click here</a></td>";
            echo "</tr>";
            echo "</table>";
            echo "<hr>";
        }
    }
} else {

    $sql = mysql_query("SELECT * FROM supplier_details INNER JOIN incentive_scheme ON supplier_details.supplier_id = incentive_scheme.sup_id WHERE incentive_scheme.confirm='0'");
    $count = mysql_num_rows($sql);
    if ($count>'0') {
        echo "<h5>New Incentive Added</h5>";

        while ($rs = mysql_fetch_array($sql)) {
            echo "<table>";
            echo "<tr id='sample'>";
            echo "<td width='250'>".$rs['bh_in_charge']." add a ".$rs['incentive']." incentive to ".$rs['supplier_id']."_".$rs['supplier_name']."</td>";
            echo "<td width='80'><a href='inc_deliveries.php'>Click here</a></td>";
            echo "</tr>";
            echo "</table>";
            echo "<hr>";
        }
    }
    $sql = mysql_query("SELECT * FROM pricing_against_competitors WHERE approved_status=''");
    $count = mysql_num_rows($sql);
    if ($count>'0') {
        echo "<h5>New Pricing Against Competitors Added</h5>";

        while ($rs = mysql_fetch_array($sql)) {
            echo "<table>";
            echo "<tr id='sample'>";
            echo "<td width='250'>".$rs['company']." change their price into min ".$rs['price']." and max is ".$rs['max_price'].". Branch Affected:  ".$rs['branch_affected']."</td>";
            echo "<td width='80'><a href='dashboard_pricing_against_competitors.php'>Click here</a></td>";
            echo "</tr>";
            echo "</table>";
            echo "<hr>";
        }
    }
}
?>



