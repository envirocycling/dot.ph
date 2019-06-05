<!doctype html>
<html lang=''>
    <head>
        <title>Vehicle Management System</title>
        <meta charset='utf-8'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/header.js" type="text/javascript"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
        <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
        <script src="js/facebox.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();
            });
        </script>
        <link href="css/select2.min.css" rel="stylesheet">
        <link href="css/tables.css" rel="stylesheet">

    </head>
    <body>
    <html>

    </script>
    <?php include('layout/header.php'); ?>
    <center>
        <div id="body">

            <table id="page1"><tr><td align="left">Terminated Contract<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
            <br />

            <?php
            include('connect.php');


            $sql_contract = mysql_query("SELECT * from tbl_contract WHERE 3_noti='0'") or die(mysql_error());
            while ($row_contract = mysql_fetch_array($sql_contract)) {

                mysql_query("UPDATE tbl_contract SET 3_noti='1' WHERE id='" . $row_contract['id'] . "'") or die(mysql_error());
            }
            ?>
            <?php //startofcode===========================================================================?>
            <br /><br />
            <?php $select = mysql_query("Select * from tbl_contract Where status LIKE 'pending%' Order by id Asc")or die(mysql_error()); ?>
            <table width="80%"  align="center">
                <tr>
                    <td>
                        <table  class="CSSTableGenerator">
                            <td>Branch</td>
                            <td>Suppliername</td>
                            <td>Plate No.</td>
                            <td>Description</td>
                            <td>Status</td>
                </tr>
<?php
while ($row_select = mysql_fetch_array($select)) {
    include('connect.php');
    $truck = mysql_query("SELECT * from tbl_truck_report WHERE id = '" . $row_select['truck_id'] . "' Order by branch Asc") or die(mysql_error());
    $row_truck = mysql_fetch_array($truck);

    include 'connect_out.php';
    $sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id = '" . $row_truck['suppliername'] . "' ") or die(mysql_error());
    $row_supplier = mysql_fetch_array($sql_supplier);
    echo '<tr>
                        <td>' . $row_truck['branch'] . '</td>
                        <td>' . $row_supplier['supplier_name'] . '</td>
                        <td>' . $row_truck['truckplate'] . '</td>
                        <td>' . $row_select['description'] . '</td>
                        <td>';
    echo ucwords($row_select['status']);
    if ($row_select['status'] == 'approved by gm') {
        echo '&nbsp;&nbsp;<u><i>Click Here</i></u>';
    }
    echo '</td>
                 </tr>';
}
?>
            </table>
            </td>
            </tr>
            </table>
            <br /><br /><br /><br />
            <h3>Terminated Contract</h3>
            <?php
            include('connect.php');
            $sql_contractlist = mysql_query("SELECT * from tbl_assigntosupp_history ") or die(mysql_error());
            ?>
            <table width="100%">
                <tr>
                    <td>
                        <table  class="data display datatable">    

                            <thead>
                                <tr class="data">
                                    <th class="data">Date</th>
                                    <th class="data">Branch</th>
                                    <th class="data">Supplier Name</th>
                                    <th class="data">Plate Number</th>
                                    <th class="data">Action</th>	
                                </tr>
                            </thead>
                            <?php
                            while ($row_contractlist = mysql_fetch_array($sql_contractlist)) {
                                include('connect.php');
                                $sql_vehicle = mysql_query("SELECT * from tbl_truck_report WHERE id = '" . $row_contractlist['truckid'] . "'") or die(mysql_error());
                                $row_vehicle = mysql_fetch_array($sql_vehicle);

                                $sql_branch = mysql_query("SELECT * from tbl_branches WHERE branch_name LIKE '%" . $row_vehicle['branch'] . "%'") or die(mysql_error());
                                $row_branch = mysql_fetch_array($sql_branch);

                                include 'connect_out.php';
                                $sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id = '" . $row_contractlist['suppliername'] . "' ") or die(mysql_error());
                                $row_supplier = mysql_fetch_array($sql_supplier);

                                if (mysql_num_rows($sql_vehicle) > 0) {
                                    echo '<tr>
                                <td class="data">' . $row_contractlist['date'] . '</td>
                                <td class="data">' . $row_vehicle['branch'] . '</td>
                                <td class="data">' . $row_supplier['supplier_id'] . '_' . $row_supplier['supplier_name'] . '</td>
                                <td class="data">' . $row_vehicle['truckplate'] . '</td>
                                <td class="data"><a href="' . $row_branch['url'] . 'user-login/ap/truck_return_form.php?vms_id=' . $row_vehicle['id'] . '"><button>Truck Return Form</button></a></td>
                            </tr>';
                                }
                            }
                            ?>
                        </table>
                    </td> 
                </tr>
            </table>

            <?php //endtofcode=========================================================================== ?>

        </div>
    </center>
    <?php include('layout/footer.php'); ?>
</body>
</html>