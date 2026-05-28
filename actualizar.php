<?php

include('conexion.php');

$id = $_POST['id'];
$nombre_producto = $_POST['nombre_producto'];
$precio = $_POST['precio'];

$sql = "UPDATE productos
        SET nombre_producto='$nombre_producto',
            precio='$preciounitario',
        WHERE id_producto='$id_producto'";

mysqli_query($conexion, $sql);

header('Location: index.php');

?>
