<!DOCTYPE html>
<html lang="en">
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
         .data{
            font-size: 15px;
        }
    </style>
    
    <script>
        $(document).ready(function(){
//            $('.cancel').click(function(){
//                var id = $(this).attr('id');
//                var dataX = 'id=' + id;
//                alert("asd");
////                $.ajax({
////                    url:"process/view_cancel_leave.php",
////                    type: "POST",
////                    data: dataX,
////                    success:function(){
////                        window.location.reload();
////                    }
////                });
//            });
        });
    </script>
    
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
                        if(isset($_POST['filter'])){
                                if(@$_POST['status'] == 'all'){
                                    $status_filter = '';
                                }else{
                                    $status_filter = @$_POST['status'];
                                }
                                if($_GET['status'] == 'sent'){
                                    $sql_leaves = mysql_query("SELECT * from leaves WHERE status LIKE '$status_filter%' and emp_num='".$row_user['emp_num']."' and date_submitted >= '".$_POST['from']."' and date_submitted <= '".$_POST['to']."' ORDER by date_submitted Asc") or die(mysql_error());
                                }else{
                                    $sql_leaves = mysql_query("SELECT * from leaves WHERE status LIKE '$status_filter%' and emp_num!='".$row_user['emp_num']."' and date_submitted >= '".$_POST['from']."' and supervisor_id='".$row_user['emp_num']."' and date_submitted <= '".$_POST['to']."' ORDER by date_submitted Asc") or die(mysql_error());
                                }
                                $from = $_POST['from'];
                                 $to = $_POST['to'];
                            }else{
                                if($_GET['status'] == 'sent'){
                                    $sql_leaves = mysql_query("SELECT * from leaves WHERE status LIKE  'pending%' and emp_num='".$row_user['emp_num']."' and manager_status LIKE '%pending%' and date_submitted LIKE '".date('Y')."%'  ORDER by date_submitted Asc") or die(mysql_error());
                                }else{
                                    $sql_leaves = mysql_query("SELECT * from leaves WHERE status LIKE  'pending to supervisor' and emp_num!='".$row_user['emp_num']."' and supervisor_status LIKE '%pending%' and date_submitted LIKE '".date('Y')."%' and supervisor_id='".$row_user['emp_num']."' ORDER by date_submitted Asc") or die(mysql_error());
                                }
                                 $from = date('Y/m');
                                 $from = $from.'/01'; 
                                $to = date('Y/m/t');                                
                            }
                        ?>
                        <link rel="stylesheet" type="text/css" href="css/override.css">
                    </div>
                    <!--Main body-->
                    <div class="main">
                        <br><br><center>
                            <table width='100%'>
                                <tr>
                                    <td class="header1" colspan="4"><center><?php echo '<font color="red"><b>'.ucwords($_GET['status']).'</font></b>'?> Leaves<br></center></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><hr></td>
                                </tr>
                            </table>
                            <input type="hidden" id="emp_num">
                            <table width="95%">
                                <tr>
                                <form method="post">
                                    <td colspan="8" align="right">Date: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker" name="from" autocomplete="off" placeholder="required" value="<?php echo $from;?>" required/> To: <input type="text" style="width:115px; height: 30px; margin-top: 10px;" id="datetimepicker1" name="to" autocomplete="off"  placeholder="required" value="<?php echo $to;?>" required/> 
                                        Status: <select name="status" style="width:115px; height: 30px; margin-top: 10px;">
                                            <?php if(isset($_POST['filter'])){
                                                $status = $_POST['status'];
                                                if(empty($status)){
                                                    $status='all';
                                                }
                                            }else{
                                                $status = 'pending';
                                            }
                                            ?>
                                            <option value="<?php echo $status;?>" selected ><?php echo ucwords($status);?></option>
                                            
                                            <option value="">All</option>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="disapproved">Disapproved</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        <input type="submit" class="btn btn-primary" value="Filter" name="filter">
                                    </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" id="leave_id">
                                        <table  class="data display datatable">
                                            <thead>
                                                <tr class="data">
                                                    <th class="data">Date Submitted</th>
                                                    <th class="data">Leave_No</th>
                                                    <th class="data">Employee Name</th>
                                                    <th class="data">Positon</th>
                                                    <th class="data">Company</th>
                                                    <th class="data">Branch</th>
                                                    <th class="data">Leave Type</th>
                                                    <th class="data">Status</th>
                                                    <th class="data" width="150px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                               
                                                while($row_leaves = mysql_fetch_array($sql_leaves)){
                                                    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$row_leaves['emp_num']."'") or die(mysql_error());
                                                    $row_emp = mysql_fetch_array($sql_emp);        
                                                    $chk_str = strlen($row_emp['middlename']);
                                                    if($chk_str > 1){
                                                        $str_count = strlen($row_emp['middlename']) - 1;
                                                    $middlename = substr($row_emp['middlename'],0,-$str_count);
                                                    }else{
                                                        $str_count = strlen($row_emp['middlename']);
                                                    $middlename = $row_emp['middlename'];
                                                    }
                                                    if(empty($row_emp['middlename'])){
                                                        $middlename = '';
                                                    }else{
                                                        $middlename = ', '.$middlename.'.';
                                                    }
                                                    $employee_fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middlename);
                                                    
                                                    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_emp['branch_id']."' ") or die(mysql_error());
                                                    $row_emp_branch = mysql_fetch_array($emp_branch);
                                                    
                                                    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_emp['position_id']."' ") or die(mysql_error());
                                                    $row_emp_position = mysql_fetch_array($emp_position);
                                                    
                                                    $emp_company = mysql_query("SELECT * from company WHERE company_id = '".$row_emp['company_id']."' ") or die(mysql_error());
                                                    $row_emp_company = mysql_fetch_array($emp_company);
                                                    
                                                    $num = 1;
                                                    
