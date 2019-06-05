<?php

ini_set('max_execution_time', 1000);

include("templates/template.php");

?>

<style>

    .total{

        background-color: yellow;

    }

    .summary{

        border: 1px solid black;

        font-size: 15px;

        text-align: center;

    }

    .td{

        border: 1px solid black;

    }

    .assess{

        border: 1px solid black;

        font-size: 12px;

    }

</style>

<?php

include("config.php");



?>

<script>

    function openWindow(str) {

        var x = screen.width / 2 - 700 / 2;

        var y = screen.height / 2 - 450 / 2;

        window.open("view_sources_listing_delivery.php?sup_id=" + str, 'mywindow', 'width=600,height=600');

    }

</script>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

    function date1(str){

        new JsDatePick({

            useMode:2,

            target:str,

            dateFormat:"%Y/%m/%d"



        });

    };

</script>

<?php



?>

<div class="grid_10" >

    <div class="box round first grid">

        <h2>Classification Listing</h2>

        <br>

        <form action="sources_listing.php" method="POST">

            <h6>Filtering Options</h6>

            <br>

            <table>

                <tr>

                    <td>

                        <font style="font-size: 12px;">CLASSIFICATION

                            <br>

                            C1 <input type="checkbox" name="C1" value="C1">

                            C2 <input type="checkbox" name="C2" value="C2">

                            C3 <input type="checkbox" name="C3" value="C3">

                            <br>

                            T1 <input type="checkbox" name="T1" value="T1">

                            T2 <input type="checkbox" name="T2" value="T2">

                            T3 <input type="checkbox" name="T3" value="T3">

                            <br>

                            J1 <input type="checkbox" name="J1" value="J1">

                            J2 <input type="checkbox" name="J2" value="J2">

                            J3 <input type="checkbox" name="J3" value="J3">

                            <br>

                            S1 <input type="checkbox" name="S1" value="S1">

                            S2 <input type="checkbox" name="S2" value="S2">

                            S3 <input type="checkbox" name="S3" value="S3">

                            <br>

                            PM <input type="checkbox" name="PM" value="PM">

                        </font>

                    </td>

                    <td>

                        <br>

                        <font style="font-size: 12px;">

                            Start Period: <input type='text'  id='inputField' name='from' value="<?php if (isset ($_POST['from'])) {

                                echo $_POST['from'];

                            } else {

                                echo date('Y/m/d');

                                                 }?>" onfocus='date1(this.id);' readonly size="8"><br>

                            End Period:<input type='text'  id='inputField2' name='to' value="<?php if (isset ($_POST['to'])) {

                                echo $_POST['to'];

                            } else {

                                echo date('Y/m/d');

                                              }?>" onfocus='date1(this.id);' readonly size="8"><br>

                        </font>

                    </td>

                    <td><br>

                        WP Grade: <select name="wp_grade">

                            <?php

                            if (isset ($_POST['wp_grade'])) {

                                if ($_POST['wp_grade']=='') {

                                    echo "<option value=''>All Grades</option>";

                                } else {

                                    echo "<option value='".$_POST['wp_grade']."'>".$_POST['wp_grade']."</option>";

                                }

                            }

                            ?>

                            <option value="">All Grades</option>

                            <option value="LCWL">LCWL</option>

                            <option value="ONP">ONP</option>

                            <option value="CBS">CBS</option>

                            <option value="OCC">OCC</option>

                            <option value="MW">MW</option>

                            <option value="CHIPBOARD">CHIPBOARD</option>

                        </select></td>

                    <td><br>

                        <font style="font-size: 12px;">

                            Branch:

                            <select name="branch">



                                <?php

                                if (isset ($_POST['branch'])) {

                                    if ($_POST['branch']=='') {

                                        echo "<option value=''>All Grades</option>";

                                    } else {

                                        echo "<option value='".$_POST['branch']."'>".$_POST['branch']."</option>";

                                    }

                                }

                                echo "<option value=''>All Branches</option>";

                                $sql_sup = mysql_query("SELECT * FROM branches");

                                while ($rs_sup = mysql_fetch_array($sql_sup)) {

                                    echo "<option value='".$rs_sup['branch_name']."'>".$rs_sup['branch_name']."</option>";

                                }

                                ?>

                            </select>

                        </font>

                    </td>

                </tr>

                <tr>

                    <td colspan="3"><input type="submit" name="submit" value="Submit"></td>

                </tr>

            </table>

        </form>

        <br>

        <?php

        if (isset ($_POST['submit'])) {

            $start_date = $_POST['from'];

            $end_date = $_POST['to'];



            echo "<h3>All ";

            if (isset ($_POST['J1'])) {

                echo $_POST['J1']." ";

            }

            if (isset ($_POST['J2'])) {

                echo $_POST['J2']." ";

            }

            if (isset ($_POST['J3'])) {

                echo $_POST['J3']." ";

            }

            if (isset ($_POST['T1'])) {

                echo $_POST['T1']." ";

            }

            if (isset ($_POST['T2'])) {

                echo $_POST['T2']." ";

            }

            if (isset ($_POST['T3'])) {

                echo $_POST['T3']." ";

            }

            if (isset ($_POST['C1'])) {

                echo $_POST['C1']." ";

            }

            if (isset ($_POST['C2'])) {

                echo $_POST['C2']." ";

            }

            if (isset ($_POST['C3'])) {

                echo $_POST['C3']." ";

            }

            if (isset ($_POST['S1'])) {

                echo $_POST['S1']." ";

            }

            if (isset ($_POST['S2'])) {

                echo $_POST['S2']." ";

            }

            if (isset ($_POST['S3'])) {

                echo $_POST['S3']." ";

            }

            if (isset ($_POST['PM'])) {

                echo $_POST['PM']." ";

            }


            if ($_POST['branch'] == ''){
                echo "in All Branches";
            } else {
                echo "in ".$_POST['branch'];
            }
            echo " Delivers to;</h3>";







            $classification = array('J1','J2','J3','T1','T2','T3','C1','C2','C3','S1','S2','S3','PM');



            if ($_POST['wp_grade'] == '') {

                $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

                $sum_sup_del_to = array ();

                $sum_del_to = array ();

                $sum_sup_del_to_per_grade = array ();

                foreach ($classification as $class) {

                    if (isset ($_POST[$class])) {

                        $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='$class' and status!='inactive' and branch like '%".$_POST['branch']."%'");

                        while ($rs_sup = mysql_fetch_array($sql_sup)) {

                            array_push($sum_sup_del_to,$rs_sup['supplier_id']);

                        }

                        foreach ($sum_sup_del_to as $sup_id) {

                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

                                array_push($sum_del_to,$rs_del_to['deliver_to']);

//                                foreach ($grades_array as $grade) {

//                                    $sql = mysql_query("SELECT sum(volume) FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and deliver_to='".$rs_del_to['deliver_to']."' and date<='$end_date' and status!='deleted'");

//                                    $rs = mysql_fetch_array($sql);

//                                    $sum_sup_del_to_per_grade[$rs_del_to['deliver_to']][$grade]+=$rs['sum(volume)'];

//                                }

                            }

                        }

                    }

                }

                $sum_del_to = array_unique($sum_del_to);

//                foreach($sum_sup_del_to as $sup_id) {

//                    foreach ($sum_del_to as $del_to) {

//                        foreach ($grades_array as $grade) {

//                            $sql = mysql_query("SELECT sum(volume) FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and deliver_to='$del_to' and date<='$end_date' and status!='deleted'");

//                            $rs = mysql_fetch_array($sql);

//                            $sum_sup_del_to_per_grade[$del_to][$grade]=$rs['sum(volume)'];

//                        }

//                    }

//                }



                echo "<table class='assess' width='400'>";

                echo "<tr>";

                echo "<td class='assess'></td>";

                foreach ($grades_array as $grade) {

                    echo "<td class='assess'>".strtoupper($grade)."</td>";

                }

                echo "</tr>";

                foreach ($sum_del_to as $sup_id) {

                    $sql_del_to = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$sup_id'");

                    $rs_del_to = mysql_fetch_array($sql_del_to);

                    echo "<tr>";

                    echo "<td class='assess'>".$rs_del_to['supplier_name']."</td>";

                    foreach ($grades_array as $grade) {

                        $total = 0;

                        echo "<td class='assess'>";

                        foreach ($sum_sup_del_to as $deliver_by) {

                            $sql = mysql_query("SELECT sum(volume) FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$deliver_by' and deliver_to='$sup_id' and date<='$end_date' and status!='deleted'");

                            $rs = mysql_fetch_array($sql);

                            $total+=$rs['sum(volume)'];

                        }

                        echo $total;

                        "</td>";

                    }

                    echo "</tr>";

                }

                echo "</table>";

            }



            echo '<table class="data display datatable" id="example" border="1">';

            echo "<thead>";

            echo "<th>ID</th>";

            echo "<th>Supplier</th>";

            echo "<th>Classification</th>";

            echo "<th>Capacity</th>";

            echo "<th>Delivers To</th>";

            if ($_POST['branch'] == '') {

                echo "<th>Branch</th>";

            }

            $start_q = $start_date;

            while ($start_q <= $end_date) {

                $month_q = date('F', strtotime($start_q));

                $year_q = date('Y', strtotime($start_q));

                echo "<th>" . $month_q . " " . $year_q . "</th>";

                $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

            }

            echo "</thead>";

            foreach ($classification as $class) {

                if (isset ($_POST[$class])) {

                    $sup_j1 = array ();

                    $sup_name_j1 = array ();

                    $del_j1 = array ();

                    $class_j1 = array ();

                    $branch_j1 = array ();

                    $capacity_j1 = array ();

                    $type_j1 = array ();

                    $del_to_j1 = array ();

                    $del_to_vol_j1 = array ();

                    $sup_del_count_j1 = array ();

                    $del_to_type_j1 = array ();

                    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='$class' and status!='inactive' and branch like '%".$_POST['branch']."%'");

                    while ($rs_sup = mysql_fetch_array($sql_sup)) {

                        array_push($sup_j1,$rs_sup['supplier_id']);

                        $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

                        $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

                        $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

                    }



                    foreach ($sup_j1 as $sup_id) {

                        if ($_POST['wp_grade'] != '') {

                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

                            $rs_cap = mysql_fetch_array($sql_cap);

                            $capacity_j1[$sup_id] = $rs_cap['capacity'];

                            $grades_array = array($_POST['wp_grade']);

                            $capa = 0;

                            foreach ($grades_array as $grade) {

                                $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

                                $rs_cap = mysql_fetch_array($sql_cap);

                                $capa += $rs_cap['capacity'];

                            }

                            $capacity_j1[$sup_id] = $capa;



                            foreach ($grades_array as $grade) {

                                $ctr = 0;

                                $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

                                while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

                                    $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

                                    $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

                                    $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

                                    $ctr++;

                                }

                                $sup_del_count_j1[$sup_id][$grade]=$ctr;

                            }

                        } else {

                            $capa = 0;

                            foreach ($grades_array as $grade) {

                                $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

                                $rs_cap = mysql_fetch_array($sql_cap);

                                $capa += $rs_cap['capacity'];

                            }

                            $capacity_j1[$sup_id] = $capa;



                            foreach ($grades_array as $grade) {

                                $ctr = 0;

                                $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

                                while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

                                    $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

                                    $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

                                    $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

                                    $ctr++;

                                }

                                $sup_del_count_j1[$sup_id][$grade]=$ctr;

                            }

                        }



                        $start_q = $start_date;

                        while ($start_q <= $end_date) {

                            $month_q = date('F', strtotime($start_q));

                            $year_q = date('Y', strtotime($start_q));

                            $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

                            $rs_del = mysql_fetch_array($sql_del);

                            $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

                            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

                        }

                    }



                    foreach ($sup_j1 as $sup_id) {

                        echo "<tr>";

                        echo "<td>$sup_id</td>";

                        echo "<td>".$sup_name_j1[$sup_id]."</td>";

                        echo "<td>".$class_j1[$sup_id]."</td>";

                        echo "<td>".$capacity_j1[$sup_id]."</td>";

                        echo "<td>";

                        foreach ($grades_array as $grade) {

                            $ctr = 0;

                            if ($sup_del_count_j1[$sup_id][$grade] != 0) {

                                echo "<table class='assess'>";

                                echo "<td colspan='3' class='assess' align='center'>".strtoupper($grade)."</td>";

                                while ($ctr < $sup_del_count_j1[$sup_id][$grade]) {

                                    if (!empty ($del_to_j1[$sup_id][$grade][$ctr])) {

                                        $sql_del_to = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$del_to_j1[$sup_id][$grade][$ctr]."'");

                                        $rs_del_to = mysql_fetch_array($sql_del_to);

                                        echo "<tr>";

                                        echo "<td class='assess'>".$rs_del_to['supplier_name']."</td>";

                                        echo "<td class='assess'>".$del_to_vol_j1[$sup_id][$grade][$ctr]."</td>";

                                        echo "<td class='assess'>".strtoupper($del_to_type_j1[$sup_id][$grade][$ctr])."</td>";

                                        echo "</tr>";

                                    }

                                    $ctr++;

                                }

                                echo "</table>";

                            }

                        }



                        echo "</td>";

                        if ($_POST['branch'] == '') {

                            echo "<td>".$branch_j1[$sup_id]."</td>";

                        }

                        $start_q = $start_date;

                        while ($start_q <= $end_date) {

                            $month_q = date('F', strtotime($start_q));

                            $year_q = date('Y', strtotime($start_q));

                            echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

                            $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

                        }

                        echo "</tr>";

                    }

                }

            }

