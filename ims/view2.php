<style>
    p{
        border-top: 1px solid #EEEEEE;
        margin-top: 0px; margin-bottom: 5px; padding-top: 5px;
    }
</style>
<?php
session_start();
$user_id = $_SESSION['username'];
$from_id = $_SESSION['from_id'];
require_once 'config.php';
mysql_query("UPDATE messages SET to_noti='1' WHERE to_id='$user_id'");
$sql = mysql_query("SELECT * FROM messages WHERE (from_id='$from_id' and to_id='$user_id') or (from_id='$user_id' and to_id='$from_id') ORDER BY msg_id ASC");
while ($row = mysql_fetch_array($sql)) {

    $user = '<strong style="color:blue;">'.$row['from_id'].'</strong>';

    $hourAndMinutes = $row['time'];

    echo '<p>'.$user.':<em>('.$hourAndMinutes.')</em>'.'<br/>'.' '.'<img src="Images/img2/spechbubble_sq_line.png" width="10" height="10">'.' '. $row['content']. '</p>';
}

?>