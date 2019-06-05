<?php
session_start();
include './../config.php';

if (!isset($_SESSION["username"])) {
    echo "<script>
    location.replace('./../index.php');
    </script>";
}

$username = $_SESSION['username'];
$start_date = '';
$end_date = '';
$branch = '';
$_date = '';


if(isset($_POST['filter'])) {

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $_date = $start_date . ' - ' . $end_date;
    $branch = $_POST['branch'];

    if($branch == 'all') {
      $queryString = "SELECT * FROM outgoing_pss WHERE date >= '$start_date' and date <= '$end_date';";

      $queryStrGrade = "SELECT wp_grade,COUNT(*) as count FROM outgoing_pss WHERE date >= '$start_date' and date <= '$end_date' GROUP BY wp_grade ORDER BY count DESC;";
    }else {
      $queryString = "SELECT * FROM outgoing_pss WHERE (date >= '$start_date' and date <= '$end_date') and branch LIKE '%$branch%';";

      $queryStrGrade = "SELECT wp_grade,COUNT(*) as count FROM outgoing_pss WHERE (date >= '$start_date' and date <= '$end_date') and branch LIKE '%$branch%' GROUP BY wp_grade ORDER BY count DESC;";
    }

}else {
    $_date = date('Y/m/d');

    $start_date = $_date;
    $end_date = $_date;

    $queryString = "SELECT * FROM outgoing_pss WHERE date='$_date';";

    $queryStrGrade = "SELECT wp_grade,COUNT(*) as count FROM outgoing_pss WHERE date='$_date' GROUP BY wp_grade ORDER BY count DESC;";
}


$outgoing_query = mysql_query($queryString);

$branch_query = mysql_query("SELECT * FROM branches;");

$grade_query = mysql_query($queryStrGrade);

$title_table = "Incoming as of $_date";


if(isset($_POST['locationSubmit'])) {

  $log_id = $_POST['log_id'];
  $location = $_POST['location'];

  $queryLocationStr = "UPDATE outgoing_pss set location='$location' WHERE log_id='$log_id';";
  mysql_query($queryLocationStr) or die(mysql_error());
  
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IMS - PSS</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">




</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PIMS</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <h1 class="h3 mr-auto mb-2 text-gray-800">Booking System (IMS)</h1>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username; ?></span>
                <img class="img-profile rounded-circle" src="./img/efi_ico.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


           <!-- Page Heading -->
           <h1 class="h3 mb-2 text-gray-800">Incoming</h1>
        
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Filtering Option</h6>
                </div>
                <div class="card-body">
                    <form action="index.php" class="form-inline" method="POST">
                        <span style="margin-right: 10px;">Start Date:</span>
                        <input name="start_date" id="startDate" value="<?php echo $start_date; ?>" width="200" required  />

                        <span style="margin: 0px 10px 0px 10px;">End Date:</span>
                        <input name="end_date" id="endDate" value="<?php echo $end_date; ?>" width="200" required  />

                        <span style="margin: 0px 10px 0px 10px;">Branch:</span>
                        <select name="branch" class="form-control" required>
                            <option value="all">All</option>
                            <?php while($row_branch = mysql_fetch_array($branch_query)): ?>
                            <option <?php echo ($branch == $row_branch['branch_name']) ? 'selected' : '';  ?> value="<?php echo $row_branch['branch_name']; ?>"><?php echo $row_branch['branch_name']; ?></option>
                            <?php endwhile; ?>
                        </select>

                        <span style="margin: 0px 10px 0px 10px;"></span>
                        <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                    </form>
                
                </div>
            </div>
        
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">INCOMING WP SUMMARY (IN-TRANSIT)</h6>
                </div>
                <div class="card-body">
                  <table class="table-bordered text-center">

                    <?php $total = 0; ?>
                  
                    <?php while($row_grade = mysql_fetch_array($grade_query)): ?>
                      <tr>
                        <td width="100px"><?php echo strtoupper($row_grade['wp_grade']); ?></td>
                        <td width="50px">
                          <?php
                            $c = (int)$row_grade['count'];
                            $total = $total + $c;

                            echo $c;
                          ?>
                        </td>
                      </tr>
                    <?php endwhile;?>

                    <tr>
                      <th class="bg-gradient-success text-white">Total</th>
                      <td class="bg-gradient-success text-white"><?php echo $total; ?></td>
                    </tr>
               

                  </table>
                </div>
            </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $title_table; ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Str</th>
                      <th>Date</th>
                      <th>Trucking</th>
                      <th>Plate #</th>
                      <th>Grade</th>
                      <th>Weight</th>
                      <th>Branch</th>
                      <th>Time Out</th>
                      <th>ETA</th>
                      <th>Location</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php while($row = mysql_fetch_array($outgoing_query)): ?>
                    <tr>
                      <td><?php echo $row['str']; ?></td>
                      <td><?php echo $row['date']; ?></td>
                      <td><?php echo $row['trucking']; ?></td>
                      <td><?php echo $row['plate_number']; ?></td>
                      <td><?php echo $row['wp_grade']; ?></td>
                      <td><?php echo $row['weight']; ?></td>
                      <td><?php echo $row['branch']; ?></td>
                      <td><?php echo $row['time_out']; ?></td>
                      <td><?php echo $row['eta']; ?></td>
                      <td><?php echo $row['location']; ?></td>
                      <td>
                          <button data-toggle="modal" data-target="#locationModal" data-id="<?php echo $row['id']; ?>" class="btn btn-success btn-sm" id="location" >Assign Location</button>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; EFI 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Location Modal -->
  <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form action="add_location.php" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Assign Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input name="log_id" type="hidden" id="locationID">
            <input name="location" type="text" class="form-control" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="locationSubmit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
      
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="./../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

  <!-- Bootstrap daterange -->
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <script>

    $(function() {
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
            format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
        $('#endDate').datepicker({
            format: 'yyyy/mm/dd',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome'
        });
    });
       
    </script>

    <script>
      var btnLocationAll = document.querySelectorAll('#location');
      var locationID = document.querySelector('#locationID');

      btnLocationAll.forEach(function(btn) {
        btn.addEventListener('click',function(e) {

          var id = btn.dataset.id;

          locationID.value = id;
          
        })
      });

      
    </script>

</body>

</html>
