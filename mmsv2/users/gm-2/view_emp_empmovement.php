    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="css/pr_form.css">
    <style>
        .val{
            border-bottom: groove;
            text-align: center;
            vertical-align: bottom;
        }
        .tr{
            height: 30px;
        }
    </style>
<?php
date_default_timezone_set("Asia/Singapore");
    include("../../connect.php");
    
    $date = date('Y/m/d');
    // if(isset($_POST['approve'])){
    //     if(mysql_query("UPDATE manpower_movement SET status='approved by gm', date_approved='$date' WHERE  mm_id = '".$_GET['mm_id']."'") or die(mysql_error())){
    //       echo '<script>
    //             window.top.location.href="view_empmovement.php?status=active&active=view&http=200";
    //         </script>';  
    //     }else{
    //        echo '<script>
    //             window.top.location.href="view_empmovement.php?status=active&active=view&http=400";
    //         </script>'; 
    //     }
    // }else if(isset($_POST['disapprove'])){
    //     if(mysql_query("UPDATE manpower_movement SET status='disapproved', status='disapproved by gm', date_approved='$date' WHERE  mm_id = '".$_GET['mm_id']."'") or die(mysql_error())){
    //       echo '<script>
    //             window.top.location.href="view_empmovement.php?status=active&active=view&http=200";
    //         </script>';  
    //     }else{
    //        echo '<script>
    //             window.top.location.href="view_empmovement.php?status=active&active=view&http=400";
    //         </script>'; 
    //     }
    // }

    $sql_mm = mysql_query("SELECT * from manpower_movement WHERE mm_id = '".$_GET['mm_id']."'") or die(mysql_error());
    $row_mm = mysql_fetch_array($sql_mm);
    
    $sql_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_mm['position_id']."' ") or die(mysql_error());
    $row_position = mysql_fetch_array($sql_position);
    
    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_mm['branch_id']."' ") or die(mysql_error());
    $row_branch = mysql_fetch_array($sql_branch);
    
    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '".$row_mm['emp_num']."' ") or die(mysql_error());
    $row_emp = mysql_fetch_array($sql_emp);
    $chk_count = strlen($row_emp['middlename']);
    if($chk_count > 1){
        $str_count = strlen($row_emp['middlename']) - 1;
        $middlename = substr($row_emp['middlename'],0,-$str_count);
    }else{
        $middlename = $row_emp['middlename'];
    }
    if(empty($row_emp['middlename'])){
        $middlename = '';
    }else{
        $middlename = ', '.$middlename.'.';
    }
    $fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middlename);
    
    //verifier
        $sql_emp_veri = mysql_query("SELECT * from employees WHERE emp_num = '".$row_mm['verified_id']."' ") or die(mysql_error());
        $row_emp_veri = mysql_fetch_array($sql_emp_veri);
        
        $sql_emp_pos = mysql_query("SELECT * from positions WHERE p_id='".$row_emp_veri['position_id']."'") or die(mysql_error());
        $row_emp_pos = mysql_fetch_array($sql_emp_pos);
        $chk_str_veri = strlen($row_emp_veri['middlename']);
        if($chk_str_veri > 1){
            $str_count_veri = strlen($row_emp_veri['middlename']) - 1;
            $middlename_veri = substr($row_emp_veri['middlename'],0,-$str_count_veri);
        }else{
            $str_count_veri = strlen($row_emp_veri['middlename']);
            $middlename_veri = $row_emp_veri['middlename'];
        }
        if(empty($row_emp_veri['middlename'])){
            $middlename_veri = '';
        }else{
            $middlename_veri = ', '.$middlename_veri.'.';
        }
        $fullname_veri = ucwords($row_emp_veri['lastname'].', '.$row_emp_veri['firstname'].$middlename_veri);
    //verifier end
        
    //approver 
        $sql_emp_app = mysql_query("SELECT * from employees WHERE emp_num = '".$row_mm['approved_id']."' ") or die(mysql_error());
        $row_emp_app = mysql_fetch_array($sql_emp_app);
        $chk_str_app = strlen($row_emp_app['middlename']);
        if($chk_str_app > 1){
            $str_count_app = strlen($row_emp_app['middlename']) - 1;
            $middlename_app = substr($row_emp_app['middlename'],0,-$str_count_app);
        }else{
            $str_count_app = strlen($row_emp_app['middlename']);
            $middlename_app = $row_emp_app['middlename'];
        }
        if(empty($row_emp_app['middlename'])){
            $middlename_app = '';
        }else{
            $middlename_app = ', '.$middlename_app.'.';
        }
        $fullname_app = ucwords($row_emp_app['lastname'].', '.$row_emp_app['firstname'].$middlename_app);
    //approver end
    
    if($row_mm['class'] == 'temporary'){
        $date = date('Y/m/d', strtotime($row_mm['temp_date1'])).'&nbsp;&nbsp; to &nbsp;&nbsp;'.date('Y/m/d', strtotime($row_mm['temp_date2']));
    }else{
        $date = 'effective date &nbsp;&nbsp;'.date('Y/m/d', strtotime($row_mm['per_date']));
    }
    
    //chk type start
    $type_data = explode('~',$row_mm['type']);
    $type = $type_data[0];
    if($type == 'transfer'){
        $transfer = 'checked';
        $sql_p = mysql_query("SELECT * from positions WHERE p_id = '".$type_data[1]."'") or die(mysql_error());
        $row_p = mysql_fetch_array($sql_p);
        $type_transfer = ucwords($row_p['position']);
    }else if($type == 'move'){
        $move = 'checked';
        $sql_p = mysql_query("SELECT * from company WHERE company_id = '".$type_data[1]."'") or die(mysql_error());
        $row_p = mysql_fetch_array($sql_p);
        $type_move = ucwords($row_p['name']);
        
    }else if($type == 'deactivate'){
        $deactivate = 'checked';
        $type_deactivate = ucwords($type_data[1]);
        
    }else if($type == 'reassign'){
        $ressign = 'checked';
        $sql_p = mysql_query("SELECT * from branches WHERE branch_id = '".$type_data[1]."'") or die(mysql_error());
        $row_p = mysql_fetch_array($sql_p);
        
        $sql_bh_user = mysql_query("SELECT * from users WHERE user_type = '3' and branch_id LIKE '%(".$type_data[1].")%' and status=''") or die(mysql_error());
        $row_bh_user = mysql_fetch_array($sql_bh_user);
        
        $sql_bh_emp = mysql_query("SELECT * from employees WHERE emp_num='".$row_bh_user['emp_num']."'") or die(mysql_error());
        $row_bh_emp = mysql_fetch_array($sql_bh_emp);
        $str_chk = strlen($row_bh_emp['middlename']);
        $str_countemp = $str_chk - 1;
        if($str_chk > 1){
            $str_countemp = strlen($row_bh_emp['middlename']) - 1;
            $emp_fullname = ucwords($row_bh_emp['lastname'].', '.$row_bh_emp['firstname'].' '.substr($row_bh_emp['middlename'],0,-$str_countemp).'.');
        }else{
            $emp_fullname = ucwords($row_bh_emp['lastname'].', '.$row_bh_emp['firstname'].' '.$row_bh_emp['middlename'].'.');
        }
        $type_reassign = ucwords($row_p['branch_name']).' <font size="2px">(BH: '.$emp_fullname.')</font>';
        
    }
    //chk type End
