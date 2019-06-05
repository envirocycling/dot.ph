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
                    <?php
                        $sql_ia = mysql_query("SELECT * from incident_accident WHERE report_id = '".$_GET['report_id']."'") or die(mysql_error());
                        $row_ia = mysql_fetch_array($sql_ia);
                        
                        $emp = explode(')',$row_ia['person']);
                        $num_part = 0;
                    ?>
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
                                <td align="left" style="width:90%;"><input type="text" name="date_submitted" value="<?php echo date('Y/m/d');?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Branch:</td>
                                <td>
                                    <select name="branch" required>
                                        <?php
                                            $sql_branchview = mysql_query("SELECT * from branches WHERE branch_id = '".$row_ia['branch_id']."'") or die(mysql_error());
                                            $row_branchview = mysql_fetch_array($sql_branchview);
                                            
                                            $sql_branch = mysql_query("SELECT * from branches WHERE status='' and branch_id != '".$row_branchview['branch_id']."' ORDER BY branch_name Asc") or die(mysql_error());
                                            echo '<option value="'.$row_branchview['branch_id'].'" selected>'.strtoupper($row_branchview['branch_name']).'</option>';
                                            while($row_branch = mysql_fetch_array($sql_branch)){
                                                echo '<option value="'.$row_branch['branch_id'].'">'.strtoupper($row_branch['branch_name']).'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><br/><br/><span class="ia_title">Brief description of the incident:</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="description" style="width: 100%;" placeholder="Required" required><?php echo $row_ia['description'];?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">What happened?</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="what_happened" style="width: 100%;" placeholder="Required" required><?php echo $row_ia['what_happened'];?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">When did it happen? (Indicate date and time):</span><br/>
                                    <input type="text" name="date_happened" id="datetimepicker" placeholder="required" value="<?php echo date('Y/m/d h:i A', strtotime($row_ia['date_happened']));?>" autocomplete="off" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">Where did it happen? (Indicate the specific place of the incident)</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="where" style="width: 100%;" placeholder="Required" required><?php echo $row_ia['where_happened'];?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">Who are the persons involved?</span></td>
                            </tr>
                             <?php
                            $num2 = 1;
                            $row = 20;
                            foreach ($emp as $attendee){
                                $attendee = str_replace("(","",$attendee);
                                if($attendee > 0){?>
                                    <script>
                                    $(document).ready(function () {
                                        $("#employee_<?php echo $num2; ?>").select2();
                                    });
                                </script>
                                <tr id="rows_<?php echo $num2; ?>" <?php echo @$attr; ?> >
                                    <td colspan="4"><center>Person <?php echo $num2; ?>:
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
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            
                            <tr>
                                <td colspan="2"><span class="ia_title">Corrective Action:</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="corrective_action" style="width: 100%;" placeholder="Required" required><?php echo $row_ia['corrective_action'];?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><span class="ia_title">Preventive Action:</span><br/>
                                    <textarea onkeyup="textAreaAdjust(this);" name="preventive_action" style="width: 100%;" placeholder="Required" required><?php echo $row_ia['preventive_action'];?></textarea>
                                </td>
                            </tr>
                        </table>
                        <br><br>
                        <input type="hidden" value="<?php echo $_GET['report_id'];?>" name="report_id">
                        <input type="submit" class="btn btn-primary" value="Update">
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
    $('#datetimepicker').keydown(false);
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
                                $('#datetimepicker').datetimepicker({value: '', step: 5});
//date picker3 end
                                function textAreaAdjust(o) {
                                    o.style.height = "1px";
                                    o.style.height = (0 + o.scrollHeight) + "px";
                                }

                                //add-minus rows start

                                $(document).ready(function () {
                                    var company_id = $('select[name="branch"]').val();
                                    var f_num = Number($('#row_ctrl').val()) + 1;
                                        $.ajax({
                                            url: 'process/register_ia2.php',
                                            type: 'Post',
                                            data: 'company_id=' + company_id
                                            }).done(function(e){ 
                                                while(f_num <= 20){
                                                    $("#employee_" + f_num).html(e);
                                                    f_num++;
                                                }
                                            });                                            
                                            
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
                                            if(row_ctrl >= '20'){
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
                                            if(row_ctrl_1 < 20){
                                                $('#add').attr('disabled',false);
                                            }
                                        }
                                    });
                                    
                                    $('select[name="branch"]').change(function(){
                                        var company_id = $(this).val();
                                        var f_num = 1;
                                        $.ajax({
                                            url: 'process/register_ia2.php',
                                            type: 'Post',
                                            data: 'company_id=' + company_id
                                            }).done(function(e){ 
                                                while(f_num <= 20){
                                                    $("#employee_" + f_num).html(e);
                                                    f_num++;
                                                }
                                            });
                                    });
                                });
                                //add-minus rows end
                                
                               
</script>


