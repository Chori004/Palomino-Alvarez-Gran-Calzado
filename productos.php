<?php
include('conexion.php');

$busqueda = "";

if(isset($_GET['buscar'])) {
    $busqueda = $_GET['buscar'];
    $sql = "SELECT p.*, m.modelo FROM productos p 
            INNER JOIN modelo_zapato m ON p.id_categoria_fk = m.id_categoria
            WHERE p.nombre_producto LIKE '%$busqueda%'";
} else {
    $sql = "SELECT p.*, m.modelo FROM productos p 
            INNER JOIN modelo_zapato m ON p.id_categoria_fk = m.id_categoria";
}

$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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

<h1>ABM Productos - PHP</h1>

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
    <input type="text"
            name="imagen_zapato"
            placeholder="URL Imagen"
            required>
    <select name="id_categoria" required>
        <option value="" disabled selected>Seleccione una categoría</option>
        <?php 
        $consulta_categorias = mysqli_query($conexion, "SELECT * FROM modelo_zapato");
        while ($categoria = mysqli_fetch_assoc($consulta_categorias)) {
            echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['modelo'] . "</option>";
        }
    
        ?>
    </select>


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
        <th>Activo</th>
        <th>Categoria</th>
        <th>Acciones</th>
    </tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>

    <tr>
        <td><?php echo $fila['id_producto']; ?></td>
        <td><?php echo $fila['nombre_producto']; ?></td>
        <td><?php echo $fila['precio']; ?></td>
        <td><?php echo $fila['activo'];?></td>
        <td><?php echo $fila['modelo']; ?></td>
    

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
