
$(document).ready(function() {   

    $('#defaultForm').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                        },
                    stringLength: {
                        message: 'The username must be minimum of 3 characters',
                        min: 3   
                    },
                    regexp:  {
                        regexp: /^[A-Za-z0-9]+$/,
                        message: 'The username can only consist of alphanumeric value'
                    }
            }
            
        },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                        },
                    stringLength: {
                        message: 'The password must be minimum of 6 characters',
                        min: 6   
                    }
                }
            },
            current_password: {
                validators: {
                    notEmpty: {
                        message: 'The current password is required'
                        }
                }
            }
    }
        
    });
});
