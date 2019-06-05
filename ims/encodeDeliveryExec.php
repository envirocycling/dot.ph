<?php
session_start();
include('config.php');
date_default_timezone_set('America/Los_Angeles');
$id=$_POST['supplier_id'];
$query="SELECT * from supplier_details where supplier_id='$id';";
$result=mysql_query($query);

$row = mysql_fetch_array($result);
$branch_delivered = $_POST['branch_delivered'];
$name = $row['supplier_name'];
$class = $row['classification'];
$branch = $row['branch'];
$bh = $row['bh_in_charge'];
$wp_grade=$_POST['wp_grade'];
$weight=$_POST['weight'];
$date_delivered=$_POST['date_delivered'];
$deliver_date_array=preg_split('[/]',$date_delivered);
if($deliver_date_array[1]=='01') {
    $month_delivered='January';
}else if($deliver_date_array[1]=='02') {
    $month_delivered='February';
}else if($deliver_date_array[1]=='03') {
    $month_delivered='March';
}else if($deliver_date_array[1]=='04') {
    $month_delivered='April';
}else if($deliver_date_array[1]=='05') {
    $month_delivered='May';
}else if($deliver_date_array[1]=='06') {
    $month_delivered='June';
}else if($deliver_date_array[1]=='07') {
    $month_delivered='July';
}else if($deliver_date_array[1]=='08') {
    $month_delivered='August';
}else if($deliver_date_array[1]=='09') {
    $month_delivered='September';
}else if($deliver_date_array[1]=='10') {
    $month_delivered='October';
}else if($deliver_date_array[1]=='11') {
    $month_delivered='November';
}else if($deliver_date_array[1]=='12') {
    $month_delivered='December';
}
$year_delivered=$deliver_date_array[0];
$day_delivered=$deliver_date_array[2];
$encoder=$_SESSION['username'];

if( $row['supplier_id'] != '') {
    if(mysql_query("INSERT INTO sup_deliveries(supplier_name,supplier_id,supplier_type,bh_in_charge,wp_grade,weight,branch_delivered,date_delivered,month_delivered,day_delivered,year_delivered,encoder)
                            VALUES('$name','$id','$class','$bh','$wp_grade','$weight','$branch_delivered','$date_delivered','$month_delivered','$day_delivered','$year_delivered','$encoder')

    ")) {
        $query2="SELECT * from incentive_scheme where sup_id='$id' and wp_grade='$wp_grade'  ;";
        $result2=mysql_query($query2);

        $row2 = mysql_fetch_array($result2);
        $toUpdate=$row2['current_deliveries']+$weight;
        
        mysql_query("UPDATE incentive_scheme SET current_deliveries ='$toUpdate' where sup_id='$id' and wp_grade='$wp_grade' and end_date >='$date_delivered' and start_date <='$date_delivered'");


        $_SESSION['insert_status']="<span id='success'>Inserted Successfully!!!</span>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }else {
        $_SESSION['insert_status']="<span id='error'>There was an error with the database... Please try again...</span>";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

}else {

    $_SESSION['insert_status']="<span id='error'>Please input a valid ID Number</span>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);


}
?>