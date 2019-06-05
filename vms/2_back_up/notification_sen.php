
<?php
include('connect.php');

$sen= mysql_query("Select * from tbl_reassign Where name='".$_SESSION['owner']."' and approved='0' ")or die (mysql_error());
$count = mysql_num_rows($sen);
?>
<html>
<link href="css/Icomoon/style.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/animated-notifications.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-2.0.2.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.10.4.min.js"></script>
<script>
$(window).load(function () {


	
function resize(){$('#notifications').height(window.innerHeight - 50);}
$( window ).resize(function() {resize();});
resize();


function refresh_close(){
$('.close').click(function(){$(this).parent().fadeOut(200);});
}
refresh_close();
 

var bottom_center = '<div id="notifications-bottom-right-tab" style="background-color:#1C1C1C"><div id="notifications-bottom-right-tab-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div><div id="notifications-bottom-right-tab-avatar"><a href="truck_reassign.php"><img src="../icon/truck.png" width="70" height="70" /></a></div><div id="notifications-bottom-right-tab-right"><div id="notifications-bottom-right-tab-right-title"><span>Truck Reassignment</span></div><div id="notifications-bottom-right-tab-right-text"><font size="+1"><?php echo $count."  ";?></font>Pending Reassign Truck. <font size="-1">(Click the Image to View.)</font></div></div></div>';


$( document ).ready(function() {

	$("#notifications-bottom-right").html();
	$("#notifications-bottom-right").html(bottom_center);
	$("#notifications-bottom-right-tab").addClass('animated ' + $('#effects').val());
	refresh_close();
	
	
});



});
</script>

</head>
<body >

  <div id="notifications-bottom-right"></div>
    
      <input type="hidden" id="position"  value="botom_center">
      <input type="hidden" id="effects" value="fadeInLeft">    


</body>
</html>
