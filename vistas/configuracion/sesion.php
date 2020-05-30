<?php 

    session_start();
    $usuario = '';
    $sesion = isset($_SESSION['sesion']);
    if($sesion){

        $usuario = $_SESSION['sesion'];

    }

?>