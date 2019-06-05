<?php

session_start();
include('connect.php');

$user = mysql_query("Select * from tbl_users Where username='".$_SESSION['encoder_username']."'  ") or die (mysql_error());
$user_row = mysql_fetch_array($user);

$tid = mysql_query("Select * from tbl_forrepair Where truckid='".$_GET['id']."' and name!='' Order by id Asc") or die(mysql_error());
while($row= mysql_fetch_array($tid)){
?>
<script>
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}
</script>
<?php
if($user_row['Name'] == $row['name'])
{ ?>
<style>
.user{ 
float:right;
background:#FFFFFF;
color:#000000;
border:2px solid #EB0505;
border-radius:43px ;
font-size:16px ;
width: 300px ;
padding: 10px ;
box-shadow: 0px 1px 13px #E30404; 
-webkit-box-shadow: 0px 1px 13px #E30404; 
-moz-box-shadow: 0px 1px 13px #E30404; 
}
.name{
	float:right;	
	}
.table{
   position:absolute;
   bottom:0;	
	}
</style>
<table width="100%">
<tr>
<td><div class="name"><?php echo "<b> <font size='-1'>".strtoupper($row['name'])."</b><font size='-1'>".$row['datetime']."</font>"?></div></td>
</tr>
<tr><td>
<textarea onclick="textAreaAdjust(this)" style="overflow:hidden"  class="user" readonly="readonly"><?php echo $row['text'];?></textarea>
</td>
</tr>
</table>
<br />
<?php
 }else{ ?>

<style>
.user1{ 
background:#FFFFFF;
color:#000000;
border:2px solid #0E72ED;
border-radius:36px ;
font-size:15px ;
width: 300px ;
padding: 10px ;
box-shadow: 1px 1px 29px #054094; 
-webkit-box-shadow: 1px 1px 29px #054094; 
-moz-box-shadow: 1px 1px 29px #054094; 
}
.table{
   position:absolute;
   bottom:0;	
	}

</style>
<table width="100%">
<tr>
<td><div ><?php echo "<b> <font size='-1'>".strtoupper($row['name'])."</b><font size='-1'>".$row['datetime']."</font>"?></div></td>
</tr>
<tr><td>
<textarea onclick="textAreaAdjust(this)" style="overflow:hidden"  class="user1" readonly="readonly"><?php echo $row['text'];?></textarea>
</td>
</tr>
</table>
<br/ >
<?php
}
?>


<?php }?>

