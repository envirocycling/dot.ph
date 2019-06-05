<?php
//error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set("Asia/Singapore");
include('templates/template.php');
if (!isset($_SESSION['username'])) {
    echo "<script>
window.location = 'index.php';
</script>";
}
include 'config.php';

$branch_array = array();

$sql_branch = mysql_query("SELECT * FROM branches");
while ($rs_branch = mysql_fetch_array($sql_branch)) {
    array_push($branch_array, $rs_branch['branch_name']);
}
?>

<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        g_calendarObject  = new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"
        });
    }

</script>
<script type="text/javascript">
    function date2(str){
       g_calendarObject  =   new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"
        });
	
		g_calendarObject.addOnSelectedDelegate(function(){
		var date = $('#inputField2').val();
		 var newdate = new Date(date);
		 newdate.setDate(newdate.getDate() + 6);
			
			var dd = newdate.getDate();
   			var mm = newdate.getMonth() + 1;
    		var y = newdate.getFullYear();
			
			if(mm <= 9){
				mm = '0' + mm;
			}
			if(dd <= 9){
				dd = '0' + dd;
			}
			var end_week_value = y + '/' + mm + '/' + dd;
			
  
  			$('#inputField3').val(end_week_value);
			//alert("sadasd");
		});
    };
</script>


<link rel="stylesheet" href="css/new_tf.css" type="text/css"></style>
  
  <script>
  	/*function startdate(){
			var start_week = $('#start_week').val();
			var data = start_week.split("-");
			var year = data[0];
			var month = data[1];
			var day = data[2];
			var mydate = month + '/' + day + '/' + year;
			var date = new Date(mydate);
   			var newdate = new Date(date);
			 
			 newdate.setDate(newdate.getDate() + 6);
			
			var dd = newdate.getDate();
   			var mm = newdate.getMonth() + 1;
    		var y = newdate.getFullYear();
			
			if(mm <= 9){
				mm = '0' + mm;
			}
			if(dd <= 9){
				dd = '0' + dd;
			}
			var end_week_value = y + '-' + mm + '-' + dd;
			
			$('#end_week').val(end_week_value);

		} */
		
	function view_encoded(){
		var branch = document.getElementById('e_branch').value;
		alert(branch);
	}
	
	function isNumber(evt) {
   	     evt = (evt) ? evt : window.event;
   			 var charCode = (evt.which) ? evt.which : evt.keyCode;
   			 if (charCode > 47 && charCode < 58) {
       			 return true;
  			  }
   			 return false;

	}
	

	
	


  </script>
  
<div class="grid_4">

    <div class="box round first">
        <?php
