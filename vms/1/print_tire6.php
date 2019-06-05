<?php 
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
include('connect.php');
?>
<html>
<head>
<script>
function prints(){
	window.print() ;
	}
</script>

<title>EFI Vehicles Report</title>
<!-- Save for Web Styles (Untitled-4) -->
<style type="text/css">


#Table_01 {
	position:absolute;
	left:0px;
	top:0px;
	width:1347px;
	height:769px;
}

#tireforprint-01 {
	position:absolute;
	left:0px;
	top:0px;
	width:1347px;
	height:146px;
}

#tireforprint-02 {
	position:absolute;
	left:0px;
	top:146px;
	width:257px;
	height:402px;
}

#tireforprint-03 {
	position:absolute;
	left:257px;
	top:146px;
	background-image:url(../tireprint/images/tireforprint_03.gif);
	width:70px;
	height:16px;
}

#tireforprint-04 {
	position:absolute;
	left:327px;
	top:146px;
	width:1020px;
	height:91px;
}

#tireforprint-05 {
	position:absolute;
	left:257px;
	top:162px;
	width:70px;
	height:75px;
}

#tireforprint-06 {
	position:absolute;
	left:257px;
	top:237px;
	width:66px;
	height:157px;
}

#tireforprint-07 {
	position:absolute;
	left:323px;
	top:237px;
	width:115px;
	height:17px;
}

#tireforprint-08 {
	position:absolute;
	left:438px;
	top:237px;
	width:202px;
	height:17px;
}

#tireforprint-09 {
	position:absolute;
	left:640px;
	top:237px;
	width:90px;
	height:17px;
}

#tireforprint-10 {
	position:absolute;
	left:730px;
	top:237px;
	width:211px;
	height:17px;
}

#tireforprint-11 {
	position:absolute;
	left:941px;
	top:237px;
	width:97px;
	height:17px;
}

#tireforprint-12 {
	position:absolute;
	left:1038px;
	top:237px;
	width:309px;
	height:17px;
}

#tireforprint-13 {
	position:absolute;
	left:323px;
	top:254px;
	width:115px;
	height:16px;
}

#tireforprint-14 {
	position:absolute;
	left:438px;
	top:254px;
	width:74px;
	height:16px;
}

#tireforprint-15 {
	position:absolute;
	left:512px;
	top:254px;
	width:128px;
	height:155px;
}

#tireforprint-16 {
	position:absolute;
	left:640px;
	top:254px;
	width:90px;
	height:16px;
}

#tireforprint-17 {
	position:absolute;
	left:730px;
	top:254px;
	width:83px;
	height:16px;
}

#tireforprint-18 {
	position:absolute;
	left:813px;
	top:254px;
	width:128px;
	height:140px;
}

#tireforprint-19 {
	position:absolute;
	left:941px;
	top:254px;
	width:97px;
	height:16px;
}

#tireforprint-20 {
	position:absolute;
	left:1038px;
	top:254px;
	width:34px;
	height:16px;
}

#tireforprint-21 {
	position:absolute;
	left:1072px;
	top:254px;
	width:275px;
	height:141px;
}

#tireforprint-22 {
	position:absolute;
	left:323px;
	top:270px;
	background-image:url(../tireprint/images/tireforprint_22.gif);
	width:115px;
	height:20px;
}

#tireforprint-23 {
	position:absolute;
	left:438px;
	top:270px;
	width:74px;
	height:20px;
}

#tireforprint-24 {
	position:absolute;
	left:640px;
	top:270px;
	background-image:url(../tireprint/images/tireforprint_24.gif);
	width:90px;
	height:20px;
}

#tireforprint-25 {
	position:absolute;
	left:730px;
	top:270px;
	width:83px;
	height:20px;
}

#tireforprint-26 {
	position:absolute;
	left:941px;
	top:270px;
	background-image:url(../tireprint/images/tireforprint_26.gif);
	width:97px;
	height:20px;
}

#tireforprint-27 {
	position:absolute;
	left:1038px;
	top:270px;
	width:34px;
	height:20px;
}

#tireforprint-28 {
	position:absolute;
	left:323px;
	top:290px;
	background-image:url(../tireprint/images/tireforprint_28.gif);
	width:115px;
	height:17px;
}

#tireforprint-29 {
	position:absolute;
	left:438px;
	top:290px;
	width:74px;
	height:17px;
}

#tireforprint-30 {
	position:absolute;
	left:640px;
	top:290px;
	background-image:url(../tireprint/images/tireforprint_30.gif);
	width:90px;
	height:17px;
}

#tireforprint-31 {
	position:absolute;
	left:730px;
	top:290px;
	width:83px;
	height:17px;
}

#tireforprint-32 {
	position:absolute;
	left:941px;
	top:290px;
	background-image:url(../tireprint/images/tireforprint_32.gif);
	width:97px;
	height:17px;
}

#tireforprint-33 {
	position:absolute;
	left:1038px;
	top:290px;
	width:34px;
	height:17px;
}

#tireforprint-34 {
	position:absolute;
	left:323px;
	top:307px;
	background-image:url(../tireprint/images/tireforprint_34.gif);
	width:115px;
	height:16px;
}

#tireforprint-35 {
	position:absolute;
	left:438px;
	top:307px;
	width:74px;
	height:16px;
}

#tireforprint-36 {
	position:absolute;
	left:640px;
	top:307px;
	background-image:url(../tireprint/images/tireforprint_36.gif);
	width:90px;
	height:16px;
}

#tireforprint-37 {
	position:absolute;
	left:730px;
	top:307px;
	width:83px;
	height:16px;
}

#tireforprint-38 {

	position:absolute;
	left:941px;
	top:307px;
	background-image:url(../tireprint/images/tireforprint_38.gif);
	width:97px;
	height:16px;
}

#tireforprint-39 {
	position:absolute;
	left:1038px;
	top:307px;
	width:34px;
	height:16px;
}

#tireforprint-40 {
	position:absolute;
	left:323px;
	top:323px;
	background-image:url(../tireprint/images/tireforprint_40.gif);
	width:115px;
	height:18px;
}

#tireforprint-41 {
	position:absolute;
	left:438px;
	top:323px;
	width:74px;
	height:18px;
}

#tireforprint-42 {
	position:absolute;
	left:640px;
	top:323px;
	background-image:url(../tireprint/images/tireforprint_42.gif);
	width:90px;
	height:18px;
}

#tireforprint-43 {
	position:absolute;
	left:730px;
	top:323px;
	width:83px;
	height:18px;
}

#tireforprint-44 {
	position:absolute;
	left:941px;
	top:323px;
	background-image:url(../tireprint/images/tireforprint_44.gif);
	width:97px;
	height:18px;
}

#tireforprint-45 {
	position:absolute;
	left:1038px;
	top:323px;
	width:34px;
	height:18px;
}

#tireforprint-46 {
	position:absolute;
	left:323px;
	top:341px;
	background-image:url(../tireprint/images/tireforprint_46.gif);
	width:115px;
	height:20px;
}

#tireforprint-47 {
	position:absolute;
	left:438px;
	top:341px;
	width:74px;
	height:20px;
}

#tireforprint-48 {
	position:absolute;
	left:640px;
	top:341px;
	background-image:url(../tireprint/images/tireforprint_48.gif);
	width:90px;
	height:20px;
}

#tireforprint-49 {
	position:absolute;
	left:730px;
	top:341px;
	width:83px;
	height:20px;
}

#tireforprint-50 {
	position:absolute;
	left:941px;
	top:341px;
	background-image:url(../tireprint/images/tireforprint_50.gif);
	width:97px;
	height:14px;
}

#tireforprint-51 {
	position:absolute;
	left:1038px;
	top:341px;
	width:34px;
	height:20px;
}

#tireforprint-52 {
	position:absolute;
	left:941px;
	top:355px;
	width:97px;
	height:6px;
}

#tireforprint-53 {
	position:absolute;
	left:323px;
	top:361px;
	width:189px;
	height:33px;
}

#tireforprint-54 {
	position:absolute;
	left:640px;
	top:361px;
	width:173px;
	height:33px;
}

#tireforprint-55 {
	position:absolute;
	left:941px;
	top:361px;
	width:131px;
	height:34px;
}

#tireforprint-56 {
	position:absolute;
	left:257px;
	top:394px;
	width:5px;
	height:154px;
}

#tireforprint-57 {
	position:absolute;
	left:262px;
	top:394px;
	width:81px;
	height:17px;
}

#tireforprint-58 {
	position:absolute;
	left:343px;
	top:394px;
	width:169px;
	height:17px;
}

#tireforprint-59 {
	position:absolute;
	left:640px;
	top:394px;
	width:164px;
	height:15px;
}

#tireforprint-60 {
	position:absolute;
	left:804px;
	top:394px;
	width:100px;
	height:17px;
}

#tireforprint-61 {
	position:absolute;
	left:904px;
	top:394px;
	width:37px;
	height:15px;
}

#tireforprint-62 {
	position:absolute;
	left:941px;
	top:395px;
	width:109px;
	height:374px;
}

