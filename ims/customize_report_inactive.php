<?php include("templates/template.php"); ?><style>    table{        font-size:12.5px;    }    .total{        background-color: yellow;        font-weight: bold;    }    th{        width:500px;    }    #totalFooter{        background-color: yellow;        font-weight: bold;    }</style><?php include("config.php");
$wp_array=array();
$supplier_array=array();
$deliveries_per_month=array();
?>
<script>
    function monthlyRemarks(str) {
        var x = screen.width/2 - 700/2;
        var y = screen.height/2 - 450/2;
        window.open("monthlyRemarks.php?id="+str,'mywindow','width=800,height=500');
    }
    function editCharacter(str){


        window.open("frmEditCharacter.php?id="+str,'mywindow','width=400,height=400');
    }
</script>
<style>
    th{
        font-size: 11px;
    }
    button{
        border-style:hidden;
        background-color:transparent;
        font-size: 11px;
    }
    #weekly{
        background-color:#FFE6B2;
    }
    #TARGET{
        background-color:#FFEBC2;
        font-weight:bold;
    }
    #percentage{
        background-color:#FFF0D1;

    }
    td{
        background-color:#FFF5E0;
        font-size:10px;
    }
    #left_header{
        background-color:#FFFAF0;
        font-size: 10px;
    }
    #view_brkdwn{
        font-size: 11px;
    }
    #static_size{
        width:200px;
        height:50px;

    }
    #price{
        background-color:#EBE0CC;
    }

