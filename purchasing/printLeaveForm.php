<?php
session_start();

?>

<head>


    <style>
        button{
            width:0px;
        }
        #name{
            position:absolute;
            margin-top:88px;
            margin-left:-860px;
        }

        #date{
            position:absolute;
            margin-top:88px;
            margin-left:-390px;
        }

        #position{
            position:absolute;
            margin-top:135px;
            margin-left:-880px;
        }
        #inc_from{
            position:absolute;
            margin-top:135px;
            margin-left:-360px;
        }
        #inc_to{
            position:absolute;
            margin-top:135px;
            margin-left:-275px;
        }
        #no_of_days{
            position:absolute;
            margin-top:135px;
            margin-left:-80px;
        }
        #sl{
            position:absolute;
            margin-top:235px;
            margin-left:-1078px;
        }
        #el{
            position:absolute;
            margin-top:260px;
            margin-left:-1078px;
        }
        #others{
            position:absolute;
            margin-top:283px;
            margin-left:-1078px;
        }
        #specify{
            position:absolute;
            margin-top:280px;
            margin-left:-870px;
        }

        #vl{
            position:absolute;
            margin-top:235px;
            margin-left:-872px;
        }
        #ml{
            position:absolute;
            margin-top:235px;
            margin-left:-597px;
        }
        #lwop{
            position:absolute;
            margin-top:260px;
            margin-left:-872px;
        }
        #bereavement{
            position:absolute;
            margin-top:260px;
            margin-left:-597px;
        }
        #reason{
            position:absolute;
            margin-top:335px;
            margin-left:-1000px;
        }
        #supervisor_approved{
            position:absolute;
            margin-top:-155px;
            margin-left:241px;
        }
        #supervisor_disapproved{
            position:absolute;
            margin-top:-155px;
            margin-left:353px;
        }
        #supervisor_approved_from{
            position:absolute;
            margin-top:-126px;
            margin-left:241px;
        }
        #manager_approved{
            position:absolute;
            margin-top:-75px;
            margin-left:244px;
        }
        #manager_disapproved{
            position:absolute;
            margin-top:-75px;
            margin-left:355px;
        }
        #manager_approved_from{
            position:absolute;
            margin-top:-48px;
            margin-left:246px;
        }

        #supervisor_from{
            position:absolute;
            margin-top:-130px;
            margin-left:392px;
        }

        #supervisor_to{
            position:absolute;
            margin-top:-130px;
            margin-left:445px;
        }

        #manager_from{
            position:absolute;
            margin-top:-50px;
            margin-left:397px;
        }
        #manager_to{
            position:absolute;
            margin-top:-50px;
            margin-left:450px;
        }
        #releaver1{
            position:absolute;
            margin-top:-378px;
            margin-left:766px;
            border-style:hidden;
            text-align:center;
        }
        #releaver2{
            position:absolute;
            margin-top:-280px;
            margin-left:766px;
            border-style:hidden;
            text-align:center;
        }
        #supervisor_name{
            position:absolute;
            margin-top:-160px;
            margin-left:515px;
            border-style:hidden;
            text-align:center;
        }
        #manager_name{
            position:absolute;
            margin-top:-80px;
            margin-left:515px;
            border-style:hidden;
            text-align:center;

        }
        #date_received{
            position:absolute;
            margin-top:-205px;
            margin-left:990px;
        }
        #no_of_leaves_entitled{
            position:absolute;
            margin-top:-181px;
            margin-left:990px;
        }
        #no_of_used_leaves{
            position:absolute;
            margin-top:-157px;
            margin-left:990px;
        }
        #no_of_reservedleaves{
            position:absolute;
            margin-top:-133px;
            margin-left:990px;
        }
        #balance_vl{
            position:absolute;
            margin-top:-85px;
            margin-left:815px;
        }
        #balance_sl{
            position:absolute;
            margin-top:-85px;
            margin-left:950px;
        }

        
    </style>
    <script language="javascript" type="text/javascript" src="js/datetimepicker.js"> </script>

</head>


