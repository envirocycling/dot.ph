<?php
session_start();
$position = $_SESSION['position'];
$branch = $_SESSION['user_branch'];
?>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
<script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>


<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: 'src/loading.gif',
            closeImage: 'src/closelabel.png'
        })
    })
</script>


<?php
if($position == 'Programmer' || $branch == 'Pampanga'){
?>
<style>
    #marking{
        position:relative;
        margin-top:500px;
    }#marking1{
        position:relative;
        margin-top:600px;
    }
    #prepared_by{
        font-size: 16px;
        position:absolute;
        margin-top: 250px;
    }
	#table{
		border-collapse:collapse;
		font-family:"Calibri";
	}

    #table td{
        font-size: 15px;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }
    #table th{
        font-size: 16px;
        text-align: center;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }

    #table_sup td{
        font-size: 17px;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }
    #table_sup th{
        font-size: 18px;
        text-align: center;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }
    #supplier_details{
        position:absolute;
        margin-top:20px;
        font-size:20px;

    }
    body{
        margin-top:80px;
        margin-left:50px;
        font-size:20px;
        padding:10px;
    }
    b{
        color:red;
    }
	#total{
		background-color:#FFFF00;
	}
</style>

<style type="text/css" media="print">
    .noprint{
        display:none;
		}
	body{
		background-image:url(images/word2.png);
		background-position:top;
		background-size: 25% 13px;
		background-repeat:no-repeat;
	}
</style>
<?php }else{?>
<style>
    #marking{
        position:relative;
        margin-top:500px;
    }#marking1{
        position:relative;
        margin-top:600px;
    }
    #prepared_by{
        font-size: 16px;
        position:absolute;
        margin-top: 250px;
    }

    #table td{
        font-size: 15px;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }
    #table th{
        font-size: 16px;
        text-align: center;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }

    #table_sup td{
        font-size: 17px;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }
    #table_sup th{
        font-size: 18px;
        text-align: center;
        /*position:absolute;*/
        /*margin-left: 500px;*/
    }
    #supplier_details{
        position:absolute;
        margin-top:20px;
        font-size:20px;

    }
    body{
        margin-top:80px;
        margin-left:50px;
        font-size:20px;
        padding:10px;
    }
    b{
        color:red;
    }

</style>

<style type="text/css" media="print">
    .noprint{
        display:none;
		}
	.noprint2{
        display:none;
		}
	body{
		background-image:url(images/word.png);
		background-repeat:no-repeat;
		background-position:top;
		background-size: 25% 13px;
	}
</style>
<?php }?>
<script>
	function incentives(){
		var inc2 = Number(document.getElementById("tot_del").value);
		var quota = Number(document.getElementById("inc_quota").value);
		var per = Number(document.getElementById("inc_per").value);
		var con = document.getElementById("con").value;
		var alls = document.getElementById("all").value;
		var lcwl = document.getElementById("lcwl").value;
		var occ = Number(document.getElementById("occ").value);
                if(con == '4' && alls == 'all'){
                    var tot_inc = ((inc2  * per) - lcwl).toFixed(2);	
                }else if(con == '5'){
                    var tot_inc = ((inc2  * per)).toFixed(2);	
                }else if(con == '4'){
			var tot_inc = (inc2  * per).toFixed(2);		
		}else if(con == '0' || con == '3'){
			var tot_inc = (inc2  * per).toFixed(2);		
		}else if(con == '1'){
			var tot_inc = ((inc2 - quota) *  per).toFixed(2);
		}else{
			var tot_inc = (quota *  per).toFixed(2);
		}
		
		var inc = tot_inc.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                //alert(con);
                if(con == '3'){
                    document.getElementById("inc").value = inc;
                        
                        var occ = Number(document.getElementById("tot_occ").value);
                        var tot_inc2 = ((occ * 0.05) -  tot_inc).toFixed(2);
                        var f_inc = tot_inc2.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                        document.getElementById("f_inc2").value = f_inc;
		}else if(con == '5'){
                    document.getElementById("inc").value = inc;
                        var occ = Number(document.getElementById("occ").value);
                        //alert(occ + '=' + tot_inc);
                        var tot_inc2 = (occ  -  tot_inc).toFixed(2);
                        var f_inc = tot_inc2.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                        document.getElementById("f_inc3").value = f_inc;
		}else{
                    document.getElementById("inc").value = inc;
                }
                
	}
</script>

