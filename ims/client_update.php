<?php
include("config.php");
$update = $_GET['update'];
$url = 'http://10.151.16.231/export_receiving.php';
if($update == 'price'){
$error = 0;
$ctr = $_POST['ctr'];
$exec_ctr = 0;
    while($exec_ctr < $ctr){
        echo $wp_grade = $_POST['material_'.$exec_ctr];
        echo '+';
        echo $price = $_POST['price_'.$exec_ctr];
        echo '+';
        echo $client_id = $_POST['cid_'.$exec_ctr];
        echo '+';
        echo $date_effective = date('Y-m-d', strtotime($_POST['dateeffective_'.$exec_ctr]));

            $sql_chk = mysql_query("SELECT * from client_price WHERE date_effective='$date_effective' and material_id='$wp_grade' and client_id='$client_id'") or die(mysql_error());

            if(mysql_num_rows($sql_chk) == 0 && $price > 0){
                if(mysql_query("INSERT INTO client_price (client_id, material_id, price, date_effective) VALUES('$client_id', '$wp_grade', '$price', '$date_effective')") or die(mysql_error())){
                }else{
                    $error++;
                }
            }else if($price > 0){
                if(mysql_query("UPDATE client_price SET price='$price' WHERE date_effective='$date_effective' and material_id='$wp_grade' and client_id='$client_id'") or die(mysql_error())){
                }else{
                    $error++;
                }
            }

        $exec_ctr++;
    }
    if($error == 0){
        echo '<script>
            window.top.location.href="'.$url.'?update=c_success";
        </script>';  
    }else{
        echo '<script>
            window.top.location.href="'.$url.'?update=c_error";
        </script>'; 
    }
}else if($update == 'name'){
$error = 0;
$ctr = $_POST['ctr'];

$exec_ctr = 0;
    while($exec_ctr < $ctr){
         $name = $_POST['name_'.$exec_ctr];
         $desc = $_POST['desc_'.$exec_ctr];
         $client_id = $_POST['cid_'.$exec_ctr];

            $sql_chk = mysql_query("SELECT * from client WHERE cid='$client_id'") or die(mysql_error());

            if(mysql_num_rows($sql_chk) == 0){
                if(mysql_query("INSERT INTO client (cid, client_name, description) VALUES('$client_id', '$name', '$desc')") or die(mysql_error())){
                }else{
                    $error++;
                }
            }else{
                if(mysql_query("UPDATE client SET client_name='$name', description='$desc' WHERE cid='$client_id'") or die(mysql_error())){
                }else{
                    $error++;
                }
            }

        $exec_ctr++;
    }
    if($error == 0){
        echo '<script>
            window.top.location.href="'.$url.'?update=n_success";
        </script>';  
    }else{
        echo '<script>
            window.top.location.href="'.$url.'?update=n_error";
        </script>'; 
    }
}
?>