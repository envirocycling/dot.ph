<!doctype html>
<html lang=''>

	<head>
		<title>Vehicle Management System</title>
		<meta charset='utf-8'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
		<link rel="stylesheet" href="css/styles.css">

		<!-- DataTables -->

		<link rel="stylesheet" type="text/css" href="css/datatables.min.css">
		<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">

		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/datatables.min.js"></script>
		<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>

		<script type="text/javascript">
			$(document).ready(function () {
				$('#truck_datatables').DataTable();
			});
		</script>
		
	</head>

	<body>

		<?php include('layout/header.php'); ?>

		<center>
			<div id="body">

			<?php 

			include('connect.php');

			$branch = $_SESSION['owner'];

			$records_per_page = 200;
			(@!$_GET['start'])?$start=0 : $start = $_GET['start'];

			$query = "SELECT count(*) FROM tbl_truck_report WHERE branch='$branch';";
			$result = mysql_query($query) or die("Error in query : $query".mysql_error());
			$row = mysql_fetch_row($result);
			$total_records = $row[0];

			if(($total_records > 0) && ($start < $total_records)) {
				if(isset($_POST['submit'])) {
					$search = $_POST['search'];
					$query = "SELECT * FROM tbl_truck_report WHERE branch = '$branch' AND truckplate LIKE '%$search%' OR branch LIKE '%$search%' OR ownersname LIKE '%$search%' OR make LIKE '%$search%' OR series LIKE '%$search%' OR bodytype LIKE '%$search%' OR yearmodel LIKE '%$search%' OR suppliername LIKE '%$search%' AND status='' ORDER BY branch,ending ASC LIMIT $start,$records_per_page";
				}else {
					$query = "SELECT * FROM tbl_truck_report WHERE branch = '$branch' AND status='' ORDER BY branch,ending ASC LIMIT $start,$records_per_page";
				}

				$result = mysql_query($query) or die(mysql_error());
				$count = 1;
			?>

	
			<table id="page1" style="margin-bottom: 50px;">
				<tr>
					<td align="left">Existing Vehicles<br /><td>
					<td align="right"><span id="back" onClick="backed();">Back</span><td/>
				</tr>
			</table>

			<table>
				<tr>
					<td>

						<table id="truck_datatables" class="table table-striped table-bordered" >    

							<thead>
								<tr>
									<th>Branch</th>
									<th>Owner's Name</th>
									<th>Supplier Name</th>
									<th>Class</th>
									<th>Plate Number</th>
									<th>Make</th>
									<th>Series</th>
									<th>Body Type</th>
									<th>Year Model</th>
									<th>Acquisition Cost</th>
									<th>Selling Price</th>
									<th>Vehicle Condition</th>	
									<th>Action</th>	
								</tr>
							</thead>

							<tbody>

		 					<?php while($row = mysql_fetch_array($result)) { ?>

								<tr>
									<form method="post" >
										<input type="hidden" value="<?php echo $row['id']; ?>">
									</form>

									<td><?php echo strtoupper($row['branch']); ?></td>
									<td><?php echo strtoupper($row['ownersname']); ?></td>
						
									<td>
										<?php

											include("connect.php");
											$suppname = mysql_query("Select * from tbl_givento Where truckid='".$row['id']."'") or die(mysql_error());
											$row_suppname = mysql_fetch_array($suppname);
											include("connect_out.php");
											$sql_supp = mysql_query("SELECT * from supplier_details WHERE supplier_id='".$row_suppname['suppliername']."'") or die (mysql_error());
											$supp_row = mysql_fetch_array($sql_supp);
											echo strtoupper($supp_row['supplier_id'].'_'.$supp_row['supplier_name']);
										?>
									</td>

									<td><?php echo strtoupper($row['class']); ?></td>
									<td><?php echo strtoupper($row['truckplate']); ?></td>
									<td><?php echo strtoupper($row['make']); ?></td>
									<td><?php echo strtoupper($row['series']); ?></td>
									<td><?php echo strtoupper($row['bodytype']); ?></td>
									<td><?php echo strtoupper($row['yearmodel']); ?></td>
									<td><?php echo strtoupper($row['aquisitioncost']); ?></td>
									<td><?php echo strtoupper($row['amount']); ?></td>
									<td><?php echo strtoupper($row['truckcondition']); ?></td>
					
									<td align="center">

										<div class="dropdown">
											<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
												Actions <span class="caret"></span>
											</button>

											<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<li><a href="edit_truck.php?id=<?= $row['id']; ?>&page=existing">View/Edit</a></li>
												<li><a href="assign.php?id=<?= $row['id']; ?>&page=existing">Assign</a></li>
												<li><a href="profile.php?id=<?= $row['id']; ?>&page=existing">Profile</a></li>
												<li><a href="truck_details.php?id=<?= $row['id']; ?>&page=existing">Images</a></li>
												<li><a href="truck_preowned.php?id=<?= $row['id']; ?>&page=existing">Pre-owned</a></li>
											</ul>
										</div>

									</td>
								</tr>

							<?php } ?>
							</tbody>
						</table>
					</td>
				</tr>
			</table>

 			<?php } ?>
			</div>
		</div>
		<?php include('layout/footer.php');?>
	</body>
</html>

