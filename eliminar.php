<?php

include('conexion.php');

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id='$id_producto'";

mysqli_query($conexion, $sql);

header('Location: index.php');

?>
