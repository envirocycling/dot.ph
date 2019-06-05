<link rel="stylesheet" type="text/css" media="all" href="../../jsDatePick_ltr.min.css" />
<script type="text/javascript" src="../../jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%n/%d"

        });
    };


</script>



<?php
$grade= $_GET['grade'];
echo "<h3>Change Price </h3>";
echo "<form action='../../updatePriceExec.php' method='POST'>";
echo "<input type='hidden' value='$grade' name='grade'>";
echo "Date of Effectivity: <input type='text'  id='inputField' name='date_of_effectivity' onfocus='date1(this.id);' readonly><br>";

echo "TIPCO's Price: <input type='text' name='tipco_price' value=''><br>";
echo "Competitor 1's Price: <input type='text' name='competitor_price' value=''><br>";
echo "Competitor 2's Price: <input type='text' name='competitor2_price' value=''><br>";
echo "Total Sales: <input type='text' name='total_sales' value=''><br>";
echo "Remarks: <input type='text' name='remarks' value=''><br>";
echo "<input type='submit' value='Update'>";
echo "</form>";


?>