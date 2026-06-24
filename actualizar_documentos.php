<?php
include("conexion.php");

$id = $_POST["id"];
$tipo_documento = $_POST["tipo_documento"];
$abreviatura = $_POST["abreviatura"];

$sql = "UPDATE tipo_documento SET tipo_documento = '$tipo_documento', abreviatura = '$abreviatura' WHERE id_tipodocumento = '$id'";
mysqli_query($conexion, $sql);
header("Location:documentos.php");
?>