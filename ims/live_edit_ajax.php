<?php
include("config.php");
if($_POST['id']) {
    $supplier_id=mysql_escape_String($_POST['id']);
    $supplier_name = mysql_escape_String($_POST['supplier_name']);
    $classification = mysql_escape_String($_POST['classification']);
    $owner = mysql_escape_String($_POST['owner']);
    $owner_contact = mysql_escape_String($_POST['owner_contact']);
    $street = mysql_escape_String($_POST['street']);
    $municipality  = mysql_escape_String($_POST['municipality']);
    $province = mysql_escape_String($_POST['province']);

//    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
//    $rs_sup = mysql_fetch_array($sql_sup);
//    if ($rs_sup['classification'] != $classification) {
//        if ($rs_sup['classification_history'] == '') {
//            $history = $rs_sup['classification']."_".$classification."|".date("Y/m/d");
//        } else {
//            $history = $rs_sup['classification_history']."_".$classification."|".date("Y/m/d");
//        }
//        $sql = "UPDATE supplier_details SET supplier_name='$supplier_name',
//        classification='$classification',
//        classification_history='$history',
//        owner='$owner',
//        owner_contact='$owner_contact',
//        street = '$street',
//        municipality = '$municipality',
//        province = '$province',
//        style = '$classification'
//        WHERE supplier_id='$supplier_id'";
//        mysql_query($sql);
//    } else {

    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
    $rs_sup = mysql_fetch_array($sql_sup);

    if ($rs_sup['classification'] != $classification) {
        mysql_query("INSERT INTO sup_class_movement (`supplier_id`, `classification`, `date`)
                VALUES ('$supplier_id','$classification','".date("Y/m/d")."')");
    }

    if ($rs_sup['classification'] != $classification || $rs_sup['owner'] != $owner || $rs_sup['owner_contact'] != $owner_contact
            || $rs_sup['street'] != $street || $rs_sup['municipality'] != $municipality || $rs_sup['province'] != $province) {

        $sql = "UPDATE supplier_details SET supplier_name='$supplier_name',
        classification='$classification',
        owner='$owner',
        owner_contact='$owner_contact',
        street = '$street',
        municipality = '$municipality',
        province = '$province',
        date_updated = '".date("Y/m/d")."'
        WHERE supplier_id='$supplier_id'";
        mysql_query($sql);
    }
//    }




}
?>