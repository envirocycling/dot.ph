<?php
session_start();
include 'connect.php';
$query = mysql_query("Select * from tbl_users Where username='" . $_SESSION['public_username'] . "' ") or die(mysql_error());
$row = mysql_fetch_array($query);
$username = $_SESSION['public_username'];
if (!isset($username)) {
    echo '<script>
			location.replace("../index.php");
		</script>';
}

?>
<style>
        #Slider {

        }
        #Actual {
            background: #282828;
            color: White;
			width:50%;
			-webkit-border-radius: 30px 0px 0px 30px;
			border-radius: 0px 50px 50px 0px;
			-moz-border-radius: 0px 50px 50px 0px;
        }
        .slideup, .slidedown {
            max-height: 0;
            overflow-y: hidden;
            -webkit-transition: max-height 1s ease-in-out;
            -moz-transition: max-height 1s ease-in-out;
            -o-transition: max-height 1s ease-in-out;
            transition: max-height 1s ease-in-out;
        }
        .slidedown {
            max-height: 300px ;
        }
		.container{

		}
		#Trigger:hover{
			background-color:#2a2b2a;
		}
		#Trigger{
			font-family:Arabic Typesetting; vertical-align:middle; font-size:80%; cursor:pointer;text-align:center; background-color:#1863b3; padding-left:15px; padding-right:15px;border-radius: 0px 0px 0px 0px;
-webkit-border-radius: 0px 0px 0px 20px;
-moz-border-radius: 0px 0px 0px 0px; color:#FFFFFF;
	}
		#back{
			cursor:pointer;
		}

    </style>

<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
 <script>
   	function setting(){
		var val = document.getElementById('val').value;
			//
		if(val == 0){
			document.getElementById('val').value='1';
			document.getElementById('setting').hidden=true;
		}else{
			document.getElementById('val').value='0';
			document.getElementById('setting').hidden=false;
		}
	}

	function backed(){
		window.history.back();
	}
   </script>

<input type="hidden" id="val" value="1">
	<div id="setting" hidden style="font-family:'Century Gothic'; color:#FFFFFF; width:20%; font-size-adjust:none;"><center><span style="font-size:11px;">Update Account</span>


		</center>
	</div>
<div id="logo"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php"><img src="img/logo_vms.png" height="20%" width="25%"></a></div>
<center>
    <div class="container">
      <div><span id="greet"  style="font-family:Haettenschweiler;">Welcome &nbsp;&nbsp;<span id="Trigger" style=""><?php echo $username; ?></span></span></div>
      <div id="Slider" class="slideup">
        <!-- content has to be wrapped so that the padding and
                margins don't effect the transition's height -->
        <div id="Actual">
			<form action="update_account.php" method="post">
             Upadate Account
			 <table style="font-size:11px; width:50%;" >
			<tr>
				<td>Username:</td>
				<td><input type="text" autocomplete="off" style="border-radius: 0px 0px 5px 5px;
-webkit-border-radius: 0px 0px 5px 5px;
-moz-border-radius:  0px 0px 5px 5px;  height:20px; width:80%; font-size:14px; text-transform:uppercase;" value="<?php echo $row['username']; ?>" name="username" required></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" style="border-radius: 0px 0px 5px 5px;
-webkit-border-radius: 0px 0px 5px 5px;
-moz-border-radius:  0px 0px 5px 5px;  height:20px;  width:80%;font-size:25px;" value="<?php echo $row['password']; ?>" name="password" required></td>
			</tr>
			<tr>
				<td>Current-Password:</td>
				<td><input type="password" style="border-radius: 0px 0px 5px 5px;
-webkit-border-radius: 0px 0px 5px 5px;
-moz-border-radius:  0px 0px 5px 5px;  height:20px;  width:80%;font-size:25px;" name="oldpassword" required></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="right"><input type="submit" id="button"></td>
			</tr>
		</table>
		</form>
            </div>
      </div>
    </div>

    <script>

        $("#Trigger").click(function () {
          $("#Slider").toggleClass("slidedown slideup");
          //  if ($("#Slider").hasClass("slideup"))
          //    $("#Slider").removeClass("slideup").addClass("slidedown");
          //  else
          //      $("#Slider").removeClass("slidedown").addClass("slideup");
        });
    </script>
</div></center><br />
<?php
@$page = $_GET['page'];
if ($page == 'existing') {
    $existing = 'active';
} else if ($page == 'maintenance') {
    $maintenance = 'active';
} else if ($page == 'registration') {
    $registration = 'active';
} else if ($page == 'trip') {
    $trip = 'active';
} else if ($page == 'summary') {
    $summary = 'active';
}
?>
<div id='cssmenu'>
<ul>
	 <?php
$username = $_SESSION['public_username'];

if ($username == 'Xcellent'):
?>
	 <li class='<?php echo $trip; ?>'><a href='trip.php?page=trip'><span>Trip Schedule</span></a></li>
	 <li><a href="logout.php"><span>Logout</span></a></li>
	 <?php else: ?>

		<li class='<?php echo $existing; ?>'><a href='existing_truck.php?page=existing'><span>Existing Vehicles</span></a></li>
   <li class='<?php echo $maintenance; ?>'><a href='maintenance.php?page=maintenance'><span>Maintenance</span></a></li>
   <li class='<?php echo $registration; ?>'><a href='registration_monitoring.php?page=registration'><span>Registration</span></a></li>
   <li class='<?php echo $trip; ?>'><a href='trip.php?page=trip'><span>Trip Schedule</span></a></li>
   <li class='<?php echo $summary; ?>'><a href='summary.php?page=summary'><span>Summary</span></a></li>
   <li><a href="logout.php"><span>Logout</span></a></li>

	<?php endif;?>

</ul>
<img src="img/header_line.png" style="width:100%;">
</div>

