
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
	background: url(images/loader-128x/l41.gif) center no-repeat #fff; opacity: 0.8;
}
</style>
<div class="se-pre-con"></div>
<script>   
    $(document).ajaxStart(function(){
        $(".se-pre-con").fadeIn("fast");
    });
    $(document).ajaxComplete(function(){
        $(".se-pre-con").fadeOut("slow");
    });
   window.onload = function () {
       $(".se-pre-con").fadeOut("slow");
    };
</script>