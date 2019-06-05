<?php session_start(); ?>
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
    input{
        font-size: 15px;
    }
    select{
        font-size: 15px;

    }
    textarea{
        font-size: 15px;
        text-align:left;
    }
</style>
<?php
include("config.php");
$sql = mysql_query("SELECT * FROM fund_req WHERE log_id='".$_GET['check_req_id']."'");
$rs = mysql_fetch_array($sql);
?>
<center>
    <form action="submit_edit_fundreq.php" method="POST" enctype='multipart/form-data'>
        <h2>
            Fund Requisition
            <hr>
            <input type="hidden" name="log_id" value="<?php echo $_GET['check_req_id']; ?>">
            Payee: <input type="text" value="<?php echo $rs['payee']; ?>" name="payee"><br>
            Date Submitted: <input type="text" value="<?php echo date('Y/m/d');?>" name="date_submitted" readonly><br>
            Amount: <input type="text" value="<?php echo $rs['amount']; ?>" name="amount"><br>

            Date of Check:  <input type='text'  id='inputField2' name='date_of_check' value="<?php echo $rs['date_of_check']; ?>" onfocus='date1(this.id);'  readonly><br>
            Breakdown:<br>
            <textarea cols="60" rows="20" name="breakdown">
                <?php echo $rs['breakdown']; ?>
            </textarea><br>
            Prepared By: <input type="text" value="<?php echo $rs['prepared_by']; ?>" name="prepared_by">

            <?php
            include("config.php");
            echo "Audited By: <select name='audited_by'>";
            if ($_SESSION['branch'] == 'Cavite' || $_SESSION['branch'] == 'Kaybiga') {
                echo "<option value='CRC'>CRC</option>";
            }
            if ($_SESSION['branch'] == 'Sauyo' || $_SESSION['branch'] == 'Mangaldan' || $_SESSION['branch'] == 'Urdaneta') {
                echo "<option value='KAA'>KAA</option>";
            }
            if ($_SESSION['branch'] == 'Pampanga' || $_SESSION['branch'] == 'Makati' || $_SESSION['branch'] == 'Pasay') {
                echo "<option value='KLB'>KLB</option>";
            }
            if ($_SESSION['branch'] == 'Calamba' || $_SESSION['branch'] == 'Cainta') {
                echo "<option value='NDB'>NDB</option>";
            }
            echo "</select>";
            ?>

            Approved By: <input type='text' name='approved_by' value='LLR' readonly>

            <input type="hidden" value="<?php echo $_SESSION['username']; ?>" name="submitted_by"><br>
            Attachment: <input type="file" name="attachment"><br><br>
            <br><input type="submit" value="Submit">
        </h2>
    </form>
</center>