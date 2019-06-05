
<?php
 date_default_timezone_set("Asia/Singapore");
function week_number( $date = 'today' ) 
{ 
    return ceil( date( 'j', strtotime( $date ) ) / 7 ); 
 
} 
 
?>
 

 
<?php
 
 $week_num = week_number();

 
$month = date("m", time());

?>

<!doctype html>
<html lang=''>
<head>
	<title>Vehicle Management System</title>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/slider.css">
   <script src="js/header.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
   <link href="css/table.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
	<script src="js/setup.js" type="text/javascript"></script>
	 <script src="js/slider.js"></script>
	<link href="css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="js/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
</head>
<body>
<html>

<?php include('layout/header.php');?>
<center>
			<div id="body">
			<table id="page1"><tr><td align="left">Registration<br /><td><td align="right"><span id="back" onClick="backed();">Back</span><td/></tr></table>
<br />
<?php
include('connect.php');
?>
<br /><br />

<table align="center">

            
<tr><td> <?php $timezone=+8;
	 $date= gmdate('m',time() + 3600*($timezone+date("I")));
	 if($date  > 9 ){
		 $num = $date;
		 }else {
		 $num =  substr($date,1);}
		 ?>
         <form action="" target="_self" method="post">
        
          <?php if($num == 1)
	 {		$rmonth = "January";
		} else if($num == 2)
	 {		$rmonth = "February";
		}else if($num == 3)
	 {		$rmonth = "March";
		}else if($num == 4)
	 {		$rmonth = "April";
		}else if($num == 5)
	 {		$rmonth = "May";
		}else if($num == 6)
	 {		$rmonth = "June";
		}else if($num == 7)
	 {		$rmonth = "July";
		}else if($num== 8)
	 {		$rmonth = "August";
		}else if($num == 9)
	 {		$rmonth = "September";
		} else if($num == 10)
	 {		$rmonth = "October";
		} ?>
               <?php if(@$_POST['month'] == 1)
	 {		@$fmonth = "January";
		} else if(@$_POST['month'] == 2)
	 {		@$fmonth = "February";
		}else if(@$_POST['month'] == 3)
	 {		@$fmonth = "March";
		}else if(@$_POST['month'] == 4)
	 {		@$fmonth = "April";
		}else if(@$_POST['month'] == 5)
	 {		@$fmonth = "May";
		}else if(@$_POST['month'] == 6)
	 {		@$fmonth = "June";
		}else if(@$_POST['month'] == 7)
	 {		@$fmonth = "July";
		}else if(@$_POST['month']== 8)
	 {		@$fmonth = "August";
		}else if(@$_POST['month'] == 9)
	 {		@$fmonth = "September";
		} else if(@$_POST['month'] == 't')
	 {		@$fmonth = "All";
		}else 
	 {		@$fmonth = "October";
		}  
		?>
    <select name="month" id="text">  
    <?php if(isset($_POST['filter'])){?>   
    <option value="<?php echo $_POST['month'];?>"> <?php echo $fmonth;?></option> <?php }else{ ?>
 <option value="<?php echo $num;?>"> <?php echo $rmonth;?></option><?php } ?>
 <option value="t">All</option>
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>

</select>
 <input type="submit" name="filter"  value="Filter" id="button">
