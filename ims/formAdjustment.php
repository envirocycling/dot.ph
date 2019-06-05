<script>
	function negative(){
		var weight1 = Number(document.getElementById("weight").value);
			if( weight1 <= 0){
				alert("Weight cannot Less than Zero.");
				document.getElementById("weight").value='';
			}
	}
</script>
<?php
session_start();
include("config.php");
echo "<h5>Please encode your number of loose bales:<br/><hr>";
echo "<form action='encode_daily_loose.php' method='POST'>";
?>
Date: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d')?>" onfocus='date1(this.id);'><br>

<?php
echo "Branch: <input type='text' value='".$_SESSION['user_branch']."' name='branch' readonly><br>";

echo "Grade: <select name='wp_grade' required>";
$sql_material = mysql_query("SELECT * from material WHERE status=''") or die(mysql_error());
while($row_material = mysql_fetch_array($sql_material)){
    echo '<option value="'.$row_material['code'].'">'.$row_material['code'].'</option>';
}
echo '</select> <br>';
echo "Weight: <input type='text' onkeyup='negative();' id='weight' value='' name='loose_weight' required><br>";

echo "<input type='submit' value='Submit'>";
echo "</form>";
?>
