<?php
session_start();
if(!isset($_SESSION['encoder_username'])){
	header("Location: ../index.php");
	}

?>

<!-- Save for Web Styles (download.jpg) -->

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
	width:272px;
	height:185px;
}

#download-01 {
	position:absolute;
	left:0px;
	top:0px;
	width:272px;
	height:102px;
}

#download-02 {
	position:absolute;
	left:0px;
	top:102px;
	width:17px;
	height:83px;
}

#download-03 {
	position:absolute;
	left:17px;
	top:102px;
	width:66px;
	height:70px;
}

#download-04 {
	position:absolute;
	left:83px;
	top:102px;
	width:189px;
	height:10px;
}

#download-05 {
	position:absolute;
	left:83px;
	top:112px;
	width:115px;
	height:73px;
}

#download-06 {
	position:absolute;
	left:198px;
	top:112px;
	width:69px;
	height:60px;
}

#download-07 {
	position:absolute;
	left:267px;
	top:112px;
	width:5px;
	height:73px;
}

#download-08 {
	position:absolute;
	left:17px;
	top:172px;
	width:66px;
	height:13px;
}

#download-09 {
	position:absolute;
	left:198px;
	top:172px;
	width:69px;
	height:13px;
}

-->
</style>
<!-- End Save for Web Styles -->

<!-- Save for Web Slices (download.jpg) -->
<?php
include('connect.php');
$qplate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_GET['id']."'") or die (mysql_error());
$rplate = mysql_fetch_array($qplate);

$select_tire = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='1'") or die (mysql_error());
$row_tire = mysql_fetch_array($select_tire);

$select_tire2 = mysql_query("Select * from tbl_trucktires Where truckplate='".$rplate['id']."' AND tireid='2'") or die (mysql_error());
$row_tire2 = mysql_fetch_array($select_tire2);

?>
		<table align="right" width="56%">
<tr>
<td><h4>Plate No.<?php echo $rplate['truckplate'];?></h4></td>
</tr></table>
<div id="Table_01">
	<div id="download-01">
		<img src="../mio/images/download_01.gif" width="272" height="102" alt="">
	</div>
	<div id="download-02">
		<img src="../mio/images/download_02.gif" width="17" height="83" alt="">
	</div>
	<div id="download-03">
          <a rel="facebox" href="maintenance_tireadd2.php?p=<?php echo $rplate['id'];?>">
            <?php 
            $select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='2' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
            $row = mysql_fetch_array($select);
            
                $selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='2' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
                   $rows = mysql_fetch_array($selects);
            $select_on = mysql_query("Select * from tbl_trucktires Where tireid='2' And truckplate='".$rplate['id']."'") or die (mysql_error());
            $row_on = mysql_fetch_array($select_on);

     
            if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0){?>
                        <img src="../mio/images/22.gif" width="66" height="70" alt="">
              <?php 
            } 
			else if(mysql_num_rows($selects) > 0){
          	 	if($rows['swapto'] == '1'){?>
                    <img src="../mio/images/21.gif" width="66" height="70" alt="">
          	 <?php }else if($rows['swapto'] == '2'){?>
                    <img src="../mio/images/22.gif" width="66" height="70" alt="">
          	 <?php }
			 
			}else if(mysql_num_rows($select) > 0){ 
          			  if($row['tireid'] == '1'){?>
                  		  <img src="../mio/images/21.gif" width="66" height="70" alt="">
          		 <?php }else if($row['tireid'] == '2'){?>
               			 <img src="../mio/images/22.gif" width="66" height="70" alt="">
           			<?php }
			}else{?>
                    <img src="../mio/images/download_03.gif" width="66" height="70" alt=""><?php }  ?>
            </a>
	
	</div>
	<div id="download-04">
		<img src="../mio/images/download_04.gif" width="189" height="10" alt="">
	</div>
	<div id="download-05">
		<img src="../mio/images/download_05.gif" width="115" height="73" alt="">
	</div>
	<div id="download-06">
      <a rel="facebox" href="maintenance_tireadd.php?p=<?php echo $rplate['id'];?>">
        <?php 
	
		$select = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And swapto='1' And remarks='swap'  order by id Desc LIMIT 1")or die (mysql_error());
		$row = mysql_fetch_array($select);
		
			$selects = mysql_query("Select * from tbl_changeswaps Where truckid='".$rplate['id']."' And tireid='1' And remarks='swap' order by id Desc LIMIT 1")or die (mysql_error());
		
		$select_on = mysql_query("Select * from tbl_trucktires Where tireid='1' And truckplate='".$rplate['id']."'") or die (mysql_error());
		$row_on = mysql_fetch_array($select_on);
		$rows = mysql_fetch_array($selects);
			if(mysql_num_rows($select_on) > 0 && mysql_num_rows($selects) == 0 && mysql_num_rows($select) == 0 ){?>
		  			<img src="../mio/images/11.gif" width="69" height="60" alt="">
		  <?php }
		else if(mysql_num_rows($selects) > 0){
				if($rows['swapto'] == '1'){?>
     			<img src="../mio/images/11.gif" width="69" height="60" alt="">
     	  <?php } else if($rows['swapto'] == '2'){?>
      		<img src="../mio/images/12.gif" width="69" height="60" alt="">
       <?php }
	   }else if(mysql_num_rows($select) > 0){ 
			if($row['tireid'] == '1'){?>
    		<img src="../mio/images/11.gif" width="69" height="60" alt="">
       <?php }else if($row['tireid'] == '2'){?>
   		<img src="../mio/images/12.gif" width="69" height="60" alt="">
       <?php }
	   
	   } else {?>
				<img src="../mio/images/download_06.gif" width="69" height="60" alt=""><?php } 
	   ?>
        </a>
		
	</div>
	<div id="download-07">
		<img src="../mio/images/download_07.gif" width="5" height="73" alt="">
	</div>
	<div id="download-08">
		<img src="../mio/images/download_08.gif" width="66" height="13" alt="">
	</div>
	<div id="download-09">
		<img src="../mio/images/download_09.gif" width="69" height="13" alt="">
	</div>
</div>
<!-- End Save for Web Slices -->
