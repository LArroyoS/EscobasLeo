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

    $("#buscarModificar").on('click',function(){

        if( validar(sku)){

            var cadena = "sku="+sku[0].val();

            $.ajax
            ({
                
                url: "./consulta.php", //¿Ese archivo se llama así realmente?
                method: "POST",
                data: cadena,
                success: function(resultado){

                    if(resultado == null || resultado == ''){

                        sku[1].text("No se encontro el producto");
                        limpiar();

                    }
                    else{

                        var json = JSON.parse(resultado);
                        if(isNaN(json)){

                            asignarValor(marca,json);
                            asignarValor(color,json);
                            asignarValor(material,json);
                            asignarValor(descripcion,json);
                            asignarValor(tipo,json);
                            asignarValor(largo,json);
                            asignarValor(ancho,json);
                            asignarValor(profundidad,json);
                            asignarValor(peso,json);
                            asignarValor(precio,json);
                            
                            sku[0].prop('readonly',true);
                            $(".btn-desactivado").prop('disabled',false);
                            $(".desactivado").prop('disabled',false); 

                        }
                        else{

                            sku[1].text("No se encontro el producto");
                            limpiar();

                        }


                    }

                }
            
            }); 

        }else{

            console.log('error de validacion');
            limpiar();

        }

    });

    $("#buscarEliminar").on('click',function(){

        if( validar(sku)){

            var cadena = "sku="+sku[0].val();
            
            $.ajax
            ({
                
                url: "./consulta.php", //¿Ese archivo se llama así realmente?
                method: "POST",
                data: cadena,
                success: function(resultado){

                    if(resultado == null || resultado == ''){

                        sku[1].text("No se encontro el producto");
                        limpiar();

                    }
                    else{

                        var json = JSON.parse(resultado);
                        if(isNaN(json)){

                            asignarValor(marca,json);
                            asignarValor(color,json);
                            asignarValor(material,json);
                            asignarValor(descripcion,json);
                            asignarValor(tipo,json);
                            asignarValor(largo,json);
                            asignarValor(ancho,json);
                            asignarValor(profundidad,json);
                            asignarValor(peso,json);
                            asignarValor(precio,json);
                            
                            sku[0].prop('readonly',true);
                            $(".btn-desactivado").prop('disabled',false);

                        }
                        else{

                            sku[1].text("No se encontro el producto");
                            limpiar();

                        }


                    }

                }
            
            }); 

        }else{

            console.log('error de validacion');
            limpiar();

        }

    });

    $("#limpiar").on('click',function(){

        limpiar();

    });

    function asignarValor(input,resultado){

        let tipo = input[0].attr('id');

        input[0].val(resultado[tipo]);

    }

    function limpiar(){

        marca[0].val('');
        color[0].val('')
        material[0].val('')
        descripcion[0].val('')
        tipo[0].val('')
        largo[0].val('')
        ancho[0].val('')
        profundidad[0].val('')
        peso[0].val('')
        precio[0].val('')
        sku[0].val('');

        sku[0].prop('readonly',false);
        $(".desactivado").prop('disabled',true);
        $(".btn-desactivado").prop('disabled',true);


    }

    $("#formulario").submit(function(e){

        if( validar(sku) && validar(marca) && validar(tipo) && 
            validar(material) && validar(color) && validar(descripcion)
            && validar(largo) && validar(ancho) && validar(profundidad)
            && validar(peso) && validar(precio)){

            console.log('escoba registrada');

            return true;

        }
        else{

            console.log('error de validacion')
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