<?php
session_start();
if(!isset ($_SESSION['username'])) {
    echo "<script> alert('Your session has expired.. Please login Again'); window.location('index.php')</script>";
}else {
    include('config.php');
    $checker=0;
    $supplier_id=$_POST['supplier_id'];
    $result=mysql_query("SELECT * FROM supplier_details where supplier_id='$supplier_id'");
    if($row = mysql_fetch_array($result)) {
        echo "<script> alert('Sorry.. This ID is already been assigned by another user.. System will redirect you back to the form and assign another ID number.. Thank you...'); window.location='formAddNewSupplier.php';</script>";

    }else {

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
        

        mysql_query("INSERT INTO supplier_details (supplier_id,supplier_name,classification,branch,bh_in_charge,address,owner,owner_contact,representative,representative_contact,no_of_trucks,plate_number,no_of_warehouse,warehouse_address,payable_online,bank,acct_name,acct_no,date_added,warehouse_add1,warehouse_add2,warehouse_add3,warehouse_add4,warehouse_add5)
                                            VALUES('$supplier_id','$supplier_name','$classification','$branch','$bh_in_charge','$address','$owner','$owner_contact','$representative','$representative_contact','$no_of_trucks','$plate_numbers','$no_of_wh','$wh_address','$payable_online','$bank','$acct_name','$acct_no','".date('Y/m/d')."','$wh_add1','$wh_add2','$wh_add3','$wh_add4','$wh_add5')");
        echo "<script> alert('Added Successfully...'); window.location='formAddNewSupplier.php';</script>";


    }
    


}
$query = "SELECT supplier_id,supplier_name FROM supplier_details group by supplier_id  ";
$result = mysql_query($query) ;
while($row = mysql_fetch_array($result)) {
    array_push($_SESSION['supplier_names_array'],$row['supplier_id']."+".$row['supplier_name']);

}
?>