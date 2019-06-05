<?php

include("templates/template.php");



include("config.php");

?>



<style>



    .total{

        background-color: yellow;
		height:30px;
		text-align:center;
		font-weight:bold;
		padding-right: 7px;
    	padding-left: 7px
    }
	.total3{

        background-color: yellow;
		height:30px;
		text-align:center;
		font-weight:bold;
		text-decoration:overline;
    }
	.total2{

        background-color: #eaea80;
		height:30px;

    }
	.myTable{
		width:100%;
	}
	.tr{
		background-color:#333333;
		height:30px;
		font-size:11px;
		font-weight:bold;
		color:#FFFFFF;
	}
	.tr2{	
		background-color:#919090;
		height:20px;
	}
@media only screen and (min-device-width: 400px) {
    body {
		background-color:#2e5e79;
    }
}
</style>



<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />

<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>

<script type="text/javascript">

    function date1(str) {

        new JsDatePick({

            useMode: 2,

            target: str,

            dateFormat: "%Y/%m/%d"



        });

    }

    ;

</script>



<div class="grid_5">

    <div class="box round first grid">

        <h2>Deliveries to Client</h2>

        <form action="" method="POST">

            <br>

            <h6>Please select your range of dates</h6>

            <?php

            if (isset($_POST['submit'])) {

                ?>



                Start Period: <input type='text'  id='inputField' name='from' value="<?php echo $_POST['from']; ?>" onfocus='date1(this.id);' readonly size="8"><br>

                End Period:<input type='text'  id='inputField2' name='to' value="<?php echo $_POST['to']; ?>" onfocus='date1(this.id);' readonly size="8"><br>

                WP Grade: <select name="wp_grade">

                    <option value="<?php echo $_POST['wp_grade']; ?>"><?php echo $_POST['wp_grade']; ?></option>

                    <option value="">All</option>

                    <option value="LCOCC">LCOCC</option>

                    <option value="LCMW">LCMW</option>

                </select>

                <br>

                <?php

            } else {

                ?>

                Start Period: <input type='text'  id='inputField' name='from' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

                End Period:<input type='text'  id='inputField2' name='to' value="<?php echo date('Y/m/d'); ?>" onfocus='date1(this.id);' readonly size="8"><br>

                WP Grade: <select name="wp_grade">

                    <option value="">All</option>

                    <option value="OCC">OCC</option>

                    <option value="MW">MW</option>

                </select>

                <br>

                <?php

       
            }

            ?>

            <br>

            <input name="submit" type="submit" value="Generate Report">

        </form>

    </div>

</div>
<?php

