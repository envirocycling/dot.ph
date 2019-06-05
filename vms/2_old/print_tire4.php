<center>
<?php
include('connect.php');
$tbltire_select1 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='1'") or die(mysql_error());
		$tbltire_row1 = mysql_fetch_array($tbltire_select1);
		$tbltire_select11 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='11'") or die(mysql_error());
		$tbltire_row11 = mysql_fetch_array($tbltire_select11);

?>
 <?php $tbltire_select3 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='3'") or die(mysql_error());
		$tbltire_row3 = mysql_fetch_array($tbltire_select3);
	
		?>
         <?php $tbltire_select4 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='4'") or die(mysql_error());
		$tbltire_row4 = mysql_fetch_array($tbltire_select4);
		
	
		?>
		  <?php $tbltire_select2 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='2'") or die(mysql_error());
		$tbltire_row2 = mysql_fetch_array($tbltire_select2);
		
	
		?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Save for Web Styles (Untitled-2) -->
<style type="text/css">
<!--

#Table_01 {
	position:absolute;
	left:12%;
	top:0px;
	width:1018px;
	height:635px;
}

#Untitled-2-01_ {
	position:absolute;
	left:0px;
	top:0px;
	background-image:url(../images/Untitled-2_01.gif);
	width:1018px;
	height:222px;
}

#Untitled-2-02_ {
	position:absolute;
	left:0px;
	top:222px;
	width:184px;
	height:413px;
}

#Untitled-2-03_ {
	position:absolute;
	left:184px;
	top:222px;
	background-image:url(../images/Untitled-2_03.gif);
	width:104px;
	height:19px;
}

#Untitled-2-04_ {
	position:absolute;
	left:288px;
	top:222px;
	width:193px;
	height:413px;
}

#Untitled-2-05_ {
	position:absolute;
	left:481px;
	top:222px;
	width:81px;
	height:19px;
	background-image:url(../images/Untitled-2_05.gif);
}

#Untitled-2-06_ {
	position:absolute;
	left:562px;
	top:222px;
	width:456px;
	height:2px;
}

#Untitled-2-07_ {
	position:absolute;
	left:562px;
	top:224px;
	width:234px;
	height:411px;
}

#Untitled-2-08_ {
	position:absolute;
	left:796px;
	top:224px;
	width:106px;
	height:19px;
	background-image:url(../images/Untitled-2_08.gif);
}

#Untitled-2-09_ {
	position:absolute;
	left:902px;
	top:224px;
	width:116px;
	height:411px;
}

#Untitled-2-10_ {
	position:absolute;
	left:184px;
	top:241px;
	width:104px;
	height:20px;
}

#Untitled-2-11_ {
	position:absolute;
	left:481px;
	top:241px;
	width:81px;
	height:8px;
}

#Untitled-2-12_ {
	position:absolute;
	left:796px;
	top:243px;
	width:106px;
	height:6px;
}

#Untitled-2-13_ {
	position:absolute;
	background-image:url(../images/Untitled-2_13.gif);
	left:184px;
	top:249px;
	width:104px;
	height:18px;
}

#Untitled-2-14_ {
	position:absolute;
	left:481px;
	top:249px;
	width:81px;
	height:18px;
	background-image:url(../images/Untitled-2_14.gif);
}

#Untitled-2-15_ {
	position:absolute;
	left:796px;
	top:249px;
	width:106px;
	height:18px;
	background-image:url(../images/Untitled-2_15.gif);
}

#Untitled-2-16_ {
	position:absolute;
	left:184px;
	top:267px;
	width:104px;
	height:6px;
}

#Untitled-2-17_ {
	position:absolute;
	left:481px;
	top:267px;
	width:81px;
	height:6px;
}

#Untitled-2-18_ {
	position:absolute;
	left:796px;
	top:267px;
	width:106px;
	height:6px;
}

#Untitled-2-19_ {
	position:absolute;
	left:184px;
	top:273px;
	background-image:url(../images/Untitled-2_19.gif);
	width:104px;
	height:19px;
}

#Untitled-2-20_ {
	position:absolute;
	left:481px;
	top:273px;
	width:81px;
	height:19px;
	background-image:url(../images/Untitled-2_20.gif);
}

