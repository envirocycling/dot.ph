 	<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../index.php");
	}
include('../title.php');
?>

  <link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
 <?php
 include('connect.php');
 ?>
 
<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
 <?php //======================================================================================?>
	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // type numbers only==================================================================?>
<script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}</script>
<?php //disabledfileds=====-=-=--=-==-===---------------------------[?>
<script>
function active(){
  if(document.getElementById('checkbox').checked){
   ;
	      document.getElementById('pdate').disabled=false;
	 document.getElementById('adate').disabled=false;
	  document.getElementById('quantity').disabled=false;
	   document.getElementById('reassign').disabled=false;
	    document.getElementById('sold').disabled=false;

}else{
   
	   document.getElementById('pdate').disabled=true;
	   	   document.getElementById('adate').disabled=true;
	   	  document.getElementById('quantity').disabled=true;
	   document.getElementById('reassign').disabled=true;
	    document.getElementById('sold').disabled=true;
	   }
}</script>
<?php //facebox==========================================================================?>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<link href="../css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: '../src/loading.gif',
            closeImage: '../src/closelabel.png'
        })
    })
</script>
<?php //=====================================================?>
<?php //======================================================================================?>

	<script>
		function caps(element){
    element.value = element.value.toUpperCase();
		}
	</script>
 <?php // headermenu==============?>
    <link rel="stylesheet" href="../css/header2.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="../js/header.js"></script>
   <img src="../image/header.png" height="25%" width="100%">
	
<div id='cssmenu'>
<ul>

   <li ><a href="existing_truck.php">Existing Vehicles</a></li>
      <li ><a href='maintenance.php'>Maintenance</a></li>
   <li ><a href="registration_monitoring.php">Vehicle Registration</a></li>
     <li><a href="truck_reassign.php">Vehicle Reassignment</a></li>
	<li class="active"><a href='summary.php'>Summary</a></li>
     <li><a href='trip.php'>Trip Schedule</a></li>
        <li>|                |</li> 
        <li><a href='myaccount.php' rel="facebox">MyAccount</a></li>
            
         <li><a href="logout.php">Logout</a></li>
</ul>
</div><br /> <?php //startofcode===========================================================================?>
<center>
<table  width="80%" align="center" >
		<tr>
				<td align="center" colspan="2"><h3>Summary</h3></td>
				<td></td>
			</tr>
	</table>  
<form action="" method="post" target="_self">

<!---beginning of select -->
<link rel="stylesheet" href="../cbFilter/cbCss.css" />
<script src="../cbFilter/jquery-1.8.3.js"></script>
<script src="../cbFilter/jquery-ui.js"></script>
<style>
    #sup_picker{
        font-size:14px;
        width:500px;
    }
    .ui-combobox {
        position: relative;
        display: inline-block;
    }
    .ui-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
        /* adjust styles for IE 6/7 */
        *height: 1.7em;
        *top: 0.1em;
    }
    .ui-combobox-input {
        margin: 0;
        padding: 0.3em;
		width:150px;
    }
