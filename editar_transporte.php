<?php
include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM transporte WHERE id_transporte='$id'";

$resultado = mysqli_query($conexion, $sql);

$transporte = mysqli_fetch_assoc($resultado);
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
    <h1>Editar Transporte</h1>

    <form action="actualizar_transporte.php" method="POST">
        <input type="hidden"
           name="id"
           value="<?php echo $transporte['id_transporte']; ?>">
        <input type="text"
           name="empresa"
           value="<?php echo $transporte['empresa']; ?>">
        <button type="submit">Actualizar</button>
    </form>
    
</body>
</html>
