<?php
include("conexion.php");

$id = $_POST["id"];
$empresa = $_POST["empresa"];

$sql = "UPDATE transporte SET empresa = '$empresa' WHERE id_transporte = '$id'";
mysqli_query($conexion, $sql);
header("Location:transporte.php");
?>