<body onLoad="incentives();" class="body">
    <?php
    date_default_timezone_set('America/Los_Angeles');
    include ("config.php");
    $sup_id = $_POST['sup_id'];
    $wp_grade = $_POST['wp_grade'];
    $scheme = $_POST['scheme'];
    $quota = $_POST['quota'];
    $incentive = $_POST['incentive'];
   $type_chk = $_POST['type'];
    $supplier_name = $_POST['supplier_name'];
    $range_date_array = preg_split('/[ -.]/', $scheme);
    $end_date = $range_date_array[1];
    
    $query1= "SELECT * FROM incentive_scheme where sup_id='$sup_id' and wp_grade='$wp_grade' and scheme='$scheme' and type='$type_chk'";
    $result1 = mysql_query($query1);
    $row1 = mysql_fetch_array($result1);
    $type1 = $row1['type'];
    
    $sql_supplier = mysql_query("SELECT * from supplier_details WHERE supplier_id='$sup_id'") or die (mysql_error());
    $row_supplier = mysql_fetch_array($sql_supplier);
	
	if($sup_id == '12373' || $sup_id == '12366' || $sup_id == '13313' ||  $sup_id == '437' || $sup_id == '1630' || $type1 == 'Covered all excess deliveries in quota'){
		echo '<input type="text" value="1" id="con" class="noprint" readonly>';
	}else if($sup_id == '14211' || $sup_id == '1626' || $sup_id == '13112' || $sup_id == '1627' || $type1 == 'Covered quota only'){
		echo '<input type="text" value="2" id="con" class="noprint" readonly>';
	}else if($sup_id == '340'){
		echo '<input type="text" value="3" id="con" class="noprint" readonly>';
	}else if($sup_id == '250'){
		echo '<input type="text" value="4" id="con" class="noprint" readonly>';
	}else if($sup_id == '13166' && $type1 == 'Covered all deliveriess'){
		echo '<input type="text" value="5" id="con" class="noprint" readonly>';
	}else {
		echo '<input type="text" value="0" id="con" class="noprint" readonly>';
	}
	
	
    echo "<h5>Supplier with Quota On <b><u><i>" . $wp_grade . "</i></u></b> for the period of <b><u><i>" . $scheme . "</i></u></b></h5>";
    ?>
	<input type="hidden" id="inc_quota" value="<?php echo $quota;?>">
	<input type="hidden" id="inc_per" value="<?php echo $incentive;?>">
 <?php
