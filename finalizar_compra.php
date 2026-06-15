<?php session_start();
include("conexion.php");

$nombre_usuario = $_SESSION['usuario_logueado'];
$consulta_usuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE nombre_usuario = '$nombre_usuario'");
$usuario = mysqli_fetch_assoc($consulta_usuario);
$consulta_transporte = mysqli_query($conexion, "SELECT * FROM transporte");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Finalizar Pago | Palomino-Alvarez Gran Calzado</title>
    <style>
        .form-check-input:checked {
            background-color: #9e8466 !important;
            border-color: #9e8466 !important;
        }
        #retiro:checked ~ .row .seccion-envio {
            display: none;
        }
    </style>
    
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #9e8466;" data-bs-theme="light">
            <div class="container-fluid">
                <a class="navbar-brand fs-3 fw-bold mx-auto mx-lg-0" href="index.php">Palomino-Alvarez Gran Calzado</a>
            </div>
        </nav>
    </header>
<form method="POST" action="procesar_compra.php">
    <input type="radio" class="d-none" name="metodo_entrega" id="domicilio" value="domicilio" checked>
    <input type="radio" class="d-none" name="metodo_entrega" id="retiro" value="retiro">

    <div class="row g-3 mb-4">
        <div class="col-6">
            <label class="btn btn-outline-dark w-100 py-3" for="domicilio">
                Envío a domicilio
            </label>
        </div>
        <div class="col-6">
            <label class="btn btn-outline-dark w-100 py-3" for="retiro">
                Retirar en tienda
            </label>
        </div>
    </div>

<div class="row">
    <div class="col-12 col-lg-8">  
    <div class="card shadow-sm p-4 mb-3">
        <h5 class="fw-bold mb-3">Datos de Facturación</h5>
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre_facturacion" class="form-control" value="<?= $usuario['nombre'] ?>" required>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Apellido</label>
                <input type="text" name="apellido_facturacion" class="form-control" value="<?= $usuario['apellido'] ?>" required>
            </div>
            <div class="col-12">
                <label class="form-label">Dirección de facturación</label>
                <input type="text" name="direccion_facturacion" class="form-control" value="<?= $usuario['direccion'] ?>" required>
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label">Zona</label>
                <select name="zona" class="form-select" required>
                    <option value="" selected disabled>Seleccione una zona</option>
                    <option value="CABA">CABA</option>
                    <option value="Fuera de CABA">Fuera de CABA</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card shadow-sm p-4 mb-3 seccion-envio">
        <h5>Envío a Domicilio</h5>
        <label class="form-label">Dirección de envío</label>
        <input type="text" name="direccion_envio" class="form-control" value="<?= $usuario['direccion']?> " required>
        <?php while($transporte = mysqli_fetch_assoc($consulta_transporte)) { ?>
            <div class="form-check p-2 mb-2">
                <input type="radio" class="form-check-input" name="transporte" id="transporte_<?= $transporte['id_transporte'] ?>" value="<?= $transporte['id_transporte'] ?>" required>
                <label class="form-check-label w-100" for="transporte_<?= $transporte['id_transporte'] ?>">
                    <?= $transporte['empresa'] ?> - $<?= number_format($transporte['costo'], 0, ',', '.') ?>
                </label>
            </div>
        <?php } ?>
    </div>

    <div class="card shadow-sm p-4 mb-3">
        <h5 class="fw-bold mb-3">Datos de la Tarjeta</h5>
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">Número de tarjeta</label>
                <input type="text" name="numero_tarjeta" class="form-control" maxlength="16" oninput="soloNumeros(this)" required>
            </div>
            <div class="col-6">
                <label class="form-label">Vencimiento</label>
                <input type="text" name="vencimiento" class="form-control" placeholder="MM/AA" maxlength="5" oninput="formatoVencimiento(this)" required>
            </div>
            <div class="col-6">
                <label class="form-label">CVV</label>
                <input type="text" name="cvv" class="form-control" maxlength="3" oninput="soloNumeros(this)" required>
            </div>
            <div class="col-12">
                <label class="form-label">Titular de la tarjeta</label>
                <input type="text" name="titular_tarjeta" class="form-control" value="<?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?>" required>
            </div>
        </div>
    </div>
    </div>
    
    
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm p-4 bg-light">
            <h4 class="fw-bold mb-4">Resumen</h4>
            <?php 
            $total_general = 0;
            foreach ($_SESSION['carrito'] as $clave => $item): 
                $subtotal = $item['precio'] * $item['cantidad'];
                $total_general += $subtotal;
            ?>
                <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                    <img src="<?php echo $item['imagen']; ?>" style="width: 50px; height: 50px; object-fit: contain;" class="me-2">
                    <div class="flex-grow-1" style="font-size: 0.9rem;">
                        <h6 class="mb-0 fw-bold"><?php echo $item['nombre']; ?></h6>
                        <small class="text-muted">Talle: <?php echo $item['talle']; ?> | Cant: <?php echo $item['cantidad']; ?></small>
                    </div>
                    <div class="fw-semibold text-dark">$<?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                <span class="text-muted">Subtotal</span>
                <span class="fw-semibold">$<?php echo number_format($total_general, 0, ',', '.'); ?></span>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span class="fs-5 fw-bold">Total</span>
                <span class="fs-4 fw-bold text-dark">$<?php echo number_format($total_general, 0, ',', '.'); ?></span>
            </div>
        </div>
    </div>
</div>

    <button type="submit" class="btn btn-dark w-100 py-3 fw-bold fs-5 mt-3">Confirmar Compra</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script>
        function soloNumeros(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }
        function formatoVencimiento(input) {
            let valor = input.value.replace(/[^0-9]/g, '');
            if (valor.length > 2) {
                valor = valor.slice(0, 2) + '/' + valor.slice(2, 4);
            }
            input.value = valor;
        }
    </script>
</body>
</html>