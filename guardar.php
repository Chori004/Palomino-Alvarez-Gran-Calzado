<?php

include('conexion.php');

$nombre_producto = $_POST['nombre_producto'];
$precio = $_POST['precio'];
$imagen_zapato = $_POST['imagen_zapato'];
$id_categoria = $_POST['id_categoria'];

$sql = "INSERT INTO productos
        (nombre_producto, precio, imagen, id_categoria_fk)
        VALUES
        ('$nombre_producto', '$precio', '$imagen_zapato', '$id_categoria')";

mysqli_query($conexion, $sql);

header('Location: productos.php');

?>
