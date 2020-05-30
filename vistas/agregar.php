<?php

    include('./configuracion/conexion.php');

    $sku = $marca = $color = $material = $descripcion = $tipo = '';
    $largo = $ancho = $profundidad = $peso = $precio = $error = '';

    if($conn){

        //isset determina si la variable esta definida y no es nula
        if($_SERVER["REQUEST_METHOD"] == "POST"){    

            if(isset($_POST['eliminar'])){

                $sku = mysqli_real_escape_string($conn,$_POST['sku']);
                $marca = mysqli_real_escape_string($conn,$_POST['marca']); 
                $color = mysqli_real_escape_string($conn,$_POST['color']);
                $material = mysqli_real_escape_string($conn,$_POST['material']);
                $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);
                $tipo = mysqli_real_escape_string($conn,$_POST['tipo']);
                $largo = mysqli_real_escape_string($conn,$_POST['largo']);
                $ancho = mysqli_real_escape_string($conn,$_POST['ancho']);
                $profundidad = mysqli_real_escape_string($conn,$_POST['profundidad']);
                $peso = mysqli_real_escape_string($conn,$_POST['peso']);
                $precio = mysqli_real_escape_string($conn,$_POST['precio']);
                // crear sql
                $sql = "INSERT INTO escoba
                        (sku,marca,color,material,descripcion,tipo,largo,ancho,
                        profundidad,peso,precio) values 
                        ('$sku','$marca','$color','$material','$descripcion',
                        '$tipo','$largo','$ancho','$profundidad','$peso',
                        '$precio')";

                // Guardar en la base de datos y revisar
                if(mysqli_query($conn, $sql)){

                    //Exito
                    //echo  'form es valido';
                    header('Location: index.php');

                }
                else{

                    //error
                    $error = 'El SKU ya existe';

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
    
    <h1 class="text-center text-secondary pb-5">Agregar una Escoba</h1>
    
    <form id="formulario" class="card shadow p-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <div class="text-danger"> <?php echo htmlspecialchars($error); ?></div>

        <div class="form-row">
                
            <div class="form-group col-md-6">
                    
                <label for="sku">SKU:</label>
                <input type="number" class="form-control" id="sku" name="sku" value="<?php echo htmlspecialchars($sku); ?>" />
                <div class="text-danger" id="errorSku"></div>

            </div>
                        
            <div class="form-group col-md-6">
                    
                <label for="marca">Marca:</label>
                <input type="number" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($marca); ?>" />
                <div class="text-danger" id="errorMarca"></div>    

            </div>
            
        </div>

        <div class="form-row">
                        
            <div class="form-group col-md-6">

                <label for="tipo">Tipo:</label></label>
                <input type="number" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>" />
                <div class="text-danger" id="errorTipo"> </div>

            </div>

            <div class="form-group col-md-6">

                <label for="material">Material ( separalos por un / ):</label>
                <input type="text" class="form-control" id="material" name="material" value="<?php echo htmlspecialchars($material); ?>" />
                <div class="text-danger" id="errorMaterial"> </div>

            </div>

        </div>

        <div class="form-row">
                        
            <div class="form-group col-md-6">
                
                <label for="color">Color:</label>
                <input type="text" class="form-control" id="color" name="color" value="<?php echo htmlspecialchars($color); ?>" />
                <div class="text-danger" id="errorColor"> </div>

            </div>

            <div class="form-group col-md-6">
            
                <label for="largo">Largo:</label>
                <input type="number" step="0.01" class="form-control" id="largo" name="largo" value="<?php echo htmlspecialchars($largo); ?>" />
                <div class="text-danger" id="errorLargo"> </div>

            </div>

        </div>

        <div class="form-row">
                        
            <div class="form-group col-md-3">

                <label for="ancho">Ancho:</label>
                <input type="number" step="0.01" class="form-control" id="ancho" name="ancho" value="<?php echo htmlspecialchars($ancho); ?>" />
                <div class="text-danger" id="errorAncho"> </div>

            </div>

            <div class="form-group col-md-3">
                        
                <label for="profundidad">Profundidad:</label>
                <input type="number" step="0.01" class="form-control" id="profundidad" name="profundidad" value="<?php echo htmlspecialchars($profundidad); ?>" />
                <div class="text-danger" id="errorProfundidad"> </div>

            </div>

            <div class="form-group col-md-3">
                        
                <label for="peso">Peso:</label>
                <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($peso); ?>" />
                <div class="text-danger" id="errorPeso"> </div>

            </div>

            <div class="form-group col-md-3">
                        
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($precio); ?>" />
                <div class="text-danger" id="errorPrecio"> </div>

            </div>

        </div>

        <div class="form-group">
                        
            <label for="descripcion">Descripcion:</label>
            <textarea type="text" class="form-control" id="descripcion" name="descripcion" cols="40" rows="5"><?php echo htmlspecialchars($descripcion); ?></textarea>
            <div class="text-danger" id="errorDescripcion"> </div>

        </div>

        <div class="card-footer bg-white p-3 text-right text-center">

            <a href="index.php" class="btn btn-light" style="min-width: 200px;">REGRESAR</a>
            <input type="submit" class="btn btn-success" style="min-width: 200px;" value="GUARDAR" id="enviar" name="enviar"/>

        </div>

    </form>

    <?php 
            
        include("modelo/pie.php");

    ?>

</html>