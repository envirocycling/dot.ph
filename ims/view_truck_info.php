<?php
include("config.php");
if (isset ($_GET['del_id'])) {
    $del_id = $_GET['del_id'];

    mysql_query("DELETE FROM truck_rent WHERE id='$del_id'");
    echo "<script>";
    echo "alert('Successfully Deleted.');";
    echo "window.close();";
    echo "</script>";
}
?>

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
<link rel="stylesheet" href="cbFilter/cbCss.css" />
<script src="cbFilter/jquery-1.8.3.js"></script>
<script src="cbFilter/jquery-ui.js"></script>
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

<?php

$truck_id = $_GET['truck_id'];
$sql = mysql_query("SELECT * FROM truck WHERE truck_id='$truck_id'");
$rs = mysql_fetch_array($sql);

echo "<div align='center'>";
echo "<form method='POST' action='truck_update_exec.php'>";
echo "<input type='hidden' name='truck_id' value='".$rs['truck_id']."'>";
echo "<table width='500' border='0'>";
echo "<tr>";
echo "<td colspan='2'><h2>EFI Trucks</h2></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Plate Number :</td>";
echo "<input type='hidden' name='plate_number2' value='".$rs['plate_number']."'>";
echo "<td><input type='text' name='plate_number' value='".$rs['plate_number']."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Acquistion Cost (PhP) :</td>";
echo "<td><input type='text' name='aquisition_cost' value='".$rs['aquisition_cost']."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Net Book Value (PhP) :</td>";
echo "<td><input type='text' name='netbook_value' value='".$rs['netbook_value']."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Amount (PhP) :</td>";
echo "<td><input type='text' name='amount' value='".$rs['amount']."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>Truck Condition: </td>";
echo "<td><input type='text' name='truck_condition' value='".$rs['truck_condition']."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='2'><input type='submit' name='update' value='Update'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
echo "<br>";

$sql_rent = mysql_query("SELECT * FROM truck_rent WHERE truck_id='$truck_id'");
$count = mysql_num_rows($sql_rent);
$rs_rent = mysql_fetch_array($sql_rent);
if ($count <= 0) {
    echo "<form method='POST' action='truck_rent_exec.php'>";
    echo "<input type='hidden' name='truck_id' value='".$rs['truck_id']."'>";
    echo "<table width='500' border='0'>";
    echo "<tr>";
    echo "<tr>";
    echo "<td colspan='2'><h2>Given To</h2></td>";
    echo "</tr>";
    echo "<td width='230'>Supplier Id/Name :</td>";
    echo "<td><span id='sup_picker'>";
    echo "<select name='supplier_id' id='combobox' >";
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
    while ($rs_sup = mysql_fetch_array($sql_sup)) {
        echo "<option value='".$rs_sup['supplier_id']."'>".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."</option>";
    }
    echo "</select>";
    echo "</span></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Issuance Date :</td>";
    echo "<td><input type='text'  id='inputField' name='issuance_date' value='".date('Y/m/d')."' onfocus='date1(this.id);' readonly size='8'>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>End Date :</td>";
    echo "<td><input type='text'  id='inputField2' name='end_date' value='".date('Y/m/d')."' onfocus='date1(this.id);' readonly size='8'>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Amortization (PhP) :</td>";
    echo "<td><input type='text' name='amortization' value=''></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Cash Bond (PhP)  :</td>";
    echo "<td><input type='text' name='cash_bond' value=''></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Proposed Volume :</td>";
    echo "<td><input type='text' name='proposed_volume' value=''></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='2'><input type='submit' name='truck_rent' value='Save'></td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
} else {
    echo "<form method='POST' action='truck_rent_update_exec.php'>";
    echo "<table width='500' border='0'>";
    echo "<input type='hidden' name='truck_id' value='".$rs['truck_id']."'>";
    echo "<input type='hidden' name='id' value='".$rs_rent['id']."'>";
    echo "<tr>";
    echo "<td colspan='2'><h2>Given To</h2></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td width='230'>Supplier Name :</td>";
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE supplier_id='".$rs_rent['supplier_id']."'");
    $rs_sup = mysql_fetch_array($sql_sup);
    echo "<td><span id='sup_picker'>";
    echo "<select name='supplier_id' id='combobox' >";
    echo "<option value='".$rs_sup['supplier_id']."'>".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."</option>";
    $sql_sup = mysql_query("SELECT * FROM supplier_details WHERE status!='inactive'");
    while ($rs_sup = mysql_fetch_array($sql_sup)) {
        echo "<option value='".$rs_sup['supplier_id']."'>".$rs_sup['supplier_id']."_".$rs_sup['supplier_name']."</option>";
    }
    echo "</select>";
    echo "</span></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Issuance Date :</td>";
    echo "<td><input type='text'  id='inputField' name='issuance_date' value='".$rs_rent['issuance_date']."' onfocus='date1(this.id);' readonly size='8'>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>End Date :</td>";
    echo "<td><input type='text'  id='inputField2' name='end_date' value='".$rs_rent['end_date']."' onfocus='date1(this.id);' readonly size='8'>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Amortization :</td>";
    echo "<td><input type='text' name='amortization' value='".$rs_rent['amortization']."'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Cash Bond :</td>";
    echo "<td><input type='text' name='cash_bond' value='".$rs_rent['cash_bond']."'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Proposed Volume :</td>";
    echo "<td><input type='text' name='proposed_volume' value='".$rs_rent['proposed_volume']."'></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='2'><input type='submit' name='update' value='Update'></td>";

    echo "</tr>";
    echo "</table></form>";

}
?>
<a href='view_truck_info.php?del_id=<?php echo $rs_rent['id']; ?>' onclick="return confirm('Are you sure you want to delete?')"><button  style="margin-top: -40px;" >Delete</button></a>
<?php
echo "</div>";


?>
