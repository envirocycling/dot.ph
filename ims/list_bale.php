<?php
session_start();
?>
<script type='text/javascript' src='jquery-1.3.2.min.js'></script>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<h1>Actual Bales</h1><hr>
<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />
<script type="text/javascript" src="jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
    function date1(str){
        new JsDatePick({
            useMode:2,
            target:str,
            dateFormat:"%Y/%m/%d"
        });
    };
</script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage : 'src/loading.gif',
            closeImage   : 'src/closelabel.png'
        })
    })
</script>
<script type="text/javascript">
    function addBale(str) {
        if (str=="")
        {
            document.getElementById("txtHint").innerHTML="";
            return;
        }
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
            }
        }

        if(str=='select_all'){
            window.open("sessionista_add_bale.php?bale_id="+str,'mywindow','width=10,height=10');
        } else{
//            alert("ok naman sa one by one");
            document.getElementById(str).disabled = true;
            xmlhttp.open("GET","sessionista_add_bale.php?bale_id="+str,true);
            xmlhttp.send();
        }
    }
</script>
<form action="create_packing_list.php" method="POST">
    STR: <input type='text' id='str_no' value=''name="str_no" size="5">.
    Dated : <input type='text'  id='inputField' name='date_out' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly><br>
    <table class="data display datatable" id="example">
        <?php
        include("config.php");
        $branch=$_SESSION['user_branch'];
        $query="SELECT * FROM bales where str_no=0 and str_no not like '%DR%' and branch like '%$branch%' and status !='rebaled' and str_no !='VOID' and wp_grade !='VOID'";
        $result=mysql_query($query);
        echo "<thead>";
        echo "<th class='data' ></th>";
        echo "<th class='data' >Bale_ID</th>";
        echo "<th class='data' >WP Grade</th>";
        echo "<th class='data' >Weight</th>";
        echo "<th class='data' >Date Created</th>";
        echo "</thead>";
        while($row = mysql_fetch_array($result)) {
            echo "<tr class='data'>";
            if($_SESSION['isall']=='no') {
                echo "<td><input type='checkbox' id='".$row['log_id']."' value='".$row['log_id']."' onclick='addBale(this.value);' ></td>";
            }else {
                echo "<td><input type='checkbox' id='".$row['log_id']."' value='".$row['log_id']."' disabled checked ></td>";
            }
            echo "<td class='data'>" .$row['bale_id']. "</td>";
            echo "<td class='data'>" .$row['wp_grade']. "</td>";
            echo "<td class='data'>" .$row['bale_weight']. "</td>";
            echo "<td class='data'>" .$row['date']. "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <input type="submit" value="Create List">
</form>
<a href="bales_clear_selection.php"><button>Clear Selection</button></a>

