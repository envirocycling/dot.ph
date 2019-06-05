<?php
session_start();
echo "<h5>Adjustments:<br/><hr>";
echo "<form action='adjustment_exec.php' method='POST'>";
?>
Date: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d')?>" onfocus='date1(this.id);'><br>

<?php
echo "Branch: <input type='text' value='".$_SESSION['user_branch']."' name='branch' readonly><br>";

echo "Desc: <input type='text' value='' name='desc' size='30'><br>";
echo "WP Grade: <input type='text' value='' name='wp_grade' size='5'><br>";
echo "Weight: <input type='text' value='' name='adjustment'  size='5'><br>";

echo "<input type='submit' value='Submit'>";
echo "</form>";
?>