if($position == 'Programmer' || $branch == 'Pampanga'){ ?>
    <div id="prepared_by" class="noprint2">
        Prepared By:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________ <br><br><br>
        Verified By:<br>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________ <br><br><br>
        Approved By:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ____________________________ <br><br><br>
    </div>

    <?php
}
    $query = "SELECT * FROM incentive_scheme where sup_id='$sup_id' and wp_grade='$wp_grade' and scheme='$scheme' and type='$type_chk'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
	$myId = $row['del_id'];

    $remarks = $row['remarks'];
    $type = $row['type'];

   if ($wp_grade == 'all_grades') {
        $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0 order by wp_grade,date_delivered;";
        echo '<input type="hidden" value="all" id="all">';
   } else {
       echo '<input type="hidden" value=" " id="all">';
        $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and wp_grade='$wp_grade' and weight>0 order by date_delivered;";
    }

    $result = mysql_query($query);
    
    $total = 0;
    while ($row = mysql_fetch_array($result)) {
        $total+=$row['weight'];
        $occ = strtoupper($row['wp_grade']);
        $total_occ[$occ] += $row['weight'];
    }
    echo "<div id='supplier_details'>";
    echo "<table border='0'>";
    echo "<tr>";
    echo "<td style='vertical-align: top;'>";
    echo "<table id='table_sup'>";
     if($sup_id == '340'){
         echo '<input type="hidden" id="tot_occ" value="'.$total_occ['OCC'].'">';
         echo "<tr>";
    echo "<td>" . "Name:" . "</td>";
    echo "<u><td><u>" . $supplier_name . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Quota:" . "</td>";
    echo "<u><td><u>" . number_format($quota, 2) . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Initial Per KG:" . "</td>";
    echo "<u><td><u>" . $incentive . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Initial Incentive:" . "</td>";
    echo "<td><u><input type='text' id='inc' style='border:0px;font-size:15px;
		text-decoration:underline;' readonly></span></td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Deduct Per KG:" . "</td>";
    echo "<u><td><u>0.10 </u>(only OCC)</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Final Incentive:" . "</td>";
    echo "<td><u><input type='text' id='f_inc2' style='border:0px;font-size:15px;
		text-decoration:underline;' readonly></span></td></u>";
    echo "</tr>";
    }else  if($sup_id == '13166' && $type1 == 'Covered all deliveriess'){
         echo '<input type="hidden" id="tot_occ" value="'.$total_occ['OCC'].'">';
         echo "<tr>";
    echo "<td>" . "Name:" . "</td>";
    echo "<u><td><u>" . $supplier_name . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Quota:" . "</td>";
    echo "<u><td><u>" . number_format($quota, 2) . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Initial Per KG:" . "</td>";
    echo "<u><td><u>" . $incentive . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Initial Incentive:" . "</td>";
    echo "<td><u><input type='text' id='inc' style='border:0px;font-size:15px;
		text-decoration:underline;' readonly></span></td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Deduct Per KG:" . "</td>";
    echo "<u><td><u>0.10 </u>(only OCC)</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Final Incentive:" . "</td>";
    echo "<td><u><input type='text' id='f_inc3' style='border:0px;font-size:15px;
		text-decoration:underline;' readonly></span></td></u>";
    echo "</tr>";
    }else{
    echo "<tr>";
    echo "<td>" . "Name:" . "</td>";
    echo "<u><td><u>" . $supplier_name . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Quota:" . "</td>";
    echo "<u><td><u>" . number_format($quota, 2) . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Per KG:" . "</td>";
    echo "<u><td><u>" . $incentive . "</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . "Incentive:" . "</td>";
    echo "<td><u><input type='text' id='inc' style='border:0px;font-size:15px;
		text-decoration:underline;' readonly></span></td></u>";
    echo "</tr>";
    }
    echo "<tr>";
    echo "<td>Type:</td>";
    echo "<td>" .$type. "</td></u>";
    echo "</tr>";
    echo "</table>";
    echo "</td>";
    echo "<td>";

    if ($wp_grade == 'all_grades') {
        //$query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0 and branch_delivered LIKE '%".$row_supplier['branch']."%' order by wp_grade,date_delivered;";
       $query = "select * from paper_buying where supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $end_date  . "'  ORDER BY date_received DESC";
    
       // echo "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0  branch_delivered LIKE '%".$row_supplier['branch']."%' order by wp_grade,date_delivered;";
    } else if ($wp_grade == 'all_without_lcwl') {
        //$query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0 and branch_delivered LIKE '%".$row_supplier['branch']."%' order by wp_grade,date_delivered;";
       $query = "select * from paper_buying where supplier_id='$sup_id' and wp_grade NOT LIKE 'LCWL%' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $end_date  . "'  ORDER BY date_received DESC";
    
       // echo "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0  branch_delivered LIKE '%".$row_supplier['branch']."%' order by wp_grade,date_delivered;";
    } else if ($wp_grade == 'all_without_occ') {
        //$query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0 and branch_delivered LIKE '%".$row_supplier['branch']."%' order by wp_grade,date_delivered;";
       $query = "select * from paper_buying where supplier_id='$sup_id' and wp_grade NOT LIKE '%OCC%' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $end_date  . "'  ORDER BY date_received DESC";
    
       // echo "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0  branch_delivered LIKE '%".$row_supplier['branch']."%' order by wp_grade,date_delivered;";
    } else {
         $query = "select * from paper_buying where wp_grade='$wp_grade' and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $end_date  . "' ORDER BY date_received DESC";
       // $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and wp_grade='$wp_grade' and weight>0 and branch_delivered LIKE '%".$row_supplier['branch']."%' order by date_delivered;";
    }

    $result = mysql_query($query);
    echo "<table border='1' id='table'>";
    echo "<thead>";
    echo "<th>Date Delivered</th>";
    echo "<th>Corrected Weight</th>";
    echo "<th>Wp Grade</th>";
    echo "<th>Price + Incentives</th>";
   
