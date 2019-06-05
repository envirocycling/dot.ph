<!DOCTYPE html>
<html lang="en">
    <!--dropdown menu src start-->
    <link href="css/select2.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
    <!--dropdown menu src end-->

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
                        <table width="65%">
                            <tr>
                                <td>Type:</td>
                                <td>
                                     <select name="training_type" required>
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="in-house">In-house</option>
                                        <option value="external">External</option>
                                    </select>
                                </td>
                                <td>Attachment:</td>
                                <td><input type="file" name="attachment" accept="application/pdf"></td>
                            </tr>
                            <tr>
                                <td>Title:</td>
                                <td><input type="text" name="title" required></td>
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
                                <td>Ban:</td>
                                <td><input type="number" name="ban" min="1" placeholder="In Months (if any)" autocomplete="off"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $num = 1;
                            $row = 100;
                            echo '<input type="hidden" id="row_ctrl" name="row_ctrl" value="' . $num . '">';

                            while ($num <= $row) {
                                if ($num != 1) {
                                    $attr = 'hidden';
                                }if($num == 1){
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

                                    <select id="employee_<?php echo $num; ?>" name="emp_num<?php echo $num; ?>" style="width:40%;">
                                        <option value="" selected disabled> Please Select</option>
                                        <?php
                                        $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                           $str_chk = strlen($row_employee['middlename']);
                                            if($str_chk > 1){
                                                $str_countemp = strlen($row_employee['middlename']) - 1;
                                                $emp_fullname = ucwords($row_employee['lastname'].' '.substr($row_employee['middlename'],0,-$str_countemp).'. '.$row_employee['firstname']);
                                            }else{
                                                $str_countemp = strlen($row_employee['middlename']);
                                                $emp_fullname = ucwords($row_employee['lastname'].' '.$row_employee['middlename'].'. '.$row_employee['firstname']);
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
                        </table>
                        <br><br>
                        <input type="submit" class="btn btn-primary" value="Submit">
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
                                            if(row_ctrl >= '100'){
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
                                            if(row_ctrl_1 < 100){
                                                $('#add').attr('disabled',false);
                                            }
                                        }
                                    });
                                });
                                //add-minus rows end
</script>


