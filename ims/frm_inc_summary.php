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
        <h2>Incentive Summary</h2>
        <form action="inc_summary.php" method="POST">
            <br>
            <h6>Please select month and branch</h6>
            Select Month: <input type='text'  id='inputField' name='date' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly size="8"><br>

            <?php
            
            $query = "SELECT * FROM branches  ";
            $result = mysql_query($query) ;
            echo "Branch:";
            $dropdown = "<select name='branch' >";
            $dropdown .= "\r\n<option value=''>All Branches</option>";
            $dropdown .= "\r\n<option value='Sauyo/Kaybiga'>Sauyo/Kaybiga</option>";
            $dropdown .= "\r\n<option value=''>__________</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['branch_name']}'>{$row['branch_name']}</option>";
            }
            $dropdown  .= "\r\n</select><br>";
            echo $dropdown;

            ?>


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
