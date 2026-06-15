<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    echo json_encode(['status' => 'error', 'mensaje' => 'Debes iniciar sesión para agregar productos al carrito.']);
    exit();
}

if (isset($_POST['id_producto']) && isset($_POST['talle_elegido'])) {
    
    $id_producto = $_POST['id_producto'];
    $talle_elegido = $_POST['talle_elegido'];
    
    $nombre_usuario = $_SESSION['usuario_logueado'];
    $consulta_user = mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario'");
    $usuario_data = mysqli_fetch_array($consulta_user);

    if (!$usuario_data) {
        echo json_encode(['status' => 'error', 'mensaje' => 'No se pudo encontrar el ID del usuario actual.']);
        exit();
    }

    $id_usuario = $usuario_data['id_usuario'];

    $consulta_variante = mysqli_query($conexion, "SELECT id_variante FROM producto_variante WHERE id_producto_fk = '$id_producto' AND talle = '$talle_elegido' AND vendido = 'N' AND activo = 'S' LIMIT 1");
    $variante = mysqli_fetch_array($consulta_variante);

    if (!$variante) {
        echo json_encode(['status' => 'error', 'mensaje' => 'No tenemos stock o no existe ese talle para este producto.']);
        exit();
    }

    $id_variante_fk = $variante['id_variante'];

    $consulta_prod = mysqli_query($conexion, "SELECT * FROM productos WHERE id_producto = '$id_producto'");
    $producto = mysqli_fetch_array($consulta_prod);

    if ($producto) {

        $clave_carrito = $id_producto . "_" . $talle_elegido;

        if (isset($_SESSION['carrito'][$clave_carrito])) {
            $_SESSION['carrito'][$clave_carrito]['cantidad']++;
        } else {
            $_SESSION['carrito'][$clave_carrito] = [
                'id_producto' => $id_producto,
                'nombre' => $producto['nombre_producto'],
                'precio' => $producto['precio'],
                'imagen' => $producto['imagen'],
                'talle' => $talle_elegido,
                'cantidad' => 1
            ];
        }

        mysqli_query($conexion, "INSERT INTO carrito (id_usuario_fk, id_variante_fk, fecha_agregado) VALUES ('$id_usuario', '$id_variante_fk', NOW())");

        mysqli_query($conexion, "UPDATE producto_variante SET vendido = 'S' WHERE id_variante = '$id_variante_fk'");

        echo json_encode([
            'status' => 'success',
            'carrito' => $_SESSION['carrito']
        ]);
        exit();
    }
}

echo json_encode(['status' => 'error', 'mensaje' => 'Ocurrió un problema al procesar los datos del producto.']);
exit();
?>