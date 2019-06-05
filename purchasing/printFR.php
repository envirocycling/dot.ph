<?php

session_start();
?>
<script>
    print();
</script>
<style>
    html{
        font-family:"Calibri (Body)";
    }
    body{
        margin-left: 90px;
        color: blue;
    }
    input{
        border-style:hidden;
        color: blue;
    }

    #amount{
        position:absolute;
        margin-top:-18px;
        margin-left: 50px;
    }
    #date_check{
        position:absolute;
        margin-top: 0px;
        margin-left: 100px;
    }
    #date{
        position:absolute;
        margin-top:-40px;
        margin-left:450px;
    }
    #line{
        border-bottom:solid;
        border-width:1px;
    }

    #total{
        border-bottom:solid;
        border-width:5px;
        font-weight: bold;
        font-size:17px;
    }
    #title{
        position: absolute;
        margin-top: 30px;
    }
    #amount_title{
        position: absolute;
        margin-top: 30px;
        margin-left: 470px;
    }
    #brkdwn{
        position:absolute;
        margin-top:132px;
    }
    #req_id{
        width:0px;
    }
    #req_id2{
        position:absolute;
        margin-top:-350px;
    }
    #prepared_by{
        position:absolute;
        margin-top: 270px;
    }
    #audited_by{
        position:absolute;
        margin-left:160px;
        margin-top: 270px;
    }
    #audited_by2{
        position:absolute;
        margin-left:230px;
        margin-top: 270px;
    }
    #approved_by{
        position:absolute;
        margin-left:380px;
        margin-top: 270px;
    }
    #cover{
        position:absolute;
        border-style:hidden;
        width:10px;
        margin-top:-200px;
    }
    #comment{
        width:160px;
    }
    td{
        text-align:right;
    }
    #supplier_name{
        font-weight: bold;
        position:absolute;
        margin-top:-40px;
        margin-left: 30px;
    }
    #button{
        position:absolute;
        margin-top:380px;
    }
    textarea{
        margin-top: 35px;
        margin-left: 50px;
        border-style:hidden;
        color: blue;
    }
</style>

<style type="text/css" media="print">
    .noprint{
        display:none;
    }
</style>
<?php

include 'config.php';
$id = $_GET['fund_req_id'];
$sql = mysql_query("SELECT * FROM fund_req WHERE log_id='$id'");
$rs = mysql_fetch_array($sql);
echo "<br><br><br><br><br><br><br><br>";
//echo "<div class='margin-left: 70px;'>";
echo "<input type='text' value='" . $rs['payee'] . "' name='supplier_name2'  size=50 id='supplier_name'  readonly>";
echo "<input type='text' value='Php " . number_format($rs['amount'], 2) . "' name='amount' id='amount'  readonly>";
echo "<input type='text' value='" . date("F d, Y", strtotime($rs['date_of_check'])) . "' name='date_check' id='date_check'  readonly>";
$date = date("F d, Y");
echo "<input type='text' value='" . $date . "' name='date' id='date'>";
$sql2 = mysql_query("SELECT * FROM users WHERE name like '%" . $rs['audited_by'] . "%'");
$rs2 = mysql_fetch_array($sql2);
echo "<input type='text' value='" . $rs['prepared_by'] . "' name='prepared_by' id='prepared_by' readonly>";
echo "<input type='text' value='" . $rs2['fullname'] . "' name='audited_by' id='audited_by' readonly>";
echo "<input type='text' value='" . $rs['approved_by'] . "' name='approved_by' id='approved_by' readonly>";
echo "<h3 id='title'><i>* * * FUND TRANSFER TO " . strtoupper($rs['branch_submitted']) . " * * *</i></h3> <h5 id='amount_title'>Php " . $rs['amount'] . "<h5>";
echo "<textarea cols='60' rows='10' name='breakdown' readonly>
" . $rs['breakdown'] . "
</textarea>";
//echo "</div>";
?>