<?php
date_default_timezone_set('America/Los_Angeles');
include('templates/template.php');


?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>EFI Branches </h2>
        <?php
        include("config.php");
        $query="SELECT * FROM branches";
        $result=mysql_query($query);
        ?>

        <table class="data display datatable" id="example">

            <?php
            echo "<thead>";
            echo "<tr class='data'>";
            echo "<th class='data'>Branch Name</th>";
            echo "<th class='data'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            while($row = mysql_fetch_array($result)) {
                echo "<tr class='data'>";
                echo "<td class='data'>".$row['branch_name']."</td>";
                echo "<td class='data'><a rel='facebox' href='admin_edit_branch.php?branch_id=".$row['branch_id']."'>Edit</a> &nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp ";

                echo "<a rel='facebox' href='deletebranch_confirmation.php?branch_id=".$row['branch_id']."'>Delete</a></td>";

                echo "</tr>";

            }
            echo "</table>";

            ?>
            <a rel="facebox" href="admin_addnew_branch.php"><button>Add New Branch</button> </a>


    </div>
</div>
