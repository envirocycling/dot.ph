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
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/setup.js" type="text/javascript"></script>
        <script src="js/select2.min.js" type="text/javascript"></script>
        <link href="css/select2.min.css" rel="stylesheet">
        <link href="css/tables.css" rel="stylesheet">
        <script>
            $(document).ready(function () {
                var _just = JSON.parse($('[name=spnJust]').text());
                $.each(_just, function () {
                    var _append = '<li>' + this.value + '</li>';
                    $('[name=spnJustPer]').append(_append);
                });
            });
        </script>
        <style>
            button:hover{
                cursor: pointer;
            }
            .tblTruckRequest{
                border-collapse: collapse;
                text-align: center;
            }
            textArea{
                resize: none;
            }
            table{
                text-transform: uppercase;
            }
            .span{
                text-align: left;
                text-indent: 30px;
            }
        </style>

    </head>
    <body>
    <html>
        <script type="text/javascript" src="js/jquery.min.js"></script>

    </script>
    <center>
        <div id="body">
            <br />

            <?php
            //startofcode===========================================================================  
            include('connect.php');
            $sql_truckrequest = mysql_query("SELECT * from tbl_truckrequest WHERE id='" . $_GET['id'] . "'") or die(mysql_error());
            $row_truckrequest = mysql_fetch_array($sql_truckrequest);

            $sql_truck = mysql_query("SELECT * from tbl_truck_report WHERE id='" . $row_truckrequest['tr_id'] . "'") or die(mysql_error());
            $row_truck = mysql_fetch_array($sql_truck);
            
            $sql_prepared = mysql_query("SELECT * from tbl_users WHERE id='".$row_truckrequest['prepared_by']."'") or die(mysql_error());
            $row_prepared = mysql_fetch_array($sql_prepared);
            
            $sql_approved = mysql_query("SELECT * from tbl_users WHERE id='".$row_truckrequest['approved_by']."'") or die(mysql_error());
            $row_approved = mysql_fetch_array($sql_approved);

            $exVolume = explode(',', $row_truckrequest['volume_summary']);
            $f = explode('=', $exVolume[0]);
            $s = explode('=', $exVolume[1]);
            $t = explode('=', $exVolume[2]);
            $avg = round(($f[1] + $s[1] + $t[1]) / 3);
            $addVol = round($row_truckrequest['commitment'] - $avg);

            include('connect_out.php');
            $sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id = '" . $row_truckrequest['supplier_id'] . "'") or die(mysql_error());
            $row_supplier = mysql_fetch_array($sql_supplier);
            ?>
            <br />
            <center>
                <table class="tblTruckRequest" border>
                    <tr>
                        <td colspan="7"><h2>Truck Request Form<h2></td>
                                    </tr>
                                    <tr>
                                        <td><h4>Junkshop Name:<h4></td>
                                                    <td colspan="6">
                                                        <span name="spnJunkshopname"><h3><?php echo $row_supplier['supplier_name']; ?><h3></span>
                                                                    </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><h4>ID No:<h4></td>
                                                                                    <td colspan="6"><span name="spnIdNo"><h3><?php echo $row_supplier['supplier_id']; ?><h3></span></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><h4>Warehouse Address:<h4></td>
                                                                                                                    <td colspan="6"><span name="spnWarehouseAddress"><h3><?php echo $row_truckrequest['address']; ?><h3></span></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td><h4>Contact No:<h4></td>
                                                                                                                                                    <td colspan="6"><span name="spnContactNo"><h3><?php echo $row_truckrequest['contact_no']; ?><h3></span></td>
                                                                                                                                                                    </tr>
                                                                                                                                                                    <tr>
                                                                                                                                                                        <td><h4>Volume Summary<h4></td>
                                                                                                                                                                                    <td><span name="spnFirst"><h5><?php echo $f[0]; ?><h5></span></td>
                                                                                                                                                                                                    <td><span name="spnSecond"><h5><h5><?php echo $s[0]; ?></span></td>
                                                                                                                                                                                                        <td><span name="spnThird"><h5><?php echo $t[0]; ?><h5></span></td>
                                                                                                                                                                                                        <td><span name="spnAvg"><h5><h5>AVG</span></td>
                                                                                                                                                                                                        <td><span name="spnCommitment"><h5>Commitment<h5></span></td>
                                                                                                                                                                                                        <td><span name="spnAddVol"><h5>Add'l Vol<h5></span></td>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Total<h4></td>
                                                                                                                                                                                                        <td><span name="spnFirstVal"><h3><?php echo $f[1]; ?><h3></span></td>
                                                                                                                                                                                                        <td><span name="spnSecondVal"><h3><?php echo $s[1]; ?><h3></span></td>
                                                                                                                                                                                                        <td><span name="spnThirdVal"><h3><?php echo $t[1]; ?><h3></span></td>
                                                                                                                                                                                                        <td><span name="spnAvgVal"><h3><?php echo $avg; ?></h3></span></td>
                                                                                                                                                                                                        <td><span name="spnCommitmentVal"><h3><?php echo $row_truckrequest['commitment']; ?></h3></td>
                                                                                                                                                                                                        <td><span name="spnAddVolVal"><h3><?php echo $addVol; ?></h3></span></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Truck Request<h4></td>
                                                                                                                                                                                                        <td colspan="6"><h3><?php echo $row_truckrequest['truck_request']; ?></h3></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Justification<h4></td>
                                                                                                                                                                                                        <span name="spnJust" hidden><?php echo $row_truckrequest['justification']; ?></span>
                                                                                                                                                                                                        <td colspan="6"><h5><span name="spnJustPer" class="span"><?php echo $row_truckrequest['justification']; ?></span></h5></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Plate No.<h4></td>
                                                                                                                                                                                                        <td colspan="6"><h3><?php echo $row_truck['truckplate']; ?></h3></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Truck Cost<h4></td>
                                                                                                                                                                                                        <td colspan="6"><h3><?php echo '&#8369;' . number_format($row_truckrequest['truck_cost'], 2); ?></h3></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Monthly Payment & Duration:<h4></td>
                                                                                                                                                                                                        <td colspan="6"><h3><?php echo '&#8369;' . number_format($row_truckrequest['amortization'], 2) . ' in ' . $row_truckrequest['mo_amortization'] . ' months'; ?></h3></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Monthly Cash Bond & Duration:<h4></td>
                                                                                                                                                                                                        <td colspan="6"><h3><?php echo '&#8369;' . number_format($row_truckrequest['cashbond'], 2) . ' in ' . $row_truckrequest['mo_cashbond'] . ' months'; ?></h3></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        </table>
                                                                                                                                                                                                        <br/><br/><br/>
                                                                                                                                                                                                        <table width="90%">
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td>Prepared by:
                                                                                                                                                                                                            <?php 
                                                                                                                                                                                                            if($row_truckrequest['status'] != 'disapproved'){
                                                                                                                                                                                                                echo '<br><img src="../signature/'.$row_prepared['signature'].'" width="60px">';
                                                                                                                                                                                                            }else{
                                                                                                                                                                                                                echo '<br/>';
                                                                                                                                                                                                            }
                                                                                                                                                                                                            echo '<br/>';
                                                                                                                                                                                                            echo strtoupper($row_prepared['Name']);
                                                                                                                                                                                                            ?>
                                                                                                                                                                                                        </td>
                                                                                                                                                                                                        <td>Approved by: <?php
                                                                                                                                                                                                        if($row_truckrequest['status'] == 'approved'){
                                                                                                                                                                                                                echo '<br><img src="../signature/'.$row_approved['signature'].'" width="120px">';
                                                                                                                                                                                                            }else{
                                                                                                                                                                                                               echo '<br/>'; 
                                                                                                                                                                                                            }
                                                                                                                                                                                                            echo '<br/>';
                                                                                                                                                                                                        echo strtoupper($row_approved['Name']);
                                                                                                                                                                                                        ?></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        </table>
                                                                                                                                                                                                        <br/><br/><br/><br/>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        </center>
                                                                                                                                                                                                        </body>
                                                                                                                                                                                                        </html>