#Untitled-2-21_ {
	position:absolute;
	left:796px;
	top:273px;
	width:106px;
	height:19px;
	background-image:url(../images/Untitled-2_21.gif);
}

#Untitled-2-22_ {
	position:absolute;
	left:184px;
	top:292px;
	width:104px;
	height:5px;
}

#Untitled-2-23_ {
	position:absolute;
	left:481px;
	top:292px;
	width:81px;
	height:5px;
}

#Untitled-2-24_ {
	position:absolute;
	left:796px;
	top:292px;
	width:106px;
	height:5px;
}

#Untitled-2-25_ {
	position:absolute;
	left:184px;
	top:297px;
	width:104px;
	height:21px;
	background-image:url(../images/Untitled-2_25.gif);
}

#Untitled-2-26_ {
	position:absolute;
	left:481px;
	top:297px;
	width:81px;
	height:21px;
	background-image:url(../images/Untitled-2_26.gif);
}

#Untitled-2-27_ {
	position:absolute;
	left:796px;
	top:297px;
	width:106px;
	height:21px;
	background-image:url(../images/Untitled-2_27.gif);
}

#Untitled-2-28_ {
	position:absolute;
	left:184px;
	top:318px;
	width:104px;
	height:5px;
}

#Untitled-2-29_ {
	position:absolute;
	left:481px;
	top:318px;
	width:81px;
	height:5px;
}

#Untitled-2-30_ {
	position:absolute;
	left:796px;
	top:318px;
	width:106px;
	height:5px;
}

#Untitled-2-31_ {
	position:absolute;
	left:184px;
	top:323px;
	width:104px;
	height:19px;
}

#Untitled-2-32_ {
	position:absolute;
	left:481px;
	top:323px;
	width:81px;
	height:19px;
}

#Untitled-2-33_ {
	position:absolute;
	left:796px;
	top:323px;
	width:106px;
	height:19px;
}

#Untitled-2-34_ {
	position:absolute;
	left:184px;
	top:342px;
	width:104px;
	height:5px;
}

#Untitled-2-35_ {
	position:absolute;
	left:481px;
	top:342px;
	width:81px;
	height:5px;
}

#Untitled-2-36_ {
	position:absolute;
	left:796px;
	top:342px;
	width:106px;
	height:5px;
}

#Untitled-2-37_ {
	position:absolute;
	left:184px;
	background-image:url(../images/Untitled-2_37.gif);
	top:347px;
	width:104px;
	height:22px;
}

#Untitled-2-38_ {
	position:absolute;
	left:481px;
	top:347px;
	width:81px;
	height:22px;
	background-image:url(../images/Untitled-2_38.gif);
}

#Untitled-2-39_ {
	position:absolute;
	left:796px;
	top:347px;
	width:106px;
	height:22px;
	background-image:url(../images/Untitled-2_39.gif);
}

#Untitled-2-40_ {
	position:absolute;
	left:184px;
	top:369px;
	width:104px;
	height:87px;
}

#Untitled-2-41_ {
	position:absolute;
	left:481px;
	top:369px;
	width:81px;
	height:266px;
}

#Untitled-2-42_ {
	position:absolute;
	left:796px;
	top:369px;
	width:106px;
	height:87px;
}

#Untitled-2-43_ {
	position:absolute;
	left:184px;
	top:456px;
	width:104px;
	height:21px;
	background-image:url(../images/Untitled-2_43.gif);
}

#Untitled-2-44_ {
	position:absolute;
	left:796px;
	top:456px;
	width:106px;
	height:21px;
	background-image:url(../images/Untitled-2_44.gif);
}

#Untitled-2-45_ {
	position:absolute;
	left:184px;
	top:477px;
	width:104px;
	height:4px;
}

#Untitled-2-46_ {
	position:absolute;
	left:796px;
	top:477px;
	width:106px;
	height:4px;
}

#Untitled-2-47_ {
	position:absolute;
	left:184px;
	top:481px;
	width:104px;
	height:22px;
	background-image:url(../images/Untitled-2_47.gif);
}

