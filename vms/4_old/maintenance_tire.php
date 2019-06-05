<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
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

$select_tire5= mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='5'") or die (mysql_error());
$row_tire5 = mysql_fetch_array($select_tire5);

$select_tire6 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='6'") or die (mysql_error());
$row_tire6 = mysql_fetch_array($select_tire6);

$select_tire7 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='7'") or die (mysql_error());
$row_tire7 = mysql_fetch_array($select_tire7);

$select_tire8 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='8'") or die (mysql_error());
$row_tire8 = mysql_fetch_array($select_tire8);

$select_tire9 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='9'") or die (mysql_error());
$row_tire9 = mysql_fetch_array($select_tire9);

$select_tire10 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='10'") or die (mysql_error());
$row_tire10 = mysql_fetch_array($select_tire10);

$select_tire11 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='11'") or die (mysql_error());
$row_tire11 = mysql_fetch_array($select_tire11);
?>
<title>EFI Vehicles Report</title>

</table>

<center>
<html>
<head>
<title>volvo-fm-rigid-chassis-top-view</title>
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
		<a rel="facebox" href="maintenance_tireadd7.php?p=<?php echo $rplate['id'];?>"><?php
		$select_tbl = mysql_query("Select * from tbl_changeswaps order by id Desc LIMIT 1")or die (mysql_error());
		$row_tbl = mysql_fetch_array($select_tbl);
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='7' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='7' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='7' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
	  <img src="../tire/8/images/8_03.png" width="128" height="53" alt="">
		<?php 
		} 
		else if(mysql_num_rows($selects) > 0){
			if($rows['swapto'] == '1'){?>
     		 <img src="../tire/8/images/71.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/72.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		   <img src="../tire/8/images/73.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/8/images/74.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/8/images/75.gif" width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/8/images/76.gif" width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
         <img src="../tire/8/images/8_03.png" width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
          <img src="../tire/8/images/78.gif"  width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
          <img src="../tire/8/images/79.gif"  width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
          <img src="../tire/8/images/710.gif"  width="128" height="53" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/71.gif" width="128" height="53" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/72.gif"  width="128" height="53" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/73.gif"  width="128" height="53" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/8/images/74.gif"  width="128" height="53" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/8/images/75.gif"  width="128" height="53" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
          <img src="../tire/8/images/76.gif"  width="128" height="53" alt="">
        <?php }else if($rows['swapto'] == '7'){?>
        <img src="../tire/8/images/8_03.png" width="128" height="53" alt="">
         <?php }else if($rows['tireid'] == '8'){?>
          <img src="../tire/8/images/78.gif" width="128" height="53" alt="">
         <?php }else if($rows['tireid'] == '9'){?>
          <img src="../tire/8/images/79.gif"  width="128" height="53" alt="">
          <?php }else if($rows['tireid'] == '10'){?>
          <img src="../tire/8/images/710.gif" width="128" height="53" alt="">
       <?php }
	   
	   } else {?>
		  <img src="../tire/8/images/8_03.gif" width="128" height="53" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id8-04">
		<a rel="facebox" href="maintenance_tireadd3.php?p=<?php echo $rplate['id'];?>"><?php

		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='3' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='3' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='3' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		<img src="../tire/8/images/8_04.png" width="125" height="53" alt="">
		<?php 
		} 
		else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/31.gif" width="125" height="53" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/32.gif" width="125" height="53" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
		<img src="../tire/8/images/8_04.png"  width="125" height="53" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/8/images/34.gif" width="125" height="53" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
        <img src="../tire/8/images/35.gif" width="125" height="53" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
        <img src="../tire/8/images/36.gif" width="125" height="53" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
        <img src="../tire/8/images/37.gif" width="125" height="53" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
        <img src="../tire/8/images/38.gif" width="125" height="53" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
        <img src="../tire/8/images/39.gif" width="125" height="53" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
        <img src="../tire/8/images/310.gif"  width="125" height="53" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/31.gif"  width="125" height="53" alt="">
       <?php }else if($row['tireid'] == '2'){?>
      <img src="../tire/8/images/8_04.png" width="125" height="53" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
	    <img src="../tire/8/images/8_04.png" width="125" height="53" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
        <img src="../tire/8/images/34.gif" width="125" height="53" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
        <img src="../tire/8/images/35.gif" width="125" height="53" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
        <img src="../tire/8/images/36.gif"  width="125" height="53" alt="">
                           <?php }else if($rows['swapto'] == '7'){?>
        <img src="../tire/8/images/37.gif"  width="125" height="53" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
        <img src="../tire/8/images/38.gif"  width="125" height="53" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
        <img src="../tire/8/images/39.gif"  width="125" height="53" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
        <img src="../tire/8/images/310.gif"  width="125" height="53" alt="">
      <?php }
	  } else {?>
		  <img src="../tire/8/images/8_04.gif" width="125" height="53" alt=""><?php } 
	  ?></a>
	</div>
	<div class="id8-05">
		<img src="../tire/8/images/8_05.gif" width="282" height="339" alt="">
	</div>
	<div class="id8-06">
		<a rel="facebox" href="maintenance_tireadd.php?p=<?php echo $rplate['id'];?>">
		 <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='1' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/8/images/8_06.png"  width="123" height="44" alt="">
		  <?php }
		else if(mysql_num_rows($selects) > 0){
				if($rows['swapto'] == '1'){?>
 <img src="../tire/8/images/8_06.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
   <img src="../tire/8/images/12.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
       <img src="../tire/8/images/13.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/8/images/14.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
        <img src="../tire/8/images/15.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
         <img src="../tire/8/images/16.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '7'){?>
         <img src="../tire/8/images/17.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '8'){?>
         <img src="../tire/8/images/18.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '9'){?>
         <img src="../tire/8/images/19.gif"  width="123" height="44" alt="">
       <?php }else if($rows['swapto'] == '10'){?>
         <img src="../tire/8/images/110gif"  width="123" height="44" alt="">
       <?php }}
			else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
   <img src="../tire/8/images/8_06.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/12.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '3'){?>
       <img src="../tire/8/images/13.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/8/images/14.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '5'){?>
           <img src="../tire/8/images/15.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '6'){?>
         <img src="../tire/8/images/16.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid']== '7'){?>
         <img src="../tire/8/images/17.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '8'){?>
         <img src="../tire/8/images/18.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '9'){?>
         <img src="../tire/8/images/19.gif"  width="123" height="44" alt="">
       <?php }else if($row['tireid'] == '10'){?>
         <img src="../tire/8/images/110.gif"  width="123" height="44" alt="">
       <?php }
	   } else{?>
		         <img src="../tire/8/images/8_06.gif"  width="123" height="44" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id8-07">
		<img src="../tire/8/images/8_07.gif" width="89" height="339" alt="">
	</div>
	<div class="id8-08">
		<img src="../tire/8/images/8_08.gif" width="123" height="134" alt="">
	</div>
	<div class="id8-09">
		<a rel="facebox" href="maintenance_tireadd8.php?p=<?php echo $rplate['id'];?>"><?php
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='8' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='8' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='8' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);

		$rows = mysql_fetch_array($selects);
				if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		<img src="../tire/8/images/8_09.png" width="128" height="53" alt="">
		<?php 
		} 
		else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/81.gif" width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/82.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		   <img src="../tire/8/images/83.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/8/images/84.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/8/images/85.gif"  width="128" height="53" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/8/images/86.gif" width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/87.gif" width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
         <img src="../tire/8/images/8_09.png" width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
          <img src="../tire/8/images/89.gif" width="128" height="53" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
          <img src="../tire/8/images/810.gif" width="128" height="53" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/81.gif" width="128" height="53" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/82.gif" width="128" height="53" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/83.gif"  width="128" height="53" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/8/images/84.gif" width="128" height="53" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/8/images/85.gif"  width="128" height="53" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
          <img src="../tire/8/images/86.gif" width="128" height="53" alt="">
                           <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/87.gif" width="128" height="53" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
         <img src="../tire/8/images/8_09.png"  width="128" height="53" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
          <img src="../tire/8/images/89.gif" width="128" height="53" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
          <img src="../tire/8/images/810.gif" width="128" height="53" alt="">
       <?php }}
	  else {?>
		<img src="../tire/8/images/8_09.gif" width="128" height="53" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id8-10">
		<a rel="facebox" href="maintenance_tireadd4.php?p=<?php echo $rplate['id'];?>"><?php
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='4' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='4' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='4' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		<img src="../tire/8/images/8_10.png" width="125" height="47" alt="">
		<?php }
			else if(mysql_num_rows($selects) > 0){
				 if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/41.gif"  width="125" height="47" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/42.gif"  width="125" height="47" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
	    <img src="../tire/8/images/43.gif"  width="125" height="47" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/8/images/8_10.png"  width="125" height="47" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/8/images/45.gif" width="125" height="47" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/8/images/46.gif"  width="125" height="47" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/47.gif" width="125" height="47" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
          <img src="../tire/8/images/48.gif"  width="125" height="47" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
          <img src="../tire/8/images/49.gif"  width="125" height="47" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
          <img src="../tire/8/images/410.gif"  width="125" height="47" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/41.gif" width="125" height="47" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/42.gif"  width="125" height="47" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/43.gif" width="125" height="47" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
        <img src="../tire/8/images/8_10.png"  width="125" height="47" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
        <img src="../tire/8/images/45.gif"  width="125" height="47" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
        <img src="../tire/8/images/46.gif"  width="125" height="47" alt="">
                           <?php }else if($rows['swapto'] == '7'){?>
        <img src="../tire/8/images/47.gif"  width="125" height="47" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
        <img src="../tire/8/images/48.gif"  width="125" height="47" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
        <img src="../tire/8/images/49.gif"  width="125" height="47" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
        <img src="../tire/8/images/410.gif"  width="125" height="47" alt="">
      <?php }
	  } else{?>
	    <img src="../tire/8/images/8_10.gif" width="125" height="47" alt=""><?php } 
	  ?></a>
	</div>
	<div class="id8-11">
		<img src="../tire/8/images/8_11.gif" width="33" height="277" alt="">
	</div>
	<div class="id8-12">
		<a rel="facebox" href="maintenance_tireadd11.php?p=<?php echo $rplate['id'];?>"> <?php if(!empty($row_tire11['id'])){?><img src="../tire/8/images/8_12.png" width="112" height="123" alt=""><?php }else{?><img src="../tire/8/images/8_12.gif" width="112" height="123" alt=""><?php }?></a>
	</div>
	<div class="id8-13">
		<img src="../tire/8/images/8_13.gif" width="7" height="85" alt="">
	</div>
	<div class="id8-14">
		<img src="../tire/8/images/8_14.gif" width="246" height="48" alt="">
	</div>
	<div class="id8-15">
		<a rel="facebox" href="maintenance_tireadd9.php?p=<?php echo $rplate['id'];?>"> <?php
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='9' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='9' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='9' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		<img src="../tire/8/images/8_15.png" width="121" height="43" alt="">
		<?php 
		}	
		else if(mysql_num_rows($selects) > 0){
			  if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/91.gif"  width="121" height="43" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/92.gif" width="121" height="43" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		   <img src="../tire/8/images/93.gif" width="121" height="43" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/8/images/94.gif"  width="121" height="43" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/8/images/95.gif" width="121" height="43" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/8/images/96.gif" width="121" height="43" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/97.gif" width="121" height="43" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
          <img src="../tire/8/images/98.gif"  width="121" height="43" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
         <img src="../tire/8/images/8_15.png"  width="121" height="43" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
          <img src="../tire/8/images/910.gif" width="121" height="43" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/91.gif" width="121" height="43" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/92.gif" width="121" height="43" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/93.gif"  width="121" height="43" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/8/images/94.gif" width="121" height="43" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/8/images/95.gif" width="121" height="43" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
          <img src="../tire/8/images/96.gif"  width="121" height="43" alt="">
                           <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/97.gif"  width="121" height="43" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
          <img src="../tire/8/images/98.gif"  width="121" height="43" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
             <img src="../tire/8/images/8_15.png"  width="121" height="43" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
          <img src="../tire/8/images/910.gif"  width="121" height="43" alt="">
       <?php }}
	    else {?>
		  <img src="../tire/8/images/8_15.gif" width="121" height="43" alt=""><?php } 

	   ?></a>
	</div>
	<div class="id8-16">
		<img src="../tire/8/images/8_16.gif" width="6" height="43" alt="">
	</div>
	<div class="id8-17">
		<a rel="facebox" href="maintenance_tireadd5.php?p=<?php echo $rplate['id'];?>">
      <?php
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='5' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='5' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='5' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		 <img src="../tire/8/images/8_17.png" width="111" height="37" alt="">
		<?php 
		}
			else if(mysql_num_rows($selects) > 0){
				if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/51.gif" width="111" height="37" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/52.gif" width="111" height="37" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
	    <img src="../tire/8/images/53.gif" width="111" height="37" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/8/images/54.gif" width="111" height="37" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
        <img src="../tire/8/images/8_17.png"  width="111" height="37" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/8/images/56.gif"  width="111" height="37" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/57.gif" width="111" height="37" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
          <img src="../tire/8/images/58.gif"  width="111" height="37" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
          <img src="../tire/8/images/59.gif" width="111" height="37" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
          <img src="../tire/8/images/510.gif" width="111" height="37" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/51.gif" width="111" height="37" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/52.gif"  width="111" height="37" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/53.gif"  width="111" height="37" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/8/images/54.gif"  width="111" height="37" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
    <img src="../tire/8/images/8_17.png"  width="111" height="37" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
        <img src="../tire/8/images/56.gif"  width="111" height="37" alt="">
                           <?php }else if($rows['swapto'] == '7'){?>
        <img src="../tire/8/images/57.gif" width="111" height="37" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
        <img src="../tire/8/images/58.gif" width="111" height="37" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
        <img src="../tire/8/images/59.gif"  width="111" height="37" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
        <img src="../tire/8/images/510.gif"  width="111" height="37" alt="">
      <?php }}
	   else {?>
	    <img src="../tire/8/images/8_17.gif" width="111" height="37" alt=""><?php } 
	  ?></a>
	</div>
	<div class="id8-18">
		<img src="../tire/8/images/8_18.gif" width="8" height="191" alt="">
	</div>
	<div class="id8-19">
		<a rel="facebox" href="maintenance_tireadd2.php?p=<?php echo $rplate['id'];?>">
          <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='2' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/8/images/8_19.png"  width="123" height="53" alt="">
		  <?php 
		}
		else if(mysql_num_rows($selects) > 0){
			if($rows['swapto'] == '1'){?>
    <img src="../tire/8/images/21.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
    <img src="../tire/8/images/8_19.png"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
    <img src="../tire/8/images/23.gif"  width="123" height="53" alt="">
           <?php }else if($rows['swapto'] == '4'){?>
             <img src="../tire/8/images/24.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
           <img src="../tire/8/images/25.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
           <img src="../tire/8/images/26.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '7'){?>
            <img src="../tire/8/images/27.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '8'){?>
            <img src="../tire/8/images/28.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '9'){?>
            <img src="../tire/8/images/29.gif"  width="123" height="53" alt="">
       <?php }else if($rows['swapto'] == '10'){?>
             <img src="../tire/8/images/210.gif"  width="123" height="53" alt="">
       <?php }}
	  		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
      <img src="../tire/8/images/21.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '2'){?>
         <img src="../tire/8/images/8_19.png"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '3'){?>
       <img src="../tire/8/images/23.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '4'){?>
       <img src="../tire/8/images/24.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '5'){?>
           <img src="../tire/8/images/25.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '6'){?>
              <img src="../tire/8/images/26.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid']== '7'){?>
    <img src="../tire/8/images/27.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '8'){?>
         <img src="../tire/8/images/28.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '9'){?>
       <img src="../tire/8/images/29.gif"  width="123" height="53" alt="">
       <?php }else if($row['tireid'] == '10'){?>
          <img src="../tire/8/images/210.gif"  width="123" height="53" alt="">
       <?php }}
	    else {?>
		         <img src="../tire/8/images/8_19.gif"  width="123" height="53" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id8-20">
		<img src="../tire/8/images/8_20.gif" width="119" height="154" alt="">
	</div>
	<div class="id8-21">
		<img src="../tire/8/images/8_21.gif" width="111" height="6" alt="">
	</div>
	<div class="id8-22">
		<a rel="facebox" href="maintenance_tireadd10.php?p=<?php echo $rplate['id'];?>">
<?php
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='10' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='10' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='10' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		<img src="../tire/8/images/8_22.png" width="121" height="55" alt="">
		<?php 
		} 
		else if(mysql_num_rows($selects) > 0){
		 if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/101.gif" width="121" height="55" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/102.gif"  width="121" height="55" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		   <img src="../tire/8/images/103.gif" width="121" height="55" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/8/images/104.gif"  width="121" height="55" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/8/images/105.gif"  width="121" height="55" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/8/images/106.gif" width="121" height="55" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/107.gif"  width="121" height="55" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
          <img src="../tire/8/images/108.gif" width="121" height="55" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
          <img src="../tire/8/images/109.gif" width="121" height="55" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
         <img src="../tire/8/images/8_22.png" width="121" height="55" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/101.gif" width="121" height="55" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/102.gif" width="121" height="55" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/103.gif" width="121" height="55" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/8/images/104.gif" width="121" height="55" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/8/images/105.gif" width="121" height="55" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
          <img src="../tire/8/images/106.gif"  width="121" height="55" alt="">
                           <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/107.gif"  width="121" height="55" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
          <img src="../tire/8/images/108.gif" width="121" height="55" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
          <img src="../tire/8/images/109.gif"  width="121" height="55" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
          <img src="../tire/8/images/8_22.png" width="121" height="55" alt="">
       <?php }}
	   else {?>
		 <img src="../tire/8/images/8_22.gif" width="121" height="55" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id8-23">
		<a rel="facebox" href="maintenance_tireadd6.php?p=<?php echo $rplate['id'];?>"><?php
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='6' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='6' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='6' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
				if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		<img src="../tire/8/images/8_23.png" width="117" height="48" alt="">
		<?php 
		}else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
      <img src="../tire/8/images/61.gif"width="117" height="48" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     <img src="../tire/8/images/62.gif" width="117" height="48" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		   <img src="../tire/8/images/63.gif" width="117" height="48" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/8/images/64.gif"  width="117" height="48" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/8/images/65.gif"  width="117" height="48" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
      <img src="../tire/8/images/8_23.png"  width="117" height="48" alt="">
                 <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/67.gif"  width="117" height="48" alt="">
                 <?php }else if($rows['swapto'] == '8'){?>
          <img src="../tire/8/images/68.gif"  width="117" height="48" alt="">
                 <?php }else if($rows['swapto'] == '9'){?>
          <img src="../tire/8/images/69.gif" width="117" height="48" alt="">
                 <?php }else if($rows['swapto'] == '10'){?>
          <img src="../tire/8/images/610.gif"  width="117" height="48" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
       <img src="../tire/8/images/61.gif"  width="117" height="48" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/8/images/62.gif"  width="117" height="48" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/8/images/63.gif"  width="117" height="48" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/8/images/64.gif"  width="117" height="48" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/8/images/65.gif"  width="117" height="48" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
         <img src="../tire/8/images/8_23.png"  width="117" height="48" alt="">
             <?php }else if($rows['swapto'] == '7'){?>
          <img src="../tire/8/images/67.gif"  width="117" height="48" alt="">
                 <?php }else if($rows['tireid'] == '8'){?>
          <img src="../tire/8/images/68.gif" width="117" height="48" alt="">
                 <?php }else if($rows['tireid'] == '9'){?>
          <img src="../tire/8/images/69.gif"  width="117" height="48" alt="">
                 <?php }else if($rows['tireid'] == '10'){?>
          <img src="../tire/8/images/610.gif"  width="117" height="48" alt="">
       <?php }}
	    else {?>
		  <img src="../tire/8/images/8_23.gif" width="117" height="48" alt=""><?php } 
	   ?></a>
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
<button onClick="window.open('print_tire10.php?id=<?php echo $rplate['id'];?>','print_tire10.php?id=<?php echo $rplate['id'];?>','width=700,height=650');"><font size="-1">Print Tire Record</font></button>
</body>
</html>
	
</center>