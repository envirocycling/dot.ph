<?php include("templates/template.php");
include("config.php");?><style>    .total{        background-color:#C1CDCD;        font-weight:bold;    }    #totalbot th{        color:transparent;        background-color: white;    }    #totalbot{        position:relative;        top:-70px;        text-align:right;    }    #botcontainer{        border-style:solid;        color:white;    }    #column_total{        text-align:right;    }</style><div class="grid_10">    <div class="box round first grid">        <h2>            <?php $ngayon=date('F d, Y');
            echo "<h2>".$_SESSION['selected_grade']." Deliveries as of : <u><b><i>".$ngayon."</i></b></u></h2>"; ?></h2>        <?php        if($_SESSION['usertype']=='Super User') {
                include("searchForm.php");
                echo "<hr>";
                include("summary.php");
            }        ?>
        <table class="data display datatable" id="example">
            <?php
            $months_array=array("January","February","March","April","May","June","July","August","September","October","November","December");
            echo "<thead>";
            echo "<th>Supplier Name</th>";
            foreach ($months_array as $value) {
                echo "<th>".$value."</th>";
            }            echo










            "<th id='total'>TOTAL</th>";
            echo "<th id='total'>AVG</th>";
            echo "</thead>";
            if($_SESSION['usertype']=='Super User') {
                if($_SESSION['selected_grade']=='all') {
                    $query="SELECT supplier_name,count(supplier_name) FROM sup_deliveries  where  supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_name like '%".$_SESSION['supplier_name']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_type like '%".$_SESSION['supplier_type']."%'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name order by supplier_name asc,del_id asc;";
                }else {
                    $query="SELECT supplier_name,count(supplier_name) FROM sup_deliveries  where wp_grade='".$_SESSION['selected_grade']."' and supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_name like '%".$_SESSION['supplier_name']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_type like '%".$_SESSION['supplier_type']."%'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name order by supplier_name asc,del_id asc;";
                }
            }
            else {
                if($_SESSION['selected_grade']=='all') {
                    $query="SELECT supplier_name,count(supplier_name) FROM sup_deliveries  where  supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered = '".$_SESSION['user_branch']."' and supplier_name like '%".$_SESSION['supplier_name']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_type like '%".$_SESSION['supplier_type']."%'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name order by supplier_name asc,del_id asc;";
                }else {
                    $query="SELECT supplier_name,count(supplier_name) FROM sup_deliveries  where wp_grade='".$_SESSION['selected_grade']."' and supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered = '".$_SESSION['user_branch']."' and supplier_name like '%".$_SESSION['supplier_name']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_type like '%".$_SESSION['supplier_type']."%'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name order by supplier_name asc,del_id asc;";
                }
            }
            $result =mysql_query($query);
            $supplier_array=array();
            while($row = mysql_fetch_array($result)) {
                array_push($supplier_array,$row['supplier_name']) ;
                $head_count=$row['count(supplier_name)'];
            }
            $deliveries_array=array();
            if($_SESSION['usertype']=='Super User') {
                if($_SESSION['selected_grade']=='all') {
                    $query3="SELECT supplier_id,del_id,supplier_name,sum(weight),month_delivered FROM sup_deliveries  where supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_name like '%".$_SESSION['supplier_name']."%'  and supplier_type like '%".$_SESSION['supplier_type']."%'  and  year_delivered ='".$_SESSION['yearcriteria']."'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name,month_delivered order by supplier_name asc,del_id asc;";
                }else {
                    $query3="SELECT supplier_id,del_id,supplier_name,sum(weight),month_delivered FROM sup_deliveries  where wp_grade='".$_SESSION['selected_grade']."' and supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered like '%".$_SESSION['supplier_branch']."%' and supplier_name like '%".$_SESSION['supplier_name']."%'  and supplier_type like '%".$_SESSION['supplier_type']."%'  and  year_delivered ='".$_SESSION['yearcriteria']."'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name,month_delivered order by supplier_name asc,del_id asc;";
                }
            }
            else {
                if($_SESSION['selected_grade']=='all') {
                    $query3="SELECT supplier_id,del_id,supplier_name,sum(weight),month_delivered FROM sup_deliveries  where supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered = '".$_SESSION['user_branch']."' and supplier_name like '%".$_SESSION['supplier_name']."%'  and supplier_type like '%".$_SESSION['supplier_type']."%'  and  year_delivered ='".$_SESSION['yearcriteria']."'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name,month_delivered order by supplier_name asc,del_id asc;";
                }else {
                    $query3="SELECT supplier_id,del_id,supplier_name,sum(weight),month_delivered FROM sup_deliveries  where wp_grade='".$_SESSION['selected_grade']."' and supplier_id like '".$_SESSION['supplier_id']."%' and branch_delivered = '".$_SESSION['user_branch']."' and supplier_name like '%".$_SESSION['supplier_name']."%'  and supplier_type like '%".$_SESSION['supplier_type']."%'  and  year_delivered ='".$_SESSION['yearcriteria']."'  and bh_in_charge like '".$_SESSION['bh_criteria']."%' group by supplier_name,month_delivered order by supplier_name asc,del_id asc;";
                }
            }
            $result3 =mysql_query($query3);
            while($row3 = mysql_fetch_array($result3)) {
                $deliveries_array[$row3['supplier_name']."+".ucfirst(strtolower($row3['month_delivered']))]=$row3['sum(weight)'];
            }
            $overall_total =0;
            $january_total=0;
            $february_total=0;
            $march_total=0;
            $april_total=0;
            $may_total=0;
            $june_total=0;
            $july_total=0;
            $august_total=0;
            $september_total=0;
            $october_total=0;
            $november_total=0;
            $december_total=0;
            foreach($supplier_array as $value2) {
                $total_per_sup=0;
                $overall_avg=0;
                echo "<tr class='data'>";
                echo "<td class='data'>".$value2."</td>";
                foreach($months_array as $value) {
                    $key_finder=$value2."+".$value;
                    if(!empty($deliveries_array[$key_finder])) {
                        echo "<td class='data'>".number_format($deliveries_array[$key_finder],1)."</td>";
                        $total_per_sup=$total_per_sup+$deliveries_array[$key_finder];
                        if($value=='January') {
                            $january_total=$january_total+$deliveries_array[$key_finder];
                        }else if($value=='February') {
                            $february_total=$february_total+$deliveries_array[$key_finder];
                        }else if($value=='March') {
                            $march_total=$march_total+$deliveries_array[$key_finder];
                        }else if($value=='April') {
                            $april_total=$april_total+$deliveries_array[$key_finder];
                        }else if($value=='May') {
                            $may_total=$may_total+$deliveries_array[$key_finder];
                        }                        else if($value=='June') {
                            $june_total=$june_total+$deliveries_array[$key_finder];
                        }                        else if($value=='July') {
                            $july_total=$july_total+$deliveries_array[$key_finder];
                        }                        else if($value=='August') {
                            $august_total=$august_total+$deliveries_array[$key_finder];
                        }else if($value=='September') {
                            $september_total=$september_total+$deliveries_array[$key_finder];
                        }else if($value=='October') {
                            $october_total=$october_total+$deliveries_array[$key_finder];
                        }else if($value=='November') {
                            $november_total=$november_total+$deliveries_array[$key_finder];
                        }else if($value=='December') {
                            $december_total=$december_total+$deliveries_array[$key_finder];
                        }
                    }
                    else {
                        echo "<td class='data'>-</td>";
                    }
                }
                echo
                "<td class='total' id='column_total'>".floor($total_per_sup)."</td>";
                $overall_total=$overall_total+$total_per_sup;
                echo "<td class='total' id='column_total'>".floor($total_per_sup/date('m'))."</td>";
                echo "</tr>";
            }            echo










                " </table>";            ?>            <div id="botcontainer">                <?php                echo '<table class="data display datatable" id="totalbot">';
                echo "<thead >";
                echo "<th >Computation</th>";
                foreach ($months_array as $value) {
                    echo "<th>".$value."</th>";
                }                echo










                "<th id='total'>TOTAL</th>";
                echo "<th id='total'>AVG</th>";
                echo "</thead>";
                echo "<tr class='total'>";
                echo "<td class='totalheader'>&nbsp;&nbsp;&nbsp; TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
                echo "<td class='total'>".number_format($january_total,1)."</td>";
                echo "<td class='total'>".number_format($february_total,1)."</td>";
                echo "<td class='total'>".number_format($march_total,1)."</td>";
                echo "<td class='total'>".number_format($april_total,1)."</td>";
                echo "<td class='total'>".number_format($may_total,1)."</td>";
                echo "<td class='total'>".number_format($june_total,1)."</td>";
                echo "<td class='total'>".number_format($july_total,1)."</td>";
                echo "<td class='total'>".number_format($august_total,1)."</td>";
                echo "<td class='total'>".number_format($september_total,1)."</td>";
                echo "<td class='total'>".number_format($october_total,1)."</td>";
                echo "<td class='total'>".number_format($november_total,1)."</td>";
                echo "<td class='total'>".number_format($december_total,1)."</td>";
                echo "<td class='total'>".number_format($overall_total,1)."</td>";
                echo "<td class='total'>".number_format($overall_total/date('m'),1)."</td>";
                echo "</tr>";
                echo "<tr class='total'>";
                echo "<td class='total'>&nbsp;&nbsp; Average&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>";
                echo "<td class='total'>".number_format($january_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($february_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($march_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($april_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($may_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($june_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($july_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($august_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($september_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($october_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($november_total/$head_count,1)."</td>";
                echo "<td class='total'>".number_format($december_total/$head_count,1)."</td>";
echo "<td class='total'>".number_format($overall_total/$head_count,1)."</td>";
echo "<td class='total'>".number_format(($overall_total/$head_count)/date('m'),1)."</td>";
echo "</tr>";
echo "</table>";                ?>            </div>    </div></div>