<?php
include('conexion.php');

$id = $_POST['id'];
$talle = $_POST['talle'];
$vendido = $_POST['vendido'];
$condicion = $_POST['condicion'];


$sql = "UPDATE producto_variante
        SET talle='$talle',
            vendido='$vendido',
            condicion= '$condicion'
        WHERE id_variante='$id'";

mysqli_query($conexion, $sql);

header('Location: producto_variante.php');
?>