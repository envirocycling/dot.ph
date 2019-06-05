<style>
    #total{
        font-weight:bold;
        background-color: yellow;

    }
</style>
<?php
include('config.php');
$str_no=$_GET['str_no'];
$query = "SELECT * FROM bales where str_no='$str_no'";
$result = mysql_query($query);

echo "<h3><u>".$str_no."</u> Packing List</h3>";
echo "<table border=1>";
echo "<th>Bale_ID</th>";
echo "<th>WP Grade</th>";
echo "<th>Weight</th>";
$total_count=0;
$total_weight=0;
while($row = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['bale_id']."</td>";
    echo "<td>".$row['wp_grade']."</td>";
    echo "<td>".$row['bale_weight']."</td>";
    echo "</tr>";
    $total_count++;
    $total_weight=$total_weight+$row['bale_weight'];
}
echo "<tr>";
echo "<td id='total'>TOTAL</td>";
echo "<td id='total'>$total_count"." Bales"."</td>";
echo "<td id='total'>$total_weight</td>";
echo "</tr>";
echo "</table>";
echo "<a href='void_packing_list.php?str_no=".$str_no."'><button>Void</button></a>";
echo "<a href='bale_list.php'><button>Done</button></a>";
?>