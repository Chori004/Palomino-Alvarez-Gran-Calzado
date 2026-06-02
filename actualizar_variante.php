<?php
include('conexion.php');

$id = $_POST['id'];
$talle = $_POST['talle'];
$vendido = $_POST['vendido'];


$sql = "UPDATE producto_variante
        SET talle='$talle',
            vendido='$vendido'
        WHERE id_variante='$id'";

mysqli_query($conexion, $sql);

header('Location: producto_variante.php');
?>