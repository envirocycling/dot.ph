<?php
include("templates/template.php");
ini_set('max_execution_time', 1000);
include("config.php");
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
        <form action="acctg_wastepaper_inventory.php" method="POST">
            Start date: <input type='text' id='inputField' name='start_date' value="<?php
            if (isset($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
            End date: <input type='text' id='inputField2' name='end_date' value="<?php
            if (isset($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"><br>
                             <?php
                             $query = "SELECT * FROM branches  ";
                             $result = mysql_query($query);
                             echo "Branch:";
                             $dropdown = "<select name='branch' >";

                             if (isset($_POST['branch'])) {
                                 $dropdown .= "\r\n<option value='" . $_POST['branch'] . "'>" . $_POST['branch'] . "</option>";
                             }

                             $dropdown .= "\r\n<option value=''>All Branches</option>";
                             while ($row = mysql_fetch_array($result)) {
                                 $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                             }
                             $dropdown .= "\r\n</select><br>";
                             echo $dropdown;
                             ?>
            Cut off: <select name="cutOff">
                <option value="sunday">Sunday</option>
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
            </select>
            <br>

            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_16" >
        <div class="box round first grid">
            <h2>Wastepaper Inventory (MT)
                <?php
                ?>
            </h2>

            <table class="table">
                <?php
                $start_date = $_POST['start_date'];
                $start_date_month = date('Y/m', strtotime($start_date));
                $end_date = $_POST['end_date'];
                $end_date_month = date('Y/m', strtotime($end_date));
                $cut_off = $_POST['cutOff'];

                $cur_month_start = $end_date_month . "/01";
                $cur_month_end = $end_date;
                $cur_month_end_end = date('Y/m/t', strtotime($end_date));

                $branch = $_POST['branch'];
                $wp_grade_array = array("LCWL", "ONP", "CBS", "OCC", "MW", "CHIPBOARD", "FS");
                $wp_grade_inv = array();
                $wp_grade_inv_weekly = array();
                $wp_grade_tot_actual = array();
                $wp_grade_tot_weekly = array();
                $total_mtd = 0;
                $total_target = 0;

                foreach ($wp_grade_array as $wp_grade) {
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $actual = 0;
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month . "/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            $end_q = date('Y/m/t', strtotime($start_q));
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        $month_q = date('F', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        if ($wp_grade == 'LCWL') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND')  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND') and branch like '%$branch%' and date <='$end_q')");
                        } else if ($wp_grade == 'ONP') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD')  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD') and branch like '%$branch%' and date <='$end_q')");
                        } else if ($wp_grade == 'MW') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT')  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT') and branch like '%$branch%' and date <='$end_q')");
                        } else if ($wp_grade == 'CHIPBOARD') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CB')  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='CB') and branch like '%$branch%' and date <='$end_q')");
                        } else if ($wp_grade == 'OCC') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or wp_grade='HM.OCC')  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or wp_grade='HM.OCC') and branch like '%$branch%' and date <='$end_q')");
                        } else {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and wp_grade='$wp_grade'  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and wp_grade='$wp_grade' and branch like '%$branch%' and date <='$end_q')");
                        //$sql_actual = mysql_query("SELECT * from bales where (date>='$start_q' and date<='$end_q' and branch like '%$branch%'  and wp_grade='$wp_grade'  and str_no!='VOID'  and  (out_date > '$end_q' or out_date < '$start_q' or out_date='')   and (date_rebaled > '$end_q' or date_rebaled < '$start_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_q' or date_rebaled='') and status!='rebaled' and wp_grade='$wp_grade' and branch like '%$branch%' and date <='$end_q')");
                        }
                       /*while($rs_actual = mysql_fetch_array($sql_actual)){
                           echo $rs_actual['bale_weight'].'=='.$rs_actual['log_id'].'==<br>';
                       }*/
                        $rs_actual = mysql_fetch_array($sql_actual);
                        $actual = $rs_actual['sum(bale_weight)'];

                        if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD') {
                            $q_grade = "LC" . $wp_grade;
                        } else {
                            $q_grade = $wp_grade;
                        }

                        $loose = 0;
                        $month_end_loose = 0;
                        if ($q_grade == 'LCWL') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_q' and (wp_grade='$q_grade' or wp_grade='LCWB' or wp_grade='WBOND') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else if ($q_grade == 'LCONP') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_q' and (wp_grade='$q_grade'or wp_grade='LCNPB' or wp_grade='LCOIN' or wp_grade='LCOPD') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else if ($q_grade == 'LCMW') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_q' and (wp_grade='$q_grade' or wp_grade='CORETUBE' or wp_grade='LCCT') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else if ($q_grade == 'CHIPBOARD') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_q' and (wp_grade='$q_grade' or wp_grade='LCCB') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_q' and wp_grade='$q_grade' and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        }


                        if ($q_grade == 'LCWL') {
                            $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='LCWB' or wp_grade='WBOND') and branch like '%$branch%' and month_end_date='$q_month'");
                            $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                            $month_end_loose += $rs_month_end_loose['sum(weight)'];
                        } else if ($q_grade == 'LCONP') {
                            $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='NPB' or wp_grade='LCOIN' or wp_grade='LCOPD') and branch like '%$branch%' and month_end_date='$q_month'");
                            $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                            $month_end_loose += $rs_month_end_loose['sum(weight)'];
                        } else if ($q_grade == 'LCMW') {
                            $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='CORETUBE' or wp_grade='LCCT') and branch like '%$branch%' and month_end_date='$q_month'");
                            $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                            $month_end_loose += $rs_month_end_loose['sum(weight)'];
                        } else if ($q_grade == 'CHIPBOARD') {
                            $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='LCCB') and branch like '%$branch%' and month_end_date='$q_month'");
                            $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                            $month_end_loose += $rs_month_end_loose['sum(weight)'];
                        } else {
                            $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where wp_grade like '$q_grade' and branch like '%$branch%' and month_end_date='$q_month'");
                            $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                            $month_end_loose += $rs_month_end_loose['sum(weight)'];
                        }
                        $wp_grade_inv[$wp_grade][$start_q][$end_q] = $actual + $loose + $month_end_loose;
                        
                       // echo $actual.'+'.$loose.'+'.$month_end_loose.'<br/>';

                        if ($q_month == $end_date_month) {
                            $total_mtd+=$rs_actual['sum(bale_weight)'];
                        }
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }
                }

                foreach ($wp_grade_array as $wp_grade) {
                    $start_week_q = $cur_month_start;
                    while ($start_week_q < $cur_month_end) {
                        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        if ($start_week_q == $cur_month_start) {
                            $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        } else {
                            if ($end_week_q > $cur_month_end) {
                                $end_week_q = $cur_month_end;
                            } else {
                                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                            }
                        }
                        if ($wp_grade == 'LCWL') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_week_q' and date<='$end_week_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND')  and str_no!='VOID'  and  (out_date > '$end_week_q' or out_date < '$start_week_q' or out_date='')   and (date_rebaled > '$end_week_q' or date_rebaled < '$start_week_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_week_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='WB' or wp_grade='WBOND') and branch like '%$branch%' and date <='$end_week_q')");
                        } else if ($wp_grade == 'ONP') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_week_q' and date<='$end_week_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD')  and str_no!='VOID'  and  (out_date > '$end_week_q' or out_date < '$start_week_q' or out_date='')   and (date_rebaled > '$end_week_q' or date_rebaled < '$start_week_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_week_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD') and branch like '%$branch%' and date <='$end_week_q')");
                        } else if ($wp_grade == 'MW') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_week_q' and date<='$end_week_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT')  and str_no!='VOID'  and  (out_date > '$end_week_q' or out_date < '$start_week_q' or out_date='')   and (date_rebaled > '$end_week_q' or date_rebaled < '$start_week_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_week_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='CORETUBE' or wp_grade='CT') and branch like '%$branch%' and date <='$end_week_q')");
                        } else if ($wp_grade == 'CHIPBOARD') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_week_q' and date<='$end_week_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or  wp_grade='CB')  and str_no!='VOID'  and  (out_date > '$end_week_q' or out_date < '$start_week_q' or out_date='')   and (date_rebaled > '$end_week_q' or date_rebaled < '$start_week_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_week_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or  wp_grade='CB') and branch like '%$branch%' and date <='$end_week_q')");
                        } else if ($wp_grade == 'OCC') {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_week_q' and date<='$end_week_q' and branch like '%$branch%'  and (wp_grade='$wp_grade' or wp_grade='HM.OCC')  and str_no!='VOID'  and  (out_date > '$end_week_q' or out_date < '$start_week_q' or out_date='')   and (date_rebaled > '$end_week_q' or date_rebaled < '$start_week_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_week_q' or date_rebaled='') and status!='rebaled' and (wp_grade='$wp_grade' or wp_grade='HM.OCC') and branch like '%$branch%' and date <='$end_week_q')");
                        } else {
                            $sql_actual = mysql_query("SELECT sum(bale_weight) from bales where (date>='$start_week_q' and date<='$end_week_q' and branch like '%$branch%'  and wp_grade='$wp_grade'  and str_no!='VOID'  and  (out_date > '$end_week_q' or out_date < '$start_week_q' or out_date='')   and (date_rebaled > '$end_week_q' or date_rebaled < '$start_week_q' or date_rebaled='')) or (str_no='0' and str_no!='VOID' and (date_rebaled>'$end_week_q' or date_rebaled='') and status!='rebaled' and wp_grade='$wp_grade' and branch like '%$branch%' and date <='$end_week_q')");
                        }

                        $rs_actual = mysql_fetch_array($sql_actual);
                        $actual = $rs_actual['sum(bale_weight)'];


                        if ($wp_grade != 'LCWL' && $wp_grade != 'CHIPBOARD') {
                            $q_grade = "LC" . $wp_grade;
                        } else {
                            $q_grade = $wp_grade;
                        }

                        $loose = 0;
                        $month_end_loose = 0;
                        if ($q_grade == 'LCWL') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_week_q' and (wp_grade='$q_grade' or wp_grade='LCWB' or wp_grade='WBOND') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else if ($q_grade == 'LCONP') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_week_q' and (wp_grade='$q_grade'or wp_grade='LCNPB' or wp_grade='LCOIN' or wp_grade='LCOPD') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else if ($q_grade == 'LCMW') {
                            $sql_loose_papers3 = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_week_q' and (wp_grade='$q_grade' or wp_grade='CORETUBE' or wp_grade='LCCT') and branch like '%$branch%'");
                            $rs_loose_papers3 = mysql_fetch_array($sql_loose_papers3);
                            $loose += $rs_loose_papers3['sum(weight)'];
                        } else if ($q_grade == 'CHIPBOARD') {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_week_q' and (wp_grade='$q_grade' or wp_grade='LCCB') and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        } else {
                            $sql_loose_papers = mysql_query("SELECT sum(weight) FROM loose_papers where date='$end_week_q' and wp_grade='$q_grade' and branch like '%$branch%'");
                            $rs_loose_papers = mysql_fetch_array($sql_loose_papers);
                            $loose += $rs_loose_papers['sum(weight)'];
                        }

                        if ($cur_month_end_end == $end_week_q) {
                            if ($q_grade == 'LCWL') {
                                $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='LCWB' or wp_grade='WBOND') and branch like '%$branch%' and month_end_date='$q_month'");
                                $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                                $month_end_loose += $rs_month_end_loose['sum(weight)'];
                            } else if ($q_grade == 'LCONP') {
                                $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='NPB' or wp_grade='LCOIN' or wp_grade='LCOPD') and branch like '%$branch%' and month_end_date='$q_month'");
                                $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                                $month_end_loose += $rs_month_end_loose['sum(weight)'];
                            } else if ($q_grade == 'LCMW') {
                                $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='CORETUBE' or wp_grade='CORETUBE' or wp_grade='LCCT') and branch like '%$branch%' and month_end_date='$q_month'");
                                $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                                $month_end_loose += $rs_month_end_loose['sum(weight)'];
                            } else if ($q_grade == 'CHIPBOARD') {
                                $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where (wp_grade='$q_grade' or wp_grade='LCCB') and branch like '%$branch%' and month_end_date='$q_month'");
                                $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                                $month_end_loose += $rs_month_end_loose['sum(weight)'];
                            } else {
                                $sql_month_end_loose = mysql_query("SELECT sum(weight) from month_end_loose where wp_grade='$q_grade' and branch like '%$branch%' and month_end_date='$q_month'");
                                $rs_month_end_loose = mysql_fetch_array($sql_month_end_loose);
                                $month_end_loose += $rs_month_end_loose['sum(weight)'];
                            }
                        }

                        $wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] = $actual + $loose + $month_end_loose;
                        if ($start_week_q == $cur_month_start) {
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
                    $wp_grade_inv_target[$wp_grade] = $rs_target['sum(target)'];
                }

                echo
                "<thead>";
                echo "<th>WP Grade</th>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        $end_q = date('Y/m/t', strtotime(
                                        $start_q));
                    } else if (
                            $q_month == $end_date_month) {

                        $start_q = $start_q;
                        $end_q = $end_date;
                    } else {
                        $end_q = date('Y/m/t', strtotime($start_q));
                    }

                    $month_q = date('M', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<th>$month_q - $year_q</th>";
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime(
                                            $start_q)));
                }

                $ctr = 1;
                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q == $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<th>Week $ctr <br>" . date("M d", strtotime($start_week_q)) . " - " . date("M d, Y", strtotime($end_week_q)) . "</th>";
                    if ($start_week_q == $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                    $ctr++;
                }
                echo
                "<th>MTD</th>";
                echo "<th>Target</th>";
                echo "<th>% of Target</th>";
                echo "</thead>";

                foreach ($wp_grade_array as $wp_grade) {
                    echo
                    "<tr>";
                    echo "<td>$wp_grade</td>";
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month . "/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            $end_q = date('Y/m/t', strtotime($start_q));
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        if (!isset($wp_grade_tot_actual[$start_q][$end_q])) {
                            $wp_grade_tot_actual[$start_q][$end_q] = 0;
                        }
                        if ($wp_grade_inv[$wp_grade][$start_q][$end_q] == '') {
                            echo
                            "<td>-</td>";
                        } else {
                            echo "<td>" . round($wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000, 2) . "</td>";
                            $wp_grade_tot_actual[$start_q][$end_q]+=$wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                        }
                        $actual = $wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }


                    $start_week_q = $cur_month_start;
                    while ($start_week_q < $cur_month_end) {
                        $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        if ($start_week_q == $cur_month_start) {
                            $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        } else {
                            if ($end_week_q > $cur_month_end) {
                                $end_week_q = $cur_month_end;
                            } else {
                                $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                            }
                        }
                        if (!isset($wp_grade_tot_weekly[$start_week_q][$end_week_q])) {
                            $wp_grade_tot_weekly[$start_week_q][$end_week_q] = 0;
                        }
                        if ($wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] == '') {
                            echo "<td>-</td>";
                        } else {
                            echo "<td>" . round($wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] / 1000, 2) . "</td>";
                            $wp_grade_tot_weekly[$start_week_q][$end_week_q]+=$wp_grade_inv_weekly[$wp_grade][$start_week_q][$end_week_q] / 1000;
                        }
                        if ($start_week_q == $cur_month_start) {
                            $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                            $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                        } else {
                            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td>" . round($actual, 2) . "</td>";
                    $total_target+=$wp_grade_inv_target[$wp_grade];
                    echo "<td>" . $wp_grade_inv_target[$wp_grade] . "</td>";
                    echo "<td>" . round(($actual / $wp_grade_inv_target[$wp_grade]) * 100, 2) . " %</td>";
                    echo "</tr>";
                }
                echo "<tr class='total'>";
                echo "<td>Total in MT</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
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
                    echo "<td>" . round($wp_grade_tot_actual[$start_q][$end_q], 2) . "</td>";
                    $actual = $wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q == $cur_month_start) {
                        $end_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                    } else {
                        if ($end_week_q > $cur_month_end) {
                            $end_week_q = $cur_month_end;
                        } else {
                            $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                        }
                    }
                    echo "<td>" . round($wp_grade_tot_weekly[$start_week_q][$end_week_q], 2) . "</td>";
                    if ($start_week_q == $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                }
                echo "<td>" . round($total_mtd / 1000, 2) . "</td>";
                echo "<td>" . round($total_target, 2) . "</td>";
                echo "<td>" . round((($total_mtd / 1000) / $total_target) * 100, 2) . "</td>";
                echo "</tr>";


                echo "<tr class='total'>";
                echo "<td>Total Cost</td>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
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


                    $month_q = date('M', strtotime($start_q));
                    $year_q = date('Y', strtotime($start_q));
                    echo "<td>" . number_format(($wp_grade_tot_actual[$start_q][$end_q] * 1000) * ($rs_unit_cost['sum(paper_buying)'] / $rs_unit_cost['sum(corrected_weight)']), 2) . "</td>";
                    $actual = $wp_grade_inv[$wp_grade][$start_q][$end_q] / 1000;
                    $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                }

                $start_week_q = $cur_month_start;
                while ($start_week_q < $cur_month_end) {
                    $end_week_q = date('Y/m/d', strtotime("+6 days", strtotime($start_week_q)));
                    if ($start_week_q == $cur_month_start) {
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
                    echo "<td>" . number_format(($wp_grade_tot_weekly[$start_week_q][$end_week_q] * 1000) * ($rs_unit_cost['sum(paper_buying)'] / $rs_unit_cost['sum(corrected_weight)']), 2) . "</td>";
                    if ($start_week_q == $cur_month_start) {
                        $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                        $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                    } else {
                        $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                    }
                }
                echo "<td>" . round($total_mtd / 1000, 2) . "</td>";
                echo "<td>" . round($total_target, 2) . "</td>";
                echo "<td>" . round((($total_mtd / 1000) / $total_target) * 100, 2) . "</td>";
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