//                                                    if (strpos($row_user['branch_id'], '('.$row_leaves['branch_id'].')') !== false) {
                                                    if($row_leaves['emp_num'] == $row_user['emp_num'] || $row_leaves['supervisor_id'] == $row_user['emp_num']){
                                                        echo '<tr>
                                                                <td class="data">'.date('Y/m/d', strtotime($row_leaves['date_submitted'])).'</td>
                                                                <td class="data">'.$row_leaves['leave_id'].'</td>
                                                                <td class="data">'.$employee_fullname.'</td>
                                                                <td class="data">'.$row_emp_position['position'].'</td>
                                                                <td class="data">'.$row_emp_company['name'].'</td>
                                                                <td class="data">'.$row_emp_branch['branch_name'].'</td>
                                                                <td class="data">'.$row_leaves['leave_type'].'</td>
                                                                <td class="data">'.ucwords($row_leaves['status']).'</td>
                                                                <td class="data"><input type="image" data-jAlert data-title="Employee Leave Form" data-iframe="view_emp_leave.php?leave_id='.$row_leaves['leave_id'].'" title="View" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40">';
                                                                    if($row_leaves['status'] == 'pending'){
                                                                    echo '| <input type="image" class="cancel" title="Do you want to cancel this request?" src="../../images/button/cancel_icon.png" width="40" height="40" id="'.$row_leaves['leave_id'].'">';}
                                                                    echo '</td>
                                                        </tr>';
                                                        $num++;
                                                    }
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
            });
            
          $('input[type*="image"]').click(function(){
               var clas = $(this).attr('class');
               if(clas == 'cancel'){
                  var id = $(this).attr('id');
                  $('#leave_id').val(id);
                  var first = $('#' + id).confirmation({
                    onShow: function(reponse) {
                        console.log('Start show event');
                    }
                });
               }
            });
        
         
        </script>
        <link rel='stylesheet' href='pop-up/jAlert.css'>
	<script src='pop-up/jAlert.js'></script>
	<script src='pop-up/jAlert-functions.js'></script>
        <script src="pop-up/jAlert.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <script src="pop-up/confirmation.js"></script>
<script>
	$(function(){
            //for the data-jAlerts
            $.jAlert('attach');
        });
</script>
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
    $('#datetimepicker').keydown(false);
    $('#datetimepicker1').keydown(false);
    $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker').datetimepicker({value: '', step: 30});
                            
    $('#datetimepicker1').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker1').datetimepicker({value: '', step: 30});
</script>