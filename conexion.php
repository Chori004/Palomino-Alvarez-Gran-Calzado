<?php

$conexion = mysqli_connect (
    "localhost",
    "root",
    "",
    "zapatos"
);
if (!$conexion) {
    die("Error de conexion");
}
?>