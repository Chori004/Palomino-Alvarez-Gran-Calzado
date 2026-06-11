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

   
    $consulta = mysqli_query($conexion, "SELECT * FROM productos WHERE id_producto = '$id_producto'");
    $producto = mysqli_fetch_array($consulta);

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