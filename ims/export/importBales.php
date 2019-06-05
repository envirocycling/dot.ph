<?php
ini_set('max_execution_time', 500);
include('config.php');
$data = array();

function add_delivery($str_no, $date  ,$delivered_to, $plate_number, $wp_grade, $weight, $branch, $dr_number, $mc, $dirt, $net_wt, $comments) {
    global $data;

    $data []= array(

            'str_no' => $str_no,
            'date' => $date,
			'delivered_to' => $delivered_to,
			'plate_number' => $plate_number,
            'wp_grade' => $wp_grade,
			'weight' => $weight,
			'branch' => $branch,
			'dr_number' => $dr_number,
			'mc' => $mc,
			'dirt' => $dirt,
			'net_wt' => $net_wt,
			'comments' => $comments,

    );
}

if ( $_FILES['file']['tmp_name'] ) {
    $dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
    $rows = $dom->getElementsByTagName( 'Row' );
    $first_row = true;
    foreach ($rows as $row) {
        if ( !$first_row ) {

            $str_no ="";
            $date = "";
			$delivered_to = "";
			$plate_number = "";
			$wp_grade = "";
            $weight="";
			$branch="";
			$dr_number="";
			$mc="";
			$dirt="";
			$net_wt="";
			$comments="";


            $index = 1;
            $cells = $row->getElementsByTagName( 'Cell' );
            foreach( $cells as $cell ) {
                $ind = $cell->getAttribute( 'Index' );
                if ( $ind != null ) $index = $ind;
                if ( $index == 1 ) $str_no = $cell->nodeValue;
                if ( $index == 2 ) $date = $cell->nodeValue;
				if ( $index == 3 ) $delivered_to = $cell->nodeValue;
				if ( $index == 4 ) $plate_number = $cell->nodeValue;
				if ( $index == 5 ) $wp_grade = $cell->nodeValue;
				if ( $index == 6 ) $weight = $cell->nodeValue;
				if ( $index == 7 ) $branch = $cell->nodeValue;
				if ( $index == 8 ) $dr_number = $cell->nodeValue;
				if ( $index == 9 ) $mc = $cell->nodeValue;
				if ( $index == 10 ) $dirt = $cell->nodeValue;
				if ( $index == 11 ) $net_wt = $cell->nodeValue;
				if ( $index == 12 ) $comments = $cell->nodeValue;

                $index ++;
            }
            add_delivery($str_no, $date  ,$delivered_to, $plate_number, $wp_grade, $weight, $branch, $dr_number, $mc, $dirt, $net_wt, $comments);
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

                <th>WP_Grade</th>



            </tr>
            <?php
            foreach( $data as $row ) {
   					 ($str_no=$row['str_no']);
					 ($date=$row['date']);
					 ($delivered_to=$row['delivered_to']);
					 ($plate_number=$row['plate_number']);
					 ($wp_grade=$row['wp_grade']);
					 ($weight=$row['weight']);
					 ($branch=$row['branch']);
					($dr_number=$row['dr_number']);
					 ($mc=$row['mc']);
					 ($dirt=$row['dirt']);
					 ($net_wt=$row['net_wt']);
					($comments=$row['comments']);
                    echo " </tr>";
                   
				   $sql_chk = mysql_query("SELECT * from actual WHERE wp_grade='$wp_grade' and str_no='$str_no' and net_wt='$net_wt' and delivered_to='$delivered_to' and branch='$branch'") or die(mysql_error());
				   if(mysql_num_rows($sql_chk) == 0){
				   		mysql_query("INSERT INTO actual (str_no, date, delivered_to, plate_number, wp_grade, weight, branch, dr_number, mc, dirt, net_wt, comments ) VALUES('$str_no', '$date', '$delivered_to', '$plate_number', '$wp_grade', '$weight', '$branch', '$dr_number' , '$mc', '$dirt', '$net_wt' , '$comments')") or die(mysql_error());
				   }

                
            }
            ?>
        </table>
        <a href="home.php"><button>Back To Home</button></a>
    </body>
</html>