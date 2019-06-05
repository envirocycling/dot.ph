<!DOCTYPE html>
<html lang="en">
    <!--dropdown menu src start-->
    <link href="css/select2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <!--dropdown menu src end-->

    <link rel="stylesheet" type="text/css" href="css/pr_form.css">
    <link rel="stylesheet" type="text/css" href="css/select2.min.css">
    <script>
        $(document).ready(function () {
            $('[name=title]').select2({
                tags: true,
                realtime: false
            });
            //adding 
            $('#add_upload').click(function () {
                var upload_control = Number($('#upload_control').val());
                var add = 1 + upload_control;
                $('#add_' + add).attr('hidden', false);
                $('#upload_control').val(add);
                if (add == 50) {
                    $('#add_upload').attr('hidden', true);
                }
                if (add > 1) {
                    $('#minus_upload_span').attr('hidden', false);
                }
            });

            $('#minus_upload').click(function () {
                var upload_control = Number($('#upload_control').val());
                var minus = upload_control - 1;
                $('#add_' + upload_control).attr('hidden', true);
                $('#upload_control').val(minus);
                if (minus == 1) {
                    $('#minus_upload_span').attr('hidden', true);
                }
                if (minus <= 50) {
                    $('#add_upload').attr('hidden', false);
                }

            });
            //adding end
            $('.employee').change(function () {
                var thisId = $(this).attr('id').split("_");
                if (thisId[0] === 'employee') {
                    var emp_num = $(this).val();
                    $.ajax({
                        url: 'process/register_tns_empdataDetails.php',
                        type: 'POST',
                        data: 'emp_num=' + emp_num + '&class=' + thisId[1],
                        async: false
                    }).done(function (e) {
                        var divEmployeeDetails = $('#divEmployeeDetails').html();
                        if ($('.empDetails').is('.' + thisId[1])) {
                            $('#divEmployeeDetails .1').html(e);
                        } else {
                            $('#divEmployeeDetails').append(e + '<br/><br/><br/>');
                        }
                        $.ajax({
                            url: 'process/register_tns_pending.php?emp_num=' + emp_num,
                            async: false
                        }).done(function (e) {
                            var eSplit = e.split('~');
                            var nVal = '';
                            $.each(eSplit, function (i) {
                                if (eSplit[i] !== '') {
                                    var _thisVal = $('[name=txtHpendingTNS]').val().toUpperCase();
                                    nVal = _thisVal.replace(eSplit[i].toUpperCase() + '~', '');
                                    $('[name=txtHpendingTNS]').val(nVal);
                                }
                            });
                            var _finalVal = $('[name=txtHpendingTNS]').val();
                            $('[name=txtHpendingTNS]').val(_finalVal + e);
                            var _finalVal2 = $('[name=txtHpendingTNS]').val();
                            var optVal = '<option value=""></option>';
                            var fValSplit = _finalVal2.split('~');
                            $.each(fValSplit, function (i) {
                                optVal += '<option value="' + fValSplit[i].toUpperCase() + '">' + fValSplit[i].toUpperCase() + '</option>';
                            });
                            $('[name=title]').html(optVal);
                        });
                    }
                    );
                }
            });
        });
    </script>
    <input type="hidden" name="txtHpendingTNS">
    <body>
        <?php include 'layout/header.php'; ?>
        <!-- Start home section -->
        <div id="home">

            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <div class="triangle"></div>
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->

                <div class="container">

                    <div class="title">
                        <?php
                        include 'layout/menu.php';
                        ?>
                    </div>
                    <!--start main-->
                    <div class="main" align="center">
                        <br><br>
                        <form action="process/register_tns_pro.php" method="post" enctype="multipart/form-data">
                            <table width="100%">
                                <tr>
                                    <td class="header1" colspan="4"><span id="header2">Training and Seminars<br></span></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                            </table>
                            <table width="80%">
                                <?php
                                echo '<input type="hidden" value="1" id="upload_control" name="upload_control">';
                                $upload_ctr = 1;
                                $upload_num = 50;
                                while ($upload_ctr <= $upload_num) {
                                    if ($upload_ctr == 1) {
                                        $attrib = '';
                                    } else {
                                        $attrib = 'hidden';
                                    }
                                    ?>
                                    <tr <?php echo $attrib; ?> id="add_<?php echo $upload_ctr; ?>">
                                        <td colspan="3"><br><font color="blue"><b><i>Attachment <?php echo $upload_ctr; ?>:<i></b></font> <input type="file" name="upload[]" id="upload_<?php echo $upload_ctr; ?>" accept="application/pdf"/></td>
                                                        <td colspan="3"><br><font color="blue"><b><i>Certificate <?php echo $upload_ctr; ?>:<i></b></font> <input type="file" name="cert[]" id="cert_<?php echo $upload_ctr; ?>" accept="application/pdf"/></td>
                                                                        </tr>
                                                                        <?php
                                                                        $upload_ctr++;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="1"><center><img id="add_upload" src="../../images/button/add_icon.png" height="25" width="25"> <span hidden id="minus_upload_span"> &nbsp;&nbsp; <img id="minus_upload" src="../../images/button/minus_icon.png" height="25" width="25"></span></center></td>
                                                                    </tr>
                                                                    <?php
                                                                    $num = 1;
                                                                    $row = 100;
                                                                    echo '<input type="hidden" id="row_ctrl" name="row_ctrl" value="' . $num . '">';

                                                                    while ($num <= $row) {
                                                                        if ($num != 1) {
                                                                            $attr = 'hidden';
                                                                        }if ($num == 1) {
                                                                            $req = 'required';
                                                                        }
                                                                        ?>
                                                                        <script>
                                                                            $(document).ready(function () {
                                                                                $("#employee_<?php echo $num; ?>").select2();
                                                                            });
                                                                        </script>
                                                                        <tr id="rows_<?php echo $num; ?>" <?php echo @$attr; ?> >
                                                                            <td colspan="4"><center><br/>Attendee <?php echo $num; ?>:

                                                                            <select id="employee_<?php echo $num; ?>" name="emp_num<?php echo $num; ?>" style="width:40%;" class="employee">
                                                                                <option value="" selected disabled> Please Select</option>
                                                                                <?php
                                                                                $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                                                                while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                                                    $str_chk = strlen($row_employee['middlename']);
                                                                                    if ($str_chk > 1) {
                                                                                        $str_countemp = strlen($row_employee['middlename']) - 1;
                                                                                        $emp_fullname = ucwords($row_employee['lastname'] . ', ' . $row_employee['firstname']) . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ';
                                                                                    } else {
                                                                                        $str_countemp = strlen($row_employee['middlename']);
                                                                                        $emp_fullname = ucwords($row_employee['lastname'] . ', ' . $row_employee['firstname']) . ' ' . $row_employee['middlename'] . '. ';
                                                                                    }echo '<option value="(' . $row_employee['emp_num'] . ')">' . $emp_fullname . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </center>
                                                                        <br>
                                                                        </td>
                                                                        </tr>

                                                                        <?php
                                                                        $num++;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="4"><br><center>
                                                                        <input type="button" value="+" style="width:70px;" class="buttons" id="add">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="button" value="-" style="width:70px;" class="buttons" id="minus" disabled></center></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4"><br/><br/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Type:</td>
                                                                        <td>
                                                                            <select name="training_type" required>
                                                                                <option value="" selected disabled>Please Select</option>
                                                                                <option value="in-house">In-house</option>
                                                                                <option value="external">External</option>
                                                                            </select>
                                                                        </td>
                                    <!--                                    <td>Attachment (pdf):</td>
                                                                        <td><input type="file" name="attachment" accept="application/pdf"></td>-->
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Title:</td>
                                                                        <td>
                                                                            <select name="title" >
                                                                                <!--                                                                                <option value="" selected></option>-->
                                                                                //<?php
//                                                $sql_pendingTNS = mysql_query("SELECT * from ") or die(mysql_error());
//                                            
                                                                                ?>
                                                                            </select>
                                                                        </td>
                                                                        <td>Venue:</td>
                                                                        <td><input type="text" name="venue" required></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Date:</td>
                                                                        <td><input type="text" name="from" id="datetimepicker" placeholder="From" autocomplete="off" required><br><input type="text" name="to" id="datetimepicker2" placeholder="To" autocomplete="off" required></td>
                                                                        <td>Facilitator:</td>
                                                                        <td><input type="text" name="facilitator" required></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Bond:</td>
                                                                        <td><input type="number" name="ban" min="1" placeholder="In Months (if any)" autocomplete="off"></td>
                                                                        <td>Justification:</td>
                                                                        <td><textarea placeholder="If Any" name="justification"></textarea></td>
                                                                    </tr>
                                                                    </table>
                                                                    <br><br>
                                                                    <input type="submit" class="btn btn-primary" value="Submit Request">
                                                                    <br><br><br>
                                                                    </form>

                                                                    <!--employee details-->
                                                                    <div id="divEmployeeDetails"></div>
                                                                    <br><br><br>
                                                                    </div>
                                                                    <!--end main-->
                                                                    </div>

                                                                    </div>
                                                                    </div>
                                                                    <!-- End home section -->
                                                                    <!-- Service section start -->
                                                                    <div class="section primary-section" id="service">
                                                                        <div class="container">
                                                                        </div>
                                                                    </div>
                                                                    <!-- Service section end -->

                                                                    <?php include 'layout/footer.php'; ?>



                                                                    </body>
                                                                    </html>
                                                                    <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
                                                                    <script src="js/jquery.datetimepicker.full.js"></script>
                                                                    <script>
                                                                            $(function () {
                                                                                $('input[name="attachment"]').change(function () {
                                                                                    var attachment = $('input[name="attachment"]').val();
                                                                                    var arr_attachment = attachment.split('.');
                                                                                    var arr_count = (arr_attachment.length) - 1;
                                                                                    var attachment_type = arr_attachment[arr_count].toUpperCase();

                                                                                    if (attachment_type !== 'PDF') {
                                                                                        alert("Invalid file type. Please choose PDF only.");
                                                                                        $('input[name="attachment"]').val('');
                                                                                    }
                                                                                });
                                                                            });
                                                                            $('#datetimepicker').keydown(false);
                                                                            $('#datetimepicker2').keydown(false);
                                                                            //date picker3 start
                                                                            $('#datetimepicker').datetimepicker({
                                                                                dayOfWeekStart: 1,
                                                                                lang: 'ch',
                                                                                format: 'Y/m/d h:i A',
                                                                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                                                                startDate: '2016',
                                                                                scrollMonth: false,
                                                                                scrollInput: false
                                                                            });
                                                                            $('#datetimepicker').datetimepicker({value: ''});

                                                                            $('#datetimepicker2').datetimepicker({
                                                                                dayOfWeekStart: 1,
                                                                                lang: 'ch',
                                                                                format: 'Y/m/d h:i A',
                                                                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                                                                startDate: '2016',
                                                                                scrollMonth: false,
                                                                                scrollInput: false
                                                                            });
                                                                            $('#datetimepicker2').datetimepicker({value: ''});
                                                                            //date picker3 end
                                                                            function textAreaAdjust(o) {
                                                                                o.style.height = "1px";
                                                                                o.style.height = (0 + o.scrollHeight) + "px";
                                                                            }

                                                                            //add-minus rows start

                                                                            $(document).ready(function () {
                                                                                $('.buttons').click(function () {
                                                                                    var act = $(this).attr('id');
                                                                                    if (act == 'add') {
                                                                                        var row_ctrl1 = Number($('#row_ctrl').val());
                                                                                        var row_ctrl_add = row_ctrl1 + 1;
                                                                                        $('#row_ctrl').val(row_ctrl_add);
                                                                                        var row_ctrl = Number($('#row_ctrl').val());
                                                                                        $("#rows_" + row_ctrl).attr("hidden", false);
                                                                                        $("#employee_" + row_ctrl).attr("required", true);
                                                                                        $('#minus').attr('disabled', false);
                                                                                        if (row_ctrl >= '100') {
                                                                                            $('#add').attr('disabled', true);
                                                                                        }

                                                                                    } else if (act == 'minus') {
                                                                                        var row_ctrl = Number($('#row_ctrl').val());
                                                                                        $("#rows_" + row_ctrl).attr("hidden", true);
                                                                                        $("#employee_" + row_ctrl).attr("required", false);
                                                                                        var row_ctrl1 = Number($('#row_ctrl').val());
                                                                                        var row_ctrl_min = row_ctrl1 - 1;
                                                                                        $('#row_ctrl').val(row_ctrl_min);
                                                                                        var row_ctrl_1 = Number($('#row_ctrl').val());
                                                                                        if (row_ctrl_1 == 1) {
                                                                                            $('#minus').attr('disabled', true);
                                                                                        } else {
                                                                                            $('#minus').attr('disabled', false);
                                                                                        }
                                                                                        if (row_ctrl_1 < 100) {
                                                                                            $('#add').attr('disabled', false);
                                                                                        }
                                                                                    }
                                                                                });
                                                                            });
                                                                            //add-minus rows end
                                                                    </script>


