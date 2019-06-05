function dis(){
		if(document.getElementById('change').checked){
			document.getElementById('swap').disabled=true;
			document.getElementById('tbl_swap').hidden=true;
			document.getElementById('tbl_new').hidden=true;
			document.getElementById('tbl_change').hidden=false;
			document.getElementById('history').checked=false;
		}else{
			document.getElementById('swap').disabled=false;
			document.getElementById('tbl_change').hidden=true;
			document.getElementById('tbl_new').hidden=false;
			document.getElementById('history').disabled=false;
		}
		if(document.getElementById('swap').checked){
			document.getElementById('change').disabled=true;
			document.getElementById('tbl_swap').hidden=false;
			document.getElementById('tbl_new').hidden=true;
		}else{
			document.getElementById('change').disabled=false;
			document.getElementById('tbl_swap').hidden=true;
		}
	
	}
