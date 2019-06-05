<?php
       include('iconnect.php');
        $val = '<option value="" selected>Please Select</option>';
        $sql = "SELECT * FROM incident_accident WHERE person LIKE '%(".@$_POST['emp_num'].")%' and del_id = 0 ORDER BY report_id ASC";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
        while ($row_employee = mysqli_fetch_array($result)) {
            @$val.='<option value="' . $row_employee['report_id'].'-'.utf8_encode(strtoupper($row_employee['description'])) . '">'.$row_employee['report_id'].'-'.utf8_encode(strtoupper($row_employee['description'])) . '</option>';
        }
    echo $val;
}