if($position == 'Programmer' || $branch == 'Pampanga'){
echo "<th>Branch Delivered</th>";}
    echo "</thead>";
    $total = 0;
    while ($row = mysql_fetch_array($result)) {
      // echo $row['branch_delivered'].$row['wp_grade'].'-'.$row['weight'].'='.$sup_id.'-'.$range_date_array[0].'-'.$row['date_delivered'].'asda<br>';
        if ($row['wp_grade'] == 'OCC') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='OCC' or wp_grade='LCOCC') and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "' and  branch LIKE '%".$row_supplier['branch']."%' ORDER BY date_received DESC");
        } else if ($row['wp_grade'] == 'CHIPBOARD' || $row['wp_grade'] == 'CB') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CB' or wp_grade='CHIPBOARD') and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "' and  branch LIKE '%".$row_supplier['branch']."%' ORDER BY date_received DESC");
        } else if ($row['wp_grade'] == 'CBS') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CBS' or wp_grade='LCCBS') and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "'  and  branch LIKE '%".$row_supplier['branch']."%' ORDER BY date_received DESC");
        } else {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='" . $row['wp_grade'] . "' and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "'  and  branch LIKE '%".$row_supplier['branch']."%' ORDER BY date_received DESC");
        }
        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
        
        echo "<tr class='light'>";
        echo "<td>" . $row['date_received'] . "</td>";
        echo "<td>" . number_format($row['corrected_weight'], 2) . "</td>";
        echo "<td>" . $row['wp_grade'] . "</td>";
        echo "<td>" . $row['unit_cost'] . "</td>";
			//}else{
			//	echo "<td>" . $row['prev_unit_cost'] . "</td>";
			//}
		   
//        } else {
//            echo "<td>" . $rs_paper_buying['prev_unit_cost'] . "</td>";
//        }
//        } else {
//            if ($row['wp_grade']=='OCC') {
//                $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='OCC' or wp_grade='LCOCC') and supplier_id='$sup_id' and date_received<='".$range_date_array[0]."' ORDER BY date_received DESC");
//            }  else if ($row['wp_grade']=='CHIPBOARD') {
//                $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CB' or wp_grade='CHIPBOARD') and supplier_id='$sup_id' and date_received<='".$range_date_array[0]."' ORDER BY date_received DESC");
//            } else if ($row['wp_grade']=='CBS') {
//                $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CBS' or wp_grade='LCCBS') and supplier_id='$sup_id' and date_received<='".$range_date_array[0]."' ORDER BY date_received DESC");
//            } else {
//                $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='".$row['wp_grade']."' and supplier_id='$sup_id' and date_received<='".$range_date_array[0]."' ORDER BY date_received DESC");
//            }
//            $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//            if($rs_paper_buying['prev_unit_cost']=='') {
//                echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
//            } else {
//                echo "<td>" . $rs_paper_buying['prev_unit_cost'] . "</td>";
//            }
//        }

       
if($position == 'Programmer' || $branch == 'Pampanga'){  echo "<td>" . $row['branch'] . "</td>"; $chk = 1;}
        echo "</tr>";
        $total+=$row['corrected_weight'];
        $grade = strtoupper($row['wp_grade']);
        if($grade == 'LCWL'){
            $wp_lcwl+=$row['corrected_weight'];
        }else if($grade == 'OCC'){
            $wp_occ+=$row['corrected_weight'];
        }
    }
    echo "<tr id='total'>";
    echo "<td><b>TOTAL</b></td>";
    echo "<td><b>" . number_format($total, 2) . "</b></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</table>";
   if($chk != 1){ echo '<tr>
               <td style="color:red;"><b><br /><br />Note: This is a branch copy and not the orginal copy.</b></td>
        </tr>'; } 
    echo "</td>";
    echo "</tr>";
    echo "</table>";

    echo "</div>";
    if ($_SESSION['usertype'] == 'Super User' && $total >= $quota ) {
    //if ($_SESSION['usertype'] == 'Super User' ) {
       if ($remarks == '') {
            echo "<div id='marking'>";
            echo "<a  rel='facebox' href='inc_mark_confirmation.php?del_id=" . $myId . "'><button class='noprint'>Mark As Processed</button></a>";
            echo "</div>";
        }
    }else  if ($_SESSION['user_branch'] == 'Pampanga'  || $_SESSION['user_branch'] == 'Cavite' ) {
    //if ($_SESSION['usertype'] == 'Super User' ) {
       if ($remarks == '') {
            echo "<div id='marking'>";
            echo "<a  rel='facebox' href='inc_mark_confirmation.php?del_id=" . $myId . "'><button class='noprint'>Mark As Processed</button></a>";
            echo "</div>";
        }
    }
    if($total < $quota){
         echo "<div id='marking1' style='color:red;'>";
            echo "<i>Quota not meet.</i>";
            echo "</div>";
    }
        $lcwls = $incentive * $wp_lcwl;
        $occs = 0.10 * $wp_occ;
        //echo $wp_occ;
	echo '<input type="hidden" id="tot_del" value="'.$total.'">';
        echo '<input type="hidden" id="lcwl" value="'.$lcwls.'">';
        echo '<input type="hidden" id="occ" value="'.$occs.'">';
    ?>
</body>
