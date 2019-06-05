<link rel="stylesheet" href="css/styles.css">
<?php
include('connect.php');
?>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/select2.min.js" type="text/javascript"></script>
<script src="css/select2.min.css" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('[name="type[]"]').select2();
    });
</script>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }</script>
<script>
    function caps(element) {
        element.value = element.value.toUpperCase();
    }


</script>
<br />
<center>
    <h3>Change Oil Update</h3>
    <br />
    <br />

    <form action="changeoilupdatetrans.php?id=<?php echo $_GET['id']; ?>" method="post" >
        <table width="400">
            <tr>
                <td>Date: </td>
                <td><input type="date" id="text" name="date" style="width:100%" required></td>
            </tr>
            <tr>
                <td>Performed By: </td>
                <td><input type="text" id="text" name="performedby" style="width:100%"  onKeyUp="caps(this)"  required></td>
            </tr>
            <tr>
                <td>Odometer / HRM: </td>
                <td><input type="text" id="text" name="from" style="width:100%"  onKeyPress="return isNumber(event)" ></td>
            </tr>
            <?php
            if (@strtoupper($_GET['class']) == 'HE') {
                ?>
                <tr>
                    <td>Type:</td>
                    <td>
                        <select name="type[]" multiple="multiple" style="width: 100%;" required>
                            <option value="engine_oil">Engine Oil</option>
                            <option value="atf">ATF</option>
                            <option value="gear_oil">Gear Oil</option>
                            <option value="hydraulic_oil">Hydraulic Oil</option>
                            <option value="coolant">Coolant</option>
                        </select>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td>Remarks: </td>
                <td><textarea name="remarks" id="text" cols="22" rows="5"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td align="right"><br /><br /><input type="submit" id="button" value="Submit" ></td>
            </tr>
        </table>
    </form>
</center>