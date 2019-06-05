	<?php
session_start();
if(!isset($_SESSION['bhead_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

  <link href="../css/table1.css" media="screen" rel="stylesheet" type="text/css" />
 <?php
 include('connect.php');
 ?>
 
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
 <?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<?php //disabledfileds=====-=-=--=-==-===---------------------------[?>
<script>
function active(){
  if(document.getElementById('checkbox').checked){
   ;
	      document.getElementById('pdate').disabled=false;
	 document.getElementById('adate').disabled=false;
	  document.getElementById('quantity').disabled=false;
	   document.getElementById('reassign').disabled=false;
	    document.getElementById('sold').disabled=false;

}else{
   
	   document.getElementById('pdate').disabled=true;
	   	   document.getElementById('adate').disabled=true;
	   	  document.getElementById('quantity').disabled=true;
	   document.getElementById('reassign').disabled=true;
	    document.getElementById('sold').disabled=true;
	   }
}</script>
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
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <center>
     <?php
	$driver2 = mysql_query("Select Distinct month from tbl_trip Where driver ='".$_GET['plate']."' or helper='".$_GET['plate']."' order by day,id,year ASC") or die (mysql_error());?>
    <table width="60% "> 
    <tr>
    <td>
    <form action="" target="summary"  method="post" id="frm">
    <select name="filter" onchange="onSelectChange()">
    <?php if(isset($_POST['filter'])){
		?>
		<option value="<?php echo $_POST['filter'];?>"><?php echo $_POST['filter'];?></option>
		<?php
		}?>
    <option value="">-Select Month-</option>
    <?php while($date = mysql_fetch_array($driver2)){
		?>
   	<option value="<?php echo $date['month'];?>"><?php echo $date['month'];?></option>
  
	<?php } ?>
      </select>
      <input type="hidden" name="plate" value="<?php echo $_GET['plate'];?>">
    </form>
    </td>
    </tr>
    <tr>
    <td>
	<table class="CSSTableGenerator">
    <tr>
    <td width="20%">Date</td>
    <td>Plate</td>
    <td>Activity</td>
    <td>Remarks</td>
    </tr>
   <?php

  if(isset($_POST['filter'])){

	     	$driver = mysql_query("Select * from tbl_trip Where (helper='".$_POST['plate']."' or driver ='".$_POST['plate']."') And month='".$_POST['filter']." '  order by no,day,year ASC") or die (mysql_error());
	  }else{
   $driver = mysql_query("Select * from tbl_trip Where driver ='".$_GET['plate']."' or helper='".$_GET['plate']."'  order by no,day,year ASC") or die (mysql_error());}
	while($rows = mysql_fetch_array($driver)){
		$n = $rows['day'].$rows['month'].$rows['year'];
		if($n == @$datea && $rows['truckid'] == @$platea){}else{
			?>
       <tr>
       <td><?php echo $rows['day'].'-'.$rows['month'].' '.$rows['year'];
	   $p_no = mysql_query("Select * from tbl_truck_report Where id ='".$rows['truckid']."'") or die (mysql_error());
	   $p_no_rows = mysql_fetch_array($p_no);
	   ?></td>
       <td><?php echo $p_no_rows['truckplate'];?></td>
       <td><?php echo $rows['supplier'];?></td>
       <td><?php echo $rows['remarks'];?></td>
       </tr> 
        <?php
		}
		$datea = $rows['day'].$rows['month'].$rows['year'];
		$platea = $rows['truckid'];
		}

	?>

    </center>