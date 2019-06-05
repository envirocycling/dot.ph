<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $suplier_id  ,$wp_grade,$weight,$branch_delivered,$date_delivered,$month_delivered,$year_delivered ) {
    global $data;

    $data []= array(
            'suplier_id' => $suplier_id,

            'wp_grade' => $wp_grade,
            'weight' => $weight,
            'branch_delivered' => $branch_delivered,
            'date_delivered' => $date_delivered,
            'month_delivered' => $month_delivered,
            'year_delivered' => $year_delivered
    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $suplier_id = "";
            $supplier_type = "";
            $wp_grade = "";
            $weight = "";
            $branch_delivered = "";
            $date_delivered = "";
            $month_delivered = "";
            $year_delivered = "";
            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $suplier_id = $cell->nodeValue;
                if ( $index == 2 ) $wp_grade = $cell->nodeValue;
                if ( $index == 3 ) $weight = $cell->nodeValue;
                if ( $index == 4 ) $branch_delivered = $cell->nodeValue;
                if ( $index == 5 ) $date_delivered = $cell->nodeValue;
                if ( $index == 6 ) $month_delivered = $cell->nodeValue;
                if ( $index == 7 ) $year_delivered = $cell->nodeValue;
                $index ++;
            }
            add_delivery($suplier_id  ,$wp_grade,$weight,$branch_delivered,$date_delivered,$month_delivered,$year_delivered );
        }
        $first_row = false;
    }
}
?>
<html>
    <body>
        <h2>The following records were uploaded successfully...</h2>
        <table border="1">
            <tr>
                <th>Supplier ID</th>
                <th>Grade Delivered</th>
                <th>Weight</th>
                <th>Branch Delivered</th>
                <th>Date Delivered</th>
                <th>Month Delivered</th>
                <th>Year Delivered</th>
            </tr>
            <?php
            $date_to_delete="";
            $branch_to_delete='';
            foreach( $data as $row ) {
                $date_to_delete= $row['date_delivered'];
                $branch_to_delete=$row['branch_delivered'];
                break;
            }
            $date_to_delete=date("Y/m",strtotime($date_to_delete));
            if($branch_to_delete=='Pampanga' || $branch_to_delete =='Pasay' || $branch_to_delete=='Makati' || $branch_to_delete=='Urdaneta') {
                mysql_query("DELETE FROM sup_deliveries where date_delivered like '%$date_to_delete%' and branch_delivered='$branch_to_delete'");
            }
            foreach( $data as $row ) {
                if($row['suplier_id']!='') {
                    $date_delivered = $row['date_delivered'];
                    $date_delivered = date("Y/m/d",strtotime($date_delivered));
                    echo("<td>". $row['suplier_id']."</td>" );
                    echo("<td>". $row['wp_grade']."</td>" );
                    echo("<td>". $row['weight'] ."</td>");
                    echo("<td>". $row['branch_delivered'] ."</td>");
                    echo("<td>". $date_delivered."</td>" );
                    echo("<td>". $row['month_delivered']."</td>" );
                    echo("<td>". $row['year_delivered'] ."</td>");
                    echo " </tr>";

                    $query="SELECT * FROM supplier_details where supplier_id='".$row['suplier_id']."'";
                    $result=mysql_query($query);
                    $row2 = mysql_fetch_array($result);
                    mysql_query("INSERT INTO sup_deliveries (supplier_id,supplier_name,supplier_type,bh_in_charge,wp_grade,weight,branch_delivered,date_delivered,month_delivered,year_delivered)
                                            VALUES('".$row['suplier_id']."','".$row2['supplier_name']."','".$row2['classification']."','".$row2['bh_in_charge']."','".$row['wp_grade']."','".$row['weight']."','".$row['branch_delivered']."','$date_delivered','".$row['month_delivered']."','".$row['year_delivered']."')");
                    $query3="SELECT * from incentive_scheme where sup_id='".$row['suplier_id']."' and wp_grade='".$row['wp_grade']."'  ;";
                    $result3=mysql_query($query3);
                    $row3 = mysql_fetch_array($result3);
                    $toUpdate=$row3['current_deliveries']+ $row['weight'] ;
                    mysql_query("UPDATE incentive_scheme SET current_deliveries ='$toUpdate' where sup_id='".$row['suplier_id']."' and wp_grade='".$row['wp_grade']."' and end_date >='".$row['date_delivered']."' and start_date <='$date_delivered'");
                }
            }


            ?>
        </table>
        <a href="home.php"><button>Confirm</button></a>
    </body>
</html>