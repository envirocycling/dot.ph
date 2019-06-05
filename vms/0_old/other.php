<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}

?>
<html>
<head>
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

<style type="text/css">


#Table_01 {
	position:absolute;
	left:0px;
	top:0px;
	width:898px;
	height:599px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-01 {
	position:absolute;
	left:0px;
	top:0px;
	width:898px;
	height:130px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-02 {
	position:absolute;
	left:0px;
	top:130px;
	width:78px;
	height:469px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-03 {
	position:absolute;
	left:78px;
	top:130px;
	width:211px;
	height:83px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-04 {
	position:absolute;
	left:289px;
	top:130px;
	width:312px;
	height:469px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-05 {
	position:absolute;
	left:601px;
	top:130px;
	width:207px;
	height:83px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-06 {
	position:absolute;
	left:808px;
	top:130px;
	width:90px;
	height:469px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-07 {
	position:absolute;
	left:78px;
	top:213px;
	width:211px;
	height:133px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-08 {
	position:absolute;
	left:601px;
	top:213px;
	width:207px;
	height:133px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-09 {
	position:absolute;
	left:78px;
	top:346px;
	width:211px;
	height:103px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-10 {
	position:absolute;
	left:601px;
	top:346px;
	width:207px;
	height:103px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-11 {
	position:absolute;
	left:78px;
	top:449px;
	width:211px;
	height:150px;
}

#id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-12 {
	position:absolute;
	left:601px;
	top:449px;
	width:207px;
	height:150px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">

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

?>
<!-- Save for Web Slices (2014-Mercedes-S-Class-S500-Hybrid-Plus-top.jpg) -->
<?php
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);
?>


<div id="Table_01">

	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-01">
    		<table align="right" width="50%">
<tr>
<td><h4>Plate No.<?php echo $rplate['truckplate'];?></h4></td>
</tr></table>
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_01.gif" width="898" height="130" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-02">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_02.gif" width="78" height="469" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-03">
    <a rel="facebox" href="maintenance_tireadd3.php?p=<?php echo $rplate['id'];?>">
        <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='3' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='3' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$rows = mysql_fetch_array($selects);
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='3' And truckplate='".$rplate['id']."'") or die (mysql_error());
		
		//code here
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){
		?> 
	<img src="../other/images/33.gif" width="211" height="83" alt="">
		<?php }
		else if(mysql_num_rows($selects) > 0){
					if($rows['swapto'] == '1'){?>
				<img src="../other/images/31.gif" width="211" height="83" alt="">
			<?php }else if($rows['swapto'] == '2'){?>
				<img src="../other/images/32.gif" width="211" height="83" alt="">
			<?php }else if($rows['swapto'] == '3'){?>
				<img src="../other/images/33.gif" width="211" height="83" alt="">
				<?php }else if($rows['swapto'] == '4'){?>
				<img src="../other/images/34.gif" width="211" height="83" alt="">
	<?php }
			else if(mysql_num_rows($select) > 0){ 
					if($row['tireid'] == '1'){?>
					<img src="../other/images/31.gif" width="211" height="83" alt="">
			<?php }else if($row['tireid'] == '2'){?>
					<img src="../other/images/32.gif" width="211" height="83" alt="">
			<?php }else if($row['tireid'] == '3'){?>
					<img src="../other/images/33.gif" width="211" height="83" alt="">
			<?php }else if($row['tireid'] == '4'){?>
					<img src="../other/images/34.gif" width="211" height="83" alt="">
			<?php }						
		}
		}
		else {?>
				<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_03.gif" width="211" height="83" alt=""><?php }
		?>
      </a>
		
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-04">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_04.gif" width="312" height="469" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-05">
   <a rel="facebox" href="maintenance_tireadd.php?p=<?php echo $rplate['id'];?>">
        <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='1' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$rows = mysql_fetch_array($selects);
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='1' And truckplate='".$rplate['id']."'") or die (mysql_error());
		
		//code here
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){
		?> 
	<img src="../other/images/11.gif" width="207" height="83" alt="">
		<?php }
		else if(mysql_num_rows($selects) > 0){
					if($rows['swapto'] == '1'){?>
				<img src="../other/images/11.gif" width="207" height="83" alt="">
			<?php }else if($rows['swapto'] == '2'){?>
				<img src="../other/images/12.gif" width="207" height="83" alt="">
			<?php }else if($rows['swapto'] == '3'){?>
			<img src="../other/images/13.gif" width="207" height="83" alt="">
				<?php }else if($rows['swapto'] == '4'){?>
				<img src="../other/images/14.gif" width="207" height="83" alt="">
	<?php }
			else if(mysql_num_rows($select) > 0){ 
					if($row['tireid'] == '1'){?>
						<img src="../other/images/11.gif" width="207" height="83" alt="">
			<?php }else if($row['tireid'] == '2'){?>
						<img src="../other/images/12.gif" width="207" height="83" alt="">
			<?php }else if($row['tireid'] == '3'){?>
						<img src="../other/images/13.gif" width="207" height="83" alt="">
			<?php }else if($row['tireid'] == '4'){?>
						<img src="../other/images/14.gif" width="207" height="83" alt="">
			<?php }						
		}
		}
		else {?>
				<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_05.gif" width="207" height="83" alt=""><?php }
		?>
      </a>

	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-06">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_06.gif" width="90" height="469" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-07">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_07.gif" width="211" height="133" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-08">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_08.gif" width="207" height="133" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-09">
    <a rel="facebox" href="maintenance_tireadd4.php?p=<?php echo $rplate['id'];?>">
        <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='4' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='4' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$rows = mysql_fetch_array($selects);
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='4' And truckplate='".$rplate['id']."'") or die (mysql_error());
		
		//code here
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){
		?> 
<img src="../other/images/44.gif" width="211" height="103" alt="">
		<?php }
		else if(mysql_num_rows($selects) > 0){
					if($rows['swapto'] == '1'){?>
				<img src="../other/images/41.gif" width="211" height="103" alt="">
			<?php }else if($rows['swapto'] == '2'){?>
				<img src="../other/images/42.gif" width="211" height="103" alt="">
			<?php }else if($rows['swapto'] == '3'){?>
			<img src="../other/images/43.gif" width="211" height="103" alt="">
				<?php }else if($rows['swapto'] == '4'){?>
				<img src="../other/images/44.gif" width="211" height="103" alt="">
	<?php }}
		else if(mysql_num_rows($select) > 0){ 
					if($row['tireid'] == '1'){?>
						<img src="../other/images/41.gif" width="211" height="103" alt="">
			<?php }else if($row['tireid'] == '2'){?>
					<img src="../other/images/42.gif" width="211" height="103" alt="">
			<?php }else if($row['tireid'] == '3'){?>
						<img src="../other/images/43.gif" width="211" height="103" alt="">
			<?php }else if($row['tireid'] == '4'){?>
						<img src="../other/images/44.gif" width="211" height="103" alt="">
			<?php }						
		}
		
		else {?>
				<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_09.gif" width="211" height="103" alt="">><?php }
		?>
      </a>
    
    </div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-10">
    <a rel="facebox" href="maintenance_tireadd2.php?p=<?php echo $rplate['id'];?>">
        <?php 
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='2' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		$rows = mysql_fetch_array($selects);
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='2' And truckplate='".$rplate['id']."'") or die (mysql_error());
		
		//code here
		if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){
		?> 
<img src="../other/images/22.gif" width="207" height="103" alt="">
		<?php }
		else if(mysql_num_rows($selects) > 0){
					if($rows['swapto'] == '1'){?>
				<img src="../other/images/21.gif" width="207" height="103" alt="">
			<?php }else if($rows['swapto'] == '2'){?>
				<img src="../other/images/22.gif" width="207" height="103" alt="">
			<?php }else if($rows['swapto'] == '3'){?>
			<img src="../other/images/23.gif" width="207" height="103" alt="">
				<?php }else if($rows['swapto'] == '4'){?>
				<img src="../other/images/24.gif" width="207" height="103" alt="">
	<?php }
			else if(mysql_num_rows($select) > 0){ 
					if($row['tireid'] == '1'){?>
						<img src="../other/images/21.gif" width="207" height="103" alt="">
			<?php }else if($row['tireid'] == '2'){?>
						<img src="../other/images/22.gif" width="207" height="103" alt="">
			<?php }else if($row['tireid'] == '3'){?>
						<img src="../other/images/23.gif" width="207" height="103" alt="">
			<?php }else if($row['tireid'] == '4'){?>
						<img src="../other/images/24.gif" width="207" height="103" alt="">
			<?php }						
		}
		}
		else {?>
				<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_10.gif" width="207" height="103" alt=""><?php }
		?>
      </a>
    	
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-11">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_11.gif" width="211" height="150" alt="">
	</div>
	<div id="id2014-Mercedes-S-Class-S500-Hybrid-Plus-top-12">
		<img src="../other/images/2014-Mercedes-S-Class-S500-Hybrid-Plus-top_12.gif" width="207" height="150" alt="">
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>