<?php
//error_reporting(E_ERROR | E_PARSE);
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

        ?>
        <h2>Testing Report (LuzVizMin)</h2>
        <h5>Filtering Options</h5>
		<br />
        <form action="" method="POST">
			<table>
				<tr class="tr">
					<td >Date:</td>
					<td><input class='dates' type='text' id='inputField' name='start_date' value="<?php if(isset ($_POST['start_date'])) {
                echo $_POST['start_date'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date1(this.id);' onkeyup="trys();"  readonly size="8"></td>
				</tr>
				<tr class="tr">
					<td>Start Week:</td>
					<!---<td><input type='text' id='inputField' name='start_date' value="" onfocus='date1(this.id);'  readonly size="8"></td>--->
					<td><input  type='text' id='inputField2' name='start_week' value="<?php if(isset ($_POST['submit'])) {
                echo $_POST['start_week'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date2(this.id);'  readonly size="8"></td>
				</tr>
				<tr class="tr">
					<td>End Week:</td>
					<!---<td><input type='date' name='end_week' value="" id="end_week" readonly/> +6 days</td>--->
					<td><input  type='text' id='inputField3' name='end_week' value="<?php if(isset ($_POST['submit'])) {
                echo $_POST['end_week'];
            } else {
                echo date("Y/m/d");
                               }?>"  readonly size="8"> +6 days</td>
				</tr>
				<tr class="tr">
					<td>Branch:</td>
					<td>
						<?php
							$sql_branch = mysql_query("SELECT * from branches WHERE branch_name!='".@$_POST['branch']."'") or die (mysql_error());
						?>
						<select name="branch" required>
							<?php
								if(isset($_POST['submit'])){
									echo '<option value="'.$_POST['branch'].'">'.$_POST['branch'].'</option>';
								}else{ 
								echo '<option value="" selected disabled>Select</option>';
								}
								while($row_branch = mysql_fetch_array($sql_branch)){
								echo '<option value="'.$row_branch['branch_name'].'">'.$row_branch['branch_name'].'</option>';
							} ?>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="submit" value="Submit" name="submit"></td>
				</tr>
			</table>
			
	</form>
           </br></br><a href="encode_mtd_new.php"><button>Encode Target</button></a>
    </div>

</div>

 <?php
 if(isset($_POST['submit'])){	
 
 
	//================================================== Monthly Target========================================================================
 	$myData_encode = array();
	$myData_salemtd = array();
	$myData_actualprice = array();
	$myData_actualweight = array();
	
	$start_date =date('Y/m', strtotime($_POST['start_date']));
	$start_date3 =$_POST['start_date'];
	$start_date2 =$_POST['start_date'];
	 $myDate = date('Y/m/d');
		if($start_date2 > $myDate){
			$start_date2 = $myDate;
		}else{
			$start_date2 = $start_date2;
		}
 	$header_date = date('F , d', strtotime($start_date2));
	
	
	$sql_encode = mysql_query("SELECT * from island_group_target WHERE date='$start_date' and branch='".$_POST['branch']."'") or die(mysql_error());
	
		 while($row_encode = mysql_fetch_array($sql_encode)){
		 	$wp_grade = strtoupper($row_encode['wp_grade']);
			$gp_island = strtoupper($row_encode['group_island']);
			@$myData_encode[$wp_grade][$gp_island] = $row_encode['target'];
			@$myTotal[$gp_island] += $row_encode['target'];
		 }	
	
	//$sql_salemtd = mysql_query("SELECT * from sup_deliveries WHERE date_delivered  like '$start_date/%' and branch_delivered='".$_POST['branch']."'") or die(mysql_error());
	$sql_salemtd = mysql_query("SELECT * from sup_deliveries WHERE date_delivered LIKE '$start_date%' and date_delivered <= '$start_date3' and branch_delivered='".$_POST['branch']."'") or die(mysql_error());
	
		while($row_salemtd = mysql_fetch_array($sql_salemtd)){
			$sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$row_salemtd['supplier_id']."'") or die (mysql_error());
			$row_supplier = mysql_fetch_array($sql_supplier);
			$wp_grade = strtoupper($row_salemtd['wp_grade']);
			$gp_island = strtoupper($row_supplier['group_island']);
			@$myData_salemtd[$wp_grade][$gp_island] +=  $row_salemtd['weight'];
			@$myTotal_salemtd[$gp_island] += round($row_salemtd['weight']);
			
		}
		
		/*while($row_salemtd = mysql_fetch_array($sql_salemtd)){
			$sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$row_salemtd['supplier_id']."'");
			$row_supplier = mysql_fetch_array($sql_supplier);
			
				 $luzon_wl +=$row_salemtd['weight'];
			
			//@$myData_salemtd +=  $row_salemtd['weight'];
			//@$myTotal_salemtd[$row_supplier['group_island']] += round($row_salemtd['weight']);
			//$totals += $row_salemtd['weight'];
		}*/
		
	$sql_actualprice = mysql_query("SELECT * from paper_buying WHERE date_received like '$start_date/%' and date_received <= '$start_date3' and branch='".$_POST['branch']."'") or die(mysql_error());
			
		while($row_actualprice = mysql_fetch_array($sql_actualprice)){
			$sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$row_actualprice['supplier_id']."'") or die (mysql_error());
			$row_supplier = mysql_fetch_array($sql_supplier);
			$wp_grade = strtoupper($row_actualprice['wp_grade']);
			$gp_island = strtoupper($row_supplier['group_island']);
			@$myData_actualprice[$wp_grade][$gp_island] += $row_actualprice['paper_buying'];	
			@$myData_actualweight[$wp_grade][$gp_island] += $row_actualprice['corrected_weight'];
			//@$myTotalprice += $myData_actualprice['wp_grade']['group_island'] / $myData_actualweight['wp_grade']['group_island'];
		}
 	//luzon		

	 $target_wl = round(@$myData_encode['LCWL']['LUZON']);
	 $target_onp = round(@$myData_encode['ONP']['LUZON']);
	 $target_cbs = round(@$myData_encode['CBS']['LUZON']);
	 $target_occ = round(@$myData_encode['OCC']['LUZON']);
	 $target_mw = round(@$myData_encode['MW']['LUZON']);
	 $target_chip = round(@$myData_encode['CHIPBOARD']['LUZON']);
	 
	$salemtd_wl = round(@$myData_salemtd['LCWL']['LUZON']/1000);
	$salemtd_onp = round(@$myData_salemtd['ONP']['LUZON']/1000);
	$salemtd_cbs = round(@$myData_salemtd['CBS']['LUZON']/1000);
	$salemtd_occ = round(@$myData_salemtd['OCC']['LUZON']/1000);
	$salemtd_mw = round(@$myData_salemtd['MW']['LUZON']/1000);
	$salemtd_chip = round(@$myData_salemtd['CHIPBOARD']['LUZON']/1000);
	 
	$total_salemtd = round((@$salemtd_wl + $salemtd_onp + $salemtd_cbs + $salemtd_occ + $salemtd_mw + $salemtd_chip));
	$total_target =round(@$myTotal['LUZON']);
	$percent = round(($total_salemtd/$total_target) * 100,1);
	
	
	//vizmin	
	$targetvm_wl = round(@$myData_encode['LCWL']['VISAYAS'] + @$myData_encode['LCWL']['MINDANAO']);
	$targetvm_onp = round(@$myData_encode['ONP']['VISAYAS'] + @$myData_encode['ONP']['MINDANAO']);
	$targetvm_cbs = round(@$myData_encode['CBS']['VISAYAS'] + @$myData_encode['CBS']['MINDANAO']);
	$targetvm_occ = round(@$myData_encode['OCC']['VISAYAS'] + @$myData_encode['OCC']['MINDANAO']);
	$targetvm_mw = round(@$myData_encode['MW']['VISAYAS'] + @$myData_encode['MW']['MINDANAO']);
	$targetvm_chip = round(@$myData_encode['CHIPBOARD']['VISAYAS'] + @$myData_encode['CHIPBOARD']['MINDANAO']);
	
	$salemtdvm_wl = round((@$myData_salemtd['LCWL']['VISAYAS'] + @$myData_salemtd['LCWL']['MINDANAO'])/1000);
	$salemtdvm_onp = round((@$myData_salemtd['ONP']['VISAYAS'] + @$myData_salemtd['ONP']['MINDANAO'])/1000);
	$salemtdvm_cbs = round((@$myData_salemtd['CBS']['VISAYAS'] + @$myData_salemtd['CBS']['MINDANAO'])/1000);
	$salemtdvm_occ = round((@$myData_salemtd['OCC']['VISAYAS'] + @$myData_salemtd['OCC']['MINDANAO'])/1000);
	$salemtdvm_mw = round((@$myData_salemtd['MW']['VISAYAS'] + @$myData_salemtd['MW']['MINDANAO'])/1000);
	$salemtdvm_chip = round((@$myData_salemtd['CHIPBOARD']['VISAYAS'] + @$myData_salemtd['CHIPBOARD']['MINDANAO'])/1000);
						
	$totalvm_salemtd = round($salemtdvm_wl + $salemtdvm_onp + $salemtdvm_cbs + $salemtdvm_occ + $salemtdvm_mw + $salemtdvm_chip);
	$totalvm_target =round($targetvm_wl + $targetvm_onp + $targetvm_cbs + $targetvm_occ + $targetvm_mw + $targetvm_chip);
	$percentvm = round(($totalvm_salemtd/$totalvm_target) * 100,1);


 //================================================== END Monthly Target========================================================================	
 ?>
 <!-- -------------- ------------------------------ MTD LUZON --------------------------------------------------------------------------->
 	 <div class="grid_10">
		 <div class="box round first">
		  <h2><?php echo $_POST['branch'].'  as of  '.$header_date;?></h2>
			<div class="header"><center>Monthly (Luzon) - MTD</center></div>
				<center>
				<table>
					<tr>
						<td class="th" align="center">EFI</td>
						<td class="th" align="center">LCWL</td>
						<td class="th" align="center">ONP</td>
						<td class="th" align="center">CBS</td>
						<td class="th" align="center">OCC</td>
						<td class="th" align="center">MW</td>
						<td class="th" align="center">CHIPBOARD</td>
						<td class="th" align="center">Total</td>
						<td class="percent" rowspan="5" align="center"><?php echo $percent.'%';?></td>
					</tr>
					<tr>
						<td class="targetonsale">Target on Sale</td>
						<td class="bg1" align="center"><?php echo $target_wl;?></td>
						<td class="bg2" align="center"><?php echo $target_onp;?></td>
						<td class="bg1" align="center"><?php echo $target_cbs ;?></td>
						<td class="bg2" align="center"><?php echo $target_occ;?></td>
						<td class="bg1" align="center"><?php echo $target_mw ;?></td>
						<td class="bg2" align="center"><?php echo $target_chip;?></td>
						<td class="total"  align="center"><?php echo $total_target;?></td>
					</tr>
					<tr>
						<td class="salesmtd">Sales MTD</td>
						<td class="bg1" align="center"><?php echo $salemtd_wl;?></td>
						<td class="bg2" align="center"><?php echo $salemtd_onp;?></td>
						<td class="bg1" align="center"><?php echo $salemtd_cbs;?></td>
						<td class="bg2" align="center"><?php echo $salemtd_occ;?></td>
						<td class="bg1" align="center"><?php echo $salemtd_mw ;?></td>
						<td class="bg2" align="center"><?php echo $salemtd_chip;?></td>
						<td class="total" align="center"><?php echo $total_salemtd;?></td>
					</tr>
					<tr>
						<td class="mtdactualprice">MTD Actual Price</td>
						<td class="bg1" align="center"><?php echo $total_wl = round(@$myData_actualprice['LCWL']['LUZON'] / @$myData_actualweight['LCWL']['LUZON'],2);?></td>
						<td class="bg2" align="center"><?php echo $total_onp = round(@$myData_actualprice['ONP']['LUZON'] / @$myData_actualweight['ONP']['LUZON'],2);?></td>
						<td class="bg1" align="center"><?php echo $total_cbs = round(@$myData_actualprice['CBS']['LUZON'] / @$myData_actualweight['CBS']['LUZON'],2);?></td>
						<td class="bg2" align="center"><?php echo $total_occ = round(@$myData_actualprice['OCC']['LUZON'] / @$myData_actualweight['OCC']['LUZON'],2);?></td>
						<td class="bg1" align="center"><?php echo $total_mw = round(@$myData_actualprice['MW']['LUZON'] / @$myData_actualweight['MW']['LUZON'],2);?></td>
						<td class="bg2" align="center"><?php echo $total_chip = round(@$myData_actualprice['CHIPBOARD']['LUZON'] / @$myData_actualweight['CHIPBOARD']['LUZON'],2);?></td>
						<td class="total" align="center"></td>
					</tr>
					<tr>	
						<td class="currentstanding">Current Standing</td>
						<td class="currentstanding_bg" align="center"><?php if($target_wl != 0){echo round(($salemtd_wl/$target_wl) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_onp != 0){echo round(($salemtd_onp/$target_onp) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_cbs != 0){echo round(($salemtd_cbs/$target_cbs) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_occ != 0){echo round(($salemtd_occ/$target_occ) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_mw != 0){echo round(($salemtd_mw/$target_mw) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_chip != 0){echo round(($salemtd_chip/$target_chip) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"></td>
					</tr>	
				</table>
				</center>
		</div>
 	</div>
	
	
 <!-- -------------- ------------------------------ MTD VIZMIN --------------------------------------------------------------------------->	
 
 
	<div class="grid_10">
		 <div class="box round first">
		 	 <h2><?php echo $_POST['branch'].'  as of  '.$header_date;?></h2>
			<div class="header"><center>Monthly (Visayas & Mindanao) - MTD</center></div>
				<center>
				<table>
					<tr>
						<td class="th" align="center">EFI</td>
						<td class="th" align="center">LCWL</td>
						<td class="th" align="center">ONP</td>
						<td class="th" align="center">CBS</td>
						<td class="th" align="center">OCC</td>
						<td class="th" align="center">MW</td>
						<td class="th" align="center">CHIPBOARD</td>
						<td class="th" align="center">Total</td>
						<td class="percent" rowspan="5" align="center"><?php echo $percentvm.'%';?></td>
					</tr>
					<tr>
						<td class="targetonsale">Target on Sale</td>
						<td class="bg1" align="center"><?php echo $targetvm_wl;?></td>
						<td class="bg2" align="center"><?php echo $targetvm_onp;?></td>
						<td class="bg1" align="center"><?php echo $targetvm_cbs;?></td>
						<td class="bg2" align="center"><?php echo $targetvm_occ;?></td>
						<td class="bg1" align="center"><?php echo $targetvm_mw;?></td>
						<td class="bg2" align="center"><?php echo $targetvm_chip;?></td>
						<td class="total"  align="center"><?php echo $totalvm_target;?></td>
					</tr>
					<tr>
						<td class="salesmtd">Sales MTD</td>
						<td class="bg1" align="center"><?php echo $salemtdvm_wl;?></td>
						<td class="bg2" align="center"><?php echo $salemtdvm_onp;?></td>
						<td class="bg1" align="center"><?php echo $salemtdvm_cbs;?></td>
						<td class="bg2" align="center"><?php echo $salemtdvm_occ;?></td>
						<td class="bg1" align="center"><?php echo $salemtdvm_mw;?></td>
						<td class="bg2" align="center"><?php echo $salemtdvm_chip;?></td>
						<td class="total" align="center"><?php echo $totalvm_salemtd;?></td>
					</tr>
					<tr>
						<td class="mtdactualprice">MTD Actual Price</td>
						<td class="bg1" align="center"><?php echo $totalvm_wl = round((@$myData_actualprice['LCWL']['VISAYAS'] + @$myData_actualprice['LCWL']['MINDANAO']) / (@$myData_actualweight['LCWL']['VISAYAS'] + @$myData_actualweight['LCWL']['MINDANAO']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalvm_onp = round((@$myData_actualprice['ONP']['VISAYAS'] + @$myData_actualprice['ONP']['MINDANAO']) / (@$myData_actualweight['ONP']['VISAYAS'] + @$myData_actualweight['ONP']['MINDANAO']),2);?></td>
						<td class="bg1" align="center"><?php echo $totalvm_cbs = round((@$myData_actualprice['CBS']['VISAYAS'] + @$myData_actualprice['CBS']['MINDANAO']) / (@$myData_actualweight['CBS']['VISAYAS'] + @$myData_actualweight['CBS']['MINDANAO']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalvm_occ = round((@$myData_actualprice['OCC']['VISAYAS'] + @$myData_actualprice['OCC']['MINDANAO']) / (@$myData_actualweight['OCC']['VISAYAS'] + @$myData_actualweight['OCC']['MINDANAO']),2);?></td>
						<td class="bg1" align="center"><?php echo $totalvm_mw = round((@$myData_actualprice['MW']['VISAYAS'] + @$myData_actualprice['MW']['MINDANAO']) / (@$myData_actualweight['MW']['VISAYAS'] + @$myData_actualweight['MW']['MINDANAO']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalvm_chip = round((@$myData_actualprice['CHIPBOARD']['VISAYAS'] + @$myData_actualprice['CHIPBOARD']['MINDANAO']) / (@$myData_actualweight['CHIPBOARD']['VISAYAS'] + @$myData_actualweight['CHIPBOARD']['MINDANAO']),2);?></td>
						<td class="total" align="center"></td>
					</tr>
					<tr>	
						<td class="currentstanding">Current Standing</td>
						<td class="currentstanding_bg" align="center"><?php if($target_wl != 0){echo round(($salemtdvm_wl/$targetvm_wl) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_onp != 0){echo round(($salemtdvm_onp/$targetvm_onp) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_cbs != 0){echo round(($salemtdvm_cbs/$targetvm_cbs) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_occ != 0){echo round(($salemtdvm_occ/$targetvm_occ) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_mw != 0){echo round(($salemtdvm_mw/$targetvm_mw) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($target_chip != 0){echo round(($salemtdvm_chip/$targetvm_chip) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"></td>
					</tr>	
				</table>
				</center>
		</div>
 	</div>
	
	
<?php
	//-------------------------------------------------- WEEKLY (LUZON) WTD -------------------------------------------------------------------------------------------------------
	$mayDate = date('Y/m/d');
	$end_week = date('Y/m/d',strtotime($_POST['end_week']));
	if($end_week >= $mayDate){
		$end_week = date('Y/m/d', strtotime("-1 day", strtotime($mayDate)));	
	}else{
		$end_week = date('Y/m/d',strtotime($_POST['end_week']));
	}
 	$start_week = date('Y/m/d',strtotime($_POST['start_week']));
	$start_week1 = date('F d, Y',strtotime($_POST['start_week']));
	$end_week1 = date('F d, Y',strtotime($_POST['end_week']));
	
	
	$sql_price = mysql_query("SELECT * from island_price_target WHERE start_week = '$start_week' and branch='".$_POST['branch']."'") or die (mysql_error());
		while($row_price = mysql_fetch_array($sql_price)){
			$wp_grade = strtoupper($row_price['wp_grade']);
			$gp_island = strtoupper($row_price['group_island']);
			$myData_price[$wp_grade][$gp_island] = $row_price['target_price'];
		
		}
	
	
	
	$sql_salewtd = mysql_query("SELECT * from sup_deliveries WHERE date_delivered >= '$start_week' and date_delivered <= '$end_week' and branch_delivered='".$_POST['branch']."'") or die(mysql_error());
	
		while($row_salewtd = mysql_fetch_array($sql_salewtd)){
			$sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$row_salewtd['supplier_id']."'") or die (mysql_error());
			$row_supplier = mysql_fetch_array($sql_supplier);
			$wp_grade = strtoupper($row_salewtd['wp_grade']);
			$gp_island = strtoupper($row_supplier['group_island']);
			@$myData_salewtd[$wp_grade][$gp_island] +=  round($row_salewtd['weight']);
			@$myTotal_salewtd[$gp_island] += round($row_salewtd['weight']);
		}
		
	$sqlwtd_actualprice = mysql_query("SELECT * from paper_buying WHERE date_received >= '$start_week' and date_received <= '$end_week' and branch='".$_POST['branch']."'") or die(mysql_error());
			
		while($rowwtd_actualprice = mysql_fetch_array($sqlwtd_actualprice)){
			$sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$rowwtd_actualprice['supplier_id']."'") or die (mysql_error());
			$row_supplier = mysql_fetch_array($sql_supplier);
			$wp_grade = strtoupper($rowwtd_actualprice['wp_grade']);
			$gp_island = strtoupper($row_supplier['group_island']);
			@$myDatawtd_actualprice[$wp_grade][$gp_island] += $rowwtd_actualprice['paper_buying'];	
			@$myDatawtd_actualweight[$wp_grade][$gp_island] += $rowwtd_actualprice['corrected_weight'];
			//@$myTotalprice += $myData_actualprice['wp_grade']['group_island'] / $myData_actualweight['wp_grade']['group_island'];
			
		}
 	//luzon	
	$sql_targets = mysql_query("SELECT * from island_price_target WHERE start_week='$start_week' and branch='".$_POST['branch']."' ") or die(mysql_error());
		while($row_targets = mysql_fetch_array($sql_targets)){
			$wp_grade = strtoupper($row_targets['wp_grade']);
			$gp_island = strtoupper($row_targets['group_island']);
			@$myData_targets[$wp_grade][$gp_island]=round($row_targets['target_tonnage']);
		}
		
	//echo $myDatawtd_actualprice['OCC']['VISAYAS'].'---------------';
	
	$targetwtd_wl = round(@$myData_targets['LCWL']['LUZON']);
	$targetwtd_onp = round(@$myData_targets['ONP']['LUZON']);
	$targetwtd_cbs = round(@$myData_targets['CBS']['LUZON']);
	$targetwtd_occ = round(@$myData_targets['OCC']['LUZON']);
	$targetwtd_mw = round(@$myData_targets['MW']['LUZON']);
	$targetwtd_chip = round(@$myData_targets['CHIPBOARD']['LUZON']);
	
	if(empty($targetwtd_wl) || $targetwtd_wl == 0){
	$targetwtd_wl = round(@$myData_encode['LCWL']['LUZON'] /4);
	}
	if(empty($targetwtd_onp) || $targetwtd_onp == 0){
	$targetwtd_onp = round(@$myData_encode['ONP']['LUZON'] /4);
	}
	if(empty($targetwtd_cbs) || $targetwtd_cbs == 0){
	$targetwtd_cbs = round(@$myData_encode['CBS']['LUZON'] /4);
	}
	if(empty($targetwtd_occ) || $targetwtd_occ == 0){
	$targetwtd_occ = (@$myData_encode['OCC']['LUZON'] /4);
	}
	if(empty($targetwtd_mw) || $targetwtd_mw == 0){
	$targetwtd_mw = round(@$myData_encode['MW']['LUZON'] /4);
	}
	if(empty($targetwtd_chip) || $targetwtd_chip == 0){
	$targetwtd_chip = round(@$myData_encode['CHIPBOARD']['LUZON']/4);
	}
		
	$salewtd_wl = round(@$myData_salewtd['LCWL']['LUZON']/1000,1);
	$salewtd_onp = round(@$myData_salewtd['ONP']['LUZON']/1000,1);
	$salewtd_cbs = round(@$myData_salewtd['CBS']['LUZON']/1000,1);
	$salewtd_occ = round(@$myData_salewtd['OCC']['LUZON']/1000,1);
	$salewtd_mw = round(@$myData_salewtd['MW']['LUZON']/1000,1);
	$salewtd_chip = round(@$myData_salewtd['CHIPBOARD']['LUZON']/1000,1);
	
	$total_salewtd = round($salewtd_wl + $salewtd_onp + $salewtd_cbs + $salewtd_occ + $salewtd_mw + $salewtd_chip);
	$totalwtd_target =round($targetwtd_wl + $targetwtd_onp + $targetwtd_cbs + $targetwtd_occ + $targetwtd_mw + $targetwtd_chip);
	$percentwtd = round(($total_salewtd/$totalwtd_target) * 100,1);
	
	//vizmin	
	
	$targetwtdvm_wl =round((@$myData_targets['LCWL']['VISAYAS'] + @$myData_targets['LCWL']['MINDANAO'])/2);
	$targetwtdvm_onp =round((@$myData_targets['ONP']['VISAYAS'] + @$myData_targets['ONP']['MINDANAO'])/2);
	$targetwtdvm_cbs =round((@$myData_targets['CBS']['VISAYAS'] + @$myData_targets['CBS']['MINDANAO'])/2);
	$targetwtdvm_occ =round((@$myData_targets['OCC']['VISAYAS'] + @$myData_targets['OCC']['MINDANAO'])/2);
	$targetwtdvm_mw =round((@$myData_targets['MW']['VISAYAS'] + @$myData_targets['MW']['MINDANAO']));
	$targetwtdvm_chip =round((@$myData_targets['CHIPBOARD']['VISAYAS'] + @$myData_targets['CHIPBOARD']['MINDANAO'])/2);
	
	if(empty($targetwtdvm_wl) || $targetwtdvm_wl == 0){
	$targetwtdvm_wl = round((@$myData_encode['LCWL']['VISAYAS'] + @$myData_encode['LCWL']['MINDANAO'])/4);
	}
	if(empty($targetwtdvm_onp) || $targetwtdvm_onp == 0){
	$targetwtdvm_onp = round((@$myData_encode['ONP']['VISAYAS'] + @$myData_encode['ONP']['MINDANAO']) /4);
	}
	if(empty($targetwtdvm_cbs) || $targetwtdvm_cbs == 0){
	$targetwtdvm_cbs = round((@$myData_encode['CBS']['VISAYAS'] + @$myData_encode['CBS']['MINDANAO']) /4);
	}
	if(empty($targetwtdvm_occ) || $targetwtdvm_occ == 0){
	$targetwtdvm_occ = round((@$myData_encode['OCC']['VISAYAS'] + @$myData_encode['OCC']['MINDANAO'])/4);
	}
	if(empty($targetwtdvm_mw) || $targetwtdvm_mw == 0){
	$targetwtdvm_mw = round((@$myData_encode['MW']['VISAYAS'] + @$myData_encode['MW']['MINDANAO']) /4);
	}
	if(empty($targetwtdvm_chip) || $targetwtdvm_chip == 0){
	$targetwtdvm_chip = round((@$myData_encode['CHIPBOARD']['VISAYAS'] + @$myData_encode['CHIPBOARD']['MINDANAO'])/4);
	}
	
	$salewtdvm_wl = round(($myData_salewtd['LCWL']['VISAYAS'] + $myData_salewtd['LCWL']['MINDANAO'])/1000,1);
	$salewtdvm_onp = round(($myData_salewtd['ONP']['VISAYAS'] + $myData_salewtd['ONP']['MINDANAO'])/1000,1);
	$salewtdvm_cbs = round(($myData_salewtd['CBS']['VISAYAS'] + $myData_salewtd['CBS']['MINDANAO'])/1000,1);
	$salewtdvm_occ = round(($myData_salewtd['OCC']['VISAYAS'] + $myData_salewtd['OCC']['MINDANAO'])/1000,1);
	$salewtdvm_mw = round(($myData_salewtd['MW']['VISAYAS'] + $myData_salewtd['MW']['MINDANAO'])/1000,1);
	$salewtdvm_chip = round(($myData_salewtd['CHIPBOARD']['VISAYAS'] + $myData_salewtd['CHIPBOARD']['MINDANAO'])/1000,1);
	
	
	$total_salewtdvm = round($salewtdvm_wl + $salewtdvm_onp + $salewtdvm_cbs + $salewtdvm_occ + $salewtdvm_mw + $salewtdvm_chip);
	$totalwtdvm_target =round($targetwtdvm_wl + $targetwtdvm_onp + $targetwtdvm_cbs + $targetwtdvm_occ + $targetwtdvm_mw + $targetwtdvm_chip);
	$percentwtdvm = round(($total_salewtdvm/$totalwtdvm_target) * 100,1);	
	
	// $myDatawtd_actualprice['ONP']['VISAYAS'].'-'.$myDatawtd_actualprice['ONP']['MINDANAO'].'<br>'; 
	// $myDatawtd_actualweight['ONP']['VISAYAS'].'-'.$myDatawtd_actualweight['ONP']['MINDANAO'];
	//-------------------------------------------------- END WEEKLY  WTD --------------------------------------------------------------------------------------------------
$myweek = date('F d, Y', strtotime($end_week));
//echo $myDatawtd_actualprice['ONP']['VISAYAS'] + @$myDatawtd_actualprice['ONP']['MINDANAO'].'-';
//echo $myDatawtd_actualweight['ONP']['VISAYAS'] + @$myDatawtd_actualweight['ONP']['MINDANAO'].'<br>';
//echo $myData_salewtd['ONP']['MINDANAO'].'---';
?>	
	
	
	 <!-- -------------- ------------------------------ WEEKLY LUZON --------------------------------------------------------------------------->	
 
 
	<div class="grid_10">
		 <div class="box round first">
		 	 <h2><?php echo $_POST['branch'].'  as of  '.$start_week1.' &nbsp;&nbsp;to&nbsp;&nbsp; '.$myweek;?></h2>
			<div class="header"><center>Weekly (Luzon) - WTD</center></div>
				<center>
				<table>
					<tr>
						<td class="th" align="center">EFI</td>
						<td class="th" align="center">LCWL</td>
						<td class="th" align="center">ONP</td>
						<td class="th" align="center">CBS</td>
						<td class="th" align="center">OCC</td>
						<td class="th" align="center">MW</td>
						<td class="th" align="center">CHIPBOARD</td>
						<td class="th" align="center">Total</td>
						<td class="percent" rowspan="6" align="center"><?php echo $percentwtd.'%';?></td>
					</tr>
					<tr>
						<td class="targetonsale">WTD Target</td>
						<td class="bg1" align="center"><?php echo $targetwtd_wl;?></td>
						<td class="bg2" align="center"><?php echo $targetwtd_onp;?></td>
						<td class="bg1" align="center"><?php echo $targetwtd_cbs;?></td>
						<td class="bg2" align="center"><?php echo $targetwtd_occ;?></td>
						<td class="bg1" align="center"><?php echo $targetwtd_mw;?></td>
						<td class="bg2" align="center"><?php echo $targetwtd_chip;?></td>
						<td class="total"  align="center"><?php echo $totalwtd_target;?></td>
					</tr>
					<tr>
						<td class="targetprice">WTD Target Price</td>
						<td class="bg1" align="center"><?php echo number_format($myData_price['LCWL']['LUZON'],2,'.','');?></td>
						<td class="bg2" align="center"><?php echo number_format($myData_price['ONP']['LUZON'],2,'.','');?></td>
						<td class="bg1" align="center"><?php echo number_format($myData_price['CBS']['LUZON'],2,'.','');?></td>
						<td class="bg2" align="center"><?php echo number_format($myData_price['OCC']['LUZON'],2,'.','');?></td>
						<td class="bg1" align="center"><?php echo number_format($myData_price['MW']['LUZON'],2,'.','');?></td>
						<td class="bg2" align="center"><?php echo number_format($myData_price['CHIPBOARD']['LUZON'],2,'.','');?></td>
						<td class="total"  align="center"></td>
					</tr>
					<tr>
						<td class="salesmtd">WTD Actual</td>
						<td class="bg1" align="center"><?php echo $salewtd_wl;?></td>
						<td class="bg2" align="center"><?php echo $salewtd_onp;?></td>
						<td class="bg1" align="center"><?php echo $salewtd_cbs;?></td>
						<td class="bg2" align="center"><?php echo $salewtd_occ;?></td>
						<td class="bg1" align="center"><?php echo $salewtd_mw;?></td>
						<td class="bg2" align="center"><?php echo $salewtd_chip;?></td>
						<td class="total" align="center"><?php echo $total_salewtd;?></td>
					</tr>
					<tr>
						<td class="mtdactualprice">WTD Actual Price</td>
						<td class="bg1" align="center"><?php echo $totalwtd_wl = round((@$myDatawtd_actualprice['LCWL']['LUZON']) / (@$myDatawtd_actualweight['LCWL']['LUZON']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalwtd_onp = round((@$myDatawtd_actualprice['ONP']['LUZON']) / (@$myDatawtd_actualweight['ONP']['LUZON']),2);?></td>
						<td class="bg1" align="center"><?php echo $totalwtd_cbs = round((@$myDatawtd_actualprice['CBS']['LUZON']) / (@$myDatawtd_actualweight['CBS']['LUZON']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalwtd_occ = round((@$myDatawtd_actualprice['OCC']['LUZON']) / (@$myDatawtd_actualweight['OCC']['LUZON']),2);?></td>
						<td class="bg1" align="center"><?php echo $totalwtd_mw = round((@$myDatawtd_actualprice['MW']['LUZON']) / (@$myDatawtd_actualweight['MW']['LUZON']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalwtd_chip = round((@$myDatawtd_actualprice['CHIPBOARD']['LUZON']) / (@$myDatawtd_actualweight['CHIPBOARD']['LUZON']),2);?></td>
						<td class="total" align="center"></td>
					</tr>
					<tr>	
						<td class="currentstanding">Current Standing</td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtd_wl != 0){echo round(($salewtd_wl/$targetwtd_wl) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtd_onp != 0){echo round(($salewtd_onp/$targetwtd_onp) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtd_cbs != 0){echo round(($salewtd_cbs/$targetwtd_cbs) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtd_occ != 0){echo round(($salewtd_occ/$targetwtd_occ) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtd_mw != 0){echo round(($salewtd_mw/$targetwtd_mw) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtd_chip != 0){echo round(($salewtd_chip/$targetwtd_chip) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"></td>
					</tr>	
				</table>
				</center>
		</div>
 	</div>
	
	
	
	 <!-- -------------- ------------------------------ WEEKLY VIZMIN --------------------------------------------------------------------------->	
 
 
	<div class="grid_10">
		 <div class="box round first">
		 	<h2><?php echo $_POST['branch'].'  as of  '.$start_week1.' &nbsp;&nbsp;to&nbsp;&nbsp; '.$myweek;?></h2>
			<div class="header"><center>Weekly (Visayas & Mindanao) - WTD</center></div>
				<center>
				<table>
					<tr>
						<td class="th" align="center">EFI</td>
						<td class="th" align="center">LCWL</td>
						<td class="th" align="center">ONP</td>
						<td class="th" align="center">CBS</td>
						<td class="th" align="center">OCC</td>
						<td class="th" align="center">MW</td>
						<td class="th" align="center">CHIPBOARD</td>
						<td class="th" align="center">Total</td>
						<td class="percent" rowspan="6" align="center"><?php echo $percentwtdvm.'%';?></td>
					</tr>
					<tr>
						<td class="targetonsale">WTD Target</td>
						<td class="bg1" align="center"><?php echo $targetwtdvm_wl;?></td>
						<td class="bg2" align="center"><?php echo $targetwtdvm_onp;?></td>
						<td class="bg1" align="center"><?php echo $targetwtdvm_cbs;?></td>
						<td class="bg2" align="center"><?php echo $targetwtdvm_occ;?></td>
						<td class="bg1" align="center"><?php echo $targetwtdvm_mw;?></td>
						<td class="bg2" align="center"><?php echo $targetwtdvm_chip;?></td>
						<td class="total"  align="center"><?php echo $totalwtdvm_target;?></td>
					</tr>
					<tr>
						<td class="targetprice">WTD Target Price</td>
						<td class="bg1" align="center"><?php echo number_format((($myData_price['LCWL']['VISAYAS'] + $myData_price['LCWL']['MINDANAO'])/2),2,'.','');?></td>
						<td class="bg2" align="center"><?php echo number_format((($myData_price['ONP']['VISAYAS'] + $myData_price['ONP']['MINDANAO'])/2),2,'.','');?></td>
						<td class="bg1" align="center"><?php echo number_format((($myData_price['CBS']['VISAYAS'] + $myData_price['CBS']['MINDANAO'])/2),2,'.','');?></td>
						<td class="bg2" align="center"><?php echo number_format((($myData_price['OCC']['VISAYAS'] + $myData_price['OCC']['MINDANAO'])/2),2,'.','');?></td>
						<td class="bg1" align="center"><?php echo number_format((($myData_price['MW']['VISAYAS'] + $myData_price['MW']['MINDANAO'])/2),2,'.','');?></td>
						<td class="bg2" align="center"><?php echo number_format((($myData_price['CHIPBOARD']['VISAYAS'] + $myData_price['CHIPBOARD']['MINDANAO'])/2),2,'.','');?></td>
						<td class="total"  align="center"></td>
					</tr>
					<tr>
						<td class="salesmtd">WTD Actual</td>
						<td class="bg1" align="center"><?php echo $salewtdvm_wl;?></td>
						<td class="bg2" align="center"><?php echo $salewtdvm_onp;?></td>
						<td class="bg1" align="center"><?php echo $salewtdvm_cbs;?></td>
						<td class="bg2" align="center"><?php echo $salewtdvm_occ;?></td>
						<td class="bg1" align="center"><?php echo $salewtdvm_mw;?></td>
						<td class="bg2" align="center"><?php echo $salewtdvm_chip;?></td>
						<td class="total" align="center"><?php echo $total_salewtdvm;?></td>
					</tr>
					<tr>
						<td class="mtdactualprice">WTD Actual Price</td>
						<td class="bg1" align="center"><?php echo $totalwtdvm_wl = round((@$myDatawtd_actualprice['LCWL']['VISAYAS'] + @$myDatawtd_actualprice['LCWL']['MINDANAO']) / (@$myDatawtd_actualweight['LCWL']['VISAYAS'] +@$myDatawtd_actualweight['LCWL']['MINDANAO']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalwtdvm_onp = round((@$myDatawtd_actualprice['ONP']['VISAYAS'] + @$myDatawtd_actualprice['ONP']['MINDANAO']) / (@$myDatawtd_actualweight['ONP']['VISAYAS'] + @$myDatawtd_actualweight['ONP']['MINDANAO']),2);?></td>
						<td class="bg1" align="center"><?php echo $totalwtdvm_cbs = round((@$myDatawtd_actualprice['CBS']['VISAYAS'] + @$myDatawtd_actualprice['CBS']['MINDANAO']) / (@$myDatawtd_actualweight['CBS']['VISAYAS'] + @$myDatawtd_actualweight['CBS']['MINDANAO']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalwtdvm_occ = round((@$myDatawtd_actualprice['OCC']['VISAYAS'] + @$myDatawtd_actualprice['OCC']['MINDANAO']) / (@$myDatawtd_actualweight['OCC']['VISAYAS'] + @$myDatawtd_actualweight['OCC']['MINDANAO']),2);?></td>
						<td class="bg1" align="center"><?php echo $totalwtdvm_mw = round((@$myDatawtd_actualprice['MW']['VISAYAS'] + @$myDatawtd_actualprice['MW']['MINDANAO']) / (@$myDatawtd_actualweight['MW']['VISAYAS'] + @$myDatawtd_actualweight['MW']['MINDANAO']),2);?></td>
						<td class="bg2" align="center"><?php echo $totalwtdvm_chip = round((@$myDatawtd_actualprice['CHIPBOARD']['VISAYAS'] + @$myDatawtd_actualprice['CHIPBOARD']['MINDANAO']) / (@$myDatawtd_actualweight['CHIPBOARD']['VISAYAS'] + @$myDatawtd_actualweight['CHIPBOARD']['MINDANAO']),2);?></td>
						<td class="total" align="center"></td>
					</tr>
					<tr>	
						<td class="currentstanding">Current Standing</td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtdvm_wl != 0){echo round(($salewtdvm_wl/$targetwtdvm_wl) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtdvm_onp != 0){echo round(($salewtdvm_onp/$targetwtdvm_onp) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtdvm_cbs != 0){echo round(($salewtdvm_cbs/$targetwtdvm_cbs) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtdvm_occ != 0){echo round(($salewtdvm_occ/$targetwtdvm_occ) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtdvm_mw != 0){echo round(($salewtdvm_mw/$targetwtdvm_mw) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetwtdvm_chip != 0){echo round(($salewtdvm_chip/$targetwtdvm_chip) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"></td>
					</tr>	
				</table>
				</center>
		</div>
 	</div>
	
	
	
	<?php
		 $myDate = date('Y/m/d');
		if($start_date2 > $myDate){
			$date_filter = $myDate;
		}else{
			$date_filter = $start_date2;
		}
	
		$targetdtd_wl =round(($targetwtd_wl + $targetwtdvm_wl)/7);
		$targetdtd_onp =round(($targetwtd_onp + $targetwtdvm_onp)/7);
		$targetdtd_cbs =round(($targetwtd_cbs + $targetwtdvm_cbs)/7);
		$targetdtd_occ =round(($targetwtd_occ + $targetwtdvm_occ)/7);
		$targetdtd_mw =round(($targetwtd_mw + $targetwtdvm_mw)/7);
		$targetdtd_chip =round(($targetwtd_chip + $targetwtdvm_chip)/7);
		
		$sql_saledtd = mysql_query("SELECT * from sup_deliveries WHERE date_delivered = '$date_filter' and branch_delivered='".$_POST['branch']."'") or die(mysql_error());
	
		while($row_saledtd = mysql_fetch_array($sql_saledtd)){
			$wp_grade = strtoupper($row_saledtd['wp_grade']);
			@$myData_saledtd[$wp_grade] +=  round($row_saledtd['weight']);
	//		@$myTotal_saledtd[$row_supplier['group_island']] += round($row_saledtd['weight']);
		}
		
	$sqldtd_actualprice = mysql_query("SELECT * from paper_buying WHERE date_received = '$date_filter' and branch='".$_POST['branch']."'") or die(mysql_error());
			
		while($rowdtd_actualprice = mysql_fetch_array($sqldtd_actualprice)){
			$wp_grade = strtoupper($rowdtd_actualprice['wp_grade']);
			@$myDatadtd_actualprice[$wp_grade] += $rowdtd_actualprice['paper_buying'];	
			@$myDatadtd_actualweight[$wp_grade] += $rowdtd_actualprice['corrected_weight'];
			//@$myTotalprice += $myData_actualprice['wp_grade']['group_island'] / $myData_actualweight['wp_grade']['group_island'];
		}
		
		
		
			$saledtd_wl = round($myData_saledtd['LCWL'] / 1000);
			$saledtd_onp = round($myData_saledtd['ONP'] / 1000);
			$saledtd_cbs = round($myData_saledtd['CBS'] / 1000);
			$saledtd_occ = round($myData_saledtd['OCC'] / 1000);
			$saledtd_mw = round($myData_saledtd['MW'] / 1000);
			$saledtd_chip = round($myData_saledtd['CHIPBOARD'] / 1000);
			
			$total_saledtd = round($saledtd_wl + $saledtd_onp + $saledtd_cbs + $saledtd_occ + $saledtd_mw + $saledtd_chip);
			$totaldtd_target = round($targetdtd_wl + $targetdtd_onp + $targetdtd_cbs + $targetdtd_occ + $targetdtd_mw + $targetdtd_chip);
			$percentdtd = round(($total_saledtd/$totaldtd_target) * 100,1);	
		
		
	?>
	
	
	
	 <!-- -------------- ------------------------------ Daily Breakdown --------------------------------------------------------------------------->	
 
 
	<div class="grid_10">
		 <div class="box round first">
		 	<h2><?php echo $_POST['branch'].' as of '.date('F d, Y', strtotime($date_filter));?></h2>
			<div class="header"><center>Daily Breakdown - DTD</center></div>
				<center>
				<table>
					<tr>
						<td class="th" align="center"></td>
						<td class="th" align="center">LCWL</td>
						<td class="th" align="center">ONP</td>
						<td class="th" align="center">CBS</td>
						<td class="th" align="center">OCC</td>
						<td class="th" align="center">MW</td>
						<td class="th" align="center">CHIPBOARD</td>
						<td class="th" align="center">Total</td>
						<td class="percent" rowspan="5" align="center"><?php echo $percentdtd.'%';?></td>
					</tr>
					<tr>
						<td class="targetonsale">Target</td>
						<td class="bg1" align="center"><?php echo $targetdtd_wl;?></td>
						<td class="bg2" align="center"><?php echo $targetdtd_onp;?></td>
						<td class="bg1" align="center"><?php echo $targetdtd_cbs;?></td>
						<td class="bg2" align="center"><?php echo $targetdtd_occ;?></td>
						<td class="bg1" align="center"><?php echo $targetdtd_mw;?></td>
						<td class="bg2" align="center"><?php echo $targetdtd_chip;?></td>
						<td class="total"  align="center"><?php echo $totaldtd_target;?></td>
					</tr>
					<tr>
						<td class="salesmtd">Tonnage</td>
						<td class="bg1" align="center"><?php echo $saledtd_wl;?></td>
						<td class="bg2" align="center"><?php echo $saledtd_onp;?></td>
						<td class="bg1" align="center"><?php echo $saledtd_cbs;?></td>
						<td class="bg2" align="center"><?php echo $saledtd_occ;?></td>
						<td class="bg1" align="center"><?php echo $saledtd_mw;?></td>
						<td class="bg2" align="center"><?php echo $saledtd_chip;?></td>
						<td class="total" align="center"><?php echo $total_saledtd;?></td>
					</tr>
					<tr>
						<td class="mtdactualprice">Price</td>
						<td class="bg1" align="center"><?php echo $totaldtd_wl = round((@$myDatadtd_actualprice['LCWL']/@$myDatadtd_actualweight['LCWL']),2);?></td>
						<td class="bg2" align="center"><?php echo $totaldtd_onp = round((@$myDatadtd_actualprice['ONP']/@$myDatadtd_actualweight['ONP']),2);?></td>
						<td class="bg1" align="center"><?php echo $totaldtd_cbs = round((@$myDatadtd_actualprice['CBS']/@$myDatadtd_actualweight['CBS']),2);?></td>
						<td class="bg2" align="center"><?php echo $totaldtd_occ = round((@$myDatadtd_actualprice['OCC']/@$myDatadtd_actualweight['OCC']),2);?></td>
						<td class="bg1" align="center"><?php echo $totaldtd_mw = round((@$myDatadtd_actualprice['MW']/@$myDatadtd_actualweight['MW']),2);?></td>
						<td class="bg2" align="center"><?php echo $totaldtd_chip = round((@$myDatadtd_actualprice['CHIPBOARD']/@$myDatadtd_actualweight['CHIPBOARD']),2);?></td>
						<td class="total" align="center"></td>
					</tr>
					<tr>	
						<td class="currentstanding">Current Standing</td>
						<td class="currentstanding_bg" align="center"><?php if($targetdtd_wl != 0){echo round(($saledtd_wl/$targetdtd_wl) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetdtd_onp != 0){echo round(($saledtd_onp/$targetdtd_onp) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetdtd_cbs != 0){echo round(($saledtd_cbs/$targetdtd_cbs) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetdtd_occ != 0){echo round(($saledtd_occ/$targetdtd_occ) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetdtd_mw != 0){echo round(($saledtd_mw/$targetdtd_mw) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"><?php if($targetdtd_chip != 0){echo round(($saledtd_chip/$targetdtd_chip) * 100).'%';}else{ echo '0%';}?></td>
						<td class="currentstanding_bg" align="center"></td>
					</tr>	
				</table>
				</center>
		</div>
 	</div>
	
	
	<?php
	
		$pb_wl = (($targetwtd_wl + $targetwtdvm_wl) * $myData_price['LCWL']['LUZON']) * 1000;
		$pb_onp = (($targetwtd_onp + $targetwtdvm_onp) * $myData_price['ONP']['LUZON']) * 1000;
		$pb_cbs = (($targetwtd_cbs + $targetwtdvm_cbs) * $myData_price['CBS']['LUZON']) * 1000;
		$pb_occ = (($targetwtd_occ + $targetwtdvm_occ) * $myData_price['OCC']['LUZON']) * 1000;
		$pb_mw = (($targetwtd_mw + $targetwtdvm_mw) * $myData_price['MW']['LUZON']) * 1000;
		$pb_chip = (($targetwtd_chip + $targetwtdvm_chip) * $myData_price['CHIPBOARD']['LUZON']) * 1000;
		$total_paper =$pb_wl + $pb_onp + $pb_cbs + $pb_occ + $pb_mw + $pb_chip;
		
		
		$wtd_wl =(($salewtdvm_wl + $salewtd_wl) * $totalwtd_wl) * 1000;
		$wtd_onp =(($salewtdvm_onp + $salewtd_onp) * $totalwtd_onp) * 1000;
		$wtd_cbs =(($salewtdvm_cbs + $salewtd_cbs) * $totalwtd_cbs) * 1000;
		$wtd_occ =(($salewtdvm_occ + $salewtd_occ) * $totalwtd_occ) * 1000;
		$wtd_mw =(($salewtdvm_mw + $salewtd_mw) * $totalwtd_mw) * 1000;
		$wtd_chip =(($salewtdvm_chip + $salewtd_chip) * $totalwtd_chip) * 1000;
		$total_wtd =  $wtd_wl + $wtd_onp + $wtd_cbs + $wtd_occ + $wtd_mw + $wtd_chip;
		
		$myPercent = round(($total_wtd/$total_paper) * 100,1);
	
	?>
	
	 <!-- -------------- ------------------------------ Paper Buying Report--------------------------------------------------------------------------->	
 
 
	<div class="grid_10">
		 <div class="box round first">
			<div class="header"><center>Paper Buying Report</center></div>
				<center>
				<table>
					<tr>
						<td class="th" align="center">EFI</td>
						<td class="th" align="center">LCWL</td>
						<td class="th" align="center">ONP</td>
						<td class="th" align="center">CBS</td>
						<td class="th" align="center">OCC</td>
						<td class="th" align="center">MW</td>
						<td class="th" align="center">CHIPBOARD</td>
						<td class="th" align="center">Total</td>
						<td class="percent" rowspan="6" align="center"><?php echo $myPercent.'%';?></td>
					</tr>
					<tr>
						<td class="targetonsale">Weekly Target</td>
						<td class="bg1" align="center"><?php echo number_format($pb_wl);?></td>
						<td class="bg2" align="center"><?php echo number_format($pb_onp);?></td>
						<td class="bg1" align="center"><?php echo number_format($pb_cbs);?></td>
						<td class="bg2" align="center"><?php echo number_format($pb_occ);?></td>
						<td class="bg1" align="center"><?php echo number_format($pb_mw);?></td>
						<td class="bg2" align="center"><?php echo number_format($pb_chip);?></td>
						<td class="total"  align="center"><?php echo $total_paper = number_format($pb_wl + $pb_onp + $pb_cbs + $pb_occ + $pb_mw + $pb_chip);?></td>
					</tr>
					<tr>
						<td class="salesmtd">MTD Actual</td>
						<td class="bg1" align="center"><?php echo  number_format($mtdpaper_wl =(($salemtd_wl + $salemtdvm_wl) * $total_wl) * 1000);?></td>
						<td class="bg2" align="center"><?php echo  number_format($mtdpaper_onp =(($salemtd_onp + $salemtdvm_onp) * $total_onp) * 1000);?></td>
						<td class="bg1" align="center"><?php echo  number_format($mtdpaper_cbs =(($salemtd_cbs + $salemtdvm_cbs) * $total_cbs) * 1000);?></td>
						<td class="bg2" align="center"><?php echo  number_format($mtdpaper_occ =(($salemtd_occ + $salemtdvm_occ) * $total_occ) * 1000);?></td>
						<td class="bg1" align="center"><?php echo  number_format($mtdpaper_mw =(($salemtd_mw + $salemtdvm_mw) * $total_mw) * 1000);?></td>
						<td class="bg2" align="center"><?php echo  number_format($mtdpaper_chip =(($salemtd_chip + $salemtdvm_chip) * $total_chip) * 1000);?></td>
						<td class="total" align="center"><?php echo $mtdpaper_all = number_format($mtdpaper_wl +  $mtdpaper_onp +  $mtdpaper_cbs +  $mtdpaper_occ +  $mtdpaper_mw + $mtdpaper_chip);?></td>
					</tr>
					<tr>
						<td class="targetprice">WTD Actual</td>
						<td class="bg1" align="center"><?php echo  number_format($wtd_wl);?></td>
						<td class="bg2" align="center"><?php echo  number_format($wtd_onp);?></td>
						<td class="bg1" align="center"><?php echo  number_format($wtd_cbs);?></td>
						<td class="bg2" align="center"><?php echo  number_format($wtd_occ);?></td>
						<td class="bg1" align="center"><?php echo  number_format($wtd_mw);?></td>
						<td class="bg2" align="center"><?php echo  number_format($wtd_chip);?></td>
						<td class="total" align="center"><?php echo number_format($total_wtd =  ($wtd_wl + $wtd_onp + $wtd_cbs + $wtd_occ + $wtd_mw + $wtd_chip));?></td>
					</tr>
					<tr>
						<td class="day"><?php echo date('F, d', strtotime($date_filter)).' (Daily)';?></td>
						<td class="bg1" align="center"><?php echo  number_format($wtdd_wl =(($saledtd_wl) * $totaldtd_wl) * 1000);?></td>
						<td class="bg2" align="center"><?php echo  number_format($wtdd_onp =(($saledtd_onp) * $totaldtd_onp) * 1000);?></td>
						<td class="bg1" align="center"><?php echo  number_format($wtdd_cbs =(($saledtd_cbs) * $totaldtd_cbs) * 1000);?></td>
						<td class="bg2" align="center"><?php echo  number_format($wtdd_occ =(($saledtd_occ) * $totaldtd_occ) * 1000);?></td>
						<td class="bg1" align="center"><?php echo  number_format($wtdd_mw =(($saledtd_mw) * $totaldtd_mw) * 1000);?></td>
						<td class="bg2" align="center"><?php echo  number_format($wtdd_chip =(($saledtd_chip) * $totaldtd_chip) * 1000);?></td>
						<td class="total" align="center"><?php echo number_format($total_daily = ($wtdd_wl + $wtdd_onp + $wtdd_cbs + $wtdd_occ + $wtdd_mw + $wtdd_chip));?></td>
					</tr>
					<tr>	
						<td class="currentstanding">Current Weekly Standing</td>
						<td class="currentstanding_bg" align="center"><?php echo round(($wtd_wl/$pb_wl) * 100).'%';?></td>
						<td class="currentstanding_bg" align="center"><?php echo round(($wtd_onp/$pb_onp) * 100).'%';?></td>
						<td class="currentstanding_bg" align="center"><?php echo round(($wtd_cbs/$pb_cbs) * 100).'%';?></td>
						<td class="currentstanding_bg" align="center"><?php echo round(($wtd_occ/$pb_occ) * 100).'%';?></td>
						<td class="currentstanding_bg" align="center"><?php echo round(($wtd_mw/$pb_mw) * 100).'%';?></td>
						<td class="currentstanding_bg" align="center"><?php echo round(($wtd_chip/$pb_chip) * 100).'%';?></td>
						<td class="currentstanding_bg" align="center"></td>
					</tr>	
				</table>
				</center>
		</div>
 	</div>


<?php }?>
<div class="clear">

</div>

<div class="clear">

</div>