//        if ($_SESSION['username'] == 'lonlon') {
        $arr_branches = array();
        ?>
        <h2>Daily Report New</h2>
        <h5>Filtering Options</h5>
		<br />
        <form action="" method="POST">
			<table>
				<tr class="tr">
					<td >Start Date:</td>
					<td><input class='dates' type='text' id='inputField' name='start_date' value="<?php if(isset ($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date1(this.id);' onkeyup="trys();"  readonly size="8"></td>
                                        <td >&nbsp;&nbsp;End Date:</td>
					<td><input class='dates' type='text' id='inputField2' name='end_date' value="<?php if(isset ($_POST['end_date'])) {
                echo $_POST['end_date'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date1(this.id);' onkeyup="trys();"  readonly size="8"></td>
				</tr>
                                <tr class="tr">
                                    <td>
                                        Cut off: </td>
                                    <td>
                                        <select name="cutOff">
                                            <?php
                                            if (isset($_POST['cutOff'])) {
                                                echo '<option value="' . $_POST['cutOff'] . '">' . $_POST['cutOff'] . '</option>';
                                            }
                                            ?>
                                            <option value="Sunday">Sunday</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                        </select>
                                    </td>
                                </tr>
				<tr class="tr">
					<td>Branch:</td>
					<td>
						<?php
							$sql_branch = mysql_query("SELECT * from branches WHERE branch_name!='".@$_POST['branch']."'") or die (mysql_error());
						?>
						<select name="branch">
							<?php
								if(isset($_POST['submit'])){
									echo '<option value="'.$_POST['branch'].'">'.$_POST['branch'].'</option>';
								}
                                                                
                                                                echo '<option value="">All Branches</option>';
                                                                echo '<option value="Without Pamp">Wihtout Pamp</option>';
								while($row_branch = mysql_fetch_array($sql_branch)){
								echo '<option value="'.$row_branch['branch_name'].'">'.$row_branch['branch_name'].'</option>';
                                                                array_push($arr_branches,$row_branch['branch_name']);
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Submit" name="submit"></td>
				</tr>
			</table>
			
	</form>
    </div>

</div>

 <?php
 if(isset($_POST['submit'])){
 $header_date = date('F d, Y', strtotime($_POST['end_date']));
 $month = date('Y/m', strtotime($_POST['end_date']));
 $branch = $_POST['branch'];
 $from = $_POST['start_date'];
 $end = $_POST['end_date'];
 $num_of_days = date('t',strtotime($end));
 $week_end_chk = date('l', strtotime($_POST['end_date']));
 if($week_end_chk == $_POST['cutOff']){
     $week_start =  $_POST['end_date'];
 }else{
    $week_start =  date('Y/m/d', strtotime('previous '.$_POST['cutOff'].'', strtotime($_POST['end_date'])));
 }
 //echo  $week_start;
 $current_date = date('Y/m/d');
 $week_end = date('Y/m/d', strtotime('+6 day', strtotime($week_start)));
 if($week_end >= $current_date){
     $week_end = date('Y/m/d', strtotime('-1 day', strtotime($current_date)));
 }
    if($current_date == $end){
        $end = date('Y/m/d', strtotime('-1 day', strtotime($end)));
    }
 //echo $week_start.'==================================';
 $wp_grade = array("LCWL", "ONP", "CBS", "OCC", "MW-TIPCO", "MW-FSI", "CHIPBOARD");
 $wp_grade_target = array("LCWL", "ONP", "CBS", "OCC", "MW", "CHIPBOARD");
 $arr_target = array();
 $arr_salesmtd = array();
 $arr_actualpaper = array();
 $arr_actualweight = array();
 
 $arr_dailytonnage = array();
 $arr_dailyactualpaper = array();
 $arr_dailyactualweight = array();
 $arr_per_branch = array();
 
 $arr_weekly_actual = array();
 $arr_weeklyactualpaper = array();
 $arr_weeklyactualweight = array();
 $arr_weekly_targetprice = array();
 $arr_weekly_targetpricecount = array();
 
 $arr_paper_mtd = array();
 $arr_paper_wtd = array();
 $arr_paper_daily = array();
 $arr_paper_standing_target = array();
 $arr_paper_standing_actual = array();
 $arr_per_branch_total = array();
 $arr_per_branch_ton = array();
 
 //$arr_weeklytargetprice = array();
 
 $target_total = 0;
 
//target start
    if($branch == 'Without Pamp'){
        $sql_target = mysql_query("SELECT * from monthly_target WHERE month='$month' and branch NOT LIKE '%Pampanga%' and branch != '' ") or die(mysql_error());
    }else{
        $sql_target = mysql_query("SELECT * from monthly_target WHERE month='$month' and branch LIKE '%$branch%' and branch != '' ") or die(mysql_error());
    }
    while($row_target = mysql_fetch_array($sql_target)){
        $row_wpgrade = strtoupper($row_target['wp_grade']);
        $arr_target[$row_wpgrade] += $row_target['target'];
        $target_total += $row_target['target'];
    }
//target end
    
//sales mtd start
    if($branch == 'Without Pamp'){
        $sql_salesmtd = mysql_query("SELECT * from actual WHERE date>='$from' and date<='$end' and branch NOT LIKE '%Pampanga%' and branch != '' ") or die(mysql_error());
    }else{
        $sql_salesmtd = mysql_query("SELECT * from actual WHERE date>='$from' and date<='$end' and branch LIKE '%$branch%' and branch != '' ") or die(mysql_error());
    }
    // echo "SELECT * from actual WHERE date>='$from' and date<='$end' and branch LIKE '%$branch%' and branch != ''";
    while($row_salesmtd = mysql_fetch_array($sql_salesmtd)){
        $row_wpgrade = strtoupper($row_salesmtd['wp_grade']);
        $delivered_to = strtoupper($row_salesmtd['delivered_to']);
        
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'LCMW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'LCNPB' || $row_wpgrade == 'LCOPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        if($row_wpgrade == 'MW'){
            $del_to = strtoupper($row_salesmtd['delivered_to']);
            if($del_to == 'TIPCO' || $del_to == 'MULTIPLY'){
                $row_wpgrade = 'MW-TIPCO';
            }else if($del_to == 'FSI'){
                $row_wpgrade = 'MW-FSI';
            }
        }
        //echo $row_wpgrade;
        //echo '<br>';
        $arr_salesmtd[$row_wpgrade] += ($row_salesmtd['weight'] / 1000);
    }
//sales mtd end
    
//actual cost start 
    if($branch == 'Without Pamp'){
        $sql_actualcost = mysql_query("SELECT * from paper_buying WHERE date_received >= '$from' and date_received <= '$end' and branch NOT LIKE '%Pampanga%' and branch !=''") or die(mysql_error());
    }else{
        $sql_actualcost = mysql_query("SELECT * from paper_buying WHERE date_received >= '$from' and date_received <= '$end' and branch LIKE '%$branch%' and branch !=''") or die(mysql_error());
    }
    while($row_actualcost = mysql_fetch_array($sql_actualcost)){
        $row_wpgrade = strtoupper($row_actualcost['wp_grade']);
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'MW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'NPB' || $row_wpgrade == 'OPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'OIN'){
            $row_wpgrade = 'ONP';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        
        $arr_actualpaper[$row_wpgrade] += $row_actualcost['paper_buying'];
        $arr_actualweight[$row_wpgrade] += $row_actualcost['corrected_weight'];
    }
//actual cost start
    
    
//weekly start
    if($branch == 'Without Pamp'){
        $sql_weekly_actual = mysql_query("SELECT * from actual WHERE date >= '$week_start' and date <= '$week_end' and branch NOT LIKE '%Pampanga%' and branch!=''") or die(mysql_error());   
    }else{
        $sql_weekly_actual = mysql_query("SELECT * from actual WHERE date >= '$week_start' and date <= '$week_end' and branch LIKE '%$branch%' and branch!=''") or die(mysql_error());
    }
    while($row_weekly_actual = mysql_fetch_array($sql_weekly_actual)){
        $row_wpgrade = strtoupper($row_weekly_actual['wp_grade']);
        $delivered_to = strtoupper($row_weekly_actual['delivered_to']);
        
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'LCMW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'LCNPB' || $row_wpgrade == 'LCOPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        if($row_wpgrade == 'MW'){
            $del_to = strtoupper($row_weekly_actual['delivered_to']);
            if($del_to == 'TIPCO' || $del_to == 'MULTIPLY'){
                $row_wpgrade = 'MW-TIPCO';
            }else if($del_to == 'FSI'){
                $row_wpgrade = 'MW-FSI';
            }
        }
        //echo $row_wpgrade;
        //echo '<br>';
        $arr_weekly_actual[$row_wpgrade] += ($row_weekly_actual['weight'] / 1000);
    }
    if($branch == 'Without Pamp'){
        $sql_weeklyprice = mysql_query("SELECT * from paper_buying WHERE date_received >= '$week_start' and date_received <= '$week_end' and branch NOT LIKE '%Pampanga%' and branch !=''") or die(mysql_error());    
    }else{
        $sql_weeklyprice = mysql_query("SELECT * from paper_buying WHERE date_received >= '$week_start' and date_received <= '$week_end' and branch LIKE '%$branch%' and branch !=''") or die(mysql_error());
    }
    while($row_weeklyprice = mysql_fetch_array($sql_weeklyprice)){
        $row_wpgrade = strtoupper($row_weeklyprice['wp_grade']);
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'MW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'NPB' || $row_wpgrade == 'OPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'OIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        
        $arr_weeklyactualpaper[$row_wpgrade] += $row_weeklyprice['paper_buying'];
        $arr_weeklyactualweight[$row_wpgrade] += $row_weeklyprice['corrected_weight'];
    }
    //echo $branch;
    if($branch == 'Without Pamp'){
        $sql_weeklytargetprice = mysql_query("SELECT * FROM weekly_target WHERE branch NOT LIKE '%Pampanga%' and branch != '' and date_effective='$week_end'") or die(mysql_error());    
        //echo "SELECT * FROM weekly_target WHERE branch NOT LIKE '%Pampanga%' and branch != '' and date_effective='$end'";
    }else{
        $sql_weeklytargetprice = mysql_query("SELECT * FROM weekly_target WHERE branch LIKE '%$branch%' and branch != '' and date_effective='$week_end'") or die(mysql_error());
    
        //echo "SELECT * FROM weekly_target WHERE branch LIKE '%$branch%' and branch != '' and date_effective='$end'";
    }
    while($row_weeklytargetprice = mysql_fetch_array($sql_weeklytargetprice)){
        $row_wpgrade = strtoupper($row_weeklytargetprice['wp_grade']);
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'MW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'NPB' || $row_wpgrade == 'OPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'OIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        $arr_weekly_targetprice[$row_wpgrade] += ($row_weeklytargetprice['unit_cost'] * $row_weeklytargetprice['target']);
        $arr_weekly_targetpricecount[$row_wpgrade] += $row_weeklytargetprice['target'];
    }
//weekly end
    
    
//daily breakdown start
    if($branch == 'Without Pamp'){
        $sql_daily = mysql_query("SELECT * from actual WHERE date = '$end' and branch NOT LIKE '%Pampanga%' and branch!=''") or die(mysql_error());
    }else{
        $sql_daily = mysql_query("SELECT * from actual WHERE date = '$end' and branch LIKE '%$branch%' and branch!=''") or die(mysql_error());
    }
    while($row_daily = mysql_fetch_array($sql_daily)){
        $row_wpgrade = strtoupper($row_daily['wp_grade']);
        $row_branch = strtoupper($row_daily['branch']);
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'LCMW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'LCNPB' || $row_wpgrade == 'LCOPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        
        if($row_wpgrade == 'MW'){
            $del_to = strtoupper($row_daily['delivered_to']);
            if($del_to == 'TIPCO' || $del_to == 'MULTIPLY'){
                $row_wpgrade = 'MW-TIPCO';
            }else if($del_to == 'FSI'){
                $row_wpgrade = 'MW-FSI';
            }
        }
        
        $arr_dailytonnage[$row_wpgrade] += $row_daily['weight'];
    }
    
    $sql_daily2 = mysql_query("SELECT * from actual WHERE date = '$end' and branch!=''") or die(mysql_error());
    while($row_daily2 = mysql_fetch_array($sql_daily2)){
        $row_wpgrade = strtoupper($row_daily2['wp_grade']);
        $row_branch = strtoupper($row_daily2['branch']);
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'LCMW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'LCNPB' || $row_wpgrade == 'LCOPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        
        if($row_wpgrade == 'MW'){
            $del_to = strtoupper($row_daily2['delivered_to']);
            if($del_to == 'TIPCO' || $del_to == 'MULTIPLY'){
                $row_wpgrade = 'MW-TIPCO';
            }else if($del_to == 'FSI'){
                $row_wpgrade = 'MW-FSI';
            }
        }
        
        $arr_per_branch[$row_branch][$row_wpgrade] += $row_daily2['weight'];
    }
    
    if($branch == 'Without Pamp'){
        $sql_dailyprice = mysql_query("SELECT * from paper_buying WHERE date_received = '$end' and branch NOT LIKE '%Pampanga%' and branch != ''") or die(mysql_error());
    }else{
        $sql_dailyprice = mysql_query("SELECT * from paper_buying WHERE date_received = '$end' and branch LIKE '%$branch%' and branch != ''") or die(mysql_error());
    }
    while($row_dailyprice = mysql_fetch_array($sql_dailyprice)){
    $row_wpgrade = strtoupper($row_dailyprice['wp_grade']);
        if($row_wpgrade == 'LCWL_GW' || $row_wpgrade == 'LCWL_CBS'){
            $row_wpgrade = 'LCWL';
        }else if($row_wpgrade == 'MW_S'){
            $row_wpgrade = 'MW';
        }else if($row_wpgrade == 'NPB' || $row_wpgrade == 'OPD'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'OIN'){
            $row_wpgrade = 'ONP';
        }else if($row_wpgrade == 'LCOCC_E'){
            $row_wpgrade = 'OCC';
        }
        if($row_wpgrade != 'LCWL'){
            $row_wpgrade = str_replace("LC","",$row_wpgrade);
        }
        
        $arr_dailyactualpaper[$row_wpgrade] += $row_dailyprice['paper_buying'];
        $arr_dailyactualweight[$row_wpgrade] += $row_dailyprice['corrected_weight'];
    }
//daily breakdown end
 ?>  
    <div class="grid_10">
	<div class="box round first">
            <h2><?php if(!empty($_POST['branch'])){echo $_POST['branch'];}else{ echo 'Envirocycling Fiber Inc';} echo '  as of  '.$header_date;?></h2>
		<div class="header"><center>Monthly - MTD</center></div>
                <center>
                    <table>
                        <tr>
                            <td class="th" align="center">EFI</td>
                            <?php
                                foreach($wp_grade as $select_grade){
                                        echo '<td class="th" align="center">'.$select_grade.'</td>';
                                }
                            ?>
                            <td class="th" align="center">Total</td>
                            <td class="percent" rowspan="5" align="center"><span id="salesmtd_percent"></span>%</td>
                        </tr>
                        <tr>
                            <td class="targetonsale">Target on Sales</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                        echo '<td class="bg'.$num.'" align="center">'.$arr_target[$select_grade].'</td>';
                                        if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                        echo '<td class="bg'.$num.'" align="center"></td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.$arr_target[$select_grade].'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"  align="center"><?php echo number_format($target_total,0)?></td>
                        </tr>
                        <tr>
                            <td class="salesmtd">Sales MTD</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade as $select_grade){
                                    echo '<td class="bg'.$num.'" align="center">'.round($arr_salesmtd[$select_grade]).'</td>';
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                    $salesmtd_total += round($arr_salesmtd[$select_grade]);
                                }
                            ?>
                            <td class="total"  align="center"><?php echo number_format($salesmtd_total,0)?></td>
                        </tr>
                        <tr>
                            <td class="mtdactualprice">MTD Actual Price</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                    echo '<td class="bg'.$num.'" align="center">'.round(($arr_actualpaper[$select_grade]/$arr_actualweight[$select_grade]),2).'</td>';
                                        if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                        }
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_actualpaper[$select_grade]/$arr_actualweight[$select_grade]),2).'</td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_actualpaper[$select_grade]/$arr_actualweight[$select_grade]),2).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"  align="center"></td>
                        </tr>
                        <tr>
                            <td class="currentstanding">MTD Standing</td>
                            <?php
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                       echo '<td class="currentstanding_bg" colspan="2" align="center">'.round(((($arr_salesmtd['MW-TIPCO'] + $arr_salesmtd['MW-FSI']) / $arr_target[$select_grade]) * 100)).'%</td>'; 
                                    }else{
                                        echo '<td class="currentstanding_bg" align="center">'.round((($arr_salesmtd[$select_grade] / $arr_target[$select_grade]) * 100)).'%</td>';
                                    }
                                }
                            ?>
                            <td class="total"  align="center"></td>
                        </tr>
                    </table>
                <!--mtd end-->
                    <br>
                    
                <!--wtd start-->
                    <div class="header"><center>Weekly - WTD <?php echo '<span style="font-size:10px;">('.date('M d, Y', strtotime($week_start)) .' - '. date('M d, Y', strtotime($week_end)).')</span>';?></center></div>
                    <table>
                        <tr>
                            <td class="th" align="center">EFI</td>
                            <?php
                                foreach($wp_grade as $select_grade){
                                        echo '<td class="th" align="center">'.$select_grade.'</td>';
                                }
                            ?>
                            <td class="th" align="center">Total</td>
                            <td class="percent" rowspan="6" align="center"><span id="weekly_percent"></span>%</td>
                        </tr>
                        <tr>
                            <td class="targetonsale">WTD Target</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                        echo '<td class="bg'.$num.'" align="center">'.$weekly_target = round($arr_target[$select_grade] / 4).'</td>';
                                        if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                        echo '<td class="bg'.$num.'" align="center"></td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.$weekly_target = round($arr_target[$select_grade] / 4).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                $weekly_target_total += $weekly_target;
                                }
                            ?>
                            <td class="total"  align="center"><?php echo  number_format($weekly_target_total,0)?></td>
                        </tr>
                        <tr>
                            <td class="targetprice">WTD Target Price</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                     if($select_grade == 'MW'){
                                         echo '<td class="bg'.$num.'" align="center">'.round(($arr_weekly_targetprice[$select_grade]/$arr_weekly_targetpricecount[$select_grade]),2).'</td>';
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_weekly_targetprice[$select_grade]/$arr_weekly_targetpricecount[$select_grade]),2).'</td>';
                                        
                                     }else{
                                    echo '<td class="bg'.$num.'" align="center">'.round(($arr_weekly_targetprice[$select_grade]/$arr_weekly_targetpricecount[$select_grade]),2).'</td>';
                                     }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"  align="center"></td>
                        </tr>
                        <tr>
                            <td class="salesmtd">WTD Actual</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade as $select_grade){
                                    echo '<td class="bg'.$num.'" align="center">'.round($arr_weekly_actual[$select_grade]).'</td>';
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                    $weeklyactual_total += round($arr_weekly_actual[$select_grade]);
                                }
                            ?>
                            <td class="total"  align="center"><?php echo  number_format($weeklyactual_total,0)?></td>
                        </tr>
                        <tr>
                            <td class="mtdactualprice">WTD Actual Price</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                    echo '<td class="bg'.$num.'" align="center">'.round(($arr_weeklyactualpaper[$select_grade]/$arr_weeklyactualweight[$select_grade]),2).'</td>';
                                        if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                        }
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_weeklyactualpaper[$select_grade]/$arr_weeklyactualweight[$select_grade]),2).'</td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_weeklyactualpaper[$select_grade]/$arr_weeklyactualweight[$select_grade]),2).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"  align="center"></td>
                        </tr>
                        <tr>
                            <td class="currentstanding">WTD Standing</td>
                            <?php
                                foreach($wp_grade_target as $select_grade){
                                    $weekly_target = round($arr_target[$select_grade] / 4);
                                    if($select_grade == 'MW'){
                                       echo '<td class="currentstanding_bg" colspan="2" align="center">'.round(((($arr_weekly_actual['MW-TIPCO'] + $arr_weekly_actual['MW-FSI']) / $weekly_target) * 100)).'%</td>'; 
                                    }else{
                                        echo '<td class="currentstanding_bg" align="center">'.round((($arr_weekly_actual[$select_grade] / $weekly_target) * 100)).'%</td>';
                                    }
                                }
                            ?>
                            <td class="total"  align="center"></td>
                        </tr>
                    </table>
                <!--wtd end-->
                <br>
                <!--daily start-->
                    <div class="header"><center>Daily Breakdown</center></div>
                    <table>
                        <tr>
                            <td class="th" align="center">EFI</td>
                            <?php
                                foreach($wp_grade as $select_grade){
                                        echo '<td class="th" align="center">'.$select_grade.'</td>';
                                }
                            ?>
                            <td class="th" align="center">Total</td>
                            <td class="percent" rowspan="6" align="center"><span id="daily_percent"></span>%</td>
                        </tr>
                        <tr>
                            <td class="targetonsale">Daily Target</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                        echo '<td class="bg'.$num.'" align="center">'.$daily_target = round(($arr_target[$select_grade] / $num_of_days)).'</td>';
                                        if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                        echo '<td class="bg'.$num.'" align="center"></td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.$daily_target = round(($arr_target[$select_grade] / $num_of_days)).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                $daily_totaltarget += $daily_target;
                                }
                            ?>
                            <td class="total" align="center"><center><?php echo $daily_totaltarget?></center></td>
                        </tr>
                        <tr>
                            <td class="salesmtd">Tonnage</td>
                            <?php
                            $num = 1;
                                foreach($wp_grade as $select_grade){
                                        echo '<td class="bg'.$num.'" align="center">'.$daily_tonnage = round(($arr_dailytonnage[$select_grade] / 1000)).'</td>';
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                    $daily_total += $daily_tonnage;
                                }
                            ?>
                            <td class="total"><center><?php echo $daily_total;?></center></td>
                        </tr>
                        <tr>
                            <td class="mtdactualprice">Price</td>
                             <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    if($select_grade == 'MW'){
                                    echo '<td class="bg'.$num.'" align="center">'.round(($arr_dailyactualpaper[$select_grade]/$arr_dailyactualweight[$select_grade]),2).'</td>';
                                        if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                        }
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_dailyactualpaper[$select_grade]/$arr_dailyactualweight[$select_grade]),2).'</td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.round(($arr_dailyactualpaper[$select_grade]/$arr_dailyactualweight[$select_grade]),2).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"></td>
                        </tr>
                    </table>
                <!--daily end-->
                <br>
                <!--paper buying start-->
                    <div class="header"><center>Paper Buying Report</center></div>
                    <table>
                        <tr>
                            <td class="th" align="center">EFI</td>
                            <?php
                                foreach($wp_grade as $select_grade){
                                        echo '<td class="th" align="center">'.$select_grade.'</td>';
                                }
                            ?>
                            <td class="th" align="center">Total</td>
                            <td class="percent" rowspan="6" align="center"><?php echo round(($salesmtd_total/$target_total) * 100).'%';?></td>
                        </tr>
                        <tr>
                            <td class="targetonsale">Weekly Target</td>
                            <?php
                                $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    $paper_weekly_target = round($arr_target[$select_grade] / 4);
                                    $paper_weekly_target_price = round(($arr_weekly_targetprice[$select_grade]/$arr_weekly_targetpricecount[$select_grade]),2);
                                    if($select_grade == 'MW'){
                                        echo '<td class="bg'.$num.'" align="center">'.number_format(($paper_weekly_target * $paper_weekly_target_price) * 1000).'</td>';
                                        if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                        echo '<td class="bg'.$num.'" align="center"></td>';
                                    }else{
                                        echo '<td class="bg'.$num.'" align="center">'.number_format(($paper_weekly_target * $paper_weekly_target_price) * 1000).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                $paper_weeklytarget_ton += round(($paper_weekly_target * $paper_weekly_target_price) * 1000);
                                $arr_paper_standing_target[$select_grade] = ($paper_weekly_target * $paper_weekly_target_price) * 1000;
                                }
                            ?>
                            <td class="total" align="center"><center><?php echo number_format($paper_weeklytarget_ton);?></center></td>
                        </tr>
                        <tr>
                            <td class="salesmtd">MTD Actual</td>
                           <?php
                            $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    $paper_mtd_price = round(($arr_actualpaper[$select_grade]/$arr_actualweight[$select_grade]),2);
                                    if($select_grade == 'MW'){
                                        $paper_mtd_sales = round($arr_salesmtd['MW-TIPCO']);
                                        $paper_mtd = ($paper_mtd_sales * $paper_mtd_price) * 1000;
                                    echo '<td class="bg'.$num.'" align="center">'.number_format($paper_mtd).'</td>';
                                        $paper_mtdtotal += $paper_mtd;
                                        
                                        if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                        }
                                        $paper_mtd_sales = round($arr_salesmtd['MW-FSI']);
                                        $paper_mtd = ($paper_mtd_sales * $paper_mtd_price) * 1000;
                                        echo '<td class="bg'.$num.'" align="center">'.number_format($paper_mtd).'</td>';
                                        $paper_mtdtotal += $paper_mtd;
                                    }else{
                                        $paper_mtd_sales = round($arr_salesmtd[$select_grade]);
                                        $paper_mtd = ($paper_mtd_sales * $paper_mtd_price) * 1000;
                                        $paper_mtdtotal += $paper_mtd;
                                        echo '<td class="bg'.$num.'" align="center">'.number_format($paper_mtd).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"><center><?php echo number_format($paper_mtdtotal);?></center></td>
                        </tr>
                        <tr>
                            <td class="targetprice">WTD Actual</td>
                            <?php
                            $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    $paper_weekly_price = round(($arr_weeklyactualpaper[$select_grade]/$arr_weeklyactualweight[$select_grade]),2);
                                    if($select_grade == 'MW'){
                                        $paper_weekly_actual = round($arr_weekly_actual['MW-TIPCO']);
                                        $paper_weekly = ($paper_weekly_actual * $paper_weekly_price) * 1000;
                                    echo '<td class="bg'.$num.'" align="center">'.number_format($paper_weekly).'</td>';
                                        $paper_weeklytotal += $paper_weekly;
                                        
                                        if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                        }
                                        $paper_weekly_actual = round($arr_weekly_actual['MW-FSI']);
                                        $paper_weekly1 = ($paper_weekly_actual * $paper_weekly_price) * 1000;
                                        echo '<td class="bg'.$num.'" align="center">'.number_format($paper_weekly1).'</td>';
                                        $paper_weeklytotal += $paper_weekly1;
                                        $arr_paper_standing_actual[$select_grade] = $paper_weekly + $paper_weekly1;
                                    }else{
                                        $paper_weekly_actual = round($arr_weekly_actual[$select_grade]);
                                        $paper_weekly = ($paper_weekly_actual * $paper_weekly_price) * 1000;
                                        $paper_weeklytotal += $paper_weekly;
                                        $arr_paper_standing_actual[$select_grade] = $paper_weekly;
                                        echo '<td class="bg'.$num.'" align="center">'.number_format($paper_weekly).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"><center><?php echo number_format($paper_weeklytotal);?></center></td>
                        </tr>
                        <tr>
                            <td class="day"><?php echo date('M d, Y', strtotime($end)).' (Daily)';?></td>
                            <?php
                            $num = 1;
                                foreach($wp_grade_target as $select_grade){
                                    $paper_daily_price = round(($arr_dailyactualpaper[$select_grade]/$arr_dailyactualweight[$select_grade]),2);
                                    if($select_grade == 'MW'){
                                        $paper_daily_sales = round($arr_dailytonnage['MW-TIPCO']/1000);
                                        $paper_daily = ($paper_daily_sales * $paper_daily_price) * 1000;
                                    echo '<td class="bg'.$num.'" align="center">'.number_format($paper_daily).'</td>';
                                        $paper_dailytotal += $paper_daily;
                                        
                                        if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                        }
                                        $paper_daily_sales = round($arr_dailytonnage['MW-FSI']/1000);
                                        $paper_daily = ($paper_daily_sales * $paper_daily_price) * 1000;
                                        echo '<td class="bg'.$num.'" align="center">'.number_format($paper_daily).'</td>';
                                        $paper_dailytotal += $paper_daily;
                                    }else{
                                        $paper_daily_sales = round(($arr_dailytonnage[$select_grade] / 1000));
                                        $paper_daily = ($paper_daily_sales * $paper_daily_price) * 1000;
                                        $paper_dailytotal += $paper_daily;
                                        echo '<td class="bg'.$num.'" align="center">'.number_format($paper_daily).'</td>';
                                    }
                                    if($num == 1){
                                        $num = 2;
                                    }else if($num == 2){
                                        $num = 1;
                                    }
                                }
                            ?>
                            <td class="total"><center><?php echo number_format($paper_dailytotal);?></center></td>
                        </tr>
                        <tr>
                            <td class="currentstanding">Weekly Standing</td>
                            <?php
                                foreach($wp_grade_target as $select_grade){
                                    $paper_weekly_standing = round(($arr_paper_standing_actual[$select_grade] / $arr_paper_standing_target[$select_grade])*100);
                                    if($select_grade == 'MW'){
                                        echo '<td class="currentstanding_bg" colspan="2"><center>'.$paper_weekly_standing.'%</center></td>';
                                    }else{
                                        echo '<td class="currentstanding_bg"><center>'.$paper_weekly_standing.'%</center></td>';
                                    }
                                }
                            ?>
                            <td class="currentstanding_bg"></td>
                        </tr>
                    </table>
                <!--paper buying end-->
                
                <br>
                <!--daily breakdown per branch start-->
                    <div class="header"><center>Daily Breakdown per Branch</center></div>
                    <table>
                        <tr>
                            <td class="th" align="center">Branch</td>
                            <?php
                                foreach ($wp_grade as $select_grade){
                                    echo '<td class="th" align="center">'.$select_grade.'</td>';
                                }
                                echo '<td class="th" width="150px"><center>Total</center></td>';
                            ?>
                        </tr>
                            <?php
                            $num = 1;
                                foreach ($arr_branches as $select_branch){
                                    $select_branch = strtoupper($select_branch);
                                    echo '<tr height="30px;">
                                            <td class="targetonsale" valign="middle" align="center">'.$select_branch.'</td>';
                                            foreach ($wp_grade as $select_grade){
                                                $per_branch = round(($arr_per_branch[$select_branch][$select_grade] / 1000));
                                                if($per_branch > 0){
                                                    $per_branch = '<b>'.$per_branch.'</b>';
                                                }
                                                echo '<td class="bg'.$num.'" align="center">'.$per_branch.'</td>';
                                                $arr_per_branch_total[$select_grade] += round(($arr_per_branch[$select_branch][$select_grade] / 1000));
                                                $arr_per_branch_ton[$select_branch] += round(($arr_per_branch[$select_branch][$select_grade] / 1000));
                                            }
                                            echo '<td class="total"><center>'.$arr_per_branch_ton[$select_branch].'</td>';
                                    echo '</tr>';
                                    
                                    
                                    if($num == 1){
                                        $num = 2;
                                        }else if($num == 2){
                                            $num = 1;
                                    }
                                }
                            ?>
                        <tr height="40px;">
                            <td class="total"><center>Total</center></td>
                            <?php
                            foreach ($wp_grade as $select_grade){
                                echo '<td class="total" align="center">'.$arr_per_branch_total[$select_grade].'</td>';
                                $per_branch_total += $arr_per_branch_total[$select_grade];
                            }
                            echo '<td class="total" align="center">'.$per_branch_total.'</td>';
                            ?>
                        </tr>
                    </table>
                <!--daily breakdown per branch end-->
                </center>
        </div>
    </div>
  
 <?php }?>
