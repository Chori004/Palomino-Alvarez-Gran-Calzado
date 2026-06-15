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
    function generarCodigo($longitud = 8) {
        $caracteres = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
        for ($i = 0; $i < $longitud; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $codigo;
    }
    $codigo_seguimiento = generarCodigo();
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