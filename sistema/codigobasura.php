if(isset($_POST['registrar'])){
        if(
            strlen($_POST['nombre']) >= 1 &&
            strlen($_POST['correo']) >= 1 &&
            strlen($_POST['usuario']) >= 1 &&
            strlen($_POST['clave']) >= 1 &&
            strlen($_POST['rol']) >= 1 
        )  { 
                $name = trim($_POST['nombre']);
                $email = trim($_POST['correo']);
                $user = trim($_POST['usuario']);
                $clave = trim($_POST['clave']);
                $rol = trim($_POST['rol']);

                $query = "INSERT INTO usuario(nombre,correo,usuario,clave,rol) 
                          VALUES ('$name','$email','$user','$clave','$rol')";
                $result = mysqli_query($conexion,$query);
                if($result){
                    $alert='<p class="msg_save">Usuario creado correctamente.</p>';
                }else{
                    $alert='<p class="msg_error">Error al crear usuario.</p>';
                }


        }

}

    

<?php

   // if(!empty($_POST)){
     //  $alert = ''; 
       //if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])){
        //    $alert ='<p class="msg_error">Todos los campos son obligatorios<p/>';
      // }else{
        //    include "../conexion.php";
            
          //  $nombre = $_POST['nombre'];
          //  $email = $_POST['correo'];
          //  $user = $_POST['usuario'];
          //  $clave = $_POST['clave'];
          //  $rol = $_POST['rol'];

          //  $query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'");
          //  $result = mysqli_fetch_array($query);

          //  if($result > 0){
          //      $alert ='<p class="msg_error">El correo o el usuario ya existe.</p>';        
          //  }else{
          //      $query_insert = mysqli_query($conexion,"INSERT INTO usuario(nombre,correo,usuario,clave,rol) 
            //                                VALUES ('$nombre','$email','$user','$clave','$rol')");
              //  
             //   if($query_insert){   
               //     $alert='<p class="msg_save">Usuario creado correctamente.</p>';        
              //  }else{
                //    $alert='<p class="msg_error">Error al crear usuario.</p>';        
              //  }
           // }
      // }        
  //  }

?>    