<?php
include 'config.php';
if (isset ($_POST['to_id'])) {
    $to_id = $_POST['to_id'];
    $message = $_POST['message'];
    $date = date("Y/m/d h:i A");
    if ($to_id=='all_ic') {
        $sql_to_id = mysql_query("SELECT * FROM users WHERE position='Inventory Controller'");
        while ($rs_to_id = mysql_fetch_array($sql_to_id)) {
            mysql_query("INSERT INTO messages(from_id, to_id, content, time)
            VALUES
            ('lonlon' , '".$rs_to_id['user_id']."', '$message', '$date')");
        }
        echo "<script>";
        echo "alert('Successfully Send.');";
        echo "window.close();";
        echo "</script>";
    } else if ($to_id=='all_bh') {
        $sql_to_id = mysql_query("SELECT * FROM users WHERE position='Branch Head'");
        while ($rs_to_id = mysql_fetch_array($sql_to_id)) {
            mysql_query("INSERT INTO messages(from_id, to_id, content, time)
            VALUES
            ('lonlon' , '".$rs_to_id['user_id']."', '$message', '$date')");
        }
        echo "<script>";
        echo "alert('Successfully Send.');";
        echo "window.close();";
        echo "</script>";
    } else if ($to_id=='all_users') {
        $sql_to_id = mysql_query("SELECT * FROM users");
        while ($rs_to_id = mysql_fetch_array($sql_to_id)) {
            mysql_query("INSERT INTO messages(from_id, to_id, content, time)
            VALUES
            ('lonlon' , '".$rs_to_id['user_id']."', '$message', '$date')");
        }
        echo "<script>";
        echo "alert('Successfully Send.');";
        echo "window.close();";
        echo "</script>";
    } else {
        mysql_query("INSERT INTO messages(from_id, to_id, content, time)
        VALUES
        ('lonlon' , '$to_id', '$message', '$date')");
        echo "<script>";
        echo "alert('Successfully Send.');";
        echo "window.close();";
        echo "</script>";
    }
}

echo "<form method='POST' action='send_message.php'>";
echo "To:";
$sql = mysql_query("SELECT * FROM users");
echo "<select name='to_id'>";
echo "<option value='all_ic'>All IC</option>";
echo "<option value='all_bh'>All BH</option>";
echo "<option value='all_users'>All Users</option>";
while ($rs = mysql_fetch_array($sql)) {
    echo "<option value='".$rs['user_id']."'>".$rs['user_id']."</option>";
}
echo "</select>";
echo "<br>";
echo "<textarea name='message' placeholder='Enter your message here'></textarea>";
echo "<br>";
echo "<input type='submit' name='send' value='Send'>";
echo "</form>";

?>