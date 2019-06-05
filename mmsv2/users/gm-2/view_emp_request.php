<link rel="stylesheet" type="text/css" href="validation/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/emp_record.css">
<link rel="stylesheet" href="btn_select/bower_components/Font-Awesome/css/font-awesome.css"/>
<link rel="stylesheet" href="btn_select/build.css"/>
<style>
.cb-enable, .cb-disable, .cb-enable span, .cb-disable span { background: url(bg.gif) repeat-x; display: block; float: left; }
.cb-enable span, .cb-disable span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
.cb-enable span { background-position: left -90px; padding: 0 10px; }
.cb-disable span { background-position: right -180px;padding: 0 10px; }
.cb-disable.selected { background-position: 0 -30px; }
.cb-disable.selected span { background-position: right -210px; color: #fff; }
.cb-enable.selected { background-position: 0 -60px; }
.cb-enable.selected span { background-position: left -150px; color: #fff; }
.switch label { cursor: pointer; }
.switch input { display: none; } 
</style>

<?php
session_start();
if(!isset($_SESSION['username-1'])){
    header("Location:../../index.php");
}
include('../../connect.php');

$request_id = $_GET['request_id'];
$request = $_GET['type'];
if(isset($_POST['submit'])){
    $approve = @$_POST['approve'];
    $cancel =  @$_POST['cancel'];
    
    $chk_emp = mysql_query("SELECT * from employees_request WHERE request_id ='$request_id'") or die(mysql_error()); 
        $row_emp = mysql_fetch_array($chk_emp);
        $emp_num = $row_emp['emp_num'];
        $firstname = $row_emp['firstname'];
        $middlename = $row_emp['middlename'];
        $lastname = $row_emp['lastname'];
        $birthdate = $row_emp['birthdate'];
        $st_brgy = $row_emp['st_brgy'];
        $town_city = $row_emp['town_city'];
        $province = $row_emp['province'];
        $contact_no = $row_emp['contact_no'];
        $civil_status = $row_emp['civil_status'];
        $date_hired = $row_emp['date_hired'];
        $date_start = $row_emp['date_start'];
        $company_id = $row_emp['company_id'];
        $branch_id = $row_emp['branch_id'];
        $position_id = $row_emp['position_id'];
        $status_id = $row_emp['status_id'];
        $stayin = $row_emp['stayin'];
        $tin = $row_emp['tin'];
        $sss_no = $row_emp['sss_no'];
        $phic_no = $row_emp['phic_no'];
        $hdmf_no = $row_emp['hdmf_no'];
        
    if($request == 'deactivate'){
        $date = $_POST['date'];
        if(!empty($approve)){
            if(mysql_query("INSERT INTO employees_deactivated (emp_num ,firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, civil_status, date_separated)
            VALUES ('$emp_num','$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company_id','$branch_id', '$position_id', '$status_id', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no','$civil_status','$date') ") or die (mysql_error())){
                if(mysql_query("DELETE from employees_request WHERE request_id = '$request_id' ") or die(mysql_error())){
                    mysql_query("DELETE from employees WHERE emp_num = '$emp_num' ") or die(mysql_error());
                    echo '<script>
                            window.top.location.href=("view_employee.php?status=todeactive&active=view&http=200");
                        </script>';
                }else{
                   echo '<script>
                            window.top.location.href=("view_employee.php?status=todeactive&active=view&http=400");
                        </script>'; 
                }
            }
        }else if(!empty($cancel)){
            if(mysql_query("DELETE from employees_request WHERE request_id = '$request_id' ") or die(mysql_error())){
                    echo '<script>
                             window.top.location.href=("view_employee.php?status=toadd&active=view&http=200");
                         </script>';
                }else{
                    echo '<script>
                             window.top.location.href=("view_employee.php?status=toadd&active=view&http=400");
                         </script>'; 
                }
        }

    }else if($request == 'add'){
        $user_id = $row_emp['user_id'];
        $date_created = $row_emp['date_created'];
        
        if(!empty($approve)){
                if(mysql_query("INSERT INTO employees (emp_num ,firstname, middlename, lastname, birthdate, st_brgy, town_city, province, contact_no, date_hired, date_start, company_id, branch_id, position_id, status_id, stayin, tin, sss_no, phic_no, hdmf_no, civil_status, date_created, user_id)
            VALUES ('$emp_num','$firstname', '$middlename', '$lastname', '$birthdate', '$st_brgy', '$town_city', '$province', '$contact_no', '$date_hired', '$date_start', '$company_id','$branch_id', '$position_id', '$status_id', '$stayin', '$tin', '$sss_no', '$phic_no', '$hdmf_no','$civil_status','$date_created', '$user_id') ") or die (mysql_error())){
                mysql_query("DELETE from employees_request WHERE request_id = '$request_id' ");
                echo '<script>
                        window.top.location.href=("view_employee.php?status=toadd&active=view&http=200");
                    </script>';
            }else{
               echo '<script>
                        window.top.location.href=("view_employee.php?status=toadd&active=view&http=400");
                    </script>'; 
                }
        }else if(!empty($cancel)){
              if(mysql_query("DELETE from employees_request WHERE request_id = '$request_id' ")){
                    echo '<script>
                             window.top.location.href=("view_employee.php?status=toadd&active=view&http=200");
                         </script>';
                }else{
                    echo '<script>
                             window.top.location.href=("view_employee.php?status=toadd&active=view&http=400");
                         </script>'; 
                }
        }
    }else if($request == 'edit'){
        $user_id = $row_emp['user_id'];
        $date_created = $row_emp['date_created'];
        
        if(!empty($approve)){
                if(mysql_query("UPDATE employees  SET firstname='$firstname', middlename='$middlename', lastname='$lastname', birthdate='$birthdate', st_brgy='$st_brgy', town_city='$town_city', province='$province', contact_no='$contact_no', stayin='$stayin', tin='$tin', sss_no='$sss_no', phic_no='$phic_no', hdmf_no='$hdmf_no', civil_status='$civil_status', date_created='$date_created', user_id='$user_id' WHERE emp_num='$emp_num'") or die (mysql_error())){
                mysql_query("DELETE from employees_request WHERE request_id = '$request_id' ");
                echo '<script>
                        window.top.location.href=("view_employee.php?status=toedit&active=view&http=200");
                    </script>';
            }else{
               echo '<script>
                        window.top.location.href=("view_employee.php?status=toedit&active=view&http=400");
                    </script>'; 
                }
        }else if(!empty($cancel)){
              if(mysql_query("DELETE from employees_request WHERE request_id = '$request_id' ")){
                    echo '<script>
                             window.top.location.href=("view_employee.php?status=toedit&active=view&http=200");
                         </script>';
                }else{
                    echo '<script>
                             window.top.location.href=("view_employee.php?status=toedit&active=view&http=400");
                         </script>'; 
                }
        }
    }
}

$sql_request = mysql_query("SELECT * from employees_request WHERE request_id = '$request_id'") or die(mysql_error());
$row_request = mysql_fetch_array($sql_request);
        
$sql_emp_data = mysql_query("SELECT * from employees_request WHERE request_id='$request_id'") or die(mysql_error());
$row_emp_data = mysql_fetch_array($sql_emp_data);

$company = mysql_query("SELECT * from company WHERE status='' and company_id='".$row_emp_data['company_id']."'") or die(mysql_error());
$row_company = mysql_fetch_array($company);

$position = mysql_query("SELECT * from positions WHERE status='' and p_id='".$row_emp_data['company_id']."'") or die(mysql_error());
$row_position = mysql_fetch_array($position);

$branch = mysql_query("SELECT * from branches WHERE status='' and branch_id='".$row_emp_data['branch_id']."'") or die(mysql_error());
$row_branch = mysql_fetch_array($branch);

$emp_status = mysql_query("SELECT * from employment_status WHERE e_id='".$row_emp_data['status_id']."'") or die(mysql_error());
$row_emp_status = mysql_fetch_array($emp_status);

if(!empty($row_emp_data['middlename'])){
    $middlename = ', '.$row_emp_data['middlename'];
}else{
    $middlename='';
}
//compare to know what is the edited start
if($request == 'edit'){
    $sql_req_edit = mysql_query("SELECT * from employees_request WHERE request_id = '$request_id'") or die(mysql_error());
    $row_req_edit = mysql_fetch_array($sql_req_edit);
    
    $sql_req_emp = mysql_query("SELECT * from employees WHERE emp_num='".$row_req_edit['emp_num']."'") or die(mysql_error());
    $row_req_emp = mysql_fetch_array($sql_req_emp);
    
    if($row_req_emp['lastname'] != $row_req_edit['lastname']){
        $attr_name = 'style="background-color:yellow;"';
    }if($row_req_emp['firstname'] != $row_req_edit['firstname']){
        $attr_name = 'style="background-color:yellow;"';
    }if($row_req_emp['middlename'] != $row_req_edit['middlename']){
        $attr_name = 'style="background-color:yellow;"';
    }if($row_req_emp['st_brgy'] != $row_req_edit['st_brgy']){
        $attr_add = 'style="background-color:yellow;"';
    }if($row_req_emp['town_city'] != $row_req_edit['town_city']){
        $attr_add = 'style="background-color:yellow;"';
    }if($row_req_emp['province'] != $row_req_edit['province']){
        $attr_add = 'style="background-color:yellow;"';
    }if($row_req_emp['birthdate'] != $row_req_edit['birthdate']){
        $attr_birt = 'style="background-color:yellow;"';
    }if($row_req_emp['civil_status'] != $row_req_edit['civil_status']){
        $attr_civ = 'style="background-color:yellow;"';
    }if($row_req_emp['contact_no'] != $row_req_edit['contact_no']){
        $attr_con = 'style="background-color:yellow;"';
    }if($row_req_emp['tin'] != $row_req_edit['tin']){
        $attr_tin = 'style="background-color:yellow;"';
    }if($row_req_emp['sss_no'] != $row_req_edit['sss_no']){
        $attr_sss = 'style="background-color:yellow;"';
    }if($row_req_emp['phic_no'] != $row_req_edit['phic_no']){
        $attr_phi = 'style="background-color:yellow;"';
    }if($row_req_emp['hdmf_no'] != $row_req_edit['hdmf_no']){
        $attr_hdm = 'style="background-color:yellow;"';
    }if($row_req_emp['stayin'] != $row_req_edit['stayin']){
        $attr_sta = 'style="background-color:yellow;"';
    }
}
//compare to know what is the edited end

echo '<center><table>
        <tr>
            <td id="logo" align="right"><img src="../../images/logo.png" height="50" width="50"></td>
            <td><span class="h1">Envirocycling Fiber Inc</span></td>
        </tr>
    </table></center>';

echo '<center><table>
        <tr>
            <td colspan="4" class="break"><span class="h2">Personal Information</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_name.'>Fullname:</td>
            <td align="left" colspan="2"><span class="val">'.$row_emp_data['lastname'].', '.$row_emp_data['firstname'].'</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_add.'>Address:</td>
            <td align="left"><span class="val">'.$row_emp_data['st_brgy'].',  '.$row_emp_data['town_city'].',  '.$row_emp_data['province'].'</span></td>
            <td class="td_1" '.@$attr_civ.'>Civil Status:</td>
            <td align="left"><span class="val">'.ucwords($row_emp_data['civil_status']).'</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_birt.'>Birthdate:</td>
            <td align="left"><span class="val">'.date('F d, Y' ,strtotime($row_emp_data['birthdate'])).'</span></td>
            <td class="td_1" '.@$attr_con.'>Contact No:</td>
            <td align="left"><span class="val">'.$row_emp_data['contact_no'].'</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_tin.'>TIN:</td>
            <td align="left"><span class="val">'.$row_emp_data['tin'].'</span></td>
            <td class="td_1" '.@$attr_sss.'>SSS No:</td>
            <td align="left"><span class="val">'.$row_emp_data['sss_no'].'</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_phi.'>PHIC No:</td>
            <td align="left"><span class="val">'.$row_emp_data['phic_no'].'</span></td>
            <td class="td_1" '.@$attr_hdm.'>HDMF No:</td>
            <td align="left"><span class="val">'.$row_emp_data['hdmf_no'].'</span></td>
        </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Job Information</span></td>
        </tr>
        <tr>
            <td class="td_1">Date Hired:</td>
            <td align="left"><span class="val">'.date('F d, Y', strtotime($row_emp_data['date_hired'])).'</span></td>
            <td>Date Started:</td>
            <td align="left"  style="width:20%;"><span class="val">'.date('F d, Y', strtotime($row_emp_data['date_start'])).'</span></td>
        </tr>
        <tr>
            <td class="td_1">Company:</td>
            <td align="left"><span class="val">'.$row_company['description'].' ('.$row_company['name'].')</span></td>
            <td style="width:20%;">Branch:</td>
            <td align="left"><span class="val">'.$row_branch['branch_name'].'</span></td>
        </tr>
        <tr>
            <td class="td_1">Position:</td>
            <td align="left"><span class="val">'.$row_position['position'].'</span></td>
            <td style="width:20%;">Employement Status:</td>
            <td align="left"><span class="val">'.$row_emp_status['code'].'</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_sta.'>Stay-in:</td>
            <td align="left"><span class="val">'.$row_emp_data['stayin'].'</span></td>
            <td style="width:20%;">Regularization Date:</td>
            <td align="left"><span class="val">'; if(strtotime($row_emp_data['date_regularization']) > 0){echo date('Y/m/d', strtotime($row_emp_data['date_regularization']));} echo'</span></td>
        </tr>';
            
        //if deactivated end
        if($request == 'deactivate'){
            echo '<tr>
                <td colspan="4" class="break"><span class="h2">Position Movement History</span></td>
            </tr>
            <tr>
                <td colspan="2" class="history"><center>Position</center></td>
                <td colspan="2" class="history"><center>Date</center></td>
            </tr>';

                //query position history start
                    $sql_posHis = mysql_query("SELECT * from manpower_movement WHERE emp_num='".$row_request['emp_num']."' and type LIKE 'transfer%' and approved_status = 'approved' ORDER BY date_submitted Asc") or die(mysql_error());
                    while($row_posHis = mysql_fetch_array($sql_posHis)){
                        $pos_ex = explode("~",$row_posHis['type']);
                        $slctd_pos = mysql_query("SELECT * from positions WHERE p_id='".$pos_ex['1']."'") or die(mysql_error());
                        $row_slctd_pos = mysql_fetch_array($slctd_pos);
                        echo '<tr><td colspan="2" class="history">'.date('F d, Y', strtotime($row_posHis['position_date_effective'])).'</td>
                              <td colspan="2" class="history"><center>'.$row_slctd_pos['position'].'</center><td></tr>';
                    }
                //query position history end

            echo '<tr>
                <td colspan="4" class="break"><span class="h2">Manpower Movement History</span></td>
            </tr>
            <tr>
                <td class="history" colspan="2"><center>Branch</center></td>
                <td class="history" colspan="2"><center>Type</center></td>
            </tr>';
                //query branch history start
                    $sql_braHis = mysql_query("SELECT * from manpower_movement WHERE emp_num='".$row_request['emp_num']."' and approved_status = 'approved' ORDER BY date_submitted Asc") or die(mysql_error());
                    while($row_braHis = mysql_fetch_array($sql_braHis)){
                        $slctd_bra = mysql_query("SELECT * from branches WHERE branch_id='".$row_braHis['branch_id']."'") or die(mysql_error());
                        $row_slctd_bra = mysql_fetch_array($slctd_bra);
                        echo '<tr><td colspan="2" class="history">'.$row_slctd_bra['branch_name'].'</td>
                              <td colspan="2" class="history"><center>'.$row_slctd_bra['class'].'</center><td></tr>';
                    }
                //query branch history end

            echo '<tr>
                <td colspan="4" class="break"><span class="h2">Training and Seminar Attended</span></td>
            </tr>
            <tr>
                <td class="history"><center>Date</center></td>
                <td class="history" colspan="3"><center>Title</center></td>
            </tr>';
            //query tns history start
                    $sql_tnsHis = mysql_query("SELECT * from training_seminar WHERE participants LIKE '%(".$row_request['emp_num'].")%' ORDER BY date Asc") or die(mysql_error());
                    while($row_tnsHis = mysql_fetch_array($sql_tnsHis)){
                        echo '<tr><td class="history">'.date('F d, Y', strtotime($row_tnsHis['date'])).'</td>
                              <td colspan="3" class="history"><center>'.$row_tnsHis['title'].'</center><td></tr>';
                    }
                //query tns history end
            echo '<tr>
                <td colspan="4" class="break"><span class="h2">Delinquency History</span></td>
            </tr>
            <tr>
                <td class="history"><center>Date Committed</center></td>
                <td class="history" colspan="3"><center>Violation</center></td>
            </tr>';
            //query tns history start
                    $sql_delHis = mysql_query("SELECT * from delinquency WHERE emp_num='".$row_request['emp_num']."' ORDER BY date_committed Asc") or die(mysql_error());
                    while($row_delHis = mysql_fetch_array($sql_delHis)){
                        echo '<tr><td class="history">'.date('F, d, Y', strtotime($row_delHis['date_committed'])).'</td>
                              <td colspan="3" class="history"><center>'.$row_delHis['violation'].'</center><td></tr>';
                    }
                //query tns history end
            echo '<tr>';
        }
         echo   '<tr class="btn_action">
                    <td colspan="4"><br><br><br><center><button class="btn btn-success" id="btn_action">Perform Action</button></center></td>
            </tr>
        </table>';
    //if deactivated end
        
        echo '<br><br>
            <form method="post" onsubmit="return confirm(\'Do you want to proceed? You cannot undo this process.\');">
            <table style="width:250px;">
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr class="action">
                    <td>
                        <center>
                            <div class="checkbox checkbox-success">
                            <input id="checkbox2" class="styled" type="checkbox" value="approve" name="approve">
                            <label for="checkbox2"><b>Approve</b></label>
                            </div>
                        </center>
                    </td>
                    <td>
                        <center>
                            <div class="checkbox checkbox-danger">
                            <input id="checkbox3" class="styled" value="cancel" type="checkbox" name="cancel">
                            <label for="checkbox3"><b>Cancel</b></label>
                            </div>
                        </center>
                    </td>
                </tr>
                    <td colspan="2" id="date_separated">
                        <center>Date Separated: <input type="text" placeholder="Required" id="datetimepicker"  style="width:115px; height: 30px; margin-top: 10px;" name="date" autocomplete="off"></center>
                    </td>
                </tr>
                <tr class="action">
                    <td colspan="2"><center><input type="submit" value="Submit" class="btn btn-primary" name="submit"></center></td>
                </tr>
            </table>
            </form>
</center>';
?>
<script src="validation/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
    $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                formatDate:'Y/m/d',
                                disabledDates: ['1986/01/08', '1986/01/09', '1986/01/10'],
                                startDate: '2016'
                            });
    $('#datetimepicker').datetimepicker({value: '', step: 30});
    
    $(document).ready(function (){
        $('input[type="checkbox"]').attr('required', true);
        $('.action').hide();
        $('#date_separated').hide(100);
        $('input[type="checkbox"]').click(function(){
             $('input[type="checkbox"]').attr('required', false);
            var action = $(this).attr('name');
            var type = "<?php echo $_GET['type'];?>";
            
            if(action == 'approve'){
                $('input[name="approve"]').attr('checked',true); 
                    if(type == 'deactivate'){
                        $('#datetimepicker').attr('required',true);
                        $('#date_separated').show(100);
                    }
                $('input[name="cancel"]').attr('checked',false);
            }else if(action == 'cancel'){
                $('input[name="cancel"]').attr('checked',true);
                if(type == 'deactivate'){
                    $('#date_separated').hide(100);
                    $('#datetimepicker').attr('required',false);
                }
                $('input[name="approve"]').attr('checked',false);
            }
        });
    });
    
    $('#btn_action').click(function(){
        $('.action').show(500);
        $('.btn_action').hide();
    });
</script>
                    