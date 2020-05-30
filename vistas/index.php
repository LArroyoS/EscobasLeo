<?php 

    include('./configuracion/conexion.php');

    $error="";

    if($conn){

        $sql = "SELECT marca,tipo,material,color,precio,sku FROM escoba ORDER BY created_at";

        $resultado = mysqli_query($conn,$sql);

        $escobas = mysqli_fetch_all($resultado,MYSQLI_ASSOC);

        mysqli_free_result($resultado);

    }
    else{

        $error = 'Error: '. mysqli_connect_error();

    }

    mysqli_close($conn);

?>
<!DOCTYPE html>
<html>

    <?php 
    
        include("modelo/encabezado.php");

    ?>

    <div class="text-danger"> <?php echo htmlspecialchars($error); ?></div>
    <h1 class="text-center text-secondary pb-5">Escobas</h1>

    <div class="container">
    
        <?php if(count($escobas) == 0): ?>

            <h1 class="text-center">No hay datos</h1>

        <?php else: ?>

            <div class="row">
                
                <?php foreach($escobas as $escoba): ?>

                    <div class="col s6 md3">
                    
                        <div class="card shadow">
                        
                            <img class="escoba" src="../recursos/img/icon-escoba.png" />

                            <div class="card-body text-center">

                                <h4> <?php echo htmlspecialchars($escoba['marca']); ?> </h4>

                                <h4>
                                
                                    <?php 
                                    
                                        echo htmlspecialchars( $escoba['tipo'].' '.$escoba['material'].' '.$escoba['color'] );

                                    ?>

                                </h4>

                                <h6> <?php echo htmlspecialchars('SKU: '.$escoba['sku']); ?> </h6>

                                <h2> <?php echo htmlspecialchars('$'.$escoba['precio']); ?> </h2>

                            </div>

                            <div class="card-footer bg-white text-right">
                            
                                <a class="brand-text escoba-text-color" href="detalles.php?id=<?php echo $escoba['sku']; ?>">MAS INFORMACIÓN</a>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

    <?php 
        
        include("modelo/pie.php");

    ?>

</html>
