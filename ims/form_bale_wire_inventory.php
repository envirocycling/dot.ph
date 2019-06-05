<?php include("templates/template.php");?>
<style>
    #summary_per{
        float:right;

    }
</style>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"

        });
    };
</script>

<?php
function secondsToWords($seconds) {
    /*** return value ***/
    $ret = "";
    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0) {
        if($hours<10) {
            $ret .= "0$hours:";
        }else {
            $ret .= "$hours:";
        }
    }else {
        $ret .= "0$hours:";
    }
    $minutes = fmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0) {
        if($minutes<10) {
            $ret .= "0$minutes";
        }else {
            $ret .= "$minutes";
        }
    }

    if($minutes==0) {
        $ret .= "0$minutes";
    }


    /*** get the seconds ***/
    $seconds = fmod(intval($seconds),60);


    return $ret;
}


function secondsToWords2($seconds) {
    /*** return value ***/
    $ret = "";

    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0) {
        if($hours<10) {
            $ret .= "0$hours:";
        }else {
            $ret .= "$hours:";
        }
    }else {
        $ret .= "0$hours:";
    }
    $minutes = fmod((intval($seconds) / 60),60);
    if($hours > 0 || $minutes > 0) {
        if($minutes<10) {
            $ret .= "0$minutes";
        }else {
            $ret .= "$minutes";
        }
    }

    if($minutes==0) {
        $ret .= "0$minutes";
    }


    /*** get the seconds ***/
    $seconds = fmod(intval($seconds),60);


    return $ret;
}



function sec_to_time($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor($seconds % 3600 / 60);
    $seconds = $seconds % 60;

    return sprintf("%02d:%02d", $minutes, $seconds);
}


?>


<style>

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
    #total{
        background-color: yellow;
        font-weight:bold;
    }
</style>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Filtering Options</h2>

        <form action="bale_wire_inventory.php" method="POST">
            <input type="hidden" name="branch" value="<?php echo $_GET['branch'];?>">
            From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly><br>
            TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly><br>
            <input type="submit" value="Filter">
        </form>



    </div>
</div>



<div class="clear">

</div>

<div class="clear">

</div>