
<?php
include('connect.php');

$selected = mysql_query("Select * from tbl_reassign Where approved='1'")or die (mysql_error());
if(mysql_num_rows($selected) > 0){
	$message = "Pending To Accept Receiving Truck";
}else{
	$message = "Pending Receiving Truck";
}

$receciveing= mysql_query("Select * from tbl_reassign Where suppliername='".$_SESSION['owner']."' ")or die (mysql_error());
$count = mysql_num_rows($receciveing);
?>
<html>
<link href="_css/Icomoon/style.css" rel="stylesheet" type="text/css" />
<link href="_css/animate1.css" rel="stylesheet" type="text/css" />
<link href="_css/animated-notifications1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="_scripts/jquery-2.0.2.min.js1"></script>
<script type="text/javascript" src="_scripts/jquery-ui-1.10.4.min.js1"></script>
<script>
$(window).load(function () {


	
function resize(){$('#notifications').height(window.innerHeight - 50);}
$( window ).resize(function() {resize();});
resize();


function refresh_close(){
$('.close').click(function(){$(this).parent().fadeOut(200);});
}
refresh_close();
 
var bottom_center = '<div id="notifications-bottom-right1-tab" style="background-color:#1C1C1C"><div id="notifications-bottom-right1-tab-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div><div id="notifications-bottom-right1-tab-avatar"><a href="truck_reassign.php"><img src="../image/truck.png" width="70" height="70" /></a></div><div id="notifications-bottom-right1-tab-right"><div id="notifications-bottom-right1-tab-right-title"><span>Truck Reassignment</span></div><div id="notifications-bottom-right1-tab-right-text"><font size="+1"><?php echo $count."  ";?></font><?php echo $message;?>. <font size="-1">(Click the Image to View.)</font></div></div></div>';


$( document ).ready(function() {

	$("#notifications-bottom-right1").html();
	$("#notifications-bottom-right1").html(bottom_center);
	$("#notifications-bottom-right1-tab").addClass('animated ' + $('#effects').val());
	refresh_close();
	

});



});
</script>

</head>
<body >

  <div id="notifications-bottom-right1"></div>
    
      <input type="hidden" id="position"  value="botom_center">
      <input type="hidden" id="effects" value="fadeInLeft">    


</body>
</html>