if (isset($_POST['submit'])) {
	
    ?>
    <div class="grid_16">

        <div class="box round first grid">

            <h2>Deliveries to Client 

                <?php

               

                    echo "from All Branches";

                



                if ($_POST['wp_grade'] == '') {

                    echo " in All Grades.";

                } else {

                    echo " in " . $_POST['wp_grade'] . ".";

                }

                ?>

            </h2>



            <table class="myTable">

                <?php
				$myArray_del = array();	
				$myArray_del2 = array();	
				$myArray2 = array();
				$arr_val2 = array();
              echo "<tr class='tr' align='center'>";

               	echo '<td class="tr" rowspan="2">Branch</td>';
				$to_date = $_POST['to'];
				$from_date = $_POST['from'];
				$arr_myDel = array();
				$num3=0;
				
			while($to_date >= $from_date){
								
				$sql_del2 = mysql_query("SELECT * from actual WHERE date='$from_date' Group By delivered_to") or die(mysql_error());				
				$num = mysql_num_rows($sql_del2);
				while($row_del2 = mysql_fetch_array($sql_del2)){
				$del = strtoupper($row_del2['delivered_to']);
				$val = $del.'-'.$from_date;
				array_push($arr_myDel, $val);
				array_push($myArray2, $row_del2['delivered_to']);	
				if ($_POST['wp_grade'] == '') {			
				$mySql_del = mysql_query("SELECT * from actual WHERE date='$from_date' and delivered_to='".$row_del2['delivered_to']."'  and (wp_grade LIKE '%OCC%' or wp_grade LIKE '%MW%') ") or die(mysql_error());
				}else{
					$mySql_del = mysql_query("SELECT * from actual WHERE date='$from_date' and delivered_to='".$row_del2['delivered_to']."'  and (wp_grade LIKE '%".$_POST['wp_grade']."%') ") or die(mysql_error());
				}
				while($row_myDel = mysql_fetch_array($mySql_del)){
				$b1 = str_replace(" ","",$row_myDel['branch']);
				$b2 = strtoupper($b1);
				$val2 = $row_del2['delivered_to'].'-'.$b2;
				array_push($arr_val2, $val2);
					$myDel = strtoupper($row_del2['delivered_to']);
					$wp_grade = strtoupper($row_myDel['wp_grade']);
					$myArray_branch[$b2][$from_date][$wp_grade][$myDel] += $row_myDel['weight'];
					//echo $b2.'-'.$from_date.'-'.$wp_grade.'-'.$myDel.'<br />';
				}
				
			}
				
				   /*if ($_POST['wp_grade'] == '') {

                $sql_del = mysql_query("SELECT * FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and delivered_to='$deliver_to' and (wp_grade='LCOCC' or wp_grade='LCMW or wp_grade='LCMW_S') and date='$from_date'");

            } else if($_POST['wp_grade']=='LCMW') {

                $sql_del = mysql_query("SELECT * FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and delivered_to='$deliver_to' and (wp_grade='LCMW' or wp_grade='LCMW_S') and date='$from_date'");

            }else {

				$sql_del = mysql_query("SELECT * FROM actual WHERE branch like '%" . $_POST['branch'] . "%' and delivered_to='$deliver_to' and  wp_grade='".$_POST['wp_grade']."' and date='$from_date'");

			}*/
			
				//while($row_myDel = mysql_fetch_array($sql_del))
			
					echo '<td colspan="'.$num.'">'.date('F d, Y', strtotime($from_date)).'</td>';
			
				$from_date = date('Y/m/d', strtotime('+1 day', strtotime($from_date)));
				
			}
												
		
			 $myArray_del2 = array_unique($myArray2);
			 $num2 = count($myArray_del2);
			echo '<td colspan="'.$num2.'">Total</td>';
			echo '<td class="tr" rowspan="2"> GrandTotal&nbsp;&nbsp;&nbsp;</td>';			
		echo '</tr>';

				echo '<tr class="tr2">';
						 foreach ($arr_myDel as $deliver_to) {
						 $myVal = explode("-",$deliver_to);
						 $date3= date('d',strtotime($myVal[1]));
						 if( $date3 % 2){
   									?>
									<style>
						#s{
							background-color:#6699cc;
  							  padding-right: 7px;
    						  padding-left: 7px;
						}</style>
									<?php  echo '<td id="s">'.$myVal[0].'</td>';
								}else{
    								?>
									<style>
						.s{
							background-color:#00ccff;
							padding-right: 7px;
    						  padding-left: 7px;
						}
						</style>
									<?php echo '<td class="s">'.$myVal[0].'</td>';
								}
						}	
						foreach ($myArray_del2 as $del2) {
						
							echo '<td  style="background-color:#ffcc00;padding-right: 7px;
    						  padding-left: 7px;font-weight:bold;">'.$del2.'</td>';
						
						}
				echo '</tr>';
		$sql_branch = mysql_query("SELECT * from branches order by branch_name Asc")or die(mysql_error());
		
			while($row_branch = mysql_fetch_array($sql_branch)){
			$c = 1;
			$myDates = $_POST['from'];
					echo '<tr>';
					echo '<td class="total">'.$row_branch['branch_name'].'</td>';
					 foreach ($arr_myDel as $deliver_to) {
					 $myVal3 = explode("-",$deliver_to);
					 $deliver_to2 = $myVal3[0];
					 $myDated = $myVal3[1];
					  if($myDated != $myDates){
										$myDates = date('Y/m/d', strtotime('+1 day', strtotime($myDates)));		
					}
					if ($_POST['wp_grade'] == '') {	
					  $sql_actual = mysql_query("SELECT * from actual WHERE date ='$myDates' and branch LIKE '%".$row_branch['branch_name']."%' and delivered_to='$deliver_to2'  and (wp_grade LIKE '%OCC%' or wp_grade LIKE '%MW%') Order By date Asc") or die(mysql_error());	
					 }else{
					 	$sql_actual = mysql_query("SELECT * from actual WHERE date ='$myDates' and branch LIKE '%".$row_branch['branch_name']."%' and delivered_to='$deliver_to2'  and wp_grade LIKE '%".$_POST['wp_grade']."%' Order By date Asc") or die(mysql_error());
					 }
					
						 	$row_actual = mysql_fetch_array($sql_actual);
							$my_branch = strtoupper($row_actual['branch']);	
							$my_date = $row_actual['date'];	
							$my_grade = strtoupper($row_actual['wp_grade']);
							$my_del = strtoupper($row_actual['delivered_to']);	
							$dels = $myArray_branch[$my_branch][$myDates][$my_grade][$my_del];
							$tot_del = round(($dels/1000),2);
							$myArray_gt[$my_branch][$my_del] += $tot_del;
							$myArray_gt2[$my_del] += $tot_del;
							$myArray_tot[$my_date][$my_del] += $tot_del;
							$total_delivery += $tot_del;			
							//echo '<td class="s4">'.$tot_del.'</td>';

							 if( $c % 2){
   									?>
									<style>
						#s2{
							background-color:#bfdbdb;
						}</style>
									<?php  echo '<td id="s2">'.$tot_del.'</td>';
								}else{
    								?>
									<style>
						.s2{
							background-color:#cceeee;
						}
						</style>
									<?php echo '<td class="s2">'.$tot_del.'</td>';
								}
							
				$c++;
						}
				$c2=1;	
				$sql_branch2 = mysql_query("SELECT * from branches order by branch_name Asc")or die(mysql_error());
		
						foreach ($myArray_del2 as $del2) {
						$b3 = strtoupper($row_branch['branch_name']);
				
						 if( $c2 % 2){
   									?>
									<style>
						#s3{
							background-color:#eaea80;
							padding-right: 7px;
    						  padding-left: 7px;
						}</style>
									<?php  echo '<td id="s3">'.$myArray_gt[$b3][$del2].'</td>';
								}else{
    								?>
									<style>
						.s3{
							background-color:#f3f3be;
							padding-right: 7px;
    						  padding-left: 7px;
						}
						</style>
									<?php echo '<td class="s3">'.$myArray_gt[$b3][$del2].'</td>';
								}
							$myGt[$b3] += $myArray_gt[$b3][$del2];
							$c2++;
					}
					/*
					$myArray4 = array_unique($arr_val2);
					foreach ($myArray4 as $vals){
					$val5 = explode("-",$vals);
						 if( $c2 % 2){
   									?>
									<style>
						#s3{
							background-color:#eaea80;
						}</style>
									<?php  echo '<td id="s3">'.$val5[1].'</td>';
								}else{
    								?>
									<style>
						.s3{
							background-color:#f3f3be;
						}
						</style>
									<?php echo '<td class="s3">'.$val5[1].'</td>';
								}
							
							$c2++;
					}
				*/
					$b4 = strtoupper($row_branch['branch_name']);
					echo '<td class="total">'.$myGt[$b4].'</td>';
					echo '</tr>';
              
			  } 
                ?>

			<tr>
				<td class="total3">&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;</td>
				<?php
					 foreach ($arr_myDel as $deliver_to) {
						 $myVal = explode("-",$deliver_to);
						 $date3= date('d',strtotime($myVal[1]));
						 if( $date3 % 2){
   									?>
									<style>
						#s{
							background-color:#6699cc;
  							  padding-right: 7px;
    						  padding-left: 7px;
							  color:#FFFFFF;
							  height:30px;
							 font-weight:bold;
						}</style>
									<?php  echo '<td id="s">'.round($myArray_tot[$myVal['1']][$myVal[0]],2).'</td>';
								}else{
    								?>
									<style>
						.s{
							background-color:#00ccff;
							padding-right: 7px;
    						  padding-left: 7px;
							  height:30px;
							 font-weight:bold;
							 color:#FFFFFF;
						}
						</style>
									<?php echo '<td class="s">'.round($myArray_tot[$myVal['1']][$myVal[0]],2).'</td>';
								}
						}
						foreach ($myArray_del2 as $del2) {
						
							echo '<td  style="background-color:#ffcc00;padding-right: 7px;
    						  padding-left: 7px; font-weight:bold;">'.round($myArray_gt2[$del2],2).'</td>';
						
						}
				?>
				<td class="total3"><?php echo round($total_delivery,2);?></td>
			</tr>
            </table>

        </div>

    </div>



    <?php

}

?>


<div class="clear">



</div>
