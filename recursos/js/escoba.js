$(document).ready(function() {

    var sku = [$("#sku"),$("#errorSku")];
    var marca = [$("#marca"),$("#errorMarca")];
    var color = [$("#color"),$("#errorColor")];
    var material = [$("#material"),$("#errorMaterial")];
    var descripcion = [$("#descripcion"),$("#errorDescripcion")];
    var tipo = [$("#tipo"),$("#errorTipo")];
    var largo = [$("#largo"),$("#errorLargo")];
    var ancho = [$("#ancho"),$("#errorAncho")];
    var profundidad = [$("#profundidad"),$("#errorProfundidad")];
    var peso = [$("#peso"),$("#errorPeso")];
    var precio = [$("#precio"),$("#errorPrecio")];

    $("#botones").on('click','#modificar',function(){

        var padre = $(this).closest('#botones');
        $(this).remove();

        var item = '<input type="submit" class="btn btn-success" style="min-width: 200px;" value="GUARDAR" id="enviar" name="enviar"/>';
        $(padre).append(item);

        $(".desactivado").prop('disabled',false);


    });

    $("#formulario").submit(function(e){

        if( validar(sku) && validar(marca) && validar(tipo) && 
            validar(material) && validar(color) && validar(descripcion)
            && validar(largo) && validar(ancho) && validar(profundidad)
            && validar(peso) && validar(precio)){

            console.log('escoba registrada');

            return true;

        }
        else{

            console.log('error al registrar escoba')
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

                case 'sku':
                case 'marca':
                case 'tipo':

                    error = validacionEntero(valor,tipo);

                break;

                case 'largo':
                case 'ancho':
                case 'profundidad':
                case 'peso':
                case 'precio':

                    error = validacionReal(valor,tipo);

                break;

                case 'material':

                    error = validarMaterial(valor);

                break;

                default:

                    error = validarTexto(valor,tipo);

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

    function validacionEntero(valor,tipo){

        if(isNaN(parseInt(valor))){

            return tipo+' no es un numero entero';
        
        }

    }

    function validacionReal(valor,tipo){

        if(isNaN(parseFloat(valor))){

            return tipo+' no es un numero';
        
        }

    }

    function validarMaterial(valor){

        var regex = /^([a-zA-Z\s]+)(\s*[a-zA-Z\s]*)*$/;

        if(!regex.test(valor.trim())){

            return 'Los materiales deben iniciar con una letra, estar separados por una coma, y no tener ningun numero'; 

        }

    }

    function validarTexto(valor,tipo){

        var regex = /^[a-zA-Z].*$/

        if(!regex.test(valor.trim())){

            return tipo+" debe comenzar por una letra";

        }

    }

});