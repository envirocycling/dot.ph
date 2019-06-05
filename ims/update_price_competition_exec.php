<?php
session_start();
include("config.php");

$company=$_POST['company'];
$wp_grade=$_POST['wp_grade'];
$price=$_POST['price'];
$date=$_POST['date'];
$branch_affected=$_POST['branch_affected'];
$company_type=$_POST['company_type'];
$updated_by=$_SESSION['username'];
$max_price=$_POST['max_price'];
$verified_by=$_POST['verified_by'];
$approved_by=$_POST['approved_by'];
$source=$_POST['source'];
if ($company == $branch_affected) {
    if ($company_type == 'competitor') {
        echo "<script>";
        echo "alert('Error! You cant insert your company as competitor!');";
        echo "window.history.back();";
        echo "</script>";
    } else {
        if(mysql_query("INSERT INTO pricing_against_competitors(company,wp_grade,price,date,branch_affected,company_type,updated_by,max_price,verified_by,approved_by,source)
                                            VALUES('$company','$wp_grade','$price','$date','$branch_affected','$company_type','$updated_by','$max_price','$verified_by','$approved_by','$source')")) {
            echo "<script>";

            echo "alert('Record has been inserted successfully...');";
            echo "window.history.back();";
            echo "</script>";
        }else {
            echo "<script>";
            echo "alert('Failed to insert record   ...');";
            echo "window.history.back();";
            echo "</script>";
        }
    }

} else {
    if(mysql_query("INSERT INTO pricing_against_competitors(company,wp_grade,price,date,branch_affected,company_type,updated_by,max_price,verified_by,approved_by,source)
                                            VALUES('$company','$wp_grade','$price','$date','$branch_affected','$company_type','$updated_by','$max_price','$verified_by','$approved_by','$source')")) {
        echo "<script>";

        echo "alert('Record has been inserted successfully...');";
        echo "window.history.back();";
        echo "</script>";
    }else {
        echo "<script>";
        echo "alert('Failed to insert record   ...');";
        echo "window.history.back();";
        echo "</script>";
    }
}

?>