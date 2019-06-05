<?php
include("templates/template.php");
$_SESSION['receiving_del_ids']=array();
?>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date2(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"
        });
    };
</script>
<style>
    #total{
        font-weight: bold;
        background-color: yellow;
    }
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
    marquee{
        font-weight:bold;
        color:red;
    }
    #highlighted td{
        background-color: #65EC3B;
        color:red;
    }
</style>
<script type="text/javascript">
    function addReceiving(str) {
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
        xmlhttp.open("GET","sessionista_add_receiving.php?del_id="+str,true);
        xmlhttp.send();

    }




</script>


<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="filter_receiving.php" method="POST">
            As of: <input type='text'  id='outgoing_filterer' name='date' value="<?php echo $_SESSION['receiving_date'];?>" onfocus='date2(this.id);' readonly size="8"><br>
            WP Grade:<input type="text" value="<?php echo $_SESSION['receiving_grade'];?>" name="wp_grade"><br>
            <input type="submit" value="Filter">
        </form>
        <a href="clear_filter_receiving.php"><button>Clear Filter</button></a>
    </div>
</div>


<div class="grid_10">
    <div class="box round first grid">
        <?php
        $ngayon=date('F d, Y');
        $branch=$_SESSION['receiving_branch'];
        if($branch=='all') {
            $branch='';
        }
        $total_receiving=0;
        echo "<h2> ".$_SESSION['receiving_branch']." WP Receiving as of : <u><b><i>".$_SESSION['receiving_date']."</i></b></u></h2>";
        ?>
        <table class="data display datatable" id="example">
            <?php
            echo "<thead>";
            echo '<tr class="data" id="highlight">';
            echo "<th class='data'></th>";
            echo "<th class='data'>Date</th>";
            echo "<th class='data'>&nbsp;</th>";

            echo "<th class='data'>Prior #</th>";
            echo "<th class='data'>Supplier ID</th>";
            echo "<th class='data'>Supplier Name</th>";
            echo "<th class='data'>Plate #</th>";
            echo "<th class='data'>WP Grade</th>";
            echo "<th class='data'>Weight</th>";
            echo "<th class='data'>MC %</th>";
            echo "<th class='data'>MC Wt</th>";
            echo "<th class='data'>Dirt %</th>";
            echo "<th class='data'>Dirt Weight</th>";
            if($branch=='') {
                echo "<th class='data'>Branch Delivered</th>";
            }
            echo "<th class='data'>Corrected Weight</th>";
            echo "<th class='data'>Remarks</th>";

            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            include("config.php");

            $total_corrected_weight=0;
            $receiving_date=$_SESSION['receiving_date'];
            $receiving_date_month=date("Y/m",strtotime($receiving_date));

            $query="SELECT * from sup_deliveries where branch_delivered like '%$branch%' and date_delivered like '%".$receiving_date_month."%' and date_delivered <='$receiving_date' and wp_grade like '%".$_SESSION['receiving_grade']."%'";
            $result=mysql_query($query);
            while($row = mysql_fetch_array($result)) {
                if($row['is_highlighted']=='yes') {
                    echo "<tr id='highlighted'>";
                }else {
                    echo "<tr>";

                }
                $del_id= $row['del_id'];
                echo "<td>"."<input type='checkbox' name='$del_id'  value='".$del_id."' onclick='addReceiving($del_id);'>"."</td>";
                echo "<td>".$row['date_delivered']."</td>";
                if($row['notations']!='') {
                    echo "<td><h3><marquee behavior='alternate' title='".$row['notations']."'>".$row['alert']."</marquee></h3></td>";
                }else {
                    echo "<td><h3><marquee behavior='alternate' title='Kindly Check'>".$row['alert']."</marquee></h3></td>";

                }
                echo "<td>".$row['priority_number']."</td>";
                echo "<td>".$row['supplier_id']."</td>";
                echo "<td>".$row['supplier_name']."</td>";
                echo "<td>".$row['plate_number']."</td>";
                echo "<td>".$row['wp_grade']."</td>";
                echo "<td id='net'>".($row['weight']+$row['mc_weight']+$row['dirt_weight'])."</td>";
                echo "<td id='mc'>".$row['mc_percentage']."</td>";
                echo "<td id='mc'>".$row['mc_weight']."</td>";
                echo "<td id='dirt'>".$row['dirt_percentage']."</td>";
                echo "<td id='dirt'>".$row['dirt_weight']."</td>";
                if($branch=='') {
                    echo "<td>".$row['branch_delivered']."</td>";
                }

                echo "<td id='corrected'>".($row['weight'])."</td>";
                $total_corrected_weight+=($row['weight']);

                if($row['remarks']!='') {
                    echo "<td id='dr'>".$row['remarks']."</td>";
                }else if($row['remarks']!='') {
                    echo "<td id='dr'>".$row['last_remarks']."</td>";

                }else {
                    echo "<td id='dr'>".$row['notations']."</td>";

                }
                echo "<td><a  rel='facebox' href='frmBackload.php?del_id=".$row['del_id']."' title='click to input backload details'>B</a>|
                 <a rel='facebox'  href='frmMcDirt.php?del_id=".$row['del_id']."' title='Click to input corrected weight'>C</a>|
              <a  href='mark.php?del_id=".$row['del_id']."' title='Click to highlight row'>A|
                 </a>
                    <a  rel='facebox' href='frm_notation.php?del_id=".$row['del_id']."' title='Click to highlight row'>N
                 </a>
                
</td>";
                echo "</tr>";
                $total_receiving+=($row['weight']+$row['mc_weight']+$row['dirt_weight']);
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
            echo "<td id='total'>".number_format($total_receiving,2)."</td>";
            if($branch=='') {
                echo "<td id='total'></td>";
            }
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "<td id='total'>$total_corrected_weight</td>";
            echo "<td id='total'></td>";
            echo "<td id='total'></td>";
            echo "</tr>";
            ?>
        </table>
        <?php
        echo "<a rel='facebox.php' href='frmDeleteReceiving.php?branch=$branch'><img src='icon/bura.png'></a>";
        echo "<a href='highlight_receiving.php'><img src='icon/highlight.png' width='30px;' title='highlight selected records'></a>";
        ?>


    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>