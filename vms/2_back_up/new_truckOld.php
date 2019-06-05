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
        <link rel="stylesheet" href="validation/bootstrap.css"/>
        <script type="text/javascript" src="validation/jquery.min.js"></script>
        <script type="text/javascript" src="validation/formValidation.js"></script>
        <script type="text/javascript" src="validation/bootstrap.js"></script>
        <script type="text/javascript" src="validation/form_validation.js"></script>
        <script>
            $(document).ready(function () {
                $('[name="class"]').change(function () {
//                    $('#tbl_soSched').hide();
                    var selected = this.value;
                    if (selected === 'HE') {
                        $('#tbl_soSched').show();
                        $('#trSoSched').show();
                    }
                });
            })
        </script>
    </head>
    <body>
    <html>
        <style>
            #success_message{ display: none;}
        </style>
        <?php
        include('layout/header.php');
        include('../connect_out.php');
        ?>

        <center>
            <div id="body">
                <table id="page1"><tr><td align="left">Vehicle's Info<td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table><br />
                <div id="tbl_soSched" hidden>
                    <?php
                    $sql_coSched = mysql_query("SELECT * from tbl_changeoilset") or die(mysql_error());
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
                    while ($row_coSched = mysql_fetch_array($sql_coSched)) {
                        echo '<tr>';
                        echo '<td>' . strtoupper($row_coSched['set']) . '</td>';
                        echo '<td>' . number_format($row_coSched['engine_oil']) . '</td>';
                        echo '<td>' . number_format($row_coSched['atf']) . '</td>';
                        echo '<td>' . number_format($row_coSched['gear_oil']) . '</td>';
                        echo '<td>' . number_format($row_coSched['hydraulic_oil']) . '</td>';
                        echo '<td>' . number_format($row_coSched['coolant']) . '</td>';
                        echo '</tr>';
                    }
                    echo '</table><br /><br />';
                    ?>
                </div>
                <br />
                <center>



                    <form id="defaultForm" method="post" class="form-horizontal" action="save_new_truck.php">
                        <table width="100%" align="center">
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Branch<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="branch" value="<?php echo ucwords($_SESSION['owner']) ?>" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Owner's Name<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Envirocycling Fiber Inc" name="ownersname" />
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Plate No.<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="text" name="truckplate" autocomplete="off" />
                                    </div>
                                </div>
                            </td>
                            <td> 
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Registration Month<span class="required">*</span></label>
                                    <div class="col-sm-5">
                                        <select name="ending" class="form-control selectpicker" >
                                            <option value=" " >Please Select</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Make</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="make" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Series</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="series" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Body Type<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="bodytype" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Wheels<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="wheels" class="form-control selectpicker" >
                                                <option value=" " >Please Select</option>
                                                <option  value="2">2</option>
                                                <option  value="4">4</option>
                                                <option  value="6">6</option>
                                                <option  value="10">10</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Year Model</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="yearmodel" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Class<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="class" class="form-control selectpicker" >
                                                <option value=" " >Please Select</option>
                                                <option  value="COMPANY">Company Service</option>
                                                <option  value="TRUCK">Truck</option>
                                                <option  value="HE">Heavy Equipment</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr id="trSoSched" hidden>
                                <td>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Change Oil Schedule<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <select name="soSched" class="form-control selectpicker" required>
                                                <!--<option value=""></option>-->
                                                <?php
                                                $sql_coSched3 = mysql_query("SELECT * from tbl_changeoilset") or die(mysql_error());
                                                while ($row_cos = mysql_fetch_array($sql_coSched3)) {
                                                    echo '<option value="' . $row_cos['id'] . '">Set ' . strtoupper($row_cos['set']) . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Aquisition Cost (Php)<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="aquisitioncost" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Net Book Value (Php)</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="netbookvalue" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Amount<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="amount" />
                                        </div>
                                    </div>
                                </td>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vehicle Condition<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <textarea class="form-control" name="truckcondition"></textarea>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td> 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Date Purchased<span class="required">*</span></label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" name="date" placeholder="YYYY/MM/DD" autocomplete="off" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                        </table>
                        <br />
                        <br />
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary">Save New Vehicle</button>
                            </div>
                        </div>
                    </form>
                    <br /><br />
            </div>

<?php include('layout/footer.php'); ?>
        </center>
    </body>
</html>

