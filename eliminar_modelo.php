<?php
include("conexion.php");

$id = $_GET["id"];

$sql = "DELETE FROM modelo_zapato WHERE id_categoria = '$id'";

mysqli_query($conexion, $sql);

header("Location:modelo.php");

?>