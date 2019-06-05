<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery( $date  ,$wp_grade,$bale_id,$bale_weight,$str_no,$branch,$out_date ) {
    global $data;

    $data []= array(
            'date' => $date,
            'wp_grade' => $wp_grade,
            'bale_id'=>$bale_id,
            'bale_weight'=>$bale_weight,
            'str_no'=>$str_no,
            'branch'=>$branch,
            'out_date'=>$out_date,
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
            $out_date = "";

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
                if ( $index == 7 ) $out_date = $cell->nodeValue;

                $index ++;
            }
            add_delivery($date,$wp_grade,$bale_id,$bale_weight,$str_no,$branch,$out_date );
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
                <th>Out_date</th>



            </tr>
            <?php
            foreach( $data as $row ) {
                if($row['date']!='') {
                    echo("<td>". $date=date("Y/m/d",strtotime($row['date']))."</td>" );
                    echo("<td>". $wp_grade=$row['wp_grade']."</td>" );
                    echo("<td>". $bale_id=$row['bale_id']."</td>" );
                    echo("<td>". $bale_weight=$row['bale_weight']."</td>" );
                    echo("<td>". $str_no=$row['str_no']."</td>" );
                    echo("<td>". $row['branch']."</td>" );
                    $out_date=date("Y/m/d",strtotime($row['out_date']));
                    if ($out_date == '1970/01/01') {
                        echo("<td></td>" );
                    } else {
                        echo("<td>$out_date</td>" );
                    }

                    $date=date("Y/m/d",strtotime($row['date']));
                    $wp_grade=strtoupper($row['wp_grade']);
                        if ((strpos($wp_grade, 'STICKIES') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL_GUMS/STICKIES';
                        }
                        if ((strpos($wp_grade, 'GUMS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL_GUMS/STICKIES';
                        }
                        if ((strpos($wp_grade, 'BOOKS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL_BOOKS';
                        }
                        if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL_CBS';
                        }
                        if ((strpos($wp_grade, 'FLEXO') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL';
                        }
                        if ((strpos($wp_grade, 'BOOKS') !== false) && (strpos($wp_grade, 'ONP') !== false)) {
                            $wp_grade = 'ONP';
                        }
                        if ((strpos($wp_grade, 'GUMS') !== false) && (strpos($wp_grade, 'ONP') !== false)) {
                            $wp_grade = 'ONP_GUMS/STICKIES';
                        }
                        if ((strpos($wp_grade, 'STICKIES') !== false) && (strpos($wp_grade, 'ONP') !== false)) {
                            $wp_grade = 'ONP_GUMS/STICKIES';
                        }
                        if ((strpos($wp_grade, 'GUMS') !== false) && (strpos($wp_grade, 'CBS') !== false)) {
                            $wp_grade = 'CBS';
                        }
                        if ((strpos($wp_grade, 'GW') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL_GW';
                        }
                        if ((strpos($wp_grade, 'CBS') !== false) && (strpos($wp_grade, 'LCWL') !== false)) {
                            $wp_grade = 'LCWL_CBS';
                        }  
                        if ((strpos($wp_grade, '_S') !== false) && (strpos($wp_grade, 'MW') !== false)) {
                            $wp_grade = 'MW_S';
                        }
                    $bale_id=$row['bale_id'];
                    $bale_weight=$row['bale_weight'];
                    $str_no=$row['str_no'];
                    $branch=$row['branch'];
                    $out_date=date("Y/m/d",strtotime($row['out_date']));
                    if ($out_date == '1970/01/01') {
                        $out_date = "";
                    }
                    echo " </tr>";
                    mysql_query("INSERT INTO bales (wp_grade,bale_id,bale_weight,str_no,date,branch,out_date)
                                               VALUES('$wp_grade','$bale_id','$bale_weight','$str_no','$date','$branch','$out_date')
                            ");

                }
            }
            ?>
        </table>
        <a href="home.php"><button>Back To Home</button></a>
    </body>
</html>