<?php 

    include('./configuracion/conexion.php');

    $error="";

    if($conn){

        $sql = "SELECT marcas.marca,tipo.tipo,material,
        color,precio,sku, imagen FROM escoba 
        INNER JOIN marcas on marcas.id = escoba.marca 
        INNER JOIN tipo on tipo.id = escoba.tipo 
        ORDER BY created_at";

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
                        
                            <img class="escoba imagen" 
                            src="<?php 
                                if($escoba['imagen']!=''){

                                    echo htmlspecialchars($escoba['imagen']);

                                }
                                else{

                                    echo '../recursos/img/icon-escoba.png';

                                }
                            ?>" 
                            alt="<?php echo htmlspecialchars($escoba['marca']); ?>" />

                            <div class="card-body text-center">

                                <h4> <?php echo htmlspecialchars($escoba['marca']); ?> </h4>

                                <h4> <?php echo htmlspecialchars($escoba['tipo']); ?> </h4>
                                <h4>

                                    <?php 
                                        
                                        $materiales = '';
                                        foreach(explode(' ',$escoba['material']) as $mat){
                                                                        
                                            $materiales = $materiales.$mat."/";

                                        }

                                        echo (($materiales!='')? htmlspecialchars(substr($materiales,0,-1)):$materiales);

                                    ?>

                                </h4>
                                <h4> <?php echo htmlspecialchars($escoba['color']); ?> </h4>

                                <h6> <?php echo htmlspecialchars('SKU: '.$escoba['sku']); ?> </h6>

                                <h2> <?php echo htmlspecialchars('$'.$escoba['precio']); ?> </h2>

                            </div>

                            <div class="card-footer bg-white text-right">
                            
                                <a class="brand-text escoba-text-color" href="detalles.php?sku=<?php echo  htmlspecialchars($escoba['sku']); ?>">MAS INFORMACIÓN</a>

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
