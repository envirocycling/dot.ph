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
    <h3>Encode Outgoing </h3><hr>

    <form action="encode_outgoing.php" method="POST">
        <?php
        $branch=$_GET['branch'];
        ?>

        Date: <input type='text'  id='inputField' name='date' value="" onfocus='date1(this.id);' readonly size="8" required><br>
        STR: <input type="text" value="" name="str" size="5" required><br>
        Trucking: <input type="text" value="" name="trucking" size="8" required><br>
        Plate #: <input type="text" value="" name="plate_number" size="8" required><br>
        <?php
        echo "<tr>";
        include('config.php');
        $query = "SELECT * FROM wp_grades ";
        $result = mysql_query($query) ;

        echo "WP Grade:";
        $dropdown = "<select name='wp_grade'  id='wp_grade' >";

        while($row = mysql_fetch_array($result)) {
			$myGrade1 = strtoupper($row['wp_grade']);
			 $wp_grade1 = substr($myGrade1,0,2);
		
		if( $wp_grade1 == 'LC' ){
			 $myGrade = $myGrade1;
		}else if($wp_grade1 == 'CH'){
			$myGrade = $myGrade1;
		}else if($wp_grade1 == 'CO'){
			$myGrade = $myGrade1;
		}else{
			$myGrade = 'LC'.$myGrade1;
		}
			
            $dropdown .= "\r\n<option value='".$myGrade."'>".$myGrade."</option>";
        }

        $dropdown .= "\r\n</select>";
        echo $dropdown;

        ?>
        Weight: <input type="text" value="0" name="weight" size="8" required readonly=""><br>
        Branch: <input type="text" value="<?php echo $branch;?>" name="branch" size="8" required><br>

        <input type="submit" value="Encode">
    </form>
</body>