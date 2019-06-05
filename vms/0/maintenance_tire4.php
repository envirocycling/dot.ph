<?php
include('connect.php');
$plate = $_GET['id'];
$select_plate = mysql_query("SELECT * from tbl_truck_report WHERE truckplate LIKE '%$plate%'") or die (mysql_error());
$row_plate = mysql_fetch_array($select_plate);
$truck_id = $row_plate['id'];

$select_1 = mysql_query("SELECT * from tbl_trucktires WHERE tireid='1' and truckplate='$truck_id' ") or die (mysql_error());
$row_1 = mysql_fetch_array($select_1);

?>
<center>
<button onClick="window.open('print_tire4.php?id=<?php echo $truck_id.'&plate='.$plate;?>','print_tire','width=700,height=650');"><font size="-1">View Tire Monitoring Record</font></button></center>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Save for Web Styles (NSX-Powertrain-Top-View.jpg) -->
<style type="text/css">
<!--

#Table_01 {
	position:absolute;
	left:4%;
	top:4%px;
	width:80%;
	height:50%;
}

#NSX-Powertrain-Top-View-01_ {
	position:absolute;
	left:0px;
	top:0px;
	width:213px;
	height:162px;
}

#NSX-Powertrain-Top-View-02_ {
	position:absolute;
	left:213px;
	top:0px;
	width:173px;
	height:84px;
}

#NSX-Powertrain-Top-View-03_ {
	position:absolute;
	left:386px;
	top:0px;
	width:466px;
	height:470px;
}

#NSX-Powertrain-Top-View-04_ {
	position:absolute;
	left:852px;
	top:0px;
	width:156px;
	height:68px;
}

#NSX-Powertrain-Top-View-05_ {
	position:absolute;
	left:1008px;
	top:0px;
	width:16px;
	height:470px;
}

#NSX-Powertrain-Top-View-06_ {
	position:absolute;
	left:852px;
	top:68px;
	width:156px;
	height:338px;
}

#NSX-Powertrain-Top-View-07_ {
	position:absolute;
	left:213px;
	top:84px;
	width:173px;
	height:310px;
}

#NSX-Powertrain-Top-View-08_ {
	position:absolute;
	left:0px;
	top:162px;
	width:12px;
	height:308px;
}

#NSX-Powertrain-Top-View-09_ {
	position:absolute;
	left:12px;
	top:162px;
	width:157px;
	height:155px;
}

#NSX-Powertrain-Top-View-10_ {
	position:absolute;
	left:169px;
	top:162px;
	width:44px;
	height:308px;
}

#NSX-Powertrain-Top-View-11_ {
	position:absolute;
	left:12px;
	top:317px;
	width:157px;
	height:153px;
}

#NSX-Powertrain-Top-View-12_ {
	position:absolute;
	left:213px;
	top:394px;
	width:162px;
	height:65px;
}

#NSX-Powertrain-Top-View-13_ {
	position:absolute;
	left:375px;
	top:394px;
	width:11px;
	height:76px;
}

#NSX-Powertrain-Top-View-14_ {
	position:absolute;
	left:852px;
	top:406px;
	width:156px;
	height:53px;
}

#NSX-Powertrain-Top-View-15_ {
	position:absolute;
	left:213px;
	top:459px;
	width:162px;
	height:11px;
}

#NSX-Powertrain-Top-View-16_ {
	position:absolute;
	left:852px;
	top:459px;
	width:156px;
	height:11px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF;">
<!-- Save for Web Slices (NSX-Powertrain-Top-View.jpg) -->
<div id="Table_01">
	<div id="NSX-Powertrain-Top-View-01_">
		<img id="NSX_Powertrain_Top_View_01" src="../images/NSX-Powertrain-Top-View_01.gif" width="213" height="162" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-02_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=3&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="NSX_Powertrain_Top_View_02" src="../images/NSX-Powertrain-Top-View_02.gif" width="173" height="84" alt="" /></a>
	</div>
	<div id="NSX-Powertrain-Top-View-03_"><img id="NSX_Powertrain_Top_View_03" src="../images/NSX-Powertrain-Top-View_03.gif" width="466" height="470" alt="" /></div>
	<div id="NSX-Powertrain-Top-View-04_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=1&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="NSX_Powertrain_Top_View_04" src="../images/NSX-Powertrain-Top-View_04.gif" width="156" height="68" alt="" /></a>
	</div>
	<div id="NSX-Powertrain-Top-View-05_">
		<img id="NSX_Powertrain_Top_View_05" src="../images/NSX-Powertrain-Top-View_05.gif" width="16" height="470" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-06_">
		<img id="NSX_Powertrain_Top_View_06" src="../images/NSX-Powertrain-Top-View_06.gif" width="156" height="338" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-07_">
		<img id="NSX_Powertrain_Top_View_07" src="../images/NSX-Powertrain-Top-View_07.gif" width="173" height="310" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-08_">
		<img id="NSX_Powertrain_Top_View_08" src="../images/NSX-Powertrain-Top-View_08.gif" width="12" height="308" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-09_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=11&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="NSX_Powertrain_Top_View_09" src="../images/NSX-Powertrain-Top-View_09.gif" width="157" height="155" alt="" /></a>
	</div>
	<div id="NSX-Powertrain-Top-View-10_">
		<img id="NSX_Powertrain_Top_View_10" src="../images/NSX-Powertrain-Top-View_10.gif" width="44" height="308" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-11_">
		<img id="NSX_Powertrain_Top_View_11" src="../images/NSX-Powertrain-Top-View_11.gif" width="157" height="153" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-12_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=4&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="NSX_Powertrain_Top_View_12" src="../images/NSX-Powertrain-Top-View_12.gif" width="162" height="65" alt="" /></a>
	</div>
	<div id="NSX-Powertrain-Top-View-13_">
		<img id="NSX_Powertrain_Top_View_13" src="../images/NSX-Powertrain-Top-View_13.gif" width="11" height="76" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-14_">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=2&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img id="NSX_Powertrain_Top_View_14" src="../images/NSX-Powertrain-Top-View_14.gif" width="156" height="53" alt="" /></a>
	</div>
	<div id="NSX-Powertrain-Top-View-15_">
		<img id="NSX_Powertrain_Top_View_15" src="../images/NSX-Powertrain-Top-View_15.gif" width="162" height="11" alt="" />
	</div>
	<div id="NSX-Powertrain-Top-View-16_">
		<img id="NSX_Powertrain_Top_View_16" src="../images/NSX-Powertrain-Top-View_16.gif" width="156" height="11" alt="" />
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>