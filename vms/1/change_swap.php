<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
<?php
include('connect.php');
@$timezone=+8;
@$date= gmdate('Y-m-d',time() + 3600*($timezone+date("I")));


$txt = $_POST['dateadded'];
$dates = explode('-',$txt);

$y= gmdate('Y',time() + 3600*($timezone+date("I")));
$m1= gmdate('m',time() + 3600*($timezone+date("I")));
$d1= gmdate('d',time() + 3600*($timezone+date("I")));

if($m1 < 10){
	$m = substr($m1,1);
	}else { $m = $m1;}
	
if($d1 < 10){
	$d = substr($d1,1);
	}else { $d = $d1;}

$month1 = $dates[1];
if($month1 < 10){
	$month = substr($month1,1);
	}else { $month = $month1;}

$day1 = $dates[2];
if($day1 < 10){
	$day = substr($day1,1);
	}else { $day = $day1;}

 $y;
 $m;
 $d."<br>";
 $year = $dates[0];
 $month;
 $day;
if($y > $year)
{
$ms = $month + 12; 	
}else {
$ms = $month;	
}

if($ms > $m){
$tm = $ms - $m;
}else{
$tm = $m - $ms;
}
if($date > $d){
$td = $day - $d;
}else {
$td = $d - $day;	
}
$life = $tm."-".$td;

@$list = explode('-',$_POST['spare']);
@$truckid=$list[1];
@$tireid=$list[0];
@$list2 = explode('-',$_POST['inused']);
$swapto = $list2[0];
$name = mysql_query("Select * from tbl_users Where username='".$_SESSION['a_username']."'") or die (mysql_error());
$rowname = mysql_fetch_array($name);

$select = mysql_query("Select * from tbl_trucktires Where truckplate='".$_GET['p']."' And tireid='".$_POST['tireid']."'") or die(mysql_error());
$row = mysql_fetch_array($select);

if($_POST['radio'] == 'swap'){
	
	$swap = mysql_query("Insert into tbl_changeswaps (tirename,tireid,truckid,tiresize,description,reason,dateadded,addedby,swapto,remarks)
	Values ('".$_POST['tirename']."','".$_POST['tireid']."','".$_GET['p']."','".$_POST['tiresize']."','".$_POST['description']."','".$_POST['reason']."','".$_POST['dateadded']."','".$_POST['addedby']."','$swapto','".$_POST['radio']."') ")or die (mysql_error());
	
}else if($_POST['radio'] == 'change'){
		$change = mysql_query("Insert into tbl_changeswaps (tirename,tireid,truckid,tiresize,description,reason,dateadded,addedby,swapto,remarks,lifespan)
	Values ('".$_POST['tirename']."','".$_POST['tireid']."','".$_GET['p']."','".$_POST['tiresize']."','".$_POST['description']."','".$_POST['reason']."','".$_POST['dateadded']."','".$_POST['addedby']."','$truckid','".$_POST['radio']."','$life') ")or die (mysql_error());
	$delete = mysql_query("Delete from tbl_trucktires Where tireid='".$_POST['tireid']."' And truckplate='$truckid'")or die (mysql_error());

		$update = mysql_query("Update tbl_trucktires Set tireid ='".$_POST['tireid']."',dateadded='$date',addedby='".$rowname['Name']."',status ='In Used',position= '".$row['position']."' Where id='$tireid' And truckplate='".$_GET['p']."'")or die (mysql_error());

		
	}
	
	
	$selects = mysql_query("Select * from tbl_truck_report Where id='".$_GET['p']."'") or die (mysql_error());
$rows = mysql_fetch_array($selects);
$select = mysql_query("Select * from tbl_trucktires Where truckplate='".$_GET['p']."' And tireid='".$_POST['tireid']."'") or die(mysql_error());
$id = $rows['truckplate'];
$bodytype = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%motor%' And id='".$_GET['p']."' ") or die(mysql_error());
$wagon = mysql_query("Select * from tbl_truck_report Where bodytype LIKE '%wagon%' And id='".$_GET['p']."' ") or die(mysql_error());
$series = mysql_query("Select * from tbl_truck_report Where series LIKE '%mio%' And id='".$_GET['p']."' ") or die(mysql_error());
	if($rows['wheels'] == '6'){
	header("Location: maintenance_tire6.php?id=$id");}
	if($rows['wheels'] == '10'){
	header("Location: maintenance_tire.php?id=$id");}
	if($rows['wheels'] == '4'){
		if(mysql_num_rows($wagon) > 0){
			
	header("Location: other.php?id=$id");
			}else{
	header("Location: maintenance_tire4.php?id=$id");}}	
	if($rows['wheels'] = '2'){
		if(mysql_num_rows($bodytype) > 0){
			header("Location: motorcycle.php?id=$id");
			}else if(mysql_num_rows($series) > 0){
				header("Location: mio.php?id=$id");
				}
		}

?>

