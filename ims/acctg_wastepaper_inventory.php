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
if (isset($_POST['submit'])) {
    ?>
    <div class="grid_16" >
        <div class="box round first grid">
            <h2>Wastepaper Inventory (MT)</h2>
                <?php
                //<!--generation of report start
                $start_date = $_POST['start_date'];
                $start_date_month = date('Y/m', strtotime($start_date));
                $end_date = $_POST['end_date'];
                $end_date_month = date('Y/m', strtotime($end_date));
                $cut_off = $_POST['cutOff'];
                $last_month = date('Y/m', strtotime('-1 month', strtotime($start_date)));

                $cur_month_start = $end_date_month . "/01";
                $cur_month_end = $end_date;
                $cur_month_end_end = date('Y/m/t', strtotime($end_date));

                $branch = $_POST['branch'];
                $wp_array = array("LCWL", "ONP", "CBS", "OCC", "MW", "CHIPBOARD");
                $arr_per_week_th = array();
                $arr_data_per_week = array();
                $total_mt = array();
                
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
                        array_push($arr_per_week_th,$end_week_q);
                        $start_date;
                        $weeek_to = date("Y/m/d", strtotime($end_week_q));
                        
                        
                    //foreach($wp_array as $slct_grade){
                        $sql_bales = mysql_query("SELECT * from bales where (date >='$start_date' and date<='$weeek_to') and (wp_grade LIKE '%%' and  date >='$start_date' and date<='$weeek_to' and ((out_date > '$weeek_to' or out_date < '$start_date' or out_date='' or str_no='0'))    and str_no!='VOID'  and  branch like '%$branch%'  and status !='rebaled') or (str_no='0' and str_no!='VOID' and (date_rebaled>'$weeek_to' or date_rebaled='') and status!='rebaled' and wp_grade LIKE '%%' and branch like '%$branch%'  and date <='$weeek_to')") or die(mysql_error());
                        //echo "SELECT * from bales where (wp_grade='$slct_grade' and  date >='$start_date' and date<='$weeek_to' and ((out_date > '$weeek_to' or out_date < '$start_date' or out_date='' or str_no='0'))    and str_no!='VOID'  and  branch like '%$branch%'  and status !='rebaled') or (str_no='0' and str_no!='VOID' and (date_rebaled>'$weeek_to' or date_rebaled='') and status!='rebaled' and wp_grade='$slct_grade' and branch like '%$branch%'  and date <='$weeek_to')<br>";
                        while($row_bales = mysql_fetch_array($sql_bales)){
                            $wp_grade = strtoupper($row_bales['wp_grade']);
                            if($wp_grade == 'LCWL_GW'){
                                $wp_grade = 'LCWL';
                            }
                            if($wp_grade != 'LCWL'){
                                $wp_grade = str_replace("LC","",$wp_grade);
                            }
                            if($wp_grade == 'MW_S'){
                                $wp_grade = 'MW';
                            }else if($wp_grade == 'NPB'){
                                $wp_grade = 'ONP';
                            }
                            if(ctype_alpha($row_bales['branch']) && !empty($row_bales['branch'])){
                            @$arr_data_per_week[$wp_grade][$weeek_to] += $row_bales['bale_weight'];
                            }
                        }
                        
                        $sql_mloose = mysql_query("SELECT * from month_end_loose where wp_grade LIKE '%%' and branch like '%$branch%' and month_end_date='$last_month'") or die(mysql_error());
                        //echo "SELECT * from month_end_loose where wp_grade LIKE '%$slct_grade%' and branch like '%$branch%' and month_end_date='$last_month'<br>";
                        while($row_mloose = mysql_fetch_array($sql_mloose)){
                            $wp_grade = strtoupper($row_mloose['wp_grade']);
                            if($wp_grade == 'LCWL_GW'){
                                $wp_grade = 'LCWL';
                            }
                            if($wp_grade != 'LCWL'){
                                $wp_grade = str_replace("LC","",$wp_grade);
                            }
                            if($wp_grade == 'MW_S'){
                                $wp_grade = 'MW';
                            }else if($wp_grade == 'NPB'){
                                $wp_grade = 'ONP';
                            }
                           // echo $wp_grade.'<br>';
                            @$arr_data_per_week_mloose[$wp_grade][$weeek_to] += $row_mloose['weight'];
                        }
                        
                        $sql_loose = mysql_query("SELECT * FROM loose_papers where date='$weeek_to' and wp_grade LIKE '%%' and branch like '%$branch%'") or die(mysql_error());
                        //echo "SELECT * FROM loose_papers where date='$weeek_to' and wp_grade='$slct_grade' and branch like '%$branch%' order by log_id limit 1 <br>";    
                            while($row_loose = mysql_fetch_array($sql_loose)){
                                $wp_grade = strtoupper($row_loose['wp_grade']);
                                if($wp_grade == 'LCWL_GW'){
                                    $wp_grade = 'LCWL';
                                }
                                if($wp_grade != 'LCWL'){
                                    $wp_grade = str_replace("LC","",$wp_grade);
                                }
                                if($wp_grade == 'MW_S'){
                                    $wp_grade = 'MW';
                                }else if($wp_grade == 'NPB'){
                                    $wp_grade = 'ONP';
                                }
                                @$arr_data_per_week_loose[$wp_grade][$weeek_to] += $row_loose['weight'];
                            }
                    //}
                                                    
                        if ($start_week_q == $cur_month_start) {
                            $start_week_q = date('Y/m/d', strtotime("next $cut_off", strtotime($start_week_q)));
                            $start_week_q = date('Y/m/d', strtotime("+1 day", strtotime($start_week_q)));
                        } else {
                            $start_week_q = date('Y/m/d', strtotime("+7 days", strtotime($start_week_q)));
                        }
                        $ctr++;
                    }
                    
            echo '<table class="table">';    
            echo '<thead>';
                echo '<th>WP Grade</th>';
                //th per week start
                $week = 1;
                foreach($arr_per_week_th as $slctd_per_week_th){
                    echo '<th> Week '.$week.'<br>As of '.date('M d, Y', strtotime($slctd_per_week_th)).'</th>';
                    $week++;
                }
                //th per week end
            echo '</thead>';
                //td per grade start
                foreach ($wp_array as $slctd_wp){
                echo '<tr>';
                    echo '<td>'.$slctd_wp.'</td>';
                    foreach($arr_per_week_th as $slctd_per_week_th){
                        //echo $slctd_wp.' bales= '.$arr_data_per_week[$slctd_wp][$slctd_per_week_th].' loose= '.$arr_data_per_week_loose[$slctd_wp][$slctd_per_week_th].' = m loose= '.$arr_data_per_week_mloose[$slctd_wp][$slctd_per_week_th];
                        //echo '<br>';
                        //@$total_per_week = round((($arr_data_per_week[$slctd_wp][$slctd_per_week_th] + $arr_data_per_week_loose[$slctd_wp][$slctd_per_week_th] + $arr_data_per_week_mloose[$slctd_wp][$slctd_per_week_th])/1000),2);
                        @$total_per_week = round((($arr_data_per_week[$slctd_wp][$slctd_per_week_th] + $arr_data_per_week_loose[$slctd_wp][$slctd_per_week_th])/1000),2);
                        echo '<td>'.$total_per_week.'</td>';
                        @$total_mt[$slctd_per_week_th] += $total_per_week;
                    }
                echo '</tr>';
                }
                //td per grade end
                echo '<tr class="total">';
                    echo '<td>Total in MT</td>';
                    foreach($arr_per_week_th as $slctd_per_week_th){
                     echo '<td>'.round($total_mt[$slctd_per_week_th],2).'</td>';   
                    }
                echo '</tr>';
                
                 echo '<tr class="total">';
                    echo '<td>Total Cost</td>';
                    foreach($arr_per_week_th as $slctd_per_week_th){
                    $sql_unit_cost = mysql_query("SELECT sum(corrected_weight),sum(paper_buying) FROM paper_buying WHERE date_received>='$start_date' and date_received<='$slctd_per_week_th' and branch like '%$branch%'") or die(mysql_erorr());
                    //echo "SELECT sum(corrected_weight),sum(paper_buying) FROM paper_buying WHERE date_received>='$start_date' and date_received<='$slctd_per_week_th' and branch like '%$branch%'";
                    $rs_unit_cost = mysql_fetch_array($sql_unit_cost);
                    $total_cost = round(($rs_unit_cost['sum(paper_buying)'] / $rs_unit_cost['sum(corrected_weight)']),2);
                    $total_kl = round(($total_mt[$slctd_per_week_th] * 1000),2);
                        echo '<td>'.number_format(($total_kl * $total_cost),2).'</td>';   
                    }
                echo '</tr>';
            echo '</table>';
                ?>
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