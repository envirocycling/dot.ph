<!DOCTYPE html>
<html lang="en">
    <!--dropdown menu src start-->
    <link href="css/select2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>
    <!--dropdown menu src end-->
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <link rel="stylesheet" type="text/css" href="css/pr_form.css">
    <style>
        .attachement{
            font-style: italic;
            color: blue;
            font-size: 13px;
            font-weight: 700;
        }
    </style>
    <body>
        <script>
            $(function () {
                $('.att').hide();
            });
            $(document).ready(function () {

                $('[name=attDelete]').click(function () {
                    var ids = '<?php echo $_GET['tns_id']; ?>';
                    alert('edit_tns_att.php?emp=' + $(this).attr('id') + '&action=att&id=' + ids);
                    $.ajax({
                        url: 'process/edit_tns_att.php?emp=' + $(this).attr('id') + '&action=att&id=' + ids,
                        async: false
                    }).done(function () {
                        alert("Successful");
                        location.reload();
                    });
                });
                $('[name=certDelete]').click(function () {
                    $.ajax({
                        url: 'edit_tns_att.php?id' + $(this).attr('id') + '&action=cert',
                        async: false
                    }).done(function () {
                        alert("Successful");
                        location.reload();
                    });
                });

                $('[name=chkAtt]').click(function () {
                    if ($(this).prop('checked')) {
                        $('.att').show(300);
                    } else {
                        $('.att').hide(300);
                    }
                });

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

                $('select').change(function () {
                    var thisId = $(this).attr('id').split("_");
                    if (thisId[0] === 'employee') {
                        var emp_num = $(this).val();
                        $.ajax({
                            url: 'process/register_tns_empdataDetails.php',
                            type: 'POST',
                            data: 'emp_num=' + emp_num + '&class=' + thisId[1]
                        }).done(function (e) {
                            var divEmployeeDetails = $('#divEmployeeDetails').html();
                            if ($('.empDetails').is('.' + thisId[1])) {
                            } else {
                                $('#divEmployeeDetails').append(e + '<br/><br/><br/>');
                            }
                        });
                    }
                });
            });
        </script>
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

                        if (isset($_POST['submit'])) {
                            $date_updated = date('Y/m/d H:i');
                            $title = mysql_real_escape_string($_POST['title']);
                            $from = date('Y/m/d H:i', strtotime($_POST['from']));
                            $to = date('Y/m/d H:i', strtotime($_POST['to']));
                            $ban = $_POST['ban'];
                            $facilitator = mysql_real_escape_string($_POST['facilitator']);
                            $venue = mysql_real_escape_string($_POST['venue']);
                            $justification = mysql_real_escape_string($_POST['justification']);
                            $training_type = $_POST['training_type'];
                            $row_ctrl = $_POST['row_ctrl'];
                            $num = 1;
                            $all_emp = '';
                            while ($num <= $row_ctrl) {
                                $emp_num = $_POST['emp_num' . $num];
                                $all_emp .= $emp_num;
                                $num++;
                            }
                            if (mysql_query("UPDATE training_seminar SET type='$training_type', title='$title', from_date='$from', to_date='$to', facilitator='$facilitator', venue='$venue', participants='$all_emp', prepared_num='" . $_SESSION['emp_num'] . "', date_updated='$date_updated', bond='$ban', justification='$justification' WHERE tns_id = '" . $_GET['tns_id'] . "'") or die(mysql_error())) {
                                $upload_control = $_POST['upload_control'];
                                $pro_ctr = 1;
                                $arr_ctr = 0;
                                $date = date('Y-m-d');
                                $target_dir = "../../attachment/tns/";
                                while ($pro_ctr <= $upload_control) {
                                    $target = $target_dir . $_GET['tns_id'] . $arr_ctr . basename($_FILES["upload"]["name"][$arr_ctr]);
                                    $target2 = $target_dir . $_GET['tns_id'] . $arr_ctr . basename($_FILES["cert"]["name"][$arr_ctr]);
                                    $upload_name = $_GET['tns_id'] . $arr_ctr . basename($_FILES["upload"]["name"][$arr_ctr]);
                                    $upload_name2 = $_GET['tns_id'] . $arr_ctr . basename($_FILES["cert"]["name"][$arr_ctr]);
                                    $base = basename($_FILES["upload"]["name"][$arr_ctr]);
                                    $base2 = basename($_FILES["cert"]["name"][$arr_ctr]);
                                    if (!empty($base)) {
                                        move_uploaded_file(@$_FILES["upload"]["tmp_name"][$arr_ctr], $target);
                                    }
                                    if (!empty($base2)) {
                                        move_uploaded_file(@$_FILES["cert"]["tmp_name"][$arr_ctr], $target2);
                                    }
//                                    echo "SELECT * from training_seminar_attachment WHERE tns_id='" . $_GET['tns_id'] . "' and emp_num='" . $_POST['emp_num' . $pro_ctr] . "'<br />";
                                    $sql_chk = mysql_query("SELECT * from training_seminar_attachment WHERE tns_id='" . $_GET['tns_id'] . "' and emp_num LIKE '%" . $_POST['emp_num' . $pro_ctr] . "%'");
                                    if (mysql_num_rows($sql_chk) == 0) {
                                        mysql_query("INSERT INTO training_seminar_attachment (tns_id, file_name, cert_name, emp_num, user_id, date_uploaded) VALUES('" . $_GET['tns_id'] . "', '$upload_name', '$upload_name2', '".$_POST['emp_num' . $pro_ctr]."', '" . $_SESSION['user_id'] . "','$date')") or die(mysql_error());
                                    
//                                        echo "INSERT INTO training_seminar_attachment (tns_id, file_name, cert_name, emp_num, user_id, date_uploaded) VALUES('" . $_GET['tns_id'] . "', '$upload_name', '$upload_name2','".$_POST['emp_num' . $pro_ctr]."', '" . $_SESSION['user_id'] . "','$date')<br>";
                                    } else {
                                        if(!empty($base)) {
                                            mysql_query("UPDATE training_seminar_attachment SET file_name='$upload_name' WHERE tns_id='" . $_GET['tns_id'] . "' and emp_num='" . $_POST['emp_num' . $pro_ctr] . "'") or die(mysql_error());
                                        
//                                            echo "UPDATE training_seminar_attachment SET file_name='$upload_name' WHERE tns_id='" . $_GET['tns_id'] . "' and emp_num='" . $_POST['emp_num' . $pro_ctr] . "'<br>";
                                        }
                                        if(!empty($base2)) {
                                            mysql_query("UPDATE training_seminar_attachment SET cert_name='$upload_name2' WHERE tns_id='" . $_GET['tns_id'] . "' and emp_num='" . $_POST['emp_num' . $pro_ctr] . "'") or die(mysql_error());
                                        
//                                            echo "UPDATE training_seminar_attachment SET cert_name='$upload_name2' WHERE tns_id='" . $_GET['tns_id'] . "' and emp_num='" . $_POST['emp_num' . $pro_ctr] . "'<br>";
                                        }
                                    }
                                    $pro_ctr++;
                                    $arr_ctr++;
                                }
//                                  @$target = '../../attachment/tns/' . basename($_FILES["attachment"]["name"]);
//                                @$target_old = '../../attachment/tns/' . $_POST['current_attachment'];
//                                @$upload_name = basename($_FILES["attachment"]["name"]);
//                                if (!empty($upload_name)) {
//                                    unlink($target_old);
//                                    if (file_exists($target)) {
//                                        unlink($target);
//                                    }
//                                    move_uploaded_file(@$_FILES["attachment"]["tmp_name"], $target);
//                                }
                                echo '<script>
                                    window.top.location.href="view_trainingseminar.php?status=active&active=view&http=200";
                                </script>';
                            } else {
                                echo '<script>
                                    window.top.location.href="view_trainingseminar.php?status=active&active=view&http=400";
                                </script>';
                            }
                        }

                        $sql_tns = mysql_query("SELECT * from training_seminar WHERE tns_id = '" . $_GET['tns_id'] . "'") or die(mysql_error());
                        $row_tns = mysql_fetch_array($sql_tns);

                        $emp = explode(')', $row_tns['participants']);
                        $num_part = 0;
                        echo '<input type="hidden" name="txtHdEmpCtrl" value="' . $row_tns['participants'] . '">';
                        ?>
                    </div>
                    <!--start main-->
                    <div class="main" align="center">
                        <br><br>
                        <form method="post" enctype="multipart/form-data">
                            <table width="100%">
                                <tr>
                                    <td class="header1" colspan="4"><span id="header2">Training and Seminars<br></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <table width="80%">
                                <tr>
                                    <td>Type:</td>
                                    <td>
                                        <select name="training_type" required>
                                            <option value="<?php echo $row_tns['type']; ?>"><?php echo strtoupper($row_tns['type']); ?></option>
                                            <option value="in-house">IN-HOUSE</option>
                                            <option value="external">EXTERNAL</option>
                                        </select>
                                    </td>
