<?php
  $alert = '';
session_start();
  if(!empty($_SESSION['active'])){//Si la session no esta vacia, activarala
    header('location: sistema/');// redirecciona la pagina al inicio
  }else{  
    if(!empty($_POST)){
      if(empty($_POST['usuario']) || empty($_POST['clave'])){
        $alert = 'ingrese Usuario y Contraseña';
      }else{
        require_once ("./conexion.php");
        $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $pass = md5(mysqli_real_escape_string($conexion, $_POST['clave']));//se encripta la contraseña

        $query = mysqli_query($conexion, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass' ");
        $result = mysqli_num_rows($query);

        if($result > 0){
          $data = mysqli_fetch_array($query);
          
          $_SESSION['active'] = true;
          $_SESSION['idUser'] = $data['idusuario'];
          $_SESSION['nombre'] = $data['nombre'];
          $_SESSION['email'] = $data['correo'];
          $_SESSION['user'] = $data['usuario'];
          $_SESSION['rol'] = $data['rol'];

          header('location: sistema/');

        }else{
          $alert = 'El usuario o la clave son incorrectos'; 
          session_destroy();
        }
      }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebService</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a948818624.js" crossorigin="anonymous"></script>
</head>
<body>
  <section id="container">
    <form action="" method="post">
       <h3>Iniciar Sesion</h3>
       <img src="./img/login.png" alt="Login">
       <input type="text" name="usuario" placeholder="Usuario">
       <input type="password" name="clave" placeholder="Contraseña">
       <div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>
       <input type="submit" value="Ingresar">
    </form>
  </section>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
