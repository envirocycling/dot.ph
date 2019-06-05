<?php
        include('iconnect.php');

    $sql = "SELECT * FROM employees WHERE branch_id = '".@$_POST['company_id']."' ORDER BY lastname ASC";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            
        while ($row_employee = mysqli_fetch_array($result)) {
            $str_chk = strlen($row_employee['middlename']);
        if ($str_chk > 1) {
            $str_countemp = strlen($row_employee['middlename']) - 1;
            $emp_fullname = ucwords($row_employee['lastname'] . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ' . $row_employee['firstname']);
        } else {
            $str_countemp = strlen($row_employee['middlename']);
            $emp_fullname = ucwords($row_employee['lastname'] . ' ' . $row_employee['middlename'] . '. ' . $row_employee['firstname']);
        }
        
        @$val.='<option value="(' . $row_employee['emp_num'] . ')">' . utf8_encode(strtoupper($emp_fullname)) . '</option>';
    }
    echo $val;
}