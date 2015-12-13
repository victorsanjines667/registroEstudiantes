function login(){
    validacion();
}

function validacion(){
    
   $('#frm-login').bootstrapValidator({
        container: 'tooltip',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombreusuario: {
                message: 'Nombre de usuario no válido',
                validators: {
                    notEmpty: {
                        message: 'Nombre de usuario requerido, no puede estar vacío'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'El nombre de usuario puede ser de 6 a 30 caracteres de longitud'
                    }/*,
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'The username can only consist of alphabetical, number and underscore'
                    }*/
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña no puede estar vacia'
                    }
                }
            }
        }
    });  

  
}