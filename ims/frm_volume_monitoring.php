<?php
include('config.php');
include('templates/template.php');
?>

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



</head>
<div class="grid_5">
    <div class="box round first grid">
        <h2>Please select your range of dates</h2>
        <form action="volume_monitoring.php" method="POST">

            Start Period: <input type='text'  id='inputField' name='start_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='end_date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            <input type="submit" value="Generate Report">
        </form>
    </div>
</div>

</body>
</html>


<div class="clear">
</div>
<div class="clear">
</div>
