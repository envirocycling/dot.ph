  <?php 
include('connect.php');
$plate = $_GET['id'];
$select_plate = mysql_query("SELECT * from tbl_truck_report WHERE truckplate LIKE '%$plate%'") or die (mysql_error());
$row_plate = mysql_fetch_array($select_plate);
$truck_id = $row_plate['id'];

$select_1 = mysql_query("SELECT * from tbl_trucktires WHERE tireid='1' and truckplate='$truck_id' ") or die (mysql_error());
$row_1 = mysql_fetch_array($select_1);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>motor</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Save for Web Styles (motor.psd) -->
<style type="text/css">
<!--

#Table_01 {
	position:absolute;
	left:15%;
	top:0px;
	width:800px;
	height:450px;
}

#motor-01_ {
	position:absolute;
	left:0px;
	top:0px;
	width:800px;
	height:158px;
}

#motor-02_ {
	position:absolute;
	left:0px;
	top:158px;
	width:284px;
	height:292px;
}

#motor-03_ {
	position:absolute;
	left:284px;
	top:158px;
	width:221px;
	height:292px;
}

#motor-04_ {
	position:absolute;
	left:505px;
	top:158px;
	width:295px;
	height:279px;
}

#motor-05_ {
	position:absolute;
	left:505px;
	top:437px;
	width:295px;
	height:13px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF;">
<!-- Save for Web Slices (motor.psd) -->
<div id="Table_01">
	<div id="motor-01_">
		<img id="motor_01" src="../images/motor_01.gif" width="800" height="158" alt="" />
	</div>
	<div id="motor-02_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=2&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="motor_02" src="../images/motor_02.gif" width="284" height="292" alt="" /></a>
	</div>
	<div id="motor-03_">
		<img id="motor_03" src="../images/motor_03.gif" width="221" height="292" alt="" />
	</div>
	<div id="motor-04_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=1&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="motor_04" src="../images/motor_04.gif" width="295" height="279" alt="" /></a>
	</div>
	<div id="motor-05_">
		<img id="motor_05" src="../images/motor_05.gif" width="295" height="13" alt="" />
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>