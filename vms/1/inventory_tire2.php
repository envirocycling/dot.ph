<?php
session_start();
if(!isset($_SESSION['a_username'])){
	header("Location: ../index.php");
	}
?>
<?php include('connect.php');?>

<?php // auto submit if change==================================================================?>
<script>
function onSelectChange(){
 document.getElementById('frm').submit();
}</script>
<link href="../css/table.css" media="screen" rel="stylesheet" type="text/css" />
<br />
<br />
<form action="inventory_tire3.php" method="post" id="frm"  target="in_tire">
<table width="45%" align="left">

<tr><td align="right">

Plate:</td><td>


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

<span id='sup_picker'>
<select name="plate"  onchange="onSelectChange();" id="combobox">
<option value=" ">All</option>
<?php 
$select_truck  = mysql_query("Select * from tbl_truck_report ORDER by ending ASC") or die (mysql_error());
$row_trucks  = mysql_fetch_array($select_truck);?>
<option value="<?php echo $row_trucks['id'];?>"><?php echo $row_trucks['truckplate'];?></option><?php
while ($row_truck  = mysql_fetch_array($select_truck)){
?>
<option value="<?php echo $row_truck['id'];?>"><?php echo $row_truck['truckplate'];?></option>
<?php } ?>
</select>
</span>

<!---end of select -->

</td>

</tr>
</table>
</form>
<br />
  <center>
 <table width="80%" align="center"><tr><td>
<table align="center" width="60%" border="1px" class="CSSTableGenerator">
<tr>
<td align="center">Tire ID</td>
<td align="center">Tire Name</td>
<td align="center">Tire Size</td>
<td align="center">Decription</td>
<td align="center">Status</td>


</tr>

<?php
$num=0;
$tool = mysql_query("Select * from tbl_trucktires ") or die (mysql_error());
 while($row = mysql_fetch_array($tool)){

$num++;
?>
<tr>
<td width="5%"><?php echo $row['tireid'];?></td>
<td><?php echo $row['tirename'];?></td>
<td><?php echo $row['tiresize']; ?></td>
<td><?php echo $row['description']; ?></td>
<td><?php echo $row['status']; ?></td>



</tr>
<?php } ?>
</table>
</td></tr></table>
</center>