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

<style>
    body{
        font-size: 30px;
    }
    input{
        font-size: 30px;
    }
</style>
<center>
    <h1>
        <body>

            <?php
            $branch=$_GET['branch'];
            echo "<h3>$branch Inventory range selection</h3><br>";
            ?>
            <form action="inventory_analysis.php" method="POST">
                <input type='hidden'  name='branch' value="<?php echo $branch;?>"  >
                From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly><br>
                TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly><br>
                <input type="hidden" name="branch" value="<?php echo $branch;?>">
                <input type="submit" value="Generate Report">
            </form>
        </body>
    </h1>
</center>