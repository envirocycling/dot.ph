<?php

include('iconnect.php');

$_branch_id = @$_POST['company_id'];


$val = '<option value=""> Please Select </option>';
$sql = "SELECT * FROM employees WHERE branch_id = '$_branch_id' ORDER BY lastname ASC";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row_employee = mysqli_fetch_array($result)) {
        $str_chk = strlen($row_employee['middlename']);
        if ($str_chk > 1) {
            $str_countemp = strlen($row_employee['middlename']) - 1;
            $emp_fullname = ucwords($row_employee['lastname'] . ' ' . substr($row_employee['middlename'], 0, -$str_countemp) . '. ' . $row_employee['firstname']);
        }else {
            $str_countemp = strlen($row_employee['middlename']);
            $emp_fullname = ucwords($row_employee['lastname'] . ' ' . $row_employee['middlename'] . '. ' . $row_employee['firstname']);
        }

        @$val.='<option value="(' . $row_employee['emp_num'] . ')">' . utf8_encode(strtoupper($emp_fullname)) . '</option>';
    }

    include('../../../iconnect_out.php');

    $branch_query = mysqli_query("SELECT * FROM branches WHERE branch_id='$_branch_id';");
    $branch_result = mysqli_fetch_array($branch_query);

    $_branch_name = $branch_result['branch_name'];


    if($_branch_name == 'San Pedro') {

       
        
        // $sql_supplier = mysqli_query($sqli_conn, "SELECT * from supplier_details WHERE branch LIKE '%$_branch_name%'");

        // while ($row_supplier = mysqli_fetch_array($sql_supplier)) {
        //     @$val.='<option value="(' . utf8_encode(strtoupper($row_supplier['supplier_id'] . '_' . $row_supplier['supplier_name'])) . ')">' . utf8_encode(strtoupper($row_supplier['supplier_id'] . '_' . $row_supplier['supplier_name'])) . '</option>';
        // }
        
        
    }

@$val.='<option value="(' . utf8_encode(strtoupper('MAITEC ENTERPRISES')) . ')">' . utf8_encode(strtoupper('MAITEC ENTERPRISES')) . '</option>';


    mysqli_close($sqli_conn);
    echo $val;
}