#Untitled-2-48_ {
	position:absolute;
	left:796px;
	top:481px;
	width:106px;
	height:22px;
	background-image:url(../images/Untitled-2_48.gif);
}

#Untitled-2-49_ {
	position:absolute;
	left:184px;
	top:503px;
	width:104px;
	height:3px;
}

#Untitled-2-50_ {
	position:absolute;
	left:796px;
	top:503px;
	width:106px;
	height:3px;
}

#Untitled-2-51_ {
	position:absolute;
	left:184px;
	top:506px;
	width:104px;
	height:21px;
	background-image:url(../images/Untitled-2_51.gif);
}

#Untitled-2-52_ {
	position:absolute;
	left:796px;
	top:506px;
	width:106px;
	height:21px;
	background-image:url(../images/Untitled-2_52.gif);
}

#Untitled-2-53_ {
	position:absolute;
	left:184px;
	top:527px;
	width:104px;
	height:4px;
}

#Untitled-2-54_ {
	position:absolute;
	left:796px;
	top:527px;
	width:106px;
	height:4px;
}

#Untitled-2-55_ {
	position:absolute;
	left:184px;
	top:531px;
	width:104px;
	height:22px;
	background-image:url(../images/Untitled-2_55.gif);
}

#Untitled-2-56_ {
	position:absolute;
	left:796px;
	top:531px;
	width:106px;
	height:22px;
	background-image:url(../images/Untitled-2_56.gif);
}

#Untitled-2-57_ {
	position:absolute;
	left:184px;
	top:553px;
	width:104px;
	height:4px;
}

#Untitled-2-58_ {
	position:absolute;
	left:796px;
	top:553px;
	width:106px;
	height:3px;
}

#Untitled-2-59_ {
	position:absolute;
	left:796px;
	top:556px;
	width:106px;
	height:21px;
}

#Untitled-2-60_ {
	position:absolute;
	left:184px;
	top:557px;
	width:104px;
	height:21px;
}

#Untitled-2-61_ {
	position:absolute;
	left:796px;
	top:577px;
	width:106px;
	height:2px;
}

#Untitled-2-62_ {
	position:absolute;
	left:184px;
	top:578px;
	width:104px;
	height:4px;
}

#Untitled-2-63_ {
	position:absolute;
	left:796px;
	top:579px;
	width:106px;
	height:25px;
	background-image:url(../images/Untitled-2_63.gif);
}

#Untitled-2-64_ {
	position:absolute;
	left:184px;
	top:582px;
	width:104px;
	height:21px;
	background-image:url(../images/Untitled-2_64.gif);
}

#Untitled-2-65_ {
	position:absolute;
	left:184px;
	top:603px;
	width:104px;
	height:32px;
}

#Untitled-2-66_ {
	position:absolute;
	left:796px;
	top:604px;
	width:106px;
	height:31px;
}

