<link rel="stylesheet" type="text/css" href="validation/bootstrap.css">
<link rel="stylesheet" type="text/css" href="validation/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/emp_record.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>

<style>
    table{
        text-transform: uppercase;
    }
    input{
        border-radius: 3px;
    }
</style>
<?php
session_start();
if(!isset($_SESSION['username-1'])){
    header("Location:../../index.php");
}
include('../../connect.php');

    $emp_num = $_GET['emp_num'];

    $sql_emp_data = mysql_query("SELECT * from employees WHERE emp_num='$emp_num'") or die(mysql_error());
    if(mysql_num_rows($sql_emp_data) == 0){
        $sql_emp_data = mysql_query("SELECT * from employees_deactivated WHERE emp_num='$emp_num'") or die(mysql_error());
        $emp_deactivated = 1;
    }
    $row_emp_data = mysql_fetch_array($sql_emp_data);

    $company = mysql_query("SELECT * from company WHERE status='' and company_id='".$row_emp_data['company_id']."'") or die(mysql_error());
    $row_company = mysql_fetch_array($company);

    $position = mysql_query("SELECT * from positions WHERE status='' and p_id='".$row_emp_data['position_id']."'") or die(mysql_error());
    $row_position = mysql_fetch_array($position);

    $branch = mysql_query("SELECT * from branches WHERE status='' and branch_id='".$row_emp_data['branch_id']."'") or die(mysql_error());
    $row_branch = mysql_fetch_array($branch);
    
    $sql_rank = mysql_query("SELECT * from rank WHERE r_id='".$row_emp_data['rank_id']."'") or die(mysql_error());
    $row_rank = mysql_fetch_array($sql_rank);

    $emp_status = mysql_query("SELECT * from employment_status WHERE e_id='".$row_emp_data['status_id']."'") or die(mysql_error());
    $row_emp_status = mysql_fetch_array($emp_status);
    
    $arr_tertiary = explode('~',$row_emp_data['tertiary']);
    $arr_secondary = explode('~',$row_emp_data['secondary']);
    $arr_primary = explode('~',$row_emp_data['elementary']);

    if(!empty($row_emp_data['middlename'])){
        $middlename = ', '.$row_emp_data['middlename'];
    }else{
        $middlename='';
    }

echo '<center>';
echo @$_SESSION['err'];
echo '<form action="process/view_delete_employee.php" method="post">';
echo '<input type="hidden" value="'.$emp_num.'" name="emp_num">';
echo '<table>
        <tr>
            <td colspan="3"><center><h3><font color="red">Deactivate this Employee</font></h3></center></td>
        </tr>
        <tr>
            <td width="200px"><br>';
                $image_path = "../../images/emp-data/".$row_emp_data['emp_num'].".png";
                if(file_exists($image_path)){?>
                    <img src="../../images/emp-data/<?php echo $row_emp_data['emp_num'];?>.png" id="myImage" width="150" height="150">
                <?php
                }
        echo '</td>
            <td>Date Separated: <input type="text" id="datetimepicker" name="date_separated" autocomplete="off" required></td>
            <td>Reason: <input type="text" style="width:75%" name="reason" required></td>
        </tr>
        <tr>
            <td colspan="3"><center><input type="submit" name="submit" value="Deactivate" class="btn-danger"></center></td>
        </tr>
</table>';
echo "</form>"; 
echo '<center><table>
        <tr>
            <td id="logo" align="right"><img src="../../images/logo.png" height="80" width="80"></td>
            <td><span class="h1">Envirocycling Fiber Inc</span></td>
        </tr>
    </table></center>';

