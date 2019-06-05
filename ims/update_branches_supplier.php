<style>
    body{
        background-color: #2e5e79;
    }
    div {
        background-color: white;
        font-family: arial;
        font-size: 20px;
        height: 200px;
        width: 450px;
        border: 2px solid;
        border-radius: 25px;
    }
    button{
        font-size: 15px;
        height: 30px;
        width: 100px;
    }
</style>

<center>
    <br><br><br><br><br>
    <div align='center'>

        <table>
            <tr height="15px">
                <td align="center"><h1>Exporting Supplier's Data to TS System.</h1>
                    <img src="images/ajax-loader.gif">
                </td>
            </tr>
            <tr height="15px">
                <td align="center"><br><font color='red'><h3>Please don't close this window.</h3></font><br>
                </td>
            </tr>
        </table>

    </div>
</center>

<?php
include 'config.php';
$branch = $_POST['branch'];
$lcurl = $_POST['url'];

$sql_sup = mysql_query("SELECT * FROM supplier_details WHERE branch='$branch' and up='0' ORDER BY supplier_id DESC LIMIT 1");
$rs_sup = mysql_fetch_array($sql_sup);
//    `supplier_id``supplier_name``owner_name``owner_contact``street``municipality``province`
$supplier_id = $rs_sup['supplier_id'];
$supplier_name = $rs_sup['supplier_name'];
$owner_name = $rs_sup['owner'];
$owner_contact = $rs_sup['owner_contact'];
$street = $rs_sup['street'];
$municipality = $rs_sup['municipality'];
$province = $rs_sup['province'];
?>
<form action="http://localhost/ts/update_supplier.php" method="POST" name="myForm">
    <input type="hidden" name="supplier_id" value="<?php echo $supplier_id; ?>">
    <input type="hidden" name="supplier_name" value="<?php echo $supplier_name; ?>">
    <input type="hidden" name="branch" value="<?php echo $branch; ?>">
    <input type="hidden" name="owner_name" value="<?php echo $owner_name; ?>">
    <input type="hidden" name="owner_contact" value="<?php echo $owner_contact; ?>">
    <input type="hidden" name="street" value="<?php echo $street; ?>">
    <input type="hidden" name="municipality" value="<?php echo $municipality; ?>">
    <input type="hidden" name="province" value="<?php echo $province; ?>">
</form>
<?php
mysql_query("UPDATE supplier_details SET up='1' WHERE supplier_id='$supplier_id'");
?>
<script>
    document.myForm.submit();
</script>