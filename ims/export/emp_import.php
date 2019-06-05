 

<html>
  <head> 
  </head>
  <body>
<!-------------------------------------------------------------------------------------------------------------------->
  <form method="post" action="" enctype="multipart/form-data">
    	Actual: <input type="file" name="file" required /><br />
        <input type="submit" name="submit" value="Submit" />
</form>
<br /><br /><br />

	<?php
		include 'db_connection.php';
		//include 'reader.php';
    	$excel = new Spreadsheet_Excel_Reader();
	if(isset($_POST['submit'])){
		echo '======================================';
	?>	
	    <table border="1">
		<tr>
			<td>str_no</td>
			<td>date</td>
			<td>delivered_to</td>
			<td>plate_number</td>
			<td>wp_grade</td>
			<td>weight</td>
			<td>branch</td>
			<td>dr_number</td>
			<td>mc</td>
			<td>dirt</td>
			<td>net_wt</td>
			<td>comments</td>
		</tr>
		<?php
            $excel->read('actual.xls');  
		   $excel->read($_FILES['file']['tmp_name']);    
			$x=2;
			while($x<=$excel->sheets[0]['numRows']) {
				$str_no = isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
				$date = isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
				$delivered_to = isset($excel->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
				$plate_number = isset($excel->sheets[0]['cells'][$x][4]) ? $excel->sheets[0]['cells'][$x][4] : '';
				$wp_grade = isset($excel->sheets[0]['cells'][$x][5]) ? $excel->sheets[0]['cells'][$x][5] : '';
				$weight = isset($excel->sheets[0]['cells'][$x][6]) ? $excel->sheets[0]['cells'][$x][6] : '';
				$branch = isset($excel->sheets[0]['cells'][$x][7]) ? $excel->sheets[0]['cells'][$x][7] : '';
				$dr_number = isset($excel->sheets[0]['cells'][$x][8]) ? $excel->sheets[0]['cells'][$x][8] : '';
				$mc = isset($excel->sheets[0]['cells'][$x][9]) ? $excel->sheets[0]['cells'][$x][9] : '';
				$dirt = isset($excel->sheets[0]['cells'][$x][10]) ? $excel->sheets[0]['cells'][$x][10] : '';
				$net_wt = isset($excel->sheets[0]['cells'][$x][11]) ? $excel->sheets[0]['cells'][$x][11] : '';
				$comments = isset($excel->sheets[0]['cells'][$x][12]) ? $excel->sheets[0]['cells'][$x][12] : '';

				
				// Save details
				//$sql_insert="INSERT INTO users_details (id,name,job,email) VALUES ('','$name','$job','$email')";
				//$result_insert = mysql_query($sql_insert) or die(mysql_error()); 
				//$job = date('Y/d/m', strtotime($job));
				echo '<tr height="30px">
						<td>'.$str_no.'</td>
						<td>'.$date.'</td>
						<td>'.$delivered_to.'</td>
						<td>'.$plate_number.'</td>
						<td>'.$wp_grade.'</td>
						<td>'.$weight.'</td>
						<td>'.$branch.'</td>
						<td>'.$dr_number.'</td>
						<td>'.$mc.'</td>
						<td>'.$dirt.'</td>
						<td>'.$net_wt.'</td>
						<td>'.$comments.'</td>
				</tr>';
				 	
					/*$sql_chk = mysql_query("SELECT * from actual WHERE str_no='$str_no' and branch='$branch' and net_wt='$net_wt' and wp_grade='$wp_grade' and delivered_to='$delivered_to'") or die(mysql_error());
						if(mysql_num_rows($sql_chk) == 0 && !empty($str_no)){						
							mysql_query("INSERT INTO actual (str_no, date, delivered_to, plate_number, wp_grade, weight, branch, dr_number, mc, dirt, net_wt, comments) Values ('$str_no', '$date', '$delivered_to', '$plate_number', '$wp_grade', '$weight', '$branch', '$dr_number', '$mc', '$dirt', '$net_wt', '$comments')") or die(mysql_error());
						}
				*/	 
			  $x++;
			}
			}
		?>
	 </table>   


  </body>
</html>
