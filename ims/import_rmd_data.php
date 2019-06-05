<?php
ini_set('max_execution_time', 1000);
include('config.php');

function add_delivery( $date,$supplier_id,$supplier_name,$str,$dr_number,$plate_number,$wp_grade,$weight,$mc,$dirt,$net_wt,$tat,$delivered_to,$remarks) {
    global $data;
    $data []= array(
            'date' => $date,
            'supplier_id' => $supplier_id,
            'supplier_name' => $supplier_name,
            'str' => $str,
            'dr_number' => $dr_number,
            'plate_number' => $plate_number,
            'wp_grade' => $wp_grade,
            'weight' => $weight,
            'mc' => $mc,
            'dirt' => $dirt,
            'net_wt' => $net_wt,
            'tat' => $tat,
            'delivered_to' => $delivered_to,
            'remarks' => $remarks
    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $date = "";
            $supplier_id = "";
            $supplier_name = "";
            $str = "";
            $dr_number = "";
            $plate_number = "";
            $wp_grade = "";
            $weight = "";
            $mc = "";
            $dirt = "";
            $tat = "";
            $net_wt = "";
            $delivered_to = "";
            $remarks = "";
            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $date = $cell->nodeValue;
                if ( $index == 2 ) $supplier_id = $cell->nodeValue;
                if ( $index == 3 ) $supplier_name = $cell->nodeValue;
                if ( $index == 4 ) $str = $cell->nodeValue;
                if ( $index == 5 ) $dr_number = $cell->nodeValue;
                if ( $index == 6 ) $plate_number = $cell->nodeValue;
                if ( $index == 7 ) $wp_grade = $cell->nodeValue;
                if ( $index == 8 ) $weight = $cell->nodeValue;
                if ( $index == 9 ) $mc = $cell->nodeValue;
                if ( $index == 10 ) $dirt = $cell->nodeValue;
                if ( $index == 11 ) $net_wt= $cell->nodeValue;
                if ( $index == 12 ) $tat = $cell->nodeValue;
                if ( $index == 13 ) $delivered_to = $cell->nodeValue;
                if ( $index == 14 ) $remarks = $cell->nodeValue;

                $index ++;
            }
            add_delivery($date,$supplier_id,$supplier_name,$str,$dr_number,$plate_number,$wp_grade,$weight,$mc,$dirt,$net_wt,$tat,$delivered_to,$remarks);
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
                <th>Date</th>
                <th>ID</th>
                <th>Supplier Name</th>
                <th>Str Number</th>
                <th>Dr Number</th>
                <th>WP Grade</th>
                <th>Weight</th>
                <th>MC</th>
                <th>Dirt</th>
                <th>Corrected</th>
                <th>TAT</th>
                <th>Delivered To</th>
                <th>Remarks</th>
            </tr>
            <?php
            $ctr = 0;
            foreach( $data as $row ) {
                $date = date("Y/m/d", strtotime($row['date']));
                $month_delivered = date("F", strtotime($row['date']));
                $day_delivered = date("d", strtotime($row['date']));
                $year_delivered = date("Y", strtotime($row['date']));
                $supplier_id = $row['supplier_id'];
                $str = $row['str'];
                $dr_number = $row['dr_number'];
                $plate_number = $row['plate_number'];
                $wp_grade = $row['wp_grade'];
                $weight = number_format($row['weight']*1000,2);
                $mc =  number_format($row['mc']*1000,2);
                $dirt =  number_format($row['dirt']*1000,2);
                $tat =  $row['tat'];
                $net_wt =  number_format($row['net_wt']*1000,2);
                $delivered_to =  $row['delivered_to'];
                $remarks = "";

                if ($ctr == '0') {
                    mysql_query("DELETE FROM actual WHERE date='$date' and dr_number!='';");
                    mysql_query("DELETE FROM sup_deliveries WHERE date_delivered='$date' and branch_delivered='PAMPANGA' and notes!='manually_encoded'");
                    $ctr++;
                }
                if($row['date']!='' && $row['supplier_id']!='' && $row['dr_number']!='' && $row['wp_grade']!='' && $row['weight']!='' && $row['delivered_to']!='') {
                    if ($supplier_id == '1449' || $supplier_id == '1450' || $supplier_id == '1451' || $supplier_id == '1452' || $supplier_id == '1453' || $supplier_id == '1454' || $supplier_id == '1455' || $supplier_id == '1456' || $supplier_id == '1458' || $supplier_id == '14025') {
                        $sql_sup = mysql_query("SELECT supplier_name FROM supplier_details WHERE supplier_id='".$row['supplier_id']."'");
                        $rs_sup = mysql_fetch_array($sql_sup);
                        $que = preg_split("[_]",$rs_sup['supplier_name']);
                        $branch = strtoupper($que[1]);
                    }
                    echo "
                    <tr>";
                    echo("<td>". date("Y/m/d",strtotime($row['date']))."</td>" );
                    echo("<td>". $row['supplier_id']."</td>" );
                    echo("<td>". $row['supplier_name']."</td>" );
                    echo("<td>". $row['str']."</td>" );
                    echo("<td>". $row['dr_number']."</td>" );
                    echo("<td>". $row['wp_grade']."</td>" );
                    echo("<td>". number_format($row['weight'],3)."</td>" );
                    echo("<td>". number_format($row['mc'],3)."</td>" );
                    echo("<td>". number_format($row['dirt'],3)."</td>" );
                    echo("<td>". number_format($row['net_wt'],3)."</td>" );
                    echo("<td>". $row['tat']."</td>" );
                    echo("<td>". $row['delivered_to']."</td>" );
                    echo("<td>". $row['remarks']."</td>" );
                    echo "</tr>";
                    mysql_query(mysql_query("INSERT INTO actual2(str_no,date,delivered_to,wp_grade,weight,branch,dr_number,mc,dirt,net_wt,comments)
                            VALUES('$str','$date','$delivered_to','$wp_grade','$net_wt','$branch','$dr_number','$mc','$dirt','$weight','$remarks')"));
                }
            }
            ?>
        </table>
        <a href="rmd_upload.php"><button>Confirm</button></a>
    </body>
</html>