echo '<center><table>
        <tr>
            <td colspan="4" class="break"><span class="h2">Personal Information</span></td>
        </tr>
        <tr>
            <td class="td_1" '.@$attr_name.'>Fullname (L,F,M):</td>
            <td align="left"><span class="val">'.$row_emp_data['lastname'].', '.$row_emp_data['firstname'].', '.$row_emp_data['middlename'].'</span></td>
            <td class="td_1">Civil Status:</td>
            <td align="left"><span class="val">'.ucwords($row_emp_data['civil_status']).'</span></td>
        </tr>
        <tr>
            <td class="td_1">Address:</td>
            <td align="left"><span class="val">'.$row_emp_data['st_brgy'].',  '.$row_emp_data['town_city'].',  '.$row_emp_data['province'].'</span></td>
            <td class="td_1">Gender:</td>
            <td align="left"><span class="val">'.ucwords($row_emp_data['gender']).'</span></td>
        </tr>
        <tr>
            <td class="td_1">Birthdate:</td>
            <td align="left"><span class="val">'.date('F d, Y' ,strtotime($row_emp_data['birthdate'])).'</span></td>
            <td class="td_1">Contact No:</td>
            <td align="left"><span class="val">'.$row_emp_data['contact_no'].'</span></td>
        </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Educational Attainment</span></td>
        <tr>
        <tr>
            <td class="td_1">Tertiary:</td>
            <td align="left"><span class="val">'.strtoupper(@$arr_tertiary[0]).'</span></td>
            <td class="td_1">Year Graduated:</td>
            <td align="left"><span class="val">'.@$arr_tertiary[1].'</span></td>
        </tr>
        <tr>
            <td class="td_1">Secondary:</td>
            <td align="left"><span class="val">'.strtoupper(@$arr_secondary[0]).'</span></td>
            <td class="td_1">Year Graduated:</td>
            <td align="left"><span class="val">'.@$arr_secondary[1].'</span></td>
        </tr>
        <tr>
            <td class="td_1">Elementary:</td>
            <td align="left"><span class="val">'.strtoupper(@$arr_primary[0]).'</span></td>
            <td class="td_1">Year Graduated:</td>
            <td align="left"><span class="val">'.@$arr_primary[1].'</span></td>
        </tr>
            <td colspan="4" class="break"><span class="h2">Employment Details</span></td>
        </tr>
        <tr>
            <td class="td_1">Date Hired:</td>
            <td align="left"><span class="val">'.date('F d, Y', strtotime($row_emp_data['date_hired'])).'</span></td>
            <td>Orig. Hiring Date:</td>
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
            <td class="td_1">Rank:</td>
            <td align="left"><span class="val">'.$row_rank['description'].'</span></td>
        </tr>
        <tr>
            <td style="width:20%;">Employement Status:</td>
            <td align="left"><span class="val">'.$row_emp_status['code'].'</span></td>
            <td class="td_1">Stay-in:</td>
            <td align="left"><span class="val">'.$row_emp_data['stayin'].'</span></td>
        </tr>
        
        <tr>
            <td class="td_1">TIN:</td>
            <td align="left"><span class="val">'.$row_emp_data['tin'].'</span></td>
            <td class="td_1">SSS No:</td>
            <td align="left"><span class="val">'.$row_emp_data['sss_no'].'</span></td>
        </tr>
        <tr>
            <td class="td_1">PHIC No:</td>
            <td align="left"><span class="val">'.$row_emp_data['phic_no'].'</span></td>
            <td class="td_1">HDMF No:</td>
            <td align="left"><span class="val">'.$row_emp_data['hdmf_no'].'</span></td>
        </tr>';


       // if(empty(@$_GET['type'])){
        echo '<tr>
        
            <td class="td_1">Tax Code:</td>
            <td align="left"><span class="val">'.strtoupper($row_emp_data['tax_code']).'</span></td>';
            if(@$emp_deactivated == 1){
                echo '<td style="width:20%;">Date Separated:</td>
                <td align="left"><span class="val">'; if(strtotime($row_emp_data['date_separated']) > 0){echo date('F d, Y', strtotime($row_emp_data['date_separated']));} echo'</span></td>';
            }else{
                echo '<td style="width:20%;">Regularization Date:</td>
                <td align="left"><span class="val">'; if(strtotime($row_emp_data['date_regularization']) > 0){echo date('F d, Y', strtotime($row_emp_data['date_regularization']));} echo'</span></td>';
            }
        echo '</tr>
            <tr>
                <td class="td_1">Home Address Sketch:</td>
                <td align="left" colspan="2"><span class="val"><i><a href="../../images/sketch/'.$row_emp_data['sketch'].'" target="_blank">'.$row_emp_data['sketch'].'</a></i></span></td>
            </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Dependents</span></td>
        </tr>
        <tr>
            <td colspan="2" class="history"><center><b>Fullname</b></center></td>
            <td class="history"><center><b>Birthdate</b></center></td>
            <td class="history"><center><b>Relationship</b></center></td>
        </tr>';
        $sql_dependents = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
        $row_dependents = mysql_fetch_array($sql_dependents);
        $arr_depedents = str_replace("[","",explode("]",$row_dependents['dependents']));
        foreach($arr_depedents as $sel_dependents){
            $dependent_data = explode("~",$sel_dependents);
            if(!empty($sel_dependents)){
                    echo '<tr>
                            <td colspan="2" class="history">'.strtoupper($dependent_data[0]).'</td>
                            <td class="history">'.date('F d, Y',strtotime($dependent_data[1])).'</td>
                            <td class="history">'.strtoupper($dependent_data[2]).'</td>
                        </tr>';
            }
        }
        echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>
         <tr>
            <td colspan="4" class="break"><span class="h2">Emergency Contact</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Fullname</b></center></td>
            <td class="history"><center><b>Contact & Address</b></center></td>
            <td class="history"><center><b>Birthdate</b></center></td>
            <td class="history"><center><b>Relationship</b></center></td>
        </tr>';
        $sql_emergency = mysql_query("SELECT * from employees WHERE emp_num = '$emp_num'") or die(mysql_error());
        $row_emergency = mysql_fetch_array($sql_emergency);
        $arr_emergency = str_replace("[","",explode("]",$row_emergency['emergency']));
        foreach($arr_emergency as $sel_emergency){
            $emergency_data = explode("~",$sel_emergency);
            if(!empty($sel_emergency)){
                    echo '<tr>
                            <td class="history">'.strtoupper($emergency_data[0]).'</td>
                            <td class="history">'.strtoupper($emergency_data[3]).'<br/>'.strtoupper($emergency_data[4]).'</td>
                            <td class="history">'.date('F d, Y',strtotime($emergency_data[1])).'</td>
                            <td class="history">'.strtoupper($emergency_data[2]).'</td>
                        </tr>';
            }
        }
        echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>
        <tr>
            <td colspan="4" class="break"><span class="h2">Position Movement History</span></td>
        </tr>';
            //query position history start
                $sql_posHis = mysql_query("SELECT * from manpower_movement WHERE emp_num='$emp_num' and type LIKE 'transfer%' and status = 'transferred' ORDER BY date_submitted Asc") or die(mysql_error());
                while($row_posHis = mysql_fetch_array($sql_posHis)){
                    $pos_ex = explode("~",$row_posHis['type']);
                    $slctd_pos = mysql_query("SELECT * from positions WHERE p_id='".$pos_ex['1']."'") or die(mysql_error());
                    $row_slctd_pos = mysql_fetch_array($slctd_pos);
                    if($row_posHis['class'] == 'permanent'){
                        $date_effecttive = date('F d, Y', strtotime($row_posHis['per_date']));
                    }else{
                        $date_effecttive = date('F d, Y', strtotime($row_posHis['temp_date1'])).' - '.date('F d, Y', strtotime($row_posHis['temp_date2']));
                    }
                    
                    echo '<tr><td colspan="2" class="history">'.$row_slctd_pos['position'].'</td></tr>';
                }
            //query position history end
        echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>';
        echo '<tr>
            <td colspan="4" class="break"><span class="h2">Company/Branch Movement History</span></td>
        </tr>';
            //query branch history start
                $sql_braHis = mysql_query("SELECT * from manpower_movement WHERE emp_num='$emp_num' and status = 'transferred' ORDER BY date_submitted Asc") or die(mysql_error());
                while($row_braHis = mysql_fetch_array($sql_braHis)){
                    $slctd_bra = mysql_query("SELECT * from branches WHERE branch_id='".$row_braHis['branch_id']."'") or die(mysql_error());
                    $row_slctd_bra = mysql_fetch_array($slctd_bra);
                    
                    $slctd_comp = mysql_query("SELECT * from company WHERE company_id='".$row_braHis['company_id']."'") or die(mysql_error());
                    $row_slctd_comp = mysql_fetch_array($slctd_comp);
                    echo '<tr><td colspan="4" class="history">'.$row_slctd_comp['name'].' / '.$row_slctd_bra['branch_name'].'</td></tr>';
                }
            //query branch history end
        echo '<tr>
            <td colspan="4" class="history"></td>
        </tr>';
        echo '<tr>
            <td colspan="4" class="break"><span class="h2">Training and Seminar Attended</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Date</b></center></td>
            <td class="history" colspan="2"><center><b>Title</b></center></td>
            <td class="history"><center><b>Banned Duration</b></center></td>
        </tr>';
        //query tns history start
                $sql_tnsHis = mysql_query("SELECT * from training_seminar WHERE participants LIKE '%($emp_num)%' ORDER BY from_date Asc") or die(mysql_error());
                while($row_tnsHis = mysql_fetch_array($sql_tnsHis)){
                    echo '<tr><td class="history">'.date('M d, Y h:i A', strtotime($row_tnsHis['from_date'])).'<br> to <br>'.date('M d, Y h:i A', strtotime($row_tnsHis['to_date'])).'</td>
                          <td colspan="2" class="history"><center>'.$row_tnsHis['title'].'</center></td>
                          <td class="history"><center>'.$row_tnsHis['ban'].' months</center></td>
                            </tr>';
                }
            //query tns history end
        echo '<tr>
            <td colspan="4" class="break"><span class="h2">Delinquency History</span></td>
        </tr>
        <tr>
            <td class="history"><center><b>Date Committed</b></center></td>
            <td class="history" colspan="3"><b><center>Violation</b></center></td>
        </tr>';
        //query tns history start
                $sql_delHis = mysql_query("SELECT * from delinquency WHERE emp_num = '$emp_num' ORDER BY date_committed Asc") or die(mysql_error());
                while($row_delHis = mysql_fetch_array($sql_delHis)){
                    echo '<tr><td class="history">'.date('F, d, Y', strtotime($row_delHis['date_committed'])).'</td>
                          <td colspan="3" class="history"><center>'.$row_delHis['violation'].'</center><td></tr>';
                }
            //query tns history end
        echo '<tr>
            <td colspan="4" class="break"><span class="h2"></span></td>
        </tr>';
       // }
    echo '</table>';
    //if(!empty(@$_GET['type'])){ echo '<br><br><br><br><input type="button" value="Delete Request" class="btn btn-danger" onclick="return confirm(\'Do you want to delete this request. You cannot undo this process.\')">';}
    echo '</center>';
?>
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
<script src="js/jquery.datetimepicker.full.js"></script>
<script>
    $('#datetimepicker').keydown(false);
//date picker3 start
                            $('#datetimepicker').datetimepicker({
                                dayOfWeekStart: 1,
                                lang:'ch',
                                timepicker:false,
                                format:'Y/m/d',
                                startDate: '2016',
                                scrollMonth : false,
                                scrollInput : false
                            });
                            $('#datetimepicker').datetimepicker({value: ''});
//date picker3 end

</script>