//            //

//            if (isset ($_POST['J2'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='J2' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['J3'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='J3' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['T1'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='T1' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['T2'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='T2' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['T3'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='T3' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['C1'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='C1' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['C2'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='C2' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['C3'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='C3' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//

//            //

//            if (isset ($_POST['S1'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='S1' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//

//            //

//            if (isset ($_POST['S2'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='S2' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//            //

//            if (isset ($_POST['S3'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='S3' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

//

//            //

//            if (isset ($_POST['PM'])) {

//                $sup_j1 = array ();

//                $sup_name_j1 = array ();

//                $del_j1 = array ();

//                $class_j1 = array ();

//                $branch_j1 = array ();

//                $capacity_j1 = array ();

//                $type_j1 = array ();

//                $del_to_j1 = array ();

//                $del_to_vol_j1 = array ();

//                $sup_del_count_j1 = array ();

//                $del_to_type_j1 = array ();

//                $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE classification='PM' and status!='inactive' and branch like '%".$_POST['branch']."%'");

//                while ($rs_sup = mysql_fetch_array($sql_sup)) {

//                    array_push($sup_j1,$rs_sup['supplier_id']);

//                    $sup_name_j1[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

//                    $class_j1[$rs_sup['supplier_id']]=$rs_sup['classification'];

