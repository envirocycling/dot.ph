<?php
$str=$_GET['str'];
$wp_grade=$_GET['wp_grade'];
echo "<h2>";
echo "<form action='upgrade_downgrade_exec.php' method='POST'>";
echo "Upgrade/Downgrade  <u><i>".$wp_grade."</i></u> to "."<input type='text' name='new_grade' ><br>";
echo "Pass Code:<input type='password' name='passcode' >";
echo "<input type='hidden' value='$wp_grade' name='old_grade'>";
echo "<input type='hidden' value='$str' name='str'>";
echo "<br><input type='submit' value='Update'>";

echo "</form>";




?>