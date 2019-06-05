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
<h3>Paper Buying Manual Input</h3><hr>
<?php
echo "<form action='input_paper_buying.php' method='POST'>";
?>
Date: <input type='text'  id='inputField' name='date_received' value="" onfocus='date1(this.id);' readonly><br>

<?php
echo "Priority Number:<input type='text' value='' name='priority_number'><br>";
echo "Supplier ID:<input type='text' value='' name='supplier_id'><br>";
echo "Supplier Name:<input type='text' value='' name='supplier_name'><br>";
echo "Plate Number:<input type='text' value='' name='plate_number'><br>";
echo "WP Grade<input type='text' value='' name='wp_grade'><br>";
echo "Corrected Weight<input type='text' value='' name='corrected_weight'><br>";
echo "Unit Cost:<input type='text' value='' name='unit_cost'><br>";
echo "Paper Buying:<input type='text' value='' name='paper_buying'><br>";
echo "<input type='hidden' value='".$_GET['branch']."' name='branch'>";
echo "<input type='submit' value='Record'>";

echo "</form>";



?>