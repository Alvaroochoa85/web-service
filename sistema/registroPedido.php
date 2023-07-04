<?php
include "../conexion.php";

// Función para cambiar el estado del pedido
function cambiar_estado_pedido($nuevo_estado, $id_pedido) {
    global $conexion;
    $query_estado = "UPDATE estado SET desc_estado = '$nuevo_estado' WHERE id_pedido = '$id_pedido'";
    mysqli_query($conexion, $query_estado);
}

// Función para obtener el estado actual del pedido
function obtener_estado_pedido($id_pedido) {
    global $conexion;
    $query_estado = "SELECT desc_estado FROM estado WHERE id_pedido = '$id_pedido'";
    $resultado = mysqli_query($conexion, $query_estado);
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['desc_estado'];
    }
    return false;
}

if (!empty($_POST)) {
    $obs = $_POST['observacion'];
    $desc_falla = $_POST['desc_falla'];
    $fecha = $_POST['fecha'];
    $id_cliente = $_POST['id_cliente'];
    $nuevo_estado = $_POST['estado'];

    $query = "INSERT INTO pedido (observacion, desc_falla, fecha, id_cliente, estado)
              VALUES ('$obs', '$desc_falla', '$fecha', '$id_cliente', '$nuevo_estado')";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        echo '<p class="msg_Save">Pedido creado correctamente.</p>';
        $id_pedido = mysqli_insert_id($conexion);

        $estado = 'Abierto';
        $query_estado = "INSERT INTO estado (desc_estado, id_pedido) VALUES ('$estado', '$id_pedido')";
        mysqli_query($conexion, $query_estado);

        cambiar_estado_pedido($nuevo_estado, $id_pedido);
    } else {
        echo '<p class="msg_error">Error al crear el pedido.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include "includes/scripts.php"; ?>
    <title>Registro de Pedidos</title>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <section id="container">
        <div class="form_register">
            <h1>Registro de Pedidos</h1>
            <hr>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="observacion" class="form-label">Observacion</label>
                    <textarea class="form-control" name="observacion" id="observacion" cols="20" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="desc_falla" class="form-label">Descripcion de la falla</label>
                    <textarea class="form-control" name="desc_falla" id="desc_falla" cols="10" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha del pedido</label>
                    <input type="date" class="form-control" name="fecha" id="fecha" required>
                </div>
                <div class="mb-3">
                    <label for="id_cliente" class="form-label">ID del cliente</label>
                    <input type="text" class="form-control" name="id_cliente" id="id_cliente" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-control" name="estado" id="estado" required>
                        <?php
                        $estados_posibles = array(
                            "Abierto",
                            "Verificado",
                            "En Reparación",
                            "Demorado",
                            "No Reparado",
                            "Reparado",
                            "Despachado"
                        );
                        foreach ($estados_posibles as $estado) {
                            echo "<option value=\"$estado\">$estado</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Crear Pedido">
            </form>
        </div>
    </section>
    <?php include "includes/footer.php"; ?>
</body>
</html>