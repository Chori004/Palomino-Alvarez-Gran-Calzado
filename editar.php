<?php

include('conexion.php');

$id_producto = $_GET['id'];

$sql = "SELECT * FROM productos WHERE id_producto='$id_producto'";

$resultado = mysqli_query($conexion, $sql);

$producto = mysqli_fetch_assoc($resultado);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            margin: 20px;
        }

        form {
            background: white;
            padding: 20px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            padding: 10px;
            margin-top: 10px;
            background: green;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<h1>Editar Producto</h1>

<form action="actualizar.php" method="POST">

    <input type="hidden"
           name="id"
           value="<?php echo $producto['id_producto']; ?>">

    <input type="text"
           name="nombre"
           value="<?php echo $producto['nombre_producto']; ?>">

    <input type="number"
           step="0.01"
           name="preciounitario"
           value="<?php echo $producto['precio']; ?>">
    <input type="text"
            name="imagen"
            value="<?php echo $producto['imagen']; ?>">
    <select name="id_categoria">
    <?php
    $consulta_categorias = mysqli_query($conexion, "SELECT * FROM modelo_zapato");
    while ($categoria = mysqli_fetch_assoc($consulta_categorias)) {
        $selected = ($producto['id_categoria_fk'] == $categoria['id_categoria']) ? "selected" : "";
        echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['modelo'] . "</option>";
    }
    ?>
</select>
    <input type="text"
           name="activo"
           value="<?php echo $producto['activo']; ?>">

    <button type="submit">Actualizar</button>

</form>

</body>
</html>