#tireforprint-63 {
	position:absolute;
	left:1050px;
	top:395px;
	width:98px;
	height:16px;
}

#tireforprint-64 {
	position:absolute;
	left:1148px;
	top:395px;
	width:199px;
	height:14px;
}

#tireforprint-65 {
	position:absolute;
	left:512px;
	top:409px;
	width:4px;
	height:84px;
}

#tireforprint-66 {
	position:absolute;
	left:516px;
	top:409px;
	width:98px;
	height:19px;
}

#tireforprint-67 {
	position:absolute;
	left:614px;
	top:409px;
	width:2px;
	height:139px;
}

#tireforprint-68 {
	position:absolute;
	left:616px;
	top:409px;
	width:26px;
	height:19px;
}

#tireforprint-69 {
	position:absolute;
	left:642px;
	top:409px;
	width:162px;
	height:360px;
}

#tireforprint-70 {
	position:absolute;
	left:904px;
	top:409px;
	width:27px;
	height:19px;
}

#tireforprint-71 {
	position:absolute;
	left:931px;
	top:409px;
	width:10px;
	height:360px;
}

#tireforprint-72 {
	position:absolute;
	left:1148px;
	top:409px;
	width:26px;
	height:19px;
}

#tireforprint-73 {
	position:absolute;
	left:1174px;
	top:409px;
	width:173px;
	height:360px;
}

#tireforprint-74 {
	position:absolute;
	left:262px;
	top:411px;
	width:81px;
	height:19px;
}

#tireforprint-75 {
	position:absolute;
	left:343px;
	top:411px;
	width:70px;
	height:19px;
}

#tireforprint-76 {
	position:absolute;
	left:413px;
	top:411px;
	width:99px;
	height:358px;
}

#tireforprint-77 {
	position:absolute;
	left:804px;
	top:411px;
	width:100px;
	height:17px;
}

#tireforprint-78 {
	position:absolute;
	left:1050px;
	top:411px;
	width:98px;
	height:17px;
}

#tireforprint-79 {
	position:absolute;
	left:516px;
	top:428px;
	background-image:url(../tireprint/images/tireforprint_79.gif);
	width:98px;
	height:18px;
}

#tireforprint-80 {
	position:absolute;
	left:616px;
	top:428px;
	width:24px;
	height:18px;
}

#tireforprint-81 {
	position:absolute;
	left:640px;
	top:428px;
	width:2px;
	height:18px;
}

#tireforprint-82 {
	position:absolute;
	left:804px;
	top:428px;
	background-image:url(../tireprint/images/tireforprint_82.gif);
	width:100px;
	height:18px;
}

#tireforprint-83 {
	position:absolute;
	left:904px;
	top:428px;
	width:27px;
	height:18px;
}

#tireforprint-84 {
	position:absolute;
	left:1050px;
	top:428px;
	background-image:url(../tireprint/images/tireforprint_84.gif);
	width:98px;
	height:18px;
}

#tireforprint-85 {
	position:absolute;
	left:1148px;
	top:428px;
	width:26px;
	height:18px;
}

#tireforprint-86 {
	position:absolute;
	left:262px;
	top:430px;
	background-image:url(../tireprint/images/tireforprint_86.gif);
	width:81px;
	height:16px;
}

#tireforprint-87 {
	position:absolute;
	left:343px;
	top:430px;
	width:70px;
	height:16px;
}

#tireforprint-88 {
	position:absolute;
	left:262px;
	top:446px;
	background-image:url(../tireprint/images/tireforprint_88.gif);
	width:81px;
	height:14px;
}

#tireforprint-89 {
	position:absolute;
	left:343px;
	top:446px;
	width:70px;
	height:14px;
}

#tireforprint-90 {
	position:absolute;
	left:516px;
	top:446px;
	background-image:url(../tireprint/images/tireforprint_90.gif);
	width:98px;
	height:14px;
}

#tireforprint-91 {
	position:absolute;
	left:616px;
	top:446px;
	width:26px;
	height:14px;
}

#tireforprint-92 {
	position:absolute;
	left:804px;
	top:446px;
	background-image:url(../tireprint/images/tireforprint_92.gif);
	width:100px;
	height:14px;
}

#tireforprint-93 {
	position:absolute;
	left:904px;
	top:446px;
	width:27px;
	height:14px;
}

#tireforprint-94 {
	position:absolute;
	left:1050px;
	top:446px;
	background-image:url(../tireprint/images/tireforprint_94.gif);
	width:98px;
	height:14px;
}

#tireforprint-95 {
	position:absolute;
	left:1148px;
	top:446px;
	width:26px;
	height:14px;
}

#tireforprint-96 {
	position:absolute;
	left:262px;
	top:460px;
	background-image:url(../tireprint/images/tireforprint_96.gif);
	width:81px;
	height:18px;
}

#tireforprint-97 {
	position:absolute;
	left:343px;
	top:460px;
	width:70px;
	height:18px;
}

#tireforprint-98 {
	position:absolute;
	left:516px;
	top:460px;
	background-image:url(../tireprint/images/tireforprint_98.gif);
	width:98px;
	height:18px;
}

#tireforprint-99 {
	position:absolute;
	left:616px;
	top:460px;
	width:24px;
	height:18px;
}

#tireforprint-100 {
	position:absolute;
	left:640px;
	top:460px;
	width:2px;
	height:51px;
}

#tireforprint-101 {
	position:absolute;
	left:804px;
	top:460px;
	background-image:url(../tireprint/images/tireforprint_101.gif);
	width:100px;
	height:18px;
}

#tireforprint-102 {
	position:absolute;
	left:904px;
	top:460px;
	width:27px;
	height:18px;
}

#tireforprint-103 {
	position:absolute;
	left:1050px;
	top:460px;
	background-image:url(../tireprint/images/tireforprint_103.gif);
	width:98px;
	height:18px;
}

#tireforprint-104 {
	position:absolute;
	left:1148px;
	top:460px;
	width:26px;
	height:18px;
}

#tireforprint-105 {
	position:absolute;
	left:262px;
	top:478px;
	background-image:url(../tireprint/images/tireforprint_105.gif);
	width:81px;
	height:15px;
}

#tireforprint-106 {
	position:absolute;
	left:343px;
	top:478px;
	width:70px;
	height:15px;
}

#tireforprint-107 {
	position:absolute;
	left:516px;
	top:478px;
	background-image:url(../tireprint/images/tireforprint_107.gif);
	width:98px;
	height:15px;
}

#tireforprint-108 {
	position:absolute;
	left:616px;
	top:478px;
	width:24px;
	height:15px;
}

#tireforprint-109 {
	position:absolute;
	left:804px;
	top:478px;
	width:100px;
	height:2px;
}

#tireforprint-110 {
	position:absolute;
	left:904px;
	top:478px;
	width:27px;
	height:17px;
}

#tireforprint-111 {
	position:absolute;
	left:1050px;
	top:478px;
	background-image:url(../tireprint/images/tireforprint_111.gif);
	width:98px;
	height:15px;
}

#tireforprint-112 {
	position:absolute;
	left:1148px;
	top:478px;
	width:26px;
	height:2px;
}

#tireforprint-113 {
	position:absolute;
	left:804px;
	top:480px;
	background-image:url(../tireprint/images/tireforprint_113.gif);
	width:100px;
	height:15px;
}

#tireforprint-114 {
	position:absolute;
	left:1148px;
	top:480px;
	width:26px;
	height:15px;
}

#tireforprint-115 {
	position:absolute;
	left:262px;
	top:493px;
	background-image:url(../tireprint/images/tireforprint_115.gif);
	width:81px;
	height:18px;
}

#tireforprint-116 {
	position:absolute;
	left:343px;
	top:493px;
	width:70px;
	height:18px;
}

#tireforprint-117 {
	position:absolute;
	left:512px;
	top:493px;
	background-image:url(../tireprint/images/tireforprint_117.gif);
	width:102px;
	height:18px;
}

#tireforprint-118 {
	position:absolute;
	left:616px;
	top:493px;
	width:24px;
	height:18px;
}

#tireforprint-119 {
	position:absolute;
	left:1050px;
	top:493px;
	background-image:url(../tireprint/images/tireforprint_119.gif);
	width:98px;
	height:19px;
}

#tireforprint-120 {
	position:absolute;
	left:804px;
	top:495px;
	background-image:url(../tireprint/images/tireforprint_120.gif);
	width:100px;
	height:16px;
}

#tireforprint-121 {
	position:absolute;
	left:904px;
	top:495px;
	width:27px;
	height:16px;
}

#tireforprint-122 {
	position:absolute;
	left:1148px;
	top:495px;
	width:26px;
	height:16px;
}

#tireforprint-123 {
	position:absolute;
	left:262px;
	top:511px;
	width:151px;
	height:37px;
}

#tireforprint-124 {
	position:absolute;
	left:512px;
	top:511px;
	width:102px;
	height:37px;
}

#tireforprint-125 {
	position:absolute;
	left:616px;
	top:511px;
	width:26px;
	height:53px;
}

#tireforprint-126 {
	position:absolute;
	left:804px;
	top:511px;
	width:127px;
	height:37px;
}

