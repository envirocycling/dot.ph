  
   $(window).load(function () {
      $(".editbox").hide();
        $("span").click(function() {
			$(".editbox2").hide();
			var ID = $(this).attr('id');
            $("#supps_" + ID).show(500);
			$("#supp" + ID).hide(500);
            $("#tons_" + ID).show(500);
			$("#ton" + ID).hide(500);
			$("#outs_" + ID).show(500);
			$("#out" + ID).hide(500);
			$("#in" + ID).hide(500);
			$("#ins_" + ID).show(500);
			$("#refills_" + ID).show(500);
			$("#refill" + ID).hide(500);
			$("#costs_" + ID).show(500);
			$("#cost" + ID).hide(500);
			$("#remarkss_" + ID).show(500);
			$("#remarks" + ID).hide(500);	
			$("#drivers_" + ID).show(500);
			$("#driver" + ID).hide(500);
			$("#helpers_" + ID).show(500);
			$("#helper" + ID).hide(500);
			$("#btn_" + ID).show(500);
			$("#btn" + ID).hide(500);
			
        });
        $("button").click(function() {
	      var valid = true;
		if(document.getElementById('inputs').value == 0){
			alert("You must Enter the Diesel Conversion First.");
			valid = false;
			return valid;
		}else{
			var ID = $(this).attr('id');
			$(".editbox2").show();
			$(".editbox").hide();
			var pno1 = document.getElementById('pno').value;
			var month1 = document.getElementById('month').value;
			var year1 = document.getElementById('year').value;
			var day1 = $("#d" + ID).val();
			var supp1 = $("#supp_" + ID).val();
			var ton1 = $("#ton_" + ID).val();
			var out1 = $("#out_" + ID).val();
			var in1 = $("#in_" + ID).val();
			var refill1 = $("#refill_" + ID).val();
			var cost1 = $("#cost_" + ID).val();
			var remarks1 = $("#remarks_" + ID).val();
			var driver1 = $("#driver_" + ID).val();
			var helper1 = $("#helper_" + ID).val();
			var out3 = Number(in1) + Number(refill1);
			var id2 = Number(ID) + 1;
			
			
		 	var dataString = 'day=' + day1 + '&supplier=' + supp1 +'&pno=' + pno1 + '&month=' + month1 + '&year=' + year1 + '&ton=' + ton1 + '&out=' + out1 + '&in=' + in1 + '&refill=' + refill1 + '&cost=' + cost1 + '&remarks=' + remarks1 + '&driver=' + driver1 + '&helper=' + helper1 + '&out3=' + out3;
            
		    
			$.ajax({
                    type: "POST",
                    url: "trip_update.php",
                    data: dataString,
                    cache: false
				 });
			
			var con2 = document.getElementById('con_').value;
			var cms2 = out1;
			var cm3 = in1;
			var cms1 = out1 - in1;
			var con1 = con2 * cms1;
			var peso2 = cost1 * con1;
			var peso1 = peso2.toFixed(2);
			var sam = document.getElementById("out_" + id2).innerHTML=out3;
			document.getElementById("supps2_" + ID).innerHTML=supp1;
			document.getElementById("ton2_" + ID).innerHTML=ton1;
			document.getElementById("out2_" + ID).innerHTML=out1;
			document.getElementById("out2_" + id2).innerHTML=out3;
			document.getElementById("out_" + id2).value=out3;
			document.getElementById("in2_" + ID).innerHTML=in1;
			document.getElementById("refill2_" + ID).innerHTML=refill1;
			document.getElementById("cost2_" + ID).innerHTML=cost1;
			document.getElementById("remarks2_" + ID).innerHTML=remarks1;
			document.getElementById("driver2_" + ID).innerHTML=driver1;
			document.getElementById("helper2_" + ID).innerHTML=helper1;
			document.getElementById("cms").value=cms1;
			document.getElementById("lits").value=con1;
			document.getElementById("pesos").value=peso1;
		
			
		}		
		
        });
		
    });
	
