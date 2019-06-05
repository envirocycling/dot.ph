<?php
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
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>


<link rel="stylesheet" href="css/new_tf.css" type="text/css">
<style>
	.edit{
		cursor:pointer;
	}
	.delete{
		cursor:pointer;
	}
</style>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
  <script>
  		function startdate(){
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

		} 
		
	function view_encoded(){
		var branch = document.getElementById('e_branch').value;
		alert(branch);
	}
	
	function isNumber(evt) {
   	     evt = (evt) ? evt : window.event;
   			 var charCode = (evt.which) ? evt.which : evt.keyCode;
   			 if (charCode == 46 || (charCode > 47 && charCode < 58)) {
       			 return true;
  			  }
   			 return false;

	}
	
	function deletes(id){
		var mes = confirm("Do you want to Delete this?");
		var data = id.split("_");
		var log_id = data[1];
		var target = data[0];
		
		if(mes == true){
			var myData = '&id=' + log_id + '&target=' + target;
			$.ajax({
				type: 'POST',
				url: 'process_delete_encode.php',
				data: myData,
			});
			
			alert("Successful.");
			window.location.reload();
		}
	}
	
	function targets(){
		var type = document.getElementById('types').value;
	
		if(type == 'Monthly'){
			document.getElementById('monthly').hidden=false;
			document.getElementById('monthly1').hidden=false;
			document.getElementById('island').hidden=false;
			document.getElementById('grade').hidden=false;
			document.getElementById('btn').hidden=false;
			document.getElementById('weekly').hidden=true;
			document.getElementById('weekly1').hidden=true;	
			document.getElementById('weekly2').hidden=true;
			document.getElementById('weekly3').hidden=true;
			document.getElementById('target').hidden=false;
		}else{
			document.getElementById('weekly').hidden=false;
			document.getElementById('weekly1').hidden=false;
			document.getElementById('weekly2').hidden=false;
			document.getElementById('weekly3').hidden=false;
			document.getElementById('monthly').hidden=true;
			document.getElementById('monthly1').hidden=true;
			document.getElementById('island').hidden=false;
			document.getElementById('grade').hidden=false;
			document.getElementById('btn').hidden=false;
		}
	}
	
  </script>
  

<div class="grid_4">
    <div class="box round first grid">
        <h2>Target Encoded</h2>
		        <h5>Filtering Options</h5>
        <form action="" method="POST">
            <br>
			<table>
				</tr>
				<tr class="tr">
					<td>Date:</td>
					<td><input type='text' id='inputField' name='month' value="<?php if(isset ($_POST['encode'])) {
                echo $_POST['month'];
            } else {
                echo date("Y/m/d");
                               }?>" onfocus='date1(this.id);' readonly size="10"></td>
				</tr>
				<tr class="tr">
					<td>Wp Grade:</td>
					<td>
						<select name="wp_grade" required>
							<?php
								if(isset($_POST['encode']) && $_POST['wp_grade'] != 'All'){
									echo '<option value="'.$_POST['wp_grade'].'">'.$_POST['wp_grade'].'</option>';
								}
							?>
							<option value="All">All</option>
							<option value="LCWL">LCWL</option>
							<option value="ONP">ONP</option>
							<option value="CBS">CBS</option>
							<option value="OCC">OCC</option>
							<option value="MW">MW</option>
							<option value="CHIPBOARD">CHIPBOARD</option>
						</select>
					</td>
				</tr>
				<tr class="tr">
					<td>Group Island:</td>
					<td>
						<select name="group_island" required>
						<?php
							if(isset($_POST['encode'])){
								echo '<option value="'.$_POST['group_island'].'" >'.$_POST['group_island'].'</option>';
							}else{
						?>
							<option value="" selected="selected" disabled="disabled">Select</option><?php }?>
							<option value="All">All</option>
							<option value="Luzon">Luzon</option>
							<option value="Visayas">Visayas</option>
							<option value="Mindanao">Mindanao</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><br /><br /><input type="submit" value="Submit" name="encode"> </form></td>
				</tr>
			</table>
       
    </div>
</div>

