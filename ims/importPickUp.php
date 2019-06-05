<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery($date,$priority_number,$supplier,$truck_number,$wp_grade,$estimated_weight,$net_weight,$variance,$mc_percentage,$total_mc_dirt,$corrected_weight,$price,$cost,$remarks,$branch) {
    global $data;
    $data []= array(
            'date' => $date,
            'priority_number'=>$priority_number,
            'supplier' =>$supplier,
            'truck_number' =>$truck_number,
            'wp_grade' =>$wp_grade,
            'estimated_weight' =>$estimated_weight,
            'net_weight' =>$net_weight,
            'variance' =>$variance,
            'mc_percentage' =>$mc_percentage,
            'total_mc_dirt' =>$total_mc_dirt,
            'corrected_weight' =>$corrected_weight,
            'price' =>$price,
            'cost' =>$cost,
            'remarks' =>$remarks,
            'branch' =>$branch,
    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $date="";
            $supplier="";
            $truck_number="";
            $wp_grade="";
            $estimated_weight="";
            $net_weught="";
            $variance="";
            $mc_percentage="";
            $total_mc_dirt="";
            $corrected_weight="";
            $price="";
            $cost="";
            $remarks="";
            $branch="";
            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $date = $cell->nodeValue;
                if ( $index == 2 ) $priority_number = $cell->nodeValue;
                if ( $index == 3 ) $supplier = $cell->nodeValue;
                if ( $index == 4 ) $truck_number = $cell->nodeValue;
                if ( $index == 5 ) $wp_grade = $cell->nodeValue;
                if ( $index == 6 ) $estimated_weight = $cell->nodeValue;
                if ( $index == 7 ) $net_weight = $cell->nodeValue;
                if ( $index == 8 ) $variance = $cell->nodeValue;
                if ( $index == 9 ) $mc_percentage = $cell->nodeValue;
                if ( $index == 10 ) $total_mc_dirt = $cell->nodeValue;
                if ( $index == 11 ) $corrected_weight = $cell->nodeValue;
                if ( $index == 12) $price = $cell->nodeValue;
                if ( $index == 13 ) $cost = $cell->nodeValue;
                if ( $index == 14 ) $remarks = $cell->nodeValue;
                if ( $index == 15 ) $branch = $cell->nodeValue;


                $index ++;
            }
            add_delivery($date,$priority_number,$supplier,$truck_number,$wp_grade,$estimated_weight,$net_weight,$variance,$mc_percentage,$total_mc_dirt,$corrected_weight,$price,$cost,$remarks,$branch);
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
                <th>DATE</th>
                <th>PRIORITY NUMBER</th>
                <th>SUPPLIER</th>
                <th>TRUCK NUMBER</th>
                <th>WP GRADE</th>
                <th>ESTIMATED WT.</th>
                <th>NET WT.</th>
                <th>VARIANCE</th>
                <th>MC/DIRT %</th>
                <th>TOTAL MC/DIRT</th>
                <th>CORRECTED WT.</th>
                <th>PRICE</th>
                <th>TOTAL COST</th>
                <th>REMARKS</th>
                <th>BRANCH</th>
            </tr>
            <?php
            $date_to_delete="";
            $branch_to_delete='';
            foreach( $data as $row ) {
                $date_to_delete= $row['date'];
                $branch_to_delete=$row['branch'];
                break;

            }

            $date_to_delete=date("Y/m",strtotime($date_to_delete));

            mysql_query("DELETE FROM pick_up where date like '%$date_to_delete%' and branch='$branch_to_delete'");
            foreach( $data as $row ) {
                echo("<td>". $row['date']."</td>" );
                echo("<td>". $row['priority_number']."</td>" );
                echo("<td>". $row['supplier']."</td>" );
                echo("<td>". $row['truck_number']."</td>" );
                echo("<td>". $row['wp_grade']."</td>" );
                echo("<td>". $row['estimated_weight']."</td>" );
                echo("<td>". $row['net_weight']."</td>" );
                echo("<td>". $row['variance']."</td>" );
                echo("<td>". $row['mc_percentage']."</td>" );
                echo("<td>". $row['total_mc_dirt']."</td>" );
                echo("<td>". $row['corrected_weight']."</td>" );
                echo("<td>". $row['price']."</td>" );
                echo("<td>". $row['cost']."</td>" );
                echo("<td>". $row['remarks']."</td>" );
                echo("<td>". $row['branch']."</td>" );
                echo " </tr>";
                mysql_query("INSERT INTO pick_up (date,priority_number,supplier_name,truck_number,wp_grade,estimated_weight,net_weight,variance,mc_percentage,total_mc_dirt,corrected_weight,price,total_cost,remarks,branch)
                                             VALUES('".$row['date']."','".$row['priority_number']."','".$row['supplier']."','".$row['truck_number']."','".$row['wp_grade']."','".$row['estimated_weight']."','".$row['net_weight']."','".$row['variance']."','".$row['mc_percentage']."','".$row['total_mc_dirt']."','".$row['corrected_weight']."','".$row['price']."','".$row['cost']."','".$row['remarks']."','".$row['branch']."')
                        ");



            }
            ?>
        </table>
        <a href="home.php"><button>Confirm</button></a>
    </body>
</html>