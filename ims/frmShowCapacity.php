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
<style>
    #character_desc{
        border-style:hidden;
        font-style:italic;
        color:red;
        text-align: center;
    }
    img{
        height:100px;
        width:100px;
    }
</style>
<center>
    
    <?php
    include("config.php");
    $parameter=$_GET['parameter'];
    $parameter_to_pass=$parameter;
    $parameter=preg_split("/[_]/",$parameter);
    $id=$parameter[0];
    $grade=$parameter[1];
    $calculated_tons_we_are_not_getting=$parameter[2];
    if ($grade == "") {
        echo "<h2> Supplier Capacity </h2>";
        echo "<h3>Supplier Capacity of Supplier ID: $id on Grade: All Grades</h3>";
    } else {
        echo "<h2>Update Supplier Capacity </h2>";
        echo "<h3>Supplier Capacity of Supplier ID: $id on Grade: ".$grade."</h3>";
    }

    $query = "SELECT * FROM supplier_capacity where supplier_id='$id' and wp_grade='$grade' order by date_effective desc limit 1  ";
    $result = mysql_query($query) ;
    $tons_we_are_not_getting='';
    $capacity='';
    $delivers_to='';
    $competitors_price='';
    $date_effective='';
    while($row = mysql_fetch_array($result)) {
        $tons_we_are_not_getting=$row['potential_to_lose'];
        $capacity=$row['capacity'];
        $delivers_to=$row['delivers_to'];
        $competitors_price=$row['competitor_price'];
        $date_effective=$row['date_effective'];
    }

    ?>
    <hr>
    <?php
    if ($grade != "") {
        ?>
    <form action="edit_capacity_exec.php" method="POST">
            <?php
            echo "<input type='hidden' value='$id' name='supplier_id'>";
            echo "<input type='hidden' value='$grade' name='wp_grade'>";

            ?>
        Capacity:<input type="text" value="<?php echo $capacity;?>" name="capacity"><br>
            <?php
            $query = "SELECT * FROM supplier_capacity group by delivers_to  ";
            $result = mysql_query($query) ;
            echo "Company:";
            $dropdown = "<select name='delivers_to' id='combobox' >";
            if($delivers_to!='') {
                $dropdown .= "\r\n<option value='$delivers_to'>$delivers_to</option>";
            }else {
                $dropdown .= "\r\n<option value=''>None</option>";

            }
            while($row = mysql_fetch_array($result)) {
                $dropdown .= "\r\n<option value='{$row['delivers_to']}'>{$row['delivers_to']}</option>";
            }
            $dropdown  .= "\r\n</select><br><a href='frmShowCapacity_new.php?parameter=$parameter_to_pass'>New Company?</a><br> ";
            echo "<span id='paliit'>";
            echo $dropdown;
            echo "</span>";

            ?>
        Competitor's Price: <input type="text" value="<?php echo $competitors_price;?>" name="competitor_price"><br>

        Calculated Tons We are Not Getting: <input type="text" value="<?php echo $calculated_tons_we_are_not_getting;?>" name="potential_to_lose" readonly><br>
        Date Effective: <input type='text'  id='inputField' name='date_effective' value="<?php echo date('Y/m/d');?>" onfocus='date1(this.id);' readonly><br>

        <input type="submit" value="Update">

    </form>

    <h3>Supplier Capacity History</h3>
        <?php
    }
    echo "<iframe src='capacityHistory.php?id=$id&grade=$grade' width=530 height=500>";
    ?>
</center>