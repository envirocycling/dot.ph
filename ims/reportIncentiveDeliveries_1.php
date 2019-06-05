<style>
    #prepared_by{
        position:absolute;
        margin-top:350px;
    }

    #table{
        position:absolute;
        margin-left: 400px;
    }

    #supplier_details{
        position:absolute;
        margin-top:20px;
        font-size:20px;

    }
    #supplier_details table{
        text-align:right;

        font-size:22px;
    }
    #supplier_details td{
        padding:10px;


    }
    body{
        margin-top:80px;
        margin-left:50px;
        font-size:20px;
        padding:10px;
    }

</style>

<body>

    <?php
    include ("config.php");
    $sup_id=$_POST['sup_id'];
    $wp_grade=$_POST['wp_grade'];
    $scheme=$_POST['scheme'];
    $quota=$_POST['quota'];
    $incentive=$_POST['incentive'];
    $supplier_name=$_POST['supplier_name'];

    echo "<h3>Supplier with Quota On <b><u><i>".$wp_grade."</i></u></b> for the period of <b><u><i>".$scheme."</i></u></b></h3>";




    $range_date_array=preg_split('/[ -.]/',$scheme);

    $query="select date_delivered,weight,branch_delivered from sup_deliveries where  date_delivered  between '".$range_date_array[0]."' and '".$range_date_array[1]."' and supplier_id='$sup_id' and wp_grade='$wp_grade' and weight>1;";
    $result=mysql_query($query);
    echo "<table border=1 id='table'>";
    echo "<thead>";
    echo "<th>Date Delivered</th>";
    echo "<th>Weight</th>";
    echo "<th>Branch Delivered</th>";
    while($row = mysql_fetch_array($result)) {
        echo "<tr class='light'>";
        echo "<td>".$row['date_delivered']."</td>";
        echo "<td>".$row['weight']."</td>";
        echo "<td>".$row['branch_delivered']."</td>";
        echo "</tr>";

    }
    echo "</table>";



    ?>

    <div id="prepared_by">
        Prepared By:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________ <br><br><br>
        Verified By:<br>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;____________________________ <br><br><br>
        Approved By:<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ____________________________ <br><br><br>



    </div>

    <?php

    $query="SELECT * FROM incentive_scheme where sup_id='$sup_id' and wp_grade='$wp_grade'";
    $result=mysql_query($query);
    $row = mysql_fetch_array($result);


    echo "<div id='supplier_details'>";
    echo "<table border=0>";
    echo "<tr>";
    echo "<td>"."Name:"."</td>";
    echo "<u><td><u>".$supplier_name."</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>"."Quota:"."</td>";
    echo "<u><td><u>".$quota."</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>"."Per KGS:"."</td>";
    echo "<u><td><u>".$incentive."</td></u>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>"."Incentive:"."</td>";
    echo "<u><td><u>".$row['computed_incentive']."</td></u>";
    echo "</tr>";

    echo "</tale>";

    echo "</div>";

    ?>

</body>
