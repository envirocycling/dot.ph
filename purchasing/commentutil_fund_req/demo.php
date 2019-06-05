<?php
session_start();

$id=$_GET['request_id'];
$id=$id."@yahoo.com";
error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";


/*
/	Select all the comments and populate the $comments array with objects
*/

$comments = array();
$result = mysql_query("SELECT * FROM fund_req_comments where email='$id' ORDER BY id ASC");

while($row = mysql_fetch_assoc($result)) {
    $comments[] = new Comment($row);
}

?>

<head>

    <link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>



    <div id="main">

        <?php

        /*
/	Output the comments one by one:
        */

        foreach($comments as $c) {
            echo $c->markup();
        }

        ?>

        <div id="addCommentContainer">
            <p>Add a Comment</p>
            <form id="addCommentForm" method="post" action="">
                <div>

                    <input type="hidden" value="<?php echo $_SESSION['username'];?>" name="name" id="name" />


                    <input type="hidden" name="email" id="email" value="<?php echo $id;?>" />


                    <input type="hidden" name="url" id="url" />

                    <label for="body">Comment Body</label>
                    <textarea name="body" id="body" cols="20" rows="5"></textarea>

                    <input type="submit" id="submit" value="Submit" />
                </div>
            </form>
        </div>

    </div>

    <script type="text/javascript" src="../jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="script.js"></script>

</body>
</html>
