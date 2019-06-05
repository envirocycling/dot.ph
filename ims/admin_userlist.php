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
		
			if(tbl == 'bales'){
				$('#bales_date').show(500);
			}else{
				$('#bales_date').hide(500);
			}if(tbl == 'loose_papers'){
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


<?php
			$sql = mysql_query("SELECT * FROM users");

?>

 <div class="grid_10">
		 <div class="box round first">
		  <h2>Users</h2>
		  <br /><button onClick="window.open('process_add_user.php','name','height=280 ,width=350 top=100px,left=300px');">Add User</button><br /> <br />
			<table class="data display datatable" id="example">
			
			<thead>
				<tr class="data">
            		<th class="data" width="80px">User ID</th>
            		<th class="data" width="170px">password</th>
            		<th class="data" >Name</th>
           		    <th class="data">Branch</th> 
					<th class="data">Initial</th> 
					<th class="data" width="100px">Position</th>
					<th class="data">User Type</th>
					<th class="data">Action</th>
					         
        		</tr>
        	</thead>
		<?php while($row = mysql_fetch_array($sql)){
		?>
			<tr class="data">
				<td class="data"><?php echo $row['user_id'];?></td>
				<td class="data"><?php echo $row['password'];?></td>
				<td class="data"><?php echo $row['name'];?></td>
				<td class="data"><?php echo $row['branch'];?></td>
				<td class="data"><?php echo $row['initial'];?></td>
				<td class="data"><?php echo $row['position'];?></td>
				<td class="data"><?php echo $row['user_type'];?></td>
				<td><button onClick="window.open('process_edit_new.php?id=<?php echo $row['log_id'];?>','name','height=400 ,width=500 top=100px,left=300px');">Edit</button> | <a href="process_delete_new.php?id=<?php echo $row['user_id'].'&tbl=users';?>"><button onClick="return confirm('Do you want to Proceed?');">Delete</button></a></td>
			</tr>
	
		<?php }?>
		</table>
		
		</div>
 </div>	 
<div class="clear">

</div>

<div class="clear">

</div>


</body>
</html>



