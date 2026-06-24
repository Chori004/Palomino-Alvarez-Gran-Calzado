<?php
include("conexion.php");

$sql_pedidos = "SELECT pedido.id_pedido, pedido.fecha_pedido, pedido.estado_pedido, pedido.fecha_entrega_estimada, usuario.nombre, usuario.apellido, transporte.empresa
                FROM pedido JOIN usuario ON pedido.id_usuario_fk = usuario.id_usuario JOIN transporte ON pedido.empresa_transporte_fk = transporte.id_transporte";

$resultado_pedidos = mysqli_query($conexion, $sql_pedidos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>

        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            padding: 10px;
            margin-top: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        a {
            text-decoration: none;
        }

    </style>
    <a href="abm.php"><h1>Inicio</h1></a>
    <h1>ABM Pedidos - PHP</h1>

    <?php while($pedido = mysqli_fetch_assoc($resultado_pedidos)) { ?>
    <h3>Pedido #<?= $pedido['id_pedido'] ?> - <?= $pedido['nombre'] ?> <?= $pedido['apellido'] ?> - <?= $pedido['estado_pedido']?>
    <a href="editar_pedido.php?id=<?= $pedido['id_pedido'] ?>">Editar</a>    
    <a href="eliminar_pedido.php?id=<?= $pedido['id_pedido'] ?>">Eliminar</a>
    </h3>
    <p>Entrega estimada: <?= $pedido['fecha_entrega_estimada'] ?> | Transporte: <?= $pedido['empresa'] ?></p>

    <table>
        <tr>
            <td>Productos</td>
            <td>Talle</td>
        </tr>
        <?php
        $id_pedido = $pedido['id_pedido'];
        $sql_detalle = "SELECT productos.nombre_producto, producto_variante.talle FROM detalle_pedido JOIN producto_variante ON detalle_pedido.id_variante_fk = producto_variante.id_variante
                        JOIN productos ON producto_variante.id_producto_fk = productos.id_producto WHERE detalle_pedido.id_pedido_fk = '$id_pedido'";
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