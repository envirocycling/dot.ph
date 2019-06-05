<center>
    <h2>Insert Start Volume</h2>
    <hr>
    <?php
    include("config.php");
    $que = $_GET['id'];
    $details = preg_split("/[_]/", $que);
    $supplier_id = $details[0];
    $truck_id = $details[1];
    $supplier_name = $details[2];
    $plate_number = $details[3];
  
    ?>
    <h3>EFI TRUCKS Starting Volume of <?php echo $supplier_id . "_" . $supplier_name; ?></h3>
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

</center>