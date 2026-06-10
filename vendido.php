<?php
include("conexion.php");

$where_filtro = "";
if (isset($_GET['filtro_producto']) && $_GET['filtro_producto'] != "") {
    $where_filtro = "AND producto_variante.id_producto_fk = '" . $_GET['filtro_producto'] . "'";
}

$resultado_vendido = mysqli_query($conexion,"SELECT productos.nombre_producto, producto_variante.id_variante, producto_variante.talle, producto_variante.vendido FROM producto_variante
                                            JOIN productos ON producto_variante.id_producto_fk = productos.id_producto WHERE vendido = 'S'". $where_filtro);             

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variantes Vendidas</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 20px; }
        h1 { color: #333; }
        form { background: white; padding: 20px; margin-bottom: 20px; border-radius: 5px; }
        select { width: 100%; padding: 10px; margin-top: 10px; }
        button { padding: 10px; margin-top: 10px; background: #007bff; color: white; border: none; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; background: white; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; }
        th, td { padding: 10px; text-align: center; }
        a { text-decoration: none; }
        .btn-activar { color: green; font-weight: bold; }
        .btn-volver { background: #6c757d; color: white; padding: 10px; border-radius: 5px; display: inline-block; margin-bottom: 20px; }
    </style>
</head>
<body>

    <a href="abm.php"><h1>Inicio</h1></a>
    <h1>Archivo de Variantes Vendidas</h1>
    
    <a href="producto_variante.php" class="btn-volver">← Volver a Stock Activo</a>

    <form method="GET">
        <label>Filtrar por Zapato Vendido:</label>
        <select name="filtro_producto">
            <option value="">Todos los productos</option>
            <?php
            $consulta_filtro = mysqli_query($conexion, "SELECT id_producto, nombre_producto FROM productos");
            while ($fila = mysqli_fetch_assoc($consulta_filtro)) {
                $selected = (isset($_GET['filtro_producto']) && $_GET['filtro_producto'] == $fila['id_producto']) ? "selected" : "";
                echo "<option value='" . $fila['id_producto'] . "' $selected>" . $fila['nombre_producto'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Filtrar</button>
    </form>

   <table>
    <tr>
        <th>ID Variante</th>
        <th>Producto</th>
        <th>Talle</th>
        <th>Vendido</th>
        <th>Acciones</th>
    </tr>
    <?php while($fila = mysqli_fetch_assoc($resultado_vendido)) { ?>
    <tr>
        <td><?= $fila['id_variante'] ?></td>
        <td><?= $fila['nombre_producto'] ?></td>
        <td><?= $fila['talle'] ?></td>
        <td><?= $fila['vendido'] ?></td>
        <td>
            <a href="reactivar_vendido.php?id=<?= $fila['id_variante'] ?>" class="btn-activar">Marcar como no vendido</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>