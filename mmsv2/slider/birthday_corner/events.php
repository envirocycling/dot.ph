<?php
include "../../connect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
    </head>
    <body style="padding:0px; margin:0px; background-color:#fff;font-family:'Open Sans',sans-serif,arial,helvetica,verdana">
        <?php
        if (!empty($_GET['page']) && $_GET['page'] == 'init') {
            echo '<center><h2>COMPANY EVENTS</h2>';
            echo '<a href="events.php">Show details. Click Here</a></center>';
        } else {
            ?>
            <!-- #region Jssor Slider Begin -->
            <!-- Generator: Jssor Slider Maker -->
            <!-- Source: http://www.jssor.com -->
            <!-- This code works without jquery library. -->
            <style>
                .no-js #loader { display: none;  }
                .js #loader { display: block; position: absolute; left: 100px; top: 0;}
                .se-pre-con {
                    position: fixed;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                    background: url(loader-128x/l41.gif) center no-repeat #fff; opacity: 0.8;
                }
            </style>
            <script src="js/jssor.slider-22.1.8.min.js" type="text/javascript"></script>
            <script src="js/jquery.min.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#jssor_1').hide();
                    $(".se-pre-con").fadeIn("fast");
                });
                jssor_1_slider_init = function () {

                    var jssor_1_options = {
                        $AutoPlay: true,
                        $BulletNavigatorOptions: {
                            $Class: $JssorBulletNavigator$
                        },
                        $ThumbnailNavigatorOptions: {
                            $Class: $JssorThumbnailNavigator$,
                            $Cols: 3,
                            $Align: 200
                        }
                    };

                    var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

                    /*responsive code begin*/
                    /*you can remove responsive code if you don't want the slider scales while window resizing*/
                    function ScaleSlider() {
                        var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                        if (refSize) {
                            refSize = Math.min(refSize, 600);
                            jssor_1_slider.$ScaleWidth(refSize);
                        } else {
                            window.setTimeout(ScaleSlider, 30);
                        }
                    }
                    ScaleSlider();
                    $Jssor$.$AddEvent(window, "load", ScaleSlider);
                    $Jssor$.$AddEvent(window, "resize", ScaleSlider);
                    $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
                    /*responsive code end*/
                };

                window.onload = function () {
                    $('#jssor_1').show();
                    $(".se-pre-con").fadeOut("slow");
                };
            </script>
            <style>
                .bday_name{
                    font-size: 15px;
                }
                /* jssor slider bullet navigator skin 03 css */
                /*
                .jssorb03 div           (normal)
                .jssorb03 div:hover     (normal mouseover)
                .jssorb03 .av           (active)
                .jssorb03 .av:hover     (active mouseover)
                .jssorb03 .dn           (mousedown)
                */
                .jssorb03 {
                    position: absolute;
                }
                .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
                    position: absolute;
                    /* size of bullet elment */
                    width: 21px;
                    height: 21px;
                    text-align: center;
                    line-height: 21px;
                    color: white;
                    font-size: 12px;
                    background: url('img/b03.png') no-repeat;
                    overflow: hidden;
                    cursor: pointer;
                }
                .jssorb03 div { background-position: -5px -4px; }
                .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
                .jssorb03 .av { background-position: -65px -4px; }
                .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }
                /* jssor slider thumbnail navigator skin 16 css *//*.jssort16 .p            (normal).jssort16 .p:hover      (normal mouseover).jssort16 .pav          (active).jssort16 .pav:hover    (active mouseover).jssort16 .pdn          (mousedown)*/.jssort16 .p {    position: absolute;    top: 0;    left: 0;    width: 200px;    height: 100px;}.jssort16 .t {    position: absolute;    top: 0;    left: 0;    width: 200px;    height: 100px;    border: none;}.jssort16 .p img {    position: absolute;    top: 0;    left: 0;    width: 200px;    height: 100px;    filter: alpha(opacity=55);    opacity: .55;    transition: opacity .6s;    -moz-transition: opacity .6s;    -webkit-transition: opacity .6s;    -o-transition: opacity .6s;}.jssort16 .pav img, .jssort16 .pav:hover img, .jssort16 .p:hover img {    filter: alpha(opacity=100);    opacity: 1;    transition: none;    -moz-transition: none;    -webkit-transition: none;    -o-transition: none;}.jssort16 .pav:hover img, .jssort16 .p:hover img {    filter: alpha(opacity=70);    opacity: .7;}.jssort16 .title, .jssort16 .title_back {    position: absolute;    bottom: 0px;    left: 0px;    width: 200px;    height: 30px;    line-height: 30px;    text-align: center;    color: #000;    font-size: 20px;}.jssort16 .title_back {    background-color: #fff;    filter: alpha(opacity=50);    opacity: .5;}.jssort16 .pav .title_back {    background-color: #000;    filter: alpha(opacity=50);    opacity: .5;}.jssort16 .pav .title {    color: #fff;}.jssort16 .p.pav:hover .title_back, .jssort16 .p:hover .title_back {    filter: alpha(opacity=40);    opacity: .4;}.jssort16 .p.pdn img {    filter: alpha(opacity=100);    opacity: 1;}
            </style>
        <center><h2>COMPANY EVENTS</h2></center>
         <div class="se-pre-con"></div>
        <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:400px;overflow:hidden;visibility:hidden;">
            <!-- Loading Screen -->
            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
            </div>
            <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:600px;height:300px;overflow:hidden;">
                <?php
                echo '<br>';
                $sql_events = mysql_query("SELECT * from slider_events WHERE active=1 Order By date Desc") or die(mysql_error());
                while ($row_events = mysql_fetch_array($sql_events)) {

                    $image_path = "../../images/events/" . $row_events['id'] . '-' . $row_events['img'];
                    echo '<div>
                        <img data-u = "image" src = "' . $image_path . '"/>
                        <div data-u = "thumb">
                            <img src = "' . $image_path . '"/>
                                <div class = "title_back"></div>
                                <div class = "title">
                                <span class="bday_name">' . strtoupper($row_events['title']) . '</span>
                                </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
            <!-- Thumbnail Navigator -->
            <div data-u="thumbnavigator" class="jssort16" style="position:absolute;left:0px;bottom:0px;width:600px;height:100px;" data-autocenter="1">
                <!-- Thumbnail Item Skin Begin -->
                <div data-u="slides" style="cursor: default;">
                    <div data-u="prototype" class="p">
                        <div data-u="thumbnailtemplate" class="t"></div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
            <!-- Bullet Navigator -->
            <div data-u="navigator" class="jssorb03" style="bottom:116px;right:16px;">
                <!-- bullet navigator item prototype -->
                <div data-u="prototype" style="width:21px;height:21px;">
                    <div data-u="numbertemplate"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript">jssor_1_slider_init();</script>
        <!-- #endregion Jssor Slider End -->
    <?php } ?>
</body>
</html>
