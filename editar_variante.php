<?php

include('conexion.php');

$id = $_GET['id'];

$sql = "SELECT * FROM producto_variante WHERE id_variante='$id'";

$resultado = mysqli_query($conexion, $sql);

$variante = mysqli_fetch_assoc($resultado);

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

<form action="actualizar_variante.php" method="POST">

    <input type="hidden"
           name="id"
           value="<?php echo $variante['id_variante']; ?>">
    <label>Talle</label>
    <input type="text"
           name="talle"
           value="<?php echo $variante['talle']; ?>">
    <label>¿Vendido?</label><br>
    <select name="vendido">
        <option value="S" <?= $variante['vendido'] == 'S' ? 'selected' : '' ?>>Si</option>
        <option value="N" <?= $variante['vendido'] == 'N' ? 'selected' : '' ?>>No</option>
    </select><br>
    <label>Condición</label><br>
    <select name="condicion">
        <option value="estable" <?= $variante['condicion'] == 'estable' ? 'selected' : '' ?>>Estable</option>
        <option value="roto" <?= $variante['condicion'] == 'roto' ? 'selected' : '' ?>>Roto</option>
    </select><br>
    

    <button type="submit">Actualizar</button>

</form>

</body>
</html>