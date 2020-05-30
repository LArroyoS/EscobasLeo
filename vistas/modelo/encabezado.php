<?php 

    include("./configuracion/sesion.php");
    if(!$sesion){

        header('Location: /Dulceria/vistas/InicioSesion.php');

    }

?>

<head>

    <title>Escobas-Leo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script src="../recursos/js/jquery.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="../recursos/css/estilo.css?1.0" />
    <script src="../recursos/js/escoba.js"></script>    

</head>

<body>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        
        <!-- Brand -->
        <a class="navbar-brand" 
        style="font-family: 'Rock Salt', cursive;" href="/Dulceria/vistas/InicioSesion.php">Escobas Leo</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            
            <span class="navbar-toggler-icon"></span>
            
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="nav navbar-nav ml-auto">

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        
                        Escobas
                    
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        
                        <a class="dropdown-item" href="agregar.php">Agregar</a>
                        <a class="dropdown-item" href="modificar.php">Modificar</a>
                        <a class="dropdown-item" href="eliminar.php">Eliminar</a>

                    </div>

                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                        
                        <span class="glyphicon glyphicon-log-in"></span> 
                        <?php echo htmlspecialchars($usuario);?>
                        
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">

                        <a class="dropdown-item" href="<?php echo htmlspecialchars('CerrarSesion.php'); ?>">Cerrar Sesion</a>
                    
                    </div>

                </li>
            
            </ul>

        </div>

    </nav>

    <div class="container-fluid text-center">