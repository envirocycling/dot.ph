<?php
include("templates/template.php");
ini_set('max_execution_time', 1000);
include("config.php");
?>
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
<style>
    .total{
        font-weight: bold;
        background-color: yellow;
    }
    body{
        background-color: 2e5e79;
    }
    .table{
        font-size: 11px;
        padding:5px;
        border: 1px solid;
    }
    .table td {
        padding: 5px;
        border: 1px solid;
        font-weight: bold;
    }
    th{
        font-size: 12px;
        background-color:gray;
        color:white;
        padding:5px;
        border: 1px solid;
    }
</style>
<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="acctg_sales_deliveries.php" method="POST">
            Start date: <input type='text' id='inputField' name='start_date' value="<?php if(isset ($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date1(this.id);' readonly size="8"><br>
            End date: <input type='text' id='inputField2' name='end_date' value="<?php if(isset ($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date("Y/m/d");
                             }?>" onfocus='date1(this.id);' readonly size="8"><br>
                             <?php
                             $query = "SELECT * FROM branches  ";
                             $result = mysql_query($query) ;
                             echo "Branch:";
                             $dropdown = "<select name='branch' >";

                             if (isset ($_POST['branch'])) {
                                 $dropdown .= "\r\n<option value='".$_POST['branch']."'>".$_POST['branch']."</option>";
                             }

                             $dropdown .= "\r\n<option value=''>All Branches</option>";
                             while($row = mysql_fetch_array($result)) {
                                 $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                             }
                             $dropdown  .= "\r\n</select><br>";
                             echo $dropdown;
                             
                             
                             ?>
            
             Cut off: <select name="cutOff">
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
            <br>
            
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>
<?php
if (isset ($_POST['submit'])) {
    ?>
<div class="grid_16" >
    <div class="box round first grid">
        <h2>Sales / Deliveries (MT)
                <?php
                ?>
        </h2>

        <table class="table">
                <?php
                $start_date = $_POST['start_date'];
                $start_date_month = date('Y/m', strtotime($start_date));
                $end_date = $_POST['end_date'];
                $end_date_month = date('Y/m', strtotime($end_date));
                $cut_off = $_POST['cutOff']; // updated code jan 13, 2018

                $cur_month_start = $end_date_month."/01";
                $cur_month_end = $end_date;

                $branch = $_POST['branch'];
                $wp_grade_array = array("LCWL","ONP","CBS","OCC","MW","CHIPBOARD");
                $wp_grade_actual = array ();
                $wp_grade_inv_target = array ();
                $wp_grade_tot_actual = array ();
                $wp_grade_actual_weekly = array ();
                $del_sauyo = array ();
                $wp_grade_actual_weekly_delSauyo = array ();
                $total_mtd = 0;
                $total_target = 0;
                $total_sales = 0;
                foreach ($wp_grade_array as $wp_grade) {
                    $grade = $wp_grade;
                    if ($wp_grade != 'LCWL' && $wp_grade !='CHIPBOARD') {
                        $wp_grade = "LC".$wp_grade;
                    }
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month."/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            $end_q = date('Y/m/t', strtotime($start_q));
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        $month_q = date('M', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        if ($wp_grade == 'LCWL') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and (wp_grade LIKE '$wp_grade%' or  wp_grade='WB' or wp_grade='WBOND') and branch like '%$branch%' and branch !=''");
                        } else if ($wp_grade == 'LCONP') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and (wp_grade='$wp_grade' or  wp_grade='LCNPB' or wp_grade='LCOIN' or wp_grade='LCOPD') and branch like '%$branch%' and branch !=''");
                        } else if ($wp_grade == 'LCMW') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and (wp_grade LIKE '$wp_grade%' or  wp_grade='CORETUBE' or wp_grade='CT') and branch like '%$branch%' and branch !=''");
                        } else if ($wp_grade == 'CHIPBOARD') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and (wp_grade='$wp_grade' or  wp_grade='CB') and branch like '%$branch%' and branch !=''");
                        } else if ($wp_grade == 'LCOCC'){
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and wp_grade LIKE '$wp_grade%' and branch like '%$branch%' and branch !=''");
                            if($branch == 'Sauyo'){
                                $sql_actual_delSauyo = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and wp_grade LIKE '$wp_grade%' and branch not like '%$branch%' and branch !='' and delivered_to LIKE '%SAUYO%'");
                            }else{
                                $sql_actual_delSauyo = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and wp_grade LIKE '$wp_grade%' and branch like '%$branch%' and branch !='' and delivered_to LIKE '%SAUYO%'");
                            }
                            $rs_actual_delSauyo = mysql_fetch_array($sql_actual_delSauyo);
                            $del_sauyo[$grade][$start_q][$end_q] = $rs_actual_delSauyo['sum(weight)'];
                        } else {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and wp_grade='$wp_grade' and branch like '%$branch%' and branch !=''");
                        }
                        $rs_actual = mysql_fetch_array($sql_actual);
                        if($wp_grade == 'LCOCC'){
                            $wp_grade_actual[$grade][$start_q][$end_q]=$rs_actual['sum(weight)'] - $del_sauyo[$grade][$start_q][$end_q];
                        }else{
                            $wp_grade_actual[$grade][$start_q][$end_q]=$rs_actual['sum(weight)'];
                        }
                        
                      //  echo "SELECT sum(weight) from actual WHERE date>='$start_q' and date<='$end_q' and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND') and branch like '%$branch%'<br>";

                        if ($q_month == $end_date_month) {
                            $total_mtd+=$wp_grade_actual[$grade][$start_q][$end_q];
                        }
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }
                }


                foreach ($wp_grade_array as $wp_grade) {
                    $grade = $wp_grade;
                    if ($wp_grade != 'LCWL' && $wp_grade !='CHIPBOARD') {
                        $wp_grade = "LC".$wp_grade;
                    }

                    $start_week_q = $cur_month_start;
                    while ($start_week_q < $cur_month_end) {
                        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        if ($start_week_q== $cur_month_start) {
                            $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        } else {
                            if ($end_week_q > $cur_month_end) {
                                $end_week_q = $cur_month_end;
                            } else {
                                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                            }
                        }

                        $month_q = date('M', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        if ($wp_grade == 'LCWL') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade LIKE '$wp_grade%' or  wp_grade='WB' or wp_grade='WBOND') and branch like '%$branch%' and branch!=''");
                        } else if ($wp_grade == 'LCONP') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade='$wp_grade' or  wp_grade='LCNPB' or wp_grade='LCOIN' or wp_grade='LCOPD') and branch like '%$branch%' and branch!=''");
                        } else if ($wp_grade == 'LCMW') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade LIKE '$wp_grade%' or  wp_grade='CORETUBE' or wp_grade='CT') and branch like '%$branch%' and branch!=''");
                        } else if ($wp_grade == 'CHIPBOARD') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade='$wp_grade' or  wp_grade='CB') and branch like '%$branch%' and branch!=''");
                        } else if ($wp_grade == 'LCOCC') {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade LIKE '$wp_grade%') and branch like '%$branch%' and branch!=''");
                            if($branch == 'Sauyo'){
                            $sql_weekly_delSauyo = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade LIKE '$wp_grade%') and branch not like '%$branch%' and branch!='' and delivered_to LIKE '%SAUYO%'");
                            $rs_weekly_delSauyo = mysql_fetch_array($sql_weekly_delSauyo);
                            }else{
                            $sql_weekly_delSauyo = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and (wp_grade LIKE '$wp_grade%') and branch like '%$branch%' and branch!='' and delivered_to LIKE '%SAUYO%'");
                            $rs_weekly_delSauyo = mysql_fetch_array($sql_weekly_delSauyo);
                            }
                            $wp_grade_actual_weekly_delSauyo[$grade][$start_week_q][$end_week_q]=$rs_weekly_delSauyo['sum(weight)'];
                        } else {
                            $sql_actual = mysql_query("SELECT sum(weight) from actual WHERE date>='$start_week_q' and date<='$end_week_q' and wp_grade='$wp_grade' and branch like '%$branch%' and branch!=''");
                        }
                        $rs_actual = mysql_fetch_array($sql_actual);
                        if($wp_grade == 'LCOCC'){
                            $wp_grade_actual_weekly[$grade][$start_week_q][$end_week_q]=$rs_actual['sum(weight)'] - $wp_grade_actual_weekly_delSauyo[$grade][$start_week_q][$end_week_q];
                        }else{
                            $wp_grade_actual_weekly[$grade][$start_week_q][$end_week_q]=$rs_actual['sum(weight)'];
                        }


                        if ($start_week_q== $cur_month_start) {
                            $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                            $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                        } else {
                            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                        }
                    }
                }

                foreach ($wp_grade_array as $wp_grade) {
                    $sql_target = mysql_query("SELECT sum(target) FROM monthly_target WHERE month like '%$end_date_month%' and branch like '%$branch%' and wp_grade='$wp_grade'");
                    $rs_target = mysql_fetch_array($sql_target);
                    $wp_grade_inv_target[$wp_grade]=$rs_target['sum(target)'];
                }

                echo "<thead>";
                echo "<th>WP Grade</th>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month."/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        $end_q = date('Y/m/t', strtotime($start_q));
                    } else if ($q_month == $end_date_month) {
                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }
                    $month_q = date('M', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<th>$month_q - $year_q</th>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $ctr = 1;
                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q== $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<th>Week $ctr <br>".date("M d", strtotime($start_week_q))." - ".date("M d, Y", strtotime($end_week_q))."</th>";
                    if ($start_week_q== $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                    $ctr++;
                }

                echo "<th>MtD</th>";
                echo "<th>Mo.Target</th>";
                echo "<th>Var %</th>";
                echo "<th>% of Sales</th>";
                echo "</thead>";


                foreach ($wp_grade_array as $wp_grade) {
                    echo "<tr>";
                    echo "<td>$wp_grade</td>";
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month."/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            $end_q = date('Y/m/t', strtotime($start_q));
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        if (!isset ($wp_grade_tot_actual[$start_q][$end_q])) {
                            $wp_grade_tot_actual[$start_q][$end_q]=0;
                        }
                        if($wp_grade_actual[$wp_grade][$start_q][$end_q] == '') {
                            echo "<td>-</td>";
                        } else {
                            echo "<td>".round($wp_grade_actual[$wp_grade][$start_q][$end_q]/1000,2)."</td>";
                            $wp_grade_tot_actual[$start_q][$end_q]+=$wp_grade_actual[$wp_grade][$start_q][$end_q]/1000;
                        }
                        $actual=$wp_grade_actual[$wp_grade][$start_q][$end_q];
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }

                    $ctr = 1;
                    $start_week_q = $cur_month_start;
                    while ($start_week_q < $cur_month_end) {
                        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        if ($start_week_q== $cur_month_start) {
                            $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        } else {
                            if ($end_week_q > $cur_month_end) {
                                $end_week_q = $cur_month_end;
                            } else {
                                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                            }
                        }

                        if($wp_grade_actual_weekly[$wp_grade][$start_week_q][$end_week_q] == '') {
                            echo "<td>-</td>";
                        } else {
                            echo "<td>".round($wp_grade_actual_weekly[$wp_grade][$start_week_q][$end_week_q]/1000,2)."</td>";
                            $wp_grade_tot_actual[$start_week_q][$end_week_q]+=$wp_grade_actual_weekly[$wp_grade][$start_week_q][$end_week_q]/1000;
//                            $wp_grade_tot_actual[$start_q][$end_q]+=$wp_grade_actual_weekly[$wp_grade][$start_q][$end_q]/1000;
                        }

                        if ($start_week_q== $cur_month_start) {
                            $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                            $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                        } else {
                            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                        }
                        $ctr++;
                    }

                    echo "<td>".round($actual/1000,2)."</td>";
                    $total_target+=$wp_grade_inv_target[$wp_grade];
                    echo "<td>".$wp_grade_inv_target[$wp_grade]."</td>";

                    $percent = 1-($actual/1000)/$wp_grade_inv_target[$wp_grade];
                    echo "<td>".round($percent * 100,2)." %</td>";
                    $total_sales +=($actual/1000)/($total_mtd/1000)*100;
                    echo "<td>".round(($actual/1000)/($total_mtd/1000)*100,2)." %</td>";
                    echo "</tr>";
                }


                echo "<tr class='total'>";
                echo "<td>Total in MT</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month."/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        $end_q = date('Y/m/t', strtotime($start_q));
                    } else if ($q_month == $end_date_month) {
                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }
                    echo "<td>".round($wp_grade_tot_actual[$start_q][$end_q],2)."</td>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $ctr = 1;
                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q== $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td>".round($wp_grade_tot_actual[$start_week_q][$end_week_q],2)."</td>";
                    if ($start_week_q== $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                    $ctr++;
                }

                echo "<td>".round($total_mtd/1000,2)."</td>";
                echo "<td>$total_target</td>";
                $percent = 1-($total_mtd/1000)/$total_target;
                echo "<td>".round($percent * 100,2)." %</td>";
                echo "<td>$total_sales %</td>";
                echo "</tr>";

                echo "<tr class='total'>";
                echo "<td>Total Cost</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month."/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        $end_q = date('Y/m/t', strtotime($start_q));
                    } else if ($q_month == $end_date_month) {
                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }

                    $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) FROM paper_buying WHERE date_received>='$start_q' and date_received<='$end_q' and branch like '%$branch%'");
                    $rs_unit_cost = mysql_fetch_array($sql_unit_cost);

                    echo "<td>".number_format(($wp_grade_tot_actual[$start_q][$end_q]*1000)*($rs_unit_cost['sum(paper_buying)']/$rs_unit_cost['sum(corrected_weight)']),2)."</td>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $ctr = 1;
                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q== $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }

                     $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) FROM paper_buying WHERE date_received>='$start_week_q' and date_received<='$end_week_q' and branch like '%$branch%'");
                    $rs_unit_cost = mysql_fetch_array($sql_unit_cost);

                    echo "<td>".number_format(($wp_grade_tot_actual[$start_week_q][$end_week_q]*1000)*($rs_unit_cost['sum(paper_buying)']/$rs_unit_cost['sum(corrected_weight)']),2)."</td>";
                    if ($start_week_q== $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                    $ctr++;
                }

                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "</tr>";

                ?>

        </table>
    </div>
</div>
    <?php
}
?>

<div class="

     clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>