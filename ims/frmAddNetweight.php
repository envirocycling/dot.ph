<?php
session_start();
$str= $_GET['str'];
$wp_grade=$_GET['wp_grade'];
include('config.php');
$result=mysql_query("SELECT * FROM outgoing where str='$str' and wp_grade='$wp_grade'");
while($row=mysql_fetch_array($result)) {
    $date= $row['date'];
    $plate_number= $row['plate_number'];
}

?>
<script>
       function f_weight(){
           var net = Number(document.getElementById('net_weight').value);
           if(net <= 0){
               alert('Net weight must greater than 0');
               document.getElementById('net_weight').value = '';
           }
       }
       
       function f_weight2(){
           var net = Number(document.getElementById('corrected_weight').value);
           if(net <= 0){
               alert('Corrected weight must greater than 0');
               document.getElementById('corrected_weight').value = '';
           }
       }
</script>
<form action="addnetweight.php" method="POST">
    <?php
    echo "<input type='hidden' value='$str' name='str'>";
    echo "<input type='hidden' value='$date' name='date'>";
    echo "<input type='hidden' value='$plate_number' name='plate_number' >";

    echo "<h2>".$str."</h2>";
    echo "<hr/>";
    echo "Delivered to: <input type='text' value='' name='delivered' required><br>";
    echo "Branch: <input type='text' value='".$_SESSION['user_branch']."' name='branch' readonly><br>";

    echo "WP Grade: <input type='text' value='$wp_grade' name='wp_grade' readonly  size=3 ><br>";
    echo "Net Weight (kg): <input type='text' value='' name='net_weight' onkeyup='f_weight()' id='net_weight' size=3 required><br>";

    echo "Moisture (kg): <input type='text' value='' name='mc' size=3 ><br>";
    echo "Dirt (kg): <input type='text' value='' name='dirt' size=3 ><br>";
    echo "Corrected Weight (kg): <input type='text' value='' onkeyup='f_weight2()' id='corrected_weight' name='corrected_weight' size=3 required><br>";

    $dr_number=preg_split("/[_]/",$str);
    $dr_number=$dr_number[1];
    echo "<input type='hidden' value='$dr_number' name='dr_number' >";
    ?>
    <input type="submit" value="Record">
</form>