</style>
<div class="grid_50" >
    <div class="box round first grid">
        <h2><?php $ngayon=date('F d, Y');
            $start_date=$_POST['start_date'];
            $breaker_date=$_POST['end_date'];
            $filtering_grade=$_POST['wp_grade'];
            $filtering_branch=$_POST['branch'];
            $remarks_date=$_SESSION['weekly_year']."/".date("m",strtotime($_SESSION['weekly_month']));
            if(strtoupper($filtering_branch)!='') {
                if($filtering_grade!='') {
                    echo "<h2>".strtoupper($filtering_branch)." Suppliers Weekly Receiving for the period <u>$start_date to $breaker_date</u> in MT on ".$filtering_grade."</h2>";
                }else {
                    echo "<h2>".strtoupper($filtering_branch)." Suppliers Weekly Receiving for the period <u>$start_date to $breaker_date</u>  in MT on all grades</h2>";
                }
            }else {
                if($filtering_grade!='') {
                    echo "<h2>CONSOLIDATED Suppliers Weekly Receiving for the period <u>$start_date to $breaker_date</u> in MT on wp grade: ".$filtering_grade."</h2>";
                }else {
                    echo "<h2>CONSOLIDATED Suppliers Weekly Receiving for the period <u>$start_date to $breaker_date</u> in MT on all grades</h2>";
                }
            }
            ?>

            <table class="data display datatable" id="example">
                <?php
                $total_array=array();
                $weeks_array=array();
                $months_array=array();
                $remarks_array=array();
                $remarks_start_date_array=preg_split("[/]",$start_date);
                $remarks_end_date_array=preg_split("[/]",$breaker_date);
                $remarks_start_date=$remarks_start_date_array[0]."/".$remarks_start_date_array[1];
                $remarks_end_date=$remarks_end_date_array[0]."/".$remarks_end_date_array[1];
                $query21="SELECT * FROM monthly_remarks where date>='$remarks_start_date' and date<='$remarks_end_date'  ";
                $result21=mysql_query($query21);

                while($row21 = mysql_fetch_array($result21)) {
                    $remarks_array[$row21['supplier_id']]=$row21['remarks'];

                }
                if($filtering_branch=='Sauyo/Kaybiga') {
                    $query="SELECT month_delivered,year_delivered FROM sup_deliveries where date_delivered >='$start_date' and date_delivered<='$breaker_date' and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') group by  month_delivered,year_delivered  order by date_delivered";

                }else {
                    $query="SELECT month_delivered,year_delivered  FROM sup_deliveries where  date_delivered >='$start_date' and date_delivered<='$breaker_date'  and branch_delivered like '%".$filtering_branch."%' group by  year_delivered,month_delivered   order by date_delivered";


                }

                $supplier_details_array=array();
                if($filtering_branch=='Sauyo/Kaybiga') {
                    $query40="SELECT * from supplier_details where branch='Sauyo' or branch='Kaybiga' " ;
                }else {
                    $query40="SELECT * from supplier_details where branch like '%$filtering_branch%' " ;
                    
                }
                $result40=mysql_query($query40);
                while($row40 = mysql_fetch_array($result40)) {
                    $supplier_details_array[$row40['supplier_id']]=($row40['supplier_name']."+".$row40['branch']."+".$row40['style']);
                }

                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($weeks_array,$row['month_delivered']."-".$row['year_delivered']);
                    array_push($months_array,$row['month_delivered']."-".$row['year_delivered']);
                }

                if($filtering_branch=='Sauyo/Kaybiga') {
                    $query5="SELECT sum(weight),month_delivered,supplier_id,date_delivered,year_delivered from sup_deliveries where   date_delivered >='$start_date' and  date_delivered <='$breaker_date' and wp_grade like '%".$filtering_grade."%' and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  group by  supplier_id,month_delivered,year_delivered order by date_delivered";
                }else {
                    $query5="SELECT sum(weight),month_delivered,supplier_id,date_delivered,year_delivered from sup_deliveries where    date_delivered >='$start_date' and date_delivered <='$breaker_date' and wp_grade like '%".$filtering_grade."%' and branch_delivered like '%".$filtering_branch."%' group by  supplier_id,month_delivered,year_delivered order by date_delivered";
                }
                $result5 =mysql_query($query5);
                while($row5 = mysql_fetch_array($result5)) {
                    $deliveries_per_month[$row5['supplier_id']."+".ucfirst(strtolower($row5['month_delivered']))."-".$row5['year_delivered']]=(($row5['sum(weight)'])/1000);
                }
                $supplier_head_count=0;
                echo "<thead>";
                echo "<th>ID</th>";
                echo "<th>Supplier Name</th>";
                echo "<th>Branch Registered</th>";
                echo "<th>Character</th>";
                foreach ($weeks_array as $value) {
                    echo "<th>".$value."</th>";
                }
                echo "<th>____Remarks____</th>";
                echo "</thead>";
                if($filtering_branch=='Sauyo/Kaybiga') {
                    $query="SELECT supplier_id FROM supplier_details where  branch ='Kaybiga' or branch ='Sauyo' group by supplier_id";
                }else {
                    $query="SELECT supplier_id FROM supplier_details where  branch like '%".$filtering_branch."%'    group by supplier_id";
                }
                $result=mysql_query($query);
                while($row = mysql_fetch_array($result)) {
                    array_push($supplier_array,$row['supplier_id']);
                }
                $supplier_array=array_unique($supplier_array);
                foreach ($supplier_array as $value2) {
                    $total_per_branch=0;
                    echo "<tr class='data'>";
                    if(!empty($supplier_details_array[$value2])) {
                        $supplier_details= $supplier_details_array[$value2];
                        $supplier_details=preg_split("/[+]/",$supplier_details);
                        echo "<td id='' class='data' >".$value2."</td>";
                        echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$_SESSION['weekly_year']." && wp_grade=".$filtering_grade."' id='view_brkdwn' >".$supplier_details[0]."</a></td>";
                        echo "<td id='left_header' >".$supplier_details[1]."</td>";
                        // echo "<td id='left_header' >".$supplier_details[2]."</td>";
                        if($supplier_details[2]!='') {
                            echo "<td id='left_header'><button  value='".$value2."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>".$supplier_details[2]."</i></u></button></td>";
                        }else {
                            echo "<td id='left_header'><button  value='".$value2."' onclick='editCharacter(this.value);'><u style='color:blue; font-size:10'><i>edit</i></u></button></td>";
                        }
                    }else {
                        echo "<td id='' >".$value2."</td>";
                        echo "<td id='left_header' >"."<a rel='facebox' href='view_delivery_brkdwn.php?sup_id=$value2 && year=".$_SESSION['weekly_year']." && wp_grade=".$filtering_grade."' id='view_brkdwn' >UNKNOWN</a></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";
                        echo "<td id='left_header' ><i>Undefined</i></td>";

                    }
                    foreach($months_array as $months) {
                        $key_finder2=$value2."+".$months;
                        $filtering_tool=$value2."_".$months;
                        if(!empty($deliveries_per_month[$key_finder2])) {
                            echo "<td>".round($deliveries_per_month[$key_finder2],2)."</td>";
                        }
                        else {
                            echo "<td>-</td>";
                        }
                    }
                    if(!empty($remarks_array[$value2])) {
                        echo "<td><div style='overflow:scroll; overflow-x:hidden; width:350px;height:60px;'>";
                        $remarks=$remarks_array[$value2];
                        $comment_date_array=preg_split("[/]",$breaker_date);
                        echo $remarks;

                        echo "</div>
                               <button  value='".$value2."_".$comment_date_array[1]."_".$comment_date_array[0]."' onclick='monthlyRemarks(this.value);'><u style='color:blue; font-size:10'><i>comment</i></u></button>
                             </td>";

                    }else {
                        $comment_date_array=preg_split("[/]",$breaker_date);
                        echo " <td>
                               <button  value='".$value2."_".$comment_date_array[1]."_".$comment_date_array[0]."' onclick='monthlyRemarks(this.value);'><u style='color:blue; font-size:10'><i>comment</i></u></button>
                             </td>";
                    }
                    echo "</tr>";
                    $supplier_head_count++;
                }
                echo "<tr class='data'>";
                echo "<td class='TOTAL' >!TOTAL!</td>";
                echo "<td class='TOTAL' >Head Count: $supplier_head_count</td>";
                echo "<td class='TOTAL' ></td>";
                echo "<td class='TOTAL' ></td>";
                foreach($months_array as $var) {
                    $total_date=preg_split("/[-]/",$var);
                    $month=$total_date[0];
                    $year=$total_date[1];
                    if(trim($filtering_grade)!='') {
                        if($filtering_branch=='Sauyo/Kaybiga') {
                            $query31="SELECT sum(weight)/1000 as weight,month_delivered,year_delivered FROM sup_deliveries where  wp_grade='".$filtering_grade."' and year_delivered='$year' and month_delivered ='$month' and   (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo')  ";
                        }else {
                            $query31="SELECT sum(weight)/1000 as weight, month_delivered,year_delivered FROM sup_deliveries where  wp_grade='".$filtering_grade."' and year_delivered='$year' and month_delivered ='$month' and branch_delivered like '%".$filtering_branch."%'  ";
                        }
                    }else {
                        if($filtering_branch=='Sauyo/Kaybiga') {
                            $query31="SELECT sum(weight)/1000 as weight,month_delivered,year_delivered FROM sup_deliveries where year_delivered='".$year."' and month_delivered ='$month'  and (branch_delivered ='Kaybiga' or branch_delivered ='Sauyo') ";
                        }else {
                            $query31="SELECT sum(weight)/1000 as weight,month_delivered,year_delivered FROM sup_deliveries where year_delivered='".$year."' and month_delivered ='$month'  and branch_delivered like '%".$filtering_branch."%'  ";
                        }
                    }
                    $result31=mysql_query($query31);
                    if($row31 = mysql_fetch_array($result31)) {
                        echo "<td class='TOTAL' >".round($row31['weight'],2)."</td>";
                    }else {
                        echo "<td class='TOTAL' >-</td>";
                    }
                }
                echo "<td class='TOTAL' ></td>";
                ?>
            </table>
    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>
<div class="clear">

</div>
