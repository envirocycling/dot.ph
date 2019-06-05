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
                        ?>
                    </div>

                    <div class="main" align="center">
                        <br/><br/>
                        <link rel="stylesheet" href="css/forms_new.css" type="text/css">
                        <script language="javascript" type="text/javascript" src="js/jquery.js"></script>


                        <!--datepicker start--->

                        <!--datepicker end--->
                        <!----rj-->
                        <script>
                            function isNumber(evt) {
                                evt = (evt) ? evt : window.event;
                                var charCode = (evt.which) ? evt.which : evt.keyCode;
                                if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
                                    return false;
                                }
                                return true;
                            }
                            
                            
    //leave balance computation                             
    function f_leave_comp(){

        var chk_leave = $('#sql_chk_leave').val();
        var no_days = $('#no_days').val();
        var bal_vl = Number($('#bal_vl').val());
        var bal_sl = Number($('#bal_sl').val());
        
        if($('#vl').attr('checked')){
            var new_vl = (bal_vl - no_days).toFixed(2);
            $('#balance_vl').val(new_vl);
        }else{
            $('#balance_vl').val(bal_vl);
        } 
        if($('#sl').attr('checked')){
            var new_sl = (bal_sl - no_days).toFixed(2);
            $('#balance_sl').val(new_sl);
        }else{
            $('#balance_sl').val(bal_sl);
        } 
                                
    }
    //end leave balance computation

                        </script>
                        <!----rj end-->

                        <?php
                        date_default_timezone_set("Asia/Singapore");
                        include("../../connect.php");
                        
                        $arr_slvl= array();
                        $arr_leaves= array();
                        //leave notation start
                        $sql_leaves = mysql_query("SELECT * from leaves WHERE emp_num='".$row_emp['emp_num']."' and  status LIKE 'approved%'") or die(mysql_error());
                            while($row_leaves = mysql_fetch_array($sql_leaves)){
                                if($row_leaves['validated'] == 1){
                                    @$arr_slvl[$row_leaves['leave_type']] += $row_leaves['no_days'];
                                    @$arr_leaves[$row_leaves['leave_type']] += $row_leaves['no_days'];
                                }
                                
                                if($row_leaves['leave_type'] == 'Sick Leave' || $row_leaves['leave_type'] == 'Vacation Leave' ){
                                    @$arr_usedleave += $row_leaves['no_days'];
                                }
                            }
                        $sql_chk_leave = mysql_query("SELECT * from entitled_leaves WHERE emp_num = '".$row_emp['emp_num']."'") or die(mysql_error());
                        $row_chk_leave = mysql_fetch_array($sql_chk_leave);
                        $num_reserved_leave = $row_chk_leave['vl'] + $row_chk_leave['sl'];
                        @$num_sl = $row_chk_leave['sl'] - $arr_slvl['Sick Leave'];
                        @$num_vl = $row_chk_leave['vl'] - $arr_slvl['Vacation Leave'];
                         //leave notation end
                        
                        echo '<input type="hidden" value="'.$num_sl.'" id="bal_sl">';
                        echo '<input type="hidden" value="'.$num_vl.'" id="bal_vl">';
                        
                        if(mysql_num_rows($sql_chk_leave) == 1){                           
                            echo '<input type="hidden" value="1" id="sql_chk_leave">';
                        }
                        
                        $sql_reliever1 = mysql_query("SELECT * from employees WHERE branch_id='".$row_branch['branch_id']."' and emp_num != '".$row_emp['emp_num']."' ORDER BY lastname Asc") or die(mysql_error());
                        $sql_reliever2 = mysql_query("SELECT * from employees WHERE branch_id='".$row_branch['branch_id']."' and emp_num != '".$row_emp['emp_num']."' ORDER BY lastname Asc") or die(mysql_error());
                        
                        $sql_supervisor = mysql_query("SELECT * from users WHERE branch_id LIKE '%(".$row_emp['branch_id'].")%'") or die(mysql_error());

                        $current_date = strtotime(date('Y/m/d')) . '<br>';
                        $date = date("Y/m/d");

                    echo "<form action='process/register_leave_pro.php' method='post'>";
                        echo '<div id="form_container">';
                        echo '<table class="mytable">
                        <tr>
                             <td id="comp_name"><label class="header_medium"><img src="../../images/logo.png" height="50px" width="60px" id="logo">Envirocycling Fiber Inc.</label><br/><label class="header_sub">Ninoy Aquino Highway, Mabalacat City Pampanga</label></td>
                             <td style="text-align: center;"><label class="header_large">Application For Leave And<br><br> Absence Form</label></td>
                        </tr>
                        <tr>
                            <td><div class="small_rectangel"><label class="form_label">Name of Employee: <u>' . strtoupper($fullname) . '</u> <input type="hidden" name="emp_num" value="' . $row_emp['emp_num'] . '"  readonly size=35></label></div></td>
                            <td><div class="small_rectangel"><label class="form_label">Date Filed: <u>' . $date . '</u><input type="hidden" value="' . $date . '" id="date" name="date_submitted" readonly></label></div></td>
                        </tr>
                        <tr>
                            <td><div class="small_rectangel"><label class="form_label">Branch / Position: <u>' . strtoupper($row_branch['branch_name'] . ' / ' . $row_position['position']) . '</u><input type="hidden" value="'. $row_position['p_id'] .'" id="position" name="position" readonly><input type="hidden" value="' . $row_branch['branch_id'] . ' " id="position" name="branch"></label></div></td>
                            <td><div class="small_rectangel"><label class="form_label">Date Affected: <input class="dates" type="text" style="width:115px;" id="datetimepicker" name="date_affected1" autocomplete="off" required/> to <input type="text" class="dates" style="width:115px;" id="datetimepicker2" name="date_affected2" autocomplete="off" required/> No.Days <input type="text" style="width:30px;" onKeypress="return isNumber(event);" onKeyup="f_leave_comp()" id="no_days" name="no_days" required></label></div></td>
                        </tr>
                </table>';

                        echo '<table class="mytable2">
                        <tr>
                            <td class="td" id="second_table_td1"><label style="font-weight: bold;">LEAVE TYPE: (Please tick your corresponding leave type)</label><br>
                                <div class="leave_type"><input type="checkbox" name="leave_type" class="leave" id="sl" value="Sick Leave" onclick="f_leave(this.id), f_leave_comp()" required>Sick Leave</div>
                                <div class="leave_type"><input type="checkbox" name="leave_type" class=\'leave\' id=\'vl\' value=\'Vacation Leave\'  onclick=\'f_leave(this.id), f_leave_comp()\' required>Vacation Leave</div>
                                <div class="leave_type"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'lwop\' value=\'Leave Without Pay\' onclick=\'f_leave(this.id), f_leave_comp()\' required>Leave w/o Pay(LWOP)</div>
                                <div class="leave_type"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'os\' value=\'Offset\' onclick=\'f_leave(this.id)\' required>Offset <input class="dates" type="text" style="width:115px;" id="datetimepicker3" name="os_date" autocomplete="off" disabled required/></div>
                                <div class="leave_type"><input type="checkbox" name="leave_type" class="leave" id="pl" value="Parental Leave" onclick="f_leave(this.id), f_leave_comp()" required>Parental Leave</div>
                                <div class="leave_type"><input type="checkbox" name="leave_type" class="leave" id="spl" value="Solo Parent Leave" onclick="f_leave(this.id), f_leave_comp()" required>Solo Parent Leave</div>
                                <div class="leave_type"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\' id=\'cs\' value=\'Change Schedule\' onclick=\'f_leave(this.id), f_leave_comp()\' required>Change Schedule (CS)</div><div class="leave_type2"><input class="dates" type="text" style="width:115px;" id="datetimepicker4" name="cs_date1" autocomplete="off" disabled required/> to <input type="text" style="width:115px;" class="dates" id="datetimepicker5" name="cs_date2" autocomplete="off" disabled required/></div>
                                <div class="leave_type2"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'hos\' value=\'Holiday Offset\' onclick=\'f_leave(this.id)\' required>Holiday Offset(HO) <input type="text" placeholder="Date of holiday" style="width:115px;" class="dates" id="datetimepicker6" name="hos_date" autocomplete="off" disabled required/></div>
                                <div class="leave_type2"><input type=\'checkbox\' name=\'leave_type\' class=\'leave\'  id=\'others\' value=\'Others\' onClick=\'f_leave(this.id), f_leave_comp()\' required>Others (pls.specify): <input type=\'text\' name=\'specify\' value=\'\' class=\'leave\' id=\'specify\' size=31 disabled required></div><br><br><br><br><br><br><br><br>
                                <div id="reason">Reason: (give specific reason)</div><div id="textarea"><textarea name=\'reason\' rows="5" id=\'reason\' required></textarea>'; //echo '<span class="remarks" hidden>Remarks: <br/><textarea type="text" cols="20" rows="3" style=" font-size:16px; font-weight:bold;" id="txt_remarks" readonly></textarea></span></div>
                        echo'</td>
                            <td align="center"><div id="reliever">DUTIES WILL BE PERFORMED BY: </div>
                                <div class="signature_reliever"></div>';
                        echo '<select name="reliever1" class="approver" style="width: 96%;">';
                        echo '<option value="">Click Here To Select - Optional</option>';
                                while($row_reliever1 = mysql_fetch_array($sql_reliever1)){
                                        $str_countr1 = strlen($row_reliever1['middlename']) - 1;
                                        $reliever1_fullname = ucwords($row_reliever1['lastname'].' '.substr($row_reliever1['middlename'],0,-$str_countr1).'. '.$row_reliever1['firstname']);
                                        echo '<option value="'.$row_reliever1['emp_num'].'">'.$reliever1_fullname.'</option>';
                                }
                        echo '</select>';
                        echo '<div id="reliever_name">(Signature over printed name)</div>
                                <div class="signature_reliever"></div>';
                        echo '<select name="reliever2" class="approver" style="width: 96%;">';
                        echo '<option value="">Click Here To Select - Optional</option>';
                                while($row_reliever2 = mysql_fetch_array($sql_reliever2)){
                                        $str_countr2 = strlen($row_reliever2['middlename']) - 1;
                                        $reliever2_fullname = ucwords($row_reliever2['lastname'].' '.substr($row_reliever2['middlename'],0,-$str_countr2).'. '.$row_reliever2['firstname']);
                                        echo '<option value="'.$row_reliever2['emp_num'].'">'.$reliever2_fullname.'</option>';
                                }
                        echo '</select>';
                        echo '<div id="reliever_name">(Signature over printed name)</div>
                            </td>
                        </tr>
                </table>';
                       echo '<table class="mytable3">
                        <tr>
                            <td class="tbl3_td1"><div id="action_taken">ACTION TAKEN:</div>';

                        echo '<div class="supervisor">Immediate Supervisor :&nbsp; </div><div class="action"><input type="checkbox" name="supervisor_action" id="supervisor_approved" value="approved" >approved</div><div class="action"><input type="checkbox" name="supervisor_action" id="supervisor_disapproved" value="not approved">not approved</div>
