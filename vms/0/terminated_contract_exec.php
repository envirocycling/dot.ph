<?php
    date_default_timezone_set("Asia/Singapore");
    include("connect.php");
    
    $sql_contract= mysql_query("SELECT * from tbl_contract WHERE id='".$_POST['id']."' ") or die(mysql_error());
    $row_contract = mysql_fetch_array($sql_contract);
    
    $sql_assign = mysql_query("SELECT * from tbl_givento WHERE truckid = '".$row_contract['truck_id']."'") or die(mysql_error());
    $row_assign = mysql_fetch_array($sql_assign);
    
    echo $action = $_POST['action'];
    $date = date('Y/m/d');
            
    if($action == 'approved by gm'){
        if(mysql_query("INSERT INTO tbl_assigntosupp_history (truckid, suppliername, issuance_date, enddate, amortization, cashbond, proposedvolume, ref_no, status, remarks, date, cashbond_month, amortization_month, penalty)
                    VALUES ('".$row_assign['truckid']."', '".$row_assign['suppliername']."', '".$row_assign['issuancedate']."', '".$row_assign['enddate']."', '".$row_assign['amortization']."', '".$row_assign['cashbond']."', '".$row_assign['proposedvolume']."', '".$row_assign['ref_no']."', '$action', 'Terminated Contract', '$date', '".$row_assign['cashbond_month']."', '".$row_assign['amortization_month']."', '".$row_assign['penalty']."') ")){
            mysql_query("UPDATE tbl_contract SET status='".$_POST['action']."' WHERE id='".$_POST['id']."'") or die(mysql_error());

        }
    }else{
        mysql_query("UPDATE tbl_contract SET status='".$_POST['action']."' WHERE id='".$_POST['id']."'") or die(mysql_error());
    }
?>
