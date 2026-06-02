<?php
include('conexion.php');

$id = $_POST['id'];
$nombre_producto = $_POST['nombre'];
$precio = $_POST['preciounitario'];
$activo= $_POST['activo'];

$sql = "UPDATE productos
        SET nombre_producto='$nombre_producto',
            precio='$precio',
            activo='$activo'
        WHERE id_producto='$id'";

mysqli_query($conexion, $sql);

header('Location: productos.php');
?>
