<center>
    <table>
        <tr>
            <td style="color: red;" align="center"><h2>Updating Employees</h2></td>
        </tr>
        <tr>
            <td><img src="images/updating.gif"></td>
        </tr>
        <tr>
            <td align="center" style="font-size: 18px;"><h3>Please wait.</h3></td>
        </tr>
    </table>
</center>
<?php
$branch = strtoupper($_GET['branch']);
include 'connect_vms.php';
    $sql_branchurl = mysql_query("SELECT * from tbl_branches WHERE branch_name = '$branch'") or die(mysql_error());
    $row_branchurl = mysql_fetch_array($sql_branchurl);
    
include 'connect.php';

if($branch == 'KAYBIGA'){
    $branch = 'Nova';
}else if($branch == 'CAVITE'){
    $branch = 'DFCI';
}else if($branch == 'PASAY'){
    $branch = 'PFRC';
    $branch2 = 'MWPC';
}else if($branch == 'URDANETA'){
    $branch = 'Pangasinan';
}

$sql_branch = mysql_query("SELECT * from branches WHERE branch_name = '$branch'") or die(mysql_error());
$row_branch = mysql_fetch_array($sql_branch);

$url = $row_branchurl['url'].'user-login/ap/update_employee.php';

$ctr = 1;
//if($branch == 'PAMPANGA'){
    $sql_employee = mysql_query("SELECT * from employees WHERE up='0'") or die (mysql_error());
//}else if(empty($branch2)){
//    $sql_employee = mysql_query("SELECT * from employees WHERE branch = '$branch' and up='0'") or die (mysql_error());
//}else{
//    $sql_employee = mysql_query("SELECT * from employees WHERE (branch = '$branch' or branch = '$branch2') and up='0'") or die (mysql_error());
//}
    echo '<form action="'.$url.'" method="post" name="myForm">';
    while($row_employee = mysql_fetch_array($sql_employee)){
        
        $sql_position = mysql_query("SELECT * from positions WHERE p_id='".$row_employee['position_id']."'");
        $row_position = mysql_fetch_array($sql_position);
        
        $sql_branches= mysql_query("SELECT * from branches WHERE branch_id='".$row_employee['branch_id']."'");
        $row_branches = mysql_fetch_array($sql_branches);
        
        $sql_company = mysql_query("SELECT * from company WHERE company_id='".$row_employee['company_id']."'");
        $row_company = mysql_fetch_array($sql_company);
        
        echo '<input type="hidden" name="name'.$ctr.'" value="'.mysql_real_escape_string($row_employee['lastname']).','.mysql_real_escape_string($row_employee['firstname']).'">  
            <input type="hidden" name="position'.$ctr.'" value="'.$row_position['position'].'"> 
            <input type="hidden" name="company'.$ctr.'" value="'.$row_company['name'].'"> 
            <input type="hidden" name="branch'.$ctr.'" value="'.$row_branches['branch_name'].'">';
        
        $ctr++;
    }
    echo '<input type="hidden" name="ctr" value="'.$ctr.'">';
    echo '</form>';
    //mysql_query("UPDATE `employees` SET `up`='1' WHERE `branch` LIKE '%$branch%' and `up`='0'") or die(mysql_error());
   
    echo '<script>
            document.myForm.submit();
    </script>';

