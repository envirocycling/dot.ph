<?php
session_start();


include('connect.php');
$timezone=+8;
$date= gmdate('m-d-Y',time() + 3600*($timezone+date("I")));


$forrepair = mysql_query("Select * from tbl_forrepair Where truckid='".$_POST['id']."' ") or die(mysql_error());

$repair = mysql_query("Select * from tbl_reassign Where id='".$_GET['id']."' And status = 'Permanent'") or die(mysql_error());

if(mysql_num_rows($forrepair) > 0){
		
		$updates = mysql_query("Update tbl_truck_report Set branch = '".$_POST['branch']."' Where id='".$_POST['id']."' ") or die (mysql_error());
			
		$update_givento = mysql_query("Update tbl_givento Set name= '".$_POST['branch']."' Where truckid='".$_POST['id']."' ") or die (mysql_error());
		
		$deleterepair = mysql_query("Delete from tbl_forrepair Where truckid='".$_POST['id']."'") or die(mysql_error());
		$delete = mysql_query("Delete from tbl_reassign Where id='".$_GET['id']."'") or die(mysql_error());
		
}else if(mysql_num_rows($repair) > 0){
	

$insert = mysql_query("Insert into tbl_reassignmenthistory (truckplate,suppname,amortization,cashbond,proposedvolume,branch,issuancedate,enddate,prepared,remarks,status)
Values ('".$_POST['id']."','".$_POST['suppliername2']."','".$_POST['amortization2']."','".$_POST['cashbond2']."','".$_POST['proposedvolume2']."','".$_POST['branch']."','".$_POST['issuancedate']."','$date','".$_POST['preparedby']."','".$_POST['remarks']."','Permanent')") or die (mysql_error());

$update = mysql_query("Update tbl_givento Set name='".$_POST['branch']."',suppliername = '',issuancedate = '',enddate = '',amortization = '',cashbond = '',proposedvolume = '',preparedby='".$_POST['preparedby']."',remarks='".$_POST['remarks']."' Where truckid='".$_POST['id']."'") or die(mysql_error());


$updated= mysql_query("Update tbl_truck_report Set branch='".$_POST['branch']."', suppliername='' Where id='".$_POST['id']."'") or die(mysql_error());

$givendelete= mysql_query("Update tbl_givento SET supllier_name='',issuancedate='',enddate='',amortization='',cashbond='',proposedvolume='' Where truckid='".$_POST['id']."'") or die(mysql_error());


$delete = mysql_query("Delete from tbl_reassign Where id='".$_GET['id']."'") or die(mysql_error());

}else{
	$updated= mysql_query("Update tbl_truck_report Set branch='".$_POST['branch']."' Where id='".$_POST['id']."'") or die(mysql_error());
	$update_givento = mysql_query("Update tbl_givento Set name= '".$_POST['branch']."' Where truckid='".$_POST['id']."' ") or die (mysql_error());
			
	$in = mysql_query("Insert into tbl_forrepair (truckid,receivingbranch,sendingbranch,datereceive,remarks)
						Values ('".$_POST['id']."','".$_POST['branch']."','".$_POST['sendingbranch']."','$date','".$_POST['remarks']."')") or die(mysql_error());
												
	$insert = mysql_query("Insert into tbl_reassignmenthistory (truckplate,branch,issuancedate,enddate,prepared,remarks,status)
Values ('".$_POST['id']."','".$_POST['branch']."','".$_POST['issuancedate']."','$date','".$_POST['preparedby']."','".$_POST['remarks']."','For Repair')") or die (mysql_error());
	
	$delete = mysql_query("Delete from tbl_reassign Where id='".$_GET['id']."'") or die(mysql_error());

	}

?>
<script>
alert("Successful.");
location.replace("truck_reassign.php");
</script>