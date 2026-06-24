<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: login.php");
    exit();
}

$nombre_usuario = $_SESSION['usuario_logueado'];
$consulta_usuario = mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE nombre_usuario = '$nombre_usuario'");
$usuario_data = mysqli_fetch_assoc($consulta_usuario);
$id_usuario = $usuario_data['id_usuario'];

$consulta_pedidos = mysqli_query($conexion, "SELECT pedido.*, transporte.empresa FROM pedido 
                                            JOIN transporte ON pedido.empresa_transporte_fk = transporte.id_transporte
                                            WHERE pedido.id_usuario_fk = '$id_usuario' 
                                            ORDER BY fecha_pedido DESC");

$consulta_reservas = mysqli_query($conexion, "SELECT * FROM reserva 
                                             WHERE id_usuario_fk = '$id_usuario' 
                                             ORDER BY fecha_reserva DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis pedidos | Palomino-Alvarez Gran Calzado</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    
<header>
<nav class="navbar navbar-expand-lg" style="background-color: #9e8466;" data-bs-theme="light">
    <div class="container-fluid">
      <a class="navbar-brand fs-3 fw-bold" href="index.php">Palomino-Alvarez Gran Calzado</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-4">
          <li class="nav-item">
            <a class="nav-link active fs-5" aria-current="page" href="hombre.php">Hombre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fs-5" href="mujer.php">Mujer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fs-5" href="niños.php">Niños/as</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"> 
            <?php
            if (isset($_SESSION['usuario_logueado'])) {
                echo '
                <div class="dropdown"> 
                    <span class="nav-link fs-5 d-inline-flex align-items-center dropdown-toggle" style="color: inherit; cursor: pointer;" data-bs-toggle="dropdown">'
                    . $_SESSION['usuario_logueado'] .
                    '</span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="mis_pedidos.php">Mis pedidos</a></li>
                        <li><a class="dropdown-item" href="login.php">Cambiar de cuenta</a></li>
                        <li><a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </div>';
            } else {
                echo '<a class="nav-link active fs-5" href="login.php">Login</a>';
            }
            ?>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link position-relative" href="#" id="cartDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-basket3 align-middle" viewBox="0 0 16 16">
                <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z"/>
              </svg>
              <?php 
              $total_items = isset($_SESSION['carrito']) ? array_sum(array_column($_SESSION['carrito'], 'cantidad')) : 0; 
              ?>
              <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger <?php echo ($total_items == 0) ? 'd-none' : ''; ?>">
                <?php echo $total_items; ?>
              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="cartDropdown" id="cart-dropdown-menu" style="width: 300px; max-height: 400px; overflow-y: auto; box-shadow: 0px 4px 15px rgba(0,0,0,0.15); right: 0; left: auto !important;">
              <div id="cart-items-container">
                <?php if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])): ?>
                  <li class="text-center text-muted my-2 py-2" id="cart-empty-msg">El carrito está vacío</li>
                <?php else: ?>
                  <?php foreach ($_SESSION['carrito'] as $clave => $item): ?>
                    <li class="d-flex align-items-center mb-3 pb-2 border-bottom">
                      <img src="<?php echo $item['imagen']; ?>" style="width: 50px; height: 50px; object-fit: contain;" class="me-2">
                      <div class="flex-grow-1" style="font-size: 0.9rem;">
                        <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;"><?php echo $item['nombre']; ?></h6>
                        <small class="text-muted">Talle: <?php echo $item['talle']; ?> | Cant: <?php echo $item['cantidad']; ?></small>
                        <div class="fw-semibold text-dark">$<?php echo number_format($item['precio'] * $item['cantidad'], 0, ',', '.'); ?></div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <li class="mt-2 text-center">
                <a href="ver_carrito.php" class="btn btn-dark btn-sm w-100">Ver Carrito Completo</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
  </div>
</nav>
</header>

