<?php
@session_start();
include('connect.php');
$query = mysql_query("Select * from tbl_users Where username='" . $_SESSION['bhead_username'] . "' ") or die(mysql_error());
$row = mysql_fetch_array($query);
$username = $_SESSION['bhead_username'];
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
    function setting() {
        var val = document.getElementById('val').value;
        //
        if (val == 0) {
            document.getElementById('val').value = '1';
            document.getElementById('setting').hidden = true;
        } else {
            document.getElementById('val').value = '0';
            document.getElementById('setting').hidden = false;
        }
    }

    function backed() {
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
if ($page == 'vehicle') {
    $vehicle = 'active';
} else if ($page == 'maintenance') {
    $maintenance = 'active';
} else if ($page == 'registration') {
    $registration = 'active';
} else if ($page == 'reassign') {
    $reassign = 'active';
} else if ($page == 'trip') {
    $trip = 'active';
} else if ($page == 'summary') {
    $summary = 'active';
} else if ($page == 'contract') {
    $contract = 'active';
}else if ($page == 'trequest') {
    $trequest = 'active';
}else if ($page == 'recording') {
    $recording = 'active';
}
?>
<div id='cssmenu'>
    <ul>
        <li class='has-sub <?php echo $vehicle; ?>'><a><span>Vehicle</span></a>
            <ul>
                <li><a href='new_truck.php?page=vehicle'><span>New Vehicle</span></a></li>
                <li><a href='existing_truck.php?page=vehicle'><span>Existing Vehicles</span></a></li>
            </ul>
        </li>
        <li class='<?php echo $recording; ?>'><a href='hrm_recording.php?page=recording'><span>HRM Recording</span></a></li>
        <li class='<?php echo $trequest; ?>'><a href='truck_request.php?page=trequest'><span>Truck Request</span></a></li>
        <li class='<?php echo $maintenance; ?>'><a href='maintenance.php?page=maintenance'><span>Maintenance</span></a></li>
        <li class='<?php echo $registration; ?>'><a href='registration_monitoring.php?page=registration'><span>Registration</span></a></li>
        <li class='<?php echo $contract; ?>'><a href='terminated_contract.php?page=contract'><span>Terminated Contract</span></a></li>
        <li class='<?php echo $reassign; ?>'><a href='truck_reassign.php?page=reassign'><span>Reassignment</span></a></li>
        <li class='<?php echo $trip; ?>'><a href='trip.php?page=trip'><span>Trip Schedule</span></a></li>
        <li class='<?php echo $summary; ?>'><a href='summary.php?page=summary'><span>Summary</span></a></li>
        <li><a href="logout.php"><span>Logout</span></a></li>
    </ul>
    <img src="img/header_line.png" style="width:100%;">
</div>

