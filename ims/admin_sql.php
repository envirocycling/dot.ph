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
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
		
    });
	
	function tbls(){
		var tbl = $('#tbl').val();
		
			if(tbl == 'bales' || tbl == 'actual' || tbl == 'sup_deliveries' || tbl == 'paper_buying' ){
				$('#bales_date').show(500);
			}else{
				$('#bales_date').hide(500);
			}if(tbl == 'loose_papers' || tbl == 'outgoing'){
				$('#loose_date').show(500);
			}else{
				$('#loose_date').hide(500);
			}
			
			
	}
	
	function bales_chks(){
	var tbl = $('#tbl').val();
		if(document.getElementById('bales_chked').checked){
			$('#another').show(500);
		}else{
			$('#another').hide(500);
		}
		
	}

</script>
<html>
<body  onload="tbls();">
<div class="grid_4">

    <div class="box round first">
       <form action="" method="POST">
		
			<table>
				<tr height="30px">
					<td> <select name="tbl" id="tbl" onChange="tbls();" required>
					<?php if(isset($_POST['submit'])){
									echo '<option value="'.$_POST['tbl'].'">'.$_POST['tbl'].'</option>';
							}else{
						?>
						<option value="" selected="selected" disabled="disabled">Table</option><?php } ?>
						<?php	$result = mysql_query("show tables"); 
									while($table = mysql_fetch_array($result)) {
   					 					echo '<option value="'.$table[0].'">'.$table[0].'</option>';
									}
						?>
						</select>
					</td>
				</tr>
				<tr height="30px">
					<td ><select name="wp_grade">
						<option value="">All</option>
							<?php
								$sql_grades = mysql_query("SELECT * from wp_grades") or die(mysql_error());
								while($row_grade = mysql_fetch_array($sql_grades)){
									echo '<option value="'.$row_grade['wp_grade'].'">'.$row_grade['wp_grade'].'</option>';
								}
							?>
						</select>
					</td>
					<td ><select name="branch">
						<?php  if(isset($_POST['submit'])){
								echo '<option value="'.$_POST['branch'].'">'.$_POST['branch'].'</option>';
								} ?>
						<option value="">All</option>
							<?php
							
								$sql_grades = mysql_query("SELECT * from branches") or die(mysql_error());
								while($row_grade = mysql_fetch_array($sql_grades)){
									echo '<option value="'.$row_grade['branch_name'].'">'.$row_grade['branch_name'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr id="bales_date" height="30px" hidden>
					<td>From<input type="date" name="bales_from" value="<?php echo $_POST['bales_from'];?>"></td>
					<td>To<input type="date" name="bales_to" value="<?php echo $_POST['bales_to'];?>"></td>
				</tr>
				<tr id="loose_date">
					<td>To:<input type="date" name="loose_date" value="<?php echo $_POST['loose_date'];?>"></td>
				</tr>
				<tr id="another" height="30px" hidden>
					<td colspan="2"><textarea rows="5" cols="50" name="another"><?php echo $_POST['other'];?></textarea></td>
				</tr>
				<tr>
					<td>Manual<input type="checkbox" id="bales_chked" onClick="bales_chks();" name="chk" value="1"></td>
				</tr>
			</table>
			<br />
			<input type="submit" name="submit" value="Execute">
			
		</form>
           
    </div>

</div>

<?php
	if(isset($_POST['submit'])){
		$wp_grade = $_POST['wp_grade'];
		$branch = $_POST['branch'];
		$chk = $_POST['chk'];
		
		if( $chk == '1' ){
			$another = $_POST['another'];
			$tbl = $_POST['tbl'];
						
			$sql = mysql_query("SELECT * from $tbl where ($another)") or die(mysql_error());
		}else if($_POST['tbl'] == 'bales' && $chk != '1' ){
			$from = date('Y/m/d', strtotime($_POST['bales_from']));
			$to = date('Y/m/d', strtotime($_POST['bales_to']));			
			
			$sql = mysql_query("SELECT * from bales where (wp_grade='$wp_grade' and  date >='$from' and date<='$to' and ((out_date > '$to' or out_date < '$from' or out_date='' or str_no='0'))    and str_no!='VOID'  and  branch like '%$branch%'  and status !='rebaled') or (str_no='0' and str_no!='VOID' and (date_rebaled>'$to' or date_rebaled='') and status!='rebaled' and wp_grade='$wp_grade' and branch like '%$branch%'  and date <='$to')");
		}else if($_POST['tbl'] == 'loose_papers'){
			
			$to = date('Y/m/d', strtotime($_POST['loose_date']));
			$sql = mysql_query("SELECT * FROM loose_papers where date='$to' and wp_grade like '%$wp_grade%' and branch like '%$branch%'");
		}else if($_POST['tbl'] == 'outgoing'){
			
			 $to = date('Y/m', strtotime($_POST['loose_date']));

			$sql = mysql_query("SELECT * FROM outgoing where wp_grade like '%$wp_grade' and  date LIKE '$to/%'  and branch like '%$branch%'") or die (mysql_error());
			
		}else if($_POST['tbl'] == 'actual'){
			
			 $from = date('Y/m/d', strtotime($_POST['bales_from']));
			 $to = date('Y/m/d', strtotime($_POST['bales_to']));	
			 $wp_grade;

			$sql = mysql_query("SELECT * FROM actual where wp_grade like '%$wp_grade' and  date >='$from' and date <='$to' and branch like '%$branch%'") or die (mysql_error());
			
		}else if($_POST['tbl'] == 'sup_deliveries'){
			
			 $from = date('Y/m/d', strtotime($_POST['bales_from']));
			 $to = date('Y/m/d', strtotime($_POST['bales_to']));	
//echo "SELECT * FROM sup_deliveries where wp_grade like '%$wp_grade' and  date_delivered >='$from' and date_delivered <='$to' and branch_delivered like '%$branch%'";
			$sql = mysql_query("SELECT * FROM sup_deliveries where wp_grade like '%$wp_grade' and  date_delivered >='$from' and date_delivered <='$to' and branch_delivered like '%$branch%'") or die (mysql_error());
			
		}else if($_POST['tbl'] == 'paper_buying'){
			
			 $from = date('Y/m/d', strtotime($_POST['bales_from']));
			 $to = date('Y/m/d', strtotime($_POST['bales_to']));	

			$sql = mysql_query("SELECT * FROM paper_buying where wp_grade like '%$wp_grade' and  date_received >='$from' and date_received <='$to' and branch like '%$branch%'") or die (mysql_error());
			
		}
                
               // echo "SELECT * from bales where (wp_grade='$wp_grade' and  date >='$from' and date<='$to' and ((out_date > '$to' or out_date < '$from' or out_date='' or str_no='0'))    and str_no!='VOID'  and  branch like '%$branch%'  and status !='rebaled') or (str_no='0' and str_no!='VOID' and (date_rebaled>'$to' or date_rebaled='') and status!='rebaled' and wp_grade='$wp_grade' and branch like '%$branch%'  and date <='$to')";
?>

 <div class="grid_10">
		 <div class="box round first">
		  <h2>Result in <?php echo $_POST['tbl'].$_POST['condition'];?></h2>
			<table class="data display datatable" id="example">
		<?php if($_POST['tbl'] == 'bales'){?>		
			<thead>
				<tr class="data">
            		<th class="data" width="80px">Log ID</th>
            		<th class="data" width="170px">Wp Grade</th>
            		<th class="data" >Bale ID</th>
           		    <th class="data">Bale Weight</th> 
					<th class="data">Str#</th> 
					<th class="data" width="100px">Date</th>
					<th class="data" width="100px">Branch</th>
					<th class="data" width="100px">Out Date</th> 
					<th class="data" width="100px">Status</th>
					<th class="data" width="100px">Date Rebaled</th>
					<th class="data">Action</th>         
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
			$total +=$row['bale_weight'];
		?>
			<tr class="data">
				<td class="data"><?php echo $row['log_id'];?></td>
				<td class="data"><?php echo $row['wp_grade'];?></td>
				<td class="data"><?php echo $row['bale_id'];?></td>
				<td class="data"><?php echo $row['bale_weight'];?></td>
				<td class="data"><?php echo $row['str_no'];?></td>
				<td class="data"><?php echo $row['date'];?></td>
				<td class="data"><?php echo $row['branch'];?></td>
				<td class="data"><?php echo $row['out_date'];?></td>
				<td class="data"><?php echo $row['status'];?></td>
				<td class="data"><?php echo $row['date_rebaled'];?></td>
				<td><button onClick="window.open('process_edit_new.php?id=<?php echo $row['log_id'];?>','name','height=400 ,width=500 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['log_id'].'&tbl='.$_POST['tbl'];?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td>
			</tr>
	
		<?php }}else if($_POST['tbl'] == 'loose_papers'){?>
		<thead>
			<tr class="data">
            		<th class="data" width="80px">Log ID</th>
					<th class="data" width="100px">Date</th>
					<th class="data" width="100px">Wp Grade</th>
					<th class="data" width="100px">Weight</th>
					<th class="data" width="100px">Branch</th>
					<th class="data">Action</th>         
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
			$total +=$row['weight'];
		?>
			<tr class="data">
				<td class="data"><?php echo $row['log_id'];?></td>
				<td class="data"><?php echo $row['date'];?></td>
				<td class="data"><?php echo $row['wp_grade'];?></td>
				<td class="data"><?php echo $row['weight'];?></td>
				<td class="data"><?php echo $row['branch'];?></td>
				<td><button onClick="window.open('process_edit_newloose.php?id=<?php echo $row['log_id'];?>','name','height=180 ,width=300 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['log_id'].'&tbl='.$_POST['tbl'];?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td>
			</tr>
		
		<?php }}else if($_POST['tbl'] == 'outgoing'){?>
		<thead>
			<tr class="data">
            		<th class="data" width="80px">Log ID</th>
					<th class="data" width="100px">Str</th>
					<th class="data" width="100px">Date</th>
					<th class="data" width="100px">Trucking</th>
					<th class="data" width="100px">Plate Number</th>
					<th class="data" width="100px">Wp Grade</th>
					<th class="data" width="100px">Weight</th>
					<th class="data" width="100px">Branch</th>
					<th class="data">Action</th>         
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
			$total +=$row['weight'];
		?>
			<tr class="data">
				<td class="data"><?php echo $row['log_id'];?></td>
				<td class="data"><?php echo $row['str'];?></td>
				<td class="data"><?php echo $row['date'];?></td>
				<td class="data"><?php echo $row['trucking'];?></td>
				<td class="data"><?php echo $row['plate_number'];?></td>
				<td class="data"><?php echo $row['wp_grade'];?></td>
				<td class="data"><?php echo $row['weight'];?></td>
				<td class="data"><?php echo $row['branch'];?></td>
				<td><button onClick="window.open('process_edit_newout.php?id=<?php echo $row['log_id'];?>','name','height=280 ,width=350 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['log_id'].'&tbl='.$_POST['tbl'];?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td>
			</tr>
		
		<?php }}else if($_POST['tbl'] == 'actual'){?>
		<thead>
			<tr class="data">
            		<th class="data" width="80px">Log ID</th>
					<th class="data" width="100px">Str</th>
					<th class="data" width="100px">Date</th>
					<th class="data" width="100px">Delivered To</th>
					<th class="data" width="100px">Plate Number</th>
					<th class="data" width="100px">Wp Grade</th>
					<th class="data" width="100px">Weight</th>
					<th class="data" width="100px">Branch</th>
					<th class="data" width="100px">Mc %</th>
					<th class="data" width="100px">Dirt</th>
					<th class="data" width="100px">Net Weight</th>
					<th class="data" width="100px">Trans ID</th>
					<th class="data" width="100px">Detail ID</th>
					<th class="data">Action</th>   
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
			$total +=$row['weight'];
		?>
			<tr class="data">
				<td class="data"><?php echo $row['log_id'];?></td>
				<td class="data"><?php echo $row['str_no'];?></td>
				<td class="data"><?php echo $row['date'];?></td>
				<td class="data"><?php echo $row['delivered_to'];?></td>
				<td class="data"><?php echo $row['plate_number'];?></td>
				<td class="data"><?php echo $row['wp_grade'];?></td>
				<td class="data"><?php echo $row['weight'];?></td>
				<td class="data"><?php echo $row['branch'];?></td>
				<td class="data"><?php echo $row['mc'];?></td>
				<td class="data"><?php echo $row['dirt'];?></td>
				<td class="data"><?php echo $row['net_wt'];?></td>
				<td class="data"><?php echo $row['trans_id'];?></td>
				<td class="data"><?php echo $row['detail_id'];?></td>
				<td><button onClick="window.open('process_edit_newactual.php?id=<?php echo $row['log_id'];?>','name','height=480 ,width=400 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['log_id'].'&tbl='.$_POST['tbl'];?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td>
			</tr>
		
		<?php }}else if($_POST['tbl'] == 'sup_deliveries'){?>
		<thead>
			<tr class="data">
            		<th class="data" width="80px">Del ID</th>
					<th class="data" width="100px">Supplier ID</th>
					<th class="data" width="100px">Supplier Name</th>
					<th class="data" width="100px">Wp Grade</th>
					<th class="data" width="100px">Weight</th>
					<th class="data" width="100px">Branch</th>
					<th class="data" width="100px">Date Received</th>
					<th class="data" width="100px">Trans ID</th>
					<th class="data" width="100px">Detail ID</th>
					<th class="data">Action</th>     
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
			$total +=$row['weight'];
		?>
			<tr class="data">
				<td class="data"><?php echo $row['del_id'];?></td>
				<td class="data"><?php echo $row['supplier_id'];?></td>
				<td class="data"><?php echo $row['supplier_name'];?></td>
				<td class="data"><?php echo $row['wp_grade'];?></td>
				<td class="data"><?php echo $row['weight'];?></td>
				<td class="data"><?php echo $row['branch_delivered'];?></td>
				<td class="data"><?php echo $row['date_delivered'];?></td>
				<td class="data"><?php echo $row['trans_id'];?></td>
				<td class="data"><?php echo $row['detail_id'];?></td>
				<td><button onClick="window.open('process_edit_newsupdel.php?id=<?php echo $row['del_id'];?>','name','height=350 ,width=450 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['del_id'].'&tbl='.$_POST['tbl'];?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td
			></tr>
		
		<?php }}else if($_POST['tbl'] == 'paper_buying'){?>
		<thead>
			<tr class="data">
            		<th class="data" width="80px">Log ID</th>
					<th class="data" width="100px">Date Received</th>
					<th class="data" width="100px">Supplier ID</th>
					<th class="data" width="100px">Supplier Name</th>
					<th class="data" width="100px">Plate#</th>
					<th class="data" width="100px">Wp Grade</th>
					<th class="data" width="100px">Corrected Weight</th>
					<th class="data" width="100px">Unit Cost</th>
					<th class="data" width="100px">Paper Buying</th>
					<th class="data" width="100px">Branch</th>
					<th class="data" width="100px">Trans ID</th>
					<th class="data" width="100px">Detail ID</th>
					<th class="data">Action</th>     
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
			$total +=$row['corrected_weight'];
			$paper +=$row['paper_buying'];
		?>
			<tr class="data">
				<td class="data"><?php echo $row['log_id'];?></td>
				<td class="data"><?php echo $row['date_received'];?></td>
				<td class="data"><?php echo $row['supplier_id'];?></td>
				<td class="data"><?php echo $row['supplier_name'];?></td>
				<td class="data"><?php echo $row['plate_number'];?></td>
				<td class="data"><?php echo $row['wp_grade'];?></td>
				<td class="data"><?php echo $row['corrected_weight'];?></td>
				<td class="data"><?php echo $row['unit_cost'];?></td>
				<td class="data"><?php echo $row['paper_buying'];?></td>
				<td class="data"><?php echo $row['branch'];?></td>
				<td class="data"><?php echo $row['trans_id'];?></td>
				<td class="data"><?php echo $row['detail_id'];?></td>
				<td><button onClick="window.open('process_edit_newpaperbuying.php?id=<?php echo $row['log_id'];?>','name','height=350 ,width=450 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['log_id'].'&tbl='.$_POST['tbl'];?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td
			></tr>
		
		<?php }}?>
		<center><h4><?php echo 'Weight: '.number_format($total); if(!empty($paper)){ echo '<br/>PaperBuying: '.number_format($paper);}?></h4>	
		</table>
		
		</div>
 </div>
<?php }?>		 
<div class="clear">

</div>

<div class="clear">

</div>


</body>
</html>



