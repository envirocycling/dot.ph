

<?php
include("templates/template_pss.php");
?>




<?php

$branches_query = mysql_query("SELECT * from branches;");

?>

<div class="grid_3">
    <div class="box round first">
        <h2>Filtering Options</h2>
        <form action="outgoing_pss_report.php" method="POST">
            From - To: <input type='text' name='dates'><br>

            Branch:
            <select name="branch">
            <?php while($branch_row = mysql_fetch_array($branches_query)): ?>
                <option value="<?php echo $branch_row['branch_name']; ?>"><?php echo $branch_row['branch_name']; ?></option>
            <?php endwhile; ?>
            </select>
            <input name="filter" type="submit" value="Filter">
        </form>
    </div>
</div>

<div class="grid_15">
    <div class="box round first grid">

        <?php

            if(isset($_POST['filter'])) {
                echo $_POST['dates'];
            }
        ?>

        <table id="tbl" class="table table-striped table-bordered" >

            <thead>
                <tr>
                    <th></th>
                    <th>Delivery Date</th>
                    <th>STR #</th>
                    <th>Branch</th>
                    <th>Delivered To</th>
                    <th>Trucking</th>
                    <th>Plate Number</th>
                    <th>Trucking Fee</th>
                    <th>WP Grade</th>
                    <th>No. of Bales</th>
                    <th>From Loc. Wt.</th>
                    <th>Avg. Wt. per Bale</th>
                    <th>NET Weight</th>
                    <th>Variance</th>
                    <th>Branch Mc (Kg)</th>
                    <th>Client Mc (Kg)</th>
                    <th>Dirt</th>
                    <th>Corrected Wt.</th>
                    <th>DR #</th>
                    <th>Client Mc Perct.</th> 
                </tr>
            </thead>

            <tbody>

            </tbody>
        
        </table>

    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>