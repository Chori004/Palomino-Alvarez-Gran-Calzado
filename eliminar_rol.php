<?php
include("conexion.php");

$id = $_GET["id"];

$sql = "DELETE FROM rol WHERE id_rol = '$id'";

mysqli_query($conexion, $sql);

header("Location:rol.php");

?>