<html>
    <body>
        <div id="container">
            <?php
            include ('config.php');
            $id=$_GET['id'];
            $query=mysql_query("select * from leaves where leave_id='$id'");
            $row=mysql_fetch_array($query);
            echo "<form action='submitLeave.php' method='POST'>";
            echo "   <img id='form' src='forms/leaveForm.png'>";
            echo "<span id='name'>";
            echo "<input type='text' value='".$row['name']."' size=35px; >";
            echo "</span>";


            echo "<input type='text' value=' ".$row['date_filed']."' id='date' name='date' readonly>";
            echo "<input type='hidden' value='".$row['branch']."' name='branch' readonly>";
            echo "<input type='text' value='".$row['position']."' id='position' name='position' readonly size=35 >";
            echo "<input type='text' value='".$row['inc_date_from']."' id='inc_from' name='inc_from' size='7'>";
            echo "<input type='text' value='".$row['inc_date_to']."' id='inc_to' name='inc_to' size='6.8'>";
            echo "<input type='text' value='".$row['no_of_days']."' id='no_of_days' name='no_of_days' size='4'>";

            if($row['leave_type']=='Sick Leave') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' checked>";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave'>";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)'>";
                echo "<input type='text' name='specify' value='' id='specify' value='' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave'>";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay'>";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";

            }else if($row['leave_type']=='Emergency Leave') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' checked>";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)'>";
                echo "<input type='text' name='specify' value='' id='specify' value='' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave'>";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay'>";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";
            }
            else if($row['leave_type']=='Others') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)' checked>";
                echo "<input type='text' name='specify'  id='specify' value='".$row['specify']."' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave'>";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay'>";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";
            } else if($row['leave_type']=='Others') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)' checked>";
                echo "<input type='text' name='specify' value='' id='specify' value='".$row['specify']."' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave'>";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay'>";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";
            }
            else if($row['leave_type']=='Maternity Leave') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)' >";
                echo "<input type='text' name='specify' value='' id='specify' value='' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave' checked>";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay'>";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";
            }
            else if($row['leave_type']=='Leave Without Pay') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)' >";
                echo "<input type='text' name='specify' value='' id='specify' value='' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay' checked>";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";
            }
            else if($row['leave_type']=='Bereavement') {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)' >";
                echo "<input type='text' name='specify' value='' id='specify' value='' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay' >";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement' checked>";
            }else {
                echo "<input type='checkbox' name='leave_type' id='sl' value='Sick Leave' >";
                echo "<input type='checkbox' name='leave_type'id='el' value='Emergency Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='others' value='Others' onClick='apply(this)' >";
                echo "<input type='text' name='specify' value='' id='specify' value='' size=31 >";
                echo "<input type='checkbox' name='leave_type' id='vl' value='Vacation Leave'>";
                echo "<input type='checkbox' name='leave_type' id='ml' value='Maternity Leave' >";
                echo "<input type='checkbox' name='leave_type'  id='lwop' value='Leave Without Pay' >";
                echo "<input type='checkbox' name='leave_type'id='bereavement' value='Bereavement'>";

            }
            echo "<u><textarea rows='5' cols='45' name='reason' id='reason'>";

            echo "</textarea></u><br>";

            echo "<input type='checkbox' name='supervisor_action' id='supervisor_approved' value='approved'>";

            echo "<input type='checkbox' name='supervisor_action' id='supervisor_disapproved' value='not approved'>";
            echo "<input type='checkbox' name='supervisor_action' id='supervisor_approved_from' value='approved from'>";
            echo "<input type='checkbox' name='manager_action' id='manager_approved' value='approved'>";
            echo "<input type='checkbox' name='manager_action' id='manager_disapproved' value='not approved'>";
            echo "<input type='checkbox' name='manager_action' id='manager_approved_from' value='approved from'>";
            echo "<input type='text' value='' id='supervisor_from' name='supervisor_from' size=2>";
            echo "<input type='text' value='' id='supervisor_to' name='supervisor_to' size=2>";

            echo "<input type='text' value='' id='manager_from' name='manager_from' size=2>";
            echo "<input type='text' value='' id='manager_to' name='manager_to' size=2>";

            echo "<input type='text' value='".$row['releaver1']."' id='releaver1' name='releaver1' size=45>";
            echo "<input type='text' value='".$row['releaver2']."' id='releaver2' name='releaver2' size=45>";

            $query2=mysql_query("select * from users where branch='".$row['branch']."'");
            $row2=mysql_fetch_array($query2);
            echo "<input type='text' value='".$row2['name']."' id='supervisor_name' name='supervisor_name' size=30 readonly>";
            echo "<input type='text' value='Luisa Lorna Regala' id='manager_name' name='manager_name' size=30 readonly>";
            echo '<a href="http://pdfcrowd.com/url_to_pdf/"><button>Download</button></a>';
            echo "</form>";



            echo "<input type='text' value='".$row['date_filed']."' id='date_received' name='date_received' size = 8 readonly>";
            $query2=mysql_query("select count(leave_id) from leaves where name ='".$row['name']."' and branch ='".$row['branch']."' ");
            $row2=mysql_fetch_array($query2);
            echo "<input type='text' value='".$row2['count(leave_id)']."' id='no_of_leaves_entitled' name='no_of_leaves_entitled' size = 8 readonly>";

            $query2=mysql_query("select count(leave_id) from leaves where status='approved' and name ='".$row['name']."' and branch ='".$row['branch']."' ");
            $row2=mysql_fetch_array($query2);


            echo "<input type='text' value='".$row2['count(leave_id)']."' id='no_of_used_leaves' and  name='no_of_used_leaves' size = 8 readonly>";


            $query2=mysql_query("select * from employees where name ='".$row['name']."' and branch ='".$row['branch']."' ");
            $row2=mysql_fetch_array($query2);

            echo "<input type='text' value='".$row2['leaves']."' id='no_of_reservedleaves' name='no_of_reservedleaves' size = 8 readonly>";

            $query2=mysql_query("select count(leave_id) from leaves where leave_type='Vacation Leave' and name ='".$row['name']."' and branch ='".$row['branch']."' ");
            $row2=mysql_fetch_array($query2);
            echo "<input type='text' value='".$row2['count(leave_id)']."' id='balance_vl' and name='balance_vl' size = 3.5 readonly>";

            $query2=mysql_query("select count(leave_id) from leaves where leave_type='Sick Leave' and name ='".$row['name']."' and branch ='".$row['branch']."' ");
            $row2=mysql_fetch_array($query2);
            echo "<input type='text' value='".$row2['count(leave_id)']."' id='balance_sl' name='balance_sl' size = 3.5 readonly  >";
            ?>
        </div>
    </body>



</html>