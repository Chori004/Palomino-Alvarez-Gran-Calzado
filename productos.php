<?php
include('conexion.php');

$busqueda = "";
$where_filtro="";
if(isset($_GET['buscar'])) {
    $busqueda = $_GET['buscar'];
    $where_filtro = "AND p.nombre_producto LIKE '%$busqueda%'";
} 
$sql = "SELECT p.id_producto, p.nombre_producto, p.precio, 
                COUNT(pv.id_variante) AS stock_actual
                FROM productos p
                LEFT JOIN producto_variante pv
                    ON p.id_producto = pv.id_producto_fk
                    AND pv.vendido = 'N'
                    AND pv.activo = 'S'
                WHERE p.activo = 'S' $where_filtro
                GROUP BY p.id_producto";
$resultado = mysqli_query($conexion, $sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ABM Productos PHP</title>
    <a href="abm.php"><h1>Inicio</h1></a>
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
</head>
<body>

<h1>ABM Usuarios - PHP</h1>

<form action="guardar.php" method="POST">

    <input type="text"
           name="nombre_producto"
           placeholder="Nombre"
           required>

    <input type="number"
           step="0.01"
           name="precio"
           placeholder="Precio"
           required>


    <button type="submit">Guardar Producto</button>

</form>

<form method="GET">

    <input type="text"
           name="buscar"
           placeholder="Buscar producto">

    <button type="submit">Buscar</button>

</form>

<table>

    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>

    <tr>
        <td><?php echo $fila['id_producto']; ?></td>
        <td><?php echo $fila['nombre_producto']; ?></td>
        <td><?php echo $fila['precio']; ?></td>
        <td><?php echo $fila['stock_actual'];?></td>

        <td>
            <a href="editar.php?id=<?php echo $fila['id_producto']; ?>">
                Editar
            </a>
            |
            <a href="eliminar.php?id=<?php echo $fila['id_producto']; ?>">
                Eliminar
            </a>
        </td>
    </tr>

<?php } ?>

</table>

</body>
</html>
