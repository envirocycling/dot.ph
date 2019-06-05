<?php
session_start();
$counter = 0;
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
}
$branch = $_SESSION['branch'];
include('config.php');

?>


<script type="text/javascript" src="js/jquery.min.js"></script>

<script>

    function changeType(data) {
		
        var branch_to_canvass = "<input type='hidden' name='branch_will_canvass' value='' id='branch_selection'>";
		
        if (data == "for_canvassing") {
            branch_to_canvass = "<span id='branch_selection'>Branch that will canvass:<select name='branch_will_canvass'  ><option>Cainta</option><option>Cavite</option><option>Calamba</option><option>Sauyo</option><option>Kaybiga</option><option>Pampanga</option><option>Pasay</option><option>Makati</option></select></span>";
        }
		
        document.getElementById("branch_to_canvass").innerHTML = branch_to_canvass;
		
        var verified = "<?php
			$result = mysql_query("SELECT * FROM users where authority='signatory' and name !='LLR' ");
			echo "<select name='verified' id='verified' required />";
			echo "<option value=''>Select </option>";
			while ($row = mysql_fetch_array($result)) {
				echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
			}
			echo "</select>";
		?>";


		let cvColumns = document.querySelectorAll('.cv');


		if(data == 'heavy_vehicles') {


			cvColumns.forEach(i => {
				i.setAttribute('disabled', null);
                i.value = '';
			});


		}else {

			cvColumns.forEach(i => {
				i.removeAttribute('disabled');
			});

		}
    }
	
    $(document).ready(function () {
        $('[name=verified]').prop('hidden', true);
        $('[name=type]').change(function () {
            var type = this.value;
            if (type === 'consumable') {
                $('[name=verified]').val('');
            }
            $.ajax({
                url: 'new_signatoryPro.php?type=' + type,
                async: false
            }).done(function (e) {
                var eSplit = e.split('~');
                if (eSplit[0] !== 'bh') {
                    $('[name=approved]').val(eSplit[0]);
                    $('[name=appName]').text(eSplit[1]);
                } else {
                    $('[name=approved]').val('');
                    $('[name=appName]').text('');
                }
                $('[name=verified]').prop('hidden', false);
            });
        });
        $('[name=verified]').change(function () {
            var _val = this.value;
            var _prType = $('[name=type]').val();
            var _text = $('[name=verified] option[value=' + _val + ']').text();
            if (_prType === 'consumable') {
                $('[name=approved]').val(_val);
                $('[name=appName]').text(_text);
            }
        });
    });

