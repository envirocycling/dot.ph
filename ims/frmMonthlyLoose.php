<script>
	function negative(){
		var weight1 = Number(document.getElementById("weight").value);
			if( weight1 <= 0 ){
				alert("Weight cannot Less than Zero.");
				document.getElementById("weight").value='';
			}
			var weight1 = (document.getElementById("weight").value);
			if( weight1 == '-' ){
				alert("Weight cannot be Negative.");
				document.getElementById("weight").value='';
			}
	}
</script>
<?php
session_start();
include("config.php");
echo "<h5>Please encode your month-end loose bales: <br/><hr>";
echo "<form action='monthlylooseexec.php' method='POST'>";
?>

Month : <select name="month" value="">
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="06">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
</select>

Year: <input type="text" value="" size="3" name="year"><br>
<?php
echo "Branch: <input type='text' value='".$_SESSION['user_branch']."' name='branch' readonly><br>";
echo "Grade: <select name='wp_grade' required>";
$sql_material = mysql_query("SELECT * from material WHERE status=''") or die(mysql_error());
while($row_material = mysql_fetch_array($sql_material)){
    echo '<option value="'.$row_material['code'].'">'.$row_material['code'].'</option>';
}
echo '</select> <br>';
echo "Weight: <input type='text' value='' onkeyup='negative()' id='weight' name='loose_weight' required><br>";

echo "<input type='submit' value='Submit'>";
echo "</form>";
?>