-->
</style>
<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF;">
<!-- Save for Web Slices (Untitled-2) -->
<div id="Table_01">
	<div id="Untitled-2-01_">
		<div style="position:absolute; top:40%; left:0px;"><h3>Plate No. <?php echo $_GET['plate'];?></h3></div>
	</div>
	<div id="Untitled-2-02_">
		<img id="Untitled_2_02" src="../images/Untitled-2_02.gif" width="184" height="413" alt="" />
	</div>
	<div id="Untitled-2-03_">
	<font size="-1">
        <?php  echo $tbltire_row1['tiresize'];?>
	</font>
	</div>
	<div id="Untitled-2-04_">
		<img id="Untitled_2_04" src="../images/Untitled-2_04.gif" width="193" height="413" alt="" />
	</div>
	<div id="Untitled-2-05_">
	<font size="-1">
        <?php  echo $tbltire_row11['tiresize'];?>
	</font>
		
	</div>
	<div id="Untitled-2-06_">
		<img id="Untitled_2_06" src="../images/Untitled-2_06.gif" width="456" height="2" alt="" />
	</div>
	<div id="Untitled-2-07_">
		<img id="Untitled_2_07" src="../images/Untitled-2_07.gif" width="234" height="411" alt="" />
	</div>
	<div id="Untitled-2-08_">
	<font size="-1">
        <?php  echo $tbltire_row2['tiresize'];?>
	</font>
	</div>
	<div id="Untitled-2-09_">
		<img id="Untitled_2_09" src="../images/Untitled-2_09.gif" width="116" height="411" alt="" />
	</div>
	<div id="Untitled-2-10_">
		<img id="Untitled_2_10" src="../images/Untitled-2_10.gif" width="104" height="8" alt="" />	</div>
	<div id="Untitled-2-11_">
		<img id="Untitled_2_11" src="../images/Untitled-2_11.gif" width="81" height="8" alt="" />
	</div>
	<div id="Untitled-2-12_">
		<img id="Untitled_2_12" src="../images/Untitled-2_12.gif" width="106" height="6" alt="" />
	</div>
	<div id="Untitled-2-13_">
	 <font size="-1">
        <?php  echo $tbltire_row1['description']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-14_">
	 <font size="-1">
        <?php  echo $tbltire_row11['description']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-15_">
	<font size="-1">
	   <?php  echo $tbltire_row2['description']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-16_">
		<img id="Untitled_2_16" src="../images/Untitled-2_16.gif" width="104" height="6" alt="" />
	</div>
	<div id="Untitled-2-17_">
		<img id="Untitled_2_17" src="../images/Untitled-2_17.gif" width="81" height="6" alt="" />
	</div>
	<div id="Untitled-2-18_">
		<img id="Untitled_2_18" src="../images/Untitled-2_18.gif" width="106" height="6" alt="" />
	</div>
	<div id="Untitled-2-19_">
	<font size="-1">
	   <?php   echo $tbltire_row1['dateadded']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-20_">
	<font size="-1">
	   <?php   echo $tbltire_row11['dateadded']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-21_">
	<font size="-1">
	   <?php  echo $tbltire_row2['dateadded']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-22_">
		<img id="Untitled_2_22" src="../images/Untitled-2_22.gif" width="104" height="5" alt="" />
	</div>
	<div id="Untitled-2-23_">
		<img id="Untitled_2_23" src="../images/Untitled-2_23.gif" width="81" height="5" alt="" />
	</div>
	<div id="Untitled-2-24_">
		<img id="Untitled_2_24" src="../images/Untitled-2_24.gif" width="106" height="5" alt="" />
	</div>
	<div id="Untitled-2-25_">
	<font size="-1">
        <?php  echo $tbltire_row1['tirename']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-26_">
	<font size="-1">
        <?php  echo $tbltire_row11['tirename']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-27_">
	<font size="-1">
	   <?php  echo $tbltire_row2['tirename']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-28_">
		<img id="Untitled_2_28" src="../images/Untitled-2_28.gif" width="104" height="5" alt="" />
	</div>
	<div id="Untitled-2-29_">
		<img id="Untitled_2_29" src="../images/Untitled-2_29.gif" width="81" height="5" alt="" />
	</div>
	<div id="Untitled-2-30_">
		<img id="Untitled_2_30" src="../images/Untitled-2_30.gif" width="106" height="5" alt="" />
	</div>
	<div id="Untitled-2-31_">
		<img id="Untitled_2_31" src="../images/Untitled-2_31.gif" width="104" height="19" alt="" />
	</div>
	<div id="Untitled-2-32_">
		<img id="Untitled_2_32" src="../images/Untitled-2_32.gif" width="81" height="19" alt="" />
	</div>
	<div id="Untitled-2-33_">
		<img id="Untitled_2_33" src="../images/Untitled-2_33.gif" width="106" height="19" alt="" />
	</div>
	<div id="Untitled-2-34_">
		<img id="Untitled_2_34" src="../images/Untitled-2_34.gif" width="104" height="5" alt="" />
	</div>
	<div id="Untitled-2-35_">
		<img id="Untitled_2_35" src="../images/Untitled-2_35.gif" width="81" height="5" alt="" />
	</div>
	<div id="Untitled-2-36_">
		<img id="Untitled_2_36" src="../images/Untitled-2_36.gif" width="106" height="5" alt="" />
	</div>
	<div id="Untitled-2-37_">
	<font size="-1">
	   <?php  echo $tbltire_row1['status']; ?>
	</font>
	</div>
	<div id="Untitled-2-38_">
	<font size="-1">
	   <?php  echo $tbltire_row11['status']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-39_">
		<font size="-1">
	   <?php  echo $tbltire_row2['status']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-40_">
		<img id="Untitled_2_40" src="../images/Untitled-2_40.gif" width="104" height="87" alt="" />
	</div>
	<div id="Untitled-2-41_">
		<img id="Untitled_2_41" src="../images/Untitled-2_41.gif" width="81" height="266" alt="" />
	</div>
	<div id="Untitled-2-42_">
		<img id="Untitled_2_42" src="../images/Untitled-2_42.gif" width="106" height="87" alt="" />
	</div>
	<div id="Untitled-2-43_">
	<font size="-1">
	   <?php  echo $tbltire_row3['tiresize']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-44_">
	<font size="-1">
	   <?php  echo $tbltire_row4['tiresize']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-45_">
		<img id="Untitled_2_45" src="../images/Untitled-2_45.gif" width="104" height="4" alt="" />
	</div>
	<div id="Untitled-2-46_">
		<img id="Untitled_2_46" src="../images/Untitled-2_46.gif" width="106" height="4" alt="" />
	</div>
	<div id="Untitled-2-47_">
	<font size="-1">
	   <?php  echo $tbltire_row3['description']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-48_">
	<font size="-1">
	   <?php  echo $tbltire_row4['description']; ?>
	</font>
	</div>
	<div id="Untitled-2-49_">
		<img id="Untitled_2_49" src="../images/Untitled-2_49.gif" width="104" height="3" alt="" />
	</div>
	<div id="Untitled-2-50_">
		<img id="Untitled_2_50" src="../images/Untitled-2_50.gif" width="106" height="3" alt="" />
	</div>
	<div id="Untitled-2-51_">
	<font size="-1">
	   <?php  echo $tbltire_row3['dateadded']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-52_">
	<font size="-1">
	   <?php  echo $tbltire_row4['dateadded']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-53_">
		<img id="Untitled_2_53" src="../images/Untitled-2_53.gif" width="104" height="4" alt="" />
	</div>
	<div id="Untitled-2-54_">
		<img id="Untitled_2_54" src="../images/Untitled-2_54.gif" width="106" height="4" alt="" />
	</div>
	<div id="Untitled-2-55_">
	<font size="-1">
	   <?php  echo $tbltire_row3['tirename']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-56_">
	<font size="-1">
	   <?php  echo $tbltire_row4['tirename']; ?>
	</font>
		
	</div>
	<div id="Untitled-2-57_">
		<img id="Untitled_2_57" src="../images/Untitled-2_57.gif" width="104" height="4" alt="" />
	</div>
	<div id="Untitled-2-58_">
		<img id="Untitled_2_58" src="../images/Untitled-2_58.gif" width="106" height="3" alt="" />
	</div>
	<div id="Untitled-2-59_">
		<img id="Untitled_2_59" src="../images/Untitled-2_59.gif" width="106" height="21" alt="" />
	</div>
	<div id="Untitled-2-60_">
		<img id="Untitled_2_60" src="../images/Untitled-2_60.gif" width="104" height="21" alt="" />
	</div>
	<div id="Untitled-2-61_">
		<img id="Untitled_2_61" src="../images/Untitled-2_61.gif" width="106" height="2" alt="" />
	</div>
	<div id="Untitled-2-62_">
		<img id="Untitled_2_62" src="../images/Untitled-2_62.gif" width="104" height="4" alt="" />
	</div>
	<div id="Untitled-2-63_">
	<font size="-1">
	   <?php  echo $tbltire_row4['status']; ?>
	</font>
	
	</div>
	<div id="Untitled-2-64_">
	<font size="-1">
	   <?php  echo $tbltire_row3['status']; ?>
	</font>
	</div>
	<div id="Untitled-2-65_">
		<img id="Untitled_2_65" src="../images/Untitled-2_65.gif" width="104" height="32" alt="" />
	</div>
	<div id="Untitled-2-66_">
		<img id="Untitled_2_66" src="../images/Untitled-2_66.gif" width="106" height="31" alt="" />
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>
</center>