#tireforprint-127 {
	position:absolute;
	left:1148px;
	top:511px;
	width:26px;
	height:53px;
}

#tireforprint-128 {
	position:absolute;
	left:1050px;
	top:512px;
	width:98px;
	height:36px;
}

#tireforprint-129 {
	position:absolute;
	left:0px;
	top:548px;
	width:244px;
	height:221px;
}

#tireforprint-130 {
	position:absolute;
	left:244px;
	top:548px;
	width:99px;
	height:16px;
}

#tireforprint-131 {
	position:absolute;
	left:343px;
	top:548px;
	width:70px;
	height:16px;
}

#tireforprint-132 {
	position:absolute;
	left:512px;
	top:548px;
	width:1px;
	height:33px;
}

#tireforprint-133 {
	position:absolute;
	left:513px;
	top:548px;
	width:102px;
	height:16px;
}

#tireforprint-134 {
	position:absolute;
	left:615px;
	top:548px;
	width:1px;
	height:16px;
}

#tireforprint-135 {
	position:absolute;
	left:804px;
	top:548px;
	width:100px;
	height:16px;
}

#tireforprint-136 {
	position:absolute;
	left:904px;
	top:548px;
	width:27px;
	height:16px;
}

#tireforprint-137 {
	position:absolute;
	left:1050px;
	top:548px;
	width:98px;
	height:16px;
}

#tireforprint-138 {
	position:absolute;
	left:244px;
	top:564px;
	width:99px;
	height:17px;
}

#tireforprint-139 {
	position:absolute;
	left:343px;
	top:564px;
	width:70px;
	height:17px;
}

#tireforprint-140 {
	position:absolute;
	left:513px;
	top:564px;
	width:101px;
	height:17px;
}

#tireforprint-141 {
	position:absolute;
	left:614px;
	top:564px;
	width:2px;
	height:34px;
}

#tireforprint-142 {
	position:absolute;
	left:616px;
	top:564px;
	width:24px;
	height:17px;
}

#tireforprint-143 {
	position:absolute;
	left:640px;
	top:564px;
	width:2px;
	height:205px;
}

#tireforprint-144 {
	position:absolute;
	left:804px;
	top:564px;
	width:100px;
	height:17px;
}

#tireforprint-145 {
	position:absolute;
	left:904px;
	top:564px;
	width:27px;
	height:17px;
}

#tireforprint-146 {
	position:absolute;
	left:1050px;
	top:564px;
	width:98px;
	height:17px;
}

#tireforprint-147 {
	position:absolute;
	left:1148px;
	top:564px;
	width:26px;
	height:18px;
}

#tireforprint-148 {
	position:absolute;
	left:244px;
	top:581px;
	background-image:url(../tireprint/images/tireforprint_148.gif);
	width:99px;
	height:17px;
}

#tireforprint-149 {
	position:absolute;
	left:343px;
	top:581px;
	width:70px;
	height:17px;
}

#tireforprint-150 {
	position:absolute;
	left:512px;
	top:581px;
	background-image:url(../tireprint/images/tireforprint_150.gif);
	width:102px;
	height:17px;
}

#tireforprint-151 {
	position:absolute;
	left:616px;
	top:581px;
	width:24px;
	height:17px;
}

#tireforprint-152 {
	position:absolute;
	left:804px;
	top:581px;
	background-image:url(../tireprint/images/tireforprint_152.gif);
	width:100px;
	height:17px;
}

#tireforprint-153 {
	position:absolute;
	left:904px;
	top:581px;
	width:27px;
	height:17px;
}

#tireforprint-154 {
	position:absolute;
	left:1050px;
	top:581px;
	width:98px;
	height:1px;
}

#tireforprint-155 {
	position:absolute;
	left:1050px;
	top:582px;
	background-image:url(../tireprint/images/tireforprint_155.gif);
	width:98px;
	height:17px;
}

#tireforprint-156 {
	position:absolute;
	left:1148px;
	top:582px;
	width:26px;
	height:17px;
}

#tireforprint-157 {
	position:absolute;
	left:244px;
	top:598px;
	background-image:url(../tireprint/images/tireforprint_157.gif);
	width:99px;
	height:22px;
}

#tireforprint-158 {
	position:absolute;
	left:343px;
	top:598px;
	width:70px;
	height:22px;
}

#tireforprint-159 {
	position:absolute;
	left:512px;
	top:598px;
	width:1px;
	height:39px;
}

#tireforprint-160 {
	position:absolute;
	left:513px;
	top:598px;
	background-image:url(../tireprint/images/tireforprint_160.gif);
	width:101px;
	height:22px;
}

#tireforprint-161 {
	position:absolute;
	left:614px;
	top:598px;
	width:26px;
	height:22px;
}

#tireforprint-162 {
	position:absolute;
	left:804px;
	top:598px;
	background-image:url(../tireprint/images/tireforprint_162.gif);
	width:100px;
	height:22px;
}

#tireforprint-163 {
	position:absolute;
	left:904px;
	top:598px;
	width:27px;
	height:22px;
}

#tireforprint-164 {
	position: absolute;
	left: 1050px;
	top: 599px;
	background-image: url(../tireprint/images/tireforprint_164.gif);
	width: 98px;
	height: 20px;
}

#tireforprint-165 {
	position:absolute;
	left:1148px;
	top:599px;
	width:26px;
	height:21px;
}

#tireforprint-166 {
	position:absolute;
	left:244px;
	top:620px;
	background-image:url(../tireprint/images/tireforprint_166.gif);
	width:99px;
	height:17px;
}

#tireforprint-167 {
	position:absolute;
	left:343px;
	top:620px;
	width:70px;
	height:17px;
}

#tireforprint-168 {
	position:absolute;
	left:513px;
	top:620px;
	background-image:url(../tireprint/images/tireforprint_168.gif);
	width:101px;
	height:17px;
}

#tireforprint-169 {
	position:absolute;
	left:614px;
	top:620px;
	width:1px;
	height:50px;
}

#tireforprint-170 {
	position:absolute;
	left:615px;
	top:620px;
	width:25px;
	height:17px;
}

#tireforprint-171 {
	position:absolute;
	left:804px;
	top:620px;
	background-image:url(../tireprint/images/tireforprint_171.gif);
	width:100px;
	height:17px;
}

#tireforprint-172 {
	position:absolute;
	left:904px;
	top:620px;
	width:27px;
	height:17px;
}

#tireforprint-173 {
	position:absolute;
	left:1050px;
	top:620px;
	background-image:url(../tireprint/images/tireforprint_173.gif);
	width:98px;
	height:17px;
}

#tireforprint-174 {
	position:absolute;
	left:1148px;
	top:620px;
	width:26px;
	height:17px;
}

#tireforprint-175 {
	position:absolute;
	left:244px;
	top:637px;
	background-image:url(../tireprint/images/tireforprint_175.gif);
	width:99px;
	height:18px;
}

#tireforprint-176 {
	position:absolute;
	left:343px;
	top:637px;
	width:70px;
	height:18px;
}

#tireforprint-177 {
	position:absolute;
	left:512px;
	top:637px;
	background-image:url(../tireprint/images/tireforprint_177.gif);
	width:102px;
	height:18px;
}

#tireforprint-178 {
	position:absolute;
	left:615px;
	top:637px;
	width:25px;
	height:18px;
}

#tireforprint-179 {
	position:absolute;
	left:804px;
	top:637px;
	background-image:url(../tireprint/images/tireforprint_179.gif);
	width:100px;
	height:18px;
}

#tireforprint-180 {
	position:absolute;
	left:904px;
	top:637px;
	width:27px;
	height:18px;
}

#tireforprint-181 {
	position:absolute;
	left:1050px;
	top:637px;
	background-image:url(../tireprint/images/tireforprint_181.gif);
	width:98px;
	height:18px;
}

#tireforprint-182 {
	position:absolute;
	left:1148px;
	top:637px;
	width:26px;
	height:18px;
}

#tireforprint-183 {
	position:absolute;
	left:244px;
	top:655px;
	background-image:url(../tireprint/images/tireforprint_183.gif);
	width:99px;
	height:15px;
}

#tireforprint-184 {
	position:absolute;
	left:343px;
	top:655px;
	width:70px;
	height:15px;
}

#tireforprint-185 {
	position:absolute;
	left:512px;
	top:655px;
	background-image:url(../tireprint/images/tireforprint_185.gif);
	width:102px;
	height:15px;
}

#tireforprint-186 {
	position:absolute;
	left:615px;
	top:655px;
	width:25px;
	height:15px;
}

#tireforprint-187 {
	position:absolute;
	left:804px;
	top:655px;
	background-image:url(../tireprint/images/tireforprint_187.gif);
	width:100px;
	height:15px;
}

#tireforprint-188 {
	position:absolute;
	left:904px;
	top:655px;
	width:27px;
	height:15px;
}

#tireforprint-189 {
	position:absolute;
	left:1050px;
	top:655px;
	background-image:url(../tireprint/images/tireforprint_189.gif);
	width:98px;
	height:15px;
}

