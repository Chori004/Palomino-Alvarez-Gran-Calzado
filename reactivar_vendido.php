<?php
include("conexion.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['id']);
    $sql = "UPDATE producto_variante SET vendido = 'N' WHERE id_variante = '$id'";
    
    if (mysqli_query($conexion, $sql)) {
        header("Location: vendido.php");
        exit();
    } else {
        echo "Error al reactivar la variante: " . mysqli_error($conexion);
    }
}
?>