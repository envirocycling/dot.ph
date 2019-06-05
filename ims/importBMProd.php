<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $date  ,$wp_grade,$start,$finish,$no_of_bales,$minutes,$min_per_bale,$rebale,$branch) {
    global $data;

    $data []= array(
            'date' => $date,
            'wp_grade' => $wp_grade,
            'start'=>$start,
            'finish'=>$finish,
            'no_of_bales'=>$no_of_bales,
            'minutes'=>$minutes,
            'minutes_per_bale'=>$min_per_bale,
            'rebale'=>$rebale,
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
            $start = "";
            $finish = "";
            $no_of_bales = "";
            $minutes = "";
            $minutes_per_bale = "";
            $rebale = "";
            $branch = "";
            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $date = $cell->nodeValue;
                if ( $index == 2 ) $wp_grade = $cell->nodeValue;
                if ( $index == 3 ) $start = $cell->nodeValue;
                if ( $index == 4 ) $finish = $cell->nodeValue;
                if ( $index == 5 ) $no_of_bales = $cell->nodeValue;
                if ( $index == 6 ) $minutes = $cell->nodeValue;
                if ( $index == 7 ) $minutes_per_bale = $cell->nodeValue;
                if ( $index == 8 ) $rebale = $cell->nodeValue;
                if ( $index == 9 ) $branch = $cell->nodeValue;
                $index ++;
            }
            add_delivery($date,$wp_grade,$start,$finish,$no_of_bales,$minutes,$minutes_per_bale,$rebale,$branch );
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
                <th>Start</th>
                <th>Finish</th>
                <th>No. of Bales</th>
                <th>Minutes</th>
                <th>Minutes per Bale</th>
                <th>Rebale</th>
                <th>Branch</th>



            </tr>
            <?php
            foreach( $data as $row ) {
                if($row['date']!='') {
                    echo("<td>". $row['date']."</td>" );
                    echo("<td>". $row['wp_grade']."</td>" );
                    echo("<td>". $row['start']."</td>" );
                    echo("<td>". $row['finish']."</td>" );
                    echo("<td>". $row['no_of_bales']."</td>" );
                    echo("<td>". $row['minutes']."</td>" );
                    echo("<td>". $row['minutes_per_bale']."</td>" );
                    echo("<td>". $row['rebale']."</td>" );
                    echo("<td>". $row['branch']."</td>" );

                    $date=$row['date'];
                    $wp_grade=$row['wp_grade'];
                    $start=$row['start'];
                    $finish=$row['finish'];
                    $no_of_bales=$row['no_of_bales'];
                    $minutes=$row['minutes'];
                    $minutes_per_bale=$row['minutes_per_bale'];
                    $rebale=$row['rebale'];
                    $branch=$row['branch'];
                    echo " </tr>";
                    mysql_query("INSERT INTO bm_prod (date,wp_grade,start,finish,no_of_bales,minutes,min_per_bale,rebale,branch)
                                             VALUES('$date','$wp_grade','$start','$finish','$no_of_bales','$minutes','$minutes_per_bale','$rebale','$branch');");

                }
            }


            ?>
        </table>
        <a href="home.php"><button>Confirm</button></a>
    </body>
</html>