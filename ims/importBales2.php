<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $date  ,$wp_grade,$bale_id,$bale_weight,$str_no,$branch ) {
    global $data;

    $data []= array(
            'date' => $date,
            'wp_grade' => $wp_grade,
            'bale_id'=>$bale_id,
            'bale_weight'=>$bale_weight,
            'str_no'=>$str_no,
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
            $bale_id = "";
            $bale_weight = "";
            $str_no = "";
            $branch = "";

            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $date = $cell->nodeValue;
                if ( $index == 2 ) $wp_grade = $cell->nodeValue;
                if ( $index == 3 ) $bale_id = $cell->nodeValue;
                if ( $index == 4 ) $bale_weight = $cell->nodeValue;
                if ( $index == 5 ) $str_no = $cell->nodeValue;
                if ( $index == 6 ) $branch = $cell->nodeValue;

                $index ++;
            }
            add_delivery($date,$wp_grade,$bale_id,$bale_weight,$str_no,$branch );
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
                <th>Bale ID</th>
                <th>Bale Weight</th>
                <th>STR No.</th>
                <th>Branch</th>



            </tr>
            <?php
            foreach( $data as $row ) {
                if($row['date']!='') {
                    echo("<td>". date("Y/m/d",strtotime($date=$row['date']))."</td>" );
                    echo("<td>". $wp_grade=$row['wp_grade']."</td>" );
                    echo("<td>". $bale_id=$row['bale_id']."</td>" );
                    echo("<td>". $bale_weight=$row['bale_weight']."</td>" );
                    echo("<td>". $str_no=$row['str_no']."</td>" );
                    echo("<td>". $row['branch']."</td>" );
                    $date=date("Y/m/d",strtotime($row['date']));
                    $wp_grade=$row['wp_grade'];
                    $bale_id=$row['bale_id'];
                    $bale_weight=$row['bale_weight'];
                    $str_no=$row['str_no'];
                    $branch=$row['branch'];
                    echo " </tr>";
                    mysql_query("INSERT INTO bales (wp_grade,bale_id,bale_weight,str_no,date,branch)
                                               VALUES('$wp_grade','$bale_id','$bale_weight','$str_no','$date','$branch')
                            ");

                }
            }
            ?>
        </table>
        <a href="home.php"><button>Back To Home</button></a>
    </body>
</html>