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
        <script type="text/javascript">
            $(document).ready(function () {
                $('[name=plateNo]').hide();
                $('[name=btnSubmit]').prop('disabled', true);
                $('input[type=number]').prop('disabled', true);
                $('input[type=radio]').prop('disabled', true);
                $('textarea').prop('disabled', true);
                $('[name=addNewLine]').prop('disabled', true);
                $('[name=slctJunkshopName]').select2();
                $('[name=slctJunkshopName]').change(function () {
                    var _thisVal = (this.value).split('_');
                    $.ajax({
                        url: 'truck_request_form_javascript.php?id=' + _thisVal[0],
                        async: false
                    }).done(function (e) {
                        var _data = e.split('~');
                        $('[name=spnIdNo]').text(_thisVal[0]);
                        $('[name=spnWarehouseAddress]').text(_data[0]);
                        $('[name=spnContactNo]').text(_data[1]);
                        $('[name=spnFirst]').text(_data[2]);
                        $('[name=spnSecond]').text(_data[3]);
                        $('[name=spnThird]').text(_data[4]);
                        $('[name=spnFirstVal]').text(_data[5]);
                        $('[name=spnSecondVal]').text(_data[6]);
                        $('[name=spnThirdVal]').text(_data[7]);
                        $('[name=spnAvgVal]').text(_data[8]);
                        $('input[type=number]').prop('disabled', false);
                        $('input[type=radio]').prop('disabled', false);
                        $('[name=justification1]').prop('disabled', false);
                        $('[name=addNewLine]').prop('disabled', false);
                        $('[name=btnSubmit]').prop('disabled', false);
                    });
                });

                $('[name=txtCommitment]').keyup(function () {
                    var commitment = Number(this.value);
                    var avg = Number($('[name=spnAvgVal]').text());
                    var addVol = commitment - avg;
                    $('[name=spnAddVolVal]').text(addVol);
                });

                $('[name=addNewLine]').click(function () {
                    var txtCtr = 10;
                    var txtHidden = Number($('[name=txtCtr]').val());
                    if (txtHidden <= txtCtr) {
                        var _new = txtHidden + 1;
                        $('#tr' + _new).attr('hidden', false);
                        $('[name=txtCtr]').val(_new);
                    }
                });

                $('[name=btnSubmit]').click(function () {
                    var supplierVal = ($('[name=slctJunkshopName]').val()).split('_');
                    var spnWarehouseAddress = $('[name=spnWarehouseAddress]').text();
                    var spnContactNo = $('[name=spnContactNo]').text();
                    var volumeSumm = $('[name=spnFirst]').text() + '=' + $('[name=spnFirstVal]').text() + ',' + $('[name=spnSecond]').text() + '=' + $('[name=spnSecondVal]').text() + ',' + $('[name=spnThird]').text() + '=' + $('[name=spnThirdVal]').text();
                    var spnAvgVal = $('[name=spnAvgVal]').text();
                    var spnCommitmentVal = $('[name=txtCommitment]').val();
                    var truck_request = $('input[type=radio]:checked').val();
                    var tr_id = $('[name=plateNo]').val();
                    var  truckCost= $('[name=truckCost]').val();
                    var  moAm= $('[name=moAm]').val();
                    var  amort= $('[name=amort]').val();
                    var  moCb= $('[name=moCb]').val();
                    var  cb= $('[name=cb]').val();
                    var _textArea = [];
                    $.each($('textarea'), function () {
                        var _thisVal = this.value;
                        var _thisName = this.name;
                        if (_thisVal !== '') {
                            _textArea.push({
                                name: _thisName,
                                value: _thisVal
                            });
                        }
                    });
                    var dataX = {'supplierName': supplierVal[1], 'supplierId': supplierVal[0], 'spnWarehouseAddress': spnWarehouseAddress,
                        'spnContactNo': spnContactNo, 'volumeSumm': volumeSumm, 'spnAvgVal': spnAvgVal, 'spnCommitmentVal': spnCommitmentVal, 'truck_request': truck_request, '_textArea': _textArea,
                        'tr_id': tr_id, 'truckCost': truckCost, 'moAm': moAm, 'amort': amort, 'moCb': moCb, 'cb': cb};

                    $.ajax({
                        data: dataX,
                        type: 'POST',
                        url: 'truck_request_form_submitPro.php',
                        async: false
                    }).done(function (e) {
                        alert('Successful.');
                        location.replace('truck_request.php?page=trequest');
                    });
                });

                $('[name=rTruckrequest]').click(function () {
                    var _thisVal = this.value;
                    $.ajax({
                        url: 'truck_request_form_plate.php?series=' + _thisVal,
                        async: false
                    }).done(function (e) {
                        $('[name=plateNo]').show();
                        $('[name=plateNo]').html(e);
                    });
                });
                
                $('[name=moAm]').keyup(function(){
                    var truckCost = Number($('[name=truckCost]').val());
                    var _moAm = Number(this.value);
                    var amort = (truckCost / _moAm).toFixed(2);
                        $('[name=amort]').val(amort);
                });
                
            });
        </script>
        <link href="css/select2.min.css" rel="stylesheet">
        <link href="css/tables.css" rel="stylesheet">
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
        </style>

    </head>
    <body>
    <html>
        <script type="text/javascript" src="js/jquery.min.js"></script>

    </script>
    <?php
    include('layout/header.php');
    include("css/drop_down.php");
    ?>
    <center>
        <div id="body">

            <table id="page1"><tr><td align="left">Truck Request<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
            <br />

            <?php //startofcode===========================================================================  ?>
            <br />
            <center>
                <table class="tblTruckRequest" border>
                    <tr>
                        <td colspan="7"><h2>Truck Request Form<h2></td>
                                    </tr>
                                    <tr>
                                        <td><h4>Junkshop Name:<h4></td>
                                                    <td colspan="6">
                                                        <span name="spnJunkshopname"><h4>
                                                                <select name="slctJunkshopName">
                                                                    <option value="" selected disabled>Please Select</option>
                                                                    <?php
