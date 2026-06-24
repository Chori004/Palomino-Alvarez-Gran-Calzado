<?php
include("conexion.php");

$id = $_GET["id"];
mysqli_query($conexion, "DELETE FROM carrito WHERE id_carrito = '$id'");


header("Location: carrito.php");
exit();
?>