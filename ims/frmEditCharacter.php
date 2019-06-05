<script>
    //    function chooseCharacter(data) {
    //        var desc="Loyal Consolidator";
    //        var image="<img src='loyal.jpg'>";
    //        if(data=="C1"){
    //            desc="Loyal Consolidator";
    //            image="<img src='loyal.jpg'>";
    //        }else if(data=="C2"){
    //            desc="Price Driven Consolidator";
    //            image="<img src='price_driven.jpg'>";
    //        }else if(data=="T1"){
    //            desc="Loyal Trader";
    //            image="<img src='loyal.jpg'>";
    //        }else if(data=="T2"){
    //            desc="Price Driven Trader";
    //            image="<img src='price_driven.jpg'>";
    //        }else if(data=="J1"){
    //            desc="Loyal Junkshop";
    //            image="<img src='loyal.jpg'>";
    //        }else if(data=="J2"){
    //            desc="Price Driven Junkshop";
    //            image="<img src='price_driven.jpg'>";
    //        }else{
    //            desc="No discription to show";
    //        }
    //        document.getElementById ("character_desc").value =desc ;
    //        document.getElementById ("imagehere").innerHTML =image ;
    //    }
    function changeclass(val)
    {
        var classi = document.getElementById('classdummy').value;
        if (classi != val){
            document.getElementById('reason').disabled = false;
        } else {
            document.getElementById('reason').disabled = true;
            document.getElementById('reason').value = '';
        }
    }
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
<?php
include 'config.php';
$sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$_GET['id']."'");
$rs = mysql_fetch_array($sql);
?>
<center>
    <h2><?php echo $rs['supplier_name']; ?>
        <br>
        Update Supplier Classification </h2>
    <hr>
    <form action="edit_character_exec.php" method="POST">

        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="supplier_id">
        <input type="hidden" id="classdummy" name="classdummy" value="<?php echo $rs['classification'];?>">
        Select Character: <select name="character" value="" onchange="changeclass(this.value);">
            <?php

            echo "<option value='".$rs['classification']."'>".$rs['classification']."</option>";
            ?>
            <option value='PM'>PM</option>
            <option value='C1'>C1</option>
            <option value='C2'>C2</option>
            <option value='C3'>C3</option>
            <option value='T1'>T1</option>
            <option value='T2'>T2</option>
            <option value='T3'>T3</option>
            <option value='J1'>J1</option>
            <option value='J2'>J2</option>
            <option value='J3'>J3</option>
            <option value='S1'>S1</option>
            <option value='S2'>S2</option>
            <option value='S3'>S3</option>
        </select>
        <br>
        Reason:<select id="reason" name="reason"  disabled="true" required>
            <option value=""></option>
            <option value="Incorrect Classification">Incorrect Classification</option>
            <option value="Diverted to EFI">Diverted to EFI</option>
            <option value="Diverted to EFI Suppliers">Diverted to EFI Suppliers</option>
            <option value="Diverted to Competitors">Diverted to Competitors</option>
        </select>
        <br>
        <!-- <br> <span id="imagehere">

        </span><i><br> <input type="text" value="No discription to show" name="character_desc" id="character_desc" size="25"></i><br>

        -->
        <input type="submit" value="Update">

    </form>

</center>