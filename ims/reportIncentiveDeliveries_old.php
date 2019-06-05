<?php
session_start();
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







<style>
    #marking{
        position:relative;
        margin-top:500px;
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
</style>

<script>
	function incentives(){
		var inc2 = Number(document.getElementById("tot_del").value);
		var quota = Number(document.getElementById("inc_quota").value);
		var per = Number(document.getElementById("inc_per").value);
		var tot_inc = (inc2  * per).toFixed(2);
		var inc = tot_inc.replace(/\D/g, "").replace(/([0-9])([0-9]{2})$/, '$1.$2').replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
		document.getElementById("inc").value = inc;
	}
</script>

<body onLoad="incentives();">

    <?php
    date_default_timezone_set('America/Los_Angeles');
    include ("config.php");
    $sup_id = $_POST['sup_id'];
    $wp_grade = $_POST['wp_grade'];
    $scheme = $_POST['scheme'];
    $quota = $_POST['quota'];
    $incentive = $_POST['incentive'];
    $supplier_name = $_POST['supplier_name'];
    $range_date_array = preg_split('/[ -.]/', $scheme);
    $end_date = $range_date_array[1];
    echo "<h5>Supplier with Quota On <b><u><i>" . $wp_grade . "</i></u></b> for the period of <b><u><i>" . $scheme . "</i></u></b></h5>";
    ?>
	<input type="hidden" id="inc_quota" value="<?php echo $quota;?>">
	<input type="hidden" id="inc_per" value="<?php echo $incentive;?>">

    <div id="prepared_by">
        Prepared By:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________ <br><br><br>
        Verified By:<br>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________ <br><br><br>
        Approved By:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ____________________________ <br><br><br>
    </div>

    <?php
    $query = "SELECT * FROM incentive_scheme where sup_id='$sup_id' and wp_grade='$wp_grade' and scheme='$scheme'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result);
	$myId = $row['del_id'];

    $remarks = $row['remarks'];

   if ($wp_grade == 'all_grades') {
        $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0 order by wp_grade,date_delivered;";
    } else {
        $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and wp_grade='$wp_grade' and weight>0 order by date_delivered;";
    }

    $result = mysql_query($query);
    
    $total = 0;
    while ($row = mysql_fetch_array($result)) {
        $total+=$row['weight'];
    }

    echo "<div id='supplier_details'>";
    echo "<table border='0'>";
    echo "<tr>";
    echo "<td style='vertical-align: top;'>";
    echo "<table id='table_sup'>";
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
    echo "</table>";
    echo "</td>";
    echo "<td>";


    if ($wp_grade == 'all_grades') {
        $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and weight>0 order by wp_grade,date_delivered;";
    } else {
        $query = "select date_delivered,weight,branch_delivered,wp_grade from sup_deliveries where  date_delivered  between '" . $range_date_array[0] . "' and '" . $end_date . "' and supplier_id='$sup_id' and wp_grade='$wp_grade' and weight>0 order by date_delivered;";
    }

    $result = mysql_query($query);
    echo "<table border='1' id='table'>";
    echo "<thead>";
    echo "<th>Date Delivered</th>";
    echo "<th>Weight</th>";
    echo "<th>Wp Grade</th>";
    echo "<th>Price</th>";
    echo "<th>Branch Delivered</th>";
    echo "</thead>";
    $total = 0;
    while ($row = mysql_fetch_array($result)) {
        echo "<tr class='light'>";
        echo "<td>" . $row['date_delivered'] . "</td>";
        echo "<td>" . number_format($row['weight'], 2) . "</td>";
        echo "<td>" . $row['wp_grade'] . "</td>";

        if ($row['wp_grade'] == 'OCC') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='OCC' or wp_grade='LCOCC') and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "' ORDER BY date_received DESC");
        } else if ($row['wp_grade'] == 'CHIPBOARD' || $row['wp_grade'] == 'CB') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CB' or wp_grade='CHIPBOARD') and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "' ORDER BY date_received DESC");
        } else if ($row['wp_grade'] == 'CBS') {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE (wp_grade='CBS' or wp_grade='LCCBS') and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "' ORDER BY date_received DESC");
        } else {
            $sql_paper_buying = mysql_query("SELECT * FROM paper_buying WHERE wp_grade='" . $row['wp_grade'] . "' and supplier_id='$sup_id' and date_received>='" . $range_date_array[0] . "' and date_received<='" . $row['date_delivered'] . "' ORDER BY date_received DESC");
        }
        $rs_paper_buying = mysql_fetch_array($sql_paper_buying);
//        if (!empty($rs_paper_buying['unit_cost'])) {
//        if ($rs_paper_buying['prev_unit_cost'] == '') {
            echo "<td>" . $rs_paper_buying['unit_cost'] . "</td>";
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

        echo "<td>" . $row['branch_delivered'] . "</td>";
        echo "</tr>";
        $total+=$row['weight'];
    }
    echo "<tr>";
    echo "<td><b>TOTAL</b></td>";
    echo "<td><b>" . number_format($total, 2) . "</b></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "</tr>";
    echo "</table>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";

    echo "</div>";

    if ($_SESSION['usertype'] == 'Super User') {
        if ($remarks == '') {
            echo "<div id='marking'>";
            echo "<a  rel='facebox' href='inc_mark_confirmation.php?del_id=" . $myId . "'><button class='noprint'>Mark As Processed</button></a>";
            echo "</div>";
        }
    }
	echo '<input type="hidden" id="tot_del" value="'.$total.'">';
    ?>

</body>
