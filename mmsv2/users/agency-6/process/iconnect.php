
<?php
$con = mysqli_connect('localhost', 'efi_db_manpower', 'Enviro101');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con, "efi_db_manpower");
