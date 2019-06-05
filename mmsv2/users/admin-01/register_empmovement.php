<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/pr_form.css">
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
                    <!--start main-->
                    <div class="main" align="center">
                        <br><br>
                        <form action="process/register_mm_pro.php" method="post">
                        <table width="90%">
                            <tr>
                                <td class="header1" colspan="6"><span id="header1">Manpower Movement</span><br></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr></td>
                            </tr>
                            <tr>
                                <td colspan="2">Date Submitted:</td>
                                <td><input type="text" value="<?php echo date('F d, Y');?>" readonly><input type="hidden" name="date_submitted" value="<?php echo date('Y/m/d');?>"></td>
                                <td></td>
                                <td>Branch Submitted:</td>
                                <td><input type="text" value="<?php echo ucwords($row_branch['branch_name']);?>" readonly><input type="hidden" name="branch" value="<?php echo ucwords($row_branch['branch_id']);?>" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="2">Employee Name:</td>
                                 <td>
                                    <select id="emp_num" name="emp_num" required>
                                        <option value="" selected disabled> Please Select</option>
					<?php
					$sql_employee = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die (mysql_error());
                                            while($row_employee = mysql_fetch_array($sql_employee)){
                                            $str_chk = strlen($row_employee['middlename']);
                                            if($str_chk > 1){
                                                $str_countemp = strlen($row_employee['middlename']) - 1;
                                                $emp_fullname = ucwords($row_employee['lastname'].' '.substr($row_employee['middlename'],0,-$str_countemp).'. '.$row_employee['firstname']);
                                            }else{
                                                $str_countemp = strlen($row_employee['middlename']);
                                                $emp_fullname = ucwords($row_employee['lastname'].' '.$row_employee['middlename'].'. '.$row_employee['firstname']);
                                            }
                                            echo '<option value="'.$row_employee['emp_num'].'">'.strtoupper($emp_fullname).'</option>';
                                            }
					?>
                                    </select>
                                 </td>
                                 <td></td>
                                <td>Position:</td>
                                <td><input type="text" name="position" id="position" placeholder="Select Employee Name" readonly><input type="hidden" name="position_box" id="position_box"</td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><br><b>Type of Movement:</b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Class</td>
                                <td>
                                    <select name="class" id="class" required>
                                        <option value="" selected disabled>Please select</option>
                                        <option value="temporary">Temporary</option>
                                        <option value="permanent">Permanent</option>
                                    </select>
                                </td>
                                <td id="if_temp" colspan="2" hidden><input type="text" name="date1" id="datetimepicker1" style="width:30%;" autocomplete="off"> to <input type="text" name="date2" id="datetimepicker2" style="width:30%;" autocomplete="off"></td>
                                <td id="if_per" colspan="2" hidden>Effective Date: <input type="text" name="date3" id="datetimepicker3" style="width:30%;" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="radio" name="type" value="transfer" id="transfer" required> Transfer to other position</td>
                                <td style="padding-bottom: 10px;">
                                    <select id="transfer_box" name="transfer_box" class="radio" disabled>
                                        <option value="" selected disabled> Please Select</option>
					<?php
					$sql_positions = mysql_query("SELECT * from positions ORDER BY position Asc") or die (mysql_error());
                                            while($row_positions = mysql_fetch_array($sql_positions)){
                                                echo '<option value="'.$row_positions['p_id'].'">'.strtoupper($row_positions['position']).'</option>';
                                            }
					?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="radio" name="type" value="move" id="move" required> Move to other company</td>
                                <td>
                                    <select name="move_box" class="radio" id="move_box" disabled>
                                        <option value="">Please select</option>
                                        <?php 
                                            $sql_company= mysql_query("SELECT * from company WHERE  status=''") or die(mysql_error());
                                            while($row_company = mysql_fetch_array($sql_company)){
                                                echo '<option value="'.$row_company['company_id'].'">'.strtoupper($row_company['name']).'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="radio" name="type" value="deactivate" id="deactivate" required> Deactivated (Resigned / Endo)</td>
                                <td><input type="text" name="deactivate_box" class="radio" id="deactivate_box" disabled></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="radio" name="type" value="reassign" id="reassign" required> Reassign to other branch</td>
                                <td>
                                    <select name="reassign_box" class="radio" id="reassign_box" disabled>
                                        <option value="">Please select</option>
                                        <?php 
                                            $sql_branch= mysql_query("SELECT * from branches WHERE status='' ORDER BY branch_name Asc") or die(mysql_error());
                                            while($row_branch= mysql_fetch_array($sql_branch)){
                                                echo '<option value="'.$row_branch['branch_id'].'">'.strtoupper($row_branch['branch_name']).'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td colspan="2" id="bh_td" hidden>BH: &nbsp;&nbsp;<span id="bh"></span><input type="hidden" id="bh_box" name="bh_box"></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br>Please be advised as well, that the employee will entitled to:</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>In-house accommodation</td>
                                <td>
                                    <select name="in_house" required>
                                        <option value="" selected disabled>Please select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Free transportation</td>
                                <td>
                                    <select name="transportation" required>
                                        <option value="" selected disabled>Please select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Change in rate</td>
                                <td><input type="text" name="rate" onkeypress="return isNum(event);" placeholder="If any"></td>
                            </tr>
                            <tr>
                                <td colspan="4" height="150px"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td align="center"><u><font size="2">Requested By: <?php echo $fullname;?></font></u></td>
                                <td align="center" colspan="2"><u><font size="2">Approved By: <?php echo $gm_fullname;?></font></u><input type="hidden" value="<?php echo $row_gm['emp_num'];?>" name="approved_id"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td align="center"><i><?php echo $row_position['position'];?></i></td>
                                <td align="center" colspan="2"><i><?php echo $row_gmposition['position'];?></i></td>
                            </tr>
                        </table>
                        <br><br><br>
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
                $('#emp_num').select2();
       });
       $(document).ready(function () {
                $('#transfer_box').select2();
       });

