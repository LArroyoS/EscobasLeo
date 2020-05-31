<?php

    include('./configuracion/conexion.php');

    $sku = $marca = $color = $material = $descripcion = $tipo = '';
    $largo = $ancho = $profundidad = $peso = $precio = $error = '';

    $desactivado = 'disabled';
    $lectura = '';

    if($conn){

        //isset determina si la variable esta definida y no es nula
        if($_SERVER["REQUEST_METHOD"] == "POST"){    

            if(isset($_POST['eliminar'])){

                $sku_eliminar = mysqli_real_escape_string($conn,$_POST['sku']);

                $sql = "DELETE FROM escoba WHERE sku = '$sku_eliminar' ";

                // Guardar en la base de datos y revisar
                if(mysqli_query($conn, $sql)){

                    //Exito
                    //echo  'form es valido';

                }
                else{

                    //error
                    $error = 'Ocurrio un error inesperado, no se pudo eliminar la escoba';

                }

            }

        }       

    }
    else{

        $error = 'Error: '. mysqli_connect_error();

    }

    //Cierra la conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <?php 
    
        include("modelo/encabezado.php");

    ?>
    
    <h1 class="text-center text-secondary pb-5">Eliminar Escoba</h1>
    
    <form id="formulario" class="card shadow p-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <div class="text-danger"> <?php echo htmlspecialchars($error); ?></div>

        <div class="form-row">
                
            <div class="form-group col-md-6">
                    
                <label for="sku">SKU:</label>
                <input type="number" class="form-control" id="sku" name="sku" value="<?php echo htmlspecialchars($sku); ?>" <?php echo htmlspecialchars($lectura); ?>/>
                <div class="text-danger" id="errorSku"></div>

            </div>

            <a id="buscarEliminar" name="buscar" class="form-group col-md-6 btn btn-secondary btn-block text-light" style="min-width: 200px;">BUSCAR</a>

            
        </div>

        <div class="form-group">
                    
                <label for="marca">Marca:</label>
                <input type="number" class="form-control desactivado" id="marca" name="marca" value="<?php echo htmlspecialchars($marca); ?>" <?php echo htmlspecialchars($desactivado); ?> />
                <div class="text-danger" id="errorMarca"></div>    

        </div>

        <div class="form-row">
                        
            <div class="form-group col-md-6">

                <label for="tipo">Tipo:</label></label>
                <input type="number" class="form-control desactivado" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorTipo"> </div>

            </div>

            <div class="form-group col-md-6">

                <label for="material">Material ( separalos por una coma ):</label>
                <input type="text" class="form-control desactivado" id="material" name="material" value="<?php echo htmlspecialchars($material); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorMaterial"> </div>

            </div>

        </div>

        <div class="form-row">
                        
            <div class="form-group col-md-6">
                
                <label for="color">Color:</label>
                <input type="text" class="form-control desactivado" id="color" name="color" value="<?php echo htmlspecialchars($color); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorColor"> </div>

            </div>

            <div class="form-group col-md-6">
                
                <label for="largo">Largo (cm):</label>
                <input type="number" step="0.01" class="form-control desactivado" id="largo" name="largo" value="<?php echo htmlspecialchars($largo); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorLargo"> </div>

            </div>

        </div>

        <div class="form-row">
            
            <div class="form-group col-md-3">

                <label for="ancho">Ancho (cm):</label>
                <input type="number" step="0.01" class="form-control desactivado" id="ancho" name="ancho" value="<?php echo htmlspecialchars($ancho); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorAncho"> </div>

            </div>

            <div class="form-group col-md-3">
                        
                <label for="profundidad">Profundidad (cm):</label>
                <input type="number" step="0.01" class="form-control desactivado" id="profundidad" name="profundidad" value="<?php echo htmlspecialchars($profundidad); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorProfundidad"> </div>

            </div>

            <div class="form-group col-md-3">
                        
                <label for="peso">Peso (kg):</label>
                <input type="number" step="0.01" class="form-control desactivado" id="peso" name="peso" value="<?php echo htmlspecialchars($peso); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorPeso"> </div>

            </div>

            <div class="form-group col-md-3">
                        
                <label for="precio">Precio (MXN):</label>
                <input type="number" step="0.01" class="form-control desactivado" id="precio" name="precio" value="<?php echo htmlspecialchars($precio); ?>" <?php echo htmlspecialchars($desactivado); ?>/>
                <div class="text-danger" id="errorPrecio"> </div>

            </div>

        </div>

        <div class="form-group">
                        
            <label for="descripcion">Descripcion:</label>
            <textarea type="text" class="form-control desactivado" id="descripcion" name="descripcion" cols="40" rows="5" <?php echo htmlspecialchars($desactivado); ?>><?php echo htmlspecialchars($descripcion); ?></textarea>
            <div class="text-danger" id="errorDescripcion"> </div>

        </div>

        <div class="card-footer bg-white p-3 text-right text-center">

            <a href="index.php" class="btn btn-light" style="min-width: 200px;">REGRESAR</a>
            <a id='limpiar' class="btn btn-light" style="min-width: 200px;">LIMPIAR</a>
            <input type="submit" name="eliminar" value="ELIMINAR" class="btn btn btn-danger btn-desactivado" style="min-width: 200px;" <?php echo htmlspecialchars($desactivado); ?> />

        </div>

    </form>

    <?php 
            
        include("modelo/pie.php");

    ?>

</html>