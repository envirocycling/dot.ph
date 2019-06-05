<?php
ini_set('max_execution_time', 1000);
include('config.php');
$data = array();

function add_delivery( $date_received,$priority_number,$supplier_id,$supplier_name,$plate_number,$wp_grade,$corrected_weight,$unit_cost,$paper_buying,$branch,$notes) {
    global $data;
    $data []= array(
            'date_received' => $date_received,
            'priority_number' => $priority_number,
            'supplier_id' => $supplier_id,
            'supplier_name' => $supplier_name,
            'plate_number' => $plate_number,
            'wp_grade' => $wp_grade,
            'corrected_weight' => $corrected_weight,
            'unit_cost' => $unit_cost,
            'paper_buying' => $paper_buying,
            'branch' => $branch,
            'notes' => $notes,
    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $date_received="";
            $priority_number="";
            $supplier_id="";
            $supplier_name="";
            $plate_number="";
            $wp_grade="";
            $corrected_weight="";
            $unit_cost="";
            $paper_buying="";
            $branch="";
            $notes="";


            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $date_received = $cell->nodeValue;
                if ( $index == 2 ) $priority_number = $cell->nodeValue;
                if ( $index == 3 ) $supplier_id = $cell->nodeValue;
                if ( $index == 4 ) $supplier_name = $cell->nodeValue;
                if ( $index == 5 ) $plate_number = $cell->nodeValue;
                if ( $index == 6 ) $wp_grade = $cell->nodeValue;
                if ( $index == 7 ) $corrected_weight = $cell->nodeValue;
                if ( $index == 8 ) $unit_cost = $cell->nodeValue;
                if ( $index == 9 ) $paper_buying = $cell->nodeValue;
                if ( $index == 10 ) $branch = $cell->nodeValue;
                if ( $index == 11 ) $notes = $cell->nodeValue;

                $index ++;
            }
            add_delivery($date_received,$priority_number,$supplier_id,$supplier_name,$plate_number,$wp_grade,$corrected_weight,$unit_cost,$paper_buying,$branch,$notes);
        }
        $first_row = false;
    }
}
?>
<html>
    <body>
        <h2>The following records were uploaded successfully...</h2>
        <h3>Note: Please upload only 1 date.</h3>
        <table border="1">
            <tr>
                <th>Date Received</th>
                <th>Priority Number</th>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Plate Number</th>
                <th>WP Grade</th>
                <th>Corrected Weight</th>
                <th>Unit Cost</th>
                <th>Paper Buying</th>
                <th>Branch</th>
                <th>Notes</th>
            </tr>
            <?php
            $c = 0;
            foreach( $data as $row ) {
                $date_received = $row['date_received'];
                $date_received = date("Y/m/d",strtotime($date_received));
                if ($c == 0) {
                    mysql_query("DELETE FROM paper_buying WHERE date_received='$date_received' and branch='".$row['branch']."'");
                    $c++;
                }
                echo " <tr>";
                echo("<td>". $date_received."</td>" );
                echo("<td>". $row['priority_number']."</td>" );
                echo("<td>".$row['supplier_id']."</td>" );

                echo("<td>".$supplier_name."</td>" );
                echo("<td>".$row['plate_number']."</td>" );
                echo("<td>".$row['wp_grade']."</td>" );
                echo("<td>".$row['corrected_weight']."</td>" );
                echo("<td>".$row['unit_cost']."</td>" );
                echo("<td>".$row['paper_buying']."</td>" );
                echo("<td>".$row['branch']."</td>" );
                echo("<td>".$row['notes']."</td>" );

                echo " </tr>";

                $priority_number=$row['priority_number'];
                $supplier_id=$row['supplier_id'];

                $sql = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='$supplier_id'");
                $rs = mysql_fetch_array($sql);
                $supplier_name=$rs['supplier_name'];
                $plate_number=$row['plate_number'];
                $wp_grade=$row['wp_grade'];
                $corrected_weight=$row['corrected_weight'];
                $unit_cost=$row['unit_cost'];
                $branch=$row['branch'];
                $paper_buying=$row['paper_buying'];
                $notes=$row['notes'];
                mysql_query("INSERT INTO paper_buying (date_received,priority_number,supplier_id,supplier_name,plate_number,wp_grade,corrected_weight,unit_cost,paper_buying,branch,notes,date_uploaded)
                                             VALUES('$date_received','$priority_number','$supplier_id','$supplier_name','$plate_number','$wp_grade','$corrected_weight','$unit_cost','$paper_buying','$branch','$notes','".date("Y/m/d")."')");
            }
            ?>
        </table>

        <a href="home.php"><button>Confirm</button></a>
    </body>
</html>