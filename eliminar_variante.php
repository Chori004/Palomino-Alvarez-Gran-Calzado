<?php

include('conexion.php');

$id = $_GET['id'];

$sql = "UPDATE producto_variante SET activo='N' WHERE id_variante='$id'";

mysqli_query($conexion, $sql);

header('Location: producto_variante.php');

?>