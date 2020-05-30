
<?php 

   include("./configuracion/sesion.php");
   if($sesion){

      header('Location: index.php');

   }
   else{

      $email = $clave = '';
      $error = '';

      if($_SERVER["REQUEST_METHOD"] == "POST"){

         include('configuracion/conexion.php');

         $email = $_POST['email'];
         $clave = $_POST['clave'];

         if($conn){

            $sql = '';
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $clave = mysqli_real_escape_string($conn,$_POST['clave']);

            if(isset($_POST['ingresar'])){

               $sql = "SELECT email,clave FROM usuarios WHERE email='$email' and clave='$clave'";
               $error = 'El usuario o la contraseña son incorrecos';

            }
            else{
      
               $sql = "INSERT INTO usuarios(email,clave) values ('$email','$clave')";
               $error = 'El usuario ya existe';

            }

            $resultado = mysqli_query($conn,$sql);

            if($resultado){

               $error = "";
               session_start();
               $_SESSION["sesion"] = $email;
               header('Location: index.php');

            }


         }
         else{

            $error = 'Error: '. mysqli_connect_error();

         }

         mysqli_close($conn);

      }

   }

?>

<!DOCTYPE html>

<html>

<head>

   <title>DulceriaLeo</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"/>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
   <script src="../recursos/js/jquery.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <script src="../recursos/js/inicioSecion.js"></script>
   <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="../recursos/css/inicioSesion.css"/>

</head>

<body>

   <div class="sidenav">
         
         <div class="login-main-text">

         <h2 style="font-family: 'Rock Salt', cursive;">
         
            Escobas Leo
            
         </h2>

         <br> 
         <br/>

         <h2>
            
            Iniciar Sesion
            
         </h2>
         
         <br/> 
         <p>Inicie Sesion o registrese aqui para tener acceso al sistema.</p>
      
      </div>
   
   </div>
   
   <div class="main">
      
      <div class="col-md-6 col-sm-12">
         
         <div class="login-form">

            <div class="text-danger"><?php echo $error;?></div>
            
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
   
               <div class="form-group">
   
                  <label>Email</label>
                  <input id="email" name="email" type="text" class="form-control" placeholder="Correo electronico" value="<?php echo htmlspecialchars($email); ?>">
                  <div id="errorEmail" class="text-danger"></div>

               </div>
               
               <div class="form-group">

                  <label>Contraseña</label>
                  <input id="clave" name="clave" type="password" class="form-control" placeholder="Contraseña" value="<?php echo htmlspecialchars($clave); ?>">
                  <div id="errorClave" class="text-danger"></div>

               </div>
      
               <input id="ingresar" name="ingresar" type="submit" class="btn btn-black" value="Ingresar" />
               <input id="registrar" name="registrar" type="submit" class="btn btn-secondary" value="Registrarse" />
            
            </form>
         
         </div>
      
      </div>
   
   </div>

</body>

</html>