?>
    <center>
                        <br><br>
                        <table width="1100px">
                            <tr>
                                <td class="header1" colspan="5"><span id="header1"><b>Manpower Movement</b></span><br></td>
                            </tr>
                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                            <tr>
                                <td><b>Date Submitted:</b></td>
                                <td class="val"><?php echo date('F d, Y', strtotime($row_mm['date_submitted']));?></td>
                                <td></td>
                                <td><b>Branch Submitted:</b></td>
                                <td class="val" style="width:220px;"><?php echo ucwords($row_branch['branch_name']);?></td>
                            </tr>
                            <tr>
                                <td><b>Employee Name:</b></td>
                                <td class="val"><?php echo $fullname;?></td>
                                <td></td>
                                <td><b>Position:</b></td>
                                <td class="val"><?php echo ucwords($row_position['position']);?></td>
                            </tr>
                            <tr>
                                <td colspan="5"><br><br><b>Type of Movement:</b></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td>Class</td>
                                <td class="val"><?php echo ucwords($row_mm['class'].'&nbsp;&nbsp;&nbsp;&nbsp;').$date;?></td>
                                <td id="if_temp" colspan="2" hidden><input type="text" name="date1" id="datetimepicker1" style="width:30%;" autocomplete="off"> to <input type="text" name="date2" id="datetimepicker2" style="width:30%;" autocomplete="off"></td>
                                <td id="if_per" colspan="2" hidden>Effective Date: <input type="text" name="date3" id="datetimepicker3" style="width:30%;" autocomplete="off"></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td><input type="radio" name="type" value="transfer" id="transfer" <?php echo @$transfer;?> disabled> Transfer to other position</td>
                                <td class="val" colspan="2"><?php echo ucwords(@$type_transfer);?></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td><input type="radio" name="type" value="move" id="move"  <?php echo @$move;?> disabled> Move to other company</td>
                                <td class="val" colspan="2"><?php echo ucwords(@$type_move);?></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td><input type="radio" name="type" value="deactivate" id="deactivate"  <?php echo @$deactivate;?> disabled> Deactivated (Resigned / Endo)</td>
                                <td class="val" colspan="2"><?php echo ucwords(@$type_deactivate);?></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td><input type="radio" name="type" value="ressign" id="reassign"  <?php echo @$ressign;?> disabled> Reassign to other branch</td>
                                <td class="val" colspan="2"><?php echo ucwords(@$type_reassign);?></td>
                            </tr>
                             <tr class="tr">
                                <td colspan="5"><br>Please be advised as well, that the employee will entitled to:</td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td>In-house accommodation</td>
                                <td class="val" colspan="2"><?php echo ucwords($row_mm['in_house']);?></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td>Free transportation</td>
                                <td class="val" colspan="2"><?php echo ucwords($row_mm['transportation']);?></td>
                            </tr>
                            <tr class="tr">
                                <td></td>
                                <td>Change in rate</td>
                                <td class="val" colspan="2"><?php echo ucwords($row_mm['change_rate']);?></td>
                            </tr>
                            <tr class="tr">
                                <td colspan="5"><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td><center><img src="../../images/signature/<?php echo $row_mm['verified_id'];?>.png" width="90"></center></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Requested By:</td>
                                <td><center><?php echo $fullname_veri;?></center></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td><center><font size="-1"><?php echo ucwords($row_emp_pos['position']);?></font></center></td>
                            </tr>
                            <tr>
                                <td colspan="5"><br><br></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td>
                                <center>
                                <?php
                                    if($row_mm['status'] == 'transferred') {
                                        echo '<img src="../../images/signature/'.$row_mm['approved_id'].'.png" width="90">';
                                    }
                                ?>
                                </center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Approved By:</td>
                                <td><center><?php echo $fullname_app;?></center></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td></td>
                                <td><center><font size="-1">HR SUPERVISOR</font></center></td>
                            </tr>
                        </table>
                     
                        <iframe width="80%" frameborder="none" height="600" src="../../comment/mm/index.php?mm_id=<?php echo $_GET['mm_id'];?>" id="iframe"></iframe> 

    </center>