<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>
	<script>
		function show(){
			if((document.getElementById('1').checked) && (document.getElementById('2').checked) && (document.getElementById('3').checked)){
				document.getElementById('t1').hidden=false;
				document.getElementById('t2').hidden=false;
			}else {
				document.getElementById('t1').hidden=true;
				document.getElementById('t2').hidden=true;
				document.getElementById('text').value='';
				document.getElementById('text2').value='';
				}
			}
	</script>
<?php
	include('connect.php');

//truck palte number =============================================
		$truck_plate = "SELECT * FROM tbl_truck_report Where id='".$_GET['id']."'";
		$result_plate = mysql_query($truck_plate) or die("Error in query : $query".mysql_error());
		$tprow = mysql_fetch_array($result_plate);
//===============================================================

//status========================================
		$registration = "SELECT * FROM tbl_truckregistration Where truckid='".$_GET['id']."' ";
		$result_registration = mysql_query($registration) or die("Error in query : $query".mysql_error());
		$rrrow = mysql_fetch_array($result_registration);
														
//============================================
		$query = "SELECT * FROM tbl_truckregistration Where truckid='".$_GET['id']."'";
		$result = mysql_query($query) or die("Error in query : $query".mysql_error());
		$row = mysql_fetch_array($result);
?>
<br />
	<center><h3>Update Vehicle Registration</h3></center>
		<form action="registration_update.php?id=<?php echo $_GET['id'];?>" method="post">
			<table>
				<tr>	
					<td align="right">Plate Number:<td>
					<td><?php echo $tprow['truckplate'];?></td>
				</tr>
				<tr>
					<td align="right">Insurance:<td>
					<td><?php if($rrrow['insurance'] == 'OK'){?><input type="checkbox"  name="insurance" value="OK" checked="checked" disabled="disabled">
								<input type="hidden" name="insurance"  value="OK">
									<?php }else{?> <input type="checkbox" id="1" name="insurance" onclick="show()" value="OK"> <?php } ?>
					</td>
				</tr>
				<tr>
					<td align="right">Stencil:<td>
					<td><?php if($rrrow['stencil'] == 'OK'){?><input type="checkbox" name="stencil" value="OK" checked="checked" disabled="disabled">
						<input type="hidden" name="stencil" value="OK">
						<?php }else{?><input type="checkbox" id="2" name="stencil"  onclick="show()" value="OK"><?php } ?></td>
					</tr>
					<tr>
						<td align="right">Emission:<td>
						<td><?php if($rrrow['emission'] == 'OK'){?><input type="checkbox" name="emission" value="OK" checked="checked" disabled="disabled">
							<input type="hidden" name="emission" value="OK">
							<?php }else{?><input type="checkbox" name="emission" id="3"  onclick="show()" value="OK"><?php } ?></td>
					</tr>
					<tr >
						<td id="t1" colspan="3" hidden="">Location:
							<input type="text"  name="location" id="text" onKeyUp="caps(this)" onKeyPress="return isNumbers(event)"  onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ></td>
					</tr>
					<tr>
						<td colspan="3">Remarks:	
							<textarea name="remarks" cols="22" rows="5" id="text2"  onKeyUp="caps(this)" onKeyPress="return isNumbers(event)" ><?php echo $rrrow['remarks'];?></textarea>
						</td>
					</tr>
				</table>
<br />

			<input type="submit" value="Save Update">
		</form>
