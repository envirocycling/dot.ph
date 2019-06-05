<style>
    body{
        font-size:30px;
        padding:100px;
    }
    input{
        font-size:30px;

    }
    button{
        font-size:30px;
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
session_start();
$branch=$_SESSION['user_branch'];
echo "Transaction Type: Delete Bales<br>";
echo "Branch : $branch";
?>
        <form action="delete_bales.php" method="POST">
            From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly>
            TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly>
			<input type="hidden" value="<?php echo $branch; ?>"  name="branch">
            <input type="submit" value="Delete" onclick="return confirm('Do you want to Proceed?');">
        </form>
<?php

echo "<a href='bm_prod_report.php'><button>Back</button></a>";
?>