<?php
include('templates/template.php');

?>




<div class="grid_10">
    <div class="box round first">
        <?php

        echo "<center><h2><i><b><u> ".$_GET['grade'] ." </u></b></i> Pricing Against Competitors</h2>";
        ?>
        <div id="bar-chart">
            <?php

            echo '<iframe src="dist/graphs/per_grade_pricing_with_competitors.php?grade='.$_GET['grade'].'" height="1000" width="100%"></iframe>';

            ?>
        </div>
    </div>
</div>
<div class="clear">
</div>

<div class="clear">
</div>
