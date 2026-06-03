<?php
include("conexion.php");

$id = $_GET["id"];

$sql = "DELETE FROM tipo_documento WHERE id_tipodocumento = '$id'";

mysqli_query($conexion, $sql);

header("Location:documentos.php");

?>