<?php
include("conexion.php");

$id = $_POST["id"];
$rol = $_POST["rol"];

$sql = "UPDATE rol SET rol = '$rol' WHERE id_rol = '$id'";
mysqli_query($conexion, $sql);
header("Location:rol.php");
?>