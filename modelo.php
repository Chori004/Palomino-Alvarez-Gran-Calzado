<?php
include("conexion.php");

if(isset($_POST["modelo"])){
    $modelo = $_POST["modelo"];
    mysqli_query($conexion, "INSERT INTO modelo_zapato (modelo) VALUES ('$modelo')");
    header("Location:modelo.php");
    exit();
}
$sql = "SELECT * FROM modelo_zapato";
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
    <h1>ABM Categoria - PHP</h1>

    <form action="" method="POST">

    <input type="text"
           name="modelo"
           placeholder="Nombre"
           required>

    <button type="submit">Guardar Categoria de Zapato</button>
    </form>
    <table>
        <tr>
            <td>ID</td>
            <td>Modelo</td>
            <td>Acciones</td>
        </tr>
        <?php while($fila=mysqli_fetch_assoc($resultado)){?>
        <tr>
            <td><?= $fila['id_categoria']?></td>
            <td><?= $fila['modelo']?></td>
            <td>
                <a href="editar_modelo.php?id=<?= $fila['id_categoria'] ?>">Editar</a>
                |
                <a href="eliminar_modelo.php?id=<?= $fila['id_categoria'] ?>">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>


</body>
</html>