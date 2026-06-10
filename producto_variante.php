<?php
include("conexion.php");

$where_filtro = "";

if (isset($_GET['filtro_producto']) && $_GET['filtro_producto'] != "") {
    $where_filtro = "AND pv.id_producto_fk = '" . $_GET['filtro_producto'] . "'";
}

if (isset($_POST["zapato"])) {
    $id_producto = $_POST["zapato"];
    $talle = $_POST["talle"];
    mysqli_query($conexion, "INSERT INTO producto_variante (id_producto_fk, talle) VALUES ('$id_producto', '$talle')");
    header("Location: producto_variante.php");
}

$sql = "SELECT pv.id_variante, p.nombre_producto, pv.talle, pv.activo, pv.vendido, pv.condicion
        FROM producto_variante pv
        JOIN productos p ON pv.id_producto_fk = p.id_producto
        WHERE pv.activo = 'S' AND pv.vendido = 'N' " . $where_filtro . "
        ORDER BY p.nombre_producto, pv.talle";

$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <a href="abm.php"><h1>Inicio</h1></a>
    <h1>ABM Stock - PHP</h1>
    <form action="producto_variante.php" method="POST">
    <label>Zapato</label>
    <select name="zapato">
        <option value="" disabled selected>Seleccione un producto</option>
    <?php
    $consulta = mysqli_query($conexion,"SELECT id_producto, nombre_producto FROM productos WHERE activo = 'S'");
    while ($fila = mysqli_fetch_assoc($consulta)) {
        echo "<option value='" . $fila['id_producto'] . "'>" . $fila['nombre_producto'] . "</option>";
    }
    ?>
    </select>

    <input type="number"
           step="0.5"
           name="talle"
           placeholder="Talle"
           required>


    <button type="submit">Guardar Producto</button>
    </form>
    <form action="inactivo.php" metho="GET">
    <label>¿Ver productos inactivos?</label>
    <button type="submit">Ver</button>
    </form>
    <form action="vendido.php" metho="GET">
    <label>¿Ver productos vendidos?</label>
    <button type="submit">Ver</button>
    </form>

    <form method="GET">
    <select name="filtro_producto">
        <option value="">Todos los productos</option>
        <?php
        $consulta_filtro = mysqli_query($conexion, "SELECT id_producto, nombre_producto FROM productos WHERE activo = 'S'");
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
        <th>ID</th>
        <th>Producto</th>
        <th>Talle</th>
        <th>Activo</th>
        <th>Vendido</th>
        <th>Condición</th>
        <th>Acciones</th>
    </tr>
    <?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
    <tr>
        <td><?= $fila['id_variante'] ?></td>
        <td><?= $fila['nombre_producto'] ?></td>
        <td><?= $fila['talle'] ?></td>
        <td><?=$fila['activo']?></td>
        <td><?= $fila['vendido'] ?></td>
        <td><?= $fila['condicion'] ?></td>
        <td>
            <a href="editar_variante.php?id=<?= $fila['id_variante'] ?>">Editar</a>
            |
            <a href="eliminar_variante.php?id=<?= $fila['id_variante'] ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
</body>
</html>