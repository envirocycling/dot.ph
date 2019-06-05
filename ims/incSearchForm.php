
<div id="inc_criteria">


    <form action='searchIncentive.php' method='post'>
        <b><u>Status:</u></b> <select name="status">
            <option value="">All</option>
            <option value="met">Met</option>
            <option value="above 50">50% and above</option>
            <option value="below 50">Below 50%</option>

        </select>

        <?php
        date_default_timezone_set('America/Los_Angeles');
        $query = "SELECT * FROM wp_grades  ";
        $result = mysql_query($query) ;

        $dropdown = " <b><u>WP Grade:</u></b> <select name='wp_grade'  id='grade' >";
        $dropdown .= "\r\n<option value=''>All</option>";
        while($row = mysql_fetch_array($result)) {
            $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
        }

        $dropdown .= "\r\n</select>";

        echo $dropdown;



        ?>
        <input type="submit" value="Filter">
    </form>
    <a href="incShowAll.php" id="hrefer" ><button>Show ALL</button></a>

</div>
