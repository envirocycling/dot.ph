<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css" href="css/pr_form.css">
<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>

<style>
.view_val{
    border-bottom: groove;
    text-align: center;
}
.fix{
    width: 260px;
}
.sig_pos{
    font-style: italic;
    font-size: 0.8em;
    text-transform: capitalize;
}
.attachement{
    font-style: italic;
    color: blue;
    font-size: 13px;
    font-weight: 700;
}
</style>
<?php
    include("../../connect.php");
    date_default_timezone_set("Asia/Singapore");
    //sql
    if(isset($_POST['noted'])){
        if(mysql_query("UPDATE personnel_requisition SET hr_status='noted', hr_date='".date('Y-m-d')."' WHERE pr_id = '".$_GET['pr_id']."'") or die(mysql_error())){
            echo '<script>
                    window.top.location.href="view_pr.php?status=active&active=view&http=200";
                </script>';
        }else{
           echo '<script>
                    window.top.location.href="view_pr.php?status=active&active=view&http=400";
                </script>'; 
        }
    }else if(isset($_POST['served'])){
//        $ctr = 0;
//        $count = 0;
//        $pro_needed = $_POST['no_needed'];
//        $served_emp = '';
//        while($ctr < $pro_needed){
//            if(!empty($_POST['emp_num'.$ctr])){
//                $served_emp .= $_POST['emp_num'.$ctr].'~';
//                $count++;
//            }
//          $ctr++;  
//        }
//        if($pro_needed == $count){
//            $stat_hr = 'served';
//            $sat = 'served';
//        }else{
//            $stat_hr = 'noted';
//            $sat = 'pending';
//        }
        if(mysql_query("UPDATE personnel_requisition SET hr_status='served', status='served', hr_serve_date='".date('Y-m-d')."'  WHERE pr_id = '".$_GET['pr_id']."'") or die(mysql_error())){
            echo '<script>
                    window.top.location.href="view_pr.php?status=active&active=view&http=200";
                </script>';
        }else{
           echo '<script>
                    window.top.location.href="view_pr.php?status=active&active=view&http=400";
                </script>'; 
        }
    }
    //sql end
    $sql_pr = mysql_query("SELECT * from personnel_requisition WHERE pr_id = '".$_GET['pr_id']."'") or die(mysql_error());
    $row_pr = mysql_fetch_array($sql_pr);
    
    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id = '".$row_pr['branch_id']."'") or die(mysql_error());
    $row_branch = mysql_fetch_array($sql_branch);
                        
    $sql_position = mysql_query("SELECT * from positions WHERE p_id = '".$row_pr['job_title']."' ") or die(mysql_error());
    $row_position = mysql_fetch_array($sql_position);
    
    $sql_company = mysql_query("SELECT * from company WHERE company_id = '".$row_pr['company_id']."'") or die(mysql_error());
    $row_company = mysql_fetch_array($sql_company);
    
    $sql_preparedby = mysql_query("SELECT * from employees WHERE emp_num = '".$row_pr['prepared_id']."'") or die(mysql_error());
    if(mysql_num_rows($sql_preparedby) == 0){   
    $sql_preparedby = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '".$row_pr['prepared_id']."'") or die(mysql_error());
    }
    $row_prepareby = mysql_fetch_array($sql_preparedby);
    $sql_position_pre = mysql_query("SELECT * from positions WHERE p_id='".$row_prepareby['position_id']."'") or die(mysql_error()) or die(mysql_error());
    $row_position_pre = mysql_fetch_array($sql_position_pre);
    $chk_count = strlen($row_prepareby['middlename']);
    if($chk_count > 1){
        $count_pre = strlen($row_prepareby['middlename']) - 1; 
        $middlename_pre = substr($row_prepareby['middlename'],0,-$count_pre);
    }else{
        $middlename_pre = $row_prepareby['middlename'];
    }
    if(empty($row_prepareby['middlename'])){
        $middlename_pre = '';
    }else{
        $middlename_pre = ', '.$middlename_pre.'.';
    }
    $fullname_pre = ucwords($row_prepareby['lastname'].', '.$row_prepareby['firstname'].$middlename_pre);
    
    $sql_approvedby = mysql_query("SELECT * from employees WHERE emp_num = '".$row_pr['gm_id']."'") or die(mysql_error());
    if(mysql_num_rows($sql_approvedby) == 0){   
    $sql_approvedby = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '".$row_pr['gm_id']."'") or die(mysql_error());
    }
    $row_approvedby = mysql_fetch_array($sql_approvedby);
    $sql_position_app = mysql_query("SELECT * from positions WHERE p_id='".$row_approvedby['position_id']."'") or die(mysql_error()) or die(mysql_error());
    $row_position_app = mysql_fetch_array($sql_position_app);
    $chk_count = strlen($row_approvedby['middlename']);
    if($chk_count > 1){
        $count_app = strlen($row_approvedby['middlename']) - 1; 
        $middlename_app = substr($row_approvedby['middlename'],0,-$count_app);
    }else{
        $middlename_app = $row_approvedby['middlename'];
    }
    if(empty($row_approvedby['middlename'])){
        $middlename_app = '';
    }else{
        $middlename_app = ', '.$middlename_app.'.';
    }
    $fullname_app = ucwords($row_approvedby['lastname'].', '.$row_approvedby['firstname'].$middlename_app);
    
    $sql_hr = mysql_query("SELECT * from employees WHERE emp_num = '".$row_pr['hr_id']."'") or die(mysql_error());
    if(mysql_num_rows($sql_approvedby) == 0){   
    $sql_hr = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '".$row_pr['hr_id']."'") or die(mysql_error());
    }
    $row_hr = mysql_fetch_array($sql_hr);
    $sql_position_hr = mysql_query("SELECT * from positions WHERE p_id='".$row_hr['position_id']."'") or die(mysql_error()) or die(mysql_error());
    $row_position_hr = mysql_fetch_array($sql_position_hr);
    $chk_count = strlen($row_hr['middlename']);
    if($chk_count > 1){
        $count_hr = strlen($row_hr['middlename']) - 1; 
        $middlename_hr = substr($row_hr['middlename'],0,-$count_hr);
    }else{
        $middlename_hr = $row_hr['middlename'];
    }
    if(empty($row_hr['middlename'])){
        $middlename_hr = '';
    }else{
        $middlename_hr = ', '.$middlename_hr.'.';
    }
    $fullname_hr = ucwords($row_hr['lastname'].', '.$row_hr['firstname'].$middlename_hr);
    
    if(mysql_num_rows($sql_company) > 0){
        $emp_status = $row_pr['employment_status'].' under '.$row_company['name'];
    }else{
        $emp_status = $row_pr['employment_status'];
    }
    //reason start
    $reason = explode("~",$row_pr['reason']);
    if($reason[0] == 'r1'){
        $r1 = 'checked';
    }if($reason[2] == 'r2'){
        $r2 = 'checked';
    }if($reason[4] == 'r3'){
        $r3 = 'checked';
    }if($reason[6] == 'r4'){
        $r4 = 'checked';
    }
    //reason end
    
    //educational req start
    $ed_req = explode("~",$row_pr['education_req']);
    if(empty($ed_req[1])){
       if($ed_req[0] == 'ag'){
           $ag = 'checked';
       }else if($ed_req[0] == 'dc'){
           $dc = 'checked';
       }else if($ed_req[0] == 'hg'){
           $hg = 'checked';
       }
    }else{
        $c = 'checked';
        $course = ' - '.$ed_req[1];
    }
    //educational req end    
    
    //chk who's cancelled start
    $can_mes = 'This request has been '.$row_pr['status'].' by ';
    if($row_pr['gm_status'] == 'disapproved'){
                            $can_mes .= 'GM </b></i></font><b><i><font size="-1" color="red"><br> at '.date('F d, Y', strtotime($row_pr['gm_date'])).'</b></i></font><br>';
    }else if($row_pr['hr_status'] == 'cancelled'){
                            $can_mes .= 'HR </b></i></font><b><i><font size="-1" color="red"><br> at '.date('F d, Y', strtotime($row_pr['hr_date'])).'</b></i></font><br>';
    }
     //chk who's cancelled end
        