</style>
<script>
    (function( $ ) {
        $.widget( "ui.combobox", {
            _create: function() {
                var input,
                that = this,
                select = this.element.hide(),
                selected = select.children( ":selected" ),
                value = selected.val() ? selected.text() : "",
                wrapper = this.wrapper = $( "<span>" )
                .addClass( "ui-combobox" )
                .insertAfter( select );

                function removeIfInvalid(element) {
                    var value = $( element ).val(),
                    matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
                    valid = false;
                    select.children( "option" ).each(function() {
                        if ( $( this ).text().match( matcher ) ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });
                    if ( !valid ) {
                        // remove invalid value, as it didn't match anything
                        $( element )
                        .val( "" )
                        .attr( "title", value + " didn't match any item" )
                        .tooltip( "open" );
                        select.val( "" );
                        setTimeout(function() {
                            input.tooltip( "close" ).attr( "title", "" );
                        }, 2500 );
                        input.data( "autocomplete" ).term = "";
                        return false;
                    }
                }

                input = $( "<input>" )
                .appendTo( wrapper )
                .val( value )
                .attr( "title", "" )
                .addClass( "ui-state-default ui-combobox-input" )
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: function( request, response ) {
                        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                        response( select.children( "option" ).map(function() {
                            var text = $( this ).text();
                            if ( this.value && ( !request.term || matcher.test(text) ) )
                                return {
                                    label: text.replace(
                                    new RegExp(
                                    "(?![^&;]+;)(?!<[^<>]*)(" +
                                        $.ui.autocomplete.escapeRegex(request.term) +
                                        ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                ), "<strong>$1</strong>" ),
                                    value: text,
                                    option: this
                                };
                        }) );
                    },
                    select: function( event, ui ) {
                        ui.item.option.selected = true;
                        that._trigger( "selected", event, {
                            item: ui.item.option
                        });
                    },
                    change: function( event, ui ) {
                        if ( !ui.item )
                            return removeIfInvalid( this );
                    }
                })
                .addClass( "ui-widget ui-widget-content ui-corner-left" );

                input.data( "autocomplete" )._renderItem = function( ul, item ) {
                    return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
                };

                $( "<a>" )
                .attr( "tabIndex", -1 )
                .attr( "title", "Show All Items" )
                .tooltip()
                .appendTo( wrapper )
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-s"
                    },
                    text: false
                })
                .removeClass( "ui-corner-all" )
                .addClass( "ui-corner-right ui-combobox-toggle" )
                .click(function() {
                    // close if already visible
                    if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                        input.autocomplete( "close" );
                        removeIfInvalid( input );
                        return;
                    }

                    // work around a bug (likely same cause as #5265)
                    $( this ).blur();

                    // pass empty string as value to search for, displaying all results
                    input.autocomplete( "search", "" );
                    input.focus();
                });

                input
                .tooltip({
                    position: {
                        of: this.button
                    },
                    tooltipClass: "ui-state-highlight"
                });
            },

            destroy: function() {
                this.wrapper.remove();
                this.element.show();
                $.Widget.prototype.destroy.call( this );
            }
        });
    })( jQuery );

    $(function() {
        $( "#combobox" ).combobox();
        $( "#toggle" ).click(function() {
            $( "#combobox" ).toggle();
        });
    });
</script>
<table  width="36%">
<tr>
<td width="90%">
<span id="sup_picker">
Select Here: 
<select name="plate" onchange="onSelectChange();" id="combobox" >
<?php if(isset($_POST['plate'])){?><option value="<?php echo @$_POST['plate'];?>"><?php echo @$_POST['plate'];?></option>
<?php
}
$query=mysql_query("Select * from tbl_truck_report") or die (mysql_error());
while($row = mysql_fetch_array($query)){
?>

    <option value="<?php echo $row['truckplate'];?>"><?php echo $row['truckplate'];?></option><?php
	}
	$query2 = mysql_query("Select DISTINCT(driver) from tbl_trip") or die (mysql_error());
	while($row2 = mysql_fetch_array($query2)){
		?>

    <option value="<?php echo $row2['driver'];?>"><?php echo $row2['driver'];?></option><?php
		}
			$query3 = mysql_query("Select DISTINCT(helper) from tbl_trip") or die (mysql_error());
	while($row3 = mysql_fetch_array($query3)){
		?>

    <option value="<?php echo $row3['helper'];?>"><?php echo $row3['helper'];?></option><?php
		}
?>
</select>

</span>
</div>
</td>
<td><input value="View Summary" type="submit" name="submit"></form></td>
</tr>
</table>
<?php
if(isset($_POST['submit'])){
	$plate = mysql_query("Select * from tbl_truck_report Where truckplate='".$_POST['plate']."'") or die (mysql_error());
	if(mysql_num_rows($plate) > 0){
?>
	<br />
    <br />
    <center>
    <table width="60% "> 
    <tr>
    <td>
	<table class="CSSTableGenerator">
    <tr>
    <td colspan="2">Date Accept</td>
    <td >Plate</td>
    <td>Branch</td>
    <td>Remarks</td>
    <td>Description</td>
    </tr>
    <?php

	$rows = mysql_fetch_array($plate);
    $select = mysql_query("Select * from tbl_reassignmenthistory Where truckplate = '".$rows['id']."' Order by id Asc") or die(mysql_error());
	
	$num = 0;
	while($row_his = mysql_fetch_array($select)){
		$num++;
		?>
       <tr>
       <td><?php echo $num;?></td>
        <td><?php echo $row_his['date_approved'];?></td>
       <td><?php echo $_POST['plate'];?></td>
       <td><?php echo $row_his['branch'];?></td>
       <td><?php echo $row_his['remarks'];?></td>
       <td><?php echo $row_his['status'];?></td>
       </tr> 
        <?php
		}
		
	 }else {?>
	 <br />
    <br />
    <iframe src="summary2.php?plate=<?php echo $_POST['plate'];?>" width="1000px" height="1500px" frameborder="0" name="summary">
    <?php }?>
       </table>
    </td>
    </tr>
    </table>

<?php
}
?>

<!---end of select -->
   </center>
<?php //endtofcode===========================================================================?>
<br /><br />
<img src="../image/footer.png" height="8%" width="100%">     