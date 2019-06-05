<?php
include 'config.php';
$que = preg_split("[_]",$_GET['sup_id']);
$supplier_id = $que[0];
$month = $que[1];
$year = $que[2];
$wp_grade = $que[3];
$sql_del = mysql_query("");

$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
$rs_sup = mysql_fetch_array($sql_sup);
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
                    echo "<th class='data'>Date</th>";
                    echo "<th class='data'>Branch Delivered</th>";
                    echo "<th class='data'>WP Grade</th>";
                    echo "<th class='data'>Weight</th>";
                    echo "</tr>";
                    echo "</thead>";
                    include("config.php");

                    $query = "SELECT * FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade like '%$wp_grade%' and month_delivered='$month' and year_delivered='$year'";

                    $result = mysql_query($query);
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr class='data'>";
                        echo "<td class='data'>" . $row['date_delivered'] . "</td>";
                        echo "<td class='data'>" . $row['branch_delivered'] . "</td>";
                        echo "<td class='data'>" . $row['wp_grade'] . "</td>";
                        echo "<td class='data'>" . $row['weight'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</center>
