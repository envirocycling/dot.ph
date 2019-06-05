<?php
include('templates/template.php');
$_SESSION['bales_to_pack']=array();
$_SESSION['bales_to_unpack']=array();
$_SESSION['isall']='no';
$_SESSION['is_unpack_all']='no';
?>



</html>

<style>
    #bale_list{
        float:left;
        boarder-style:solid;
        padding-right:200px;
    }
    #out_list{
        border-style:solid;
    }
</style>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Packing List Generation</h2>

        <iframe src="list_bale.php" height="800" width="400" id="bale_list" ></iframe>
        <iframe src="out_bales.php" height="800" width="400" id="out_list" ></iframe>

    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>