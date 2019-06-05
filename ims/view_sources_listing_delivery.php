<?php
include('config.php');
$que = preg_split("[_]",$_GET['sup_id']);
$supplier_id = $que[0];
$month = $que[1];
$year = $que[2];
$month = date("m",strtotime($month));
$date = $year."/".$month;
$start_date = $date."/01";
$end_date = date("Y/m/t",strtotime($start_date));
$sup_id_array = array ();
$sql_sup = mysql_query("SELECT * FROM supplier_assessment WHERE deliver_to='$supplier_id' and date<='$end_date' and date_deleted<='$end_date'");
while ($rs_sup = mysql_fetch_array($sql_sup)) {
    array_push($sup_id_array,$rs_sup['supplier_id']);
}
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
    $(document).ready(function() {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<style>
    #example{
        border-width:50%;
    }
</style>
<script type="text/javascript">
    function change(str) {
        var splits = str.split("_");
        document.getElementById("class").value = splits[1];
    }
</script>
<center>
    <?php
    echo "<h2>" . $rs_sup['supplier_name'] . " Supplier Assessment History</h2>";
    ?>
    <table width="600">
        <tr><td>
                <table class="data display datatable" id="example">
                    <?php
                    echo "<thead>";
                    echo '<tr class="data">';
                    echo "<th class='data'>WP Grade</th>";
                    echo "<th class='data'>Delivers To</th>";
                    echo "<th class='data'>Type</th>";
                    echo "<th class='data'>Volume</th>";
                    echo "</tr>";
                    echo "</thead>";
                    include("config.php");

                    $sql_assess = mysql_query("SELECT * FROM supplier_assessment WHERE deliver_to='$supplier_id' and date<='$end_date' and date_deleted<='$end_date'");
                    while ($rs_assess = mysql_fetch_array($sql_assess)) {
                        echo "<tr class='data'>";
                        echo "<td class='data'>" . $rs_assess['wp_grade'] . "</td>";
                        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$rs_assess['deliver_to']."'");
                        $rs_sup = mysql_fetch_array($sql_sup);
                        echo "<td class='data'>" . $rs_sup['supplier_name'] . "</td>";
                        echo "<td class='data'>" . $rs_assess['type'] . "</td>";
                        echo "<td class='data'>" . $rs_assess['volume'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</center>
