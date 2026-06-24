<?php
include("conexion.php");

if(isset($_POST["rol"])){
    $rol = $_POST["rol"];
    mysqli_query($conexion,"INSERT INTO rol (rol) VALUES ('$rol')");
    header("Location:rol.php");
    exit();
}

$sql = "SELECT * FROM rol";
$resultado = mysqli_query($conexion, $sql);
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
    <a href="abm.php"><h1>Inicio</h1></a>
    <h1>ABM Rol - PHP</h1>

    <form action="" method="POST">

    <input type="text"
           name="rol"
           placeholder="Nombre"
           required>

    <button type="submit">Guardar Rol</button>
    </form>
    <table>
        <tr>
            <td>ID</td>
            <td>Rol</td>
            <td>Acciones</td>
        </tr>
        <?php while($fila=mysqli_fetch_assoc($resultado)){?>
        <tr>
            <td><?= $fila['id_rol']?></td>
            <td><?= $fila['rol']?></td>
            <td>
                <a href="editar_rol.php?id=<?= $fila['id_rol'] ?>">Editar</a>
                |
                <a href="eliminar_rol.php?id=<?= $fila['id_rol'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>


</body>
</html>