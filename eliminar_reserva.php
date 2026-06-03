<?php
include("conexion.php");

$id = $_GET["id"];
mysqli_query($conexion, "DELETE FROM detalle_reserva WHERE id_reserva_fk = '$id'");
mysqli_query($conexion, "DELETE FROM reserva WHERE id_reserva = '$id'");

header("Location: reservas.php");
exit();
?>