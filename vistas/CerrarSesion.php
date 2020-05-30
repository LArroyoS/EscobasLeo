<?php 

    include("./configuracion/sesion.php");
    if($sesion){

        session_unset();
        session_destroy();
        header('Location: InicioSesion.php');

    }

?>