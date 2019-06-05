<script>
	function negative(){
		var weight1 = Number(document.getElementById("weight").value);
			if( weight1 <= 0){
				alert("Weight cannot Less than Zero.");
				document.getElementById("weight").value='';
			}
	}
</script>
<h3>Edit Bale Details</h3>
<hr>
<?php
$bale_id=$_GET['bale_id'];
include("config.php");
$query="SELECT  * FROM bales where log_id=$bale_id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {

    echo "<form action='editBaleExec.php' method='POST'>";
    echo "Bale ID:<input type='text' value='".$row['bale_id']."' name='bale_id' required><br>";
    echo "WP Grade:<input type='text' value='".$row['wp_grade']."' name='wp_grade' required><br>";
    echo "Weight:<input type='text' id='weight' onkeyup='negative()' value='".$row['bale_weight']."' name='bale_weight' required><br><br>";
   /* echo "<hr>";
    echo "Please ask your immediate supervisor  to enter his code<br>";
    echo "Supervisor Code: <input type='password' value='' name='passcode'><br>";
    echo "<input type='hidden' value='$bale_id' name='log_id'>";
   */ echo "<input type='submit' value='Update'>";
    echo "</form>";
	
}
?>