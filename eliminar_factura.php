<?php
include("conexion.php");

$id = $_GET["id"];

mysqli_query($conexion, "DELETE FROM detalle_factura WHERE id_factura_fk = '$id'");
mysqli_query($conexion, "DELETE FROM factura WHERE id_factura = '$id'");

header("Location: factura.php");
exit();

?>