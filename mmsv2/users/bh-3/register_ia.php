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
    <?php include 'layout/header.php'; 
    ?>
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
                <style>
                    .ia_title{
                        font-weight: bold;
                        font-style: italic;
                    }
                    textArea{
                        overflow: hidden;
                        resize: none;
                    }
                </style>
                <div class="main" align="center">
                    <br><br>
                    <form action="process/register_ia.php" method="post">
                        <table width="100%">
                            <tr>
                                <td class="header1" colspan="4"><span id="header2">Incident / Accident<br></span></td>
                            </tr>
                            <tr>
                                <td><hr></td>
                            </tr>
                        </table>
                        <table width="70%">
                            <tr>
                                <td>Date:</td>
                                <td align="left" style="width:90%;"><input type="text" name="date_submitted" value="<?php echo date('Y/m/d'); ?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Branch:</td>
                                <td>
                                    <select name="branch" required>
                                        <?php
                                        $sql_branch = mysql_query("SELECT * from branches WHERE status='' ORDER BY branch_name Asc") or die(mysql_error());
                                        echo '<option value="" selected disabled>Please Select</option>';
                                        while ($row_branch = mysql_fetch_array($sql_branch)) {
                                            if (strpos($_SESSION['branch_id'], '(' . $row_branch['branch_id'] . ')') !== false) {
                                                echo '<option value="' . $row_branch['branch_id'] . '">' . strtoupper($row_branch['branch_name']) . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Category:</td>
                                <td>
                                    <select name="category" required>
                                        <option value="" selected disabled>Please Select</option>
                                        <option value="for information">For Information</option>
                                        <option value="for delinquency">For Delinquency</option>
                                        <option value="for billing">For Billing</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Cost:</td>
                                <td><input type="number" placeholder="optional" name="cost"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br/><br/><span class="ia_title">Brief description of the incident:</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="description" style="width: 100%;" placeholder="Required" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">What happened?</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="what_happened" style="width: 100%;" placeholder="Required" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">When did it happen? (Indicate date and time):</span><br/>
                                    <input type="text" name="date_happened" id="datetimepicker" placeholder="required" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">Where did it happen? (Indicate the specific place of the incident)</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="where" style="width: 100%;" placeholder="Required" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">Who are the persons involved?</span></td>
                            </tr>
                            <?php
                            $num = 1;
                            $row = 20;
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
                                    <td colspan="4"><center><br/>Person <?php echo $num; ?>:

                                    <select id="employee_<?php echo $num; ?>" name="emp_num<?php echo $num; ?>" style="width:40%;">
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
                                <td colspan="2"><br><center>
                                <input type="button" value="+" style="width:70px;" class="buttons" id="add">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" value="-" style="width:70px;" class="buttons" id="minus" disabled></center></td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>

                            <tr>
                                <td colspan="2"><span class="ia_title">Corrective Action:</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="corrective_action" style="width: 100%;" placeholder="Required" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">Preventive Action:</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="preventive_action" style="width: 100%;" placeholder="Required" required></textarea>
                                </td>
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
//                                        $('#datetimepicker').keydown(false);
//date picker3 start
                                        $('#datetimepicker').datetimepicker({
                                            dayOfWeekStart: 1,
                                            lang: 'ch',
                                            format: 'Y/m/d H:i',
                                            startDate: '2016',
                                            scrollMonth: false,
                                            scrollInput: false
                                        });
                                        $('#datetimepicker').datetimepicker({value: '', step: 5});
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
                                                    if (row_ctrl >= '20') {
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
                                                    if (row_ctrl_1 < 20) {
                                                        $('#add').attr('disabled', false);
                                                    }
                                                }
                                            });

                                            $('select[name="branch"]').change(function () {
                                                var company_id = $(this).val();
                                                var f_num = 1;
                                                $.ajax({
                                                    url: 'process/register_ia2.php',
                                                    type: 'Post',
                                                    data: 'company_id=' + company_id
                                                }).done(function (e) {
                                                    while (f_num <= 20) {
                                                        $("#employee_" + f_num).html(e);
                                                        f_num++;
                                                    }
                                                });
                                            });
                                        });
                                        //add-minus rows end


</script>


