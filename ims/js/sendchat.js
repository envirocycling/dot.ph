$(function() {
	$('#textb').click(function() {
		document.newMessage.textb.value = "";
	});
	
	$('#johnlei').click(function(){
		var from_id = $('#texta').val();
		var message = $('#textb').val();
		var to_id = $('#recipient').val();
		
		if (message == "" || message == "Enter your message here" || recipient == "" || recipient == "--Send Chat To--") {
			return false;
		}
		
		var dataString = 'from_id=' + from_id + '&message=' + message + '&to_id=' + to_id;
		
		$.ajax({
			type: "POST",
			url: "send_save_chat.php",
			data: dataString,
			success: function() {
				document.newMessage.textb.value = "";
			}
		});
	});
});