<div class="action_name">';
                        echo '<label class="approver">';
                        echo '<select name="supervisor" required>';
                            
                            echo '<option value="" selected disabled>Plese Select</option>';
                            while($row_supervisor = mysql_fetch_array($sql_supervisor)){
                                $sql_emp_sup = mysql_query("SELECT * from employees WHERE emp_num = '".$row_supervisor['emp_num']."' ") or die(mysql_error());
                                $row_emp_sup = mysql_fetch_array($sql_emp_sup);
                                $chk_str = strlen($row_emp_sup['middlename']);
                                if($chk_str > 1){
                                    $str_count = strlen($row_emp_sup['middlename']) - 1;
                                $middlename = substr($row_emp_sup['middlename'],0,-$str_count);
                                }else{
                                    $str_count = strlen($row_emp_sup['middlename']);
                                $middlename = $row_emp_sup['middlename'];
                                }
                                if(empty($row_emp_sup['middlename'])){
                                    $middlename = '';
                                }else{
                                    $middlename = ', '.$middlename.'.';
                                }
                                $fullname_sup = ucwords($row_emp_sup['lastname'].', '.$row_emp_sup['firstname'].$middlename);
                                echo '<option value="'.$row_supervisor['emp_num'].'">'.$fullname_sup.'</option>';
                            }
                        echo '</select>';
                        echo '</label></div>';
                        
                       // echo '<br/><br/><div id="app_from"><input type=\'checkbox\' name=\'supervisor_action\' id=\'supervisor_approved_from\' value=\'approved from\'>approved from <input type=\'text\' value=\'\' id=\'supervisor_from\' name=\'supervisor_from\' style="width:16%;" > - <input type=\'text\' value=\'\' id=\'supervisor_to\' name=\'supervisor_to\' style="width:16%;" ></div><div class="action_name2">Signature over printed name</div><br><br>';
                        /*echo '<br><br><br><div class="supervisor">Accounting Manager : &nbsp;</div><div class="action"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_approved\' value=\'approved\'>approved</div><div class="action"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_disapproved\' value=\'not approved\'>not approved</div><div class="action_name"><label class="approver">';
                             echo '<select name="accounting_manager" required>';
                            
                            echo '<option value="" selected disabled>Plese Select</option>';
                            echo '<option value="N/A">N/A</option>';
                                $sql_emp_sup = mysql_query("SELECT * from employees WHERE emp_num = '".$row_accthead['emp_num']."' ") or die(mysql_error());
                                $row_emp_sup = mysql_fetch_array($sql_emp_sup);
                                $chk_str = strlen($row_emp_sup['middlename']);
                                if($chk_str > 1){
                                    $str_count = strlen($row_emp_sup['middlename']) - 1;
                                $middlename = substr($row_emp_sup['middlename'],0,-$str_count);
                                }else{
                                    $str_count = strlen($row_emp_sup['middlename']);
                                $middlename = $row_emp_sup['middlename'];
                                }
                                if(empty($row_emp_sup['middlename'])){
                                    $middlename = '';
                                }else{
                                    $middlename = ', '.$middlename.'.';
                                }
                                $fullname_sup = ucwords($row_emp_sup['lastname'].', '.$row_emp_sup['firstname'].$middlename);
                                echo '<option value="'.$row_accthead['emp_num'].'">'.$fullname_sup.'</option>';
                        echo '</select>';
                        echo '</label></div>';*/
                        echo '<br><br><br><div class="supervisor">Operations Manager : &nbsp;</div><div class="action"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_approved\' value=\'approved\'>approved</div><div class="action"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_disapproved\' value=\'not approved\'>not approved</div><div class="action_name"><label class="approver">'.$gm_fullname.'</label><input type=\'hidden\' value="'.$row_gmname['emp_num'].'" id=\'manager_name\' name=\'manager\' size=25 readonly class="approver"></div><br/><br/>';
                               // <div id="app_from"><input type=\'checkbox\' name=\'manager_action\' id=\'manager_approved_from\' value=\'approved from\'>approved from <input type=\'text\' value=\'\' id=\'manager_from\' name=\'manager_from\'  style="width:16%;" > - <input type=\'text\' value=\'\' id=\'manager_to\' name=\'manager_to\' style="width:16%;" ></div><div class="action_name2">Signature over printed name</div><br><br><br><br>
                        echo '</td>
                            <td class="tbl3_td2"><div id="hr_not">HR Notation (Days): <br><center><h4><i>No. of Leave Submitted</i></h4></center></div>
                                <div class="hr_label">SL: <span class="leave_summary">'.round(@$arr_leaves['Sick Leave'],2).'</span></div>
                                <div class="hr_label">VL: <span class="leave_summary">'.round(@$arr_leaves['Vacation Leave'],2).'</span></div>
                                <div class="hr_label">LWOP: <span class="leave_summary">'.round(@$arr_leaves['Leave Without Pay'],2).'</span></div>
                                <div class="hr_label">CS: <span class="leave_summary">'.round(@$arr_leaves['Change Schedule'],2).'</span></div>
                                <div class="hr_label">Offset: <span class="leave_summary">'.round(@$arr_leaves['Offset'],2).'</span></div>
                                <div class="hr_label">HO: <span class="leave_summary">'.round(@$arr_leaves['Holiday Offset'],2).'</span></div>
                                <div class="hr_label_val">Leave Balance After This: <br><div style="width: 50%; float: left">VL: <input type="text" value="'.$num_vl.'" id="balance_vl"  name="balance_vl" style="width:20%;" readonly></div><div style="width: 50%; float: left">SL: <input type="text" value="'.$num_sl.'" id="balance_sl"  style="width:20%;" name="balance_sl" readonly></div></div>
                            </td>
                        </tr>
                   </table>';
                        echo '</div>';
                        echo '<br>';
                        echo '<div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>';
                        ?>
                        </form>
                        <br><br><br>
                    </div>
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
    
