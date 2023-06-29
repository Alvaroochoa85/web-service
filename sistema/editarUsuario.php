<?php

    include "../conexion.php";

    if(!empty($_POST)){
       $alert = ''; 
       if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])){
            $alert ='<p class="msg_error">Todos los campos son obligatorios<p/>';
       }else{
            //Conexion a la base de datos
            
            //preparacion de valores de los campos
            $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
            $email = mysqli_real_escape_string($conexion, $_POST['correo']);
            $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
            $clave = md5 (mysqli_real_escape_string($conexion, $_POST['clave']));
            $rol = mysqli_real_escape_string($conexion, $_POST['rol']);

            //Contrucion de la consulta INSERT utilizando mysqli_field
            $query = "INSERT INTO usuario(nombre, correo, usuario, clave, rol)
                    VALUES ('$nombre','$email','$user','$clave','$rol')";
                   
            //ejecucion de la consulta
            if(mysqli_query($conexion,$query)){
                $alert='<p class="msg_save">Usuario creado correctamente.</p>';
            }else{
                $alert='<p class="msg_error">Error al crear usuario.';
            }
           
       }        
    }
    //Mostrar datos
    if(empty($_GET['id'])){
        header('Location: listaUsuario.php');
    }
    $iduser = $_GET['id'];
    $sql = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) as idrol, (r.rol) as rol 
                                    FROM usuario u 
                                    INNER JOIN rol r 
                                    ON u.rol = r.idrol 
                                    WHERE idusuario = $iduser");
    $resultSql = mysqli_num_rows($sql); // la consulta devuelve el nuemro de filas                                  

    if($resultSql = 0){
        header('Location: listaUsuario.php');
    }else{
        $option = '';
        while($data  = mysqli_fetch_array($sql)){
            $iduser  = $data['idusuario'];
            $nombre  = $data['nombre'];
            $correo  = $data['correo'];
            $usuario = $data['usuario'];
            $idrol   = $data['idrol'];
            $rol     = $data['rol'];

            if($idrol == 1){
                $option ='<option value="'.$idrol.'"select>'.$rol.'</option>';
            }elseif($idrol == 2){
                $option ='<option value="'.$idrol.'"select>'.$rol.'</option>';
            }elseif($idrol == 3){
                $option ='<option value="'.$idrol.'"select>'.$rol.'</option>';
            }
        }
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php";?>
	<title>Actualizar Usuario</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<div class="form_register">
            <h1>Actualizar Usuario</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert :''; ?></div>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ;?>" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electronico</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo ;?>">
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario ;?>">
                </div>
                <div class="mb-3">
                    <label for="clave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="clave" name="clave">
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Tipo de Usuario</label>

                    <?php 
                       
                        $query_rol = mysqli_query($conexion, "SELECT * FROM rol");
                        $result_rol = mysqli_num_rows($query_rol); //cuenta las filas que devulve de la consulta.
                        
                    ?>
                    <select name="rol" id="rol" class="form-select" aria-label="Default select example">
                        <?php
                            echo $option; 
                            if($result_rol > 0){
                                while($rol = mysqli_fetch_array($query_rol)){
                        ?>
                            <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                        <?php    
                                }
                            }
                        ?>
                    </select>
                </div>    
                <input type="submit" class="btn btn-primary" value="Actualizar Usuario"></input>
            </form>
        </div>
	</section>
	<?php include "includes/footer.php";?>
</body>
</html>