<?php
include 'config.php';
$c = $_POST['ctr'];
$from = $_POST['from'];
$to = $_POST['to'];
$branch = $_POST['branch'];
$chk_branch = strtoupper($_POST['branch']);
$group = $_POST['group'];
$ctr = 0;
$dr_number = $_POST['dr_number'];

while ($ctr < $c) {
    if (isset ($_POST['cv_'.$ctr])) {
        $log_id = $_POST['cv_'.$ctr];
        
        if($chk_branch == 'PAMPANGA'){
            mysql_query("UPDATE paper_buying SET ref_no='$dr_number',status='billed',date_billed='".date("Y/m/d")."' WHERE log_id='$log_id'");
        }else{
            mysql_query("UPDATE paper_buying SET dr_number='$dr_number',status='billed',date_billed='".date("Y/m/d")."' WHERE log_id='$log_id'");
        }
    }
    $ctr++;
}

echo "<script>
    location.replace('tipco_multiply_billings.php?submit=1&from=$from&to=$to&branch=$branch&group=$group');
</script>";

?>
