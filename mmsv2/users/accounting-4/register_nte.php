<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />
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
                        date_default_timezone_set("Asia/Manila");
                        ?>
                    </div>
                    <style>
                        .txt2{
                            text-indent: 70px;
                            font-weight: bold;
                        }
                        .txt{
                            font-weight: bold;
                            padding-top: 20px;
                        }
                        .txt3{
                            font-weight: bold;
                            padding-top: 20px;
                            font-size: 12px;
                        }
                        .txt4{
                            font-size: 12px;
                            padding-top: 0px;
                        }
                        .txt5{
                            font-size: 16px;
                            font-weight: lighter;
                            padding-top: 10px;
                        }
                        .textarea{
                            resize: none;
                            width: 100%;
                        }
                        select{
                            width: 350px;
                        }
                    </style>
                    <!--start main-->
                    <div class="main" align="center">
                        <br><br>
                        <form action="process/register_ntePro.php" method="post">
                            <table width="85%">
                                <tr>
                                    <td style="color: gray;" colspan="2"><?php echo '<h4><b><span id="company"></span></b></h4>'; ?></td>
                                    <td style="text-align: right; color: gray;"><h3><b>NOTICE TO EXPLAIN</b></h3></td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td style="text-align: right; color: gray;"><h4><?php echo date('F d, Y') ?></h4></td>
                                </tr>
                                <tr>
                                    <td class="txt" colspan="2">TO:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="txt2">EMPLOYEE NAME :</td>
                                    <td colspan="2">
                                        <?php
                                        echo '<select name="emp" id="emp_num" required>';
                                        echo '<option value="" selected disabled>Please Select</option>';
                                        $sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die(mysql_error());
                                        while ($row_employee = mysql_fetch_array($sql_employee)) {
                                                $chk_str = strlen($row_employee['middlename']);
                                                if ($chk_str > 1) {
                                                    $str_count = strlen($row_employee['middlename']) - 1;
                                                    $middlename2 = substr($row_employee['middlename'], 0, -$str_count);
                                                } else {
                                                    $str_count = strlen($row_employee['middlename']);
                                                    $middlename2 = $row_employee['middlename'];
                                                }
                                                if (empty($row_employee['middlename'])) {
                                                    $middlename2 = '';
                                                } else {
                                                    $middlename2 = ', ' . $middlename2 . '.';
                                                }
                                                $fullname2 = strtoupper($row_employee['lastname'] . ', ' . $row_employee['firstname'] . $middlename2);
                                                echo '<option value="' . $row_employee['emp_num'] . '">' . $fullname2 . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="txt2">POSITION :</td>
                                    <td class="txt5" id="emp_position" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="txt2">BRANCH :</td>
                                    <td class="txt5" id="emp_branch" colspan="2"></td>
                                </tr>
                                <tr>
                                    <td class="txt">RE :</td>
                                    <td colspan="2"><br/><br/>
                                        <select name="delinquency" required>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="txt">FR :</td>
                                    <td colspan="2" class="txt5"><?php echo strtoupper($row_department['description']);?></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><hr></td>
                                </tr>
                                <tr>
                                    <td colspan="3">This office has received information/complaint of your alleged violation of company policy detailed hereunder: </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><textarea class="textarea" placeholder="Committed Delinquency/Violation" onkeyup="textAreaAdjust(this);" name="description"></textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br />In which it is a clear violation of our Company rules on <b>(Violated Company Policies)</b><br /><br />
                                        Please explain in writing and submit to the undersigned a letter explaining your side <b>within 120 hours</b> upon receipt of this notice. Failure to submit your explanation within the period above means that you waive your right to be heard and the management will decide on your case on the basis of the evidence at hand, and if warranted, impose the appropriate sanction.
                                        <br /><br /><br /><br />Please be guided accordingly.<br /><br /> <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo '<span class="txt3">' . $fullname . '</span><br><span class="txt4">' . $row_position['position'] . '</span><br /><br /><br /><br />'; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="txt4">Received By:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php echo '<br /><span class="txt3" id="emp_name"></span><br><span class="txt4" id="emp_position2"></span><br/><span class="txt4">Date Received: _______________________</span>'; ?></td>
                                    <td></td>
                                </tr>
                            </table>
                            <br><br>
                            <input type="hidden" name="dep_id" value="<?php echo $row_department['dep_id'];?>">
                            <input type="hidden" name="supervisor_num" value="<?php echo $_SESSION['emp_num'];?>">
                            <input type="hidden" name="supervisor_position" value="<?php echo $row_position['p_id'];?>">
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
<!--dropdown menu src start-->

<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
<script>
                                        $(document).ready(function () {
                                            $('[name=delinquency]').hide();
                                            $('#emp_num').change(function () {
                                                var _this = this.value;
                                                var _thisText = $('#emp_num option:selected').text();
                                                $('#emp_name').text(_thisText);
                                                $.ajax({
                                                    url: 'process/register_nteData.php?emp_num=' + _this,
                                                    async: false
                                                }).done(function (e) {
                                                    var eSplit = e.split('~');
                                                    $('#company').text(eSplit[0]);
                                                    $('#emp_position').text(eSplit[2]);
                                                    $('#emp_position2').text(eSplit[2]);
                                                    $('#emp_branch').text(eSplit[1]);
                                                    $('[name=delinquency]').html(eSplit[3]);
                                                    $('[name=delinquency]').show();
                                                });
                                            });
                                        });
</script>
<!--dropdown menu src end-->

<!--get data start-->
<script>
    //get data end-->

    function textAreaAdjust(o) {
        o.style.height = "1px";
        o.style.height = (0 + o.scrollHeight) + "px";
    }
</script>

<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
//date picker3 start
    $('#datetimepicker').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'ch',
        timepicker: false,
        format: 'Y/m/d',
        startDate: '2016',
        scrollMonth: false,
        scrollInput: false
    });
    $('#datetimepicker').datetimepicker({value: ''});
//date picker3 end

</script>

<link href="../css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#emp_num').select2();
        $('#datetimepicker').keydown(false);

        $('input[type="checkbox"]').click(function () {
            if ($(this).attr('checked')) {
                $('input[type="checkbox"]').attr('checked', false);
                $(this).attr('checked', true);
                $('#report_num').attr('hidden', false);
                $('select[name="report_number"]').attr('required', true);
            } else {
                $(this).attr('checked', false);
                $('#report_num').attr('hidden', true);
                $('select[name="report_number"]').attr('required', false);
            }

        });
    });
</script>