<div class="grid_4">
    <div class="box round first grid">
		 <h2>Encode Target</h2>
        <form action="" method="POST" onsubmit="return confirm('Do you want to Proceed?');">
            <br>
			<table>
				<tr class="tr">
					<td>Target Type:</td>
					<td><select name="type" id="types" onchange="targets();" required>
							<option value="" selected="selected" disabled="disabled">Select</option>
							<option value="Monthly">Monthly</option>
							<option value="Weekly">Weekly</option>
						</select>
					</td>
				<tr class="tr" id="monthly" hidden>
					<td>Month & Year:</td>
					<td><input type='text' id='inputField2' name='emonth' value="<?php if(isset ($_POST['esubmit'])) {
                echo $_POST['emonth'];
            } else {
                echo date("Y/m");
                             }?>" onfocus='date1(this.id);' readonly size="5"></td>
				</tr>
				<tr class="tr" id="weekly" hidden>
					<td>Start Week:</td>
					<td ><input type='date' name='start_week' value="<?php echo $_POST['start_week'];?>" id="start_week" onchange="startdate();" ></td>
				</tr>
				<tr class="tr" id="weekly1" hidden>
					<td>End Week:</td>
					<td><input type='date' name='end_week' value="<?php echo $_POST['end_week'];?>" id="end_week" readonly/> +6 days</td>
				</tr>
				<tr class="tr" id="island"  hidden>
					<td>Group Island:</td>
					<td>
						<select name="egroup_island" required>
						<?php
							if(isset($_POST['esubmit'])){
								echo '<option value="'.$_POST['egroup_island'].'" >'.$_POST['egroup_island'].'</option>';
							}else{
						?>
							<option value="" selected="selected" disabled="disabled">Select</option><?php }?>
							<option value="Luzon">Luzon</option>
							<option value="Visayas">Visayas</option>
							<option value="Mindanao">Mindanao</option>
							<option value="VizMin">VizMin</option>
						</select>
					</td>
				</tr>
				<tr class="tr" id="grade" hidden>
					<td>Wp Grade:</td>
					<td>
						<select name="ewp_grade" required>
							<?php
								if(isset($_POST['esubmit'])){
									echo '<option value="'.$_POST['ewp_grade'].'">'.$_POST['ewp_grade'].'</option>';
								}
							?>
							<option value="LCWL">LCWL</option>
							<option value="ONP">ONP</option>
							<option value="CBS">CBS</option>
							<option value="OCC">OCC</option>
							<option value="MW">MW</option>
							<option value="CHIPBOARD">CHIPBOARD</option>
						</select>
					</td>
				</tr>
				<tr class="tr" id="monthly1" hidden>
					<td>Target (Tons):</td>
					<td><input type="text" name="etarget" style="width:110px;" onkeypress="return isNumber(event);"></td>
				</tr>
				<tr class="tr" id="weekly2" hidden>
					<td>Target Price:</td>
					<td><input type="text" name="etarget_price" style="width:110px;" onkeypress="return isNumber(event);"></td>
				</tr>
				<tr class="tr" id="weekly3" hidden>
					<td>Target Tonnage:</td>
					<td><input type="text" name="etarget_tonnage" style="width:110px;" onkeypress="return isNumber(event);"> Optional</td>
				</tr>
				<tr id="btn"  hidden>
					<td align="right"><br /><br /><input type="submit" name="esubmit"  value="Encode MTD" ></form></td>
				</tr>
				
			</table>
			
			<?php
			 if(isset($_POST['esubmit'])){
			 
			 		$ebranch = $_SESSION['user_branch'];
					$ewp_grade = $_POST['ewp_grade'];
					$etarget = $_POST['etarget'];
					$egroup_island = $_POST['egroup_island'];
					$edate = $_POST['emonth'];
					$ecreated_id = $_SESSION['username'];
					$ecreated_date = date('Y/m/d');
					$type = $_POST['type'];
					$start_week = date('Y/m/d', strtotime($_POST['start_week']));
					$end_week = date('Y/m/d', strtotime($_POST['end_week']));
					$etarget_price = $_POST['etarget_price'];
					$etarget_tonnage = $_POST['etarget_tonnage'];
					
					$sql_encode = mysql_query("SELECT * from island_group_target WHERE branch='$ebranch' and wp_grade='$ewp_grade' and group_island='$egroup_island' and date='$edate'") or die (mysql_error());
					$row_encode = mysql_fetch_array($sql_encode);
					
					$sql_encode2 = mysql_query("SELECT * from island_price_target WHERE branch='$ebranch' and wp_grade='$ewp_grade' and group_island='$egroup_island' and start_week = '$start_week' and end_week = '$end_week' ") or die (mysql_error());
					$row_encode2 = mysql_fetch_array($sql_encode2);
					
						if($type == 'Monthly'){
							if(mysql_num_rows($sql_encode) == 0){
								
									if(mysql_query("INSERT INTO island_group_target (branch,wp_grade,target,group_island,date,create_id,created_date)
										VALUES ('$ebranch','$ewp_grade','$etarget','$egroup_island','$edate','$ecreated_id','$ecreated_date')") or die (mysql_error())){
									
											echo '<script>
														alert("Successful.");
												</script>';
										}
							}
						}else{
							if(mysql_num_rows($sql_encode2) == 0){
									
								if($egroup_island != 'VizMin'){
									if(mysql_query("INSERT INTO island_price_target (branch,wp_grade,target_price,group_island,start_week,end_week,create_id,created_date,target_tonnage)
										VALUES ('$ebranch','$ewp_grade','$etarget_price','$egroup_island','$start_week','$end_week','$ecreated_id','$ecreated_date','$etarget_tonnage')") or die (mysql_error())){
									
											echo '<script>
														alert("Successful.");
												</script>';
										}
								}else if($egroup_island == 'VizMin'){
									if(mysql_query("INSERT INTO island_price_target (branch,wp_grade,target_price,group_island,start_week,end_week,create_id,created_date,target_tonnage)
										VALUES ('$ebranch','$ewp_grade','$etarget_price','Visayas','$start_week','$end_week','$ecreated_id','$ecreated_date','$etarget_tonnage'),
										('$ebranch','$ewp_grade','$etarget_price','Mindanao','$start_week','$end_week','$ecreated_id','$ecreated_date','$etarget_tonnage')") or die (mysql_error())){
									
											echo '<script>
														alert("Successful.");
												</script>';
										}
								}
							}
						}
			 
			 }
			?>
			
	</div>
</div>

 <?php
 if(isset($_POST['encode'])){	
 	$header_date = date('F, Y', strtotime($_POST['month']));
	
	$wp_grade = $_POST['wp_grade'];
    $date = date('Y/m', strtotime($_POST['month']));
	$branch = $_SESSION['user_branch'];
	$group_island = $_POST['group_island'];
 ?>
 	 <div class="grid_10">
		 <div class="box round first">
		 	<h2><?php echo $_SESSION['user_branch'].' Monthly Target  as of  '.$header_date;
				
				if($wp_grade != 'All' && $group_island != 'All'){
						$sql_island = mysql_query("SELECT * from island_group_target WHERE wp_grade='$wp_grade' and date='$date' and branch='$branch' and group_island='$group_island'") or die(mysql_error());
				}else if($wp_grade != 'All' && $group_island == 'All'){
						$sql_island = mysql_query("SELECT * from island_group_target WHERE wp_grade='$wp_grade' and date='$date' and branch='$branch'") or die(mysql_error());
				}else if($wp_grade == 'All' && $group_island == 'All'){
						$sql_island = mysql_query("SELECT * from island_group_target WHERE date='$date' and branch='$branch'") or die(mysql_error());
				}else{
						$sql_island = mysql_query("SELECT * from island_group_target WHERE  date='$date' and branch='$branch' and group_island='$group_island'") or die(mysql_error());
				}
				
				
			?></h2>

			<table class="data display datatable" id="example">
			
			<thead>
				<tr class="data">
            		<th class="data" width="90px">Log ID</th>
            		<th class="data">Wp Grade</th>
            		<th class="data" width="170px">Target</th>
           		    <th class="data" width="100px">Group Island</th> 
					<th class="data" width="100px">Date</th> 
					<th class="data" width="100px">Action</th>        
        		</tr>
        	</thead>
		<?php
			while($row_island = mysql_fetch_array($sql_island)){
				$date1 = str_replace("/", "-", $row_island['date']);
		?>
			<tr class="data">
				<td class="data"><?php echo $row_island['log_id'];?></td>
				<td class="data"><?php echo $row_island['wp_grade'];?></td>
				<td class="data"><?php echo $row_island['target'];?></td>
				<td class="data"><?php echo $row_island['group_island'];?></td>
				<td class="data"><?php echo date('F, Y',strtotime($date1));?></td>
				<td class="data"><img src="images/edit_property.png" class="edit"  onclick="window.open('process_edit_encode.php?id=<?php echo $row_island['log_id'];?>','edit','height=300,width=400,left=500,top=150');" width="25px" height="25px">&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <img src="images/black-white-metro-delete-icon.png" height="25px" width="25px" id="actual_<?php echo $row_island['log_id'];?>" onclick="deletes(this.id);" class="delete"></td>
			</tr>
		<?php }?>
		</table>

		</div>
 	</div>
	
	
	 <div class="grid_10">
		 <div class="box round first">
		 <h2><?php echo $_SESSION['user_branch'].' Weekly Target Price  as of  '.$header_date; ?></h2>
		 
		 	<table class="data display datatable" >
			
			<thead>
				<tr class="data">
            		<th class="data" width="90px">Log ID</th>
            		<th class="data">Wp Grade</th>
            		<th class="data" width="170px">Target Price</th>
					<th class="data" width="170px">Target tonnage</th>
           		    <th class="data" width="100px">Group Island</th> 
					<th class="data" width="100px">Date Effective</th> 
					<th class="data" width="100px">Action</th>        
        		</tr>
        	</thead>
		 	<?php
				$date1 = date('Y/m', strtotime($_POST['month']));
				if($wp_grade != 'All' && $group_island != 'All'){
						$sql_price = mysql_query("SELECT * from island_price_target WHERE branch='$branch' and wp_grade='$wp_grade' and start_week like  '$date1%' and group_island='$group_island' ") or die (mysql_error());
				}else if($wp_grade != 'All' && $group_island == 'All'){
						$sql_price = mysql_query("SELECT * from island_price_target WHERE wp_grade='$wp_grade' and start_week like  '$date1%' and branch='$branch'") or die(mysql_error());
				}else if($wp_grade == 'All' && $group_island == 'All'){
						$sql_price = mysql_query("SELECT * from island_price_target WHERE branch='$branch' and start_week like  '$date1%' ") or die (mysql_error());
				}else{
						$sql_price = mysql_query("SELECT * from island_price_target WHERE branch='$branch' and start_week like  '$date1%' and group_island='$group_island' ") or die (mysql_error());
				}
				
			
				while($row_price = mysql_fetch_array($sql_price)){ ?>
					
					<tr class="data">
						<td class="data"><?php echo $row_price['log_id'];?></td>
						<td class="data"><?php echo $row_price['wp_grade'];?></td>
						<td class="data"><?php echo $row_price['target_price'];?></td>
						<td class="data"><?php echo $row_price['target_tonnage'];?></td>
						<td class="data"><?php echo $row_price['group_island'];?></td>
						<td class="data"><?php echo date('F d, Y', strtotime($row_price['start_week'])).'&nbsp; to&nbsp; '.date('F d, Y', strtotime($row_price['end_week']));?></td>
						<td class="data"><img src="images/edit_property.png" class="edit"  onclick="window.open('process_edit_encode.php?id=<?php echo $row_price['log_id'].'&target=price';?>','edit','height=300,width=400,left=500,top=150');" width="25px" height="25px">&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <img src="images/black-white-metro-delete-icon.png" height="25px" width="25px" id="price_<?php echo $row_price['log_id'];?>" onclick="deletes(this.id);" class="delete"></td>
					</tr>	
				
			<?php	}
			?>
		</table>
		 </div>
	</div>
	
	
<?php }?>
<div class="clear">

</div>



