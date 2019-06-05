<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

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
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);

$select_tire = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='1'") or die (mysql_error());
$row_tire = mysql_fetch_array($select_tire);

$select_tire2 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='2'") or die (mysql_error());
$row_tire2 = mysql_fetch_array($select_tire2);

$select_tire3 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='3'") or die (mysql_error());
$row_tire3 = mysql_fetch_array($select_tire3);

$select_tire4 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='4'") or die (mysql_error());
$row_tire4 = mysql_fetch_array($select_tire4);

$select_tire11 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='11'") or die (mysql_error());
$row_tire11 = mysql_fetch_array($select_tire11);
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
	left:0px;
	top:0px;
	width:100%;
	height:100%;
}

div.id4-01 {
	background-image:url(../tire/4/images/4_01.gif);
	position:absolute;
	left:0px;
	top:0px;
	width:892px;
	height:57px;
}

div.id4-02 {
	position:absolute;
	left:0px;
	top:57px;
	width:631px;
	height:24px;
}

div.id4-03 {
	position:absolute;
	left:631px;
	top:57px;
	width:172px;
	height:85px;
}

div.id4-04 {
	position:absolute;
	left:803px;
	top:57px;
	width:89px;
	height:381px;
}

div.id4-05 {
	position:absolute;
	left:0px;
	top:81px;
	width:201px;
	height:47px;
}

div.id4-06 {
	position:absolute;
	left:201px;
	top:81px;
	width:183px;
	height:85px;
}

div.id4-07 {
	position:absolute;
	left:384px;
	top:81px;
	width:247px;
	height:357px;
}

div.id4-08 {
	position:absolute;
	left:0px;
	top:128px;
	width:23px;
	height:310px;
}

div.id4-09 {
	position:absolute;
	left:23px;
	top:128px;
	width:178px;
	height:188px;
}

div.id4-10 {
	position:absolute;
	left:631px;
	top:142px;
	width:172px;
	height:163px;
}

div.id4-11 {
	position:absolute;
	left:201px;
	top:166px;
	width:183px;
	height:104px;
}

div.id4-12 {
	position:absolute;
	left:201px;
	top:270px;
	width:172px;
	height:85px;
}

div.id4-13 {
	position:absolute;
	left:373px;
	top:270px;
	width:11px;
	height:168px;
}

div.id4-14 {
	position:absolute;
	left:631px;
	top:305px;
	width:172px;
	height:82px;
}

div.id4-15 {
	position:absolute;
	left:23px;
	top:316px;
	width:178px;
	height:122px;
}

div.id4-16 {
	position:absolute;
	left:201px;
	top:355px;
	width:172px;
	height:83px;
}

div.id4-17 {
	position:absolute;
	left:631px;
	top:387px;
	width:172px;
	height:51px;
}

-->
</style>