$('.dates').keydown(false);
//date picker1 start
                            $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                scrollMonth : false,
                                scrollInput : false,
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
                            $('#datetimepicker').datetimepicker({value: '', step: 30});
//date picker1 end

//date picker2 start
                            $('#datetimepicker2').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                scrollMonth : false,
                                scrollInput : false,
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
                            $('#datetimepicker2').datetimepicker({value: '', step: 30});
//date picker2 end

//date picker3 start
                            $('#datetimepicker3').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                scrollMonth : false,
                                scrollInput : false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
                            $('#datetimepicker3').datetimepicker({value: '', step: 30});
//date picker3 end

//date picker4 start
                            $('#datetimepicker4').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                datepicker:false,
                                scrollMonth : false,
                                scrollInput : false,
                                format:'h:i A'
                            });
                            $('#datetimepicker4').datetimepicker({value: '', step: 30});
//date picker4 end

//date picker5 start
                            $('#datetimepicker5').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                scrollMonth : false,
                                scrollInput : false,
                                datepicker:false,
                                format:'h:i A'
                            });
                            $('#datetimepicker5').datetimepicker({value: '', step: 30});
                            
                             $('#datetimepicker6').datetimepicker({
                                dayOfWeekStart: 1,
                                lang: 'en',
                                scrollMonth : false,
                                scrollInput : false,
                                timepicker:false,
                                format:'Y/m/d'
                            });
                            $('#datetimepicker6').datetimepicker({value: '', step: 30});
