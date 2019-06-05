<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
	<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script src="js/setup.js" type="text/javascript"></script>
	<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
	</script>
	<link href="css/select2.min.css" rel="stylesheet">
	<link href="css/tables.css" rel="stylesheet">

</head>
<body>
<html>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
    function f_action(id){
        var message = confirm("Do you want to proceed?");
        
        if(message == true){
            var data = id.split("_");
            var datax = 'id=' + data[1] + '&action=' + data[0];
                $.ajax({
                    type: 'POST',
                    data: datax,
                    url: 'terminated_contract_exec.php'
                }).done(function(){
                    alert("Successful.");
                    location.reload();
                });
        }else{
            return false();
        }
    }
</script>
<?php include('layout/header.php');  ?>
<center>
			<div id="body">

<table id="page1"><tr><td align="left">Terminated Contract<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />

 <?php
 include('connect.php');
 	 mysql_query("UPDATE tbl_contract SET gm_noti='1' Where status LIKE '%pending%' Order by id Asc")or die (mysql_error());	

 ?>
<?php //startofcode===========================================================================?>
<br /><br />
<?php 

$select = mysql_query("Select * from tbl_contract Where status LIKE '%pending%' Order by id Asc")or die (mysql_error());?>
<table width="80%"  align="center">
<tr>
<td>
<table  class="CSSTableGenerator">
<td>Branch</td>
<td>Suppliername</td>
<td>Plate No.</td>
<td>Description</td>
<td>Status</td>
<td colspan="2">Action</td>
</tr>
    <?php
        while($row_select = mysql_fetch_array($select)){
            include('connect.php');
            $truck = mysql_query("SELECT * from tbl_truck_report WHERE id = '".$row_select['truck_id']."'") or die(mysql_error());
            $row_truck = mysql_fetch_array($truck);
            
            include 'connect_out.php';
                $sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id = '".$row_truck['suppliername']."' ") or die(mysql_error());
                $row_supplier = mysql_fetch_array($sql_supplier);
            echo '<tr>
                        <td>'.$row_truck['branch'].'</td>
                        <td>'.$row_supplier['supplier_name'].'</td>
                        <td>'.$row_truck['truckplate'].'</td>
                        <td>'.$row_select['description'].'</td>
                        <td>'.ucwords($row_select['status']).'</td>
                        <td><input type="button" value="Approved" id="approved by gm_'.$row_select['id'].'" onclick="f_action(this.id);"></td>
                        <td><input type="button" value="Disapproved" id="disapproved by gm_'.$row_select['id'].'" onclick="f_action(this.id);"></td>
                 </tr>';
        }
    ?>
</table>
</td>
</tr>
</table>


<?php //endtofcode===========================================================================?>

</div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>