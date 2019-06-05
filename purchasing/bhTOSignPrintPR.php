<?php session_start();?>
<head>
    <style>
        #branch_to_canvass{
            position:absolute;
            margin-top:22px;
            margin-left:21px;
            border-style:hidden;
            background-color:transparent;

        }
        #stamp{
            position:absolute;
            margin-left:-250px;
            margin-top:100px;
            width:280px;
            height:280px;
            opacity:0.5;
        }
        #comments{
            position:absolute;
            margin-left:1000px;
        }
        #textarea{
            border-style:hidden;

        }
        #signature{
            position:absolute;
            margin-top:-130px;
            height:80px;
            width:200px;
            margin-left:710px;


        }
        #prNumber{
            position:absolute;
            margin-top:46px;
            margin-left:835px;
            height:19px;
            width:130px;

            font-weight:bold;
            font-size:15px
        }
        input{
            border-style:hidden;
        }
        #branch{
            position:absolute;
            margin-top:46px;
            margin-left:-988px;
            height:19px;
        }
        #date{
            position:absolute;
            margin-top:46px;
            margin-left:-845px;
            height:19px;


        }

        #date_needed{
            position:absolute;
            margin-top:46px;
            margin-left:-640px;
            height:19px;


        }
        #end_use{
            position:absolute;
            margin-top:68px;
            margin-left:-930px;
            height:19px;


        }
        #justification{
            position:absolute;
            margin-top:90px;
            margin-left:-974px;
            height:19px;


        }

        #container{
            position:absolute;
        }
        #qty1{
            position:absolute;
            margin-top:157px;
            margin-left:-1080px;
            height:19px;


        }
        #qty2{
            position:absolute;
            margin-top:179px;
            margin-left:-1080px;
            height:19px;


        }
        #qty3{
            position:absolute;
            margin-top:201px;
            margin-left:-1080px;
            height:19px;


        }
        #qty4{
            position:absolute;
            margin-top:224px;
            margin-left:-1080px;
            height:19px;


        }
        #qty5{
            position:absolute;
            margin-top:245px;
            margin-left:-1080px;
            height:19px;


        }
        #qty6{
            position:absolute;
            margin-top:267px;
            margin-left:-1080px;
            height:19px;


        }
        #qty7{
            position:absolute;
            margin-top:290px;
            margin-left:-1080px;
            height:19px;


        }
        #qty8{
            position:absolute;
            margin-top:313px;
            margin-left:-1080px;
            height:19px;


        }
        #qty9{
            position:absolute;
            margin-top:334px;
            margin-left:-1080px;
            height:19px;


        }
        #qty10{
            position:absolute;
            margin-top:356px;
            margin-left:-1080px;
            height:19px;


        }
        #qty11{
            position:absolute;
            margin-top:378px;
            margin-left:-1080px;
            height:19px;


        }
        #qty12{
            position:absolute;
            margin-top:401px;
            margin-left:-1080px;
            height:19px;


        }

        #qty12{
            position:absolute;
            margin-top:401px;
            margin-left:-1080px;
            height:19px;


        }

        #um1{
            position:absolute;
            margin-top:157px;
            margin-left:-985px;
            height:19px;


        }
        #um2{
            position:absolute;
            margin-top:179px;
            margin-left:-985px;
            height:19px;


        }

        #um3{
            position:absolute;
            margin-top:201px;
            margin-left:-985px;
            height:19px;


        }
        #um4{
            position:absolute;
            margin-top:224px;
            margin-left:-985px;
            height:19px;


        }
        #um5{
            position:absolute;
            margin-top:245px;
            margin-left:-985px;
            height:19px;


        }
        #um6{
            position:absolute;
            margin-top:267px;
            margin-left:-985px;
            height:19px;


        }
        #um7{
            position:absolute;
            margin-top:290px;
            margin-left:-985px;
            height:19px;


        }

        #um8{
            position:absolute;
            margin-top:313px;
            margin-left:-985px;
            height:19px;


        }

        #um9{
            position:absolute;
            margin-top:334px;
            margin-left:-985px;
            height:19px;


        }
        #um10{
            position:absolute;
            margin-top:356px;
            margin-left:-985px;
            height:19px;


        }

        #um11{
            position:absolute;
            margin-top:378px;
            margin-left:-985px;
            height:19px;


        }

        #um12{
            position:absolute;
            margin-top:401px;
            margin-left:-985px;
            height:19px;


        }







        #desc1{
            position:absolute;
            margin-top:157px;
            margin-left:-890px;
            height:19px;


        }
        #desc2{
            position:absolute;
            margin-top:179px;
            margin-left:-890px;
            height:19px;


        }
        #desc3{
            position:absolute;
            margin-top:201px;
            margin-left:-890px;
            height:19px;


        }
        #desc4{
            position:absolute;
            margin-top:224px;
            margin-left:-890px;
            height:19px;


        }
        #desc5{
            position:absolute;
            margin-top:245px;
            margin-left:-890px;
            height:19px;


        }
        #desc6{
            position:absolute;
            margin-top:267px;
            margin-left:-890px;
            height:19px;


        }
        #desc7{
            position:absolute;
            margin-top:290px;
            margin-left:-890px;
            height:19px;


        }
        #desc8{
            position:absolute;
            margin-top:313px;
            margin-left:-890px;
            height:19px;


        }
        #desc9{
            position:absolute;
            margin-top:334px;
            margin-left:-890px;
            height:19px;


        }
        #desc10{
            position:absolute;
            margin-top:356px;
            margin-left:-890px;
            height:19px;


        }
        #desc11{
            position:absolute;
            margin-top:378px;
            margin-left:-890px;
            height:19px;


        }
        #desc12{
            position:absolute;
            margin-top:401px    ;
            margin-left:-890px;
            height:19px;


        }


        #lpp1{
            position:absolute;
            margin-top:157px    ;
            margin-left:-545px;
            height:19px;
        }
        #lpp2{
            position:absolute;
            margin-top:179px        ;
            margin-left:-545px;
            height:19px;


        }
        #lpp3{
            position:absolute;
            margin-top:201px;
            margin-left:-545px;
            height:19px;
        }
        #lpp4{
            position:absolute;
            margin-top:224px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp5{
            position:absolute;
            margin-top:245px  ;
            margin-left:-545px;
            height:19px;


        }
        #lpp6{
            position:absolute;
            margin-top:267px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp7{
            position:absolute;
            margin-top:290px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp8{
            position:absolute;
            margin-top:313px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp9{
            position:absolute;
            margin-top:334px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp10{
            position:absolute;
            margin-top:356px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp11{
            position:absolute;
            margin-top:378px    ;
            margin-left:-545px;
            height:19px;


        }
        #lpp12{
            position:absolute;
            margin-top:401px    ;
            margin-left:-545px;
            height:19px;


        }



        #cvt1{
            position:absolute;
            margin-top:133.9px   ;
            margin-left:-452px;
            height:19px;


        }
        #cv1{
            position:absolute;
            margin-top:157px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv2{
            position:absolute;
            margin-top:179px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv3{
            position:absolute;
            margin-top:201px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv4{
            position:absolute;
            margin-top:224px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv5{
            position:absolute;
            margin-top:245px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv6{
            position:absolute;
            margin-top:267px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv7{
            position:absolute;
            margin-top:290px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv8{
            position:absolute;
            margin-top:313px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv9{
            position:absolute;
            margin-top:334px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv10{
            position:absolute;
            margin-top:356px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv11{
            position:absolute;
            margin-top:378px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv12{
            position:absolute;
            margin-top:401px    ;
            margin-left:-452px;
            height:19px;


        }

        #cvt2{
            position:absolute;
            margin-top:133.9px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv21{
            position:absolute;
            margin-top:157px    ;
            margin-left:-372px;
            height:19px;


        }

        #cv22{
            position:absolute;
            margin-top:179px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv23{
            position:absolute;
            margin-top:201px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv24{
            position:absolute;
            margin-top:224px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv25{
            position:absolute;
            margin-top:245px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv26{
            position:absolute;
            margin-top:267px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv27{
            position:absolute;
            margin-top:290px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv28{
            position:absolute;
            margin-top:313px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv29{
            position:absolute;
            margin-top:334px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv210{
            position:absolute;
            margin-top:356px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv211{
            position:absolute;
            margin-top:378px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv212{
            position:absolute;
            margin-top:401px    ;
            margin-left:-372px;
            height:19px;


        }

        #cvt3{
            position:absolute;
            margin-top:133.9px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv31{
            position:absolute;
            margin-top:157px    ;
            margin-left:-245px;
            height:19px;


        }

        #cv32{
            position:absolute;
            margin-top:179px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv33{
            position:absolute;
            margin-top:201px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv34{
            position:absolute;
            margin-top:224px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv35{
            position:absolute;
            margin-top:245px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv36{
            position:absolute;
            margin-top:267px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv37{
            position:absolute;
            margin-top:290px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv38{
            position:absolute;
            margin-top:313px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv39{
            position:absolute;
            margin-top:334px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv310{
            position:absolute;
            margin-top:356px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv311{
            position:absolute;
            margin-top:378px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv312{
            position:absolute;
            margin-top:401px    ;
            margin-left:-245px;
            height:19px;


        }

        #total1{
            position:absolute;
            margin-top:422px    ;
            margin-left:-452px;
            height:19px;


        }

        #total2{
            position:absolute;
            margin-top:422px    ;
            margin-left:-372px;
            height:19px;


        }
        #total3{
            position:absolute;
            margin-top:422px    ;
            margin-left:-245px;
            height:19px;


        }

        #totalLPP{
            position:absolute;
            margin-top:422px    ;
            margin-left:-545px;
            height:19px;
        }

        #canvass{
            float: right;
            margin-top: -50%;
            margin-right: -160;
        }

        #canvasser{
            position:absolute;
            margin-top:538px    ;
            margin-left:-990px;
            height:19px;
        }

        #verified{
            position:absolute;
            margin-top:538px    ;
            margin-left:-720px;
            height:19px;
        }
        #approved{
            position:absolute;
            margin-top:538px    ;
            margin-left:-320px;
            height:19px;
        }
        #approvedSpn{
            position:absolute;
            margin-top:538px    ;
            margin-left:-250px;
            height:19px;
        }
        #lblprepared{
            position:absolute;
            margin-top:540px;
            margin-left:10px;
        }
        #lblverified{
            position:absolute;
            margin-top:540px;
            margin-left:280px;
        }
        #lblapproved{
            position:absolute;
            margin-top:540px;
            margin-left:640px;
        }


        #print{
            border-style:solid;
            font-size: 20px;
        }

        #bh_signature{
            position:absolute;
            margin-top:-130px;
            margin-left:300px;
        }

        #buttons{
            position:absolute;
            margin-top:600px;
        }
        #type{
            position:absolute;
            margin-left:10px;
            font-weight:bold;
        }


        /*****************/

        #cost_total{

            height:19px;
            position:absolute;
            margin-top:422px    ;
            margin-left:-110px;
            height:19px;

        }
        #cost_1{
            position:absolute;
            margin-top:157px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }

        #cost_2{
            position:absolute;
            margin-top:179px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_3{
            position:absolute;
            margin-top:201px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_4{
            position:absolute;
            margin-top:224px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_5{
            position:absolute;
            margin-top:245px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_6{
            position:absolute;
            margin-top:267px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_7{
            position:absolute;
            margin-top:290px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_8{
            position:absolute;
            margin-top:313px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_9{
            position:absolute;
            margin-top:334px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_10{
            position:absolute;
            margin-top:356px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_11{
            position:absolute;
            margin-top:378px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }
        #cost_12{
            position:absolute;
            margin-top:401px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
        }


        #total_cost{
            position:absolute;
            margin-top:422px    ;
            margin-left:-110px;
            height:19px;
            font-weight: bold;
            text-align: right;
            color: red;

        }


        #approve_button{
            margin-top: 50px;
        }

        #disapprove_button{
            margin-top: -10px;
        }
    </style>
    <script language="javascript" type="text/javascript" src="js/datetimepicker.js"> </script>

</head>


<html>
    <body>
        <div id="container">
            <?php
            include('config.php');
            $request_id=$_GET['request_id'];
            $result = mysql_query("SELECT * FROM requests where request_id='$request_id'");
            $row = mysql_fetch_array($result);
            echo "<input type=text name='prNumber' id='prNumber' value='Unassigned' readonly>";

            echo "<form action='bhToSignForwardPR.php' method='POST'>";
            echo "<input type='hidden' name='request_number' value='".$request_id."' readonly>";
            echo "<div id='type'>PR Type: <input type='text' name='type' value='".$row['type']."'  readonly></div>";
            echo "<span id='branch_to_canvass'>Branch to canvass: <input type='text' name='branch_will_canvass' value='".$row['branch_to_canvass']."' id='branch_selection'></span>";

            echo "<img id='form' src='prform.png'>";

            $status=$row['status'];
            echo "<input type='text' name='branch' id='branch' value='".$row['branch']."' size='10' readonly>";

            echo "<input type='text' name='date' id='date' size=10 value='".$row['date']."' readonly>";
            echo "<input type='text' name='date_needed' id='date_needed' size=10 value='".$row['date_needed']."' readonly>";
            echo "<input type='text' name='end_use' id='end_use' size=120 value='".$row['end_use']."'>";
            echo "<input type='text' name='justification' id='justification' value='".$row['justification']."' size=120 readonly>";

            echo "<input type='text'name='qty1' id='qty1' value='".$row['qty1']."' size=8 readonly>";
            echo "<input type='text'name='qty2' id='qty2' value='".$row['qty2']."' size=8 readonly>";
            echo "<input type='text'name='qty3' id='qty3' value='".$row['qty3']."' size=8 readonly>";
            echo "<input type='text'name='qty4' id='qty4' value='".$row['qty4']."' size=8 readonly>";
            echo "<input type='text'name='qty5' id='qty5' value='".$row['qty5']."' size=8 readonly>";
            echo "<input type='text'name='qty6' id='qty6' value='".$row['qty6']."' size=8 readonly>";
            echo "<input type='text'name='qty7' id='qty7' value='".$row['qty7']."' size=8 readonly>";
            echo "<input type='text'name='qty8' id='qty8' value='".$row['qty8']."' size=8 readonly>";
            echo "<input type='text'name='qty9' id='qty9' value='".$row['qty9']."' size=8 readonly>";
            echo "<input type='text'name='qty10' id='qty10' value='".$row['qty10']."' size=8 readonly>";
            echo "<input type='text'name='qty11' id='qty11' value='".$row['qty11']."' size=8 readonly>";
            echo "<input type='text'name='qty12' id='qty12' value='".$row['qty12']."' size=8 readonly>";

            echo "<input type='text'name='um1' id='um1' value='".$row['um1']."' size=8 readonly>";
            echo "<input type='text'name='um2' id='um2' value='".$row['um2']."' size=8 readonly>";
            echo "<input type='text'name='um3' id='um3' value='".$row['um3']."' size=8 readonly>";
            echo "<input type='text'name='um4' id='um4' value='".$row['um4']."' size=8 readonly>";
            echo "<input type='text'name='um5' id='um5' value='".$row['um5']."' size=8 readonly>";
            echo "<input type='text'name='um6' id='um6' value='".$row['um6']."' size=8 readonly>";
            echo "<input type='text'name='um7' id='um7' value='".$row['um7']."' size=8 readonly>";
            echo "<input type='text'name='um8' id='um8' value='".$row['um8']."' size=8 readonly>";
            echo "<input type='text'name='um9' id='um9' value='".$row['um9']."' size=8 readonly>";
            echo "<input type='text'name='um10' id='um10' value='".$row['um10']."' size=8 readonly>";
            echo "<input type='text'name='um11' id='um11' value='".$row['um11']."' size=8 readonly>";
            echo "<input type='text'name='um12' id='um12' value='".$row['um12']."' size=8 readonly>";

            echo "<input type='text' name='desc1' id='desc1' value='".$row['desc1']."' size=50 readonly>";
            echo "<input type='text' name='desc2' id='desc2' value='".$row['desc2']."' size=50 readonly>";
            echo "<input type='text' name='desc3' id='desc3' value='".$row['desc3']."' size=50 readonly>";
            echo "<input type='text' name='desc4' id='desc4' value='".$row['desc4']."' size=50 readonly>";
            echo "<input type='text' name='desc5' id='desc5' value='".$row['desc5']."' size=50 readonly>";
            echo "<input type='text' name='desc6' id='desc6' value='".$row['desc6']."' size=50 readonly>";
            echo "<input type='text' name='desc7' id='desc7' value='".$row['desc7']."' size=50 readonly>";
            echo "<input type='text' name='desc8' id='desc8' value='".$row['desc8']."' size=50 readonly>";
            echo "<input type='text' name='desc9' id='desc9' value='".$row['desc9']."' size=50 readonly>";
            echo "<input type='text' name='desc10' id='desc10' value='".$row['desc10']."' size=50 readonly>";
            echo "<input type='text' name='desc11' id='desc11' value='".$row['desc11']."' size=50 readonly>";
            echo "<input type='text' name='desc12' id='desc12' value='".$row['desc12']."' size=50 readonly>";

            echo "<input type='text'name='lpp1' id='lpp1' value='".$row['lpp1']."' size=8 readonly>";
            echo "<input type='text'name='lpp2' id='lpp2' value='".$row['lpp2']."' size=8 readonly>";
            echo "<input type='text'name='lpp3' id='lpp3' value='".$row['lpp3']."' size=8 readonly>";
            echo "<input type='text'name='lpp4' id='lpp4' value='".$row['lpp4']."' size=8 readonly>";
            echo "<input type='text'name='lpp5' id='lpp5' value='".$row['lpp5']."' size=8 readonly>";
            echo "<input type='text'name='lpp6' id='lpp6' value='".$row['lpp6']."' size=8 readonly>";
            echo "<input type='text'name='lpp7' id='lpp7' value='".$row['lpp7']."' size=8 readonly>";
            echo "<input type='text'name='lpp8' id='lpp8' value='".$row['lpp8']."' size=8 readonly>";
            echo "<input type='text'name='lpp9' id='lpp9' value='".$row['lpp9']."' size=8 readonly>";
            echo "<input type='text'name='lpp10' id='lpp10' value='".$row['lpp10']."' size=8 readonly>";
            echo "<input type='text'name='lpp11' id='lpp11' value='".$row['lpp11']."' size=8 readonly>";
            echo "<input type='text'name='lpp12' id='lpp12' value='".$row['lpp12']."' size=8 readonly>";

            echo "<input type='text'name='cv1_1' id='cv1' value='".$row['cv1_1']."' size=7 readonly >";
            echo "<input type='text'name='cv1_2' id='cv2' value='".$row['cv1_2']."' size=7 readonly >";
            echo "<input type='text'name='cv1_3' id='cv3' value='".$row['cv1_3']."' size=7 readonly >";
            echo "<input type='text'name='cv1_4' id='cv4' value='".$row['cv1_4']."' size=7 readonly >";
            echo "<input type='text'name='cv1_5' id='cv5' value='".$row['cv1_5']."' size=7 readonly >";
            echo "<input type='text'name='cv1_6' id='cv6' value='".$row['cv1_6']."' size=7 readonly >";
            echo "<input type='text'name='cv1_7' id='cv7' value='".$row['cv1_7']."' size=7 readonly >";
            echo "<input type='text'name='cv1_8' id='cv8' value='".$row['cv1_8']."' size=7 readonly >";
            echo "<input type='text'name='cv1_9' id='cv9' value='".$row['cv1_9']."' size=7 readonly >";
            echo "<input type='text'name='cv1_10' id='cv10' value='".$row['cv1_10']."' size=7 readonly >";
            echo "<input type='text'name='cv1_11' id='cv11' value='".$row['cv1_11']."' size=7 readonly >";
            echo "<input type='text'name='cv1_12' id='cv12' value='".$row['cv1_12']."' size=7 readonly >";

            echo "<input type='text'name='cv2_1' id='cv21' value='".$row['cv2_1']."' size=14 readonly >";
            echo "<input type='text'name='cv2_2' id='cv22' value='".$row['cv2_2']."' size=14 readonly >";
            echo "<input type='text'name='cv2_3' id='cv23' value='".$row['cv2_3']."' size=14 readonly >";
            echo "<input type='text'name='cv2_4' id='cv24' value='".$row['cv2_4']."' size=14 readonly >";
            echo "<input type='text'name='cv2_5' id='cv25' value='".$row['cv2_5']."' size=14 readonly >";
            echo "<input type='text'name='cv2_6' id='cv26' value='".$row['cv2_6']."' size=14 readonly >";
            echo "<input type='text'name='cv2_7' id='cv27' value='".$row['cv2_7']."' size=14 readonly >";
            echo "<input type='text'name='cv2_8' id='cv28' value='".$row['cv2_8']."' size=14 readonly >";
            echo "<input type='text'name='cv2_9' id='cv29' value='".$row['cv2_9']."' size=14 readonly >";
            echo "<input type='text'name='cv2_10' id='cv210' value='".$row['cv2_10']."' size=14 readonly >";
            echo "<input type='text'name='cv2_11' id='cv211' value='".$row['cv2_11']."' size=14 readonly >";
            echo "<input type='text'name='cv2_12' id='cv212' value='".$row['cv2_12']."' size=14 readonly >";


            echo "<input type='text'name='cv3_1' id='cv31' value='".$row['cv3_1']."' size=14 readonly >";
            echo "<input type='text'name='cv3_2' id='cv32' value='".$row['cv3_2']."' size=14 readonly >";
            echo "<input type='text'name='cv3_3' id='cv33' value='".$row['cv3_3']."' size=14  readonly >";
            echo "<input type='text'name='cv3_4' id='cv34' value='".$row['cv3_4']."' size=14 readonly >";
            echo "<input type='text'name='cv3_5' id='cv35' value='".$row['cv3_5']."' size=14 readonly >";
            echo "<input type='text'name='cv3_6' id='cv36' value='".$row['cv3_6']."' size=14 readonly >";
            echo "<input type='text'name='cv3_7' id='cv37' value='".$row['cv3_7']."' size=14 readonly >";
            echo "<input type='text'name='cv3_8' id='cv38' value='".$row['cv3_8']."' size=14 readonly >";
            echo "<input type='text'name='cv3_9' id='cv39' value='".$row['cv3_9']."' size=14 readonly >";
            echo "<input type='text'name='cv3_10' id='cv310' value='".$row['cv3_10']."' size=14 readonly >";
            echo "<input type='text'name='cv3_11' id='cv311' value='".$row['cv3_11']."' size=14 readonly >";
            echo "<input type='text'name='cv3_12' id='cv312' value='".$row['cv3_12']."' size=14 readonly >";


            echo "<input type='text'name='cost_1' id='cost_1' value='".$row['cost_1']."' size=12 readonly  />";
            echo "<input type='text'name='cost_2' id='cost_2' value='".$row['cost_2']."' size=12 readonly  />";
            echo "<input type='text'name='cost_3' id='cost_3' value='".$row['cost_3']."' size=12  readonly  />";
            echo "<input type='text'name='cost_4' id='cost_4' value='".$row['cost_4']."' size=12 readonly  />";
            echo "<input type='text'name='cost_5' id='cost_5' value='".$row['cost_5']."' size=12 readonly  />";
            echo "<input type='text'name='cost_6' id='cost_6' value='".$row['cost_6']."' size=12 readonly  />";
            echo "<input type='text'name='cost_7' id='cost_7' value='".$row['cost_7']."' size=12 readonly  />";
            echo "<input type='text'name='cost_8' id='cost_8' value='".$row['cost_8']."' size=12 readonly  />";
            echo "<input type='text'name='cost_9' id='cost_9' value='".$row['cost_9']."' size=12 readonly  />";
            echo "<input type='text'name='cost_10' id='cost_10' value='".$row['cost_10']."' size=12 readonly  />";
            echo "<input type='text'name='cost_11' id='cost_11' value='".$row['cost_11']."' size=12 readonly  />";
            echo "<input type='text'name='cost_12' id='cost_12' value='".$row['cost_12']."' size=12 readonly  />";

            echo "<input type='hidden' name='quotation' value='".$row['quotation']."'>";


            echo "<input type='text' name='cvt1' id='cvt1' value='".$row['cv_sup1']."' size=7 readonly >";
            echo "<input type='text' name='cvt2' id='cvt2' value='".$row['cv_sup2']."' size=14 readonly >";
            echo "<input type='text' name='cvt3' id='cvt3' value='".$row['cv_sup3']."' size=14 readonly >";
            echo "<input type='text' name='total_cost' id='total_cost' value='".$row['total_cost']."' size=12 readonly  />";


            echo "<input type='text' name='total1' id='total1' value='".$row['cv1_total']."' size=7 readonly >";
            echo "<input type='text' name='total2' id='total2' value='".$row['cv2_total']."' size=14 readonly >";
            echo "<input type='text' name='total3' id='total3' value='".$row['cv3_total']."' size=14 readonly >";
            echo "<input type='text' name='totalLPP' id='totalLPP' value='".$row['lpp_total']."' size=8 readonly >";

            echo "<input type='hidden' name='type'  value='".$row['type']."' size=8 >";
            echo "<input type='hidden' name='status'  value='".$row['status']."' size=8 >";

            echo "<input type='text' name='canvasser' id='canvasser' value='".$row['canvasser']."' size=18 readonly>";
            echo "<input type='text' name='verified' id='verified' value='".$row['verified']."' size=4 readonly>";
            
            $sql_approver = mysql_query("SELECT * from users WHERE name='".$row['approved']."'");
            $row_approver = mysql_fetch_array($sql_approver);

            echo "<input type='text' name='approved' id='approved' value='".$row['approved']."-".$row_approver['fullname']."' size=30 readonly><br>";
            echo "<input type='hidden' name='verified_signature' value='".$_SESSION['name']."' readonly><br>";

            if($_SESSION['position']=='BH' && ($row['status']=='' || $row['status']=='for approval')) {
                echo "<button id='approve_button'><input type='submit' value='Approve'></button>";
            }
            echo "</form>";

            if($_SESSION['position']=='BH' && $row['status']!='disapproved') {
                echo'<a href=bhToSignDisApprovePR.php?request_id=' .$request_id. '><button id="disapprove_button">' . 'Disapprove PR' . '</button></a>';
            }
            

            ?>
        </div>

    </body>
    <span id="lblprepared">
        Prepared By:
    </span>

    <span id="lblverified">
        Verified By:
    </span>
    <span id="lblapproved">
        Approved By:
    </span>


</html>

<span id="comments">
    <?php
    echo '<iframe src="commentutil/demo.php?request_id='.$request_id.'" height="100%" width="600" frameBorder="0"></iframe>';


    ?>
</span>

<div id="buttons">
    <A HREF="javascript:void(0)"
       onclick="window.open('<?php echo $row['quotation'];?>')">

        <?php

        if($row['quotation']!='quotations/' && $row['quotation']!='') {
            echo '<button>View Quotation</button></a>';
        }else {
            echo '<button disabled>View Quotation</button></a>';

        }
        echo'<a  href=home.php><button>' . "Back to Home" . '</button></a>';


        ?>
</div>