function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (0+o.scrollHeight)+"px";
}

 </script>
 <!--dropdown menu src end-->
 <!--get data start-->
<script>
    $('select').change(function (){
        var id = $(this).attr('id');
        
        if(id == 'emp_num'){    
            var emp = $('#emp_num').val();
            var dataX = 'emp_id=' + emp;
                $.ajax({
                    type:'POST',
                    data: dataX,
                    url: 'process/register_tns_empdata.php',
                    cache: true,
                    dataType: 'text',
                    success: function(data){
                        var position = data.split('-');;
                        $('#position').val(position[0]);
                        $('#position_box').val(position[1]);
                    }
                });
        }else if(id == 'reassign_box'){    
            var branch = $('#reassign_box').val();
            var dataX = 'branch_id=' + branch;
                $.ajax({
                    type:'POST',
                    data: dataX,
                    url: 'process/register_mm_bhdata.php',
                    cache: true,
                    dataType: 'text',
                    success: function(data){
                        var bh_data = data.split('-');
                        $('#bh').html(bh_data[0]);
                        $('#bh_box').val(bh_data[1]);
                        $('#bh_td').attr('hidden',false);
                    }
                });
                
        }
    });
   //get data end-->
   function isNum(evt) {
                        evt = (evt) ? evt : window.event;
                        var code = (evt.which) ? evt.which : evt.keyCode;
                        if (!(code > 47 && code < 58) && (code != 43) && (code != 45)){ // numeric (0-9)
                          return false;
                        }
                        return true;
                    }  
 </script>
 <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
//date picker3 start
                                $('#datetimepicker1').datetimepicker({
                                    dayOfWeekStart: 1,
                                    lang: 'ch',
                                    timepicker: false,
                                    format: 'Y/m/d',
                                    disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                    startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                                });
                                $('#datetimepicker1').datetimepicker({value: ''});
                                
                                $('#datetimepicker2').datetimepicker({
                                    dayOfWeekStart: 1,
                                    lang: 'ch',
                                    timepicker: false,
                                    format: 'Y/m/d',
                                    disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                    startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                                });
                                $('#datetimepicker2').datetimepicker({value: ''});
                                
                                $('#datetimepicker3').datetimepicker({
                                    dayOfWeekStart: 1,
                                    lang: 'ch',
                                    timepicker: false,
                                    format: 'Y/m/d',
                                    disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                    startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                                });
                                $('#datetimepicker3').datetimepicker({value: ''});
//date picker3 end

    $('#class').change(function(){
        var my_class = $('#class').val();
        if(my_class == 'temporary'){
            $('#if_temp').attr('hidden',false);
            $('#datetimepicker1').attr('required',true);
            $('#datetimepicker2').attr('required',true);
        }else{
            $('#if_temp').attr('hidden',true);
            $('#datetimepicker1').attr('required',false);
            $('#datetimepicker2').attr('required',false);
            $('#datetimepicker1').val('');
            $('#datetimepicker2').val('');
            
        }
        if(my_class == 'permanent'){
            $('#if_per').attr('hidden',false);
            $('#datetimepicker3').attr('required',true);
        }else{
            $('#if_per').attr('hidden',true);
            $('#datetimepicker3').attr('required',false);
            $('#datetimepicker3').val('');
            
        }
    });
    
    $('input:radio').click(function(){
       var id = $(this).attr('id');
       $('.radio').attr('disabled',true);
       $('.radio').val('');
       if($(id).attr('check','checked')){
           var dis = id + '_box';
            $('#'+dis).attr('disabled',false);
            $('#'+dis).attr('required',true);
        }
        if(id!='reassign'){
            $('#bh_td').attr('hidden',true);
            $('#bh_box').val('');
        }
    });
</script>