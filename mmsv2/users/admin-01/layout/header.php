<?php
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
date_default_timezone_set("Asia/Singapore");
@session_start();
if(!isset($_SESSION['username-0'])){
    echo '<script>
        location.replace("../../index.php");
        </script>';
} 
if($pageWasRefreshed ) {
    if(@$_GET['http'] == '200'){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = str_replace("&http=200","",$actual_link);
    echo '<script>
            window.top.location.href="'.$actual_link.'";
    </script>';
    }else if(@$_GET['http'] == '400'){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $actual_link = str_replace("&http=400","",$actual_link);
    echo '<script>
            window.top.location.href="'.$actual_link.'";
    </script>';
    }
}
if(@$_GET['http'] == '200'){include 'alert.php';}
if(@$_GET['http'] == '400'){include 'alert_exist.php';}
?>
<head>
        <title>EFI Manpower Management</title>
        <!-- Load Roboto font -->
        <link href='css/fonts.css' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.cslider.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css" />
        <link rel="shortcut icon" type="image/x-icon" href="../../../images/logo.png" />

    </head>
<div class="navbar">
            <div class="navbar-inner">
                
                <div class="container">
                    <a class="brand"><img src="../../images/logo.png" alt="Logo" />EFI Manpower Management System</a>                 
                        
                    <div class="nav-collapse collapse pull-right1">
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
</div>
    
