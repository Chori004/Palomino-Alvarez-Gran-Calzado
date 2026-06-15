<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['clave']) && $_GET['clave'] != "") {
    $clave_a_eliminar = $_GET['clave'];

    if (isset($_SESSION['carrito'][$clave_a_eliminar])) {
        
        $partes = explode("_", $clave_a_eliminar);
        if (count($partes) == 2) {
            $id_producto = $partes[0];
            $talle_elegido = $partes[1];

            $nombre_usuario = $_SESSION['usuario_logueado'];
            $consulta_user = mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario'");
            $usuario_data = mysqli_fetch_array($consulta_user);

            if ($usuario_data) {
                $id_usuario = $usuario_data['id_usuario'];

                $consulta_variante = mysqli_query($conexion, "SELECT id_variante FROM producto_variante WHERE id_producto_fk = '$id_producto' AND talle = '$talle_elegido'");
                $variante = mysqli_fetch_array($consulta_variante);

                if ($variante) {
                    $id_variante_fk = $variante['id_variante'];

                    $sql_delete = "DELETE FROM carrito WHERE id_usuario_fk = '$id_usuario' AND id_variante_fk = '$id_variante_fk' LIMIT 1";
                    mysqli_query($conexion, $sql_delete);
                    mysqli_query($conexion, "UPDATE producto_variante SET vendido = 'N' WHERE id_variante = '$id_variante_fk'");
                }
            }
        }

        unset($_SESSION['carrito'][$clave_a_eliminar]);
    }
}

header("Location: ver_carrito.php");
exit();
?>