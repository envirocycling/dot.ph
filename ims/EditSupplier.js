$(document).ready(function()
    {
        $(".data").live('click',function()
        {
            var ID=$(this).attr('id');

            $("#zero_"+ID).hide();
            $("#one_"+ID).hide();
            $("#two_"+ID).hide();
            $("#three_"+ID).hide();
            $("#four_"+ID).hide();
            $("#five_"+ID).hide();
            $("#six_"+ID).hide();
            $("#seven_"+ID).hide();

            $("#zero_input_"+ID).show();
            $("#one_input_"+ID).show();
            $("#two_input_"+ID).show();
            $("#three_input_"+ID).show();
            $("#four_input_"+ID).show();
            $("#five_input_"+ID).show();
            $("#six_input_"+ID).show();
            $("#seven_input_"+ID).show();

        }).live('change',function(e)
        {
            var ID=$(this).attr('id');

            var zero_val=$("#zero_input_"+ID).val();
            var one_val=$("#one_input_"+ID).val();
            var two_val=$("#two_input_"+ID).val();
            var three_val=$("#three_input_"+ID).val();
            var four_val=$("#four_input_"+ID).val();
            var five_val=$("#five_input_"+ID).val();
            var six_val=$("#six_input_"+ID).val();
            var seven_val=$("#seven_input_"+ID).val();

            var dataString = 'id='+ ID +'&supplier_id='+zero_val+'&supplier_name='+one_val+'&classification='+two_val+'&owner='+three_val+'&owner_contact='+four_val+'&street='+five_val+'&municipality='+six_val+'&province='+seven_val;
            if(one_val.length>0 || two_val.length>0 || three_val.length>0 || four_val.length>0 || five_val.length>0 || six_val.length>0 || seven_val.length>0)
            {
                $.ajax({
                    type: "POST",
                    url: "live_edit_ajax.php",
                    data: dataString,
                    cache: false,
                    success: function(e)
                    {

                        $("#one_"+ID).html(one_val);
                        $("#two_"+ID).html(two_val);
                        $("#three_"+ID).html(three_val);
                        $("#four_"+ID).html(four_val);
                        $("#five_"+ID).html(five_val);
                        $("#six_"+ID).html(six_val);
                        $("#seven_"+ID).html(seven_val);

                        e.stopImmediatePropagation();

                    }
                });
            }
        //else
        //{
        //alert('Enter something.');
        //}

        });

        // Edit input box click action
        $(".editbox").live("mouseup",function(e)
        {
            e.stopImmediatePropagation();
        });

        // Outside click action
        $(document).mouseup(function()
        {
            $(".editbox").hide();
            $(".text").show();
        });
    });