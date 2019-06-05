<style>
    body{
        background-color: #2e5e79;
    }
    div {
        background-color: white;
        font-family: arial;
        font-size: 20px;
        height: 200px;
        width: 350px;
        border: 2px solid;
        border-radius: 25px;
    }
    button{
        font-size: 15px;
        height: 30px;
        width: 100px;
    }
</style>
<?php
include 'config.php';
$sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$_GET['sup_id']."'");
$rs = mysql_fetch_array($sql);
echo "<center>";
echo "<br><br><br><br><br>";
echo "<div align='center'>";
echo "<br><br>";
echo "SUPPLIER ID OF ".$rs['supplier_name'].":";
echo "<br>";

?>
<font size="8" color="blue">"<?php echo $rs['supplier_id']; ?>"</font>
<?php
echo "<br>";
echo "<a href='formAddNewSupplier.php'><button>OK</button></a>";
echo "</div>";
echo "</center>";

?>
