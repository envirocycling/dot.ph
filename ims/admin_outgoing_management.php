<?php
date_default_timezone_set('America/Los_Angeles');
include('templates/template.php');

ini_set('upload_max_filesize', '700M');
ini_set('post_max_size', '16M');

?>

<?php
//get unique id
$up_id = uniqid();
?>

<head>


    <style>



        input{
            font-size:20px;
        }
        table{
            text-align:left;
        }
        .sup_name{
            border-style:hidden;
            color:red;
            font-size:20px;
        }
        #supplier_name{
            border-style:hidden;
            color:red;
            font-size:20px;
            background-color: transparent;
        }
        td{
            font-size:20px;
        }
        .sup_name td{
            border-style:hidden;
            font-style:   italic;
        }
        #name_here{
            color:red;
        }
        #grade{
            font-size:30px;
        }
        h2{
            color:black;
        }
    </style>


</head>

</html>




<div class="grid_10">
    <div class="box round first grid">
        <h2>Outgoing Data Management</h2>

        <a rel="facebox" href="frm_delete_outgoing_data.php"><button>Delete Branch Outgoing Data</button></a>
        <a rel="facebox" href="frm_delete_actual_data.php"><button>Delete Actual Outgoing Data</button></a>





    </div>
</div>
<div class="clear">

</div>

<div class="clear">

</div>