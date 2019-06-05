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
        <script>
            $(document).ready(function () {
                $('#btn_record').hide();
                $('#tblCo').hide();
                $('[name="plate_no"]').change(function () {
                    var _thisVal = this.value;

                    $.ajax({
                        url: 'hrm_recordingAjax.php?truck_id=' + _thisVal,
                        async: false
                    }).done(function (e) {
                        var eSplit = e.split('~');
                        $('.CSSTableGenerator').html(eSplit[0]);
                        $('#tblCo').html(eSplit[1]);
                        $('#btn_record').prop('href', 'hrm_recordingPro.php?id=' + _thisVal);
                        $('#btn_record').show();
                        $('#tblCo').show();
                    });
                });
            });
        </script>
        <link href="css/select2.min.css" rel="stylesheet" />
        <link href="css/table.css" rel="stylesheet">

    </head>
    <body>
    <html>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <style>
            .dp{
                font-size: 18px;
            }
            .CSSTableGenerator{
                font-size: 16px;
            }
        </style>
        <?php include('layout/header.php'); ?>
        <center>
            <div id="body">
                <table id="page1"><tr><td align="left">HRM Recording<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
                <?php
                include('connect.php');
                $plate = mysql_query("Select * from tbl_truck_report Where class='HE' and branch LIKE '%" . $_SESSION['owner'] . "%' and status='' ORDER BY truckplate Asc") or die(mysql_error());
                ?>
                <br />
                <br />
                <center>
                    <div width="500px" id="tblCo">
                    </div>
                    <table  width="70%">
                        <tr>
                            <td><br /><br /><font size="+1"><b>Plate No. 
                                    <?php
                                    echo '<select name="plate_no" class="dp" required>';
                                    echo '<option value="" selected disabled>Select</option>';
                                    while ($row_he = mysql_fetch_array($plate)) {
                                        echo '<option value="' . $row_he['id'] . '">' . $row_he['truckplate'] . '</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </b></font></td>
                            <td align="right"><br /><br /><a href="" rel="facebox" id="btn_record"><input type="button" value="Record HRM Reading"></a></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="CSSTableGenerator">
                                    <tr>
                                        <td>Date</td>
                                        <td>HRM</td>
                                        <td>Remarks</td>
                                    </tr>
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

<link rel="stylesheet" href="css/zebra_dialog.css" type="text/css">
<script type="text/javascript" src="js/zebra_dialog.js"></script>
<?php
$sql_he = mysql_query("SELECT * from tbl_truck_report WHERE class = 'HE' and coSet > 0 and status='' and branch LIKE '%" . $_SESSION['owner'] . "%'") or die(mysql_error());
while ($row_he = mysql_fetch_array($sql_he)) {
    $sql_coSet = mysql_query("SELECT * from tbl_changeoilset WHERE id='" . $row_he['coSet'] . "'") or die(mysql_error());
    $row_coSet = mysql_fetch_array($sql_coSet);

    $sql_hrm = mysql_query("SELECT * from tbl_hrm WHERE truck_id='" . $row_he['id'] . "' ORDER BY date Desc LIMIT 1") or die(mysql_error());
    $row_hrm = mysql_fetch_array($sql_hrm);

    $pop = 0;
    $last_hrm = $row_hrm['hrm'];
    $next_engineOil = $row_he['engine_oil'] - 10;
    $next_atf = $row_he['atf'] - 10;
    $next_gearOil = $row_he['gear_oil'] - 10;
    $next_hydraulicOil = $row_he['hydraulic_oil'] - 10;
    $next_coolant = $row_he['coolant'] - 10;
    
        if($last_hrm >= $next_engineOil){
            $pop++;
        }
        if($last_hrm >= $next_atf){
            $pop++;
        }
        if($last_hrm >= $next_gearOil){
            $pop++;
        }
        if($last_hrm >= $next_hydraulicOil){
            $pop++;
        }
        if($last_hrm >= $next_coolant){
            $pop++;
        }
}

if($pop > 0){
?>
<script type="text/javascript">
            $(document).ready(function () {
                new $.Zebra_Dialog('<strong>Maintenance</strong><br><br>', {
                    source: {'iframe': {
                            'src': 'hrm_chk.php',
                            'height': 350
                        }},
                    width: 800,
                    title: 'Need To Change Oil'
                });
            });
</script>
<?php
}
?>
