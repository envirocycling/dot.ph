<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $date  ,$wp_grade,$weight,$remarks,$branch ) {
    global $data;

    $data []= array(
            'date' => $date,
            'wp_grade' => $wp_grade,
            'weight'=>$weight,
            'remarks'=>$remarks,
            'branch'=>$branch,

    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $date = "";
            $wp_grade="";
            $weight="";
            $remarks="";
            $branch = "";

            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $date = $cell->nodeValue;
                if ( $index == 2 ) $wp_grade = $cell->nodeValue;
                if ( $index == 3 ) $weight = $cell->nodeValue;
                if ( $index == 4 ) $remarks = $cell->nodeValue;
                if ( $index == 5 ) $branch = $cell->nodeValue;



                $index ++;
            }
            add_delivery($date,$wp_grade,$weight,$remarks,$branch );
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
                <th>WP_Grade</th>
                <th>Weight</th>
                <th>Remarks</th>
                <th>Branch</th>



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

            mysql_query("DELETE FROM sorting_prod where date like '%$date_to_delete%' and branch='$branch_to_delete'");


            foreach( $data as $row ) {
                if($row['date']!='') {
                    echo("<td>". $row['date']."</td>" );
                    echo("<td>". $row['wp_grade']."</td>" );
                    echo("<td>". $row['weight']."</td>" );
                    echo("<td>". $row['remarks']."</td>" );
                    echo("<td>". $row['branch']."</td>" );
                    $date=$row['date'];
                    $wp_grade=$row['wp_grade'];
                    $weight=$row['weight'];
                    $remarks=$row['remarks'];
                    $branch=$row['branch'];
                    echo " </tr>";
                    mysql_query("INSERT INTO sorting_prod (date,wp_grade,weight,remarks,branch)
                                               VALUES('$date','$wp_grade','$weight','$remarks','$branch')
                            ");

                }
            }
            ?>
        </table>
        <a href="home.php"><button>Back to Home</button></a>
    </body>
</html>