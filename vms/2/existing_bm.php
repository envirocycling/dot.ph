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

				$('#bm_datatables').DataTable();

				$('#terminate').on('click', (e) => {

					var id = $('#terminate').data('id');
					
					$('#modal-id').val(id);

				});

			});



		</script>

	</head>

<body>

<?php include('layout/header.php'); ?>

<div class="container">
	<div class="row">
		<div class="col col-xm-12">
			
			<?php include('connect.php');

			$records_per_page = 200;
			(@!$_GET['start'])?$start=0 : $start = $_GET['start'];

			$query = 'SELECT count(*) FROM tbl_bm_report';
			$result = mysql_query($query) or die("Error in query : $query".mysql_error());
			$row = mysql_fetch_row($result);
			$total_records = $row[0];

			if(($total_records > 0) && ($start < $total_records)) {

				if(isset($_POST['submit'])) {
					$search = $_POST['search'];
					$query = "Select * from tbl_bm_report Where series_no LIKE '%$search%' or branch LIKE '%$search%' or owner_name LIKE '%$search%' or cash_bond LIKE '%$search%' or date_purchased LIKE '%$search%' or date_release LIKE '%$search%' ORDER BY branch ASC LIMIT $start,$records_per_page";
				}else {

					$branch = $_SESSION['owner'];
					$query = "SELECT * FROM tbl_bm_report WHERE branch = '$branch' ORDER BY branch ASC LIMIT $start,$records_per_page";
		        }

				$result = mysql_query($query) or die(mysql_error());
				$count = 1;
			?>

			<table id="page1" style="margin-bottom: 50px;">
				<tr>
					<td align="left">Existing Baling Machine<br /></td>
					<td align="right"><span id="back" onClick="backed();">Back</span></td>
				</tr>
			</table>

			<table id="bm_datatables" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Branch</th>
						<th>Owner's Name</th>
						<th>Supplier Name</th>
						<th>Series Number</th>
						<th>Aquisition Cost</th>
						<th>Cash Bond</th>
						<th>Quota</th>
						<th>BM Condition</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
				<?php while($row=mysql_fetch_array($result)) { ?>
				    <tr>
						<form method="post" >
							<input type="hidden" value="<?php echo $row['id']; ?>">
						</form>

						<td><?php echo strtoupper($row['branch']); ?></td>
						<td><?php echo strtoupper($row['owner_name']); ?></td>

						<td>
						<?php

						if($row['supplier_name'] && $row['supplier_name'] != '') {

							$supplierName = strtoupper($row['supplier_name']);
							$rowSupplierName = $supplierName;
							$rowCashBond = $row['cash_bond'];
							$rowQuota = $row['quota'];

						}else {

							$rowSupplierName = '---';
							$rowCashBond = '---';
							$rowQuota = '---';

						}

						echo $rowSupplierName;

						?>
						</td>

						<td><?php echo strtoupper($row['series_no']); ?></td>
					    <td><?php echo $row['aquisition_cost']; ?></td>
					    <td><?php echo $rowCashBond; ?></td>
						<td><?php echo $rowQuota; ?></td>
						<td><?php echo strtoupper($row['condition']); ?></td>

						<td>
							<?php if($row['status'] == 'assigned'): ?>
							<span class="label label-success">Active</span>
							<?php else: ?>
							<span class="label label-danger">Inactive</span>
							<?php endif; ?>	
						</td>

						<!-- Action button -->
						<td align="center">
							<div class="dropdown">

								<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
									Actions <span class="caret"></span>
								</button>

								<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<li><a href="edit_bm.php?id=<?= $row['id']; ?>&page=existing" >View/Edit</a></li>

									<?php if($row['status'] == '' || $row['status'] == 'terminated'): ?>
									<li><a href="assign_bm.php?id=<?= $row['id']; ?>&page=existing" >Assign</a></li>
									<?php else: ?>
									<li><a href="#" id="terminate" data-toggle="modal" data-target="#myModal" data-id="<?= $row['id']; ?>" style="color: red !important;">Terminate</a></li>
									<li><a href="update_bm_owner.php?id=<?= $row['id']; ?>&page=existing" >View/Update Owner</a></li>
									<?php endif; ?>
								</ul>

							</div>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php } else { ?>
			<table id="page1" style="margin-bottom: 50px;">
				<tr>
					<td align="left">Existing Baling Machine<br /></td>
					<td align="right"><span id="back" onClick="backed();">Back</span></td>
				</tr>
			</table>

			<table id="bm_datatables" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Branch</th>
						<th>Owner's Name</th>
						<th>Supplier Name</th>
						<th>Series Number</th>
						<th>Aquisition Cost</th>
						<th>Cash Bond</th>
						<th>Quota</th>
						<th>BM Condition</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					
				</tbody>
			</table>
			<?php }?>	
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="terminate_bm.php" method="POST">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Terminate</h4>
      		</div>

      		<div class="modal-body">
      			<input type="hidden" id="modal-id" name="id" class="form-control" readonly>
      			<div class="form-group">
	      			<label for="">Date</label>
	      			<input type="text" value="<?= date('y/m/d'); ?>" name="date" class="form-control" readonly>
	      		</div>

	      		<div class="form-group">
	      			<label for="remarks">Remarks/Reason</label>
	      			<textarea name="remarks" class="form-control"></textarea>
	      		</div>
      		</div>

	      	<div class="modal-footer">
	        	<button type="submit" class="btn btn-danger" >Terminate BM</button>
	      	</div>
    	</div>
	</form>

  </div>
</div>


<?php include('layout/footer.php');?>
</body>
</html>

