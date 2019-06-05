<?php include("templates/template.php");?>
<style>
    #summary_per{
        float:right;

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

<?php
function secondsToWords($seconds) {
    /*** return value ***/
    $ret = "";
    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0) {
        if($hours<10) {
            $ret .= "0$hours:";
        }else {
            $ret .= "$hours:";
        }
    }else {
        $ret .= "0$hours:";
    }
    $minutes = fmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0) {
        if($minutes<10) {
            $ret .= "0$minutes";
        }else {
            $ret .= "$minutes";
        }
    }

    if($minutes==0) {
        $ret .= "0$minutes";
    }


    /*** get the seconds ***/
    $seconds = fmod(intval($seconds),60);


    return $ret;
}


function secondsToWords2($seconds) {
    /*** return value ***/
    $ret = "";

    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0) {
        if($hours<10) {
            $ret .= "0$hours:";
        }else {
            $ret .= "$hours:";
        }
    }else {
        $ret .= "0$hours:";
    }
    $minutes = fmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0) {
        if($minutes<10) {
            $ret .= "0$minutes";
        }else {
            $ret .= "$minutes";
        }
    }

    if($minutes==0) {
        $ret .= "0$minutes";
    }


    /*** get the seconds ***/
    $seconds = fmod(intval($seconds),60);


    return $ret;
}



function sec_to_time($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor($seconds % 3600 / 60);
    $seconds = $seconds % 60;

    return sprintf("%02d:%02d", $minutes, $seconds);
}


?>


<style>

    #positive{
        color:green;
        font-weight: bold;
        background-color:#FF9340;
    }
    #negative{
        color:red;
        font-weight: bold;
        background-color:#FF9340;
    }

    #zero{

        font-weight: bold;
        background-color:#FF9340;
    }
    #net{
        font-weight:bold;
        background-color:#33CCFF;
    }
    #from_location{
        font-weight:bold;
        background-color:#29A6CF;
    }
    #dr{
        font-weight:bold;
        background-color:#33CCCC;
    }
    #mc{
        background-color: #85E0FF;
    }
    #dirt{
        background-color: #00B8E6;
    }
    #corrected{
        background-color: yellow;
        font-weight:bold;
    }
    #total{
        background-color: yellow;
        font-weight:bold;
    }
</style>
<?php
if(isset($_GET['branch'])) {
    $branch=$_GET['branch'];
    $date_from=$_GET['from'];
    $date_to=$_GET['to'];
}
else {
    $branch=$_POST['branch'];
    $date_from=$_POST['from'];
    $date_to=$_POST['to'];
}
?>
<div class="grid_3">
    <div class="box round first grid">
        <h2>Bale Wire (Weight in Kg)</h2>

        <form action="bale_wire_add.php" method="POST">
            <input type="hidden" name="branch" value="<?php echo $branch; ?>">
            <input type="hidden" name="from" value="<?php echo $date_from; ?>">
            <input type="hidden" name="to" value="<?php echo $date_to; ?>">
            Date Used: <input type='text' id='inputField2' name='date' value="" onfocus='date1(this.id);' readonly required><br>
            Weight: <input type='text' name='qty' value="" required><br>
            Transaction Type:
            <select name="txn" required>
                <option value="Issue">Issue</option>
                <option value="Receive">Receive</option>
            </select><br>
            Brand:
            <select name="brand" required>
                <option value="CBK">CBK</option>
                <option value="ICON">ICON</option>
            </select><br>
            Bale Wire Type:
            <select name="type" required>
                <option value="2.8">2.8</option>
                <option value="3.0">3.0</option>
            </select><br>

            <input type="submit" value="Add">
        </form>


    </div>
</div>

<div class="grid_7">
    <div class="box round first">
        <h2>Transaction Log</h2>
        <table class="data display datatable" id="example">
            <thead>
                <tr class='data'>
                    <?php
                    echo "<th>Date Used</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Transaction</th>";
                    echo "<th>Brand</th>";
                    echo "<th>Type</th>";
                    ?>
                </tr>
            </thead>
            <?php
            $query=mysql_query("SELECT * FROM bale_wire WHERE branch like '%$branch%' and date_use >= '$date_from' and date_use<='$date_to' ORDER BY log_id DESC");
            while ($row = mysql_fetch_array($query)) {
                echo "<tr>";
                echo "<td>".$row['date_use']."</td>";
                echo "<td>".$row['quantity']."</td>";
                echo "<td>".$row['transaction_type']."</td>";
                echo "<td>".$row['brand']."</td>";
                echo "<td>".$row['bale_wire_type']."</td>";
                echo "</tr>";
            }

            ?>
        </table>
    </div>
</div>

<div class="grid_7">
    <div class="box round first">
        <h2>Inventory</h2>
        <table class="data display datatable" id="example">
            <thead>
                <tr class='data'>
                    <?php
                    echo "<th>Type</th>";
                    echo "<th>In</th>";
                    echo "<th>Out</th>";
                    echo "<th>Actual</th>";
                    ?>
                </tr>
            </thead>
            <?php
            $query=mysql_query("SELECT * FROM bale_wire WHERE branch LIKE '%$branch%' and date_use >= '$date_from' and date_use<='$date_to' GROUP BY bale_wire_type ");
            $count = mysql_num_rows($query);
            if($count>=1) {
                while ($row = mysql_fetch_array($query)) {
                    $sql = mysql_query("SELECT sum(quantity) FROM bale_wire WHERE branch LIKE '%$branch%' and date_use >= '$date_from' and date_use<='$date_to' and bale_wire_type = '".$row['bale_wire_type']."' and transaction_type = 'Receive' ORDER BY log_id DESC");
                    $in = mysql_fetch_array($sql);
                    $sql2 = mysql_query("SELECT sum(quantity) FROM bale_wire WHERE branch LIKE '%$branch%' and date_use >= '$date_from' and date_use<='$date_to' and bale_wire_type = '".$row['bale_wire_type']."' and transaction_type = 'Issue' ORDER BY log_id DESC");
                    $out = mysql_fetch_array($sql2);
                    $sql3 = mysql_query("SELECT sum(quantity) FROM bale_wire WHERE branch LIKE '%$branch%' and date_use >= '$date_from' and date_use<='$date_to' and bale_wire_type = '".$row['bale_wire_type']."' and transaction_type = 'Receive' ORDER BY log_id DESC");
                    $pin = mysql_fetch_array($sql3);
                    $sql4 = mysql_query("SELECT sum(quantity) FROM bale_wire WHERE branch LIKE '%$branch%' and date_use<='$date_to' and bale_wire_type = '".$row['bale_wire_type']."' and transaction_type = 'Issue' ORDER BY log_id DESC");
                    $pout = mysql_fetch_array($sql4);
                    $actual = $pin['sum(quantity)'] - $pout['sum(quantity)'];
                    echo "<tr>";
                    echo "<td>".$row['bale_wire_type']."</td>";
                    echo "<td>".$in['sum(quantity)']."</td>";
                    echo "<td>".$out['sum(quantity)']."</td>";
                    echo "<td>".$actual."</td>";
                    echo "</tr>";
                }
            }

            ?>
        </table>
    </div>
</div>


<div class="clear">

</div>

<div class="clear">

</div>