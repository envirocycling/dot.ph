<?php
@session_start();
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $supplier_id,$capacity,$wp_grade,$company,$price,$date_effective ) {
    global $data;

    $data []= array(
            'supplier_id' => $supplier_id,
            'capacity'=>$capacity,
            'wp_grade'=>$wp_grade,
            'company'=>$company,
            'price'=>$price,
            'date_effective'=>$date_effective,
    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $supplier_id="";
            $capacity="";
            $wp_grade="";
            $company="";
            $price="";
            $date_effective="";

            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $supplier_id = $cell->nodeValue;
                if ( $index == 2 ) $capacity = $cell->nodeValue;
                if ( $index == 3 ) $wp_grade = $cell->nodeValue;
                if ( $index == 4 ) $company = $cell->nodeValue;
                if ( $index == 5 ) $price = $cell->nodeValue;
                if ( $index == 6 ) $date_effective = $cell->nodeValue;




                $index ++;
            }
            add_delivery($supplier_id,$capacity,$wp_grade,$company,$price,$date_effective );
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
                <th>Capacity</th>
                <th>WP Grade</th>
                <th>Company</th>
                <th>Price</th>
                <th>Date Effective</th>
            </tr>
            <?php

            foreach( $data as $row ) {
                add_delivery($supplier_id,$capacity,$wp_grade,$company,$price,$date_effective );

                if($row['supplier_id']!='') {
                    echo " <tr>";
                    echo("<td>". $supplier_id=$row['supplier_id'] ."</td>" );
                    echo("<td>". $capacity=$row['capacity'] ."</td>" );
                    echo("<td>". $wp_grade=$row['wp_grade']."</td>" );
                    echo("<td>". $company=$row['company']."</td>" );
                    echo("<td>". $price=$row['price']."</td>" );
                    echo("<td>". $date_effective=date("Y/m/d",strtotime($row['date_effective']))."</td>" );
                    echo " </tr>";

                    $supplier_id=$row['supplier_id'];
                    $capacity=$row['capacity'];
                    $wp_grade=$row['wp_grade'];
                    $company=$row['company'];
                    $price=$row['price'];
                    $date_effective=date("Y/m/d",strtotime($row['date_effective']));

                    mysql_query("INSERT INTO `supplier_capacity`(`supplier_id`, `wp_grade`, `capacity`, `delivers_to`, `updated_by`, `date_effective`, `date_updated`, `competitor_price`)
                        VALUES ('$supplier_id','$wp_grade','$capacity','$company','".$_SESSION['username']."','$date_effective','".date("Y/m/d")."','$price')
                            ");
                }
            }
            ?>
        </table>
        <a href="home.php"><button>Confirm</button></a>
    </body>
</html>