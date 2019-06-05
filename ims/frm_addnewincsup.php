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



<?php
include('config.php');
include('templates/template.php');




?>
<link rel="stylesheet" href="cbFilter/cbCss.css" />
<script src="cbFilter/jquery-1.8.3.js"></script>
<script src="cbFilter/jquery-ui.js"></script>
<style>
    #sup_picker{
        font-size:25px;
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

$(document).ready(function(){
    $('select[name="wp_grade"]').change(function(){
        var supp = $('select[name="supplier_id"]').val();
        var wp_grade = $('select[name="wp_grade"]').val();
        var dataX = 'supplier_id=' + supp + '&wp_grade=' + wp_grade;
        $.ajax({
            type: 'POST',
            url: 'frm_addnewincsup_chk.php',
            data: dataX
        }).done(function(e){
            var dataN = e.split('~');
            var quota = dataN[0];
            var base_price = dataN[1];
            var incentive = dataN[2];
            var covered_incentive = dataN[3];
            var type = dataN[4];
            
            $('input[name="quota"]').val(quota);
            $('input[name="base_price"]').val(base_price);
            $('input[name="incentive"]').val(incentive);
            $('input[name="covered_incentive"]').val(covered_incentive);
            $('select[name="type"]').val(type);
        });
    });
    $('#inputField').click(function(){
        var supp = $('select[name="supplier_id"]').val();
        var wp_grade = $('select[name="wp_grade"]').val();
        var dataX = 'supplier_id=' + supp + '&wp_grade=' + wp_grade;
        $.ajax({
            type: 'POST',
            url: 'frm_addnewincsup_chk.php',
            data: dataX
        }).done(function(e){
            var dataN = e.split('~');
            var quota = dataN[0];
            var base_price = dataN[1];
            var incentive = dataN[2];
            var covered_incentive = dataN[3];
            var type = dataN[4];
            
            $('input[name="quota"]').val(quota);
            $('input[name="base_price"]').val(base_price);
            $('input[name="incentive"]').val(incentive);
            $('input[name="covered_incentive"]').val(covered_incentive);
            $('select[name="type"]').val(type);
        });
    });
});
</script>

<style>
    #faceboxxx{
        font-size:18px;
    }
    #faceboxxx  input{
        font-size:18px;
    }
    #list{
        font-size:18px;
    }
    table {
        border-style:hidden;
        text-align:left;
    }
    table tr{
        border-style:hidden;
    }
    table td{
        border-style:hidden;
    }
    #wp_grade{
        font-size:18px;

    }



</style>


</head>
<div class="grid_10">
    <div class="box round first grid">
        <div id="faceboxxx">
            <?php

            include('config.php');
			$supplier = mysql_query("Select * from supplier_details");
            echo "Please Input Incentive Details";
            echo "<hr></hr>";


            echo "<form action='add_new_inc_sup_exe.php' method='POST'>";
            echo "<table border=0>";


            echo "<tr>";
            echo "<th>Supplier:</th>";
            echo "<td>";
            echo "<span id='sup_picker'>";
            echo "<select name='supplier_id' id='combobox'>";

            while($row = mysql_fetch_array($supplier)) {
               // $sup_det = preg_split("/[+]/", $value);
                echo "<option value='".$row['supplier_id']."'>".$row['supplier_id']."_".$row['supplier_name']."</option>";

            }
            echo "</select>";
            echo "</span>";
            echo "</td>";






            echo "</tr>";

            echo "<tr>";
            $query = "SELECT * FROM wp_grades  ";
            $result = mysql_query($query) ;

            echo "<td>WP Grade:</td>";
            $dropdown = "<td><select name='wp_grade'  id='wp_grade' required>";
            $dropdown .= "\r\n<option value='' disabled selected>Please Select</option>";
            $dropdown .= "\r\n<option value='all_grades'>All Grades</option>";
            $dropdown .= "\r\n<option value='all_without_lcwl'>All without LCWL</option>";
            $dropdown .= "\r\n<option value='all_without_occ'>All without OCC</option>";
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['wp_grade']}'>{$row['wp_grade']}</option>";
            }

            $dropdown .= "\r\n</select></td>";

            echo $dropdown;
            echo "</tr>";


            echo "<tr>";
            echo "<td>Scheme:</td>";
            echo "<td>FROM: <input type='text'  id='inputField' name='start_date' onfocus='date1(this.id);' readonly>";
            echo "TO: <input type='text'  id='inputField2' name='end_date' onfocus='date1(this.id);'  readonly></td>";
            echo "</tr>";






            echo "<tr>";
            echo "<td>Quota (KG):</td>";
            echo "<td><input type='text' value=''  name='quota'  size=15; ></td>";
            echo "</tr>";



            echo "<tr>";
            echo "<td>Base Price (per KG):</td>";
            echo "<td><input type='text' value=''  name='base_price'  size=15; ></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Incentive :</td>";
            echo "<td><input type='text' value=''  name='incentive'  size=15; ></td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>Covered with Incentive:</td>";
            echo "<td><input type='text' value=''  name='covered_incentive'  size=15; ></td>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>Incentive Type:</td>";
            echo "<td>";
                echo '<select name="type" id="wp_grade" required>
                            <option value="" selected disabled>Please Select</option>
                            <option value="Covered all deliveries">Covered all deliveries</option>
                            <option value="Covered all excess deliveries in quota">Covered excess deliveries in quota only</option>
                            <option value="Covered quota only">Covered quota only</option>
                    </select>';
            echo"</td>";
            echo "</tr>";








            echo "<tr><td></td><td><input type='Submit' value='Save'> <a href='inc_deliveries.php'><u>Back To List</u></a></td>";

            echo "</table>";
            echo "</form>";

            ?>

</div></div>
</div>

</body>
</html>


<div class="clear">
</div>
<div class="clear">
</div>
