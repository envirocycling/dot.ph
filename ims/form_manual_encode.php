<?php
include 'config.php';

?>

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
    <h3>Encode Receiving</h3>
    <form action="manual_encode_receiving.php" method="POST">
    <table>
        <tr>
            <td><h3>Select Date: </h3></td>
            <td><input type='text' id='inputField' name='date' value="" onfocus='date1(this.id);' placeholder="Select Date" required></td>
        </tr>
        <tr>
            <td><h4>Input Quantity: </h4></td>
            <td><input type='text' name='count' value="" placeholder="Input Quantity" required></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type='submit' name='submit' value="Submit"></td>
        </tr>
    </table>
    </form>

</center>