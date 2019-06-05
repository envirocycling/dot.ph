
var numbers =/^[0-9]+$/;
 function validateMe ( ) { 
    var isValid = true;
	 if ( document.form1.lastname.value == "" ) { 
	    alert ( "Lastname is Required." ); 
	    isValid = false;
	} else if ( document.form1.firstname.value == "" ) { 
	    alert ( "Firstname is Required." ); 
	    isValid = false;
} else if ( document.form1.Country.value == "" ) { 
	    alert ( "Address is Required." ); 
	    isValid = false;
	}else if ( document.form1.cellnumber.value == "" ) { 
	    alert ( "Cellphone Number is Required." ); 
		isValid = false;
	}else if ( !document.form1.cellnumber.value.match(numbers) ) { 
	    alert ( "Cellphone Number must only contain numbers." ); 
		isValid = false;
	}else if ( document.form1.cellnumber.value.length < 11 ) { 
	    alert ( "Cellnumber must be 11 characters long." ); 
		isValid = false;
	}
    return isValid;
}


