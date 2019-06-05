<?php
if($wp_grade!='LCWL' && $wp_grade!='CHIPBOARD') {
    $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%' and branch_delivered='$branch' and wp_grade='$wp_grade2' group by wp_grade";
}else {
    if($wp_grade=='CHIPBOARD') {
        $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%' and branch_delivered='$branch' and wp_grade='cb' group by wp_grade";
    }else {
        $query="SELECT wp_grade,sum(weight) from sup_deliveries where date_delivered like '%$month%' and branch_delivered='$branch' and wp_grade='LCWL' group by wp_grade";
    }
}
?>