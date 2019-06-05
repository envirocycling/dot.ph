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
        <h2>Uploading of Supplier Capacity Template</h2>
        <h3><i>Kindly upload XML files only <i></h3><br>

                    <form action="importSupplierCapacity.php" method="post"
                          enctype="multipart/form-data">

                        <label for="file">Maximum file size is 1 MB or 1400 rows in excel</label>
                        <input type="file" name="file" id="file"><br>
                        <input type="submit" name="" value="Upload">
                    </form>



                    </div>
                    </div>
                    <div class="clear">

                    </div>

                    <div class="clear">

                    </div>