<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">
<!-- Save for Web Slices (volvo-fm-rigid-chassis-top-view.jpg) -->
<div class="Table_01">

	<div class="id4-01"><br /><button onClick="window.open('print_tire4.php?id=<?php echo $rplate['id'];?>','print_tire4.php?id=<?php echo $rplate['id'];?>','width=700,height=650');"><font size="-1">Print Tire Record</font></button></div>
	<div class="id4-02">
		<img src="../tire/4/images/4_02.gif" width="631" height="24" alt="">
	</div>
	<div class="id4-03">
   
		<a rel="facebox" href="maintenance_tireadd.php?p=<?php echo $rplate['id'];?>">
        <?php 
		
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='1' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='1' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/4/images/4_03.png" width="172" height="85" alt="">
		  <?php 
		}	else if(mysql_num_rows($selects) > 0){
			  if($rows['swapto'] == '1'){?>
        <img src="../tire/4/images/4_03.png" width="172" height="85" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/4/images/22.png" width="172" height="85" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/4/images/33.png" width="172" height="85" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/4/images/44.png" width="172" height="85" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/4/images/4_03.png" width="172" height="85" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/4/images/22.png" width="172" height="85" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/4/images/33.png" width="172" height="85" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/4/images/44.png" width="172" height="85" alt="">
       <?php }}
	    else{?>
		   <img src="../tire/4/images/4_03.gif" width="172" height="85" alt=""><?php } 
	   ?>
        </a>
	</div>
	<div class="id4-04">
		<img src="../tire/4/images/4_04.gif" width="89" height="381" alt="">
	</div>
	<div class="id4-05">
		<img src="../tire/4/images/4_05.gif" width="201" height="47" alt="">
	</div>
	<div class="id4-06">
		<a rel="facebox" href="maintenance_tireadd3.php?p=<?php echo $rplate['id'];?>"> 
		 <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='3' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='3' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='3' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/4/images/4_06.png" width="183" height="85" alt="">
		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
        <img src="../tire/4/images/31.png" width="183" height="85" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/4/images/32.png" width="183" height="85" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/4/images/4_06.png" width="183" height="85" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/4/images/34.png" width="183" height="85" alt="">
       <?php }}
	   else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/4/images/31.png" width="183" height="85" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/4/images/32.png" width="183" height="85" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/4/images/4_06.png" width="183" height="85" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/4/images/34.png" width="183" height="85" alt="">
       <?php }}
	   else {?>
		   <img src="../tire/4/images/4_06.gif" width="183" height="85" alt=""><?php } 
	   ?>
        </a>
	</div>
	<div class="id4-07">
		<img src="../tire/4/images/4_07.gif" width="247" height="357" alt="">
	</div>
	<div class="id4-08">
		<img src="../tire/4/images/4_08.gif" width="23" height="310" alt="">
	</div>
	<div class="id4-09">
		<a rel="facebox" href="maintenance_tireadd11.php?p=<?php echo $rplate['id'];?>"><?php if(!empty($row_tire11['tireid'])){?> 
        <img src="../tire/4/images/4_09.jpg" width="178" height="188" alt=""><?php }else{?> <img src="../tire/4/images/4_09.gif" width="178" height="188" alt=""><?php }?></a>
	</div>
	<div class="id4-10">
		<img src="../tire/4/images/4_10.gif" width="172" height="163" alt="">
	</div>
	<div class="id4-11">
		<img src="../tire/4/images/4_11.gif" width="183" height="104" alt="">
	</div>
	<div class="id4-12">
		<a rel="facebox" href="maintenance_tireadd4.php?p=<?php echo $rplate['id'];?>">
      <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='4' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='4' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='4' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/4/images/4_12.png" width="183" height="85" alt="">
		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
        <img src="../tire/4/images/41.png" width="183" height="85" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/4/images/42.png" width="183" height="85" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/4/images/43.png" width="183" height="85" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/4/images/4_12.png" width="183" height="85" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/4/images/41.png" width="183" height="85" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/4/images/42.png" width="183" height="85" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/4/images/43.png" width="183" height="85" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/4/images/4_12.png" width="183" height="85" alt="">
       <?php }}
	    else {?>
		   <img src="../tire/4/images/4_12.gif" width="183" height="85" alt=""><?php } 
	   ?>  </a>
	</div>
	<div class="id4-13">
		<img src="../tire/4/images/4_13.gif" width="11" height="168" alt="">
	</div>
	<div class="id4-14">
		<a rel="facebox" href="maintenance_tireadd2.php?p=<?php echo $rplate['id'];?>">
              <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
						$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='2' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		 $rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/4/images/2.png" width="172" height="85" alt="">
		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			if($rows['swapto'] == '1'){?>
        <img src="../tire/4/images/111.png" width="172" height="85" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/4/images/2.png" width="172" height="85" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/4/images/333.png" width="172" height="85" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/4/images/444.png" width="172" height="85" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/4/images/111.png" width="172" height="85" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/4/images/2.png" width="172" height="85" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/4/images/333.png" width="172" height="85" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/4/images/444.png" width="172" height="85" alt="">
       <?php }}
	   else{?>
		   <img src="../tire/4/images/2.gif" width="172" height="85" alt=""><?php } 
	   ?>
        </a>
	</div>
	<div class="id4-15">
		<img src="../tire/4/images/4_15.gif" width="178" height="122" alt="">
	</div>
	<div class="id4-16">
		<img src="../tire/4/images/4_16.gif" width="172" height="83" alt="">
	</div>
	<div class="id4-17">
		<img src="../tire/4/images/4_17.gif" width="172" height="51" alt="">
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>
	
</center>