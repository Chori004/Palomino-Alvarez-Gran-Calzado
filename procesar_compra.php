<?php
session_start();
include("conexion.php");

$metodo_entrega = $_POST['metodo_entrega'];
$zona = $_POST['zona'];
$mensaje_error = "";

if ($zona == "Fuera de CABA" && $metodo_entrega == "domicilio") {
    $mensaje_error = "Para envíos fuera de CABA, por favor contáctese directamente con la empresa de transporte.";
} else {
    $nombre_usuario = $_SESSION['usuario_logueado'];
    $consulta_usuario = mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario'");
    $usuario_data = mysqli_fetch_assoc($consulta_usuario);
    $id_usuario = $usuario_data['id_usuario'];

    function generarCodigo($longitud = 10) {
        $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $codigo;
    }
    $codigo_seguimiento = generarCodigo();

    if ($metodo_entrega == "domicilio" && !isset($_POST['transporte'])) {
        $mensaje_error = "Por favor seleccione una empresa de transporte.";

    } elseif ($metodo_entrega == "retiro") {
        mysqli_query($conexion, "INSERT INTO reserva (id_usuario_fk, estado_reserva, codigo_seguimiento) 
                                  VALUES ('$id_usuario', 'pendiente', '$codigo_seguimiento')");
        $id_reserva = mysqli_insert_id($conexion);

        foreach ($_SESSION['carrito'] as $clave => $item) {
            $consulta_variante = mysqli_query($conexion, "SELECT id_variante FROM producto_variante 
                                                          WHERE id_producto_fk = '" . $item['id_producto'] . "' 
                                                          AND talle = '" . $item['talle'] . "' 
                                                          AND vendido = 'S' LIMIT 1");
            $variante = mysqli_fetch_assoc($consulta_variante);
            if ($variante) {
                mysqli_query($conexion, "INSERT INTO detalle_reserva (id_reserva_fk, id_variante_fk) 
                                         VALUES ('$id_reserva', '" . $variante['id_variante'] . "')");
            }
        }

        mysqli_query($conexion, "DELETE FROM carrito WHERE id_usuario_fk = '$id_usuario'");
        unset($_SESSION['carrito']);
        header("Location: mis_pedidos.php");
        exit();

    } else {
        $id_transporte = $_POST['transporte'];
        $fecha_entrega = date('Y-m-d', strtotime('+7 days'));

        mysqli_query($conexion, "INSERT INTO pedido (estado_pedido, empresa_transporte_fk, fecha_entrega_estimada, id_usuario_fk) 
                                VALUES ('pendiente', '$id_transporte', '$fecha_entrega', '$id_usuario')");
        $id_pedido = mysqli_insert_id($conexion);

        mysqli_query($conexion, "INSERT INTO factura (id_usuario_fk, id_pedido_fk) VALUES ('$id_usuario', '$id_pedido')");
        $id_factura = mysqli_insert_id($conexion);

        foreach ($_SESSION['carrito'] as $clave => $item) {
            $consulta_variante = mysqli_query($conexion, "SELECT id_variante FROM producto_variante 
                                                        WHERE id_producto_fk = '" . $item['id_producto'] . "' 
                                                        AND talle = '" . $item['talle'] . "' 
                                                        AND vendido = 'S' LIMIT 1");
            $variante = mysqli_fetch_assoc($consulta_variante);
            if ($variante) {
                mysqli_query($conexion, "INSERT INTO detalle_pedido (id_pedido_fk, id_variante_fk) 
                                        VALUES ('$id_pedido', '" . $variante['id_variante'] . "')");
                mysqli_query($conexion, "INSERT INTO detalle_factura (id_factura_fk, id_producto_variante_fk) 
                                         VALUES ('$id_factura', '" . $variante['id_variante'] . "')");
            }
        }

        mysqli_query($conexion, "DELETE FROM carrito WHERE id_usuario_fk = '$id_usuario'");
        unset($_SESSION['carrito']);
        header("Location: mis_pedidos.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesando Compra | Palomino-Alvarez Gran Calzado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm p-5 text-center" style="max-width: 500px;">
            <?php if ($mensaje_error != ""): ?>
                <h4 class="text-danger mb-3">Atención</h4>
                <p><?= $mensaje_error ?></p>
                <a href="ver_carrito.php" class="btn btn-dark">Volver al Carrito</a>
            <?php else: ?>
                <h4 class="text-success mb-3">¡Compra realizada con éxito!</h4>
                <p>Procesando...</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>