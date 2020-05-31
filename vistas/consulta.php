<?php 

    include('./configuracion/conexion.php');

    $sku = $_POST['sku'];

    $sql = "SELECT * FROM escoba WHERE sku = $sku ";

    $resultado = mysqli_query($conn,$sql);

    $escoba = mysqli_fetch_assoc($resultado);

    echo json_encode($escoba);

?>