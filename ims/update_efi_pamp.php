<script src="js/jquery.min.js" type="text/javascript"></script>
<style>
    body{
        background-color: #2e5e79;
    }
    div {
        background-color: white;
        font-family: arial;
        font-size: 20px;
        height: 200px;
        width: 450px;
        border: 2px solid;
        border-radius: 25px;
    }
    button{
        font-size: 15px;
        height: 30px;
        width: 100px;
    }
</style>

<center>
    <br><br><br><br><br>
    <div align='center'>

        <table>
            <tr height="15px">
                <td align="center"><h1>Exporting Data to EFI System.</h1>
                    <img src="images/ajax-loader.gif">
                </td>
            </tr>
            <tr height="15px">
                <td align="center"><br><font color='red'><h3>Please don't close this window.</h3></font><br>
                </td>
            </tr>
        </table>

    </div>
</center>
<?php
include 'config.php';
$branch = $_POST['branch'];
$lcurl = $_POST['url'];

$sql = mysql_query("SELECT * FROM monthly_target WHERE ps_update='0' ORDER BY log_id ASC LIMIT 1");
$rs = mysql_fetch_array($sql);

if (mysql_num_rows($sql) > 0) {
    $log_id = $rs['log_id'];
    $month = $rs['month'];
    $branch = $rs['branch'];
    $wp_grade = $rs['wp_grade'];
    $target = $rs['target'];
    echo '<form action="http://' . $lcurl . '" method="POST" name="myForm">';
    echo '<input type = "hidden" name = "month" value = "' . $month . '">';
    echo '<input type = "hidden" name = "branch" value = "' . $branch . '">';
    echo '<input type = "hidden" name = "wp_grade" value = "' . $wp_grade . '">';
    echo '<input type = "hidden" name = "target" value = "' . $target . '">';
    echo '</form >';

    mysql_query("UPDATE monthly_target SET ps_update='1' WHERE log_id='$log_id'");

    echo '<script>';
    echo 'document.myForm.submit();';
    echo '</script>';
} else {
    echo "else";
    echo '<form action="http://' . $lcurl . '" method="POST" name="myForm">';
    echo '<input type = "hidden" name = "noitem" value = "">';
    echo '</form >';

    echo '<script>';
    echo 'document.myForm.submit();';
    echo '</script>';
}
?>