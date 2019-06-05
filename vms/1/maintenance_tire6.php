<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

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
<button onClick="window.open('print_tire6.php?id=<?php echo $rplate['id'];?>','print_tire6.php?id=<?php echo $rplate['id'];?>','width=700,height=650');"><font size="-1">Print Tire Record</font></button></div>
	<div class="id6-02">
		<img src="../tire/6/images/6_02.gif" width="184" height="87" alt="">
	</div>
	<div class="id6-03">
		<a rel="facebox" href="maintenance_tireadd3.php?p=<?php echo $rplate['id'];?>">
 <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='3' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='3' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='3' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/4/images/4_06.png" width="174" height="79" alt="">
		  <?php 
		}
		else if(mysql_num_rows($selects) > 0){
		 if($rows['swapto'] == '1'){?>
        <img src="../tire/4/images/31.png" width="174" height="79" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/4/images/32.png" wwidth="174" height="79" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/4/images/4_06.png" width="174" height="79" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/4/images/34.png" width="174" height="79" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/4/images/31.png" width="174" height="79" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/4/images/32.png" width="174" height="79" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/4/images/4_06.png" width="174"height="79" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/4/images/34.png" width="174"height="79" alt="">
       <?php }}
	    else {?>
		   <img src="../tire/4/images/4_06.gif" width="174" height="79" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id6-04">
		<img src="../tire/6/images/6_04.gif" width="502" height="27" alt="">
	</div>
	<div class="id6-05">
		<img src="../tire/6/images/6_05.gif" width="234" height="368" alt="">
	</div>
	<div class="id6-06">
		<a rel="facebox" href="maintenance_tireadd.php?p=<?php echo $rplate['id'];?>">
          <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='1' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='1' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/6/images/6_06.png" width="174" height="80" alt="">
		  <?php 
		}	else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
        <img src="../tire/6/images/6_06.png" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/6/images/12.gif" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/6/images/13.gif" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
        <img src="../tire/6/images/14.gif" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
        <img src="../tire/6/images/15.gif" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
        <img src="../tire/6/images/16.gif" width="174" height="80" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/6/images/6_06.png" width="174" height="80" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/6/images/12.gif" width="174" height="80" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/6/images/13.gif" width="174" height="80" alt="">
       <?php }else if($row['tireid'] == '4'){?>
        <img src="../tire/6/images/14.gif" width="174" height="80" alt="">
       <?php }else if($row['tireid'] == '5'){?>
        <img src="../tire/6/images/15.gif" width="174" height="80" alt="">
       <?php }else if($row['tireid'] == '6'){?>
        <img src="../tire/6/images/16.gif" width="174" height="80" alt="">
       <?php }}
	    else{?>
		   <img src="../tire/6/images/6_06.gif" width="174" height="80" alt=""><?php } 
	   ?>
    
       </a>
	</div>
	<div class="id6-07">
		<img src="../tire/6/images/6_07.gif" width="94" height="368" alt="">
	</div>
	<div class="id6-08">
	<a rel="facebox" href="maintenance_tireadd4.php?p=<?php echo $rplate['id'];?>">	
 <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='4' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='4' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='4' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/6/images/6_08.png"  width="186" height="63" alt="">
		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			if($rows['swapto'] == '1'){?>
        <img src="../tire/6/images/41.gif" width="186" height="63" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/6/images/42.gif"  width="186" height="63" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/6/images/43.gif"  width="186" height="63" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/6/images/4_06.gif"  width="186" height="63" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
        <img src="../tire/6/images/45.gif"  width="186" height="63" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
        <img src="../tire/6/images/46.gif"  width="186" height="63" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/6/images/41.gif"  width="186" height="63" alt="">
       <?php }else if($row['tireid'] == '2'){?>
        <img src="../tire/6/images/42.gif" width="186" height="63" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/6/images/43.gif"  width="186" height="63" alt="">
       <?php }else if($row['tireid'] == '4'){?>
           <img src="../tire/6/images/4_06.gif"  width="186" height="63" alt="">
       <?php }else if($row['tireid'] == '5'){?>
        <img src="../tire/6/images/45.gif"  width="186" height="63" alt="">
       <?php }else if($row['tireid'] == '6'){?>
        <img src="../tire/6/images/46.gif"  width="186" height="63" alt="">
       <?php }}
	    else {?>
		      <img src="../tire/6/images/6_08.gif"  width="186" height="63" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id6-09">
		<img src="../tire/6/images/6_09.gif" width="20" height="317" alt="">
	</div>
	<div class="id6-10">
		<img src="../tire/6/images/6_10.gif" width="14" height="308" alt="">
	</div>
	<div class="id6-11">
		<a rel="facebox" href="maintenance_tireadd11.php?p=<?php echo $rplate['id'];?>">
        <?php if(!empty($row_tire11)){?><img src="../tire/6/images/6_11.png" width="170" height="183" alt=""><?php }else{?><img src="../tire/6/images/6_11.gif" width="170" height="183" alt=""><?php }?></a>
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
		<a rel="facebox" href="maintenance_tireadd5.php?p=<?php echo $rplate['id'];?>">
	<?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='5' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='5' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='5' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		      <img src="../tire/6/images/6_15.png"   width="174" height="65" alt="">		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			  if($rows['swapto'] == '1'){?>
        <img src="../tire/6/images/51.gif"  width="174" height="65" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
        <img src="../tire/6/images/52.gif"   width="174" height="65" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
        <img src="../tire/6/images/53.gif"   width="174" height="65" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/6/images/54.gif"   width="174" height="65" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/6/images/6_15.gif"   width="174" height="65" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/6/images/56.gif"   width="174" height="65" alt="">
       <?php }}
	else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/6/images/51.gif"  width="174" height="65" alt="">
       <?php }else if($row['tireid'] == '2'){?>
      <img src="../tire/6/images/52.gif"   width="174" height="65" alt="">
       <?php }else if($row['tireid'] == '3'){?>
        <img src="../tire/6/images/53.gif"   width="174" height="65" alt="">
       <?php }else if($row['tireid'] == '4'){?>
            <img src="../tire/6/images/54.gif"   width="174" height="65" alt="">
       <?php }else if($row['tireid'] == '5'){?>
             <img src="../tire/6/images/6_15.gif"   width="174" height="65" alt="">
       <?php }else if($row['tireid'] == '6'){?>
              <img src="../tire/6/images/56.gif"   width="174" height="65" alt="">
       <?php }}
	    else {?>
		      <img src="../tire/6/images/6_15.gif"   width="174" height="65" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id6-16">
		<a rel="facebox" href="maintenance_tireadd2.php?p=<?php echo $rplate['id'];?>"><?php
		
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='2' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='2' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		   <img src="../tire/6/images/6_16.png" width="174" height="89" alt="">
		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
        <img src="../tire/6/images/21.gif" width="174" height="89" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
       <img src="../tire/6/images/6_16.png" width="174" height="89" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		  <img src="../tire/6/images/23.gif" width="174" height="89" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/6/images/24.gif" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/6/images/25.gif" width="174" height="80" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/6/images/26.gif" width="174" height="80" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/6/images/21.gif" width="174" height="80" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/6/images/6_16.png" width="174" height="80" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/6/images/23.gif" width="174" height="80" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/6/images/24.gif" width="174" height="80" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/6/images/25.gif" width="174" height="80" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
          <img src="../tire/6/images/26.gif" width="174" height="80" alt="">
       <?php }}
	   else {?>
		  <img src="../tire/6/images/6_16.gif" width="174" height="89" alt=""><?php } 
	   ?></a>
	</div>
	<div class="id6-17">
		<img src="../tire/6/images/6_17.gif" width="170" height="125" alt="">
	</div>
	<div class="id6-18">
		<a rel="facebox" href="maintenance_tireadd6.php?p=<?php echo $rplate['id'];?>">
        <?php

		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='6' And remarks='swap' And tireid='1' order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='6' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='6' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		    <img src="../tire/6/images/6_18.png" width="164" height="80" alt="">
		  <?php 
		}else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
        <img src="../tire/6/images/61.gif" width="164" height="80" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
       <img src="../tire/6/images/62.gif" width="164" height="80" alt="">
       <?php }else if($rows['swapto'] == '3'){?>
 		   <img src="../tire/6/images/63.gif" width="164" height="80" alt="">
       <?php }else if($rows['swapto'] == '4'){?>
          <img src="../tire/6/images/64.gif" width="164" height="80" alt="">
       <?php }else if($rows['swapto'] == '5'){?>
          <img src="../tire/6/images/65.gif"  width="164" height="80" alt="">
       <?php }else if($rows['swapto'] == '6'){?>
          <img src="../tire/6/images/6_18.png"  width="164" height="80" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
		if($row['tireid'] == '1'){?>
        <img src="../tire/6/images/61.gif" width="164" height="80" alt="">
       <?php }else if($row['tireid'] == '2'){?>
       <img src="../tire/6/images/62.gif"  width="164" height="80" alt="">
        <?php }else if($rows['tireid'] == '3'){?>
 		   <img src="../tire/6/images/63.gif"  width="164" height="80" alt="">
       <?php }else if($rows['tireid'] == '4'){?>
          <img src="../tire/6/images/64.gif" width="164" height="80" alt="">
       <?php }else if($rows['tireid'] == '5'){?>
          <img src="../tire/6/images/65.gif" width="164" height="80" alt="">
       <?php }else if($rows['tireid'] == '6'){?>
          <img src="../tire/6/images/6_18.png" width="164" height="80" alt="">
       <?php }}
	    else {?>
		   <img src="../tire/6/images/6_18.gif"  width="164" height="80" alt=""><?php } 
	   ?></a>
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