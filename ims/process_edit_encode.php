<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m"

        });
    };
	
</script>
<script>
	
	function isNumber(evt) {
   	     evt = (evt) ? evt : window.event;
   			 var charCode = (evt.which) ? evt.which : evt.keyCode;
   			 if (charCode == 46 || (charCode > 47 && charCode < 58)) {
       			 return true;
  			  }
   			 return false;

	}
	
	function startdate(){
			var start_week = document.getElementById('start_week').value;
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
			
			document.getElementById('end_week').value=end_week_value;

		} 
</script>
<?php
session_start();
include('config.php');
$id = $_GET['id'];
$target = $_GET['target'];
	
	if(empty($target)){
		$sql_encode = mysql_query("SELECT * from island_group_target WHERE log_id='$id'") or die(mysql_error());
	}else{
		$sql_encode = mysql_query("SELECT * from island_price_target WHERE log_id='$id'") or die(mysql_error());
	}
	
	$row_encode = mysql_fetch_array($sql_encode);
	
	 @$myDate = $row_encode['date'];

?>
<center><h3>Edit</h3>
<form action=""  method="post">
<?php
	if($target != 'price'){
?>
<table>
	<tr>
		<td>Date:</td>
		<td><input type='text' id='inputField' name='date' value="<?php echo $myDate;?>" onfocus='date1(this.id);' readonly size="5"></td>
	</tr>
	<tr>
		<td>Wp Grade:</td>
		<td>
				<select name="wp_grade" style="width:100%;">
			<?php echo '<option value="'.$row_encode['wp_grade'].'">'.$row_encode['wp_grade'].'</option>';?>
							<option value="LCWL">LCWL</option>
							<option value="ONP">ONP</option>
							<option value="CBS">CBS</option>
							<option value="OCC">OCC</option>
							<option value="MW">MW</option>
							<option value="CHIPBOARD">CHIPBOARD</option>
						</select>
		</td>
	</tr>
	<tr>
		<td>Target:</td>
		<td><input type="text" name="target" onKeyPress="return isNumber(event);" value="<?php echo $row_encode['target'];?>"></td>
	</tr>
	<tr>
		<td>Group Island:</td>
		<td><select name="group_island" style="width:100%;">
			<?php echo '<option value="'.$row_encode['group_island'].'">'.$row_encode['group_island'].'</option>';?>
							<option value="Luzon">Luzon</option>
							<option value="Visayas">Visayas</option>
							<option value="Mindanao">Mindanao</option>
						</select></td>
	</tr>
</table>
<?php }else{?>
		<table>
	<tr class="tr">
					<td>Start Week:</td>
					<td ><input type='date' name='start_week' value="<?php echo date('Y-m-d', strtotime($row_encode['start_week']));?>" id="start_week" onchange="startdate();" required></td>
				</tr>
				<tr class="tr">
					<td>End Week:</td>
					<td><input type='date' name='end_week' value="<?php echo date('Y-m-d', strtotime($row_encode['end_week']));?>" id="end_week" readonly/> +6 days</td>
				</tr>
	<tr>
		<td>Wp Grade:</td>
		<td>
				<select name="wp_grade1" style="width:86%;">
			<?php echo '<option value="'.$row_encode['wp_grade'].'">'.$row_encode['wp_grade'].'</option>';?>
							<option value="LCWL">LCWL</option>
							<option value="ONP">ONP</option>
							<option value="CBS">CBS</option>
							<option value="OCC">OCC</option>
							<option value="MW">MW</option>
							<option value="CHIPBOARD">CHIPBOARD</option>
						</select>
		</td>
	</tr>
	<tr>
		<td>Target Price:</td>
		<td><input type="text" name="target1" onKeyPress="return isNumber(event);" value="<?php echo $row_encode['target_price'];?>"></td>
	</tr>
	<tr>
		<td>Target Tonnage:</td>
		<td><input type="text" name="target2" onKeyPress="return isNumber(event);" value="<?php echo $row_encode['target_tonnage'];?>"></td>
	</tr>
	<tr>
		<td>Group Island:</td>
		<td><select name="group_island1" style="width:86%;">
			<?php echo '<option value="'.$row_encode['group_island'].'">'.$row_encode['group_island'].'</option>';?>
							<option value="Luzon">Luzon</option>
							<option value="Visayas">Visayas</option>
							<option value="Mindanao">Mindanao</option>
						</select></td>
	</tr>
</table>
	<?php }?>
	<br /><br /><input type="submit" name="submits">
</form>
</center>
<?php

	if(isset($_POST['submits'])){
		
		if($target != 'price'){
		$myDate = date('Y/m/d');
		@$date = $_POST['date'];
			mysql_query("UPDATE island_group_target SET wp_grade='".$_POST['wp_grade']."', target='".$_POST['target']."', group_island='".$_POST['group_island']."', date='$date', update_id='".$_SESSION['username']."',updated_date='$myDate' WHERE log_id='$id'");
			echo '<script>
					window.onunload = refreshParent;
    				function refreshParent() {
        			window.opener.location.reload();
   				 }
					window.close();
				</script>';
		}else if($target == 'price'){
		$myDate = date('Y/m/d');
		@$start_week = date('Y/m/d', strtotime($_POST['start_week']));
		@$end_week = date('Y/m/d', strtotime($_POST['end_week']));
			mysql_query("UPDATE island_price_target SET wp_grade='".$_POST['wp_grade1']."', target_price='".$_POST['target1']."' , target_tonnage='".$_POST['target2']."', group_island='".$_POST['group_island1']."', start_week='$start_week', end_week='$end_week', update_id='".$_SESSION['username']."', update_date='$myDate' WHERE log_id='$id'") or die (mysql_error());
			echo '<script>
					window.onunload = refreshParent;
    				function refreshParent() {
        			window.opener.location.reload();
   				 }
					window.close();
				</script>';
				
			}
			
	}

?>