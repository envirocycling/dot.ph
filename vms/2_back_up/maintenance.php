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
        <link rel="stylesheet" href="css/popup.css" />
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
    </head><body>
        <?php
        date_default_timezone_set("Asia/Singapore");
        include('layout/header.php');
        include('connect.php');
        ?>

    <center>
        <div id="body">
            <table id="page1"><tr><td align="left">Maintenance<td></td></table><br/><br/>
            <?php
            $query = "Select * from tbl_truck_report WHERE status=''";
            $result = mysql_query($query) or die(mysql_error());
            ?>	
            <table width="100%">
                <tr>
                    <td>
                        <table  class="data display datatable">    

                            <thead>
                                <tr class="data">
                                    <th class="data">Branch</th>	
                                    <th class="data" style="width:70px;">Plate</th>	
                                    <th class="data">Type</th>
                                    <th class="data">Deployment</th>	
                                    <th class="data" style="width:300px;">Change Oil</th>	
                                    <th class="data" style="width:115px;">Repair</th>	
                                </tr>							
                            </thead>
                            <?php
                            while ($row = mysql_fetch_array($result)) {
                                include("connect_out.php");
                                $sql_supp = mysql_query("SELECT * from supplier_details WHERE supplier_id='" . $row['suppliername'] . "'") or die(mysql_error());
                                $supp_row = mysql_fetch_array($sql_supp);

                                include("connect.php");
                                $oil = mysql_query("Select * from tbl_changeoil Where truckid='" . $row['id'] . "' order by date Desc LIMIT 1") or die(mysql_error());
                                $oil_row = mysql_fetch_array($oil);

                                $repair = mysql_query("Select * from tbl_repair Where truckid='" . $row['id'] . "' order by date Desc LIMIT 1") or die(mysql_error());
                                $repair_row = mysql_fetch_array($repair);

                                $date = date("M d,Y", strtotime($row['oil']));
                                $next = date("M d,Y", strtotime($row['oil_next']));
                                $repair = date("M d,y", strtotime($repair_row['date']));

                                echo '<tr>
											<td class="data">' . strtoupper($row['branch']) . '</td>
											<td class="data">' . strtoupper($row['truckplate']) . '</td>
											<td class="data">' . strtoupper($row['series']) . " - - " . strtoupper($row['bodytype']) . '</td>
											<td class="data">' . strtoupper($supp_row['supplier_id'] . '_' . $supp_row['supplier_name']) . '</td>
											<td class="data">';
                                ?><?php
                                if (($_SESSION['owner'] == $row['branch'] || $_SESSION['owner'] == 'PAMPANGA')) {
                                    echo '<a href="m_changeoil.php?id=' . $row['id'] . '&page=maintenance"><img src="../icon/change_oil.png" height="35px" title="Change Oil" width="40px" style="cursor:pointer;"></a>';
                                }
                                ?><?php
                                if (strtoupper($row['class']) == 'HE') {
                                    echo '<br><b>Prev:</b><span style="text-decoration:underline;font-size:14px;"><b>' . number_format($oil_row['froms']) . ' HRM</b></span>';
                                    echo '<br><b>Next:</b><span style="text-decoration:underline;font-size:14px;"><b>';
                                    echo 'Engine:'.number_format($row['engine_oil']).' &nbsp;&nbsp;ATF:'.number_format($row['atf']).' &nbsp;&nbsp;Gear:'.number_format($row['gear_oil']).'&nbsp;&nbsp; Hydraulic:'.number_format($row['hydraulic_oil']).' &nbsp;&nbsp;Coolant:'.number_format($row['coolant']);
                                    echo'</b></span>';
                                } else {
                                    if (!empty($row['oil'])) {
                                        echo '<b>Prev:</b><span style="text-decoration:underline;font-size:14px;"><b>' . $date . '</b></span>';
                                    }if (!empty($row['oil'])) {
                                        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Next:</b><span style="text-decoration:underline;font-size:14px;font-weight:bold;">' . $next;
                                    }
                                }
                                echo '</span></td>
											<td class="data">';
                                ?><?php
                                if (($_SESSION['owner'] == $row['branch'] || $_SESSION['owner'] == 'PAMPANGA')) {
                                    echo '<a href="m_repair.php?id=' . $row['id'] . '&page=maintenance"><img src="../icon/repair.png" height="35px" title="Repair" width="40px" style="cursor:pointer;"></a>';
                                }
                                ?><?php echo '&nbsp;&nbsp;&nbsp;<span style="text-decoration:underline;font-size:14px;font-weight:bold;">'; ?><?php
                                if ($repair_row['date']) {
                                    echo $repair;
                                }echo '</span></td>
									</tr>';
                            }
                            $date = date('Y-m-d');
                            $select_date = mysql_query("Select * from tbl_truck_report Where (oil_next <= '$date' or oil_next='') and branch LIKE '%" . $_SESSION['owner'] . "%' and status='' and class !='HE'") or die(mysql_error());
                            ?>
                        </table>	
                    </td>
                </tr>
            </table>	
        </div>
        <?php include('layout/footer.php'); ?>
    </center>
</body>
</html>
<?php
if (mysql_num_rows($select_date) > 0) {
    ?>
    <link rel="stylesheet" href="css/zebra_dialog.css" type="text/css">
    <script type="text/javascript" src="js/zebra_dialog.js"></script>
    <script type="text/javascript">
            $(document).ready(function () {
                new $.Zebra_Dialog('<strong>Maintenance</strong><br><br>', {
                    source: {'iframe': {
                            'src': 'need_changeoil.php',
                            'height': 350
                        }},
                    width: 800,
                    title: 'Need To Change Oil'
                });
            });
    </script>
<?php }
?>