<!--                                    <td>Attachment:</td>
                                    <td><input type="file" name="attachment" accept="application/pdf"></td>-->
                                </tr>
                                <tr>
                                    <td>Title:</td>
                                    <td><input type="text" name="title" value="<?php echo strtoupper($row_tns['title']); ?>" required></td>
                                    <td>Venue:</td>
                                    <td><input type="text" name="venue" value="<?php echo strtoupper($row_tns['venue']); ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Date:</td>
                                    <td><input type="text" name="from" value="<?php echo date('Y/m/d h:i A', strtotime($row_tns['from_date'])); ?>" id="datetimepicker" placeholder="From" autocomplete="off" required><br><input type="text" name="to" value="<?php echo date('Y/m/d h:i A', strtotime($row_tns['to_date'])); ?>" id="datetimepicker2" placeholder="To" autocomplete="off" required></td>
                                    <td>Facilitator:</td>
                                    <td><input type="text" name="facilitator" value="<?php echo strtoupper($row_tns['facilitator']); ?>" required></td>
                                </tr>
                                <tr>
                                    <td>Bond:</td>
                                    <td><input type="number" name="ban" min="1" value="<?php echo strtoupper($row_tns['bond']); ?>" placeholder="In Months (if any)" autocomplete="off"></td>
                                    <td>Justification:</td>
                                    <td><textarea placeholder="If Any" name="justification"><?php echo strtoupper($row_tns['justification']); ?></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></hr><h5>View Uploaded Attachment<input type="checkbox" name="chkAtt"></h5></td>
                                </tr>
                                <?php
                                $arrAtt = array();
                                $arrAttCert = array();
                                $sql_att = mysql_query("SELECT * from training_seminar_attachment WHERE tns_id = '" . $row_tns['tns_id'] . "'");
                                while ($row_att = mysql_fetch_array($sql_att)) {
                                    $attend1 = str_replace('(', '', $row_att['emp_num']);
                                    $attend = str_replace(')', '', $attend1);
                                    if (is_numeric($row_att['file_name'])) {
                                        $att = '';
                                    } else {
                                        $att = $row_att['file_name'];
                                    }
                                    if (is_numeric($row_att['cert_name'])) {
                                        $attCert = '';
                                    } else {
                                        $attCert = $row_att['cert_name'];
                                    }
                                    $arrAtt[$attend] = '<a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['file_name'] . '">' . $att . '</a>';
                                    $arrAttCert[$attend] = '<a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['cert_name'] . '">' . $attCert . '</a>';
//                                    array_push($arrAtt, '<a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['file_name'] . '">' . $att . '</a>');
//                                    array_push($arrAttCert, '<a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['cert_name'] . '">' . $attCert . '</a>');
//            echo 'Attachment : <a class="attachement" target="_blank" href="../../attachment/tns/' . $row_att['file_name'] . '">' . $row_att['file_name'] . '</a><br >';
                                }
                                $num = 1;
                                foreach ($emp as $attendee) {
                                    $attendee = str_replace("(", "", $attendee);
                                    if ($attendee > 0) {
                                        echo '<tr class="att"><td colspan="2">Attachment ' . $num . ':' . $arrAtt[$attendee] . '<img name="attDelete" src="../../images/button/delete_icon.png" id="' . $attendee . '" height="25" width="25"></td><td colspan="2">Certificate ' . $num . ':' . $arrAttCert[$attendee] . '<img name="certDelete" src="../../images/button/delete_icon.png" id="' . $attendee . '" height="25" width="25"></td></tr>';
                                    }
                                    $num++;
                                }
                                ?>
                                <!--                                    </td>
                                                                </tr>-->
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
                                                        <td colspan="3"><br><font color="blue"><b><i>Certificate <?php echo $upload_ctr; ?>:<i></b></font> <input type="file" name="cert[]" id="upload_<?php echo $upload_ctr; ?>" accept="application/pdf"/></td>
                                                                        </tr>
                                                                        <?php
                                                                        $upload_ctr++;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="1"><center><img id="add_upload" src="../../images/button/add_icon.png" height="25" width="25"> <span hidden id="minus_upload_span"> &nbsp;&nbsp; <img id="minus_upload" src="../../images/button/minus_icon.png" height="25" width="25"></span></center></td>
                                                                    </tr>
                                                                    <?php
                                                                    $num2 = 1;
                                                                    $row = 150;
                                                                    foreach ($emp as $attendee) {
                                                                        $attendee = str_replace("(", "", $attendee);
                                                                        if ($attendee > 0) {
                                                                            ?>
                                                                            <script>
                                                                                $(document).ready(function () {
                                                                                    $("#employee_<?php echo $num2; ?>").select2();
                                                                                });
                                                                            </script>
                                                                            <tr id="rows_<?php echo $num2; ?>" <?php echo @$attr; ?> >
                                                                                <td colspan="4"><br><br><center>Attendee <?php echo $num2; ?>:
                                                                                <select id="employee_<?php echo $num2; ?>" name="emp_num<?php echo $num2; ?>" style="width:40%;">
                                                                                    <?php
                                                                                    $sql_part = mysql_query("SELECT * from employees WHERE emp_num = '$attendee' ") or die(mysql_error());
                                                                                    if(mysql_num_rows($sql_part) == 0){
                                                                                        $sql_part = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '$attendee' ") or die(mysql_error());
                                                                                    }
                                                                                    $row_part = mysql_fetch_array($sql_part);
                                                                                    $str_count_part = strlen($row_part['middlename']) - 1;
                                                                                    $middlename_part = substr($row_part['middlename'], 0, -$str_count_part);
                                                                                    if (empty($row_part['middlename'])) {
                                                                                        $middlename_part = '';
                                                                                    } else {
                                                                                        $middlename_part = ', ' . $middlename_part . '.';
                                                                                    }
                                                                                    $fullname_part = ucwords($row_part['lastname'] . ', ' . $row_part['firstname'] . $middlename_part);
                                                                                    echo '<option value="(' . $row_part['emp_num'] . ')">' . $fullname_part . '</option>';

                                                                                    $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                                                                    while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                                                        $str_countemp = strlen($row_employee['middlename']) - 1;
                                                                                        $emp_fullname = ucwords($row_employee['lastname'] . ', ' . $row_employee['firstname']) . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ';
                                                                                        echo '<option value="(' . $row_employee['emp_num'] . ')">' . $emp_fullname . '</option>';
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </center>
                                                                            </td>
                                                                            </tr>
                                                                            <script>
                                                                                $(document).ready(function () {
                                                                                    var toSplit = "employee_<?php echo $num2; ?>";
                                                                                    var thisId = toSplit.split("_");
                                                                                    if (thisId[0] === 'employee') {
                                                                                        var emp_num = "<?php echo $attendee; ?>";
                                                                                        $.ajax({
                                                                                            url: 'process/register_tns_empdataDetails.php',
                                                                                            type: 'POST',
                                                                                            data: 'emp_num=' + emp_num + '&class=' + thisId[1]
                                                                                        }).done(function (e) {
                                                                                            var divEmployeeDetails = $('#divEmployeeDetails').html();
                                                                                            if ($('.empDetails').is('.' + thisId[1])) {
                                                                                            } else {
                                                                                                $('#divEmployeeDetails').append(e + '<br/><br/><br/>');
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            </script> 
                                                                            <?php
                                                                            $num_part++;
                                                                            $num2++;
                                                                        }
                                                                    }


                                                                    $num = $num_part + 1;

                                                                    echo '<input type="hidden" id="row_ctrl" name="row_ctrl" value="' . $num_part . '">';
                                                                    while ($num <= $row) {
                                                                        if ($num_part < $num) {
                                                                            $attr = 'hidden';
                                                                        }
                                                                        ?>
                                                                        <script>
                                                                            $(document).ready(function () {
                                                                                $("#employee_<?php echo $num; ?>").select2();
                                                                            });
                                                                        </script>
                                                                        <tr id="rows_<?php echo $num; ?>" <?php echo @$attr; ?> >
                                                                            <td colspan="4"><br><br><center>Attendee <?php echo $num; ?>:
                                                                            <select id="employee_<?php echo $num; ?>" name="emp_num<?php echo $num; ?>" style="width:40%;">
                                                                                <option value="" selected > Please Select</option>
                                                                                <?php
                                                                                $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                                                                while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                                                    $str_countemp = strlen($row_employee['middlename']) - 1;
                                                                                    $emp_fullname = ucwords($row_employee['lastname'] . ', ' . $row_employee['firstname']) . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ';
                                                                                    echo '<option value="(' . $row_employee['emp_num'] . ')">' . $emp_fullname . '</option>';
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </center>
                                                                        <br/>                                <br/>
                                                                        <br/>

                                                                        </td>
                                                                        </tr>

                                                                        <?php
                                                                        $num++;
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td colspan="4"><br><center>
                                                                        <input type="button" value="+" style="width:70px;" class="buttons" id="add">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <input type="button" value="-" style="width:70px;" class="buttons" id="minus"></center></td>
                                                                    </tr>
                                                                    </table>
                                                                    <br><br>
                                                                    <input type="submit" class="btn btn-primary" name='submit' value="Update Record">
                                                                    <br><br><br>
                                                                    <!--employee details-->
                                                                    <div id="divEmployeeDetails"></div>
                                                                    <br><br><br>
                                                                    </form>
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
                                                                                    if (row_ctrl >= '150') {
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
                                                                                    if (row_ctrl_1 < 150) {
                                                                                        $('#add').attr('disabled', false);
                                                                                    }
                                                                                }
                                                                            });
                                                                        });
                                                                        //add-minus rows end
                                                                    </script>


