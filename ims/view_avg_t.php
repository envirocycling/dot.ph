<?php
include 'config.php';
?>
<html>
    <head>
        <style>
            .tbl td{
                border: 1px solid black;
                padding: 5px;
                font-size: 14px;
            }
            .head{
                background-color:gray;
                color:white;
                padding:7px;
            }
            .total{
                font-weight: bold;
                background-color:yellow;
            }
            .right{
                padding-left: 10px;
            }
            .left{
                padding-right: 10px;
            }
        </style>
    </head>
    <body>

        <?php
        $id = $_GET['id'];
        $split = preg_split("[_]", $id);

        $wp_grade = $split[0];
        $start_q = $split[1];
        $end_q = $split[2];
        $branch = $split[3];
        $price = $split[4];

        $branches_array = array();
        $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name like '%$branch%'");
        while ($rs_branch = mysql_fetch_array($sql_branch)) {
            array_push($branches_array, $rs_branch['branch_name']);
        }

        $start_qq = date('M d, Y', strtotime($start_q));
        $end_qq = date('M d, Y', strtotime($end_q));

        $day1 = date('d', strtotime($start_qq));
        $day2 = date('d', strtotime($end_qq));

        $month1 = date('M', strtotime($start_qq));
        $month2 = date('M', strtotime($end_qq));

        $year1 = date('Y', strtotime($start_qq));
        $year2 = date('Y', strtotime($end_qq));
        echo "<h2>";
        if ($month1 == $month2 && $year1 == $year2) {
            echo $wp_grade . " from " . $month1 . " $day1 to $day2, $year1</td>";
        } else if ($month1 != $month2 && $year1 == $year2) {
            echo $wp_grade . " from " . $month1 . " $day1 to $month2 $day2, $year1</td>";
        } else {
            echo $wp_grade . " from " . $month1 . " " . $day . ", " . $year1 . " to " . $month2 . " " . $day2 . ", " . $year2;
        }
        echo "</h2>";

        echo "<br>";
        echo "<h5>Tipco Buying Price: $price</h5>";
        echo "<br>";
        echo "<table>";
        echo "<tr>";
        echo "<td class='left'>";
        echo "<table class='tbl'>
            <tr class='head'>
            <td colspan='9' align='center'>Paper Buying</td>
            </tr>
            <tr class='head'>
            <td>Date</td>
            <td>Supplier Name</td>
            <td>Branch</td>
            <td>WP Grade</td>
            <td>Weight</td>
            <td>Buying Price</td>
            <td>Tipco Price</td>
            <td>Adtl Price</td>
            <td>Amount</td>
            </tr>";
        $total = 0;

        foreach ($branches_array as $branch) {
            $sql_price = mysql_query("SELECT * FROM tipco_prices WHERE branch='$branch' and wp_grade='$wp_grade' and date_effective<='$end_q' ORDER BY date_effective DESC");
            $rs_price = mysql_fetch_array($sql_price);
            $ppr_buy = 0;
            $sql_amount_cost = mysql_query("SELECT * FROM paper_buying WHERE unit_cost>'" . $rs_price['price'] . "' and branch='$branch' and wp_grade='$wp_grade' and date_received>='$start_q' and date_received<='$end_q'");
            while ($rs_amount_cost = mysql_fetch_array($sql_amount_cost)) {
                $spc_price = $rs_amount_cost['unit_cost'] - $rs_price['price'];
                $ppr_buy = ($spc_price * $rs_amount_cost['corrected_weight']);

                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $rs_amount_cost['supplier_id'] . "'");
                $rs_sup = mysql_fetch_array($sql_sup);
                echo "<tr>";
                echo "<td>" . $rs_amount_cost['date_received'] . "</td>";
                echo "<td>" . $rs_amount_cost['supplier_id'] . "_" . $rs_sup['supplier_name'] . "</td>";
                echo "<td>" . $rs_amount_cost['branch'] . "</td>";
                echo "<td>" . $rs_amount_cost['wp_grade'] . "</td>";
                echo "<td>" . $rs_amount_cost['corrected_weight'] . "</td>";
                echo "<td>" . $rs_amount_cost['unit_cost'] . "</td>";
                echo "<td>" . $rs_price['price'] . "</td>";
                echo "<td>" . number_format($spc_price,2) . "</td>";
                echo "<td align='right'>" . number_format($ppr_buy, 2) . "</td>";
                echo "</tr>";
                $total+=$ppr_buy;
            }
        }
        echo "<tr class='total'>";
        echo "<td>Total</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>" . number_format($total, 2) . "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</td>";
        echo "<td class='right'>";
        if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD') {
            $wp_grade_q = "LC" . $wp_grade;
        } else {
            $wp_grade_q = $wp_grade;
        }

        echo "<table class='tbl'>
            <tr class='head'>
            <td colspan='5' align='center'>Sales</td>
            </tr>
            <tr class='head'>
            <td>Date</td>
            <td>Dr No.</td>
            <td>Branch</td>
            <td>WP Grade</td>
            <td>Weight </td>
            </tr>";
        $total = 0;
        foreach ($branches_array as $branch) {
            $sql_daily_sales = mysql_query("SELECT * FROM actual WHERE branch like '%$branch%' and wp_grade='$wp_grade_q' and date>='$start_q' and date<='$end_q'");
            while ($rs_daily_sales = mysql_fetch_array($sql_daily_sales)) {
                echo "<tr>";
                echo "<td>" . $rs_daily_sales['date'] . "</td>";
                echo "<td>" . $rs_daily_sales['str_no'] . "</td>";
                echo "<td>" . $rs_daily_sales['branch'] . "</td>";
                echo "<td>" . $rs_daily_sales['wp_grade'] . "</td>";
                echo "<td>" . $rs_daily_sales['weight'] . "</td>";
                echo "</tr>";
                $total+=$rs_daily_sales['weight'];
            }
        }
        echo "<tr class='total'>";
        echo "<td>Total</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>" . round($total, 2) . "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        ?>
    </body>

</html>            