<?php
include("conexion.php");

$mensaje = "";

if (isset($_POST["nombre_usuario"])) {
    $nombre_usuario = $_POST["nombre_usuario"];
    mysqli_query($conexion, "DELETE FROM usuario WHERE nombre_usuario = '$nombre_usuario'");

    if (mysqli_affected_rows($conexion) > 0) {
        $mensaje = "Usuario eliminado correctamente";
    } else {
        $mensaje = "No se encontró ningún usuario con ese nombre";
    }
}
$mensaje_editar = "";

if (isset($_POST["nombre_editar"])) {
    $nombre_editar = $_POST["nombre_editar"];
    $resultado = mysqli_query($conexion, "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_editar'");
    
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        header("Location: editar_usuario.php?id=" . $usuario['id_usuario']);
    } else {
        $mensaje_editar = "No se encontró ningún usuario con ese nombre";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM Usuarios</title>
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

    <form action="usuarios.php" method="POST">

    <input type="text"
           name="nombre_usuario"
           placeholder="Nombre"
           required>
    <button type="submit">Eliminar usuario</button>
    </form>
    <?php if ($mensaje != "") echo $mensaje; ?>
    <form action="usuarios.php" method="POST">

    <input type="text"
           name="nombre_editar"
           placeholder="Nombre"
           required>
    <button type="submit">Editar usuario</button>
    </form>
    <?php if ($mensaje_editar != "") echo $mensaje_editar; ?>
</body>
</html>