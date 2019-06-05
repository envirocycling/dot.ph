<script>
    function openMessage(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("message2.php?from_id="+str,'mywindow','width=380,height=480');
    }

    function sendMessage(str){
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("send_message.php",'mywindow','width=300,height=200');
    }
</script>
<h2>Messages</h2>

<?php
include 'config.php';
$sql = mysql_query("SELECT * FROM messages WHERE to_id='lonlon' and to_noti='0' GROUP BY from_id");
while($rs = mysql_fetch_array($sql)) {
    $sql_c = mysql_query("SELECT * FROM messages WHERE to_id='lonlon' and from_id='".$rs['from_id']."' and to_noti='0'");
    $count = mysql_num_rows($sql_c);
    echo $rs['from_id']." ".$count." unread message &nbsp;&nbsp;&nbsp;&nbsp; <a id='".$rs['from_id']."' onclick='openMessage(this.id);'>Click here</a><br>";
}

echo "<a  onclick='sendMessage(this.id);'>Send new message</a>";
?>