?>
    <center>        
        <?php
        if($row_pr['status'] == 'cancelled' || $row_pr['status'] == 'disapproved'){
                    echo '<font size="+1" color="red"><b><i>'.$can_mes;
                    }
        ?>
        <br><br>
                            <table width="95%">
                            <tr>
                                <td class="header1" colspan="4"><img src="../../images/logo.png" height="70" width="70"><span id="header1">Envirocycling Fiber Incorporated</span><br><span id="header2">Personnel Requisition Form<br></span></td>
                            </tr>
                            <tr>
                                <td colspan="4"><hr></td>
                            </tr>
                            <tr>
                                <td colspan="2">Date Requested: <span class="view_val"><?php echo date('F d, Y', strtotime($row_pr['date_requested']));?><span></td>
                                <td colspan="2">Branch: <span class="view_val"><?php echo ucwords($row_branch['branch_name']);?></span></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>I. DESCRIPTION OF NEEDED</b></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Date Needed:</div></td>
                                <td class="view_val"><div class="label_field"><?php echo date('Y/m/d', strtotime($row_pr['date_needed']));?></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Number Needed:</div></td>
                                <td class="view_val"><div class="label_field"><?php echo $row_pr['no_needed'];?></div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Job Title:</div></td>
                                <td class="view_val"><?php echo $row_position['position'];?></td>
                            </tr>
                            <tr>
                                <td><div class="label_info">Status of Employment:</div></td>
                                <td class="view_val"><div class="label_field"><?php echo $emp_status;?></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>II. REASON FOR REQUIREMENT</b></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><div class="label_info"><input type="checkbox" name="reason" value="r1" disabled <?php echo @$r1;?>> Replacement of Resigned / Endo / Terminated Employee</div></td>
                                <td colspan="2" class="view_val"><div class="label_info"><?php echo $reason[1];?></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><div class="label_info"><input type="checkbox" name="reason" value="r2" disabled <?php echo @$r2;?>> Replacement of Promoted / Transferred Employee</div></td>
                                <td colspan="2" class="view_val"><div class="label_info"><?php if(!empty($reason[3])){echo 'Date of movement: '.date('Y/m/d', strtotime($row_pr['date_movement'])).',&nbsp;&nbsp;';} echo $reason[3];?></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><div class="label_info"><input type="checkbox" name="reason" value="r3" disabled <?php echo @$r3;?>> Additional Manpower</div></td>
                                <td colspan="2" class="view_val"><div class="label_info"><?php echo $reason[5];?></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><br><div class="label_info"><input type="checkbox" name="reason" value="r4" disabled <?php echo @$r4;?>> Requisition for new position</div></td>
                                <td colspan="2" class="view_val"><div class="label_info"><?php echo $reason[7];?></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>III. REQUIREMENTS</b></td>
                            </tr>
                            <tr>
                                <td><br><div class="label_info">Educational Requirements</div></td>
                                <td><br><div class="label_info"><input type="radio" name="ed_requirements" id="college" value="c~" disabled <?php echo @$c;?>> College <span id="span_college" style="width:70%;"><?php echo @$course;?></span></div></td>
                                            <td><br><div class="label_info"><input type="radio" name="ed_requirements" value="ag" disabled <?php echo @$ag;?>> Associate Graduate</div></td>
                            </tr>
                            <tr>
                                <td><br><div class="label_info"></div></td>
                                <td><br><div class="label_info"><input type="radio" name="ed_requirements" value="dc" disabled <?php echo @$dc;?>> Diploma Course</div></td>
                                <td><br><div class="label_info"><input type="radio" name="ed_requirements" value="hg" disabled <?php echo @$hg;?>> At least High School Graduate</div></td>
                            </tr>
                            <tr>
                                <td><br><br><div class="label_info">Special Skills Required:</div></td>
                                <td colspan="3" class="view_val"><br><div class="label_info"><?php echo $row_pr['special_skills'];?></div></td>
                            </tr>
                            <tr>
                                <td class="fix"><br><div class="label_info">Attitudinal Requirements:</div></td>
                                <td colspan="3" class="view_val"><div class="label_info"><?php echo $row_pr['attitudinal_req'];?></div></td>
                            </tr>
                            <tr>
                                <td><br><div class="label_info">Other Special Requirements:</div></td>
                                <td colspan="3" class="view_val"><div class="label_info"><?php echo $row_pr['other_skills'];?></div></td>
                            </tr>
                            <tr>
                                <td colspan="4"><br><b>IV. RECOMMENDATIONS</b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><br><div class="label_info">After reviewing the file for the most qualified applicants for this position, I recommend that the following person be considered for employment : <br>(please attached bio-data / resume of the applicant)</div></td>
                            </tr>
                            <tr>
                                <td><div class="label_info"><br>Reason for recommendation</div></td>
                                <td colspan="3" class="view_val"><br><div class="label_info"><?php echo $row_pr['recommendation'];?></div></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div class="label_info"><br>Salary: <span class="view_val"><?php echo 'Php '.number_format($row_pr['salary'],2);?><span></div></td>
                            </tr>
                            <?php
                            $sql_attach = mysql_query("SELECT * from personnel_requisition_attachment WHERE pr_id='".$_GET['pr_id']."'") or die(mysql_error());
                                if(mysql_num_rows($sql_attach) > 0){
                                    while($row_attach = mysql_fetch_array($sql_attach)){
                            ?>
                            <tr>
                                <td colspan="3"><br><span class="attachement">Attachment: <a href="../../attachment/pr/<?php echo $row_attach['file_name'];?>" target="_blank"><?php echo $row_attach['file_name'];?></a></span></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                            <tr>
                                <td colspan="4"><br>
                                    <?php 
                                        if($row_pr['status'] == 'served'){
                                        echo '<font color="red" ><i>Hired for this PR:<br>';
                                            $hired_emp = explode('~',$row_pr['emp_num']);
                                            foreach ($hired_emp as $sel_emp){
                                                if(!empty($sel_emp)){
                                                    $sql_emp = mysql_query("SELECT * from employees WHERE emp_num='$sel_emp'");
                                                    $row_emp = mysql_fetch_array($sql_emp);
                                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row_emp['lastname'].', '.$row_emp['firstname'].'<br>';
                                                }
                                            }
                                        echo '</i></font>';
                                        }
                                    ?>
                                <br><br>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><div class="label_info">Prepared By:</div></td>
                                <td colspan="3"><img src="../../images/signature/<?php echo $row_pr['prepared_id'].'.png';?>" width="80" height="80"><br><span class="view_val"><?php echo $fullname_pre;?></span></td>
                            </tr>
                            <tr>
                                <td align="right"><br></td>
                                <td colspan="3" class="sig_pos"><?php echo $row_position_pre['position'];?><br><br><br></td>
                            </tr>
                            <tr>
                                <td align="right"><div class="label_info">Approved By: </div></td>
                                <td  colspan="3"><?php if($row_pr['gm_status'] == 'approved'){?><img src="../../images/signature/<?php echo $row_approvedby['emp_num'].'.png';?>" width="80" height="80"><?php }?><br><span class="view_val"><?php echo $fullname_app;?></span></td>
                            </tr>
                            <tr>
                                <td align="right"><br></td>
                                <td colspan="3" class="sig_pos"><?php echo $row_position_app['position'];?><br><br><br></td>
                            </tr>
                            <tr>
                                <td align="right"><div class="label_info">Action Performed By: </div></td>
                                <td colspan="3">
                        <?php                           
                            if($row_pr['hr_status'] == 'noted' || $row_pr['hr_status'] == 'served'){
                            ?><img src="../../images/signature/<?php echo $row_hr['emp_num'].'.png';?>" width="80" height="80"><br><span class="view_val"><?php } echo '<br>'.$fullname_hr;?></span></td>
                            </tr>
                            <tr>
                                <td align="right"></td>
                                <td colspan="3" class="sig_pos"><?php echo $row_position_hr['position'];?>
                                    <?php
                                        if(!empty($row_pr['emp_num'])){
                                            $arr_emp = explode('~',$row_pr['emp_num']);
                                        }
                                        echo '<form action="" method="post" onsubmit="return confirm(\'Do you want to proceed?\')">';
                                    if ($row_pr['hr_status'] == 'pending' && $row_pr['gm_status'] == 'approved') {
                                        echo '<input type="submit" class="btn btn-primary" value="Mark as Noted" name="noted">';
                                    } else if ($row_pr['hr_status'] == 'noted' && $row_pr['gm_status'] == 'approved') {
//                                        $ctr=0;
//                                        $no_needed = $row_pr['no_needed'];
//                                        while($ctr < $no_needed){
//                                            echo '<br><br> Name: <select id="select_emp'.$ctr.'" style="width: 220px; margin-top:10px;" name="emp_num'.$ctr.'">';
//                                                if(empty($arr_emp[$ctr])){
//                                                    echo '<option value="" selected disabled>Please Select</option>';
//                                                }
//                                                $sql_emp = mysql_query("SELECT * from employees ORDER BY lastname Asc") or die (mysql_error());
//                                                    while($row_emp = mysql_fetch_array($sql_emp)){
//                                                        if($arr_emp[$ctr] == $row_emp['emp_num']){
//                                                            @$attr = 'selected';
//                                                        }else{
//                                                            @$attr = '';
//                                                        }
//                                                        echo '<option value="'.$row_emp['emp_num'].'" '.@$attr.'>'.strtoupper($row_emp['lastname'].','.$row_emp['firstname']).'</option>';
//                                                    }
//                                            echo '</select>';
//                                        $ctr++;
//                                        }
//                                        echo '<input type="hidden" value="'.$no_needed.'" name="no_needed">';
                                        echo ' &nbsp;<br><br><input type="submit" class="btn btn-primary" value="Served" name="served">';
                                    }
                                    echo '</form>';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><hr></td>
                            </tr>
                        </table>
                        <br>
                     
                        <iframe width="80%" frameborder="none" height="600" src="../../comment/pr/index.php?pr_id=<?php echo $_GET['pr_id'];?>" id="iframe"></iframe> 
</center>
 <script>
	$(document).ready(function () {
            var ctr = 0;
            var no_needed = Number("<?php echo $no_needed;?>");
                while(ctr < no_needed){
                    $('#select_emp' + ctr).select2();
                    ctr++;
                }
       });
</script>