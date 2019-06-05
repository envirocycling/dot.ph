<?php
@session_start();
include('templates/template.php');
include("configPhp.php");
?>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str) {
        new JsDatePick({
            useMode: 2,
            target: str,
            dateFormat: "%Y/%m/%d"

        });
    }
    ;

    function openWindow(str) {
        window.open("print_po.php?payment_id=" + str, 'mywindow', 'width=1020,height=600,left=150,top=20');
    }
</script>
<style>
    .inputs{
        font-size: 14px;
        width: 80px;
        height: 18px
    }
    .select{
        font-size: 14px;
        width: 100px;
        height: 18px
    }
    .submit{
        font-size: 14px;
        height: 23px;
    }
</style>
<div class="tabs">
    <div id="tab-1" class="tab">
        <h1>Processed POs</h1>
        <h5>Filtering Options.</h5>
        <form  method="post">
            <?php
            if (isset($_POST['submit'])) {
                ?>
                Date Range: <input class="inputs" type='text' id='inputField' name='from' value="<?php echo $_POST['from']; ?>" onfocus='date1(this.id);' readonly> TO <input class="inputs" type='text' id='inputField2' name='to' value="<?php echo $_POST['to']; ?>"onfocus='date1(this.id);' readonly>
                
                &nbsp;&nbsp;<input class="submit" type="submit" name="submit" value="Submit">

                <?php
            } else {
                ?>
                Date Range: <input class="inputs" type='text' id='inputField' name='from' value="<?php echo date("Y/m/d"); ?>" onfocus='date1(this.id);' readonly> TO <input class="inputs" type='text' id='inputField2' name='to' value="<?php echo date("Y/m/d"); ?>"onfocus='date1(this.id);' readonly>
               
                &nbsp;&nbsp;<input class="submit" type="submit" name="submit" value="Submit">
                <?php
            }
            ?>
        </form>

        <br>
        <table class="data display datatable" id="example">
            <article>

                <?php
                @session_start();
                if (isset($_POST['submit'])) {
                    $query = "SELECT * FROM payment WHERE status='processed' and date>='" . $_POST['from'] . "' and date<='" . $_POST['to'] . "' and branch_code like '%" . $_SESSION['branch'] . "%'  and printed='1'";
                } else {
                    $query = "SELECT * FROM payment WHERE status='processed' and printed='1' and date>='" . date('Y/m/d') . "' and date<='" .date('Y/m/d') . "' and branch_code like '%" . $_SESSION['branch'] . "%' ";
                }
                $result = mysql_query($query);
                echo "<thead>";
                echo "<th>Branch Code</th>";
                echo "<th>Supplier Name</th>";
                echo "<th>Acct. Name</th>";
                echo "<th>Voucher No.</th>";
                echo "<th>Amount</th>";
                echo "<th>Date_Time Printed</th>";
                echo "<th>Date_Time Processed </th>";
                echo "<th>Time Consumed</th>";
//                    echo "<th>Status</th>";
                echo "<th>Action</th>";
                echo "</thead>";
                while ($row = mysql_fetch_array($result)) {
                 
                    echo "<tr>";
                    echo "<td>" . $row['branch_code'] . "</td>";
                    echo "<td>" . $row['supplier_name'] . "</td>";
                    echo "<td>" . $row['account_name'] . "</td>";
                    echo "<td>" . $row['voucher_no'] . "</td>";
                    echo "<td>Php " . number_format($row['grand_total'], 2) . "</td>";
                    echo "<td>"; if((strtotime($row['printed_date'])) > 0){echo date('Y/m/d h:i A', strtotime($row['printed_date']));} echo "</td>";
                    echo "<td>";
                    if((strtotime($row['processed_date'])) > 0){echo date('Y/m/d h:i A', strtotime($row['processed_date']));}
                    echo "</td>";
                    echo '<td>';
 $date_chk = strtotime($row['printed_date']);              
$date1 = $row['printed_date'];
$date2 = $row['processed_date'];
$diff = abs(strtotime($date2) - strtotime($date1));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*24*60*60)/ (60*60));
$minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*24*60*60 - $hours*60*60)/ (60));

//$days = floor($time / (24*60*60));
//$hours = floor(($time - ($days*24*60*60)) / (60*60));
//$minutes = floor(($time - ($days*24*60*60)-($hours*60*60)) / 60);

if($date_chk > 0){printf('%d hr and %d min',$hours,$minutes);}

                    echo '</td>';
//                        if ($row['status'] == '') {
//                            echo "<td>pending</td>";
//                        } else {
//                            echo "<td>" . $row['status'] . "</td>";
//                        }
                     echo "<td><a rel='facebox' href='ifrm_cv.php?payment_id=" . $row['payment_id'] . "'><button>View</button></a> <button id=" . $row['payment_id'] . " onclick='openWindow(this.id);'>Print</button></td>";
                    echo "</tr>";
                }


                     
                
                ?>
        </table>

        </article>
    </div>




</div>
<?php include ('templates/footer.php'); ?>

