
<?php
include('connect.php');
$sen= mysql_query("Select * from tbl_contract Where status LIKE 'pending%' Order by id Asc ")or die (mysql_error());
$count = mysql_num_rows($sen);
?>
<html>
<link href="css/Icomoon/style.css" rel="stylesheet" type="text/css" />
<link href="css/animate2.css" rel="stylesheet" type="text/css" />
<link href="css/animated-notifications2.css" rel="stylesheet" type="text/css" />
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
 

var bottom_center = '<div id="notifications-bottom-right2-tab" style="background-color:#1C1C1C"><div id="notifications-bottom-right2-tab-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div><div id="notifications-bottom-right2-tab-avatar"><a href="terminated_contract.php?page=contract"><img src="../icon/truck.png" width="70" height="70" /></a></div><div id="notifications-bottom-right2-tab-right"><div id="notifications-bottom-right2-tab-right-title"><span>Pre-Terminated Contract</span></div><div id="notifications-bottom-right2-tab-right-text"><font size="+1"><?php echo $count."  ";?></font>Pending Request. <font size="-1">(Click the Image to View.)</font></div></div></div>';


$( document ).ready(function() {

	$("#notifications-bottom-right2").html();
	$("#notifications-bottom-right2").html(bottom_center);
	$("#notifications-bottom-right2-tab").addClass('animated ' + $('#effects').val());
	refresh_close();
	
	
});



});
</script>

</head>
<body >

  <div id="notifications-bottom-right2"></div>
    
      <input type="hidden" id="position"  value="botom_center">
      <input type="hidden" id="effects" value="fadeInLeft">    


</body>
</html>
