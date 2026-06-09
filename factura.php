<?php
include("conexion.php");


$resultado_factura = mysqli_query($conexion, "SELECT factura.id_factura, factura.fecha_factura, usuario.id_usuario, usuario.nombre, usuario.apellido FROM factura
                                        JOIN usuario ON factura.id_usuario_fk = usuario.id_usuario");
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
    <h1>ABM Factura - PHP</h1>
    <?php while($factura = mysqli_fetch_assoc($resultado_factura)) { ?>

   
    <h3>
        Factura #<?= $factura['id_factura'] ?> - 
        <?= $factura['nombre'] ?> <?= $factura['apellido'] ?>
        | <a href="eliminar_factura.php?id=<?= $factura['id_factura'] ?>">Eliminar</a>
    </h3>
    <p>Fecha de factura: <?= $factura['fecha_factura'] ?></p>
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Talle</th>
        </tr>
        
        <?php 
        $id_factura = $factura['id_factura'];
        $resultado_detalle = mysqli_query($conexion,"SELECT productos.nombre_producto, productos.precio, producto_variante.talle FROM detalle_factura
                                                    JOIN producto_variante ON detalle_factura.id_producto_variante_fk = producto_variante.id_variante
                                                    JOIN productos ON producto_variante.id_producto_fk = productos.id_producto
                                                    WHERE detalle_factura.id_factura_fk = '$id_factura'");
        $total = 0;
        while($factura_detalle = mysqli_fetch_assoc($resultado_detalle)) { ?>
        <tr>
            <td><?= $factura_detalle['nombre_producto'] ?></td>
            <td>$<?= $factura_detalle['precio'] ?></td>
            <td><?= $factura_detalle['talle'] ?></td>
        </tr>
        <?php $total += $factura_detalle['precio']; 
        } ?>
    <?php }?>
    <tr>
        <td colspan="2"><strong>Total</strong></td>
        <td><strong>$<?= number_format($total, 2, ',', '.') ?></strong></td>
    </tr>
    </table>
</body>
</html>