<form></td></tr>
</table>
<table width="60%" align="center"><tr><td align="right"><br /><br/><input type="button" value="View History" onClick="window.open('view_registration_history.php','', 'width=400px, height=500px')">
 <table width="60%"  border="1px" align="center" class="CSSTableGenerator">    
		<tr>
            <td align="center">Branch</td>
				<td align="center">Vehicle Plate</td>
            <td align="center">Insurance</td>
			<td align="center">Stencil</td>
			<td align="center">Emission</td>
			<td align="center">Status</td>
            <td align="center">Location</td>
            <td align="center" width="20%">Remarks</td>
			<td align="center" colspan="2">Action</td>
			
		</tr>	 
    
   
        
   <?php //select month today=============================================================================
  
   
   if(isset($_POST['filter'])){
  			if($_POST['month'] == 't'){
			$result= mysql_query("Select * from tbl_truck_report WHERE class!='HE' and status='' ORDER BY ending ASC ") or die (mysql_error()); }else{
			$result= mysql_query("Select * from tbl_truck_report Where class!='HE' and ending='".$_POST['month']."' and status='' ORDER BY ending ASC") or die (mysql_error()); }
   			

				 } else {
  $result= mysql_query("Select * from tbl_truck_report Where  class!='HE' and ending='$num' and status=''") or die (mysql_error()); }?>
 
 <?php

 

	while($row=mysql_fetch_array($result))
  
	{
	
  ?>
                                              
                                              
 
		<tr >
				<form method="post" >
					<input type="hidden" value="<?php echo $row['id']; ?>">
                    <?php $registration = "SELECT * FROM tbl_truckregistration Where truckid='".$row['id']."' ";
$result_registration = mysql_query($registration) or die("Error in query : $query".mysql_error());
					$row_reg=mysql_fetch_array($result_registration);
					?>
				</form>
	       <td align="center"><font size="-2"><?php echo strtoupper($row['branch']); ?></td>
    		<td align="center"><font size="-2"><?php echo strtoupper($row['truckplate']);

 


				$len = strlen($row['truckplate']) - 1;
			$len2 = $len - 1;
			
			$var  = str_split($row['truckplate']);
			
			$fweek = $var[1];
			
		 $lastending = substr($row['truckplate'],$len);
		    if(is_numeric($lastending)){
				$ending = $lastending;
			}else if(is_numeric($var[3])){
				$ending = $var[3];
			}else if(is_numeric($var[2])){
				$ending = $var[2];}
				
			
			$week2= substr($row['truckplate'],$len2);
			$week3 = str_split($week2);
			
			$lastweek = $week3[0];
			if(is_numeric($lastweek)){
				$week = $lastweek;
			}else{
				$week =$fweek;
				}
				if($week < 4 &&  $week > 0){
					$weeks='1';
					}else if( $week < 7 && $week > 3){
						$weeks ='2';
						}else if( $week < 9  && $week > 6){
						$weeks ='3';
						}else if( $week == 9  && $week == 0){
						$weeks ='4';
						}
				
				
		$timezone=+8;
		$c_year =  $row_reg['year'];
	 $year= gmdate('Y',time() + 3600*($timezone+date("I")));

$ctr = 0;



 $m= gmdate('m',time() + 3600*($timezone+date("I")));
	 $months = substr($m,1);


	if($week_num == @$weeks && $months == $ending && $year > $c_year){
	{
		mysql_query("Update tbl_truckregistration Set insurance='', stencil='', emission='', location='', remarks='', status='0' Where truckid='".$row['id']."' ") or die (mysql_error());
		}
	}

	
			?>
            </td>
     			<td align="center"><font size="-2"><?php echo strtoupper($row_reg['insurance']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row_reg['stencil']); ?></td>
			<td align="center"><font size="-2"><?php echo strtoupper($row_reg['emission']); ?></td>
            <td align="center"><font size="-2"><?php
			if($row_reg['status'] == 0 ){ 
				$true = 1;
			}
			 if($row_reg['status'] == 0 ){ echo "NOT REGISTER"; 
													}else  {
														echo "REGISTRED";
														}
			?></td>			
                <td align="center"><font size="-2"><?php echo strtoupper($row_reg['location']); ?></td>
            <td align="center"><font size="-2"><?php echo strtoupper($row_reg['remarks']); ?></td>
			
		<td><?php  echo '<a rel="facebox" href="truck_updatereg.php?id='.$row['id'].'">' ?><input type="button" value="Update"/></a></td><td>
<?php

if($row_reg['status'] == 0) {
	echo '<a  rel="facebox" href="registration_registered.php?id='.$row['id'].'">' ?><input type="button" value="Register" ></a>
	<?php }else{
echo '<a href="registration_cancel.php?id='.$row['id'].'">' ?><input type="button" value="Cancel" onClick="return confirm('Do you want to Cancel this Registration?');"></a><?php } 
}
?>
			</td>
                    
		</tr>

	


		<?php 
			if(!isset($_POST['filter'])){
			  $sql_reg= mysql_query("Select * from tbl_truck_report Where class!='HE' and  ending < '$months' and status='' order by ending Asc ") or die (mysql_error());
			  	echo '<tr>
							<td colspan="10" style="background-color:gray;color:white;font-size:15px;"><center>Vehicles are not yet register must show below</center></td>
					</tr>';
			  	while($row_reg = mysql_fetch_array($sql_reg)){
					$sql_regstatus = mysql_query("SELECT * from tbl_truckregistration WHERE truckid='".$row_reg['id']."' and status='0'") or die(mysql_error());	
					$row_regstatus = mysql_fetch_array($sql_regstatus);
				if(mysql_num_rows($sql_regstatus) > 0){
				?>
					<tr>
						<td><font size="-2"><?php echo $row_reg['branch'];?></font></td>
						<td><font size="-2"><?php echo $row_reg['truckplate'];?></font></td>
						<td><font size="-2"><?php echo $sql_regstatus['insurance'];?></font></td>
						<td><font size="-2"><?php echo $sql_regstatus['stencil'];?></font></td>
						<td><font size="-2"><?php echo $sql_regstatus['emission'];?></font></td>
						<td><font size="-2"><?php if($sql_regstatus['status'] == 1){
							$reg = 'REGISTERED';
						}else{ $reg = 'NOT REGISTER';}
							
						echo $reg;?></font>
						</td>
						<td><font size="-2"><?php echo $sql_regstatus['location'];?></font></td>
						<td><font size="-2"><?php echo $sql_regstatus['remarks'];?></font></td>
						<td><?php  echo '<a rel="facebox" href="truck_updatereg.php?id='.$row['id'].'">' ?><input type="button" value="Update"/></a></td><td>
<?php
//echo $row_regstatus['truckid'].'-';
if($sql_regstatus['status'] == 0) {
	echo '<a  rel="facebox" href="registration_registered.php?id='.$row_regstatus['truckid'].'">' ?><input type="button" value="Register" ></a>
	<?php }else{
echo '<a href="registration_cancel.php?id='.$row['id'].'">' ?><input type="button" value="Cancel" onClick="return confirm('Do you want to Cancel this Registration?');"></a><?php } 
}
?>
			</td>
		<?php }}?>

</table>
</td>
</tr>
      </table>  
   <?php
if(@$true > 0){ 
  ?>
      <link rel="stylesheet" href="css/zebra_dialog.css" type="text/css">
    	<script type="text/javascript" src="js/zebra_dialog.js"></script>
    	<script type="text/javascript">
		$(document).ready(function() {
			new $.Zebra_Dialog('<strong>Registration</strong><br><br>', {
            source: {'iframe': {
                'src':  'need_toregister.php',
                'height': 350
            }},
            width: 700,
            title:  'Need To Register'
       	 	});
		});
	</script>
<?php }
       //=====================================================================================================?>

<br /><br />
<br /><br />


 </div>
</center>
<?php include('layout/footer.php');?>
</body>
</html>

 
