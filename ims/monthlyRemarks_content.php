<style >

 
    #form{
        border-style:dashed;
        text-align:center;
    }
    th{
        border-right:solid;
        border-bottom:solid;
    }
    td{

        border-right:solid;
        border-bottom:solid;
        border-width:1px;
    }
</style>
<?php
session_start();
$filtering=$_GET['id'];
$url=$filtering;
$filtering=preg_split("/[_]/",$filtering);
$sup_id=$filtering[0];
$month=date('m',strtotime($filtering[1]));
$year=$filtering[2];
$date=$year."/".$month;
include('config.php');

$result=mysql_query("SELECT * FROM supplier_details where  supplier_id=$sup_id ");
if($row=mysql_fetch_array($result)) {
    echo "<center><h2><u>".$row['supplier_name']."</u>&nbsp;".$filtering[1]."&nbsp; Remarks</h2></center>";
}
echo "<center>============================================================</center>";

$result=mysql_query("SELECT * FROM monthly_remarks where supplier_id='$sup_id' order by log_id desc");
echo "<table>";
echo "<th>Date Input</th>";
echo "<th>User ID</th>";
echo "<th>WP Grade</th>";
echo "<th>Subject</th>";
echo "<th>Content</th>";
while($row=mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['date_inputed']."</td>";
    echo "<td><i><b>".$row['user_id']."</b></i></td>";
    echo "<td>".$row['wp_grade']."</td>";
    echo "<td><i><b>".$row['subject']."</b></i></td>";
    echo "<td><i>".$row['remarks']."</i></td>";
    echo "</tr>";

}
echo "</table>";
echo "<form action='insert_monthly_remarks.php' method='POST' id='form'>";
echo "<h3>Input Remarks Here: </h3><hr>";
$user_id=$_SESSION['username'];
if(!empty($user_id)) {
    echo "Username: <input type='text' value='$user_id' name='user_id' readonly><br>";
}else {
    echo "Username: <input type='text' value='' name='user_id' ><br>";

}
echo "<input type='hidden' value='$sup_id' name='supplier_id'>";
echo "<input type='hidden' value='$url' name='url'>";
echo "Date: <input type='text' value='$date' name='date' readonly><br>";
echo "Subject :<input type='text' value='' name='subject'><br>";

include("config.php");
$query = "SELECT * FROM wp_grades ";
$result = mysql_query($query) ;
echo "WP Grade:";
$dropdown = "<select name='wp_grade' >";
$dropdown .= "\r\n<option value=''>All Grades</option>";
$dropdown .= "\r\n<option value=''>__________</option>";
while($row = mysql_fetch_array($result)) {
    $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
}
$dropdown  .= "</select><br>";
echo $dropdown;




echo "Remarks:<br>";
echo "<textarea cols='38' rows='4' name='remarks'></textarea><br>";
echo "<input type='submit' value='Submit'>";
echo "</form>";
?>

