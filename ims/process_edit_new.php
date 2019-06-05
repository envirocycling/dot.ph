<?php
include 'config.php';

$id = $_GET['id'];
$sql = mysql_query("SELECT * from bales WHERE log_id = '$id'") or die(mysql_error());
$row = mysql_fetch_array($sql);
?>
<script>
	function action(){
	//	var chk = document.getElementById('insert').value();
		if(document.getElementById('insert').checked){
			document.getElementById('insert1').hidden=false;
			document.getElementById('date1').hidden=false;
			document.getElementById('str1').hidden=false;
			document.getElementById('date').hidden=true;
			document.getElementById('str').hidden=true;
			document.getElementById('edit1').hidden=true;
			
		}else{
			document.getElementById('insert1').hidden=true;
			document.getElementById('date1').hidden=true;
			document.getElementById('str1').hidden=true;
			document.getElementById('date').hidden=false;
			document.getElementById('str').hidden=false;
			document.getElementById('edit1').hidden=false;
		}
	}
</script>
<center>
<table>
	<tr height="90px;">
		<td colspan="2" align="center">Insert<input type="checkbox" id="insert" onclick="action();"></td>
	</tr>
	<tr>
	<form action=" " method="post">
		<td>Wp Grade</td>
		<td><input type="text" name="wp_grade" value="<?php echo $row['wp_grade'];?>"></td>
	</tr>
	<tr>
		<td>Baled ID</td>
		<td><input type="text" name="bale_id" value="<?php echo $row['bale_id'];?>"></td>
	</tr>
	<tr>
		<td>Bale Weight</td>
		<td><input type="text" name="bale_weight" value="<?php echo $row['bale_weight'];?>"></td>
	</tr>
	<tr>
		<td>Str</td>
		<td><input type="text" name="str" value="<?php echo $row['str_no'];?>" id="str"><input type="text" name="str1" value="0" id="str1" hidden></td>
	</tr>
	<tr>
		<td>Date</td>
		<td><input type="text" name="date" value="<?php echo $row['date'];?>" id="date"><input style="width:100%;" type="date" name="date1" id="date1" hidden></td>
	</tr>
	<tr>
		<td>Branch</td>
		<td><input type="text" name="branch" value="<?php echo $row['branch'];?>"></td>
	</tr>
	<tr>
		<td>Out Date</td>
		<td><input type="text" name="out_date" value="<?php echo $row['out_date'];?>" id="out_date"></td>
	</tr>
	<tr>
		<td>Status</td>
		<td><input type="text" name="status" value="<?php echo $row['status'];?>" id="status"></td>
	</tr>
	<tr>
		<td>Date_rebaled</td>
		<td><input type="text" name="date_rebaled" value="<?php echo $row['date_rebaled'];?>" id="date_rebaled"></td>
	</tr>
	<tr>
		<td colspan="2" align="center" id="edit1"><input type="submit" name="edit" value="Edit"></td>
		<td colspan="2" align="center" id="insert1" hidden><input type="submit" name="insert" value="Insert" onclick="return confirm('Double Check the Data.');"></td>
	</tr>
</table>
</form>
</center>
	<?php
	
		if(isset($_POST['edit'])){
			$wp_grade = $_POST['wp_grade'];
			$bale_id = $_POST['bale_id'];
			$bale_weight = $_POST['bale_weight'];
			$str = $_POST['str'];
			$date = $_POST['date'];
			$branch = $_POST['branch'];
			$out_date = $_POST['out_date'];
			$status = $_POST['status'];
			$date_rebaled = $_POST['date_rebaled'];
			
			if(mysql_query("UPDATE bales SET wp_grade='$wp_grade',bale_id='$bale_id',bale_weight='$bale_weight',str_no='$str',date='$date',branch='$branch',out_date='$out_date',status='$status',date_rebaled='$date_rebaled'  WHERE log_id='$id'") or die(mysql_error())){
				echo '<script>
							alert("Successful.");
					</script>';
			}
		}else if(isset($_POST['insert'])){
			$wp_grade = $_POST['wp_grade'];
			$bale_id = $_POST['bale_id'];
			$bale_weight = $_POST['bale_weight'];
			$str = $_POST['str1'];
			$date = date('Y/m/d', strtotime($_POST['date1']));
			$branch = $_POST['branch'];
			$out_date = $_POST['out_date'];
			
			if(mysql_query("INSERT INTO bales (wp_grade,bale_id,bale_weight,str_no,date,branch,out_date,status,date_rebaled)
				VALUES('$wp_grade','$bale_id','$bale_weight','$str','$date','$branch','$out_date','','')") or die(mysql_error())){
				
					echo '<script>
								alert("Successful.");
						</script>';
				}
				
		}
		
	?>