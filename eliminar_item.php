<?php
session_start();

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['clave']) && $_GET['clave'] != "") {
    $clave_a_eliminar = $_GET['clave'];

    if (isset($_SESSION['carrito'][$clave_a_eliminar])) {
        unset($_SESSION['carrito'][$clave_a_eliminar]);
    }
}

header("Location: ver_carrito.php");
exit();
?>