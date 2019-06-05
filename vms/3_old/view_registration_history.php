<?php
include('connect.php');
?>
 <link href="../css/table1.css" media="screen" rel="stylesheet" type="text/css" />
 <center>
<table>
	<tr>
		<td colspan="3" align="center">Registration History<hr></hr></td>
	</tr>
	<tr>
		<td colspan="3">
			<?php 
			
			$timezone=+8;
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
    <select name="month">  
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
|
<select name="year" reuired>
	 <?php if(isset($_POST['filter'])){?> 
	 	<option value="<?php echo $_POST['year'];?>"><?php echo $_POST['year'];?></option>
	 <?php }else{?>
	 	<option value="<?php echo date('Y');?>"><?php echo date('Y');?></option>
	 <?php }?>
		<option value="2016">2016</option>
		<option value="2017">2017</option>
		<option value="2018">2018</option>
		<option value="2019">2019</option>
		<option value="2020">2020</option>
</select>
 <input type="submit" name="filter"  value="Filter">
</form>
		</td>
	</tr>
	<tr>
		 <table width="60%"  border="1px" align="center" class="CSSTableGenerator">    
			<tr>
				<td>Branch</td>
				<td>Plate#</td>
				<td>Year</td>
				<td>Status</td>
			</tr>
			
			<?php
			 $myYear = date('Y');
			if(!isset($_POST['filter'])){
				$myMonth = date('m');
				$reg_history = mysql_query("SELECT * from tbl_registration_history WHERE date='$myYear'") or die (mysql_error());
			}else{
				$reg_history = mysql_query("SELECT * from tbl_registration_history WHERE date='".$_POST['year']."'") or die (mysql_error());
				$myMonth = $_POST['month'];
			}
				while($row = mysql_fetch_array($reg_history)){
					$truck = mysql_query("SELECT * from tbl_truck_report WHERE ending Like '%$myMonth' and id='".$row['truckid']."'") or die(mysql_error());
					$row_truck = mysql_fetch_array($truck);
					//echo $myMonth;
					if(mysql_num_rows($truck) > 0){
						if(empty($row['status']) || $row['date']== ' '){
							$status = 'Not Register';
						}else{
							$status = 'Registred';
						}
					echo '<tr>
							<td>'.$row_truck['branch'].'</td>
							<td>'.$row_truck['truckplate'].'</td>
							<td>'.$row['date'].'</td>
							<td>'.$status.'</td>
						</tr>';
				}
			}
			?>
			
		</table>
	</tr>
</table>
</center>