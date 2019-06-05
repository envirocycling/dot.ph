<style>
    #borderless{
        border-style:hidden;
    }
</style>
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
<style>
    body{
        font-size: 30px;
    }
    input{
        font-size: 30px;
    }
</style>
<center>
    <h1>
<h3>Mark as  Rebaled </h3>
<hr>
<?php
$bale_id=$_GET['bale_id'];
include("config.php");
$query="SELECT  * FROM bales where log_id=$bale_id";
$result=mysql_query($query);
while($row = mysql_fetch_array($result)) {
    echo "Are you sure you want to delete this bale?<br>";
    echo "<form action='deleteBale.php' method='POST'>";
    echo "Bale ID:<input id='borderless' type='text' value='".$row['bale_id']."' name='bale_id' readonly ><br>";
    echo "WP Grade:<input id='borderless'  type='text' value='".$row['wp_grade']."' name='wp_grade'  readonly><br>";
    echo "Weight:<input id='borderless'  type='text' value='".$row['bale_weight']."' name='bale_weight'  readonly><br>";
    echo "<input id='borderless'  type='hidden' value='$bale_id' name='log_id'  readonly>";
    echo "<hr>";
    ?>
Date Rebaled: <input type='text'  id='inputField' name='date_rebaled' value="<?php echo date('Y/m/d')?>" onfocus='date1(this.id);' readonly><br>

    <?php
    echo "<input type='hidden' value='a' name='passcode'><br>";
    echo "<input type='submit' value='Rebale'>";
    echo "</form>";

}
?>