<?php
//error_reporting(E_ERROR | E_PARSE);
include('templates/template.php');
if (!isset($_SESSION['username'])) {
    echo "<script>
window.location = 'index.php';
</script>";
}
include 'config.php';

$branch_array = array();

$sql_branch = mysql_query("SELECT * FROM branches");
while ($rs_branch = mysql_fetch_array($sql_branch)) {
    array_push($branch_array, $rs_branch['branch_name']);
}
?>
<script src="js/jquery.min.js" type="text/javascript"></script>
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
<html>
    <style>
    h1{
        color:white;
    }
    a{
        color:blue;
    }
    body{
        background-color: #2e5e79;
    }
</style>
<body  onload="tbls();">
<div class="grid_4">
    <div class="box round first">
       <form action="" method="POST">
		
			<table>
				<tr height="30px">
                                    <td>
					<form action="" method="POST">
            From: <input type='text' id='inputField' name='from' value="<?php
            if (isset($_POST['from'])) {
                echo $_POST['from'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8"></td>
            <td>&nbsp;&nbsp;&nbsp;To: <input type='text' id='inputField2' name='to' value="<?php
            if (isset($_POST['to'])) {
                echo $_POST['to'];
            } else {
                echo date("Y/m/d");
            }
            ?>" onfocus='date1(this.id);' readonly size="8">
                </td>
                <td>
                    <?php 
                    $sql_client = mysql_query("SELECT * FROM client");
                        if (isset($_POST['from'])) {
                            echo 'Client: <select name="client">';
                            if ($_POST['client'] != '') {
                                $sql_clientSet = mysql_query("SELECT * FROM client WHERE cid='".$_POST['client']."'");
                                $row_clintSet = mysql_fetch_array($sql_clientSet);
                                echo '<option value="' . $_POST['client'] . '">' . strtoupper($row_clintSet['client_name']) . '</option>';
                            }
                            while($row_client = mysql_fetch_array($sql_client)){
                                 echo '<option value="' . $row_client['cid'] . '">' . strtoupper($row_client['client_name']) . '</option>';
                            }
                        }else{
                            echo 'Client: <select name="client">';
                            while($row_client = mysql_fetch_array($sql_client)){
                                 echo '<option value="' . $row_client['cid'] . '">' . strtoupper($row_client['client_name']) . '</option>';
                            }
                            echo '</select>&nbsp;&nbsp;&nbsp;';
                        }
                    ?>
                </td>
                <td>&nbsp;&nbsp;&nbsp;
            <input type="submit" name="submit" value="Filter">
            </td>
        </form>
				</tr>
			</table>
           
    </div>

</div>

<?php
	if(isset($_POST['submit'])){

    date_default_timezone_set("Asia/Singapore");
$from = date('Y-m-d', strtotime($_POST['from']));
$to =  date('Y-m-d', strtotime($_POST['to']));

$current_date = date('Y-m-d');            
               // echo "SELECT * from bales where (wp_grade='$wp_grade' and  date >='$from' and date<='$to' and ((out_date > '$to' or out_date < '$from' or out_date='' or str_no='0'))    and str_no!='VOID'  and  branch like '%$branch%'  and status !='rebaled') or (str_no='0' and str_no!='VOID' and (date_rebaled>'$to' or date_rebaled='') and status!='rebaled' and wp_grade='$wp_grade' and branch like '%$branch%'  and date <='$to')";
$sql_clientSet = mysql_query("SELECT * FROM client WHERE cid='".$_POST['client']."'");
$row_clintSet = mysql_fetch_array($sql_clientSet);
            ?>

 <div class="grid_10">
     <div class="box round first" style="width:2000px;">
		  <h2>Result in <?php echo '&nbsp;&nbsp;'.strtoupper($row_clintSet['client_name']).'&nbsp; ('.date('M d, Y', strtotime($_POST['from'])).' to '.date('M d, Y', strtotime($_POST['to'])).')';?></h2>
		<?php


echo '<table class="data display datatable" id="example">
<thead>
<tr class="data">
            <th class="data">Client</th>';
$arr_grade_history = array();
$arr_grade = array();
$arr_mat = array();
$arr_mat_heading = array();
$arr_grade_heading = array();

$sql_client_grade= mysql_query("SELECT * FROM client_price WHERE client_id='".$_POST['client']."' and date_effective >= '$from' and date_effective <= '$to' Order BY date_effective Asc") or die(mysql_error());
while($row_client_grade = mysql_fetch_array($sql_client_grade)){
    $sql_material = mysql_query("SELECT * FROM material WHERE material_id='".$row_client_grade['material_id']."'");
    $row_material = mysql_fetch_array($sql_material);
    $sql_current_price= mysql_query("SELECT * FROM client_price WHERE client_id='".$_POST['client']."' and material_id='".$row_client_grade['material_id']."' and date_effective <= '$current_date' Order by date_effective Desc LIMIT 1") or die(mysql_error());
    $row_current_price = mysql_fetch_array($sql_current_price);
    if($row_current_price['date_effective'] == $row_client_grade['date_effective'] && $row_client_grade['price'] == $row_current_price['price']){
        $arr_grade_history[$row_client_grade['material_id']] .= '<font color="green"><i>'.date('d-M-y',strtotime($row_client_grade['date_effective'])).'</i>&nbsp;:&nbsp;&nbsp;<b><u>'.$row_client_grade['price'].'</b></u></font><hr>';
    }else{
        $arr_grade_history[$row_client_grade['material_id']] .= '<i>'.date('d-M-y',strtotime($row_client_grade['date_effective'])).'</i>&nbsp;:&nbsp;&nbsp;<b><u>'.$row_client_grade['price'].'</b></u><hr>';
    }
        array_push($arr_grade,$row_material['code']);
        array_push($arr_mat,$row_client_grade['material_id']);
}
$arr_grade_heading = array_unique($arr_grade);
$arr_mat_heading = array_unique($arr_mat);
foreach($arr_grade_heading as $slct_grade){
        echo'<th class="data">'. $slct_grade.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
}
echo '</tr>
        </thead>';
echo "<tr class='data'>";
    echo "<td class='data' valign='middle'><center><font size='+10' color='black'><h1>".strtoupper($row_clintSet['client_name'])."</font></center></td>";
foreach($arr_mat_heading as $slcts_mat){
    echo "<td class='data' valign='top'>".$arr_grade_history[$slcts_mat]."</td>";
}
echo "</tr>";
echo "</table>";
?>
		
		</div>
 </div>
<?php }?>		 
<div class="clear">
</div>

<div class="clear">
</div>


</body>
</html>



