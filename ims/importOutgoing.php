<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $str,$date,$trucking,$plate_number,$wp_grade,$weight,$branch ) {
    global $data;

    $data []= array(
            'str' => $str,
            'date'=>$date,
            'trucking'=>$trucking,
            'plate_number'=>$plate_number,
            'wp_grade'=>$wp_grade,
            'weight'=>$weight,
            'branch'=>$branch,
    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {
            $str="";
            $date="";
            $trucking="";
            $plate_number="";
            $wp_grade="";
            $weight="";
            $branch="";

            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $str = $cell->nodeValue;
                if ( $index == 2 ) $date = $cell->nodeValue;
                if ( $index == 3 ) $trucking = $cell->nodeValue;
                if ( $index == 4 ) $plate_number = $cell->nodeValue;
                if ( $index == 5 ) $wp_grade = $cell->nodeValue;
                if ( $index == 6 ) $weight = $cell->nodeValue;
                if ( $index == 7 ) $branch = $cell->nodeValue;




                $index ++;
            }
            add_delivery($str,$date,$trucking,$plate_number,$wp_grade,$weight,$branch );
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
                <th>STR</th>
                <th>Date</th>
                <th>Trucking</th>
                <th>Plate Number</th>
                <th>WP Grade</th>
                <th>Weight</th>
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

            mysql_query("DELETE FROM outgoing where date like '%$date_to_delete%' and branch='$branch_to_delete'");

           foreach( $data as $row ) {

                if($row['str']!='') {
                    $date=$row['date'];
                    $date = date("Y/m/d",strtotime($date));
                    echo("<td>". $str=$row['str']."</td>" );
                    echo("<td>". $date."</td>" );
                    echo("<td>". $trucking=$row['trucking']."</td>" );
                    echo("<td>". $plate_number=$row['plate_number']."</td>" );
                    $wp_grade= $row['wp_grade'];

                    if((strpos($wp_grade,'LCWL') === FALSE ) && (strpos($wp_grade,'CHIPBOARD') === FALSE )) {
                        $wp_grade="LC".$wp_grade;
                    }
                    if((strpos($wp_grade,'.') == TRUE) ) {
                        $wp_grade='LCMW';
                    }
                    if($wp_grade == 'LCCB') {
                        $wp_grade='CHIPBOARD';
                    }

                    echo("<td>". $wp_grade."</td>" );
                    echo("<td>". $weight=$row['weight']."</td>" );
                    echo("<td>". $branch=$row['branch']."</td>" );

                    $str=$row['str'];
                    
                    $trucking=$row['trucking'];
                    $plate_number=$row['plate_number'];

                    $branch=$row['branch'];
                    $weight=$row['weight'];
                    $branch=$row['branch'];
                    echo " </tr>";
                    mysql_query("INSERT INTO outgoing (str,date,trucking,plate_number,wp_grade,weight,branch)
                                             VALUES('$str','$date','$trucking','$plate_number','$wp_grade','$weight','$branch')
                            ");


                }
            }
            ?>
        </table>
        <a href="home.php"><button>Confirm</button></a>
    </body>
</html>