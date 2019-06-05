<?php
include('config.php');
include('templates/template.php');
?>

<style>
    body{
        background-color: #2e5e79;
    }
    td{
        padding: 5px;
    }
    .border {
        font-size: 12px;
        border: solid 1px;
    }
    .head{
        background-color: #8f8f8f;
    }
    .capacity{
        background-color: #33ccff;
    }
</style>

</head>
<div class="grid_16">
    <div class="box round first grid">
        <h2>Supplier Capacity Updating</h2>
        <br>        <br>

        <table width="2000">
            <?php

            $branch_array = array();
            $grade_array = array('LCWL', 'ONP', 'CBS', 'OCC', 'MW', 'CHIPBOARD');
            $class_array = array('C1','C2','C3','T1','T2','T3','J1','J2','J3','S1','S2','S3','PM');
            $total_capa = array();
            $total_capa_per_class = array();
            $sup_count = array();
            $num_sup_branch = array();
            $num_sup_branch_per_class = array();

            echo "<tr class='head'>";
            echo "<td class='border' align='center'><b>Branch</b></td>";
            echo "<td class='border' align='center' width='70'><b># of Sup</b></td>";
            echo "<td class='border' align='center' colspan='2' width='80'><b>Updated</b></td>";
            echo "<td class='border' align='center'><b>Accomplishment</b></td>";
            foreach ($class_array as $class) {
                echo "<td class='border' align='center' colspan='2' width='80'><b>$class</b></td>";
            }
            echo "</tr>";
            echo "<tr class='head'>";
            echo "<td class='border' align='center'></td>";
            echo "<td class='border' align='center'></td>";
            echo "<td class='border' align='center' width='50'><b># of Sup</b></td>";
            echo "<td class='border' align='center' width='50'><b>Capacity</b></td>";
            echo "<td class='border' align='center'></td>";
            foreach ($class_array as $class) {
                echo "<td class='border' align='center' width='50'><b># of Sup</b></td>";
                echo "<td class='border' align='center' width='50'><b>Capacity</b></td>";
            }
            echo "</tr>";
//            echo "<tr>";
//            echo "<td class='border'></td>";
//            echo "<td class='border'></td>";
//            echo "<td class='border'>
//
//             </td>";
//            echo "<td class='border'></td>";
//            foreach ($class_array as $class) {
//                echo "<td class='border'>
//                <table>";
//                echo "<tr>
//                <td align='center' width='80'><b># of Sup</b></td>
//                <td align='center' width='80'><b>Capacity</b></td>
//                </tr>
//                </table>
//             </td>";
//            }
//            echo "</tr>";

            $sql_branch = mysql_query("SELECT * FROM branches");
            while ($rs_branch = mysql_fetch_array($sql_branch)) {
                array_push($branch_array, $rs_branch['branch_name']);
                $sql_count = mysql_query("SELECT count(supplier_id) FROM supplier_details WHERE branch='" . $rs_branch['branch_name'] . "' and status!='inactive'");
                $rs_count = mysql_fetch_array($sql_count);
                $sup_count[$rs_branch['branch_name']] = $rs_count['count(supplier_id)'];
                $c = 0;
                $capa = 0;
                $sql_count_sup = mysql_query("SELECT * FROM supplier_details INNER JOIN supplier_capacity ON supplier_details.supplier_id = supplier_capacity.supplier_id WHERE supplier_details.branch='" . $rs_branch['branch_name'] . "' and supplier_details.status!='inactive' and  supplier_capacity.capacity!='' GROUP BY supplier_details.supplier_id");
                while ($rs_count_sup = mysql_fetch_array($sql_count_sup)) {
                    foreach ($grade_array as $grade) {
                        $sql = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='" . $rs_count_sup['supplier_id'] . "' and wp_grade='$grade' ORDER BY log_id DESC");
                        $rs = mysql_fetch_array($sql);
                        $capa += $rs['capacity'];
                    }
                    $c++;
                }
                $total_capa[$rs_branch['branch_name']] = $capa;
                $num_sup_branch[$rs_branch['branch_name']] = $c;

                foreach ($class_array as $class) {
                    $c = 0;
                    $capa = 0;
                    $sql_count_sup = mysql_query("SELECT * FROM supplier_details INNER JOIN supplier_capacity ON supplier_details.supplier_id = supplier_capacity.supplier_id WHERE supplier_details.branch='" . $rs_branch['branch_name'] . "' and supplier_details.classification='$class' and  supplier_details.status!='inactive' and  supplier_capacity.capacity!='' GROUP BY supplier_details.supplier_id");
                    while ($rs_count_sup = mysql_fetch_array($sql_count_sup)) {
                        foreach ($grade_array as $grade) {
                            $sql = mysql_query("SELECT * FROM supplier_capacity WHERE supplier_id='" . $rs_count_sup['supplier_id'] . "' and wp_grade='$grade' ORDER BY log_id DESC");
                            $rs = mysql_fetch_array($sql);
                            $capa += $rs['capacity'];
                        }
                        $c++;
                    }
                    $total_capa_per_class[$rs_branch['branch_name']][$class] = $capa;
                    $num_sup_branch_per_class[$rs_branch['branch_name']][$class] = $c;
                }
            }

//            echo "<tr>";
//            echo "<td class='border'>&nbsp;&nbsp;&nbsp;<b>TOTAL</b></td>";
//            echo "<td class='border' align='center'></td>";
//            echo "<td class='border' align='center' width='50'></td>";
//            echo "<td class='border' align='center' width='50'></td>";
//            echo "<td class='border' align='center'></td>";
//            foreach ($class_array as $class) {
//                echo "<td class='border' align='center' width='50'></td>";
//                echo "<td class='border' align='center' width='50'></td>";
//
//            }
//            echo "</tr>";
            foreach ($branch_array as $branch) {
                echo "<tr>";
                echo "<td class='border'>&nbsp;&nbsp;&nbsp;<b>$branch</b></td>";
                echo "<td class='border' align='center'>" . $sup_count[$branch] . "</td>";
                echo "<td class='border' align='center' width='50'>$num_sup_branch[$branch]</td>";
                echo "<td class='border' align='center' width='50'>$total_capa[$branch]</td>";
                echo "<td class='border' align='center'>" . round(($num_sup_branch[$branch] / $sup_count[$branch]) * 100, 0) . "%</td>";
                foreach ($class_array as $class) {
                    echo "<td class='border' align='center' width='50'>".$num_sup_branch_per_class[$branch][$class]."</td>";
                    echo "<td class='border' align='center' width='50'>".$total_capa_per_class[$branch][$class]."</td>";

                }
                echo "</tr>";
            }
//            echo "<tr>";
//            echo "<td class='border'><b>Total Per Class</b></td>";
//            echo "<td class='border' align='center'></td>";
//            echo "<td class='border' align='center' width='50'></td>";
//            echo "<td class='border' align='center' width='50'></td>";
//            echo "<td class='border' align='center'></td>";
//            foreach ($class_array as $class) {
//                echo "<td class='border' align='center' width='50'></td>";
//                echo "<td class='border' align='center' width='50'></td>";
//
//            }
//            echo "</tr>";
            ?>

        </table>

    </div>
</div>



<div class="
     clear">
</div>
<div class="clear">
</div>
