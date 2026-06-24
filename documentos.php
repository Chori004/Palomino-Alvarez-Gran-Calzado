<?php
include("conexion.php");

if(isset($_POST["tipo_documento"])){
    $tipo_documento = $_POST["tipo_documento"];
    $abreviatura = $_POST["abreviatura"];
    mysqli_query($conexion,"INSERT INTO tipo_documento (tipo_documento, abreviatura) VALUES ('$tipo_documento', '$abreviatura')");
    header("Location:documentos.php");
    exit();
}

$sql = "SELECT * FROM tipo_documento";
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
    <h1>ABM Tipo de Documento - PHP</h1>

    <form action="" method="POST">

    <input type="text"
           name="tipo_documento"
           placeholder="Nombre"
           required>
    <input type="text"
            name="abreviatura"
            placeholder="Abreviatura"
            required>
    <button type="submit">Guardar Documento</button>
    </form>
    <table>
        <tr>
            <td>ID</td>
            <td>Documentos</td>
            <td>Abreviatura</td>
            <td>Acciones</td>
        </tr>
        <?php while($fila=mysqli_fetch_assoc($resultado)){?>
        <tr>
            <td><?= $fila['id_tipodocumento']?></td>
            <td><?= $fila['tipo_documento']?></td>
            <td><?= $fila['abreviatura']?></td>
            <td>
                <a href="editar_documentos.php?id=<?= $fila['id_tipodocumento'] ?>">Editar</a>
                |
                <a href="eliminar_documentos.php?id=<?= $fila['id_tipodocumento'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>


</body>
</html>