//                    $branch_j1[$rs_sup['supplier_id']]=$rs_sup['branch'];

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//

//                    if ($_POST['wp_grade'] != '') {

//                        $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='".$_POST['wp_grade']."' and supplier_id='$sup_id' and date_effective<='$end_date'");

//                        $rs_cap = mysql_fetch_array($sql_cap);

//                        $capacity_j1[$sup_id] = $rs_cap['capacity'];

//                        $grades_array = array($_POST['wp_grade']);

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    } else {

//                        $grades_array = array('lcwl', 'onp', 'cbs', 'occ', 'mw', 'chipboard');

//                        $capa = 0;

//                        foreach ($grades_array as $grade) {

//                            $sql_cap = mysql_query("SELECT * FROM supplier_capacity WHERE wp_grade='$grade' and supplier_id='$sup_id' and date_effective<='$end_date' order by date_effective desc LIMIT 1");

//                            $rs_cap = mysql_fetch_array($sql_cap);

//                            $capa += $rs_cap['capacity'];

//                        }

//                        $capacity_j1[$sup_id] = $capa;

//

//                        foreach ($grades_array as $grade) {

//                            $ctr = 0;

//                            $sql_del_to = mysql_query("SELECT * FROM supplier_assessment WHERE wp_grade='$grade' and supplier_id='$sup_id' and date<='$end_date' and status!='deleted'");

//                            while ($rs_del_to = mysql_fetch_array($sql_del_to)) {

//                                $del_to_j1[$sup_id][$grade][$ctr]=$rs_del_to['deliver_to'];

//                                $del_to_vol_j1[$sup_id][$grade][$ctr]=$rs_del_to['volume'];

//                                $del_to_type_j1[$sup_id][$grade][$ctr]=$rs_del_to['type'];

//                                $ctr++;

//                            }

//                            $sup_del_count_j1[$sup_id][$grade]=$ctr;

//                        }

//                    }

//

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$sup_id' and month_delivered='$month_q' and year_delivered='$year_q'");

//                        $rs_del = mysql_fetch_array($sql_del);

//                        $del_j1[$sup_id][$month_q][$year_q]=$rs_del['sum(weight)']/1000;

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                }

//

//                foreach ($sup_j1 as $sup_id) {

//                    echo "<tr>";

//                    echo "<td>$sup_id</td>";

//                    echo "<td>".$sup_name_j1[$sup_id]."</td>";

//                    echo "<td>".$class_j1[$sup_id]."</td>";

//                    if ($_POST['branch'] == '') {

//                        echo "<td>".$branch_j1[$sup_id]."</td>";

//                    }

//                    $start_q = $start_date;

//                    while ($start_q <= $end_date) {

//                        $month_q = date('F', strtotime($start_q));

//                        $year_q = date('Y', strtotime($start_q));

//                        echo "<td id='".$sup_id."_".$month_q."_".$year_q."' onclick='openWindow(this.id);'>".$del_j1[$sup_id][$month_q][$year_q]."</td>";

//                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));

//                    }

//                    echo "</tr>";

//                }

//            }

            echo "</table>";

        }

        ?>



    </div>

</div>

<div class="clear">



</div>



<div class="clear">



</div>

<div class="clear">



</div>