<div class="clear">

</div>

<div class="clear">

</div>

  
<script>
    window.onload = function() {
        /*sales mtd percent computation start*/
            var salesmtd_total = Number('<?php echo $salesmtd_total?>');
            var salesmatd_totaltarget = Number('<?php echo $target_total?>');
            var salesmtd_percent = Math.round((salesmtd_total / salesmatd_totaltarget)*100);
            document.getElementById('salesmtd_percent').innerHTML  = salesmtd_percent;
        /*sales mtd percent computation end*/
        
        /*weekly percent computation start*/
            var weekly_total = Number('<?php echo $weeklyactual_total;?>');
            var weekly_totaltarget = Number('<?php echo $weekly_target_total?>');
            var weekly_percent = Math.round((weekly_total / weekly_totaltarget)*100);
            document.getElementById('weekly_percent').innerHTML  = weekly_percent;
        /*weekly percent computation end*/
        
        /*daily percent computation start*/
            var daily_total = Number('<?php echo $daily_total?>');
            var daily_totaltarget = Number('<?php echo $daily_totaltarget?>');
            var daily_percent = Math.round((daily_total / daily_totaltarget)*100);
            document.getElementById('daily_percent').innerHTML  = daily_percent;
        /*daily percent computation end*/
    };
</script>
