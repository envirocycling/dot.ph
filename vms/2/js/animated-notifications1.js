$(window).load(function () {


	
function resize(){$('#notifications').height(window.innerHeight - 50);}
$( window ).resize(function() {resize();});
resize();


function refresh_close(){
$('.close').click(function(){$(this).parent().fadeOut(200);});
}
refresh_close();
 

var bottom_center = '<div id="notifications-bottom-right1-tab"><div id="notifications-bottom-right1-tab-close" class="close"><span class="iconb" data-icon="&#xe20e;"></span></div><div id="notifications-bottom-right1-tab-avatar"><img src="_assets/avatar.png" width="70" height="70" /></div><div id="notifications-bottom-right1-tab-right"><div id="notifications-bottom-right1-tab-right-title"><span>George</span> sent you a message</div><div id="notifications-bottom-right1-tab-right-text">This is a sample notification that <br> will appear the right bottom corner.</div></div></div>';


$( document ).ready(function() {

	$("#notifications-bottom-right1").html();
	$("#notifications-bottom-right1").html(bottom_center);
	$("#notifications-bottom-right1-tab").addClass('animated ' + $('#effects').val());
	refresh_close();
	
	
});



});