//date picker5 end

                    function f_leave(id) {
                                var no_days = Number($('#no_days').val());
                                var bal_vl = Number($('#bal_vl').val());
                                var bal_sl = Number($('#bal_sl').val());
                                var chk_leave = $('#sql_chk_leave').val();
                                if($('#' + id).attr('checked')){
                                    $('.leave').attr('disabled',true);
                                    $('#' + id).attr('disabled',false);
                                }else{
                                    $('.leave').attr('disabled',false);
                                }
                             
                                //var no2 = $('#no2').val();
                                
                                /*start leave compute
                                    if(chk_leave == 1){
                                        if($('#sl').attr('checked')){
                                            var new_bal_sl = Number(bal_sl - no_days);
                                            $('#balance_sl').val(new_bal_sl);
                                        }else if($('#vl').attr('checked')){
                                            var new_bal_vl = Number(bal_vl - no_days);
                                            $('#balance_vl').val(new_bal_vl);
                                        }else{
                                            $('#balance_sl').val(bal_sl);
                                            $('#balance_vl').val(bal_vl);
                                        }
                                    }
                                end leave compute*/

                                if (id != 'no_of_days') {
                                    if ($('#others').attr('checked')) {
                                        $('#specify').val("");
                                        $('#specify').attr('disabled', false);
                                        $('#datetimepicker4').attr('disabled', true);
                                        $('#datetimepicker5').attr('disabled', true);
                                        $('#datetimepicker3').attr('disabled', true);
                                        $('#datetimepicker4').val('');
                                        $('#datetimepicker5').val('');
                                        $('#datetimepicker3').val('');
                                        $('#datetimepicker6').val('');
                                        $('#hos').attr('required', false);
                                        $('#datetimepicker6').attr('disabled', true);
                                    }else if($('#cs').attr('checked')){
                                        $('#specify').val("");
                                        $('#specify').attr('disabled', true);
                                        $('#datetimepicker4').attr('disabled', false);
                                        $('#datetimepicker5').attr('disabled', false);
                                        $('#datetimepicker3').attr('disabled', true);
                                        $('#datetimepicker3').val("");
                                        $('#datetimepicker6').val('');
                                        $('#hos').attr('required', false);
                                        $('#datetimepicker6').attr('disabled', true);
                                    }else if($('#os').attr('checked')){
                                        $('#specify').val("");
                                        $('#specify').attr('disabled', true);
                                        $('#datetimepicker3').attr('disabled', false);
                                        $('#datetimepicker4').attr('disabled', true);
                                        $('#datetimepicker5').attr('disabled', true);
                                        $('#datetimepicker4').val('');
                                        $('#datetimepicker5').val('');
                                        $('#datetimepicker6').val('');
                                        $('#hos').attr('required', false);
                                        $('#datetimepicker6').attr('disabled', true);
                                    }else if($('#hos').attr('checked')){
                                        $('#specify').val("");
                                        $('#specify').attr('disabled', true);
                                        $('#datetimepicker6').attr('disabled', false);
                                        $('#datetimepicker3').attr('disabled', true);
                                        $('#datetimepicker4').attr('disabled', true);
                                        $('#datetimepicker5').attr('disabled', true);
                                        $('#datetimepicker3').val('');
                                        $('#datetimepicker4').val('');
                                        $('#datetimepicker5').val('');
                                    }else {
                                        $('#specify').attr('disabled', true);
                                        $('#hos').attr('required', false);
                                        $('#specify').val("");
                                        $('#datetimepicker4').attr('disabled', true);
                                        $('#datetimepicker5').attr('disabled', true);
                                        $('#datetimepicker3').attr('disabled', true);
                                        $('#datetimepicker4').val('');
                                        $('#datetimepicker5').val('');
                                        $('#datetimepicker3').val('');
                                        $('#datetimepicker6').val('');
                                        $('#datetimepicker6').attr('disabled', true);
                                    }

                                }

                            }
                            
</script>
