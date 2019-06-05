<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
         .data{
            font-size: 15px;
        }
        #position{
            height: 30px;
            width: 300px;
        }
    </style>
        
    <body>
        <?php  include 'layout/header.php'; ?>
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
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center>Entitled Leaves<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                                <tr id="datas">
                                    <td colspan="4"><center><br><br>Employee: <span id="employee1"><select id="employee"  style="border-radius: 4px;" name="employee">
                                            <option value="" selected>Please Select</option>
                                        <?php
					$sql_employee = mysql_query("SELECT * from employees WHERE status_id='2' ORDER BY lastname Asc") or die (mysql_error());
                                            while($row_employee = mysql_fetch_array($sql_employee)){
                                            $str_countemp = strlen($row_employee['middlename']) - 1;
                                            $emp_fullname = ucwords($row_employee['lastname'].' '.substr($row_employee['middlename'],0,-$str_countemp).'. '.$row_employee['firstname']);
                                                
                                                $sql_chk = mysql_query("SELECT * from entitled_leaves WHERE emp_num='".$row_employee['emp_num']."'") or die(mysql_error());
                                                if(mysql_num_rows($sql_chk) == 0){
                                                    echo '<option value="'.$row_employee['emp_num'].'">'.$emp_fullname.'</option>';
                                                }
                                            }
					?>
                                    </select>
                                        </span>
                                        <select id="employee2"  style="border-radius: 4px;" name="employee2">
                                        <?php
					$sql_employee = mysql_query("SELECT * from employees WHERE status_id='2' ORDER BY lastname Asc") or die (mysql_error());
                                            while($row_employee = mysql_fetch_array($sql_employee)){
                                            $str_countemp = strlen($row_employee['middlename']) - 1;
                                            $emp_fullname = ucwords($row_employee['lastname'].' '.substr($row_employee['middlename'],0,-$str_countemp).'. '.$row_employee['firstname']);
                                                
                                                $sql_chk = mysql_query("SELECT * from entitled_leaves WHERE emp_num='".$row_employee['emp_num']."'") or die(mysql_error());
                                                if(mysql_num_rows($sql_chk) == 1){
                                                    echo '<option value="'.$row_employee['emp_num'].'">'.$emp_fullname.'</option>';
                                                }
                                            }
					?>
                                    </select>&nbsp;&nbsp;
                                    VL: <input type="number" style="width:60px; height: 30px;" step="any" min="0.1" name="vl" required>&nbsp;&nbsp;
                                    SL: <input type="number" style="width:60px; height: 30px;" step="any" min="0.1" name="sl" required>&nbsp;&nbsp;
                                    Date Effective: <input type="text" id="datetimepicker" value="<?php echo date('Y/m/d');?>" name="date_effective" required>
                                    <br><button class="btn btn-primary" id="save">Save</button> | <button class="btn btn-danger" id="cancel">Cancel</button></center><br><br><br><br></td>
                                </tr>
                            </table>
                            <input type="hidden" id="update_id">
                            <table width="80%">
                                <tr id="record_leave">
                                    <td colspan="4" align="right"><b>Record Leaves</b><input type="image" src="../../images/button/add_icon.png" height="40" width="40" class="record_leave"><br><br><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" id="position_id">
                                <tr>
                                    <td>
                                        <table  class="data display datatable">    
                                            <thead>
                                               <tr class="data">
                                               <th class="data" width="300px">Name</th>
                                               <th class="data">Emp#</th>
                                               <th class="data">Branch</th>
                                               <th class="data">Vacation Leave</th>
                                               <th class="data">Sick Leave</th>
                                               <th class="data">Date Effective</th>
                                               <th class="data">Action</th>
                                               </tr>
                                           </thead>
                                           <?php
                                            $sql_leave = mysql_query("SELECT * from entitled_leaves WHERE status=''") or die(mysql_error());
                                                while($row_leave = mysql_fetch_array($sql_leave)){
                                                    $sql_leave_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$row_leave['emp_num']."' ") or die(mysql_error());
                                                    $row_leave_emp = mysql_fetch_array($sql_leave_emp);
                                                    $str_countleave = strlen($row_leave_emp['middlename']) - 1;
                                                    $leave_fullname = ucwords($row_leave_emp['lastname'].' '.substr($row_leave_emp['middlename'],0,-$str_countleave).'. '.$row_leave_emp['firstname']);

                                                    $leave_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_leave_emp['branch_id']."' ") or die(mysql_error());
                                                    $row_leave_branch = mysql_fetch_array($leave_branch);        

                                                    echo '<tr>
                                                            <td>'.$leave_fullname.'</td>
                                                            <td>'.$row_leave_emp['emp_num'].'</td>
                                                            <td>'.ucwords($row_leave_branch['branch_name']).'</td>
                                                            <td>'.$row_leave['vl'].'</td>
                                                            <td>'.$row_leave['sl'].'</td>
                                                            <td>'.date('Y/m/d', strtotime($row_leave['date_effective'])).'</td>
                                                            <td><input type="image" class="edit"  id="edit_'.$row_leave['entleave_id'].'" src="../../images/button/edit_icon.png" width="40" height="40"></td>
                                                        </tr>';
                                                }
                                           ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </center><br><br><br>
                    </div>
                    <!--Main body end-->
                    
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

        <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
            $(document).ready(function () {
                setupLeftMenu();
                $('.datatable').dataTable();
                setSidebarHeight();
                var first = $('.cancel').confirmation({
                onShow: function() {
                    console.log('Start show event');
                }
                });
                
                $('#datas').hide();
                $('#employee2').hide();
            });
            
            
        $('button').click(function(){
                var action = $(this).attr("id");
                var action2 = $('#save').html();
                if(action == 'cancel'){
                    $('#datas').hide(100);
                    $('#record_leave').show(600);
                    $('#save').html('Save');
                    $('input[name="vl"]').val('');
                    $('input[name="sl"]').val('');
                }else if(action2 == 'Save'){
                    var employee = ($('#employee').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    var vl = Number($('input[name="vl"]').val());
                    var sl = Number($('input[name="sl"]').val());
                    var date_effective = $('input[name="date_effective"]').val();
                    
                    if( employee != ''){
                        var dataX = 'employee=' + employee + '&vl=' + vl + '&sl=' + sl + '&date_effective=' + date_effective + '&action=save';
                            $.ajax({
                                url: 'process/maintenance_edit_leave.php',
                                type: 'POST',
                                data: dataX,
                                success: function(e){
                                    if(e == ''){
                                        location.replace("maintenance_leaves.php?active=maintenance&http=200");
                                    }else if(e != ''){
                                        location.replace("maintenance_leaves.php?active=maintenance&http=400");
                                    }
                                }
                            });
                    }
                    
                }else if(action2 == 'Update'){
                    var employee = ($('#employee2').val()).replace("&","ampersand").replace("ñ","**").replace("Ñ","(*)");
                    var vl = Number($('input[name="vl"]').val());
                    var sl = Number($('input[name="sl"]').val());
                    var id = $('#update_id').val();
                    var date_effective = $('input[name="date_effective"]').val();
                    if(employee != ''){
                        var dataX = 'employee=' + employee + '&vl=' + vl + '&sl=' + sl + '&id=' + id + '&date_effective=' + date_effective + '&action=update';
                        
                            $.ajax({
                                url: 'process/maintenance_edit_leave.php',
                                type: 'POST',
                                data: dataX,
                                success: function(e){               
                                    if(e == ''){
                                        location.replace("maintenance_leaves.php?active=maintenance&http=200");
                                    }else if(e != ''){
                                        location.replace("maintenance_leaves.php?active=maintenance&http=400");
                                    }
                                }
                            });
                    }
                }
        });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'edit'){
                    var id = $(this).attr('id');
                    var entleave_id = id.split("_");
                    $('#record_leave').hide();
                    $('#update_id').val(entleave_id[1]);
                    $('#employee1').hide();
                    var dataX = 'entleave_id=' + entleave_id[1] + '&action=edit';
                        $.ajax({
                            type: 'POST',
                            data: dataX,
                            url: 'process/maintenance_edit_leave.php',
                            success: function(data){
                                var data = data.split("~");
                                $('#employee2').val(data[0]);
                                $('input[name="vl"]').val(data[1]);
                                $('input[name="sl"]').val(data[2]);
                                $('input[name="date_effective"]').val(data[3]);
                                $('#employee2').show(400);
                            }
                        });
                    $('#datas').show(300);
                    $('#save').html('Update');
               }else if(clas == 'record_leave'){
                   $('#employee2').hide();
                   $('#' + clas).hide();
                   $('#btn').html('Save');
                   $('#datas').show(300);
                   $('#employee1').show(400);
               }
            });
        </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
	<script src='pop-up/jAlert.js'></script>
	<script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="pop-up/confirmation.js"></script>
 <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
//date picker1 start
    $('#datetimepicker').datetimepicker({
        dayOfWeekStart: 1,
        lang: 'ch',
	timepicker:false,
	format:'Y/m/d',
	formatDate:'Y/m/d',
        startDate: '2016'
    });
</script>       
<!--dropdown menu src start-->
<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/select2.min.js"></script>
       <style>
            #employee{
                width: 300px;
		text-align:center;
                color: black;
                border-radius: 4px;
            }
        </style>
 <script>
	 $(document).ready(function () {
                $('#employee').select2();
       });
 </script>
 <!--dropdown menu src end-->