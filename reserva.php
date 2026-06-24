<?php
include("conexion.php");

$sql_reservas = "SELECT reserva.id_reserva, reserva.fecha_reserva, reserva.fecha_expiracion, reserva.estado_reserva, usuario.nombre, usuario.apellido FROM reserva JOIN usuario ON reserva.id_usuario_fk = usuario.id_usuario";


$resultado_reservas = mysqli_query($conexion, $sql_reservas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 20px; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: white; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: center; }
        a { text-decoration: none; }
    </style>
</head>
<body>
    <a href="abm.php"><h1>Inicio</h1></a>
    <h1>ABM Reservas - PHP</h1>

    <?php while($reserva = mysqli_fetch_assoc($resultado_reservas)) { ?>

        <h3>
            Reserva #<?= $reserva['id_reserva'] ?> - 
            <?= $reserva['nombre'] ?> <?= $reserva['apellido'] ?> - 
            <?= $reserva['estado_reserva'] ?>
            | <a href="editar_reserva.php?id=<?= $reserva['id_reserva'] ?>">Editar</a>
            | <a href="eliminar_reserva.php?id=<?= $reserva['id_reserva'] ?>">Eliminar</a>
        </h3>
        <p>Fecha reserva: <?= $reserva['fecha_reserva'] ?> | Expira: <?= $reserva['fecha_expiracion'] ?></p>

        <table>
            <tr>
                <td>Producto</td>
                <td>Talle</td>
            </tr>
            <?php
            $id_reserva = $reserva['id_reserva'];
            $sql_detalle = "SELECT productos.nombre_producto, producto_variante.talle FROM detalle_reserva JOIN producto_variante ON detalle_reserva.id_variante_fk = producto_variante.id_variante
                            JOIN productos ON producto_variante.id_producto_fk = productos.id_producto WHERE detalle_reserva.id_reserva_fk = '$id_reserva'";
            $resultado_detalle = mysqli_query($conexion, $sql_detalle);
            while($detalle = mysqli_fetch_assoc($resultado_detalle)) { ?>
            <tr>
                <td><?= $detalle['nombre_producto'] ?></td>
                <td><?= $detalle['talle'] ?></td>
            </tr>
            <?php } ?>
        </table>

    <?php } ?>

</body>
</html>