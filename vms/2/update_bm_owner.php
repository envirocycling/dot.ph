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
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<script src="js/setup.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>

<?php

    include('layout/header.php');
    include("css/drop_down.php");
    include('connect.php');

    $id = $_GET['id'];

    $query = mysql_query("SELECT * FROM tbl_bm_givento WHERE bm_id='".$id."';") or die(mysql_error());
    $row = mysql_fetch_array($query);

?>

<div class="container">
    <div class="row">

        <div class="col col-sm-12">

            <table id="page1" style="margin-bottom: 50px;">
                <tr>
                    <td align="left">Baling Machine : Update Data<br /></td>
                    <td align="right"><span id="back" onClick="backed();">Back</span><td/>
                </tr>
            </table>

            
            <form action="update_bm_owner_process.php" method="POST">

                <input type="hidden" name="id" value="<?= $id; ?>">
                <input type="hidden" name="branch" value="<?= $_SESSION['owner']; ?>">

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label for='supplier_name'>SUPPLIER NAME:</label>
                                        </div>
                                        <div class="col col-sm-8">

                                            <?php

                                                include('connect_out.php');

                                                $branch = $_SESSION['owner'];

                                                $selectp = mysql_query("SELECT * FROM supplier_details WHERE branch='$branch' ORDER BY supplier_id ASC") or die(mysql_error());

                                            ?>
                                            
                                            <select name="supplier_name" class='form-control' required>
                                                <option value="<?= $row['supplier_name']; ?>"><?= $row['supplier_name']; ?></option>
                                                <?php while($rowp = mysql_fetch_array($selectp)): ?>
                                                <option value="<?= $rowp['supplier_name'];?> "><?= $rowp['supplier_name'];?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label>ISSUANCE DATE:  </label>
                                        </div>
                                        <div class="col col-sm-8">
                                            <input type="date" required id="sup_issuance" name="issuancedate" class="form-control" value="<?= $row['issuance_date']; ?>" >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label>END DATE:  </label>
                                        </div>
                                        <div class="col col-sm-8">
                                            <input type="date" required id="sup_end" name="enddate" value="<?= $row['end_date']; ?>" class="form-control" onChange="am();">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label>AMORTIZATION</label>
                                        </div>
                                        <div class="col col-sm-3">
                                            <input type="text"  name="amortization"  onKeyPress="return decimal(event)" value="<?= $row['amortization']; ?>" required class="form-control" >
                                        </div>

                                        <div class="col col-sm-2 text-right">
                                           <label>Month/s</label>
                                        </div>
                                        <div class="col col-sm-3">
                                            <input type="number" onKeyUp="maxl();" id="e_am" name="amortization_month"  maxlength="3" value="<?= $row['amortization_month']; ?>" required class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label>CASH BOND</label>
                                        </div>
                                        <div class="col col-sm-3">
                                            <input type="text" required name="cashbond" value="<?= $row['cash_bond']; ?>"  id="extra7" onKeyPress="return decimal(event)" class="form-control">
                                        </div>

                                        <div class="col col-sm-2 text-right">
                                           <label>Month/s</label>
                                        </div>
                                        <div class="col col-sm-3">
                                            <input onKeyUp="maxl();" type="number" id="e_cm" value="<?= $row['cash_bond_month']; ?>"  name="cashbond_month" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label>QUOTA</label>
                                        </div>
                                        <div class="col col-sm-3">
                                            <input type="text" required name="quota" value="<?= $row['quota']; ?>" onKeyPress="return decimal(event)" class="form-control">
                                        </div>

                                        <div class="col col-sm-2 text-right">
                                           <label>PENALTY</label>
                                        </div>
                                        <div class="col col-sm-3">
                                            <input type="text"  name="penalty" value="<?= $row['penalty']; ?>" onKeyPress="return decimal(event)" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-sm-4 text-right">
                                           <label>REMARKS:</label>
                                        </div>
                                        <div class="col col-sm-8">
                                            <textarea  name="remarks" cols="22" rows="3" onKeyUp="caps(this)" class="form-control" ><?= $row['remarks']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

            

                    <button class='btn btn-primary'>Update Data</button>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


<script>

    function decimal(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46 || (charCode > 47 && charCode < 58)) {
            return true;
        }
        return false;
    }

    function am() {

            var end_date = document.getElementById('sup_end').value;
            var issuance_date = document.getElementById('sup_issuance').value;
            var new_enddate = new Date(end_date);
            var new_issuancedate = new Date(issuance_date);
            var mm = new_issuancedate.getMonth();
            var mm2 = new_enddate.getMonth();
            var yy = new_issuancedate.getFullYear();
            var yy2 = new_enddate.getFullYear();
            var m = (mm2 - mm);
            var m3 =String(m);
            var months = ((yy2 - yy) * 12) + (m);

            document.getElementById('e_am').value=months;

        };

        function maxl() {

            var a_m = document.getElementById('e_am').value;
            var ca_m = document.getElementById('e_cm').value;
            var l_am = a_m.length;
            var l_cam = ca_m.length;

            if(l_am > 3) {
                var a_m2 = a_m.substring(0,3);
                alert("Maximum of 3 characters long.");
                document.getElementById('e_am').value=a_m2;
            }

            if(l_cam > 3){
                var ca_m2 = ca_m.substring(0,3);
                alert("Maximum of 3 characters long.");
                document.getElementById('e_cm').value=ca_m2;
            }
        };


    </script>

<?php include('layout/footer.php');?>
</body>
</html>