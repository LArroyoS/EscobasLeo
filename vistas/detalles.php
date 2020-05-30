<?php

    include('./configuracion/conexion.php');

    $escoba = null;
    $error = "";

    if($conn){

        //isset determina si la variable esta definida y no es nula
        if($_SERVER["REQUEST_METHOD"] == "POST"){    

            $sku_eliminar = mysqli_real_escape_string($conn,$_POST['sku']);
            // crear sql
            $sql = "DELETE FROM escoba WHERE sku = '$sku_eliminar' ";

            // Guardar en la base de datos y revisar
            if(mysqli_query($conn, $sql)){

                header('Location: index.php');

            }
            else{

                //error
                $error = 'Ocurrio un error inesperado';

            }

        }

        if(isset($_GET['sku'])){

            $sku = mysqli_real_escape_string($conn,$_GET['sku']);

            $sql = "SELECT * FROM escoba WHERE sku = $sku ";

            $resultado = mysqli_query($conn,$sql);

            $escoba = mysqli_fetch_assoc($resultado);

            mysqli_free_result($resultado);

        }    

    }
    else{

        $error = 'Error: '. mysqli_connect_error();

    }

    $Botones = '<a href="index.php" class="btn btn-light" style="min-width: 200px;">REGRESAR</a>';

    //Cierra la conexión
    mysqli_close($conn);

?>

<!DOCTYPE html>

<html>

    <?php 
    
        include("modelo/encabezado.php");

    ?>
    
    <h1 class="text-center text-secondary pb-5">Detalle de Escoba</h1>
    
    <form class="card shadow p-4" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

        <?php if($escoba): ?>

            <div class="text-danger"> <?php echo htmlspecialchars($error); ?></div>

            <div class="form-row">
                    
                <div class="form-group col-md-6">
                        
                    <label for="sku">SKU:</label>
                    <input type="number" class="form-control" id="sku" name="sku" value="<?php echo htmlspecialchars($escoba['sku']); ?>" readonly="true"/>

                </div>
                            
                <div class="form-group col-md-6">
                        
                    <label for="marca">Marca:</label>
                    <input type="number" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($escoba['marca']); ?>" disabled="true"/>  

                </div>
                
            </div>

            <div class="form-row">
                            
                <div class="form-group col-md-6">

                    <label for="tipo">Tipo:</label></label>
                    <input type="number" class="form-control" id="tipo" name="tipo" value="<?php echo htmlspecialchars($escoba['tipo']); ?>" disabled="true"/>

                </div>

                <div class="form-group col-md-6">

                    <label for="material">Material ( separalos por un / ):</label>
                    <input type="text" class="form-control" id="material" name="material" value="<?php echo htmlspecialchars($escoba['material']); ?>" disabled="true"/>

                </div>

            </div>

            <div class="form-row">
                            
                <div class="form-group col-md-6">
                    
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" id="color" name="color" value="<?php echo htmlspecialchars($escoba['color']); ?>" disabled="true"/>

                </div>

                <div class="form-group col-md-6">
                
                    <label for="largo">Largo:</label>
                    <input type="number" step="0.01" class="form-control" id="largo" name="largo" value="<?php echo htmlspecialchars($escoba['largo']); ?>" disabled="true"/>

                </div>

            </div>

            <div class="form-row">
                            
                <div class="form-group col-md-3">

                    <label for="ancho">Ancho:</label>
                    <input type="number" step="0.01" class="form-control" id="ancho" name="ancho" value="<?php echo htmlspecialchars($escoba['ancho']); ?>" disabled="true"/>

                </div>

                <div class="form-group col-md-3">
                            
                    <label for="profundidad">Profundidad:</label>
                    <input type="number" step="0.01" class="form-control" id="profundidad" name="profundidad" value="<?php echo htmlspecialchars($escoba['profundidad']); ?>" disabled="true"/>

                </div>

                <div class="form-group col-md-3">
                            
                    <label for="peso">Peso:</label>
                    <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="<?php echo htmlspecialchars($escoba['peso']); ?>" disabled="true"/>

                </div>

                <div class="form-group col-md-3">
                            
                    <label for="precio">Precio:</label>
                    <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo htmlspecialchars($escoba['precio']); ?>" disabled="true"/>

                </div>

            </div>

            <div class="form-group">
                            
                <label for="descripcion">Descripcion:</label>
                <textarea type="text" class="form-control" id="descripcion" name="descripcion" cols="40" rows="5" disabled="true"><?php echo htmlspecialchars($escoba['descripcion']); ?></textarea>

            </div>

            <?php 
            
                $Botones = $Botones.'<input type="submit" name="eliminar" value="ELIMINAR" class="btn btn btn-danger" style="min-width: 200px;">'
                            .'<input type="submit" name="modificar" value="MODIFICAR" class="btn btn-success" style="min-width: 200px;">';

            ?>

        <?php else: ?>

            <h1>¡La Escoba que usted busca no existe!</h1>

        <?php endif; ?>

        <div class="card-footer bg-white p-3 text-right text-center">

            <?php echo $Botones; ?>

        </div>

    </form>

    <?php 
            
        include("modelo/pie.php");

    ?>

</html>