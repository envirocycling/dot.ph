<?php
include 'config.php';
$que = $_GET['details'];
$details = preg_split("/[_]/",$que);
$unit_cost = $details[0];
$branch = $details[1];
$start_date = $details[2];
$breaker_date = $details[3];
$grade = $details[4];
//$unit_cost2 = substr($unit_cost, 0, -1);
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
<h2>Paper Buying in <?php echo $branch; ?> <br> Price: <?php echo $unit_cost; ?></h2>
<table class="data display datatable" id="example">
    <?php
    $total = '0';
    echo "<thead>";
    echo '<tr class="data">';
    echo "<th class='data'>Date Received</th>";
    echo "<th class='data'>Supplier ID</th>";
    echo "<th class='data'>Supplier Name</th>";
    echo "<th class='data'>Branch Delivered</th>";
    echo "<th class='data'>WP Grade</th>";
    echo "<th class='data'>Weight</th>";
    echo "</tr>";
    echo "</thead>";
    if ($grade=='ONP') {
        $sql = mysql_query("SELECT * FROM paper_buying WHERE unit_cost='$unit_cost' and branch='$branch' and date_received>='$start_date' and date_received<='$breaker_date' and (wp_grade like '%$grade%' or wp_grade='NPB' or wp_grade='OPD')");
    } else if ($grade=='MW') {
        $sql = mysql_query("SELECT * FROM paper_buying WHERE unit_cost='$unit_cost' and branch='$branch' and date_received>='$start_date' and date_received<='$breaker_date' and (wp_grade like '%$grade%' or wp_grade='CORETUBE')");
    }else if ($grade=='CHIPBOARD') {
        $sql = mysql_query("SELECT * FROM paper_buying WHERE unit_cost='$unit_cost' and branch='$branch' and date_received>='$start_date' and date_received<='$breaker_date' and (wp_grade like '%$grade%' or wp_grade='CB')");
    } else {
        $sql = mysql_query("SELECT * FROM paper_buying WHERE unit_cost='$unit_cost' and branch='$branch' and date_received>='$start_date' and date_received<='$breaker_date' and wp_grade like '%$grade%'");
    }
    while ($rs = mysql_fetch_array($sql)) {
        echo "<tr class='data'>";
        echo "<td class='data'>".$rs['date_received']."</td>";
        echo "<td class='data'>".$rs['supplier_id']."</td>";
        echo "<td class='data'>".$rs['supplier_name']."</td>";
        echo "<td class='data'>".$rs['branch']."</td>";
        echo "<td class='data'>".$rs['wp_grade']."</td>";
        $total+=$rs['corrected_weight']/1000;
        echo "<td class='data'>".round($rs['corrected_weight']/1000,2)."</td>";
        echo "</tr>";
    }
    echo "<tr id='total'>";
    echo "<td>!Total!</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td>".round($total,2)."</td>";
    echo "</table>";

    ?>

</table>

