<?php
@session_start();
$branch = $_SESSION['branch'];
$ref_no =($_GET['q']);

//$con = mysqli_connect('localhost','root','');
$con = mysqli_connect("localhost", "efi_purchasing", "Hesoyams18");
if (!$con) {
    die('Error, please contact your system administrator: ' . mysqli_error($con));
}

mysqli_select_db($con,"efi_purchasing");

$sql_chk = mysqli_query($con, "SELECT * from check_req WHERE ref_no='$ref_no' and status != 'cancelled' and status != 'disapproved' and branch_submitted='$branch' ") or die(mysqli_error());
if(mysqli_num_rows($sql_chk) > 0){
    echo "<font size='-1'  color='red'><i><b>Third Party Reference number is already exist.";
    
echo '<script>
  $(".ref_no2").val("");
</script>';

}
mysqli_close($con);
?>