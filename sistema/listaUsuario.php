<?php
	include"../conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ;?>
	<title>Lista de Usuarios</title>
</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		<h1>Lista de Usuarios</h1>
		<a href="registroUsuario.php" class="btn btn-success">Crear Usuario</a>
		<table class="table table-dark table-striped">
			<thead>
				<tr>
					<th scope="col">id</th>
					<th scope="col">Nombre</th>
					<th scope="col">Correo</th>
					<th scope="col">Usuario</th>
					<th scope="col">Rol</th>
					<th scope="col">Acciones</th>
				</tr>
				<?php
					$query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol 
													  FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
					$result = mysqli_num_rows($query);
					if($result >0){
						while($data = mysqli_fetch_array($query)){
				?>			
			</thead>
				<tbody>
					<tr>
						<td><?php echo $data["idusuario"] ?></td>
						<td><?php echo $data["nombre"] ?></td>
						<td><?php echo $data["correo"] ?></td>
						<td><?php echo $data["usuario"] ?></td>
						<td><?php echo $data["rol"] ?></td>
						<td>
							<a class="linkEdit" href="editarUsuario.php?id=<?php echo $data["idusuario"] ?>">Editar</a>
							<a class="linkDel" href="#">Eliminar</a>
						</td>
					</tr>
				<?php	
					}
				}
			?>		
				</tbody>
		</table>
	</section>

	<?php include "includes/footer.php";?>
</body>
</html>