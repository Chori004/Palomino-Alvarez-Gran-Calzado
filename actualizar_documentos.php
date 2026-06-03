<?php
include("conexion.php");

$id = $_POST["id"];
$tipo_documento = $_POST["tipo_documento"];

$sql = "UPDATE tipo_documento SET tipo_documento = '$tipo_documento' WHERE id_tipodocumento = '$id'";
mysqli_query($conexion, $sql);
header("Location:documentos.php");
?>