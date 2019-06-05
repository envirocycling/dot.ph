<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}

?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Save for Web Styles (TMX_125_Alpha2.jpg) -->
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
<style type="text/css">
<!--

#Table_01 {
	position:absolute;
	left:0px;
	top:0px;
	width:350px;
	height:350px;
}

#TMX-125-Alpha2-01 {
	position:absolute;
	left:0px;
	top:0px;
	width:350px;
	height:201px;
}

#TMX-125-Alpha2-02 {
	position:absolute;
	left:0px;
	top:201px;
	width:32px;
	height:149px;
}

#TMX-125-Alpha2-03 {
	position:absolute;
	left:32px;
	top:201px;
	width:71px;
	height:93px;
}

#TMX-125-Alpha2-04 {
	position:absolute;
	left:103px;
	top:201px;
	width:247px;
	height:12px;
}

#TMX-125-Alpha2-05 {
	position:absolute;
	left:103px;
	top:213px;
	width:123px;
	height:137px;
}

#TMX-125-Alpha2-06 {
	position:absolute;
	left:226px;
	top:213px;
	width:111px;
	height:124px;
}

#TMX-125-Alpha2-07 {
	position:absolute;
	left:337px;
	top:213px;
	width:13px;
	height:137px;
}

#TMX-125-Alpha2-08 {
	position:absolute;
	left:32px;
	top:294px;
	width:71px;
	height:56px;
}

#TMX-125-Alpha2-09 {
	position:absolute;
	left:226px;
	top:337px;
	width:111px;
	height:13px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<?php
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);

$select_tire = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='1'") or die (mysql_error());
$row_tire = mysql_fetch_array($select_tire);

$select_tire2 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='2'") or die (mysql_error());
$row_tire2 = mysql_fetch_array($select_tire2);

?>

<body style="background-color:#FFFFFF; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">
<!-- Save for Web Slices (TMX_125_Alpha2.jpg) -->

		<table align="right" width="56%">
<tr>
<td><h4>Plate No.<?php echo $rplate['truckplate'];?></h4></td>
</tr>
<tr>
<td>
<div id="Table_01">
	<div id="TMX-125-Alpha2-01">
		<img src="../motor/images/TMX_125_Alpha2_01.gif" width="350" height="201" alt="">
	</div>
	<div id="TMX-125-Alpha2-02">
		<img src="../motor/images/TMX_125_Alpha2_02.gif" width="32" height="149" alt="">
	</div>
	<div id="TMX-125-Alpha2-03">
    <a rel="facebox" href="maintenance_tireadd2.php?p=<?php echo $rplate['id'];?>">
        <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='2' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='2' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		  		<img src="../motor/images/2TMX_125_Alpha2_03.gif" width="71" height="93" alt="">
		  <?php 
		} 
		else if(mysql_num_rows($selects) > 0){
				  if($rows['swapto'] == '1'){?>
     				<img src="../motor/images/21.gif" width="71" height="93" alt="">
     	  <?php }else if($rows['swapto'] == '2'){?>
      				<img src="../motor/images/TMX_125_Alpha2_03.gif" width="71" height="93" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
				if($row['tireid'] == '1'){?>
    				<img src="../motor/images/21.gif" width="71" height="93" alt="">
      	 <?php }else if($row['tireid'] == '2'){?>
   					<img src="../motor/images/TMX_125_Alpha2_03.gif" width="71" height="93" alt="">
     	  <?php }}
	   
	   else {?>
				<img src="../motor/images/TMX_125_Alpha2_03.gif" width="71" height="93" alt=""><?php } ?>
        </a>

	</div>
	<div id="TMX-125-Alpha2-04">
		<img src="../motor/images/TMX_125_Alpha2_04.gif" width="247" height="12" alt="">
	</div>
	<div id="TMX-125-Alpha2-05">
		<img src="../motor/images/TMX_125_Alpha2_05.gif" width="123" height="137" alt="">
	</div>
	<div id="TMX-125-Alpha2-06">	<a rel="facebox" href="maintenance_tireadd.php?p=<?php echo $rplate['id'];?>">
        <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='1' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='1' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		    <img src="../motor/images/1TMX_125_Alpha2_06.gif" width="111" height="124" alt="">
		  <?php 
		}
		else if(mysql_num_rows($selects) > 0){
			 if($rows['swapto'] == '1'){?>
     			 <img src="../motor/images/1TMX_125_Alpha2_06.gif" width="111" height="124" alt="">
       <?php }else if($rows['swapto'] == '2'){?>
     			  <img src="../motor/images/12.gif" width="111" height="124" alt="">
       <?php }}
		else if(mysql_num_rows($select) > 0){ 
				if($row['tireid'] == '1'){?>
           			 <img src="../motor/images/1TMX_125_Alpha2_06.gif" width="111" height="124" alt="">
     	  <?php }else if($row['tireid'] == '2'){?>
       				 <img src="../motor/images/12.gif" width="111" height="124" alt="">
       <?php }}
	   
	    else {?>
		 <img src="../motor/images/TMX_125_Alpha2_06.gif" width="111" height="124" alt=""><?php } ?>
        </a>
		
	</div>
	<div id="TMX-125-Alpha2-07">
		<img src="../motor/images/TMX_125_Alpha2_07.gif" width="13" height="137" alt="">
	</div>
	<div id="TMX-125-Alpha2-08">
		<img src="../motor/images/TMX_125_Alpha2_08.gif" width="71" height="56" alt="">
	</div>
	<div id="TMX-125-Alpha2-09">
		<img src="../motor/images/TMX_125_Alpha2_09.gif" width="111" height="13" alt="">
	</div>
</div>
</td>
<tr>
</table>
</center>
<!-- End Save for Web Slices -->
</body>

</html>