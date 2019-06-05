<?php

ini_set('max_execution_time', 1000000);
include 'config.php';
$branch_url = '192.168.1.6';
$c = $_POST['ctr'];
$failed_to_insert = 0;
$ctr = 0;
$counter = 0;
while ($ctr < $c) {
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='" . $_POST['supplier_id' . $ctr] . "'") or die (mysql_error());
    $rs_sup = mysql_fetch_array($sql_sup);
    $supplier_id = $_POST['supplier_id' . $ctr];
     $branch = $_POST['branch' . $ctr];
     
     
    

    $supplier_name = $rs_sup['supplier_name'];
    $classification = $rs_sup['classification'];
    $bh_ic_charge = $rs_sup['bh_in_charge'];
    $priority_no = $_POST['priority_no' . $ctr];
    $wp_grade = $_POST['wp_grade' . $ctr];

    if ($wp_grade == 'HM.M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'HM.MW') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'MW.PLAYING CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CORETUBE M.WASTE') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CARDS') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'MW-PPQ') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'CT') {
        $wp_grade = 'MW';
    }
    if ($wp_grade == 'HM.OCC') {
        $wp_grade = 'OCC';
    }
    if ($wp_grade == 'CB') {
        $wp_grade = 'CHIPBOARD';
    }
    if ($wp_grade == 'STICKIES LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL PADJ') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL STICKIES') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'GUMS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL FLEXO' || $wp_grade == 'LCWL Flexo') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCWL BOOKS') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'BOOKS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'BOOKS LCWL') {
        $wp_grade = 'LCWL';
    }
    if ($wp_grade == 'LCBOOKS LCWL') {
        $wp_grade = 'LCWL';
    }
    /*if ($wp_grade == 'LCWL_GW') {
        $wp_grade = 'LCWL';
    }*/
    if ($wp_grade == 'ONP BOOKS') {
        $wp_grade = 'ONP ';
    }
    if ($wp_grade == 'GUMS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'STICKIES ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'BOOKS ONP') {
        $wp_grade = 'ONP';
    }
    if ($wp_grade == 'GUMS_CBS' || $wp_grade == 'GUMS CBS') {
        $wp_grade = 'CBS';
    }
    if ($wp_grade == 'CORETUBE') {
        $wp_grade = 'MW';
    }
     $wp_grade;

    $tid = $_POST['trans_id' . $ctr];
   $did = $_POST['detail_id' . $ctr];
    $weight = $_POST['correct_weight' . $ctr];
  $date = $_POST['date' . $ctr];
   $priority_number = $_POST['priority_no' . $ctr];
   $price = $_POST['price' . $ctr];
   $adj_price = $_POST['adj_price' . $ctr];
   $adj_amount = $_POST['adj_amount' . $ctr];
   $new_price = $price + $adj_price;
   
 
    $paper_buying = $weight * $new_price ;
     
     $chk = mysql_query("SELECT * from paper_buying WHERE trans_id='$tid' and detail_id='$did' and branch='$branch'") or die (mysql_error());

    $num = 0;
    if($tid == '' || $tid =='0' || $did=='' || $did == '0'){
    ?>
        <script>
            window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php";
        </script>
    <?php
    }else  if($wp_grade != 'LCOTHERS' || $wp_grade != 'OTHERS'){
        $plate_number = $_POST['plate_number' . $ctr];
        
        if ($weight >= 0 && $new_price > 0) {
                
                if(mysql_num_rows($chk) == 0){          
                
                    if (mysql_query("INSERT INTO paper_buying (trans_id,detail_id,date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch)
VALUES('$tid','$did','$date','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$weight','$new_price','$paper_buying',
'$branch')"))       {
                    $num = 1;
                    }             
                }else if(mysql_num_rows($chk) > 0){
                    
                    if(mysql_query("UPDATE paper_buying SET trans_id='$tid',detail_id='$did',date_received='$date',priority_number='$priority_number',supplier_id='$supplier_id',supplier_name='$supplier_name',plate_number='$plate_number',wp_grade='$wp_grade',corrected_weight='$weight',unit_cost='$new_price',paper_buying='$paper_buying',branch='$branch' WHERE trans_id='$tid' and detail_id='$did' and branch='$branch' ") ){
                    $num=1;                 
                    }
                }
         }
    }else{
        ?>
    <script>
        window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?tid=<?php echo $tid.'& update=paper';?>";
    </script>
        <?php   
    }
    $ctr++;
}
 

if($num == 1){
?>
    <script>
        window.top.location.href = "http://<?php echo $branch_url;?>/ts/export_receiving_ims.php?tid=<?php echo $tid.'& update=paper';?>";
    </script>
<?php
    
}else if($num == 0){
    ?>
    <script>
         window.top.location.href = "http://<?php echo $branch_url; ?>/ts/export_receiving_ims.php";
    </script>
    <?php
    
}

?>
