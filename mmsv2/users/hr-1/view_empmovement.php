<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="validation/bootstrap.css"/>
    <script type="text/javascript" src="validation/jquery.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../images/logo.png" />

    <style>
         .data{
            font-size: 15px;
        }
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
                            if(isset($_POST['filter'])){
                                if(@$_POST['status'] == 'all'){
                                    $status_filter = '';
                                }else{
                                    $status_filter = @$_POST['status'];
                                }
                                 $sql_mm = mysql_query("SELECT * from manpower_movement WHERE status LIKE '$status_filter%' and date_submitted >= '".$_POST['from']."' and date_submitted <= '".$_POST['to']."'") or die(mysql_error());
                                 $from = $_POST['from'];
                                 $to = $_POST['to'];
                            }else{
                                 $sql_mm= mysql_query("SELECT * from manpower_movement WHERE status LIKE 'pending%' and date_submitted LIKE '".date('Y')."%'") or die(mysql_error());
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
                                    <td class="header1" colspan="4"><center>Manpower Movement<br></center></td>
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
                                            <!-- <option value="approved">Approved</option> -->
                                            <option value="disapproved">Disapproved</option>
                                            <option value="transferred">Transferred</option>
                                            <option value="received">Received</option>
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
                                                    <th class="data">Employee Name</th>
                                                    <th class="data">ID No</th>
                                                    <th class="data">Current Position</th>
                                                    <th class="data">Date Submitted</th>
                                                    <th class="data">Class</th>
                                                    <th class="data">Branch</th>
                                                    <th class="data">Status</th>
                                                    <th class="data" width="120px">Action</th>	
                                                </tr>
                                            </thead>
                                            <?php
                                               
                                                while($row_mm = mysql_fetch_array($sql_mm)){
                                                    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$row_mm['emp_num']."'") or die(mysql_error());
                                                    if(mysql_num_rows($sql_emp) == 0){
                                                      $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '".$row_mm['emp_num']."'") or die(mysql_error()); 
                                                    }
                                                    $row_emp = mysql_fetch_array($sql_emp); 
                                                    $chk_count = strlen($row_emp['middlename']);
                                                    if($chk_count > 1){
                                                        $str_counted = strlen($row_emp['middlename']) - 1;
                                                        $middle = ', '.substr($row_emp['middlename'],0,-$str_counted).'.';
                                                    }else{
                                                        $middle = ', '.$row_emp['middlename'].'.';
                                                    }
                                                    $employee_fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middle);
                                                    
                                                    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_mm['branch_id']."' ") or die(mysql_error());
                                                    $row_emp_branch = mysql_fetch_array($emp_branch);
                                                    
                                                    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_mm['position_id']."' ") or die(mysql_error());
                                                    $row_emp_position = mysql_fetch_array($emp_position);
                                                    
                                                    $num = 1;
                                                    echo '<tr>
                                                            <td class="data">'.$employee_fullname.'</td>
                                                            <td class="data">'.$row_mm['mm_id'].'</td>
                                                            <td class="data">'.$row_emp_position['position'].'</td>
                                                            <td class="data">'.date('Y/m/d', strtotime($row_mm['date_submitted'])).'</td>
                                                            <td class="data">'.ucwords($row_mm['class']).'</td>
                                                            <td class="data">'.$row_emp_branch['branch_name'].'</td>
                                                            <td class="data">'.ucwords($row_mm['status']).'</td>
                                                            <td class="data"><input type="image" data-jAlert data-title="Manpower Movement Form" data-iframe="view_emp_empmovement.php?mm_id='.$row_mm['mm_id'].'" title="View" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40">';

                                                            echo ' | <img src="../../images/button/print_icon.png" width="40" height="40" title="Print" class="buttons" id="' . $row_mm['mm_id'] . '">';

                                                            if($row_mm['status'] != 'transferred'){
                                                                echo ' | <input type="image" class="cancel" id="'.$row_mm['mm_id'].'" title="Do you want to cancel this request?" src="../../images/button/cancel_icon.png" width="40" height="40">';
                                                            }
                                                            echo '</td>
                                                    </tr>';?>
                                                <?php
                                                $num++;
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

            $('.buttons').click(function () {
                var _thisId = $(this).attr('id');
                window.open('view_emp_empmovement_print.php?mm_id=' + _thisId);
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