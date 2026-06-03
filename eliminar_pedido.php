<?php
include("conexion.php");

$id = $_GET["id"];
mysqli_query($conexion, "DELETE FROM detalle_pedido WHERE id_pedido_fk = '$id'");

mysqli_query($conexion,"DELETE FROM pedido WHERE id_pedido = '$id'");

header("Location: pedidos.php");
exit();

?>