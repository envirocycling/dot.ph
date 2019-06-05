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
        <form action="acctg_wastepaper_prices.php" method="POST">
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
                              $dropdown .= "\r\n<option value='without pampanga'>Without Pampanga</option>";
                             while ($row = mysql_fetch_array($result)) {
                                 $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
                             }
                             $dropdown .= "\r\n</select><br>";
                             echo $dropdown;
                             ?>
            <input type="submit" name="submit" value="Filter">
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_16" >
        <div class="box round first grid">
            <h2>Wastepaper Prices
                <?php ?>
            </h2>
            <br><br>
            <table class="table">


                <?php
                $start_date = $_POST['start_date'];
                $start_date_month = date('Y/m', strtotime($start_date));
                $end_date = $_POST['end_date'];
                $end_date_month = date('Y/m', strtotime($end_date));

                $cur_month_start = $end_date_month . "/01";
                $cur_month_end = $end_date;

                $branch = $_POST['branch'];

                $wp_grade_array = array();
                $sql_material = mysql_query("SELECT * from material WHERE status='' and class='1' ORDER BY details Asc") or die(mysql_error());
                while($row_material = mysql_fetch_array($sql_material)){
                   if((strpos($row_material['code'],'LCWL') === false) && (strpos($row_material['code'], 'CHIPBOARD') === false)){
                       $wp = substr($row_material['code'],2);
                   }else{
                       $wp = $row_material['code'];
                   }
                   array_push($wp_grade_array,$wp);
                }
                $wt_avg_per_month = array();


                foreach ($wp_grade_array as $wp_grade) {
                    $wt_avg = 0;
                    $total_wp_grade = 0;
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month . "/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            if ($q_month == $end_date_month) {
                                $end_q = $end_date;
                            } else {
                                $end_q = date('Y/m/t', strtotime($start_q));
                            }
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        
                        if($_POST['branch'] != 'without pampanga' ){
                            if ($wp_grade == 'LCWL') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch like '%$branch%'  and (wp_grade = '$wp_grade' or  wp_grade='WB' or wp_grade='WBOND') and paper_buying >'0'");
                            } else if ($wp_grade == 'ONP') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch like '%$branch%'  and (wp_grade like '%$wp_grade%' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD') and paper_buying >'0'");
                            } else if ($wp_grade == 'MW') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch like '%$branch%'  and (wp_grade like '%$wp_grade%' or  wp_grade='CORETUBE' or wp_grade='CT') and paper_buying >'0'");
                            } else if ($wp_grade == 'CHIPBOARD') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch like '%$branch%'  and (wp_grade like '%$wp_grade%' or  wp_grade='CB') and paper_buying >'0'");
                            } else {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch like '%$branch%'  and wp_grade like '$wp_grade%' and paper_buying >'0'");
                            }
                        }else if($_POST['branch'] == 'without pampanga' ){
                            if ($wp_grade == 'LCWL') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch  not like '%pampanga%' and (wp_grade = '$wp_grade' or  wp_grade='WB' or wp_grade='WBOND') and paper_buying >'0'");
                            } else if ($wp_grade == 'ONP') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch  not like '%pampanga%'  and (wp_grade like '%$wp_grade%' or  wp_grade='NPB' or wp_grade='OIN' or wp_grade='OPD') and paper_buying >'0'");
                            } else if ($wp_grade == 'MW') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch  not like '%pampanga%' and (wp_grade like '%$wp_grade%' or  wp_grade='CORETUBE' or wp_grade='CT') and paper_buying >'0'");
                            } else if ($wp_grade == 'CHIPBOARD') {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch  not like '%pampanga%' and (wp_grade like '%$wp_grade%' or  wp_grade='CB') and paper_buying >'0'");
                            } else {
                                $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) from paper_buying where date_received>='$start_date' and date_received<='$end_date' and branch  not like '%pampanga%' and wp_grade like '$wp_grade%' and paper_buying >'0'");
                            }
                        }
                        $rs_unit_cost = mysql_fetch_array($sql_unit_cost);


                        $wt_avg_per_month[$wp_grade][$start_q][$end_q] = $rs_unit_cost['sum(paper_buying)'] / $rs_unit_cost['sum(corrected_weight)'];
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
						
						//echo  $wt_avg_per_month['LCWL']['2016/02/25']['2016/03/02'];
						
                    }
                }

                echo "<thead>";
                echo "<th>WP Grade</th>";
                $start_q = $start_date;
                while ($start_q <= $end_date) {
                    $q_month = date('Y/m', strtotime($start_q));
                    $start_q = $q_month . "/01";
                    if ($q_month == $start_date_month) {
                        $start_q = $start_date;
                        if ($q_month == $end_date_month) {
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
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
                echo "</thead>";

                foreach ($wp_grade_array as $wp_grade) {
                    echo "<tr>";
                    echo "<td>$wp_grade</td>";
                    $start_q = $start_date;
                    while ($start_q <= $end_date) {
                        $q_month = date('Y/m', strtotime($start_q));
                        $start_q = $q_month . "/01";
                        if ($q_month == $start_date_month) {
                            $start_q = $start_date;
                            if ($q_month == $end_date_month) {
                                $end_q = $end_date;
                            } else {
                                $end_q = date('Y/m/t', strtotime($start_q));
                            }
                        } else if ($q_month == $end_date_month) {
                            $start_q = $start_q;
                            $end_q = $end_date;
                        } else {
                            $end_q = date('Y/m/t', strtotime($start_q));
                        }
                        $month_q = date('M', strtotime($start_q));
                        $year_q = date('Y', strtotime($start_q));
                        if($wt_avg_per_month[$wp_grade][$start_q][$end_q] > 0){
                        echo "<td align='right'>" . number_format($wt_avg_per_month[$wp_grade][$start_q][$end_q], 2) . "</td>";
                        }
                        $start_q = date('Y/m/d', strtotime("+1 month", strtotime($start_q)));
                    }
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    </div>
    <?php
}
?>

<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>