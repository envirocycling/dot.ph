<!DOCTYPE html>
<html lang="en">
    <!--dropdown menu src start-->
    <link href="css/select2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>
    <!--dropdown menu src end-->
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <link rel="stylesheet" type="text/css" href="css/pr_form.css">
</style>
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
                    
                    if(isset($_POST['submit'])){
                        $date_updated = date('Y/m/d H:i');
                        $title = mysql_real_escape_string($_POST['title']);
                        $from = date('Y/m/d H:i', strtotime($_POST['from']));
                        $to = date('Y/m/d H:i', strtotime($_POST['to']));
                        $ban = $_POST['ban'];
                        $facilitator = mysql_real_escape_string($_POST['facilitator']);
                        $venue = mysql_real_escape_string($_POST['venue']);
                        $row_ctrl = $_POST['row_ctrl'];
                        $num = 1;
                        $all_emp = '';
                        while($num <= $row_ctrl){
                            $emp_num = $_POST['emp_num'.$num];
                            $all_emp .= $emp_num;
                           $num++;
                        }
                        if(mysql_query("UPDATE training_seminar SET title='$title', from_date='$from', to_date='$to', facilitator='$facilitator', venue='$venue', participants='$all_emp', user_id='".$_SESSION['user_id']."', date_updated='$date_updated', attachment='".basename($_FILES["attachment"]["name"])."', ban='$ban' WHERE tns_id = '".$_GET['tns_id']."'") or die(mysql_error())){
                            $target = '../../attachment/tns/' . basename($_FILES["attachment"]["name"]);
                            $target_old = '../../attachment/tns/'.$_POST['current_attachment'];
                            $upload_name = basename($_FILES["attachment"]["name"]);
                            if (!empty($upload_name)) {
                                unlink($target_old);
                                    if (file_exists($target)){
                                        unlink($target);
                                    }
                                move_uploaded_file(@$_FILES["attachment"]["tmp_name"], $target);
                            }
                            echo '<script>
                                    window.top.location.href="view_trainingseminar.php?status=active&active=view&http=200";
                                </script>';
                        }else{
                            echo '<script>
                                    window.top.location.href="view_trainingseminar.php?status=active&active=view&http=400";
                                </script>';
                        }
                    }
                    
                    $sql_tns = mysql_query("SELECT * from training_seminar WHERE tns_id = '".$_GET['tns_id']."'") or die(mysql_error());
                    $row_tns = mysql_fetch_array($sql_tns);
                    
                    $emp = explode(')',$row_tns['participants']);
                    $num_part = 0;
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
                        <table width="65%">
                            <tr>
                                <td>Type:</td>
                                <td>
                                     <select name="training_type" required>
                                         <option value="<?php echo $row_tns['type'];?>"><?php echo strtoupper($row_tns['type']);?></option>
                                        <option value="in-house">IN-HOUSE</option>
                                        <option value="external">EXTERNAL</option>
                                    </select>
                                </td>
                                <td>Attachment:</td>
                                <td><input type="file" name="attachment" accept="application/pdf"></td>
                            </tr>
                            <tr>
                                <td>Title:</td>
                                <td><input type="text" name="title" value="<?php echo strtoupper($row_tns['title']);?>" required></td>
                                <td>Venue:</td>
                                <td><input type="text" name="venue" value="<?php echo strtoupper($row_tns['venue']);?>" required></td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td><input type="text" name="from" value="<?php echo date('Y/m/d h:i A', strtotime($row_tns['from_date']));?>" id="datetimepicker" placeholder="From" autocomplete="off" required><br><input type="text" name="to" value="<?php echo date('Y/m/d h:i A', strtotime($row_tns['to_date']));?>" id="datetimepicker2" placeholder="To" autocomplete="off" required></td>
                                <td>Facilitator:</td>
                                <td><input type="text" name="facilitator" value="<?php echo strtoupper($row_tns['facilitator']);?>" required></td>
                            </tr>
                            <tr>
                                <td>Ban:</td>
                                <td><input type="number" name="ban" min="1" value="<?php echo strtoupper($row_tns['ban']);?>" placeholder="In Months (if any)" autocomplete="off"></td>
                                <td colspan="2">Attachment Uploaded: <a href="../../attachment/tns/<?php echo $row_tns['attachment'];?>" target="_blank"><font color="blue" style="text-decoration: underline;"><i><?php echo $row_tns['attachment'];?></font></i></a></td>
                            </tr>
                            <?php
                            $num2 = 1;
                            $row = 150;
                            foreach ($emp as $attendee){
                                $attendee = str_replace("(","",$attendee);
                                if($attendee > 0){?>
                                    <script>
                                    $(document).ready(function () {
                                        $("#employee_<?php echo $num2; ?>").select2();
                                    });
                                </script>
                                <tr id="rows_<?php echo $num2; ?>" <?php echo @$attr; ?> >
                                    <td colspan="4"><center>Attendee <?php echo $num2; ?>:
                                    <select id="employee_<?php echo $num2; ?>" name="emp_num<?php echo $num2; ?>" style="width:40%;">
                                        <?php
                                        $sql_part = mysql_query("SELECT * from employees WHERE emp_num = '$attendee' ") or die(mysql_error());
                                        $row_part = mysql_fetch_array($sql_part);
                                        $str_count_part = strlen($row_part['middlename']) - 1;
                                        $middlename_part = substr($row_part['middlename'],0,-$str_count_part);
                                        if(empty($row_part['middlename'])){
                                            $middlename_part = '';
                                        }else{
                                            $middlename_part = ', '.$middlename_part.'.';
                                        }
                                        $fullname_part = ucwords($row_part['lastname'].', '.$row_part['firstname'].$middlename_part);
                                        echo '<option value="('.$row_part['emp_num'].')">'.$fullname_part.'</option>';
                                        
                                        $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                            $str_countemp = strlen($row_employee['middlename']) - 1;
                                            $emp_fullname = ucwords($row_employee['lastname'] . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ' . $row_employee['firstname']);
                                            echo '<option value="(' . $row_employee['emp_num'] . ')">' . $emp_fullname . '</option>';
                                        }
                                        ?>
                                    </select>
                                </center>
                                <br>
                                </td>
                                </tr>
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
                                    <td colspan="4"><center>Attendee <?php echo $num; ?>:
                                    <select id="employee_<?php echo $num; ?>" name="emp_num<?php echo $num; ?>" style="width:40%;">
                                        <option value="" selected > Please Select</option>
                                        <?php
                                        $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                            $str_countemp = strlen($row_employee['middlename']) - 1;
                                            $emp_fullname = ucwords($row_employee['lastname'] . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ' . $row_employee['firstname']);
                                            echo '<option value="(' . $row_employee['emp_num'] . ')">' . $emp_fullname . '</option>';
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
                                <input type="button" value="-" style="width:70px;" class="buttons" id="minus"></center></td>
                            </tr>
                        </table>
                        <br><br>
                        <input type="submit" class="btn btn-primary" name='submit' value="Update Record">
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
$(function(){
        $('input[name="attachment"]').change(function(){
            var attachment = $('input[name="attachment"]').val();
            var arr_attachment = attachment.split('.');
            var arr_count = (arr_attachment.length) - 1;
            var attachment_type = arr_attachment[arr_count].toUpperCase();
            
            if(attachment_type !== 'PDF' ){
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
                                    scrollMonth : false,
                                    scrollInput : false
                                });
                                $('#datetimepicker').datetimepicker({value: ''});
                                
                                $('#datetimepicker2').datetimepicker({
                                    dayOfWeekStart: 1,
                                    lang: 'ch',
                                    format: 'Y/m/d h:i A',
                                    disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                    startDate: '2016',
                                    scrollMonth : false,
                                    scrollInput : false
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
                                            $('#minus').attr('disabled',false);
                                            if(row_ctrl >= '150'){
                                                $('#add').attr('disabled',true);
                                            }
                                            
                                        }else if (act == 'minus') {
                                            var row_ctrl = Number($('#row_ctrl').val());
                                            $("#rows_" + row_ctrl).attr("hidden", true);
                                            $("#employee_" + row_ctrl).attr("required", false);
                                            var row_ctrl1 = Number($('#row_ctrl').val());
                                            var row_ctrl_min = row_ctrl1 - 1;
                                            $('#row_ctrl').val(row_ctrl_min);
                                            var row_ctrl_1 = Number($('#row_ctrl').val());
                                            if(row_ctrl_1 == 1){
                                                $('#minus').attr('disabled',true);
                                            }else{
                                                $('#minus').attr('disabled',false);
                                            }
                                            if(row_ctrl_1 < 150){
                                                $('#add').attr('disabled',false);
                                            }
                                        }
                                    });
                                });
                                //add-minus rows end
</script>


