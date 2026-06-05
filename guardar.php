<?php

include('conexion.php');

$nombre_producto = $_POST['nombre_producto'];
$precio = $_POST['precio'];
$id_categoria = $_POST['id_categoria'];

$sql = "INSERT INTO productos
        (nombre_producto, precio, id_categoria_fk)
        VALUES
        ('$nombre_producto', '$precio', '$id_categoria')";

mysqli_query($conexion, $sql);

header('Location: productos.php');

?>
