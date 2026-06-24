<?php
include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM modelo_zapato WHERE id_categoria='$id'";

$resultado = mysqli_query($conexion, $sql);

$modelo = mysqli_fetch_assoc($resultado);
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
    <h1>Editar Modelo</h1>

    <form action="actualizar_modelo.php" method="POST">
        <input type="hidden"
           name="id"
           value="<?php echo $modelo['id_categoria']; ?>">
        <input type="text"
           name="modelo"
           value="<?php echo $modelo['modelo']; ?>">
        <button type="submit">Actualizar</button>
    </form>
    
</body>
</html>