#tireforprint-190 {
	position:absolute;
	left:1148px;
	top:655px;
	width:26px;
	height:15px;
}

#tireforprint-191 {
	position:absolute;
	left:244px;
	top:670px;
	width:169px;
	height:99px;
}

#tireforprint-192 {
	position:absolute;
	left:512px;
	top:670px;
	width:128px;
	height:99px;
}

#tireforprint-193 {
	position:absolute;
	left:804px;
	top:670px;
	width:127px;
	height:99px;
}

#tireforprint-194 {
	position:absolute;
	left:1050px;
	top:670px;
	width:124px;
	height:99px;
}


</style>
<!-- End Save for Web Styles -->
</head>
<body style="background-color:#FFFFFF; margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;"  onLoad="prints()">
<!-- Save for Web Slices (Untitled-4) -->
<div id="Table_01">
	<div id="tireforprint-01">
	  <img src="../tireprint/images/tireforprint_01.gif" width="1347" height="146" alt="">
	</div>
	<div id="tireforprint-02">
	  <img src="../tireprint/images/tireforprint_02.gif" width="257" height="402" alt="">
	</div>

  <div id="tireforprint-03" align="center">
	<?php $plate = mysql_query("Select * from tbl_truck_report Where id='".$_GET['id']."'") or die(mysql_error());
	$plate_row = mysql_fetch_array($plate);
	echo $plate_row['truckplate'];
	?>
  </div>
	<div id="tireforprint-04">
	  <img src="../tireprint/images/tireforprint_04.gif" width="1020" height="91" alt="">
	</div>
	<div id="tireforprint-05">
	  <img src="../tireprint/images/tireforprint_05.gif" width="70" height="75" alt="">
	</div>
	<div id="tireforprint-06">
	  <img src="../tireprint/images/tireforprint_06.gif" width="66" height="157" alt="">
	</div>
	<div id="tireforprint-07">
	  <img src="../tireprint/images/tireforprint_07.gif" width="115" height="17" alt="">
	</div>
	<div id="tireforprint-08">
	  <img src="../tireprint/images/tireforprint_08.gif" width="202" height="17" alt="">
	</div>
	<div id="tireforprint-09">
	  <img src="../tireprint/images/tireforprint_09.gif" width="90" height="17" alt="">
	</div>
	<div id="tireforprint-10">
	  <img src="../tireprint/images/tireforprint_10.gif" width="211" height="17" alt="">
	</div>
	<div id="tireforprint-11">
	  <img src="../tireprint/images/tireforprint_11.gif" width="97" height="17" alt="">
	</div>
	<div id="tireforprint-12">
	  <img src="../tireprint/images/tireforprint_12.gif" width="309" height="17" alt="">
	</div>
	<div id="tireforprint-13">
	  <img src="../tireprint/images/tireforprint_13.gif" width="115" height="16" alt="">
	</div>
	<div id="tireforprint-14">
	  <img src="../tireprint/images/tireforprint_14.gif" width="74" height="16" alt="">
	</div>
	<div id="tireforprint-15">
	  <img src="../tireprint/images/tireforprint_15.gif" width="128" height="155" alt="">
	</div>
	<div id="tireforprint-16">
	  <img src="../tireprint/images/tireforprint_16.gif" width="90" height="16" alt="">
	</div>
	<div id="tireforprint-17">
	  <img src="../tireprint/images/tireforprint_17.gif" width="83" height="16" alt="">
	</div>
	<div id="tireforprint-18">
	  <img src="../tireprint/images/tireforprint_18.gif" width="128" height="140" alt="">
	</div>
	<div id="tireforprint-19">
	  <img src="../tireprint/images/tireforprint_19.gif" width="97" height="16" alt="">
	</div>
	<div id="tireforprint-20">
	  <img src="../tireprint/images/tireforprint_20.gif" width="34" height="16" alt="">
	</div>
	<div id="tireforprint-21">
	  <img src="../tireprint/images/tireforprint_21.gif" width="275" height="141" alt="">
	</div>
	<div id="tireforprint-22">
	<?php $tbltire_select1 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='1'") or die(mysql_error());
		$tbltire_row1 = mysql_fetch_array($tbltire_select1);
		
		$tblswaptire_select1 = mysql_query("Select * from tbl_changeswaps Where tireid='1' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row1 = mysql_fetch_array($tblswaptire_select1);
		
		$tblswap_select1 = mysql_query("Select * from tbl_changeswaps Where swapto='1' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row1 = mysql_fetch_array($tblswap_select1);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select1) == 0 && mysql_num_rows($tblswaptire_select1) == 0 && mysql_num_rows($tblswap_select1) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select1) > 0){
			echo $tblswap_row1['tireid'];
			}else if(mysql_num_rows($tblswaptire_select1) > 0){
		 echo $tblswaptire_row1['swapto'];
		 
		}else if(mysql_num_rows($tbltire_select1) > 0){
			echo $tbltire_row1['tireid'];
			}	
		?></font>
	</div>
	<div id="tireforprint-23">
	  <img src="../tireprint/images/tireforprint_23.gif" width="74" height="20" alt="">
	</div>
	<div id="tireforprint-24">
    <?php $tbltire_select11 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='11' Order by id Desc LIMIT 1") or die(mysql_error());
		$tbltire_row11 = mysql_fetch_array($tbltire_select11);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select11) == 0 ){
			echo '';
			}
		else {
			echo $tbltire_row11['tireid'];}
		
		?></font>
	 
	</div>
	<div id="tireforprint-25">
	  <img src="../tireprint/images/tireforprint_25.gif" width="83" height="20" alt="">
	</div>
	<div id="tireforprint-26">
	  	<?php $tbltire_select2 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='2'") or die(mysql_error());
		$tbltire_row2 = mysql_fetch_array($tbltire_select2);
		
		$tblswaptire_select2 = mysql_query("Select * from tbl_changeswaps Where tireid='2' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row2 = mysql_fetch_array($tblswaptire_select2);
		
		$tblswap_select2 = mysql_query("Select * from tbl_changeswaps Where swapto='2' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row2 = mysql_fetch_array($tblswap_select2);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select2) == 0 && mysql_num_rows($tblswaptire_select2) == 0 && mysql_num_rows($tblswap_select2) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select2) > 0){
			echo $tblswap_row2['tireid'];
			}else if(mysql_num_rows($tblswaptire_select2) > 0){
		 echo $tblswaptire_row2['swapto'];
		 
		}else if(mysql_num_rows($tbltire_select2) > 0){
			echo $tbltire_row2['tireid'];
			}	
		?></font>
	</div>
	<div id="tireforprint-27">
	  <img src="../tireprint/images/tireforprint_27.gif" width="34" height="20" alt="">
	</div>
	<div id="tireforprint-28">
	  <font size="-1">
	   <?php $tbltire_select1 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='1'") or die(mysql_error());
		$tbltire_row1 = mysql_fetch_array($tbltire_select1);
		
		$tblswaptire_select1 = mysql_query("Select * from tbl_changeswaps Where tireid='1' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row1 = mysql_fetch_array($tblswaptire_select1);
		
		$tblswap_select1 = mysql_query("Select * from tbl_changeswaps Where swapto='1' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row1 = mysql_fetch_array($tblswap_select1);
	
		?>
        <?php
		if(mysql_num_rows($tbltire_select1) == 0 && mysql_num_rows($tblswaptire_select1) == 0 && mysql_num_rows($tblswap_select1) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select1) > 0){
			echo $tblswap_row1['dateadded'];
			}else if(mysql_num_rows($tblswaptire_select1) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row1['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['dateadded'];
		}else if(mysql_num_rows($tbltire_select1) > 0){
				 echo $tbltire_row1['dateadded'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-29">
	  <img src="../tireprint/images/tireforprint_29.gif" width="74" height="17" alt="">
	</div>
	<div id="tireforprint-30">
    <font size="-1"><?php
		if(mysql_num_rows($tbltire_select11) == 0 ){
			echo '';
			}
		else {
			echo $tbltire_row11['dateadded'];}
		
		?></font>
	 
	</div>
	<div id="tireforprint-31">
	  <img src="../tireprint/images/tireforprint_31.gif" width="83" height="17" alt="">
	</div>
	<div id="tireforprint-32">
<font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select2) == 0 && mysql_num_rows($tblswaptire_select2) == 0 && mysql_num_rows($tblswap_select2) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select2) > 0){
			echo $tblswap_row2['dateadded'];
			}else if(mysql_num_rows($tblswaptire_select2) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row2['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row2['dateadded'];
		}else if(mysql_num_rows($tbltire_select1) > 0){
				 echo $tbltire_row2['dateadded'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-33">
	  <img src="../tireprint/images/tireforprint_33.gif" width="34" height="17" alt="">
	</div>
	<div id="tireforprint-34">
    	  <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select1) == 0 && mysql_num_rows($tblswaptire_select1) == 0 && mysql_num_rows($tblswap_select1) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select1) > 0){
			echo $tblswap_row1['tirename'];
			}else if(mysql_num_rows($tblswaptire_select1) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row1['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tirename'];
		}else if(mysql_num_rows($tbltire_select1) > 0){
				 echo $tbltire_row1['tirename'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-35">
	  <img src="../tireprint/images/tireforprint_35.gif" width="74" height="16" alt="">
	</div>
	<div id="tireforprint-36">
        <font size="-1"><?php
		if(mysql_num_rows($tbltire_select11) == 0 ){
			echo '';
			}
		else {
			echo $tbltire_row11['tirename'];}
		
		?></font>
	
	</div>
	<div id="tireforprint-37">
	  <img src="../tireprint/images/tireforprint_37.gif" width="83" height="16" alt="">

	</div>
	<div id="tireforprint-38">
	   <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select2) == 0 && mysql_num_rows($tblswaptire_select2) == 0 && mysql_num_rows($tblswap_select2) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select2) > 0){
			echo $tblswap_row2['tirename'];
			}else if(mysql_num_rows($tblswaptire_select2) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row2['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row2['tirename'];
		}else if(mysql_num_rows($tbltire_select2) > 0){
				 echo $tbltire_row2['tirename'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-39">
	  <img src="../tireprint/images/tireforprint_39.gif" width="34" height="16" alt="">
	</div>
	<div id="tireforprint-40">
	   <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select1) == 0 && mysql_num_rows($tblswaptire_select1) == 0 && mysql_num_rows($tblswap_select1) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select1) > 0){
			echo $tblswap_row1['tiresize'].' '.$tblswap_row1['description'];
			}else if(mysql_num_rows($tblswaptire_select1) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row1['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tiresize'].' '.$tire_row1['description'];
		}else if(mysql_num_rows($tbltire_select1) > 0){
				 echo $tbltire_row1['tiresize'].' '.$tbltire_row1['description'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-41">
	  <img src="../tireprint/images/tireforprint_41.gif" width="74" height="18" alt="">
	</div>
	<div id="tireforprint-42">
     <font size="-1"><?php
		if(mysql_num_rows($tbltire_select11) == 0 ){
			echo '';
			}
		else {
			echo $tbltire_row11['tiresize'].' '.$tbltire_row11['description'];}
		
		?></font>
	  
	</div>
	<div id="tireforprint-43">
	  <img src="../tireprint/images/tireforprint_43.gif" width="83" height="18" alt="">
	</div>
	<div id="tireforprint-44">
 <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select2) == 0 && mysql_num_rows($tblswaptire_select2) == 0 && mysql_num_rows($tblswap_select2) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select2) > 0){
			echo $tblswap_row2['tiresize'].' '.$tblswap_row2['description'];
			}else if(mysql_num_rows($tblswaptire_select2) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row2['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tiresize'].' '.$tire_row1['description'];
		}else if(mysql_num_rows($tbltire_select2) > 0){
				 echo $tbltire_row2['tiresize'].' '.$tbltire_row2['description'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-45">
	  <img src="../tireprint/images/tireforprint_45.gif" width="34" height="18" alt="">
	</div>
	<div id="tireforprint-46">
	  <font size="-1">
	   <?php
		if(mysql_num_rows($tbltire_select1) == 0 && mysql_num_rows($tblswaptire_select1) == 0 && mysql_num_rows($tblswap_select1) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select1) > 0){
			$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswap_row1['tireid']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
			echo $tire_row1['status'].'('.$tblswap_row1['remarks'].')';
			}else if(mysql_num_rows($tblswaptire_select1) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row1['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['status'].'('.$tblswaptire_row1['remarks'].'to'.$tblswaptire_row1['tireid'].')';
		}else if(mysql_num_rows($tbltire_select1) > 0){
				 echo $tbltire_row1['status'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-47">
	  <img src="../tireprint/images/tireforprint_47.gif" width="74" height="20" alt="">
	</div>
	<div id="tireforprint-48">
     <font size="-1"><?php
		if(mysql_num_rows($tbltire_select11) == 0 ){
			echo '';
			}
		else {
			echo $tbltire_row11['status'];}
		
		?></font>
	  
	</div>
	<div id="tireforprint-49">
	  <img src="../tireprint/images/tireforprint_49.gif" width="83" height="20" alt="">
	</div>
	<div id="tireforprint-50">
	  <font size="-1">
	   <?php
		if(mysql_num_rows($tbltire_select2) == 0 && mysql_num_rows($tblswaptire_select2) == 0 && mysql_num_rows($tblswap_select2) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select2) > 0){
$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswap_row2['tireid']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
			echo $tire_row1['status'].'('.$tblswap_row2['remarks'].')';
			}else if(mysql_num_rows($tblswaptire_select2) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row2['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['status'].'('.$tblswaptire_row2['remarks'].'to'.$tblswaptire_row2['tireid'].')';
		}else if(mysql_num_rows($tbltire_select2) > 0){
				 echo $tbltire_row2['status'];
			}	?>
	</font>
	</div>
	<div id="tireforprint-51">
	  <img src="../tireprint/images/tireforprint_51.gif" width="34" height="20" alt="">
	</div>
	<div id="tireforprint-52">
	  <img src="../tireprint/images/tireforprint_52.gif" width="97" height="6" alt="">
	</div>
	<div id="tireforprint-53">
	  <img src="../tireprint/images/tireforprint_53.gif" width="189" height="33" alt="">
	</div>
	<div id="tireforprint-54">
	  <img src="../tireprint/images/tireforprint_54.gif" width="173" height="33" alt="">
	</div>
	<div id="tireforprint-55">
	  <img src="../tireprint/images/tireforprint_55.gif" width="131" height="34" alt="">
	</div>
	<div id="tireforprint-56">
	  <img src="../tireprint/images/tireforprint_56.gif" width="5" height="154" alt="">
	</div>
	<div id="tireforprint-57">
	  <img src="../tireprint/images/tireforprint_57.gif" width="81" height="17" alt="">
	</div>
	<div id="tireforprint-58">
	  <img src="../tireprint/images/tireforprint_58.gif" width="169" height="17" alt="">
	</div>
	<div id="tireforprint-59">
	  <img src="../tireprint/images/tireforprint_59.gif" width="164" height="15" alt="">
	</div>
	<div id="tireforprint-60">
	  <img src="../tireprint/images/tireforprint_60.gif" width="100" height="17" alt="">
	</div>
	<div id="tireforprint-61">
	  <img src="../tireprint/images/tireforprint_61.gif" width="37" height="15" alt="">
	</div>
	<div id="tireforprint-62">
	  <img src="../tireprint/images/tireforprint_62.gif" width="109" height="374" alt="">
	</div>
	<div id="tireforprint-63">
	  <img src="../tireprint/images/tireforprint_63.gif" width="98" height="16" alt="">
	</div>
	<div id="tireforprint-64">
	  <img src="../tireprint/images/tireforprint_64.gif" width="199" height="14" alt="">
	</div>
	<div id="tireforprint-65">
	  <img src="../tireprint/images/tireforprint_65.gif" width="4" height="84" alt="">
	</div>
	<div id="tireforprint-66">
	  <img src="../tireprint/images/tireforprint_66.gif" width="98" height="19" alt="">
	</div>
	<div id="tireforprint-67">
	  <img src="../tireprint/images/tireforprint_67.gif" width="2" height="139" alt="">
	</div>
	<div id="tireforprint-68">
	  <img src="../tireprint/images/tireforprint_68.gif" width="26" height="19" alt="">
	</div>
	<div id="tireforprint-69">
	  <img src="../tireprint/images/tireforprint_69.gif" width="162" height="360" alt="">
	</div>
	<div id="tireforprint-70">
	  <img src="../tireprint/images/tireforprint_70.gif" width="27" height="19" alt="">
	</div>
	<div id="tireforprint-71">
	  <img src="../tireprint/images/tireforprint_71.gif" width="10" height="360" alt="">
	</div>
	<div id="tireforprint-72">
	  <img src="../tireprint/images/tireforprint_72.gif" width="26" height="19" alt="">
	</div>
	<div id="tireforprint-73">
	  <img src="../tireprint/images/tireforprint_73.gif" width="173" height="360" alt="">
	</div>
	<div id="tireforprint-74">
	  <img src="../tireprint/images/tireforprint_74.gif" width="81" height="19" alt="">
	</div>
	<div id="tireforprint-75">
	  <img src="../tireprint/images/tireforprint_75.gif" width="70" height="19" alt="">
	</div>
	<div id="tireforprint-76">
	  <img src="../tireprint/images/tireforprint_76.gif" width="99" height="358" alt="">
	</div>
	<div id="tireforprint-77">
	  <img src="../tireprint/images/tireforprint_77.gif" width="100" height="17" alt="">
	</div>
	<div id="tireforprint-78">
	  <img src="../tireprint/images/tireforprint_78.gif" width="98" height="17" alt="">
	</div>
	<div id="tireforprint-79">
     <?php $tbltire_select4 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='4'") or die(mysql_error());
		$tbltire_row4 = mysql_fetch_array($tbltire_select4);
		
		$tblswaptire_select4 = mysql_query("Select * from tbl_changeswaps Where tireid='4' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row4 = mysql_fetch_array($tblswaptire_select4);
		
		$tblswap_select4= mysql_query("Select * from tbl_changeswaps Where swapto='4' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row4 = mysql_fetch_array($tblswap_select4);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select4) == 0 && mysql_num_rows($tblswaptire_select4) == 0 && mysql_num_rows($tblswap_select4) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select4) > 0){
			echo $tblswap_row4['tireid'];
			}else if(mysql_num_rows($tblswaptire_select4) > 0){
		 echo $tblswaptire_row4['swapto'];
		 
		}else if(mysql_num_rows($tbltire_select4) > 0){
			echo $tbltire_row4['tireid'];
			}	
		?></font>

	</div>
	<div id="tireforprint-80">
	  <img src="../tireprint/images/tireforprint_80.gif" width="24" height="18" alt="">
	</div>
	<div id="tireforprint-81">
	  <img src="../tireprint/images/tireforprint_81.gif" width="2" height="18" alt="">
	</div>
	<div id="tireforprint-82">
     <?php $tbltire_select5 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='5'") or die(mysql_error());
		$tbltire_row5 = mysql_fetch_array($tbltire_select5);
		
		$tblswaptire_select5 = mysql_query("Select * from tbl_changeswaps Where tireid='5' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row5 = mysql_fetch_array($tblswaptire_select5);
		
		$tblswap_select5= mysql_query("Select * from tbl_changeswaps Where swapto='5' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row5 = mysql_fetch_array($tblswap_select5);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select5) == 0 && mysql_num_rows($tblswaptire_select5) == 0 && mysql_num_rows($tblswap_select5) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select5) > 0){
			echo $tblswap_row5['tireid'];
			}else if(mysql_num_rows($tblswaptire_select5) > 0){
		 echo $tblswaptire_row5['swapto'];
		 
		}else if(mysql_num_rows($tbltire_select5) > 0){
			echo $tbltire_row5['tireid'];
			}	
		?></font>


	</div>
	<div id="tireforprint-83">
	  <img src="../tireprint/images/tireforprint_83.gif" width="27" height="18" alt="">
	</div>
	<div id="tireforprint-84">

     <?php $tbltire_select6 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='6'") or die(mysql_error());
		$tbltire_row6 = mysql_fetch_array($tbltire_select6);
		
		$tblswaptire_select6 = mysql_query("Select * from tbl_changeswaps Where tireid='6' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row6 = mysql_fetch_array($tblswaptire_select6);
		
		$tblswap_select6= mysql_query("Select * from tbl_changeswaps Where swapto='6' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row6 = mysql_fetch_array($tblswap_select6);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select6) == 0 && mysql_num_rows($tblswaptire_select6) == 0 && mysql_num_rows($tblswap_select6) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select6) > 0){
			echo $tblswap_row6['tireid'];
			}else if(mysql_num_rows($tblswaptire_select6) > 0){
		 echo $tblswaptire_row6['swapto'];
		 
		}else if(mysql_num_rows($tbltire_select6) > 0){
			echo $tbltire_row6['tireid'];
			}	
		?></font>
	  
	</div>
	<div id="tireforprint-85">
	  <img src="../tireprint/images/tireforprint_85.gif" width="26" height="18" alt="">
	</div>
	<div id="tireforprint-86">
	  <?php $tbltire_select3 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='3'") or die(mysql_error());
		$tbltire_row3 = mysql_fetch_array($tbltire_select3);
		
		$tblswaptire_select3 = mysql_query("Select * from tbl_changeswaps Where tireid='3' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row3 = mysql_fetch_array($tblswaptire_select3);
		
		$tblswap_select3= mysql_query("Select * from tbl_changeswaps Where swapto='3' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row3 = mysql_fetch_array($tblswap_select3);
	
		?><font size="-1"><?php
		if(mysql_num_rows($tbltire_select3) == 0 && mysql_num_rows($tblswaptire_select3) == 0 && mysql_num_rows($tblswap_select3) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select3) > 0){
			echo $tblswap_row3['tireid'];
			}else if(mysql_num_rows($tblswaptire_select3) > 0){
		 echo $tblswaptire_row3['swapto'];
		 
		}else if(mysql_num_rows($tbltire_select3) > 0){
			echo $tbltire_row3['tireid'];
			}	
		?></font>
	</div>
	<div id="tireforprint-87">
	  <img src="../tireprint/images/tireforprint_87.gif" width="70" height="16" alt="">
	</div>
	<div id="tireforprint-88"> 
    <font size="-1">
       <?php $tbltire_select3 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='3'") or die(mysql_error());
		$tbltire_row3 = mysql_fetch_array($tbltire_select3);
		
		$tblswaptire_select3 = mysql_query("Select * from tbl_changeswaps Where tireid='3' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row3 = mysql_fetch_array($tblswaptire_select3);
		
		$tblswap_select3 = mysql_query("Select * from tbl_changeswaps Where swapto='3' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row3 = mysql_fetch_array($tblswap_select3);
	
		?>
        <?php
		if(mysql_num_rows($tbltire_select3) == 0 && mysql_num_rows($tblswaptire_select3) == 0 && mysql_num_rows($tblswap_select3) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select3) > 0){
			echo $tblswap_row3['dateadded'];
			}else if(mysql_num_rows($tblswaptire_select3) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row3['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['dateadded'];
		}else if(mysql_num_rows($tbltire_select3) > 0){
				 echo $tbltire_row3['dateadded'];
			}	?>
	</font>
	 
	</div>
	<div id="tireforprint-89">
	  <img src="../tireprint/images/tireforprint_89.gif" width="70" height="14" alt="">
	</div>
	<div id="tireforprint-90">
    <font size="-1">
     <?php $tbltire_select4 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='4'") or die(mysql_error());
		$tbltire_row4 = mysql_fetch_array($tbltire_select4);
		
		$tblswaptire_select4 = mysql_query("Select * from tbl_changeswaps Where tireid='4' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row4 = mysql_fetch_array($tblswaptire_select4);
		
		$tblswap_select4 = mysql_query("Select * from tbl_changeswaps Where swapto='4' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row4 = mysql_fetch_array($tblswap_select4);
	
		?>
        <?php
		if(mysql_num_rows($tbltire_select4) == 0 && mysql_num_rows($tblswaptire_select4) == 0 && mysql_num_rows($tblswap_select4) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select4) > 0){
			echo $tblswap_row4['dateadded'];
			}else if(mysql_num_rows($tblswaptire_select4) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row4['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['dateadded'];
		}else if(mysql_num_rows($tbltire_select4) > 0){
				 echo $tbltire_row4['dateadded'];
			}	?>
	</font>
	  
	</div>
	<div id="tireforprint-91">
	  <img src="../tireprint/images/tireforprint_91.gif" width="26" height="14" alt="">
	</div>
	<div id="tireforprint-92">
    <font size="-1">
     <?php $tbltire_select5 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='5'") or die(mysql_error());
		$tbltire_row5 = mysql_fetch_array($tbltire_select5);
		
		$tblswaptire_select5 = mysql_query("Select * from tbl_changeswaps Where tireid='5' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row5 = mysql_fetch_array($tblswaptire_select5);
		
		$tblswap_select5 = mysql_query("Select * from tbl_changeswaps Where swapto='5' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row5 = mysql_fetch_array($tblswap_select5);
	
		?>
        <?php
		if(mysql_num_rows($tbltire_select5) == 0 && mysql_num_rows($tblswaptire_select5) == 0 && mysql_num_rows($tblswap_select5) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select5) > 0){
			echo $tblswap_row5['dateadded'];
			}else if(mysql_num_rows($tblswaptire_select5) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row5['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['dateadded'];
		}else if(mysql_num_rows($tbltire_select5) > 0){
				 echo $tbltire_row5['dateadded'];
			}	?>
	</font>
	  
	</div>
	<div id="tireforprint-93">
	  <img src="../tireprint/images/tireforprint_93.gif" width="27" height="14" alt="">
	</div>
	<div id="tireforprint-94">
     <font size="-1">
     <?php $tbltire_select6 = mysql_query("Select * from tbl_trucktires Where truckplate= '".$_GET['id']."' And tireid='6'") or die(mysql_error());
		$tbltire_row6 = mysql_fetch_array($tbltire_select6);
		
		$tblswaptire_select6 = mysql_query("Select * from tbl_changeswaps Where tireid='6' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
		$tblswaptire_row6 = mysql_fetch_array($tblswaptire_select6);
		
		$tblswap_select6 = mysql_query("Select * from tbl_changeswaps Where swapto='6' And truckid='".$_GET['id']."' And remarks='swap' Order by id Desc LIMIT 1") or die(mysql_error());
			$tblswap_row6 = mysql_fetch_array($tblswap_select6);
	
		?>
        <?php
		if(mysql_num_rows($tbltire_select6) == 0 && mysql_num_rows($tblswaptire_select6) == 0 && mysql_num_rows($tblswap_select6) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select6) > 0){
			echo $tblswap_row6['dateadded'];
			}else if(mysql_num_rows($tblswaptire_select6) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row6['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['dateadded'];
		}else if(mysql_num_rows($tbltire_select6) > 0){
				 echo $tbltire_row6['dateadded'];
			}	?>
	</font>
	  
	</div>
	<div id="tireforprint-95">
	  <img src="../tireprint/images/tireforprint_95.gif" width="26" height="14" alt="">
	</div>
	<div id="tireforprint-96">
     <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select3) == 0 && mysql_num_rows($tblswaptire_select3) == 0 && mysql_num_rows($tblswap_select3) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select3) > 0){
			echo $tblswap_row3['tirename'];
			}else if(mysql_num_rows($tblswaptire_select3) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row3['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tirename'];
		}else if(mysql_num_rows($tbltire_select3) > 0){
				 echo $tbltire_row3['tirename'];
			}	?>
      </font>	
	
	</div>
	<div id="tireforprint-97">
	  <img src="../tireprint/images/tireforprint_97.gif" width="70" height="18" alt="">
	</div>
	<div id="tireforprint-98">
    <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select4) == 0 && mysql_num_rows($tblswaptire_select4) == 0 && mysql_num_rows($tblswap_select4) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select4) > 0){
			echo $tblswap_row4['tirename'];
			}else if(mysql_num_rows($tblswaptire_select4) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row4['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tirename'];
		}else if(mysql_num_rows($tbltire_select4) > 0){
				 echo $tbltire_row4['tirename'];
			}	?>
      </font>	
	  
	</div>
	<div id="tireforprint-99">
	  <img src="../tireprint/images/tireforprint_99.gif" width="24" height="18" alt="">
	</div>
	<div id="tireforprint-100">
	  <img src="../tireprint/images/tireforprint_100.gif" width="2" height="51" alt="">
	</div>
	<div id="tireforprint-101">
     <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select5) == 0 && mysql_num_rows($tblswaptire_select5) == 0 && mysql_num_rows($tblswap_select5) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select5) > 0){
			echo $tblswap_row5['tirename'];
			}else if(mysql_num_rows($tblswaptire_select5) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row5['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tirename'];
		}else if(mysql_num_rows($tbltire_select5) > 0){
				 echo $tbltire_row5['tirename'];
			}	?>
      </font>	
	  
	  
	</div>
	<div id="tireforprint-102">
	  <img src="../tireprint/images/tireforprint_102.gif" width="27" height="18" alt="">
	</div>
	<div id="tireforprint-103">
    <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select6) == 0 && mysql_num_rows($tblswaptire_select6) == 0 && mysql_num_rows($tblswap_select6) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select6) > 0){
			echo $tblswap_row6['tirename'];
			}else if(mysql_num_rows($tblswaptire_select6) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row6['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tirename'];
		}else if(mysql_num_rows($tbltire_select6) > 0){
				 echo $tbltire_row6['tirename'];
			}	?>
      </font>	
	 
	</div>
	<div id="tireforprint-104">
	  <img src="../tireprint/images/tireforprint_104.gif" width="26" height="18" alt="">
	</div>
	<div id="tireforprint-105">
    <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select3) == 0 && mysql_num_rows($tblswaptire_select3) == 0 && mysql_num_rows($tblswap_select3) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select3) > 0){
			echo $tblswap_row3['tiresize'].' '.$tblswap_row3['description'];
			}else if(mysql_num_rows($tblswaptire_select3) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row3['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tiresize'].' '.$tire_row1['description'];
		}else if(mysql_num_rows($tbltire_select3) > 0){
				 echo $tbltire_row3['tiresize'].' '.$tbltire_row3['description'];
			}	?>
	</font>
	 
	</div>
	<div id="tireforprint-106">
	  <img src="../tireprint/images/tireforprint_106.gif" width="70" height="15" alt="">
	</div>
	<div id="tireforprint-107">
    <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select4) == 0 && mysql_num_rows($tblswaptire_select4) == 0 && mysql_num_rows($tblswap_select4) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select4) > 0){
			echo $tblswap_row4['tiresize'].' '.$tblswap_row4['description'];
			}else if(mysql_num_rows($tblswaptire_select4) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row4['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tiresize'].' '.$tire_row1['description'];
		}else if(mysql_num_rows($tbltire_select4) > 0){
				 echo $tbltire_row4['tiresize'].' '.$tbltire_row4['description'];
			}	?>
	</font>
	  
	</div>
	<div id="tireforprint-108">
	  <img src="../tireprint/images/tireforprint_108.gif" width="24" height="15" alt="">
	</div>
	<div id="tireforprint-109">
	  <img src="../tireprint/images/tireforprint_109.gif" width="100" height="2" alt="">
	</div>
	<div id="tireforprint-110">
	  <img src="../tireprint/images/tireforprint_110.gif" width="27" height="17" alt="">
	</div>
	<div id="tireforprint-111">
     <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select6) == 0 && mysql_num_rows($tblswaptire_select6) == 0 && mysql_num_rows($tblswap_select6) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select6) > 0){
			echo $tblswap_row6['tiresize'].' '.$tblswap_row6['description'];
			}else if(mysql_num_rows($tblswaptire_select6) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row6['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tiresize'].' '.$tire_row1['description'];
		}else if(mysql_num_rows($tbltire_select6) > 0){
				 echo $tbltire_row6['tiresize'].' '.$tbltire_row6['description'];
			}	?>
	</font>
	 
	</div>
	<div id="tireforprint-112">
	  <img src="../tireprint/images/tireforprint_112.gif" width="26" height="2" alt="">
	</div>
	<div id="tireforprint-113">
     <font size="-1">
        <?php
		if(mysql_num_rows($tbltire_select5) == 0 && mysql_num_rows($tblswaptire_select5) == 0 && mysql_num_rows($tblswap_select5) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select5) > 0){
			echo $tblswap_row5['tiresize'].' '.$tblswap_row5['description'];
			}else if(mysql_num_rows($tblswaptire_select5) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row5['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['tiresize'].' '.$tire_row1['description'];
		}else if(mysql_num_rows($tbltire_select5) > 0){
				 echo $tbltire_row5['tiresize'].' '.$tbltire_row5['description'];
			}	?>
	</font>
	 
	</div>
	<div id="tireforprint-114">
	  <img src="../tireprint/images/tireforprint_114.gif" width="26" height="15" alt="">
	</div>
	<div id="tireforprint-115">
    <font size="-1">
	   <?php
		if(mysql_num_rows($tbltire_select3) == 0 && mysql_num_rows($tblswaptire_select3) == 0 && mysql_num_rows($tblswap_select3) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select3) > 0){
			$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswap_row3['tireid']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
			echo $tire_row1['status'].'('.$tblswap_row3['remarks'].')';
			}else if(mysql_num_rows($tblswaptire_select3) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row3['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['status'].'('.$tblswaptire_row3['remarks'].'to'.$tblswaptire_row3['tireid'].')';
		}else if(mysql_num_rows($tbltire_select3) > 0){
				 echo $tbltire_row3['status'];
			}	?>
	</font>

	</div>
	<div id="tireforprint-116">
	  <img src="../tireprint/images/tireforprint_116.gif" width="70" height="18" alt="">
	</div>
	<div id="tireforprint-117">
     <font size="-1">
	   <?php
		if(mysql_num_rows($tbltire_select4) == 0 && mysql_num_rows($tblswaptire_select4) == 0 && mysql_num_rows($tblswap_select4) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select4) > 0){
		$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswap_row4['tireid']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
			echo $tire_row1['status'].'('.$tblswap_row4['remarks'].')';
			}else if(mysql_num_rows($tblswaptire_select4) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row4['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['status'].'('.$tblswaptire_row4['remarks'].'to'.$tblswaptire_row4['tireid'].')';
		}else if(mysql_num_rows($tbltire_select4) > 0){
				 echo $tbltire_row4['status'];
			}	?>
	</font>
	 
	</div>
	<div id="tireforprint-118">
	  <img src="../tireprint/images/tireforprint_118.gif" width="24" height="18" alt="">
	</div>
	<div id="tireforprint-119">
     <font size="-1">
	   <?php
		if(mysql_num_rows($tbltire_select6) == 0 && mysql_num_rows($tblswaptire_select6) == 0 && mysql_num_rows($tblswap_select6) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select6) > 0){
			$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswap_row6['tireid']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
			echo $tire_row1['status'].'('.$tblswap_row6['remarks'].')';
			}else if(mysql_num_rows($tblswaptire_select6) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row6['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['status'].'('.$tblswaptire_row6['remarks'].'to'.$tblswaptire_row6['tireid'].')';
		}else if(mysql_num_rows($tbltire_select6) > 0){
				 echo $tbltire_row6['status'];
			}	?>
	</font>
	 
	</div>
	<div id="tireforprint-120">
    <font size="-1">
	   <?php
		if(mysql_num_rows($tbltire_select5) == 0 && mysql_num_rows($tblswaptire_select5) == 0 && mysql_num_rows($tblswap_select5) == 0){
			echo '';
			}
		else if(mysql_num_rows($tblswap_select5) > 0){
		$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswap_row5['tireid']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
			echo $tire_row1['status'].'('.$tblswap_row5['remarks'].')';
			}else if(mysql_num_rows($tblswaptire_select5) > 0){
				$tire = mysql_query("Select * from tbl_trucktires Where tireid='".$tblswaptire_row5['swapto']."'") or die(mysql_error());
				$tire_row1 = mysql_fetch_array($tire);
						 echo $tire_row1['status'].'('.$tblswaptire_row5['remarks'].'to'.$tblswaptire_row5['tireid'].')';
		}else if(mysql_num_rows($tbltire_select5) > 0){
				 echo $tbltire_row5['status'];
			}	?>
	</font>
	  
	</div>
	<div id="tireforprint-121">
	  <img src="../tireprint/images/tireforprint_121.gif" width="27" height="16" alt="">
	</div>
	<div id="tireforprint-122">
	  <img src="../tireprint/images/tireforprint_122.gif" width="26" height="16" alt="">
	</div>
	<div id="tireforprint-123">
	  <img src="../tireprint/images/tireforprint_123.gif" width="151" height="37" alt="">
	</div>
	<div id="tireforprint-124">
	  <img src="../tireprint/images/tireforprint_124.gif" width="102" height="37" alt="">
	</div>
	<div id="tireforprint-125">
	  <img src="../tireprint/images/tireforprint_125.gif" width="26" height="53" alt="">
	</div>
	<div id="tireforprint-126">
	  <img src="../tireprint/images/tireforprint_126.gif" width="127" height="37" alt="">
	</div>
	<div id="tireforprint-127">
	  <img src="../tireprint/images/tireforprint_127.gif" width="26" height="53" alt="">
	</div>
	<div id="tireforprint-128">
	  <img src="../tireprint/images/tireforprint_128.gif" width="98" height="36" alt="">
	</div>
	<div id="tireforprint-129">
	  <img src="../tireprint/images/tireforprint_129.gif" width="244" height="221" alt="">
	</div>
	<div id="tireforprint-130">
	  <img src="../tireprint/images/tireforprint_130.gif" width="99" height="16" alt="">
	</div>
	<div id="tireforprint-131">
	  <img src="../tireprint/images/tireforprint_131.gif" width="70" height="16" alt="">
	</div>
	<div id="tireforprint-132">
	  <img src="../tireprint/images/tireforprint_132.gif" width="1" height="33" alt="">
	</div>
	<div id="tireforprint-133">
	  <img src="../tireprint/images/tireforprint_133.gif" width="102" height="16" alt="">
	</div>
	<div id="tireforprint-134">
	  <img src="../tireprint/images/tireforprint_134.gif" width="1" height="16" alt="">
	</div>
	<div id="tireforprint-135">
	  <img src="../tireprint/images/tireforprint_135.gif" width="100" height="16" alt="">
	</div>
	<div id="tireforprint-136">
	  <img src="../tireprint/images/tireforprint_136.gif" width="27" height="16" alt="">
	</div>
	<div id="tireforprint-137">
	  <img src="../tireprint/images/tireforprint_137.gif" width="98" height="16" alt="">
	</div>
	<div id="tireforprint-138">
	  <img src="../tireprint/images/tireforprint_138.gif" width="99" height="17" alt="">
	</div>
	<div id="tireforprint-139">
	  <img src="../tireprint/images/tireforprint_139.gif" width="70" height="17" alt="">
	</div>
	<div id="tireforprint-140">
	  <img src="../tireprint/images/tireforprint_140.gif" width="101" height="17" alt="">
	</div>
	<div id="tireforprint-141">
	  <img src="../tireprint/images/tireforprint_141.gif" width="2" height="34" alt="">
	</div>
	<div id="tireforprint-142">
	  <img src="../tireprint/images/tireforprint_142.gif" width="24" height="17" alt="">
	</div>
	<div id="tireforprint-143">
	  <img src="../tireprint/images/tireforprint_143.gif" width="2" height="205" alt="">
	</div>
	<div id="tireforprint-144">
	  <img src="../tireprint/images/tireforprint_144.gif" width="100" height="17" alt="">
	</div>
	<div id="tireforprint-145">
	  <img src="../tireprint/images/tireforprint_145.gif" width="27" height="17" alt="">
	</div>
	<div id="tireforprint-146">
	  <img src="../tireprint/images/tireforprint_146.gif" width="98" height="17" alt="">
	</div>
	<div id="tireforprint-147">
	  <img src="../tireprint/images/tireforprint_147.gif" width="26" height="18" alt="">
	</div>
	<div id="tireforprint-148">
	</div>
	<div id="tireforprint-149">
	  <img src="../tireprint/images/tireforprint_149.gif" width="70" height="17" alt="">
	</div>
	<div id="tireforprint-150">
    </div>
	<div id="tireforprint-151">
	  <img src="../tireprint/images/tireforprint_151.gif" width="24" height="17" alt="">
	</div>
	<div id="tireforprint-152">
    </div>
	<div id="tireforprint-153">
	  <img src="../tireprint/images/tireforprint_153.gif" width="27" height="17" alt="">
	</div>
	<div id="tireforprint-154">
	  <img src="../tireprint/images/tireforprint_154.gif" width="98" height="1" alt="">
	</div>
	<div id="tireforprint-155">
  </div>
	<div id="tireforprint-156">
	  <img src="../tireprint/images/tireforprint_156.gif" width="26" height="17" alt="">
	</div>
	<div id="tireforprint-157"> 
	</div>
	<div id="tireforprint-158">
	  <img src="../tireprint/images/tireforprint_158.gif" width="70" height="22" alt="">
	</div>
	<div id="tireforprint-159">
	  <img src="../tireprint/images/tireforprint_159.gif" width="1" height="39" alt="">
	</div>
	<div id="tireforprint-160">
    </div>
	<div id="tireforprint-161">
	  <img src="../tireprint/images/tireforprint_161.gif" width="26" height="22" alt="">
	</div>
	<div id="tireforprint-162">
  </div>
  <div id="tireforprint-163">
	  <img src="../tireprint/images/tireforprint_163.gif" width="27" height="22" alt="">
	</div>
	<div id="tireforprint-164">
    
	</div>
	<div id="tireforprint-165">
	  <img src="../tireprint/images/tireforprint_165.gif" width="26" height="21" alt="">
	</div>
</div>
	<div id="tireforprint-167">
	  <img src="../tireprint/images/tireforprint_167.gif" width="70" height="17" alt="">
	</div>
	<div id="tireforprint-168">
     </div>
	<div id="tireforprint-169">
	  <img src="../tireprint/images/tireforprint_169.gif" width="1" height="50" alt="">
	</div>
	<div id="tireforprint-170">
	  <img src="../tireprint/images/tireforprint_170.gif" width="25" height="17" alt="">
	</div>
	<div id="tireforprint-171">
   </div>
	<div id="tireforprint-172">
	  <img src="../tireprint/images/tireforprint_172.gif" width="27" height="17" alt="">
	</div>
	<div id="tireforprint-173">
    </div>
	<div id="tireforprint-174">
	  <img src="../tireprint/images/tireforprint_174.gif" width="26" height="17" alt="">
	</div>
	<div id="tireforprint-175">
   </div>
	<div id="tireforprint-176">
	  <img src="../tireprint/images/tireforprint_176.gif" width="70" height="18" alt="">
	</div>
	<div id="tireforprint-177">
    </div>
	<div id="tireforprint-178">
	  <img src="../tireprint/images/tireforprint_178.gif" width="25" height="18" alt="">
	</div>
	<div id="tireforprint-179">
   </div>
   <div id="tireforprint-180">
	  <img src="../tireprint/images/tireforprint_180.gif" width="27" height="18" alt="">
	</div>
	<div id="tireforprint-181">
    </div>
	<div id="tireforprint-182">
	  <img src="../tireprint/images/tireforprint_182.gif" width="26" height="18" alt="">
	</div>
	<div id="tireforprint-183">
   </div>
	<div id="tireforprint-184">
	  <img src="../tireprint/images/tireforprint_184.gif" width="70" height="15" alt="">
	</div>
	<div id="tireforprint-185">
   </div>
	<div id="tireforprint-186">
	  <img src="../tireprint/images/tireforprint_186.gif" width="25" height="15" alt="">
	</div>
	<div id="tireforprint-187">
   </div>
	<div id="tireforprint-188">
	  <img src="../tireprint/images/tireforprint_188.gif" width="27" height="15" alt="">
	</div>
	<div id="tireforprint-189">
  </div>
	<div id="tireforprint-190">
	  <img src="../tireprint/images/tireforprint_190.gif" width="26" height="15" alt="">
	</div>
	<div id="tireforprint-191">
	  <img src="../tireprint/images/tireforprint_191.gif" width="169" height="99" alt="">
	</div>
	<div id="tireforprint-192">
	  <img src="../tireprint/images/tireforprint_192.gif" width="128" height="99" alt="">
	</div>
	<div id="tireforprint-193">
	  <img src="../tireprint/images/tireforprint_193.gif" width="127" height="99" alt="">
	</div>
	<div id="tireforprint-194">
	  <img src="../tireprint/images/tireforprint_194.gif" width="124" height="99" alt="">
      
	</div>
</div>
<!-- End Save for Web Slices -->
</body>
</html>