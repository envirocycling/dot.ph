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
    #character_desc{
        border-style:hidden;
        font-style:italic;
        color:red;
        text-align: center;
    }
    img{
        height:100px;
        width:100px;
    }
</style>
<center>
    <h2>Update Supplier Capacity </h2>
    <?php
    $parameter=$_GET['parameter'];
    $parameter=preg_split("/[_]/",$parameter);
    $id=$parameter[0];
    $grade=$parameter[1];
    $calculated_tons_we_are_not_getting=$parameter[2];
    include ('config.php');
    echo "<h3>Update Supplier Capacity of Supplier ID: $id on Grade: $grade</h3>";
    $query = "SELECT * FROM supplier_capacity where supplier_id='$id' and wp_grade='$grade' order by date_effective desc limit 1  ";
    $result = mysql_query($query) ;
    $tons_we_are_not_getting='';
    $capacity='';
    $delivers_to='';
    $competitors_price='';
    $date_effective='';
    while($row = mysql_fetch_array($result)) {
        $tons_we_are_not_getting=$row['potential_to_lose'];
        $capacity=$row['capacity'];
        $delivers_to=$row['delivers_to'];
        $competitors_price=$row['competitor_price'];
        $date_effective=$row['date_effective'];
    }

    ?>
    <hr>
    <form action="edit_capacity_exec.php" method="POST">
        <?php
        echo "<input type='hidden' value='$id' name='supplier_id'>";
        echo "<input type='hidden' value='$grade' name='wp_grade'>";

        ?>

        Capacity:<input type="text" value="<?php echo $capacity; ?>" name="capacity"><br>
        Delivers TO:<input type="text" value="<?php echo $delivers_to; ?>" name="delivers_to"><br>
        Competitor's Price: <input type="text" value="<?php echo $competitors_price;?>" name="competitor_price"><br>

        Tons We are Not Getting: <input type="text" value="<?php echo $calculated_tons_we_are_not_getting; ?>" name="potential_to_lose" readonly><br>
        Date Effective: <input type='text'  id='inputField' name='date_effective' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly><br>

        <input type="submit" value="Update">

    </form>

</center>