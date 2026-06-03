<?php
include("conexion.php");

$id = $_POST["id"];
$modelo = $_POST["modelo"];

$sql = "UPDATE modelo_zapato SET modelo = '$modelo' WHERE id_categoria = '$id'";
mysqli_query($conexion, $sql);
header("Location:modelo.php");
?>