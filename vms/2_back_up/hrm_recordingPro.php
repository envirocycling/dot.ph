<link rel="stylesheet" href="css/styles.css">
<?php
include('connect.php');
$id = $_GET['id'];
?>
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
    <h3>HRM Recording</h3>
    <br />
    <br />

    <form action="hrm_recordingProNext.php?id=<?php echo $id;?>" method="post" >
        <table width="300">
            <tr>
                <td>Date: </td>
                <td><input type="date" id="text" name="date" style="width:100%" required></td>
            </tr>
            <tr>
                <td>HRM: </td>
                <td><input type="text" id="text" name="hrm" style="width:100%"  onKeyPress="return isNumber(event)" required></td>
            </tr>
            <tr>
                <td>Remarks: </td>
                <td><textarea name="remarks" id="text" style="width:100%" rows="5"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td align="right"><br /><br /><input type="submit" id="button" value="Submit" name="submit" ></td>
            </tr>
        </table>
    </form>
</center>