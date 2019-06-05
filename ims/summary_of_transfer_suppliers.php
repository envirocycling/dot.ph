<?php
include('config.php');

include('templates/template.php');
?>



<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

    function date1(str) {

        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"



        });

    }

    ;

</script>



<style>



    #total{

        background-color: yellow;

    }



</style>



</head>

<div class="grid_5">

    <div class="box round first grid">

        <h2>Summary of Transfer Suppliers</h2>

        <form action="summary_of_transfer_suppliers.php" method="POST">

            <br>

            <h6>Please select your range of dates</h6>

            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

            <?php
//            $query = "SELECT * FROM wp_grades ";
//            $result = mysql_query($query) ;
//            echo "WP Grade:";
//            $dropdown = "<select name='wp_grade' >";
//            $dropdown .= "\r\n<option value=''>All Grades</option>";
//            $dropdown .= "\r\n<option value=''>__________</option>";
//            while($row = mysql_fetch_array($result)) {
//                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
//            }
//            $dropdown  .= "</select><br>";
//            echo $dropdown;

            $query = "SELECT * FROM branches  ";

            $result = mysql_query($query);

            echo "Branch:";

            $dropdown = "<select name='branch' >";

            $dropdown .= "\r\n<option value=''>All Branches</option>";

            while ($row = mysql_fetch_array($result)) {

                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }

            $dropdown .= "\r\n</select><br>";

            echo $dropdown;
            ?>





            <input type="submit" value="Generate Report">

        </form>

    </div>

</div>