//                                        @session_start();
                                                                    include('connect_out.php');
                                                                    $sql_supplier = mysql_query("SELECT * from supplier_details WHERE branch LIKE '%" . $_SESSION['owner'] . "%'") or die(mysql_error());
                                                                    while ($row_supplier = mysql_fetch_array($sql_supplier)) {
                                                                        echo '<option value="' . $row_supplier['supplier_id'] . '_' . $row_supplier['supplier_name'] . '">' . $row_supplier['supplier_name'] . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <h4></span>
                                                                    </td>
                                                                    </tr>
                                                                    <?php
                                                                    include('connect.php');
                                                                    ?>
                                                                    <tr>
                                                                        <td><h4>ID No:<h4></td>
                                                                                    <td colspan="6"><span name="spnIdNo"><h4><h4></span></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td><h4>Warehouse Address:<h4></td>
                                                                                                                    <td colspan="6"><span name="spnWarehouseAddress"><h4><h4></span></td>
                                                                                                                                    </tr>
                                                                                                                                    <tr>
                                                                                                                                        <td><h4>Contact No:<h4></td>
                                                                                                                                                    <td colspan="6"><span name="spnContactNo"><h4><h4></span></td>
                                                                                                                                                                    </tr>
                                                                                                                                                                    <tr>
                                                                                                                                                                        <td><h4>Volume Summary<h4></td>
                                                                                                                                                                                    <td><span name="spnFirst"><h5><h5></span></td>
                                                                                                                                                                                                    <td><span name="spnSecond"><h5><h5></span></td>
                                                                                                                                                                                                        <td><span name="spnThird"><h5><h5></span></td>
                                                                                                                                                                                                        <td><span name="spnAvg"><h5><h5>AVG</span></td>
                                                                                                                                                                                                        <td><span name="spnCommitment"><h5>Commitment<h5></span></td>
                                                                                                                                                                                                        <td><span name="spnAddVol"><h5>Add'l Vol<h5></span></td>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Total<h4></td>
                                                                                                                                                                                                        <td><span name="spnFirstVal"><h4><h4></span></td>
                                                                                                                                                                                                        <td><span name="spnSecondVal"><h4><h4></span></td>
                                                                                                                                                                                                        <td><span name="spnThirdVal"><h4><h4></span></td>
                                                                                                                                                                                                        <td><span name="spnAvgVal"><h4><h4></span></td>
                                                                                                                                                                                                        <td><span name="spnCommitmentVal"><h4><input type="number" style="width:60px;height:30px;" name="txtCommitment" required><h4></span></td>
                                                                                                                                                                                                        <td><span name="spnAddVolVal"><h4><h4></span></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Truck Request<h4></td>
                                                                                                                                                                                                        <td colspan="6"><input type="radio" name="rTruckrequest" value="ELF">ELF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="rTruckrequest" value="FORWARD">FORWARD</td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td colspan="7"><h4>Justification<h4></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td colspan="7"><textarea rows="3" style="width:90%;" name="justification1" placeholder="Bullet1" required></textarea></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php
                                                                                                                                                                                                                                                                                                                                                                                                                                    echo '<input type="hidden" name="txtCtr" value="1">';
                                                                                                                                                                                                                                                                                                                                                                                                                                    $stop = 10;
                                                                                                                                                                                                                                                                                                                                                                                                                                    $start = 2;
                                                                                                                                                                                                                                                                                                                                                                                                                                    while ($start <= $stop) {
                                                                                                                                                                                                                                                                                                                                                                                                                                        echo '<tr id="tr' . $start . '" hidden>
                        <td colspan="7"><textarea rows="3" style="width:90%;" name="justification1" placeholder="Bullet' . $start . '" required></textarea></td>
                    </tr>';
                                                                                                                                                                                                                                                                                                                                                                                                                                        $start++;
                                                                                                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                                                                                                    ?>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td colspan="7"><button name="addNewLine">Add New Line</button></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Plate No.<h4></td>
                                                                                                                                                                                                        <td colspan="6">
                                                                                                                                                                                                        <select name="plateNo" style="width:80%; font-size: 18px; height: 30px;">
                                                                                                                                                                                                        </select>
                                                                                                                                                                                                        </td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Truck Cost<h4></td>
                                                                                                                                                                                                        <td colspan="6"><input type="number" step="any" name="truckCost" style="width:100px;height:30px;"></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Monthly Payment & Duration:<h4></td>
                                                                                                                                                                                                        <td colspan="6">Mos.<input type="number" step="any" name="moAm" style="width:50px;height:30px;"> Mo.Amort<input type="number" step="any" name="amort" style="width:80px;height:30px;"></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                        <td><h4>Cash Bond:<h4></td>
                                                                                                                                                                                                        <td colspan="6">Mos.<input type="number" step="any" name="moCb" style="width:50px;height:30px;"> Mo.Cashbond<input type="number" step="any" name="cb" style="width:80px;height:30px;"></td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        </table>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php //endtofcode===========================================================================   ?>

                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        <br/><br/><button style="width: 100px; height: 30px;" name="btnSubmit">SUBMIT</button>
                                                                                                                                                                                                        </center>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <?php include('layout/footer.php'); ?>
                                                                                                                                                                                                        </body>
                                                                                                                                                                                                        </html>