</script>
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
            margin-top:-170px;
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
            /* border-style:hidden;*/
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
            margin-left:-610px;
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
        #cv_1{
            position:absolute;
            margin-top:157px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_2{
            position:absolute;
            margin-top:179px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_3{
            position:absolute;
            margin-top:201px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_4{
            position:absolute;
            margin-top:224px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_5{
            position:absolute;
            margin-top:245px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_6{
            position:absolute;
            margin-top:267px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_7{
            position:absolute;
            margin-top:290px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_8{
            position:absolute;
            margin-top:313px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_9{
            position:absolute;
            margin-top:334px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_10{
            position:absolute;
            margin-top:356px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_11{
            position:absolute;
            margin-top:378px    ;
            margin-left:-452px;
            height:19px;


        }
        #cv_12{
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
        #cv2_1{
            position:absolute;
            margin-top:157px    ;
            margin-left:-372px;
            height:19px;


        }

        #cv2_2{
            position:absolute;
            margin-top:179px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_3{
            position:absolute;
            margin-top:201px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_4{
            position:absolute;
            margin-top:224px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_5{
            position:absolute;
            margin-top:245px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_6{
            position:absolute;
            margin-top:267px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_7{
            position:absolute;
            margin-top:290px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_8{
            position:absolute;
            margin-top:313px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_9{
            position:absolute;
            margin-top:334px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_10{
            position:absolute;
            margin-top:356px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_11{
            position:absolute;
            margin-top:378px    ;
            margin-left:-372px;
            height:19px;


        }
        #cv2_12{
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
        #cv3_1{
            position:absolute;
            margin-top:157px    ;
            margin-left:-245px;
            height:19px;


        }

        #cv3_2{
            position:absolute;
            margin-top:179px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_3{
            position:absolute;
            margin-top:201px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_4{
            position:absolute;
            margin-top:224px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_5{
            position:absolute;
            margin-top:245px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_6{
            position:absolute;
            margin-top:267px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_7{
            position:absolute;
            margin-top:290px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_8{
            position:absolute;
            margin-top:313px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_9{
            position:absolute;
            margin-top:334px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_10{
            position:absolute;
            margin-top:356px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_11{
            position:absolute;
            margin-top:378px    ;
            margin-left:-245px;
            height:19px;


        }
        #cv3_12{
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
            margin-left:-980px;
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
            margin-top:-100px;
            margin-left:10px;
        }
        #lblverified{
            position:absolute;
            margin-top:-100px;
            margin-left:280px;
        }
        #lblapproved{
            position:absolute;
            margin-top:-100px;
            margin-left:640px;
        }


        #print{
            border-style:solid;
            font-size: 20px;
        }

        #bh_signature{
            position:absolute;
            margin-top:-170px;
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
		
		
		input:disabled {
			cursor: not-allowed;
		}


    </style>




    <script language="javascript" type="text/javascript" src="js/datetimepicker.js"></script>

    <script type="text/javascript">

	    function apply(cb) {

	        if(cb.checked == 1) {
	            document.getElementById('createAccount').disabled = false;
	        }else {
	            document.getElementById('createAccount').disabled = true;
	        }
	    }

        function show(str) {

            var value = document.getElementById(str).value;
            var message = "Stricly use number only.";

            if(isNaN(value) == true) {
                alert(message);
                document.getElementById(str).select();
                return false;
            }else {
                var splits = str.split("_");
                var cost_id = "cost_" + splits[1];
                document.getElementById(cost_id).value = value * Number(document.getElementById("qty" + splits[1]).value);
                var total_cost = 0
                var counter = 1;
                while (counter <= 12) {
                    total_cost += Number(document.getElementById("cost_" + counter).value);
                    counter++;
                }
                document.getElementById("total_cost").value = total_cost;
                return true;
            }
        }



    </script>

    <?php
    echo '<h3 style="color:red;">Please select the appropriate PR Type to identify the right signatories.</h3>';
    echo "<form name='sendpr' action='segregatePR.php' enctype='multipart/form-data'  method='POST' >";
    echo "<div id='type'>PR Type: <select name='type' onchange='changeType(this.value);' required >";
    echo "<option value='' selected disabled>Please Select</option>";
    echo "<option value='for approval'>For LLR</option>";
    echo "<option value='consumable'>Consumable</option>";
    echo "<option value='office supplies'>Office Supplies</option>";
    echo "<option value='safety supplies'>Safety Supplies</option>";
    echo "<option value='for_canvassing' >For Canvassing</option>";
    echo "<option value='for_sample' >For Sample</option>";
    echo "<option value='for hr'>PPE</option>";
    echo "<option value='heavy_vehicles' >Heavy Equipment / Vehicles</option>";
    echo "<option value='electric_equipment'>Electric Equipment</option>";
    echo "</select></div>";
    echo "<input type=text name='prNumber' id='prNumber' value='Unassigned' readonly>";
    echo "<span id='branch_to_canvass'><input type='hidden' name='branch_will_canvass' value='' id='branch_selection'></span>";
    echo "<img id='form' src='prform.png'>";

    //echo "<input type='text' name='branch' id='branch' value='$branch' size=11 readonly>";

    
    //added 11/27/18 - jayson
    echo "<input type='hidden' name='branch' id='branch' value='$branch' size=11 readonly>";
    echo "<span id='branch'>{$branch}</span>";
    ?>

    <?php
    $petsa = date("Y/m/d");
	//echo "<input type='text' name='date' id='date' size=10 value='$petsa' readonly>";

    //added 11/27/18 - jayson
    echo "<input type='hidden' name='date' id='date' size=10 value='$petsa' readonly>";
    echo "<span id='date'>{$petsa}</span>";

    echo "<input type='text' name='date_needed' id='date_needed' size=10  required >";
    echo "<input type='text' name='end_use' id='end_use' size=120 required >";
    echo "<input type='text' name='justification' id='justification' size=120 required >";
    echo "<input type='text'name='qty1' id='qty1' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty2' id='qty2' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty3' id='qty3' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty4' id='qty4' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty5' id='qty5' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty6' id='qty6' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty7' id='qty7' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty8' id='qty8' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty9' id='qty9' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty10' id='qty10' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty11' id='qty11' onkeyup='show(this.id);' value='' size=8>";
    echo "<input type='text'name='qty12' id='qty12' onkeyup='show(this.id);' value='' size=8>";

    echo "<input type='text'name='um1' id='um1' value='' size=8>";
    echo "<input type='text'name='um2' id='um2' value='' size=8>";
    echo "<input type='text'name='um3' id='um3' value='' size=8>";
    echo "<input type='text'name='um4' id='um4' value='' size=8>";
    echo "<input type='text'name='um5' id='um5' value='' size=8>";
    echo "<input type='text'name='um6' id='um6' value='' size=8>";
    echo "<input type='text'name='um7' id='um7' value='' size=8>";
    echo "<input type='text'name='um8' id='um8' value='' size=8>";
    echo "<input type='text'name='um9' id='um9' value='' size=8>";
    echo "<input type='text'name='um10' id='um10' value='' size=8>";
    echo "<input type='text'name='um11' id='um11' value='' size=8>";
    echo "<input type='text'name='um12' id='um12' value='' size=8>";

    echo "<input type='text' name='desc1' id='desc1' value='' size=50>";
    echo "<input type='text' name='desc2' id='desc2' value='' size=50>";
    echo "<input type='text' name='desc3' id='desc3' value='' size=50>";
    echo "<input type='text' name='desc4' id='desc4' value='' size=50>";
    echo "<input type='text' name='desc5' id='desc5' value='' size=50>";
    echo "<input type='text' name='desc6' id='desc6' value='' size=50>";
    echo "<input type='text' name='desc7' id='desc7' value='' size=50>";
    echo "<input type='text' name='desc8' id='desc8' value='' size=50>";
    echo "<input type='text' name='desc9' id='desc9' value='' size=50>";
    echo "<input type='text' name='desc10' id='desc10' value='' size=50>";
    echo "<input type='text' name='desc11' id='desc11' value='' size=50>";
    echo "<input type='text' name='desc12' id='desc12' value='' size=50>";

    echo "<input type='text' name='lpp1' id='lpp1' value='' size=8>";
    echo "<input type='text' name='lpp2' id='lpp2' value='' size=8>";
    echo "<input type='text' name='lpp3' id='lpp3' value='' size=8>";
    echo "<input type='text' name='lpp4' id='lpp4' value='' size=8>";
    echo "<input type='text' name='lpp5' id='lpp5' value='' size=8>";
    echo "<input type='text' name='lpp6' id='lpp6' value='' size=8>";
    echo "<input type='text' name='lpp7' id='lpp7' value='' size=8>";
    echo "<input type='text' name='lpp8' id='lpp8' value='' size=8>";
    echo "<input type='text' name='lpp9' id='lpp9' value='' size=8>";
    echo "<input type='text' name='lpp10' id='lpp10' value='' size=8>";
    echo "<input type='text' name='lpp11' id='lpp11' value='' size=8>";
    echo "<input type='text' name='lpp12' id='lpp12' value='' size=8>";



    // echo "<input type='text' name='cv1_1' id='cv_1' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_2' id='cv_2' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_3' id='cv_3' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_4' id='cv_4' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_5' id='cv_5' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_6' id='cv_6' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_7' id='cv_7' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_8' id='cv_8' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_9' id='cv_9' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_10' id='cv_10' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_11' id='cv_11' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv1_12' id='cv_12' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";

    // echo "<input type='text' name='cv2_1' id='cv2_1' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_2' id='cv2_2' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_3' id='cv2_3' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_4' id='cv2_4' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_5' id='cv2_5' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_6' id='cv2_6' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_7' id='cv2_7' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_8' id='cv2_8' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_9' id='cv2_9' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_10' id='cv2_10' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_11' id='cv2_11' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv2_12' id='cv2_12' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";

    // echo "<input type='text' name='cv3_1' id='cv3_1' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_2' id='cv3_2' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_3' id='cv3_3' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_4' id='cv3_4' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_5' id='cv3_5' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_6' id='cv3_6' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_7' id='cv3_7' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_8' id='cv3_8' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_9' id='cv3_9' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_10' id='cv3_10' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_11' id='cv3_11' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";
    // echo "<input type='text' name='cv3_12' id='cv3_12' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' readonly>";

    echo "<input type='text' name='cv1_1' id='cv_1' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_2' id='cv_2' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_3' id='cv_3' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_4' id='cv_4' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_5' id='cv_5' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_6' id='cv_6' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_7' id='cv_7' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_8' id='cv_8' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_9' id='cv_9' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_10' id='cv_10' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_11' id='cv_11' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv1_12' id='cv_12' value='' size=7 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";

    echo "<input type='text' name='cv2_1' id='cv2_1' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_2' id='cv2_2' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_3' id='cv2_3' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_4' id='cv2_4' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_5' id='cv2_5' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_6' id='cv2_6' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_7' id='cv2_7' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_8' id='cv2_8' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_9' id='cv2_9' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_10' id='cv2_10' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_11' id='cv2_11' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv2_12' id='cv2_12' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";


    echo "<input type='text' name='cv3_1' id='cv3_1' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_2' id='cv3_2' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_3' id='cv3_3' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_4' id='cv3_4' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_5' id='cv3_5' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_6' id='cv3_6' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_7' id='cv3_7' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_8' id='cv3_8' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_9' id='cv3_9' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_10' id='cv3_10' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_11' id='cv3_11' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cv3_12' id='cv3_12' value='' size=14 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";

    echo "<input type='text' name='cost_1' id='cost_1' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_2' id='cost_2' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_3' id='cost_3' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_4' id='cost_4' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_5' id='cost_5' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_6' id='cost_6' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_7' id='cost_7' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_8' id='cost_8' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_9' id='cost_9' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_10' id='cost_10' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_11' id='cost_11' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";
    echo "<input type='text' name='cost_12' id='cost_12' value='' size=12 onkeyup='show(this.id);' onclick='show(this.id);' autocomplete='off' class='cv'>";

    echo "<input type='text' name='cvt1' id='cvt1' value='' size=7 class='cv'>";
    echo "<input type='text' name='cvt2' id='cvt2' value='' size=14 class='cv'>";
    echo "<input type='text' name='cvt3' id='cvt3' value='' size=14 class='cv'>";
    echo "<input type='text' name='total_cost' id='total_cost' value='' size=12 class='cv' />";

    echo "<input type='text' name='total1' id='total1' value='' size=7 class='cv'>";
    echo "<input type='text' name='total2' id='total2' value='' size=14 class='cv'>";
    echo "<input type='text' name='total3' id='total3' value='' size=14 class='cv'>";
    echo "<input type='text' name='totalLPP' id='totalLPP' value='' size=8>";
    
    if ($_SESSION['usertype'] == 'HRD') {
        echo "<input type='text' name='canvasser' id='canvasser' value='EFI HR' size=15 required readonly>";
    } else {
        echo "<input type='text' name='canvasser' id='canvasser' value='' size=15 required >";
    }

    $result = mysql_query("SELECT * FROM users where authority='signatory' and name !='LLR' and (position='BH' or position='HRD')");

    echo "<select name='verified' id='verified' required />";
    echo "<option value=''>Select </option>";
    while ($row = mysql_fetch_array($result)) {
        echo "<option value='" . $row['name'] . "'>" . strtoupper($row['fullname']) . "</option>";

    }
    echo "</select>"; 

    echo "<input type='text' value='' size=4 id='approved' name='approved' readonly><span id='approvedSpn' name='appName'></span><br>";
    echo 'Quotation: <input type="file" name="quotation[]" multiple>' . '<br>';
    echo 'Is this Final?<input type="checkbox" id="condition" name="condition" value="checkbox" onClick="apply(this)" />';
    echo "<input type='submit' id='createAccount' value='Submit' disabled='true'>";
    echo "</form>";
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

<span id="canvass">
    <h3>Supplier Directory</h3>
    <iframe src="supplierlist.php" height="500" width="350"></iframe>
</span>


