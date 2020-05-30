$(document).ready(function() {

    var email = [$("#email"),$("#errorEmail")];
    var clave = [$("#clave"),$("#errorClave")];  

    $("#ingresar").on('click',function(e){

        if(validar(email) && validar(clave)){

            console.log('acceso permitido');

            return true;

        }
        else{

            console.log('acceso denegado')
            return false;

        }

    });

    $("#registrar").on('click',function(){

        if(validar(email) && validar(clave)){

            console.log('registro exitoso');
            return true

        }
        else{

            console.log('registro fallido')
            return false;
            
        }

    });

    function validar(input){

        input[0].removeClass('error');
        input[1].text('');
        let valor = input[0].val();
        let tipo = input[0].attr('id');
        error = '';

        if(valor!=null && valor!=''){

            switch(tipo){

                case 'email':

                    error = validacionEmail(valor);

                break;

                case 'clave':

                    error = validacionClave(valor);

                break;

            }

            if(error === null || error === undefined || error === "" ){

                return true;

            }

        }
        else{

            error = tipo+" es requerido";

        }

        input[1].text(error);
        input[0].addClass("error");

        return false;

    }

    function validacionEmail(valor){

        var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

        if (!regex.test(valor.trim())) {

            return 'La direccón de correo no es válida';
        
        }

    }

    function validacionClave(valor){

        var regex = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;

        if(!regex.test(valor.trim())){

            return 'Entre 8 y 10 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales'; 

        }

    }

});