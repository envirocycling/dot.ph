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
            jQuery(document).ready(function ($) {
                $('a[rel*=facebox]').facebox({
                    loadingImage: '../src/loading.gif',
                    closeImage: '../src/closelabel.png'
                });
            });
        </script>
        <link href="css/select2.min.css" rel="stylesheet" />
        <link href="css/table.css" rel="stylesheet">

    </head>
    <body>
    <html>
        <script type="text/javascript" src="js/jquery.min.js"></script>

    </script>
    <?php include('layout/header.php'); ?>
    <center>
        <div id="body">
            <table id="page1"><tr><td align="left">Maintenance: Change Oil<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
            <?php
            include('connect.php');
            $plate = mysql_query("Select * from tbl_truck_report Where id ='" . $_GET['id'] . "'") or die(mysql_error());
            $plate_row = mysql_fetch_array($plate);
            ?>
            <br />
            <br />
            <?php
            $sql_coSet = mysql_query("SELECT * from tbl_truck_report WHERE id = '".$_GET['id']."' and coSet > 0 ");
            $row_coSet = mysql_fetch_array($sql_coSet);

            $sql_coSched = mysql_query("SELECT * from tbl_changeoilset WHERE id='" . $row_coSet['coSet'] . "'") or die(mysql_error());
            echo '<table border="1">';
            echo '<tr>
                    <td colspan="6"><center><b>HRM CHANGE OIL SCHEDULE</b></center></td>
                </tr>';
            echo '<tr>
                    <td>Set</td>
                    <td>Engine Oil</td>
                    <td>ATF</td>
                    <td>Gear Oil</td>
                    <td>Hydraulic Oil</td>
                    <td>Coolant</td>';
            echo '</tr>';
            $row_coSched = mysql_fetch_array($sql_coSched);
            echo '<tr>';
            echo '<td>' . strtoupper($row_coSched['set']) . '</td>';
            echo '<td>' . number_format($row_coSched['engine_oil']) . '</td>';
            echo '<td>' . number_format($row_coSched['atf']) . '</td>';
            echo '<td>' . number_format($row_coSched['gear_oil']) . '</td>';
            echo '<td>' . number_format($row_coSched['hydraulic_oil']) . '</td>';
            echo '<td>' . number_format($row_coSched['coolant']) . '</td>';
            echo '</tr>';
            echo '</table>';
            ?>
            <center>
                <table  width="70%">
                    <tr>
                        <td><br /><br /><font size="+1"><b>Plate No. <?php echo "<font style='text-decoration:underline'>" . $plate_row['truckplate'] . "</font>"; ?></b></font></td>
                        <td align="right"><br /><br /><a href="m_changeoilupdate.php?id=<?php echo $plate_row['id'] . '&class=' . $plate_row['class']; ?>" rel="facebox"><input type="button" value="Record Change Oil"></a></td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="CSSTableGenerator">
                                <tr>
                                    <td rowspan="1">Date</td>
                                    <td rowspan="1">Performed By</td>
                                    <td colspan="3" rowspan="1" width="40%">Km Reading</td>
                                    <td rowspan="1">Remarks</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><h4>From</h4></td>
                                    <td><h4>To</h4></td>
                                    <td><h4>Total Travel</h4></td>
                                    <td></td>

                                </tr>

                                <?php
                                $oil = mysql_query("Select * from tbl_changeoil Where truckid='" . $_GET['id'] . "' Order by date Desc") or die(mysql_error());
                                while ($row = mysql_fetch_array($oil)) {
                                    ?>
                                    <tr>
                                        <td width="20%"><?php echo date('F d, Y', strtotime($row['date'])); ?></td>
                                        <td><?php echo $row['performedby']; ?></td>
                                        <td><?php echo $num1 = $row['froms']; ?></td>
                                        <td><?php echo $num2 = $row['tos']; ?>
                                        </td>
                                        <td><?php
                                            if (!empty($row['tos'])) {
                                                $total = $num2 - $num1;
                                                echo $total;
                                            }
                                            ?></td>
                                        <td><?php echo $row['remarks']; ?></td>
                                    </tr>    

                                    <?php
                                }
                                ?>

                            </table>
                        </td>
                    </tr>
                </table>
            </center>
            <br />
        </div>
    </center>
    <?php include('layout/footer.php'); ?>
</body>
</html>