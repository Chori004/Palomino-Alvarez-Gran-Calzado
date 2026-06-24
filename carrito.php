<?php 
include("conexion.php");

$sql_carrito = "SELECT carrito.id_carrito, carrito.fecha_agregado, productos.nombre_producto, productos.precio, producto_variante.talle, usuario.nombre_usuario FROM carrito
                JOIN producto_variante ON carrito.id_variante_fk = producto_variante.id_variante
                JOIN productos ON producto_variante.id_producto_fk = productos.id_producto
                JOIN usuario ON carrito.id_usuario_fk = usuario.id_usuario";

$resultado_carrito = mysqli_query($conexion, $sql_carrito);
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
    <h1>ABM Carrito - PHP</h1>

    <table>
        <tr>
            <th>Usuario</th>
            <th>Producto</th>
            <th>Talle</th>
            <th>Precio</th>
            <th>Fecha Agregado</th>
            <th>Acciones</th>
        </tr>
        
        <?php while($carrito = mysqli_fetch_assoc($resultado_carrito)) { ?>
        <tr>
            <td><?= $carrito['nombre_usuario'] ?></td>
            <td><?= $carrito['nombre_producto'] ?></td>
            <td><?= $carrito['talle'] ?></td>
            <td>$<?= $carrito['precio'] ?></td>
            <td><?= $carrito['fecha_agregado'] ?></td>
            <td>
                <a href="editar_carrito.php?id=<?= $carrito['id_carrito'] ?>">Editar</a>
                |
                <a href="eliminar_carrito.php?id=<?= $carrito['id_carrito'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</body>
</html>