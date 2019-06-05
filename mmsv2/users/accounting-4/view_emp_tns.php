<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
<style>
    #table{
        width:1000px;
        border-bottom: groove;
        border-top: groove;
        border-left: groove;
        border-right: groove;
    }
    .tr{
        border-bottom: groove;
        border-top: groove;
        border-left: groove;
        border-right: groove;
    }
</style>
<?php
    include("../../connect.php");
    
    $sql_tns = mysql_query("SELECT * from  training_seminar WHERE tns_id = '".$_GET['tns_id']."'") or die(mysql_error());
    $row_tns = mysql_fetch_array($sql_tns);
    $emp = explode(")",$row_tns['participants']);
?>
    <center>   
        <table id="table">
            <tr>
                <td colspan="4"><center><h2><?php echo ucwords($row_tns['title']);?></h2></center></td>
            </tr>
            <tr>
                <td colspan="4"><center><font size='-1'><?php echo strtoupper($row_tns['venue']);?></font></center><br></td>
            </tr>
            <tr>
                <td width="100px">Facilitator:</td>
                <td colspan="3" style="text-align: left;"><?php echo ucwords($row_tns['facilitator']);?></td>
            </tr>
            <tr>
                <td width="100px">Date:</td>
                <td colspan="3" style="text-align: left;"><?php echo date('F d, Y', strtotime($row_tns['date']));?></td>
            </tr>
            <tr>
                <td colspan="4"><br><br></td>
            </tr>
            <tr height="35px;">
                <td class="tr"><b>No</b></td>
                <td colspan="3" class="tr"><b>Employee Name</b></td>
            </tr>
            <?php
            $num = 1;
                foreach($emp as $attendee){
                    $attendee = str_replace("(","",$attendee);
                    if($attendee > 0){
                        $sql_emp = mysql_query("SELECT * from employees WHERE emp_num = '$attendee'") or die(mysql_error());
                        if(mysql_num_rows($sql_emp) == 0){
                            $sql_emp = mysql_query("SELECT * from employees_deactivated WHERE emp_num = '$attendee'") or die(mysql_error());
                        }
                        $row_emp = mysql_fetch_array($sql_emp);
                        
                        $str_count = strlen($row_emp['middlename']) - 1;
                        $middlename = substr($row_emp['middlename'],0,-$str_count);
                        if(empty($row_emp['middlename'])){
                            $middlename = '';
                        }else{
                            $middlename = ', '.$middlename.'.';
                        }
                        $fullname = ucwords($row_emp['lastname'].', '.$row_emp['firstname'].$middlename);
                        echo '<tr>
                            <td class="tr">'.$num.'.</td>
                            <td colspan="3" class="tr">'.$fullname.'</td>
                        </tr>';
                    $num++;
                    }
                }
            ?>
        </table>
    </center>
