<?php
session_start();
$total_general = 0;
include("conexion.php"); 

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario_logueado'];
$consulta_user = mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario'");
$usuario_data = mysqli_fetch_array($consulta_user);

if ($usuario_data) {
    $id_usuario = $usuario_data['id_usuario'];

    $sql_carrito_db = "SELECT p.id_producto, p.nombre_producto, p.precio, p.imagen, pv.talle, COUNT(c.id_variante_fk) as cantidad
                       FROM carrito c
                       INNER JOIN producto_variante pv ON c.id_variante_fk = pv.id_variante
                       INNER JOIN productos p ON pv.id_producto_fk = p.id_producto
                       WHERE c.id_usuario_fk = '$id_usuario'
                       GROUP BY c.id_variante_fk";
                       
    $resultado_db = mysqli_query($conexion, $sql_carrito_db);

    $_SESSION['carrito'] = [];

    while ($fila = mysqli_fetch_array($resultado_db)) {
        $id_prod = $fila['id_producto'];
        $talle = $fila['talle'];
        $clave_carrito = $id_prod . "_" . $talle;

        $_SESSION['carrito'][$clave_carrito] = [
            'id_producto' => $id_prod,
            'nombre' => $fila['nombre_producto'],
            'precio' => $fila['precio'],
            'imagen' => $fila['imagen'],
            'talle' => $talle,
            'cantidad' => $fila['cantidad']
        ];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito | Palomino-Alvarez Gran Calzado</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #9e8466;" data-bs-theme="light">
            <div class="container-fluid">
                <a class="navbar-brand fs-3 fw-bold mx-auto mx-lg-0" href="index.php">Palomino-Alvarez Gran Calzado</a>
                <div class="d-flex border-bottom-0">
                    <a href="index.php" class="btn btn-outline-light btn-sm fw-semibold">Seguir Comprando</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-5" style="min-height: 60vh;">
        <h2 class="mb-4 fw-bold text-center text-lg-start">Tu Carrito de Compras</h2>

        <?php if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])): ?>
            <div class="text-center py-5">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#adb5bd" class="bi bi-cart-x" viewBox="0 0 16 16">
                        <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </div>
                <h4 class="text-muted">No tenés productos en el carrito actualmente</h4>
                <p class="text-muted mb-4">¡Recorré nuestro catálogo para encontrar el calzado ideal!</p>
                <a href="index.php" class="btn btn-dark px-4 py-2">Ver Catálogo</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm p-3">
                        <?php foreach ($_SESSION['carrito'] as $clave => $item): 
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total_general += $subtotal; // Sumamos cada subtotal al total general acumulado
                        ?>
                            <div class="row align-items-center mb-3 pb-3 border-bottom text-center text-sm-start">
                                <div class="col-12 col-sm-2 mb-3 mb-sm-0">
                                    <img src="<?php echo $item['imagen']; ?>" class="img-fluid rounded" style="max-height: 80px; object-fit: contain;" alt="<?php echo $item['nombre']; ?>">
                                </div>
                                <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                    <h5 class="mb-1 fw-bold fs-6"><?php echo $item['nombre']; ?></h5>
                                    <p class="text-muted small mb-0">Talle: <span class="fw-semibold text-dark"><?php echo $item['talle']; ?></span></p>
                                </div>
                                <div class="col-12 col-sm-3 mb-2 mb-sm-0">
                                    <div class="text-muted small mb-1">Cant: <?php echo $item['cantidad']; ?></div>
                                    <div class="small text-secondary">$<?php echo number_format($item['precio'], 0, ',', '.'); ?> c/u</div>
                                </div>
                                <div class="col-12 col-sm-3 d-flex justify-content-between align-items-center justify-content-sm-end gap-3">
                                    <div class="fw-bold fs-5 text-dark">$<?php echo number_format($subtotal, 0, ',', '.'); ?></div>
                                    <a href="eliminar_item.php?clave=<?php echo $clave; ?>" class="btn btn-outline-danger btn-sm border-0" title="Eliminar del carrito">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm p-4 bg-light">
                        <h4 class="fw-bold mb-4">Resumen</h4>
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-semibold">$<?php echo number_format($total_general, 0, ',', '.'); ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5 fw-bold">Total</span>
                            <span class="fs-4 fw-bold text-dark">$<?php echo number_format($total_general, 0, ',', '.'); ?></span>
                        </div>
                        
                        <a href="finalizar_compra.php" class="btn btn-dark w-100 py-3 fw-bold fs-5 shadow-sm">
                            Iniciar Compra
                        </a>
                        
                        <div class="text-center mt-3">
                            <small class="text-muted">Garantía de cambio por fallas o talle sin cargo</small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer class="mt-5 py-4" style="background-color: #f8f9fa;">
        <div class="container text-center">
            <p class="mb-0 text-black">&copy; <?php echo date("Y"); ?> Palomino-Alvarez Gran Calzado. Av. Cabildo 1979.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>