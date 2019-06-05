<?php

include("templates/template.php");
?>
<style>

    #positive{
        color:green;
        font-weight: bold;
        background-color:#FF9340;
    }
    #negative{
        color:red;
        font-weight: bold;
        background-color:#FF9340;
    }

    #zero{

        font-weight: bold;
        background-color:#FF9340;
    }
    #net{
        font-weight:bold;
        background-color:#33CCFF;
    }
    #from_location{
        font-weight:bold;
        background-color:#29A6CF;
    }
    #dr{
        font-weight:bold;
        background-color:#33CCCC;
    }
    #mc{
        background-color: #85E0FF;
    }
    #dirt{
        background-color: #00B8E6;
    }
    #corrected{
        background-color: yellow;
        font-weight:bold;
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
        <?php

        function parse_number($number, $dec_point=null) {
            if (empty($dec_point)) {
                $locale = localeconv();
                $dec_point = $locale['decimal_point'];
            }
            return floatval(str_replace($dec_point, '.', preg_replace('/[^\d'.preg_quote($dec_point).']/', '', $number)));
        }

        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        echo "<h2> ".$_SESSION['selected_branch']." TS and FS Variance Analysis as of : <u><b><i>".$ngayon."</i></b></u></h2>";


        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data">';


            echo "<th class='data'>Delivery Date</th>";
            echo "<th class='data'>STR #</th>";
            echo "<th class='data'>Branch</th>";


            echo "<th class='data'>Trucking</th>";
            echo "<th class='data'>Plate Number</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Wt. from TS</th>";
            echo "<th class='data'>Wt. from FS</th>";
            echo "<th class='data'>TS vs FS</th>";
            echo "</tr>";

            echo "</thead>";
            include("config.php");
            $query="SELECT wp_grade,str,branch,trucking,date,plate_number,sum(weight) as weight FROM outgoing where branch='$branch' group by str,wp_grade";
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                $wp_grade=$row['wp_grade'];
                if((strpos($wp_grade,'LCWL') === FALSE ) && (strpos($wp_grade,'CHIPBOARD') === FALSE ) && (strpos($wp_grade,'.') === FALSE ) ) {
                    $wp_grade=preg_split("[LC]",$wp_grade);
                    $wp_grade=$wp_grade[1];
                }
                if((strpos($wp_grade,'.') == TRUE) ) {
                    $wp_grade='MW';
                }
                
                $query2="SELECT sum(bale_weight) as bale_weight FROM bales where str_no = '".$row['str']."' and wp_grade='".$wp_grade."' group by str_no,wp_grade";
                $result2=mysql_query($query2);
                $bale_weight=0;
                $individual_bale_weight="";
                while($row2 = mysql_fetch_array($result2)) {
                    $individual_bale_weight=trim($row2['bale_weight']);
                    $bale_weight+=parse_number($individual_bale_weight);

                }
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['date']."</td>";
                echo "<td class='data'>".$row['str']."</td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$row['trucking']."</td>";
                echo "<td class='data'>".$row['plate_number']."</td>";
                echo "<td class='data'>".$row['wp_grade']."</td>";
                echo "<td>".$row['weight']."</td>";
                echo "<td>".$bale_weight."</td>";
                echo "<td>".($row['weight']-$bale_weight)."</td>";



                echo "</tr>";
            }


            echo "</table>";


            ?>







        </table>

    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>