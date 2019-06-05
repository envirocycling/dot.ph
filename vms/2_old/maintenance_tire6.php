<?php


?>
<title>EFI Vehicles Report</title>
  <link href="../css/tables.css" media="screen" rel="stylesheet" type="text/css" />
<?php //facebox==========================================================================?>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<link href="../css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
<?php //=====================================================?>

  <?php 
include('connect.php');
$plate = $_GET['id'];
$select_plate = mysql_query("SELECT * from tbl_truck_report WHERE truckplate LIKE '%$plate%'") or die (mysql_error());
$row_plate = mysql_fetch_array($select_plate);
$truck_id = $row_plate['id'];

$select_1 = mysql_query("SELECT * from tbl_trucktires WHERE tireid='1' and truckplate='$truck_id' ") or die (mysql_error());
$row_1 = mysql_fetch_array($select_1);

?>
<title>EFI Vehicles Report</title>

</table>

<center>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Save for Web Styles (volvo-fm-rigid-chassis-top-view.jpg) -->
<style type="text/css">
<!--

div.Table_01 {
	position:absolute;
	left:9%	;
	top:0px;
	width:90%;
	height:100%;
}

div.id6-01 {
	background-image:url(../tire/6/images/6_01.gif)
	position:absolute;
	left:0px;
	top:0px;
	width:892px;
	height:43px;
}

div.id6-02 {
	position:absolute;
	left:0px;
	top:43px;
	width:184px;
	height:87px;
}

div.id6-03 {
	position:absolute;
	left:184px;
	top:43px;
	width:206px;
	height:78px;
}

div.id6-04 {
	position:absolute;
	left:390px;
	top:43px;
	width:502px;
	height:27px;
}

div.id6-05 {
	position:absolute;
	left:390px;
	top:70px;
	width:234px;
	height:368px;
}

div.id6-06 {
	position:absolute;
	left:624px;
	top:70px;
	width:174px;
	height:80px;
}

div.id6-07 {
	position:absolute;
	left:798px;
	top:70px;
	width:94px;
	height:368px;
}

div.id6-08 {
	position:absolute;
	left:184px;
	top:121px;
	width:186px;
	height:63px;
}

div.id6-09 {
	position:absolute;
	left:370px;
	top:121px;
	width:20px;
	height:317px;
}

div.id6-10 {
	position:absolute;
	left:0px;
	top:130px;
	width:14px;
	height:308px;
}

div.id6-11 {
	position:absolute;
	left:14px;
	top:130px;
	width:170px;
	height:183px;
}

div.id6-12 {
	position:absolute;
	left:624px;
	top:150px;
	width:174px;
	height:124px;
}

div.id6-13 {
	position:absolute;
	left:184px;
	top:184px;
	width:186px;
	height:64px;
}

div.id6-14 {
	position:absolute;
	left:184px;
	top:248px;
	width:12px;
	height:190px;
}

div.id6-15 {
	position:absolute;
	left:196px;
	top:248px;
	width:174px;
	height:65px;
}

div.id6-16 {
	position:absolute;
	left:624px;
	top:274px;
	width:174px;
	height:89px;
}

div.id6-17 {
	position:absolute;
	left:14px;
	top:313px;
	width:170px;
	height:125px;
}

div.id6-18 {
	position:absolute;
	left:196px;
	top:313px;
	width:164px;
	height:80px;
}

div.id6-19 {
	position:absolute;
	left:360px;
	top:313px;
	width:10px;
	height:125px;
}

div.id6-20 {
	position:absolute;
	left:624px;
	top:363px;
	width:174px;
	height:75px;
}

div.id6-21 {
	position:absolute;
	left:196px;
	top:393px;
	width:164px;
	height:45px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">
<!-- Save for Web Slices (volvo-fm-rigid-chassis-top-view.jpg) -->
<div class="Table_01">
	<div class="id6-01"><br />
<button onClick="window.open('print_tire6.php?id=<?php echo $truck_id;?>','print_tire6.php?id=<?php echo $truck_id;?>','width=700,height=650');"><font size="-1">View Tire Monitoring Record</font></button></div>
	<div class="id6-02">
		<img src="../tire/6/images/6_02.gif" width="184" height="87" alt="">
	</div>
	<div class="id6-03">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=3&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
	<img src="../tire/6/images/6_03.png" width="174" height="79" alt=""></a>
	  <?php //////////////////////////////// ?>
	</div>
	<div class="id6-04">
		<img src="../tire/6/images/6_04.gif" width="502" height="27" alt="">
	</div>
	<div class="id6-05">
		<img src="../tire/6/images/6_05.gif" width="234" height="368" alt="">
	</div>
	<div class="id6-06">
	
		  <a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=1&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');"> <img src="../tire/6/images/6_06.png" width="174" height="80" alt=""></a><?php ///////////////////////////////////////?>

	</div>
	<div class="id6-07">
		<img src="../tire/6/images/6_07.gif" width="94" height="368" alt="">
	</div>
	<div class="id6-08">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=4&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		      <img src="../tire/6/images/6_08.png"  width="186" height="63" alt=""></a><?php  //////////////////////////////////// ?>
	</div>
	<div class="id6-09">
		<img src="../tire/6/images/6_09.gif" width="20" height="317" alt="">
	</div>
	<div class="id6-10">
		<img src="../tire/6/images/6_10.gif" width="14" height="308" alt="">
	</div>
	<div class="id6-11">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=11&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img src="../tire/6/images/6_11.png" width="170" height="183" alt=""></a><?php //////////////////////////////////?>
	</div>
	<div class="id6-12">
		<img src="../tire/6/images/6_12.gif" width="174" height="124" alt="">
	</div>
	<div class="id6-13">
		<img src="../tire/6/images/6_13.gif" width="186" height="64" alt="">
	</div>
	<div class="id6-14">
		<img src="../tire/6/images/6_14.gif" width="12" height="190" alt="">
	</div>
	<div class="id6-15">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=5&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		      <img src="../tire/6/images/6_15.png"   width="174" height="65" alt=""></a><?php //////////////////////////////////////?>
	</div>
	<div class="id6-16">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=2&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');"><img src="../tire/6/images/6_16.png" width="174" height="89" alt=""></a>
	  <?php //////////////////////////////////////// ?>
	</div>
	<div class="id6-17">
		<img src="../tire/6/images/6_17.gif" width="170" height="125" alt="">
	</div>
	<div class="id6-18">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=6&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		   <img src="../tire/6/images/6_18.png"  width="164" height="80" alt=""></a><?php  //////////////////////////////?>
	</div>
	<div class="id6-19">
		<img src="../tire/6/images/6_19.gif" width="10" height="125" alt="">
	</div>
	<div class="id6-20">
		<img src="../tire/6/images/6_20.gif" width="174" height="75" alt="">
	</div>
	<div class="id6-21">
		<img src="../tire/6/images/6_21.gif" width="164" height="45" alt="">
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>
	
</center>