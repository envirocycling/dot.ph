
<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

<link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("select.country").change(function(){
        var selectedCountry = $(".country option:selected").val();
       if(selectedCountry == 2){
		   document.getElementById('branch').hidden=false;
		   }else {
		   document.getElementById('branch').hidden=true;
		   }
    });
});
</script>
<script>
function isNumbers(evt) {
       var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
}</script>
<?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
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
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
 <?php // type numbers only==================================================================?>
<script>
function isNumbers(evt) {
       var ew = event.which;
    if(ew == 32)
        return true;
    if(48 <= ew && ew <= 57)
        return true;
    if(65 <= ew && ew <= 90)
        return true;
    if(97 <= ew && ew <= 122)
        return true;
    return false;
}</script>
<script>
function true() {
       if(document.getElementById('type').value=2){
		   document.getElementById('branch').hidden=false;
		   }else {
			   document.getElementById('branch').hidden=true;
			   }
}
       </script>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>

<?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
<img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li><a href="new_truck.php">New Vehicle</a></li>
   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li ><a href='maintenance.php'>Maintenance</a></li>
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
      <li ><a href='inventory.php'>Inventory</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            <li  class='active'><a href='otheraccount.php'>Other Account</a></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br />
<br />

<center>
	<br />

		<table>
			<tr>
				<td align="center" colspan="2"><h3>Other Account</h3></td>
                <td></td>
            </tr>
  </table>
  <br /><br />
  <form action="add_usertrans.php" method="post">
  <table>
  <tr>
  <td>Name:</td>
  <td><input type="text" name="name"  id="text" onKeyUp="caps(this)"  required></td>
  </tr>
  <tr>
  <td>Username:</td>
  <td><input type="text" name="username"  id="text"   required></td>
  </tr><tr>
  <td>Password:</td>
  <td><input type="password" name="password" required></td>
  </tr>
  <tr>
  <td>User Type:</td>
  <td><select name="type" id="type" class="country">
   <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
   <option value="4">4</option>
  </select></td>
  </tr>
  <tr id="branch" hidden="" >
  <td>Branch:</td>
  <td><select name="branch">
  <?php 
  include('connect_out.php');
  $select = mysql_query("Select * from branches") or die (mysql_error());
  while($row = mysql_fetch_array($select)){?>
  <option value="<?php echo strtoupper($row['branch_name']);?>"><?php echo strtoupper($row['branch_name']);?></option>
  <?php }
  ?>
  </select></td>
  </tr>
  <tr>
  <td align="right" colspan="2"><br /><input type="submit" value="Add User Account"> 
	</td>
    </tr>
  </table>
  </form>
  <br /><br /><br />
  <table width="50%" >
  <tr>
  <td align="left"><h4>Users</h4></td>
  </tr>
  </table>
  <form action="" target="_self" method="post">
    <input type="submit" value="Search" name="text">
  <?php if(isset($_POST['text'])){?>
<input  type="text" name="key" value="<?php echo $_POST['key'];?>"  id="text" onKeyUp="caps(this)"  placeholder="Type Here"><?php }else {?>
 <input type="text" name="key" placeholder="Type Here"  id="text" onKeyUp="caps(this)" ><?php }?>
  </form>
  <table width="50%">
  <tr>
  <td>
  <table class="CSSTableGenerator">
  <tr>
  <td>Name</td>
  <td  width="30%">Username</td>
   <td>Type</td>
  <td width="10%">Action</td>
  </tr>
  <?php
include('connect.php');

$records_per_page = 50;


(@!$_GET['start'])?$start=0 : $start = $_GET['start'];
if(isset($_POST['text'])){
	$key = $_POST['key'];
$query = "SELECT count(*) FROM tbl_users Where  Name LIKE '%$key%' And type != '1' And type != '0' or username LIKE '%$key%'  And type != '1' And type != '0'";
}else{$query = "SELECT count(*) FROM tbl_users Where type != '1'";}
$result = mysql_query($query) or die("Error in query : $query".mysql_error());
$row = mysql_fetch_row($result);
$total_records = $row[0];

if(($total_records > 0) && ($start < $total_records))
{
		if(isset($_POST['text'])){
	$query = "Select * from tbl_users Where Name LIKE '%$key%' And type != '1' And type != '0' or username LIKE '%$key%'  And type != '1' And type != '0' ORDER BY ID ASC LIMIT $start,$records_per_page";
		}else{	$query = "Select * from tbl_users Where type != '1' ORDER BY ID ASC LIMIT $start,$records_per_page";}
	$result = mysql_query($query) or die(mysql_error());
	$count = 1;
?>
                                              
                                              
  <?php


while($row=mysql_fetch_array($result))
  
  {
  $class = ($count%2 == 1)?'even':'odd';
		$count++;
  ?>
                                              
	  <tr>
      <td><?php echo $row['Name'];?></td>
      <td><?php echo $row['username'];?></td>
         <td width="7%"><?php echo $row['type'];?></td>
      <td><a href="edit_user.php?id=<?php echo $row['id'];?>" rel="facebox"><input type="button" value="Edit"></a></td>
      </tr><?php
  }
}
  
  ?>
  </table>
  </td>
  </tr>
  </table>
  </br></br>

    <center>
 <?php

		if($start>=$records_per_page)
		{
			echo "<td align='center'>
			<a href=".$_SERVER['PHP_SELF']."?start=".($start-$records_per_page).">
			<img src='../img/pre.png' width='18' heigth='18' ></a></td>&nbsp;&nbsp;&nbsp;";
		}
	



		if(($start+$records_per_page<$total_records)&&($start>=0))
		{
			echo "<td align='center'>
			<a href=".$_SERVER['PHP_SELF']."?start=".($start+$records_per_page).">
			<img src='../img/next.png' width='18' heigth='18' ></a></td>";
			
		}
	
			
		
		for($i=1;$i<=1;$i++)
		{$num=($start/$records_per_page)+1;
		$num1=($start/$records_per_page);
		if($num1==0)
		{

			echo "<br><b><font color='red'>$num</b><br>";
			}else {echo "<center><b><font color='red'>$num</b></center>";}
			}
		?>
</center>

  
  
  	<br />
    	<br />
        	<br />
            	<br />
                
<img style="vertical-align:bottom" src="../image/footer.png" height="8%" width="100%">
</center>

</body>
</html>