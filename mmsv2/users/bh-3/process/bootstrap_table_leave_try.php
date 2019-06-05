<?php

date_default_timezone_set("Asia/Singapore");
include('../../../connect.php');
$num = 1;
$sql_employees = mysql_query("SELECT * from employees ORDER by lastname Asc") or die(mysql_error());
while ($row_employees = mysql_fetch_array($sql_employees)) {
    $str_counted = strlen($row_employees['middlename']) - 1;
    $middlename_view = substr($row_employees['middlename'], 0, -$str_counted);
    if (empty($row_employees['middlename'])) {
        $middlename_view = '';
    } else {
        $middlename_view = ', ' . $middlename_view . '.';
    }
    $employee_fullname = ucwords($row_employees['lastname'] . ', ' . $row_employees['firstname'] . $middlename_view);

    $emp_branch = mysql_query("SELECT * from branches WHERE branch_id = '" . $row_employees['branch_id'] . "' ") or die(mysql_error());
    $row_emp_branch = mysql_fetch_array($emp_branch);

    $emp_position = mysql_query("SELECT * from positions WHERE p_id = '" . $row_employees['position_id'] . "' ") or die(mysql_error());
    $row_emp_position = mysql_fetch_array($emp_position);

    $emp_company = mysql_query("SELECT * from company WHERE company_id = '" . $row_employees['company_id'] . "' ") or die(mysql_error());
    $row_emp_company = mysql_fetch_array($emp_company);

    $emp_status = mysql_query("SELECT * from employment_status WHERE e_id = '" . $row_employees['status_id'] . "' ") or die(mysql_error());
    $row_emp_status = mysql_fetch_array($emp_status);

    $employee_fullname;
    $bday = date('M d, Y', strtotime($row_employees['birthdate']));
    $row_emp_company['name'];
    $row_emp_branch['branch_name'];
    $row_emp_position['position'];
    $date_hired = date('M d, Y', strtotime($row_employees['date_hired']));
    $row_emp_status['code'];
    $button = '<input type="image" data-jAlert data-title="Employee Information" title="View" data-iframe="view_emp_data.php?emp_num=' . $row_employees['emp_num'] . '" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40"> | <input type="image" src="../../images/button/edit_icon.png" title="Edit" class="edit" id="edit_' . $row_employees['emp_num'] . '" width="40" height="40"> | <input class="delete" data-id="' . $num . '" id="' . $row_employees['emp_num'] . '" type="image" src="../../images/button/delete_icon.png" width="40" height="40">';                                     
    
        $emp_data[] = array(
            'emp no' => $row_employees['emp_num'],
            'employee name' => $employee_fullname,
            'birhtdate' => $bday,
            'company' => $row_emp_company['name'],
            'branch' => $row_emp_branch['branch_name'],
            'position' => $row_emp_position['position'],
            'date hired' => $date_hired,
            'status' => $row_emp_status['code'],
            'action' => '<input type="image" data-jAlert data-title="Employee Information" title="View" data-iframe="view_emp_data.php?emp_num=' . $row_employees['emp_num'] . '" data-fullscreen="true" src="../../images/button/view_icon.png" width="40" height="40"> | <input type="image" src="../../images/button/edit_icon.png" title="Edit" class="edit" id="edit_' . $row_employees['emp_num'] . '" width="40" height="40"> | <input class="delete" data-id="' . $num . '" id="' . $row_employees['emp_num'] . '" type="image" src="../../images/button/delete_icon.png" width="40" height="40">'
        );
     $num++;
    
}
    echo json_encode($emp_data);
 