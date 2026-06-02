<?php

include('conexion.php');

$id = $_GET['id'];

$sql = "UPDATE productos SET activo='N' WHERE id_producto='$id'";

mysqli_query($conexion, $sql);

header('Location: productos.php');

?>
