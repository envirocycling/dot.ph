<?php
session_start();
include('config.php');
if (isset($_POST['from_id'])) {
    $from_idm = $_POST['from_id'];
    $message = $_POST['message'];
    $to_id = $_POST['to_id'];
    $date = date("Y/m/d h:i A");
    mysql_query("INSERT INTO messages
	(from_id, to_id, content, time)
	VALUES
	('$from_idm','$to_id','$message','$date')");
    $_SESSION['from_id'] = $to_id;
} else {
    $_SESSION['from_id'] = $_GET['from_id'];
}
$from_id = $_SESSION['from_id'];
?>
<html lang="EN">
    <head>
        <meta charset="utf-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <style>
            body {
                background-color: #3366ff;
                font-family:"Tahoma",Arial Narrow;
                font-size: 12px;
            }
            .holder {
                background-color: white;
                padding:3px;
                margin-left:auto;
                margin-right:auto;
                margin-top:10%;
                display:table;
                border:solid 1px #cccccc;
                border-width: thin;
            }
            .style {
                bottom:0px;
                border:1px solid #666;
                background-color:#FFF;
                border-radius:3px;
                -webkit-border-radius:3px;
                -moz-border-radius:3px;
                box-shadow:0 0 5px #000;
                -moz-box-shadow:0 0 5px #000;
                -webkit-box-shadow:0 0 5px #000;
            }
            .alpha {
                float:right;
                width:300px;
                padding:2px;
                border:1px solid #666;
                background-color:#FFF;
                border-radius: 3px;
            }
            .refresh {
                border: 1px solid #3366FF;
                border-left: 4px solid #3366FF;
                color: green;
                font-family: tahoma;
                font-size: 12px;
                height: 225px;
                overflow: auto;
                width: 270px;
                padding:10px;
                background-color:#FFFFFF;
            }
            #post_button{
                border: 1px solid #3366FF;
                background-color:#3366FF;
                width: 50px;
                color:#FFFFFF;
                font-weight: bold;
                margin-left: -04px; padding-top: 4px; padding-bottom: 4px;
                cursor:pointer;
            }
            #textb{
                border: 1px solid #3366FF;
                border-left: 4px solid #3366FF;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 5px;
                width: 220px;
            }
            #texta{
                border: 1px solid #3366FF;
                border-left: 4px solid #3366FF;
                width: 210px;
                margin-bottom: 10px;
                padding:5px;
            }
            #johnlei{
                margin-left:3px;
                color: #ffffff;
                text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
                background-color: #49afcd;
                *background-color: #2f96b4;
                background-image: -moz-linear-gradient(top, #5bc0de, #2f96b4);
                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#5bc0de), to(#2f96b4));
                background-image: -webkit-linear-gradient(top, #5bc0de, #2f96b4);
                background-image: -o-linear-gradient(top, #5bc0de, #2f96b4);
                background-image: linear-gradient(to bottom, #5bc0de, #2f96b4);
                background-repeat: repeat-x;
                border-color: #2f96b4 #2f96b4 #1f6377;
                border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff5bc0de', endColorstr='#ff2f96b4', GradientType=0);
                filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
                float:right;
                cursor:pointer;
                height: 53px;
                width:70px;
            }
            #johnlei:hover,
            #johnlei:active,
            #johnlei.active,
            #johnlei.disabled,
            #johnlei[disabled] {
                color: #ffffff;
                background-color: #51a351;
                *background-color: #499249;
            }
            #johnlei:active,
            #johnlei.active {
                background-color: #408140;
            }
            #johnlei:hover{
                background-color: #2f96b4;
            }
        </style>
        <script src="js/jquery.js"></script>
    </head>
    <body>
        <div class="holder">
            <h2>
                <label id="welcomemsg">WELCOME: </label><label for="name">
                    <?php echo ucfirst($_SESSION['username']); ?>
                </label>
            </h2>
            <div class="style">
                <div class="alpha">
                    <b align="center"></b>
                    <div class="refresh">
                    </div>
                    <br/>
                    <form method="POST" name="newMessage" class="newMessage" action="message2.php">
                        <input name="from_id" type="hidden" id="texta" value="<?php echo ucfirst($_SESSION['username']); ?>"/>

                        <input name="to_id" type="hidden" id="recipient" value="<?php echo $from_id; ?>"/>
                        <textarea name="message" id="textb" placeholder="Enter your message here"></textarea>
                        <input name="submit" type="submit" value="Send" id="johnlei" />
                    </form>
                </div>
            </div>
            <script src="js/refresh_1.js" type="text/javascript"></script>
        </div>
    </body>
</html>