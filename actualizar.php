<?php
include('conexion.php');

$id = $_POST['id'];
$nombre_producto = $_POST['nombre'];
$precio = $_POST['preciounitario'];
$id_categoria = $_POST['id_categoria'];
$imagen = $_POST['imagen'];
$activo= $_POST['activo'];

$sql = "UPDATE productos SET 
        nombre_producto='$nombre_producto',
        precio='$precio',
        id_categoria_fk='$id_categoria',
        activo='$activo',
        imagen='$imagen'
        WHERE id_producto='$id'";

mysqli_query($conexion, $sql);

header('Location: productos.php');
?>
