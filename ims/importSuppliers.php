<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $supplier_name,$classification,$branch,$bh_in_charge) {
    global $data;

    $data []= array(
            'supplier_name' => $supplier_name,
            'classification' => $classification,
            'branch' => $branch,
            'bh_in_charge' => $bh_in_charge

    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $supplier_name="";
            $classificaton="";
            $branch="";
            $bh_in_charge="";

            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $supplier_name = $cell->nodeValue;
                if ( $index == 2 ) $classification = $cell->nodeValue;
                if ( $index == 3 ) $branch = $cell->nodeValue;
                if ( $index == 4 ) $bh_in_charge = $cell->nodeValue;



                $index ++;
            }
            add_delivery($supplier_name,$classification,$branch,$bh_in_charge );
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
                <th>Supplier_Name</th>
                <th>Classification</th>
                <th>Branch</th>
                <th>BH In-charge</th>




            </tr>
            <?php
            foreach( $data as $row ) {
                if($row['supplier_name']!='') {
                    $result2 = mysql_query("SELECT * FROM supplier_details  order by supplier_id desc limit 1");
                    $row2 = mysql_fetch_array($result2);
                    $idNumber=$row2['supplier_id']+1;
                    echo("<td>". $idNumber."</td>" );

                    echo("<td>". $supplier_name=$row['supplier_name']."</td>" );
                    echo("<td>". $classification=$row['classification']."</td>" );
                    echo("<td>". $branch=$row['branch']."</td>" );
                    echo("<td>". $bh_in_charge=$row['bh_in_charge']."</td>" );

                    $supplier_name=$row['supplier_name'];
                    $classification=$row['classification'];
                    $branch=$row['branch'];
                    $bh_in_charge=$row['bh_in_charge'];

                    echo " </tr>";

                    if(mysql_query("INSERT INTO supplier_details (supplier_id,supplier_name,classification,branch,bh_in_charge)
                                               VALUES($idNumber,'$supplier_name','$classification','$branch','$bh_in_charge')
                    ")) {

                    }else {
                        echo "<script>";
                        echo "alert('Failed to add supplier $supplier_name for branch $branch')";
                        echo "</script>";
                    }

                }
            }
            ?>
        </table>
        <a href="supplierlist.php"><button>Confirm</button></a>
    </body>
</html>