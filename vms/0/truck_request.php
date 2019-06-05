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
        <script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();
                var _filter = "<?php echo @$_POST['status'];?>";
                $.each($('[name=status] option'), function(){
                    var _thisVal = this.value;
                    if(_thisVal === _filter){
                        $(this).prop('selected', true);
                    }
                });
                
                $('button').click(function(){
                    var name = this.name;
                    var _id = this.value;
                    if(name === 'view'){
                        window.open('truck_request_view.php?id=' + _id, '_blank');
                    }else if (name === 'edit'){
                        location.replace('truck_request_form_edit.php?id=' + _id);
                    }
                });
            });
        </script>
    </head>
    <body>
    <html>

        <?php include('layout/header.php'); ?>
        <center>
            <div id="body">
                <?php include('connect.php'); ?>

                <table id="page1"><tr><td align="left">Existing Vehicles<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
                <br />

                <center>
                    <form action="truck_request_form.php">
<!--                        <table width="100%" >
                            <tr align="center">
                                <td ><button name="btnTruckRequest"><img src="../icon/truck_request.png" width="50px"><br>Truck Request Form</button></td>
                            </tr>
                            <tr>
                            <td></td>
                            </tr>
                        </table>-->
                    </form>
                    <br /><br />
                    <form method="post">
                        <div style="float:right;">
                            <select name="status">
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Disapproved">Disapproved</option>
                            </select>
                            <input type="submit" value="Submit" name="submit">
                        </div>
                    </form>
                    <table width="100%">
                        <tr>
                            <td>
                                <table  class="data display datatable">    
                                    <thead>
                                        <tr class="data">
                                            <th class="data">Date Submitted</th>
                                            <th class="data">Branch</th>
                                            <th class="data">Supplier Name</th>
                                            <th class="data">Warehouse Address</th>
                                            <th class="data">Contact No</th>
                                            <th class="data">Status</th>
                                            <th class="data">Action</th>	
                                        </tr>
                                    </thead>
                                    <?php
                                    if (!isset($_POST['submit'])) {
                                        $sql_truckRequest = mysql_query("SELECT * from tbl_truckrequest WHERE status LIKE '%pending%'") or die(mysql_error());
                                    } else {
                                        $sql_truckRequest = mysql_query("SELECT * from tbl_truckrequest WHERE status LIKE '%" . $_POST['status'] . "%'") or die(mysql_error());
                                    }
                                    while ($row_truckRequest = mysql_fetch_array($sql_truckRequest)) {
                                        echo '<tr>
                                                <td>' . date('Y/m/d', strtotime($row_truckRequest['date'])) . '</td>
                                                <td>' . strtoupper($row_truckRequest['branch']) . '</td>
                                                <td>' . strtoupper($row_truckRequest['supplier_id'] . '_' . $row_truckRequest['supplier_name']) . '</td>
                                                <td>' . strtoupper($row_truckRequest['address']) . '</td>
                                                <td>' . strtoupper($row_truckRequest['contact_no']) . '</td>
                                                <td>' . strtoupper($row_truckRequest['status']) . '</td>';
                                                if($row_truckRequest['status'] == 'approved' || $row_truckRequest['status'] == 'disapproved' || $row_truckRequest['status'] == 'cancelled'){
                                                    echo '<td><button name=view value="'.$row_truckRequest['id'].'">View</button></td>';
                                                }else{
                                                    echo '<td><button name=view value="'.$row_truckRequest['id'].'">View</button> | <button name=edit value="'.$row_truckRequest['id'].'">Edit</button></td>';
                                                }
                                            echo '</tr>';
                                    }
                                    ?>

                                </table>
                            </td>
                        </tr>
                    </table>
                    </br></br>

            </div>
        </center>
        <?php include('layout/footer.php'); ?>
    </body>
</html>

