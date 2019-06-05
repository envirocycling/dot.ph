<?php
include("templates/template.php");

$_SESSION['outgoing_log_ids']=array();
$_SESSION['outgoing_date']=date('Y/m',strtotime($_SESSION['outgoing_date']));
?>
<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
    #highlight{
        background-color:85EB6A;
        color:black;
    }

    #highlight a{
        background-color:85EB6A;
        color:black;
    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date2(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m"

        });
    };
</script>
<style>
    #link_ng_str{
        color:blue;
    }
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
    #highlighted td{
        background-color: #65EC3B;
        color:red;
    }
</style>
<script type="text/javascript">
    function addOutgoing(str) {
        if (str=="")
        {
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }

        xmlhttp.open("OPEN","sessionista_add_outgoing.php?log_id="+str,true);
        xmlhttp.send();

    }




</script>


<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="filter_outgoing.php" method="POST">
            Date: <input type='text'  id='outgoing_filterer' name='date' value="<?php echo $_SESSION['outgoing_date'];?>" onfocus='date2(this.id);' readonly size="8"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_filter_outgoing.php"><button>Clear Filter</button></a>
    </div>
</div>

<div class="grid_12">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['selected_branch'];
        echo "<h2> ".$_SESSION['selected_branch']." OUTGOING DELIVERIES as of : <u><b><i>".$_SESSION['outgoing_date']."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data"> ';
            echo "<th class='data'></th>";
            echo "<th class='data'>Delivery Date</th>";
            echo "<th class='data'>STR #</th>";
            echo "<th class='data'>Branch</th>";
            echo "<th class='data'>Delivered To</th>";
            echo "<th class='data'>Trucking</th>";
            echo "<th class='data'>Plate Number</th>";
            echo "<th class='data'>Trucking Fee</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>No. of Bales</th>";
            echo "<th class='data'>From Loc. Wt.</th>";
            echo "<th class='data'>Avg. Wt. per Bale</th>";
            echo "<th class='data'>NET Weight</th>";
            echo "<th class='data'>Variance</th>";
            echo "<th class='data'>MC</th>";
            echo "<th class='data'>Dirt</th>";
            echo "<th class='data'>Corrected Wt.</th>";
            echo "<th class='data'>DR #</th>";
            echo "<th class='data'>Remarks</th>";
            echo "<th class='data'>Notations</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");
            $total_from_loc=0;
            $total_net_weight=0;
            $total_variance=0;
            $total_mc=0;
            $total_dirt=0;
            $total_corrected=0;
            $total_dr=0;

            $query="SELECT log_id,notations,trucking_fee,sum(weight),date,str,branch,trucking,plate_number,wp_grade,remarks,is_marked,log_id FROM outgoing where branch='$branch' and str !='VOID' and date like '%".$_SESSION['outgoing_date']."%' group by str,wp_grade";
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                $str_number=$row['str'];
                $del_id=$row['log_id'];
                $log_id=0;
                if (preg_match('/DR/',$str_number) ) {
                    $str_number=preg_split("[_]",$str_number);
                    $str_number=$str_number[1];

                    $query2="SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt  FROM actual where str_no like '%".$str_number."%' and wp_grade='".$row['wp_grade']."' group by str_no";
                    // $query2="SELECT delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt  FROM actual where dr_number = '".$dr_number."' and wp_grade='".$row['wp_grade']."' group by str_no";
                }else {
                    $query2="SELECT log_id,delivered_to,dr_number,sum(weight)as weight,mc,dirt,sum(net_wt) as net_wt  FROM actual where str_no like '%".$str_number."%' and wp_grade='".$row['wp_grade']."' group by str_no";
                }
                $result2=mysql_query($query2);
                if($row2 = mysql_fetch_array($result2)) {
                    $netwt=$row2['weight'];
                }else {
                    $netwt="";
                }
                if($row['is_marked']=="!") {
                    echo "<tr class='data' id='highlighted' >";
                }else {
                    echo "<tr class='data'>";
                }


                echo "<td>"."<input type='checkbox' name='$del_id'  id='$del_id' value='".$del_id."' onclick='addOutgoing(this.id);'>"."</td>";
                echo "<td class='data' >".$row['date']."</td>";
                echo "<td class='data'><u id='link_ng_str'><a rel='facebox' ";
                $query10="SELECT * from actual where str_no ='".$row['str']."'";
                $result10=mysql_query($query10);
                echo "title='";
                while($row10 = mysql_fetch_array($result10)) {
                    echo $row10['wp_grade'].": ".$row10['weight']."\r\n";
                }
                echo "'";
                echo "href='frmAddNetweight.php?str=".$row['str']."&wp_grade=".$row['wp_grade']."'>".$row['str']."</a></u></td>";
                echo "<td class='data'>".$row['branch']."</td>";
                echo "<td class='data'>".$row2['delivered_to']."</td>";
                $log_id=$row2['log_id'];
                echo "<td class='data'>".$row['trucking']."</td>";
                echo "<td class='data'>".$row['plate_number']."</td>";
                echo "<td class='data'>".$row['trucking_fee']."</td>";
                echo "<td class='data'><u><a rel='facebox' href='upgrade_downgrade.php?str=".$row['str']."&wp_grade=".$row['wp_grade']."' title='Click to UPGRADE/DOWNGRADE'>".$row['wp_grade']."</a></u></td>";
                echo "<td>";
                $bale_count_grade='';
                $bale_count_grade=$row['wp_grade'];
                if($row['wp_grade']!='LCWL' && $row['wp_grade']!='CHIPBOARD'  && $row['wp_grade']!='LCCB') {
                    $bale_count_grade= substr($row['wp_grade'], 2);
                }


                $query21="SELECT * from bales where str_no like '%".$row['str']."%' and wp_grade='".$bale_count_grade."'";
                $result21=mysql_query($query21);
                $bale_count=0;
                while($row21 = mysql_fetch_array($result21)) {
                    $bale_count++;
                }
                echo $bale_count;
                echo "</td>";
                if($row['is_marked']=="yes") {
                    echo "<td id='higlight'>".$row['sum(weight)']."</td>";
                }else {
                    echo "<td id='from_location'>".$row['sum(weight)']."</td>";

                }
                if($bale_count>0) {

                    echo "<td id=''>".number_format(($row['sum(weight)']/$bale_count), 2, '.', '')."</td>";
                }else {
                    echo "<td id=''>".number_format(0,2)."</td>";


                }

                $netnet_wt=0;
                if($row2['net_wt']<1) {
                    if($row['is_marked']=="yes") {
                        echo "<td class='data' id='highlight'>".$row2['weight']."</td>";
                    }else {
                        echo "<td class='data' id='net'>".$row2['weight']."</td>";

                    }
                    $netnet_wt=$row2['weight'];
                }else {
                    if($row['is_marked']=="yes") {
                        echo "<td class='data' id='highlight'>".$row2['net_wt']."</td>";
                    }else {
                        echo "<td class='data' id='net'>".$row2['net_wt']."</td>";

                    }
                    $netnet_wt=$row2['net_wt'];
                }
                $variance=($netnet_wt-$row['sum(weight)']);
                $variance_number=$variance;
                if($variance<0) {
                    $variance=$variance*-1;
                    $variance="(".$variance.")";
                    if($row['is_marked']=="yes") {
                        echo "<td class='data' id='highlight'>".$variance."</td>";
                    }else {
                        echo "<td class='data' id='negative'>".$variance."</td>";

                    }
                }else if ($variance==0) {
                    if($row['is_marked']=="yes") {
                        echo "<td class='data' id='highlight'>".$variance."</td>";
                    }else {
                        echo "<td class='data' id='zero'>".$variance."</td>";

                    }
                }else {
                    if($row['is_marked']=="yes") {
                        echo "<td class='data' id='highlight'>".$variance."</td>";
                    }else {
                        echo "<td class='data' id='positive'>".$variance."</td>";

                    }
                }
                if($row['is_marked']=="yes") {
                    echo "<td class='data' id='highlight'>".$row2['mc']."</td>";
                }else {
                    echo "<td class='data' id='mc'>".$row2['mc']."</td>";

                }

                if($row['is_marked']=="yes") {
                    echo "<td class='data' id='highlight'>".$row2['dirt']."</td>";
                }else {
                    echo "<td class='data' id='dirt'>".$row2['dirt']."</td>";
                }

                if($row['is_marked']=="yes") {
                    echo "<td id='highlight'>".$netwt."</td>";
                }else {
                    echo "<td id='corrected'>".$netwt."</td>";

                }

                if($row['is_marked']=="yes") {
                    echo "<td class='data' id='highlight'>".$row2['dr_number']."</td>";
                }else {
                    echo "<td class='data' id='dr'>".$row2['dr_number']."</td>";

                }
                echo "<td class='data'>".$row['remarks']."</td>";
                echo "<td class='data'>".$row['notations']."</td>";
                if($row['is_marked']=='yes') {
                    echo "<td class='data'><a href='highlight_outgoing.php?log_id=".$row['log_id']."' title='Click to Remove Highlight'><img src='icon/mark.png'></a><a href='delete_one_actual.php?log_id=".$log_id."' title='Click to Erase Encoded Actual'><img src='icon/bura.png' ></a></td>";
                }else {
                    echo "<td class='data'><a href='delete_one_actual.php?log_id=".$log_id."' title='Click to Erase Encoded Actual'><img src='icon/bura.png'></a><a rel='facebox' href='outgoing_frm_notation.php?log_id=".$row['log_id']."'>N</a></td>";
                }


                echo "</tr>";

                $total_from_loc +=$row['sum(weight)']  ;
                $total_net_weight +=$netnet_wt  ;
                $total_variance+=$variance_number;
                $total_mc+=$row2['mc'];
                $total_dirt+=$row2['dirt'];
                $total_corrected+=$netwt;
            }


            echo "<tr>";
            echo "<td id='total'></td>";
            echo "<td id='total'>z_TOTAL_z</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'>".number_format($total_from_loc,2)."</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'>".number_format($total_net_weight,2)."</td>";
            echo "<td id='total'>".number_format($total_variance,2)."</td>";
            echo "<td id='total'>".number_format($total_mc,2)."</td>";
            echo "<td id='total'>".number_format($total_dirt,2)."</td>";
            echo "<td id='total'>".number_format($total_corrected,2)."</td>";
            echo "<td id='total'>".number_format($total_dr,2)."</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "</tr>";
            echo "</table>";
            if($_SESSION['usertype']=='Super User') {
                echo '<a rel="facebox" href="form_encode_outgoing.php?branch='.$_SESSION['selected_branch'].'"><button>Encode Outgoing</button></button></a>';
            }
            echo '<a rel="facebox" href="form_delete_manual_outgoing.php?branch='.$_SESSION['selected_branch'].'"><button>Delete Manually Encoded Outgoing</button></a>';
            echo '<a rel="facebox" href="form_delete_outgoing.php?branch='.$_SESSION['selected_branch'].'"><button>Delete Exported Outgoing</button></a>';
            echo '<a rel="facebox" href="form_delete_actual.php?branch='.$_SESSION['selected_branch'].'"><button>Delete Actual</button></a>';
            echo "<a href='highlight_outgoing.php'><img src='icon/highlight.png' width='30px;' title='highlight selected records'></a>";

            ?>

        </table>

    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>