<?php
include 'config.php';
$que =  $_GET['details'];
$details = preg_split("[_]", $que);
$province = $details[0];
$start_date = $details[1];
$end_date = $details[2];
$wp_grade = $details[3];
?>
<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<style>
    #example{
        border-width:50%;
    }
    #total{
        background-color: yellow;
        font-weight: bold;    }
</style>
<h2>Delivery Performace in <?php echo ucfirst($province);?></h2>
<table class="data display datatable" id="example">
    <?php
    $total = '0';
    $total_per_month = array();
    echo "<thead>";
    echo '<tr class="data">';
    echo "<th class='data'>Supplier ID</th>";
    echo "<th class='data'>Supplier Name</th>";
    $start_q = $start_date;
    while ($start_q <= $end_date) {
        $month_q = date('F', strtotime($start_q));
        $year_q = date('Y', strtotime($start_q));
        echo "<th>" . $month_q . " " . $year_q . "</th>";
        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
    }
    echo "</tr>";
    echo "</thead>";


    $sql = mysql_query("SELECT * FROM supplier_details WHERE province='$province'");
    while ($rs = mysql_fetch_array($sql)) {
        $check = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and date_delivered>='$start_date' and date_delivered<='$end_date'");
        $rs_check = mysql_fetch_array($check);
        if(!empty ($rs_check['sum(weight)'])) {
            echo "<tr>";
            echo "<td>".$rs['supplier_id']."</td>";
            echo "<td>".$rs['supplier_name']."</td>";
            $start_q = $start_date;
            while ($start_q <= $end_date) {
                $month_q = date('F', strtotime($start_q));
                $year_q = date('Y', strtotime($start_q));
                $sql_del_mon = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='".$rs['supplier_id']."' and month_delivered='$month_q' and year_delivered='$year_q' and wp_grade like '%$wp_grade%'");
                $rs_del_mon = mysql_fetch_array($sql_del_mon);
                $total_per_month[$month_q][$year_q]+=$rs_del_mon['sum(weight)']/1000;
                echo "<td>" . round($rs_del_mon['sum(weight)']/1000,2) . "</td>";
                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
            }
            echo "</tr>";
        }
    }

    echo "<tr id = 'total'>";
    echo "<td>!Total!</td>";
    echo "<td></td>";
    $start_q = $start_date;
    while ($start_q <= $end_date) {
        $month_q = date('F', strtotime($start_q));
        $year_q = date('Y', strtotime($start_q));
        echo "<td>" . round($total_per_month[$month_q][$year_q],2) . "</td>";
        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
    }
    echo "</tr>";
    echo "</table>";

    ?>

</table>
