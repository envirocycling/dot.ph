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


<body>
    <h1>Please input criteria</h1>

    <form action="export_outgoing.php" method="POST">



        From: <input type='text'  id='inputField' name='from' value="" onfocus='date1(this.id);' readonly><br>
        TO: <input type='text'  id='inputField2' name='to' value="" onfocus='date1(this.id);' readonly><br>
        <input type="submit" value="Export">
    </form>
</body>