<?php
if (isset($_POST['branch'])) {

    $branch = $_POST['branch'];

    $date_from = $_POST['start_date'];

    $date_to = $_POST['end_date'];

    $total_per_branch = array();

    $total_tot = 0;

    if ($branch == '') {
        $sql_branchf = mysql_query("SELECT * FROM branches");
        while ($rs_branchf = mysql_fetch_array($sql_branchf)) {
            $total_tot = 0;
            echo "<div class='grid_10' >

                            <div class='box round first grid'>

                                <h2> Summary Of Transfer Suppliers From " . $date_from . " to " . $date_to . " in " . $rs_branchf['branch_name'] . "</h2>";



            echo '<table class="data display datatable" id="example" border="1">';

            echo "<thead>";

            echo "<th>Supplier Name</th>";

            echo "<th>Branch Orig</th>";

            $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name!='" . $rs_branchf['branch_name'] . "'");

            while ($rs_branch = mysql_fetch_array($sql_branch)) {

                echo "<th>" . $rs_branch['branch_name'] . "</th>";
            }

            echo "<th>TOTAL</th>";

            echo "</thead>";


            $sql_del_trans = mysql_query("SELECT * FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.branch_delivered!='" . $rs_branchf['branch_name'] . "' and supplier_details.branch='" . $rs_branchf['branch_name'] . "'  and sup_deliveries.date_delivered>='$date_from' and sup_deliveries.date_delivered<='$date_to' GROUP BY supplier_details.supplier_id");
            while ($rs_del_trans = mysql_fetch_array($sql_del_trans)) {
                $total = 0;
                echo "<tr>";
                echo "<td>" . $rs_del_trans['supplier_name'] . "</td>";
                echo "<td>" . $rs_branchf['branch_name'] . "</td>";
                $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name!='" . $rs_branchf['branch_name'] . "$branch'");
                while ($rs_branch = mysql_fetch_array($sql_branch)) {
                    $sql_del = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE  supplier_details.inter_branch='0' and sup_deliveries.supplier_id='" . $rs_del_trans['supplier_id'] . "' and sup_deliveries.branch_delivered='" . $rs_branch['branch_name'] . "' and (sup_deliveries.date_delivered>='$date_from' and sup_deliveries.date_delivered<='$date_to')");
                    $rs_del = mysql_fetch_array($sql_del);
                    if (!empty($rs_del['sum(sup_deliveries.weight)'])) {
                        $total_per_branch[$rs_branch['branch_name']]+=$rs_del['sum(sup_deliveries.weight)'] / 1000;
                        $total+=round($rs_del['sum(sup_deliveries.weight)'] / 1000, 2);
                        echo "<td>" . round($rs_del['sum(sup_deliveries.weight)'] / 1000, 2) . "</td>";
                    } else {
                    echo "<td>0</td>";
                    }
                }
                $total_tot+=$total;
                echo "<td id='total'>" . $total . "</td>";
                echo "</tr>";
            }

            echo "<tr id='total'>";
            echo "<td>!Total!</td>";
            echo "<td></td>";
            $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name!='" . $rs_branchf['branch_name'] . "$branch'");
            while ($rs_branch = mysql_fetch_array($sql_branch)) {
                if (!empty($total_per_branch[$rs_branch['branch_name']])) {
                    echo "<td>" . round($total_per_branch[$rs_branch['branch_name']], 2) . "</td>";
                } else {
                    echo "<td>0</td>";
                }
            }
            echo "<td>" . round($total_tot, 2) . "</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>

                </div>";
            unset($total_per_branch);
        }
    } else {
        echo "<div class='grid_10' >

                            <div class='box round first grid'>

                                <h2> Summary Of Transfer Suppliers From " . $date_from . " to " . $date_to . " in " . $branch . "</h2>";



        echo '<table class="data display datatable" id="example" border="1">';

        echo "<thead>";

        echo "<th>Supplier Name</th>";

        echo "<th>Branch Orig</th>";

        $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name!='$branch'");

        while ($rs_branch = mysql_fetch_array($sql_branch)) {

            echo "<th>" . $rs_branch['branch_name'] . "</th>";
        }

        echo "<th>TOTAL</th>";

        echo "</thead>";


        $sql_del_trans = mysql_query("SELECT * FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.branch_delivered!='$branch' and supplier_details.branch='$branch'  and sup_deliveries.date_delivered>='$date_from' and sup_deliveries.date_delivered<='$date_to' GROUP BY supplier_details.supplier_id");
        while ($rs_del_trans = mysql_fetch_array($sql_del_trans)) {
            $total = 0;
            echo "<tr>";
            echo "<td>" . $rs_del_trans['supplier_name'] . "</td>";
            echo "<td>" . $branch . "</td>";
            $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name!='$branch'");
            while ($rs_branch = mysql_fetch_array($sql_branch)) {
                $sql_del = mysql_query("SELECT sum(sup_deliveries.weight) FROM supplier_details INNER JOIN sup_deliveries ON supplier_details.supplier_id = sup_deliveries.supplier_id WHERE supplier_details.inter_branch='0' and sup_deliveries.supplier_id='" . $rs_del_trans['supplier_id'] . "' and sup_deliveries.branch_delivered='" . $rs_branch['branch_name'] . "' and supplier_details.branch='$branch' and (sup_deliveries.date_delivered>='$date_from' and sup_deliveries.date_delivered<='$date_to')");
                $rs_del = mysql_fetch_array($sql_del);
                if (!empty($rs_del['sum(sup_deliveries.weight)'])) {
                    $total_per_branch[$rs_branch['branch_name']]+=$rs_del['sum(sup_deliveries.weight)'] / 1000;
                    $total+=round($rs_del['sum(sup_deliveries.weight)'] / 1000, 2);
                    echo "<td>" . round($rs_del['sum(sup_deliveries.weight)'] / 1000, 2) . "</td>";
                } else {
                    echo "<td>0</td>";
                }
            }
            $total_tot+=$total;
            echo "<td id='total'>" . $total . "</td>";
            echo "</tr>";
        }

        echo "<tr id='total'>";
        echo "<td>!Total!</td>";
        echo "<td></td>";
        $sql_branch = mysql_query("SELECT * FROM branches WHERE branch_name!='$branch'");
        while ($rs_branch = mysql_fetch_array($sql_branch)) {
            if (!empty($total_per_branch[$rs_branch['branch_name']])) {
                echo "<td>" . round($total_per_branch[$rs_branch['branch_name']], 2) . "</td>";
            } else {
                echo "<td>0</td>";
            }
        }
        echo "<td>" . round($total_tot, 2) . "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</div>

                </div>";
    }
}
?>




<div class="clear">

</div>

<div class="clear">

</div>



