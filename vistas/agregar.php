<?php

    include('./configuracion/conexion.php');

    $sku = $marca = $color = $material = $descripcion = $tipo = '';
    $largo = $ancho = $profundidad = $peso = $precio = $error = $ruta = '';

    if($conn){

        //isset determina si la variable esta definida y no es nula
        if($_SERVER["REQUEST_METHOD"] == "POST"){    

            if(isset($_POST['enviar'])){

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
                
                if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK ){

                    $nombreArchivo = $_FILES['imagen']['name'];
                    $nombreArchivoCmps = explode('.',$nombreArchivo); 
                    $extension = strtolower(end($nombreArchivoCmps));
                    $ruta = "../recursos/img/$sku.$extension";
                    move_uploaded_file($_FILES['imagen']['tmp_name'],$ruta);

                }
                
                // crear sql
                $sql = "INSERT INTO escoba
                        (sku,marca,color,material,descripcion,tipo,largo,ancho,
                        profundidad,peso,precio,imagen) values 
                        ('$sku','$marca','$color','$material','$descripcion',
                        '$tipo','$largo','$ancho','$profundidad','$peso',
                        '$precio','$ruta')";

                // Guardar en la base de datos y revisar
                if(mysqli_query($conn, $sql)){

                    //Exito
                    //echo  'form es valido';
                    header('Location: index.php');

                }
                else{

                    //error
                    $error = 'Ocurrio un error inesperado, no se pudo modificar la escoba';

                }

            }

        }
        
        //marcas
        $sql = "SELECT * FROM marcas";
        $resultado = mysqli_query($conn,$sql);
        $marcas = mysqli_fetch_all($resultado,MYSQLI_ASSOC);

        mysqli_free_result($resultado);

        $sql = "SELECT * FROM tipo";
        $resultado = mysqli_query($conn,$sql);
        $tipos = mysqli_fetch_all($resultado,MYSQLI_ASSOC);

        mysqli_free_result($resultado);

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
    
    <form id="formulario" class="card shadow p-4 mt-5" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

        <img id="imagen-vista" class="escoba-formulario imagen" src="../recursos/img/insertar.png" alt="Haga clic para añadir una imagen" />
        <input type="file" name="imagen" id="imagen" style="display:none;" accept="image/*"/>
        <div class="text-danger text-center" id="errorImagen"></div>
        
        <div class="card-body">

            <div class="text-danger"> <?php echo htmlspecialchars($error); ?></div>
    
            <div class="form-row">
                    
                <div class="form-group col-md-6">
                        
                    <label for="sku">SKU:</label>
                    <input type="number" class="form-control" id="sku" name="sku" value="<?php echo htmlspecialchars($sku); ?>" />
                    <div class="text-danger" id="errorSku"></div>

                </div>
                            
                <div class="form-group col-md-6">
                        
                    <label for="marca">Marca:</label>
                    <select class="form-control" id="marca" name="marca">

                        <option value="">Seleccione una marca</option>
                        <?php foreach($marcas as $marca):?>

                            <option value="<?php echo htmlspecialchars($marca['id']); ?>"><?php echo htmlspecialchars($marca['marca']); ?></option>
                        
                        <?php endforeach; ?>

                    </select>
                    <div class="text-danger" id="errorMarca"></div>    

                </div>
                
            </div>

            <div class="form-row">
                            
                <div class="form-group col-md-6">

                    <label for="tipo">Tipo:</label></label>
                    <select class="form-control" id="tipo" name="tipo">

                        <option value="">Seleccione un tipo</option>
                        <?php foreach($tipos as $tipo):?>

                            <option value="<?php echo htmlspecialchars($tipo['id']); ?>"><?php echo htmlspecialchars($tipo['tipo']); ?></option>

                        <?php endforeach; ?>

                    </select>
                    <div class="text-danger" id="errorTipo"> </div>

                </div>

                <div class="form-group col-md-6">

                    <label for="material">Material ( separalos por una coma ):</label>
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
                
                    <label for="largo">Largo (cm):</label>
                    <input type="number" step="0.01" class="form-control" id="largo" name="largo" value="<?php echo htmlspecialchars($largo); ?>" />
                    <div class="text-danger" id="errorLargo"> </div>

                </div>

            </div>

            <div class="form-row">
                            
                <div class="form-group col-md-3">

                    <label for="ancho">Ancho (cm):</label>
                    <input type="number" step="0.01" class="form-control" id="ancho" name="ancho" value="<?php echo htmlspecialchars($ancho); ?>" />
                    <div class="text-danger" id="errorAncho"> </div>

                </div>

                <div class="form-group col-md-3">
                            
                    <label for="profundidad">Profundidad (cm):</label>
                    <input type="number" step="0.01" class="form-control" id="profundidad" name="profundidad" value="<?php echo htmlspecialchars($profundidad); ?>" />
                    <div class="text-danger" id="errorProfundidad"> </div>

                </div>

                <div class="form-group col-md-3">
                            
                    <label for="peso">Peso (kg):</label>
                    <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($peso); ?>" />
                    <div class="text-danger" id="errorPeso"> </div>

                </div>

                <div class="form-group col-md-3">
                            
                    <label for="precio">Precio (MXN):</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($precio); ?>" />
                    <div class="text-danger" id="errorPrecio"> </div>

                </div>

            </div>

            <div class="form-group">
                            
                <label for="descripcion">Descripcion:</label>
                <textarea type="text" class="form-control" id="descripcion" name="descripcion" cols="40" rows="5"><?php echo htmlspecialchars($descripcion); ?></textarea>
                <div class="text-danger" id="errorDescripcion"> </div>

            </div>

        </div>

        <div class="card-footer bg-white p-3 text-right text-center">

            <a href="index.php" class="btn boton btn-light" >REGRESAR</a>
            <input type="submit" class="btn boton btn-success"  value="GUARDAR" id="enviar" name="enviar"/>

        </div>

    </form>

    <?php 
            
        include("modelo/pie.php");

    ?>

</html>