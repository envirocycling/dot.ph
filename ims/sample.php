<!DOCTYPE html>
<html>

    <head>
        <style>
            h1 {
                border-bottom: 3px solid #cc9900;
                color: #996600;
                font-size: 30px;
            }
            table, th , td {
                border: 1px solid grey;
                border-collapse: collapse;
                padding: 5px;
            }
            table tr:nth-child(odd) {
                background-color: #f1f1f1;
            }
            table tr:nth-child(even) {
                background-color: #ffffff;
            }
        </style>
    </head>

    <body>

        <h1>Customers</h1>
        <p id="demo"></p>

        <script>
            var text = '<?php
ini_set('max_execution_time', 1000);
include 'config.php';
$outp = '{"supplier":[';
$outp2 = '';
$supplier_id_array = array ();
$supplier_capacity = array ();
$supplier_name = array ();
$supplier_unit_cost = array ();
$sql_sup = mysql_query("SELECT supplier_id,supplier_name FROM supplier_details WHERE status!='inactive' and branch='Mangaldan'");
while ($rs_sup = mysql_fetch_array($sql_sup)) {
    array_push ($supplier_id_array,$rs_sup['supplier_id']);
    $supplier_name[$rs_sup['supplier_id']]=$rs_sup['supplier_name'];

    $sql_cap = mysql_query("SELECT capacity FROM supplier_capacity WHERE supplier_id='".$rs_sup['supplier_id']."' and wp_grade like '%LCWL%' and date_effective<='2015/02/13' ORDER BY date_effective DESC LIMIT 1");
    $rs_cap = mysql_fetch_array($sql_cap);
    $supplier_capacity[$rs_sup['supplier_id']]=$rs_cap['capacity'];

    $sql_cost = mysql_query("SELECT unit_cost FROM paper_buying WHERE wp_grade like '%LCWL%' and date_received<='2015/03/15' and supplier_id='".$rs_sup['supplier_id']."'");
    $rs_cost = mysql_fetch_array($sql_cost);
    $supplier_unit_cost[$rs_sup['supplier_id']]=$rs_cost['unit_cost'];
}
foreach ($supplier_id_array as $supplier_id) {
    $outp2 .= ',{"supplier_id":"'.$supplier_id.'","supplier_name":"'.$supplier_name[$supplier_id].'"';

    $outp2 .= ',"capacity":"'.$supplier_capacity[$supplier_id].'"';

    $outp2 .= ',"unit_cost":"'.$supplier_unit_cost[$supplier_id].'"';

    $start_q = '2014/10/01';
    while ($start_q < '2015/02/13') {
        $month_q = date("F", strtotime($start_q));
        $year_q = date("Y", strtotime($start_q));
        $sql_del = mysql_query("SELECT sum(weight) FROM sup_deliveries WHERE supplier_id='$supplier_id' and wp_grade like '%LCWL%' and month_delivered='$month_q' and year_delivered='$year_q'");
        $rs_del = mysql_fetch_array($sql_del);

        $outp2 .= ',"'.$month_q.''.$year_q.'":"'.$rs_del['sum(weight)'].'"';
        $start_q = date("Y/m/d", strtotime("+1 month", strtotime($start_q)));
    }

    $outp2 .= ' }';
}
$outp2 = substr($outp2,1);
$outp =$outp."".$outp2."]}";
echo $outp;
?>';
    obj = JSON.parse(text);
    var val = '';
    var outi = '';
    var i = 0;
    while (obj.supplier[i].supplier_id != '') {
        val += obj.supplier[i].supplier_id + " " + obj.supplier[i].supplier_name + " " + obj.supplier[i].capacity + " " + obj.supplier[i].unit_cost + " " + obj.supplier[i].October2014 +" " + obj.supplier[i].November2014 + " " + obj.supplier[i].December2014 + " " + obj.supplier[i].January2015 + " " + obj.supplier[i].February2015 +"<br>";
        i++;
        document.getElementById("demo").innerHTML = val;
    }
        </script>
    </body>
</html>