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

div.id8-01 {
	position:absolute;
	left:0px;
	top:0px;
	background-image:url(../tire/8/images/8_01.gif);
	width:892px;
	height:99px;
}

div.id8-02 {
	position:absolute;
	left:0px;
	top:99px;
	width:145px;
	height:62px;
}

div.id8-03 {
	position:absolute;
	left:145px;
	top:99px;
	width:128px;
	height:53px;
}

div.id8-04 {
	position:absolute;
	left:273px;
	top:99px;
	width:125px;
	height:53px;
}

div.id8-05 {
	position:absolute;
	left:398px;
	top:99px;
	width:282px;
	height:339px;
}

div.id8-06 {
	position:absolute;
	left:680px;
	top:99px;
	width:123px;
	height:44px;
}

div.id8-07 {
	position:absolute;
	left:803px;
	top:99px;
	width:89px;
	height:339px;
}

div.id8-08 {
	position:absolute;
	left:680px;
	top:143px;
	width:123px;
	height:134px;
}

div.id8-09 {
	position:absolute;
	left:145px;
	top:152px;
	width:128px;
	height:47px;
}

div.id8-10 {
	position:absolute;
	left:273px;
	top:152px;
	width:125px;
	height:47px;
}

div.id8-11 {
	position:absolute;
	left:0px;
	top:161px;
	width:33px;
	height:277px;
}

div.id8-12 {
	position:absolute;
	left:33px;
	top:161px;
	width:112px;
	height:123px;
}

div.id8-13 {
	position:absolute;
	left:145px;
	top:199px;
	width:7px;
	height:85px;
}

div.id8-14 {
	position:absolute;
	left:152px;
	top:199px;
	width:246px;
	height:48px;
}

div.id8-15 {
	position:absolute;
	left:152px;
	top:247px;
	width:121px;
	height:43px;
}

div.id8-16 {
	position:absolute;
	left:273px;
	top:247px;
	width:6px;
	height:43px;
}

div.id8-17 {
	position:absolute;
	left:279px;
	top:247px;
	width:111px;
	height:37px;
}

div.id8-18 {
	position:absolute;
	left:390px;
	top:247px;
	width:8px;
	height:191px;
}

div.id8-19 {
	position:absolute;
	left:680px;
	top:277px;
	width:123px;
	height:53px;
}

div.id8-20 {
	position:absolute;
	left:33px;
	top:284px;
	width:119px;
	height:154px;
}

div.id8-21 {
	position:absolute;
	left:279px;
	top:284px;
	width:111px;
	height:6px;
}

div.id8-22 {
	position:absolute;
	left:152px;
	top:290px;
	width:121px;
	height:55px;
}

div.id8-23 {
	position:absolute;
	left:273px;
	top:290px;
	width:117px;
	height:48px;
}

div.id8-24 {
	position:absolute;
	left:680px;
	top:330px;
	width:123px;
	height:108px;
}

div.id8-25 {
	position:absolute;
	left:273px;
	top:338px;
	width:117px;
	height:100px;
}

div.id8-26 {
	position:absolute;
	left:152px;
	top:345px;
	width:121px;
	height:93px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<body>
<!-- Save for Web Slices (volvo-fm-rigid-chassis-top-view.jpg) -->

<div class="Table_01">

	<div class="id8-01">


<table align="center" width="50%">

	</div>
	<div class="id8-02">
		<img src="../tire/8/images/8_02.gif" width="145" height="62" alt="">
	</div>
	<div class="id8-03">
<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=7&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
 <img src="../tire/8/images/8_03.png" width="128" height="53" alt=""></a><?php //////////////////////////////////////////////////////////?> 
	</div>
	<div class="id8-04">
		<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=3&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img src="../tire/8/images/8_04.png" width="125" height="53" alt=""></a><?php ////////////////////////////////////////?>
	</div>
	<div class="id8-05">
		<img src="../tire/8/images/8_05.gif" width="282" height="339" alt="">
	</div>
	<div class="id8-06">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=1&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');"><img src="../tire/8/images/11.gif"  width="123" height="44" alt=""></a>
	  <?php ////////////////////////?>
	</div>
	<div class="id8-07">
		<img src="../tire/8/images/8_07.gif" width="89" height="339" alt="">
	</div>
	<div class="id8-08">
		<img src="../tire/8/images/8_08.gif" width="123" height="134" alt="">
	</div>
	<div class="id8-09">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=8&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img src="../tire/8/images/8_09.png" width="128" height="53" alt=""></a><?php /////////////////////////?>
	</div>
	<div class="id8-10">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=4&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
	    <img src="../tire/8/images/8_10.png" width="125" height="47" alt=""></a><?php /////////////////////////////////////////?>
	</div>
	<div class="id8-11">
		<img src="../tire/8/images/8_11.gif" width="33" height="277" alt="">
	</div>
	<div class="id8-12">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=11&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		<img src="../tire/8/images/8_12.png" width="112" height="123" alt=""></a><?php /////////////////////////////////////?>
	</div>
	<div class="id8-13">
		<img src="../tire/8/images/8_13.gif" width="7" height="85" alt="">
	</div>
	<div class="id8-14">
		<img src="../tire/8/images/8_14.gif" width="246" height="48" alt="">
	</div>
	<div class="id8-15">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=9&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		  <img src="../tire/8/images/8_15.png" width="121" height="43" alt=""></a><?php ////////////////////////////////////?>
	</div>
	<div class="id8-16">
		<img src="../tire/8/images/8_16.gif" width="6" height="43" alt="">
	</div>
	<div class="id8-17">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=5&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
	    <img src="../tire/8/images/8_17.png" width="111" height="37" alt=""></a><?php ///////////////////////////////////////////?>
	</div>
	<div class="id8-18">
		<img src="../tire/8/images/8_18.gif" width="8" height="191" alt="">
	</div>
	<div class="id8-19">
		       <a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=2&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
			     <img src="../tire/8/images/8_19.png"  width="123" height="53" alt=""></a><?php ///////////////////////////////////?>
	</div>
	<div class="id8-20">
		<img src="../tire/8/images/8_20.gif" width="119" height="154" alt="">
	</div>
	<div class="id8-21">
		<img src="../tire/8/images/8_21.gif" width="111" height="6" alt="">
	</div>
	<div class="id8-22">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=10&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		 <img src="../tire/8/images/8_22.png" width="121" height="55" alt=""></a><?php //////////////////////////////////////////?>
	</div>
	<div class="id8-23">
	<a onClick="window.open('maintenance_tireadd.php?id=<?php echo $truck_id.'&tire=6&p='.$plate;?>','tire_1','width=370,height=370,top=100,left=500');">
		  <img src="../tire/8/images/8_23.png" width="117" height="48" alt=""></a><?php //////////////////////////////////////////?>
	</div>
	<div class="id8-24">
		<img src="../tire/8/images/8_24.gif" width="123" height="108" alt="">
	</div>
	<div class="id8-25">
		<img src="../tire/8/images/8_25.gif" width="117" height="100" alt="">
	</div>
  <div class="id8-26">
		<img src="../tire/8/images/8_26.gif" width="121" height="93" alt="">
  </div>
</div>

<br />
<button onClick="window.open('print_tire10.php?id=<?php echo $truck_id;?>','print','width=700,height=650');"><font size="-1">View Tire Monitoring Record</font></button>
</body>
</html>
	
</center>