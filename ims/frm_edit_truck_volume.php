<center>
    <h2>Edit Start Volume</h2>
    <hr>
    <?php
    include("config.php");

    if (isset($_GET['del_id'])) {
        $truck_id = $_GET['del_id'];
        mysql_query("UPDATE truck_rent SET starting_volume='', starting_volume_date='' WHERE truck_id='$truck_id'");
        echo "<script>";
        echo "alert('Deleted successfully...');";
        echo "window.close();";
        echo "</script>";
    }



    $que = $_GET['id'];
    $details = preg_split("/[_]/", $que);
    $supplier_id = $details[0];
    $truck_id = $details[1];
    $supplier_name = $details[2];
    $plate_number = $details[3];
    $volume = $details[4];
    $volume_date = $details[5];
    $volume_date = date("F", strtotime($volume_date));

   
    ?>
    <h3>EFI TRUCKS Starting Volume of <?php echo $supplier_id . "_" . $supplier_name; ?></h3>
    <h3><?php echo $volume_date; ?></h3>
    <h3>Starting Volume: <?php echo $volume; ?></h3>
    <h2>By Month</h2>
    <hr>

    <form action="insert_truck_volume_exec.php" method="POST">
        <input type="hidden" value="<?php echo $supplier_id; ?>" name="supplier_id">
        <input type="hidden" value="<?php echo $truck_id; ?>" name="truck_id">
        <select name="month">
            <option value="01/31">January</option>
            <option value="02/28">February</option>
            <option value="03/31">March</option>
            <option value="04/30">April</option>
            <option value="05/31">May</option>
            <option value="06/30">June</option>
            <option value="07/30">July</option>
            <option value="08/31">August</option>
            <option value="09/30">September</option>
            <option value="10/31">October</option>
            <option value="11/30">November</option>
            <option value="12/31">December</option>
        </select>

        <input type="submit" name="update" value="Update">

    </form>

    <a href="frm_edit_truck_volume.php?del_id=<?php echo $truck_id; ?>"><button>Delete Starting Volume</button></a>
</center>