<div class="container my-5">
    <h2 class="fw-bold mb-4">Mis Pedidos</h2>

    <?php if (mysqli_num_rows($consulta_pedidos) == 0): ?>
        <div class="text-center py-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#adb5bd" class="bi bi-box-seam mb-3" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5H5.5a.5.5 0 0 0 0 1h.5v7.983a.5.5 0 0 0 .372.483l6 1.5a.5.5 0 0 0 .256 0l6-1.5a.5.5 0 0 0 .372-.483V6h.5a.5.5 0 0 0 0-1h-.096z"/>
            </svg>
            <h4 class="text-muted">No tenés pedidos realizados aún</h4>
            <p class="text-muted mb-4">¡Recorré nuestro catálogo para encontrar el calzado ideal!</p>
            <a href="index.php" class="btn btn-dark px-4 py-2">Ver Catálogo</a>
        </div>
    <?php else: ?>
        <?php while($pedido = mysqli_fetch_assoc($consulta_pedidos)) { ?>
            <div class="card shadow-sm p-4 mb-3">
                <h5>Pedido #<?= $pedido['id_pedido'] ?> - <?= $pedido['estado_pedido'] ?></h5>
                <p>Fecha: <?= $pedido['fecha_pedido'] ?></p>
                <p>Entrega estimada: <?= $pedido['fecha_entrega_estimada'] ?></p>
                <p>Transporte: <?= $pedido['empresa'] ?></p>
                <hr>
                <h6 class="fw-bold">Productos:</h6>
                <?php
                $id_pedido = $pedido['id_pedido'];
                $resultado_detalle = mysqli_query($conexion, "SELECT productos.nombre_producto, producto_variante.talle
                                                              FROM detalle_pedido
                                                              JOIN producto_variante ON detalle_pedido.id_variante_fk = producto_variante.id_variante
                                                              JOIN productos ON producto_variante.id_producto_fk = productos.id_producto
                                                              WHERE detalle_pedido.id_pedido_fk = '$id_pedido'");
                while($detalle = mysqli_fetch_assoc($resultado_detalle)) { ?>
                    <p class="mb-1"><?= $detalle['nombre_producto'] ?> - Talle: <?= $detalle['talle'] ?></p>
                <?php } ?>
            </div>
        <?php } ?>
    <?php endif; ?>

    <h2 class="fw-bold mb-4 mt-5">Mis Reservas</h2>

    <?php if (mysqli_num_rows($consulta_reservas) == 0): ?>
        <div class="text-center py-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#adb5bd" class="bi bi-bag-x mb-3" viewBox="0 0 16 16">
                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                <path d="M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z"/>
            </svg>
            <h4 class="text-muted">No tenés reservas realizadas aún</h4>
            <p class="text-muted mb-4">¡Recorré nuestro catálogo para encontrar el calzado ideal!</p>
            <a href="index.php" class="btn btn-dark px-4 py-2">Ver Catálogo</a>
        </div>
    <?php else: ?>
        <?php while($reserva = mysqli_fetch_assoc($consulta_reservas)) { ?>
            <div class="card shadow-sm p-4 mb-3">
                <h5>Reserva #<?= $reserva['id_reserva'] ?> - <?= $reserva['estado_reserva'] ?></h5>
                <p>Fecha: <?= $reserva['fecha_reserva'] ?></p>
                <p>Expira: <?= $reserva['fecha_expiracion'] ?></p>
                <p>Código de seguimiento: <strong><?= $reserva['codigo_seguimiento'] ?></strong></p>
                <hr>
                <h6 class="fw-bold">Productos:</h6>
                <?php
                $id_reserva = $reserva['id_reserva'];
                $resultado_detalle = mysqli_query($conexion, "SELECT productos.nombre_producto, producto_variante.talle
                                                              FROM detalle_reserva
                                                              JOIN producto_variante ON detalle_reserva.id_variante_fk = producto_variante.id_variante
                                                              JOIN productos ON producto_variante.id_producto_fk = productos.id_producto
                                                              WHERE detalle_reserva.id_reserva_fk = '$id_reserva'");
                while($detalle = mysqli_fetch_assoc($resultado_detalle)) { ?>
                    <p class="mb-1"><?= $detalle['nombre_producto'] ?> - Talle: <?= $detalle['talle'] ?></p>
                <?php } ?>
            </div>
        <?php } ?>
    <?php endif; ?>
</div>

<footer>
  <div class="container text-center text-white py-4">
    <div class="row mb-3">
      <div class="col-12 col-md-3"><h4>CONTÁCTANOS</h4></div>
      <div class="col-12 col-md-3"><h4>Newsletter</h4></div>
      <div class="col-12 col-md-3"><h4>Medios de pago</h4></div>
      <div class="col-12 col-md-3"><h4>Medios de envío</h4></div>
    </div>
    <div class="row align-items-center">
      <div class="col-12 col-md-3 mb-4 mb-md-0">
        <p class="mb-1">Encuentranos en Av. Cabildo 1979</p>
        <p class="mb-0">palomino-alvarez@gmail.com</p>
      </div>
      <div class="col-12 col-md-3 mb-4 mb-md-0">
        <div class="px-2">
          <label for="exampleFormControlInput1" class="form-label mb-2">Ingrese su email</label>
          <input type="email" class="form-control mb-2" id="exampleFormControlInput1" placeholder="ejemplo@ejemplo.com">
          <button type="submit" class="btn btn-outline-light btn-sm w-100">Enviar</button>
        </div>
      </div>
      <div class="col-12 col-md-3 mb-4 mb-md-0">
        <img id="medio_pago" src="https://i.ibb.co/1fTJfQK3/medios-de-pago-tarjetas-lilis.jpg" class="img-fluid rounded bg-white p-1" alt="medio de pago">
      </div>
      <div class="col-12 col-md-3 mb-4 mb-md-0">
        <ul class="list-unstyled mb-0">
          <?php
          $consulta_envios = mysqli_query($conexion, "SELECT * FROM transporte");
          if ($consulta_envios && mysqli_num_rows($consulta_envios) > 0) {
              while($transporte = mysqli_fetch_array($consulta_envios)) {
                  echo "<li class='mb-2'>" . $transporte["empresa"] . "</li>";
              }
          } else {
              echo "<li>No hay medios de envío disponibles</li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>