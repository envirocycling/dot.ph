<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/del_form.css">
<script type="text/javascript" src="validation/jquery.min.js"></script>
<style>
    table{
        font-style: italic;
    }
    .txt_val{
        padding-left: 40px;
    }
</style>
<?php
    include("../../connect.php");
    
    $sql_ia = mysql_query("SELECT * from incident_accident WHERE report_id = '".$_GET['report_id']."'") or die(mysql_error());
    $row_ia = mysql_fetch_array($sql_ia);
    
    $sql_branch = mysql_query("SELECT * from branches WHERE branch_id='".$row_ia['branch_id']."'") or die(mysql_error());
    $row_branch = mysql_fetch_array($sql_branch);
    
    $emp_num = explode(")", $row_ia['person']);
    $employee_fullname = '';
    foreach ($emp_num as $participants) {
        $participants = str_replace("(", "", $participants);
        if ($participants > 0) {
            $sql_employees = mysql_query("SELECT * from employees WHERE emp_num = '$participants'");
            $row_employees = mysql_fetch_array($sql_employees);
            $str_counted = strlen($row_employees['middlename']) - 1;
            if ($str_counted == 0) {
                $middlename_view = $row_employees['middlename'];
            } else {
                $middlename_view = substr($row_employees['middlename'], 0, -$str_counted);
            }
            //$middlename_view = substr($row_employees['middlename'],0,-$str_counted);
            if (empty($row_employees['middlename'])) {
                $middlename_view = '';
            } else {
                $middlename_view = ', ' . $middlename_view . '.';
            }
            $employee_fullname .= strtoupper($row_employees['lastname'] . ', ' . $row_employees['firstname'] . $middlename_view) . '<br>';
        }
    }
    ?>
<br>
    <center>
        <?php
            if(@$_GET['head'] == 1){
                echo '<table width="100%">
                        <tr>
                            <td><center><h4>Incident / Accident Form</h4></center></td>
                        </tr>
                </table>';
            }
        ?>
        
<br>
                        <table width="70%">
                            <tr>
                                <td><span class="txt">Date:</span> <?php echo date('Y/m/d');?></td>
                            </tr>
                            <tr>
                                <td><span class="txt">Branch:</span> <?php echo $row_branch['branch_name'];?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/><br/><br/>Brief description of the incident:</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $row_ia['description'];?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>What happened?</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $row_ia['what_happened'];?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>When did it happen? (Indicate date and time):</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo date('Y/m/d h:i A' ,strtotime($row_ia['date_happened']));?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>Where did it happen? (Indicate the specific place of the incident)</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $row_ia['where_happened'];?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>Where did it happen? (Indicate the specific place of the incident)</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $row_ia['where_happened'];?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>Who are the persons involved?</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $employee_fullname;?></td>
                            </tr>
                            <tr>
                                <td><br/><hr></hr></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>Corrective Action:</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $row_ia['corrective_action'];?></td>
                            </tr>
                            <tr>
                                <td class="txt"><br/>Preventive Action:</td>
                            </tr>
                            <tr>
                                <td class="txt_val"><?php echo $row_ia['preventive_action'];?></td>
                            </tr>
                        </table>
    </center>
<br><br>
