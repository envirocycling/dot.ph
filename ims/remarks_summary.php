<?php
include('templates/template.php');
$from=$_POST['from'];
$to=$_POST['to'];
?>



<div class="grid_10">
    <div class="box round first grid">
        <?php
        echo "<h2>Remarks summary for the period of <u>$from to $to</u>";


        ?>
        <?php
        include("config.php");
        $wp_grade_array=array();
        $subjects_array=array();

        $result=mysql_query("SELECT wp_grade FROM monthly_remarks where date_inputed >='$from' and date_inputed <='$to' group by wp_grade");
        while ($row=mysql_fetch_array($result)) {
            array_push($wp_grade_array,$row['wp_grade']);
        }

        $result=mysql_query("SELECT subject FROM monthly_remarks where date_inputed >='$from' and date_inputed <='$to' group by subject");
        while ($row=mysql_fetch_array($result)) {
            array_push($subjects_array,$row['subject']);
        }

        $wp_grade_array=array_unique($wp_grade_array);
        $subjects_array=array_unique($subjects_array);

        foreach($wp_grade_array as $wp_grade) {
            $query=mysql_query("SELECT * FROM monthly where    ");
        }

        ?>



        <table>


        </table>
    </div>
</div>


<div class="clear">

</div>



<div class="clear">

</div>

