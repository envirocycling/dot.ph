<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>

<h1>Backload Delivery </h1>
<?php
$del_id=$_GET['del_id'];
include('config.php');
echo "<form action='backload_exec.php' method='POST'>";
$query="SELECT * from sup_deliveries where del_id=$del_id";
$result=mysql_query($query);

while($row = mysql_fetch_array($result)) {
    echo "Supplier ID: ".$row['supplier_id']."<br>";
    echo "Supplier Name: ".$row['supplier_name']."<br>";
    echo "WP Grade: ".$row['wp_grade']."<br>";
    echo "Weight: ".$row['weight']."<br>";
}

echo "<hr>";
echo "<input type='hidden' value='$del_id' name='del_id' size=5><br>";
?>
Date: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly><br>

<?php
echo "Backload weight: <input type='text' value='' name='weight' onkeypress='return isNumberKey(event)' size=5><br>";
echo "Remarks: <input type='text' value='BACKLOAD' name='remarks' size=30><br>";
echo "<input type='submit' value='Record'>";
echo "</form>";


?>