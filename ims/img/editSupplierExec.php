<?php
session_start();
if(!isset ($_SESSION['username'])) {
    echo "<script> alert('Your session has expired.. Please login Again'); window.location('index.php')</script>";
}else {
    include('config.php');
    $supplier_id=$_POST['supplier_id'];
    $supplier_name=$_POST['supplier_name'];
    $classification=$_POST['classification'];
    $branch=$_POST['branch'];
    $bh_in_charge=$_POST['bh_in_charge'];
    $address=$_POST['street']."/".$_POST['municipality']."/".$_POST['province'];
    $owner=$_POST['owner'];
    $owner_contact=$_POST['owner_contact'];
    $representative=$_POST['representative'];
    $representative_contact=$_POST['representative_contact'];
    $no_of_trucks=$_POST['no_of_trucks'];
    $plate_numbers=$_POST['plate_numbers'];

    $no_of_wh=$_POST['no_of_wh'];
    $wh_address=$_POST['wh_address'];
    $payable_online=$_POST['payable_online'];
    $bank=$_POST['bank'];
    $acct_name=$_POST['acct_name'];
    $acct_no=$_POST['acct_no'];

    $wh_add1 = $_POST['wh_st1']."/".$_POST['wh_city1']."/".$_POST['wh_prov1'];
        $wh_add2 = $_POST['wh_st2']."/".$_POST['wh_city2']."/".$_POST['wh_prov2'];
        $wh_add3 = $_POST['wh_st3']."/".$_POST['wh_city3']."/".$_POST['wh_prov3'];
        $wh_add4 = $_POST['wh_st4']."/".$_POST['wh_city4']."/".$_POST['wh_prov4'];
        $wh_add5 = $_POST['wh_st5']."/".$_POST['wh_city5']."/".$_POST['wh_prov5'];


    mysql_query("UPDATE supplier_details SET supplier_name='$supplier_name',classification='$classification',branch='$branch',bh_in_charge='$bh_in_charge',address='$address',owner='$owner',owner_contact='$owner_contact',representative_contact='$representative_contact',representative='$representative',no_of_trucks='$no_of_trucks',plate_number='$plate_numbers',no_of_warehouse='$no_of_wh',warehouse_address='$wh_address',payable_online='$payable_online',bank='$bank',acct_name='$acct_name',acct_no='$acct_no',warehouse_add1='$wh_add1',warehouse_add2='$wh_add2',warehouse_add3='$wh_add3',warehouse_add4='$wh_add4',warehouse_add5='$wh_add5' WHERE supplier_id='$supplier_id'");
   // mysql_query("UPDATE sup_deliveries SET supplier_name='$supplier_name',supplier_type='$classification',bh_in_charge='$bh_in_charge' WHERE supplier_id='$supplier_id'");
        

    echo "<script> alert('Updated Successfully...Kindly refresh the list once your done updating your records'); window.close();</script>";







}

?>	