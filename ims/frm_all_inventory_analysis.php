<?php
include('config.php');
include('templates/template.php');
$branch = $_GET['branch'];
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
    function date2(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m"

        });
    };
</script>



</head>
<div class="grid_4">
    <div class="box round first grid">
        <h2>Inventory Analysis Of All Branches</h2>
        <form action="all_inventory_analysis_ver2.php" method="POST">
            <br>
            <h6>Please select your range of dates</h6>
            Start Period: <input type='text'  id='inputField' name='from' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
            End Period:<input type='text'  id='inputField2' name='to' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>
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
