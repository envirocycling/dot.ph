<?php
session_start();
echo "<h5>Please encode your month-end loose bales: <br/><hr>";
echo "<form action='encode_buying_cost.php' method='POST'>";
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
echo "Grade: <input type='text' value='' name='wp_grade'><br>";
echo "Avg Cost: <input type='text' value='' name='avg_cost' size='5'><br>";

echo "<input type='submit' value='Submit'>";
echo "</form>";
?>
