<?php
include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM rol WHERE id_rol='$id'";

$resultado = mysqli_query($conexion, $sql);

$rol = mysqli_fetch_assoc($resultado);
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
    <h1>Editar Rol</h1>

    <form action="actualizar_rol.php" method="POST">
        <input type="hidden"
           name="id"
           value="<?php echo $rol['id_rol']; ?>">
        <input type="text"
           name="rol"
           value="<?php echo $rol['rol']; ?>">
        <button type="submit">Actualizar</button>
    </form>
    
</body>
</html>