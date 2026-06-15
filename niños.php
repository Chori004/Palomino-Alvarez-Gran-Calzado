<?php session_start(); 
include("conexion.php");
$where_tipo = "";
if (isset($_GET['tipo']) && $_GET['tipo'] != "") {
    $where_tipo = "AND nombre_producto LIKE '%" . $_GET['tipo'] . "%'";
}

$consulta_productos = mysqli_query($conexion, "SELECT * FROM productos WHERE activo = 'S' AND id_categoria_fk = 3 " . $where_tipo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niños/as | Zapatilla, zapatos y más</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 500px;
            object-fit: contain;
        }
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }
        .talle-sin-stock {
            color: #6c757d !important;
            border-color: #dee2e6 !important;
            background-color: #f8f9fa !important;
            overflow: hidden;
        }
        .talle-sin-stock::after {
            content: "";
            position: absolute;
            width: 150%;
            height: 1px;
            background-color: #adb5bd;
            transform: rotate(-35deg);
            top: 50%;
            left: -25%;
        }
    </style>
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
          <li class="nav-item dropdown">
              <a class="nav-link active fs-5" href="hombre.php">Hombre</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link active fs-5" href="mujer.php">Mujer</a>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link active fs-5 dropdown-toggle" href="niños.php">Niños/as</a>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="niños.php">Todos</a></li>
                  <li><a class="dropdown-item" href="niños.php?tipo=Borcegos">Borcegos</a></li>
                  <li><a class="dropdown-item" href="niños.php?tipo=Zapatilla">Zapatillas</a></li>
                  <li><a class="dropdown-item" href="niños.php?tipo=Bota">Botas</a></li>
                  <li><a class="dropdown-item" href="niños.php?tipo=Zapato">Zapato</a></li>
              </ul>
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
<div class="container-fluid px-3">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
    <?php

    while ($producto = mysqli_fetch_array($consulta_productos)) {
    ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="Foto de <?php echo $producto['nombre_producto']; ?>">
            
          <div class="card-body">
            <h5 class="card-title"><?php echo $producto['nombre_producto']; ?></h5>
              
            <p class="card-text">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>
             <?php if (isset($_SESSION['usuario_logueado'])): ?>
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalProducto<?php echo $producto['id_producto']; ?>">
                    Agregar
                </button>
            <?php else: ?>
                <a href="login.php" class="btn btn-dark">Agregar</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modalProducto<?php echo $producto['id_producto']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $producto['nombre_producto']; ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="agregar_carrito.php" method="POST">
                <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">

                <div class="mb-3">
                  <label class="form-label fw-bold d-block mb-3">Seleccioná tu Talle:</label>
                  
                  <div class="d-flex flex-wrap gap-2">
                    
                    <?php
                    $talles_ninos = [25, 26, 27, 28, 29, 30, 31, 32, 33, 34];
                    $id_actual = $producto['id_producto'];

                    foreach ($talles_ninos as $talle) {
                        $id_unico = "talle_" . $id_actual . "_" . $talle;
                        
                        $buscar_variante = mysqli_query($conexion, "SELECT COUNT(*) as total FROM producto_variante WHERE id_producto_fk = '$id_actual' AND talle = '$talle' AND activo = 'S' AND vendido = 'N'");
                        $resultado = mysqli_fetch_array($buscar_variante);
                        
                        $disabled = "";
                        $clase_sin_stock = "";
                        
                        if (!$resultado || $resultado['total'] <= 0) {
                            $disabled = "disabled";
                            $clase_sin_stock = "talle-sin-stock";
                        }
                        ?>
                        
                        <input type="radio" class="btn-check" name="talle_elegido" id="<?php echo $id_unico; ?>" value="<?php echo $talle; ?>" required <?php echo $disabled; ?>>
                        
                        <label class="btn btn-outline-dark d-flex align-items-center justify-content-center position-relative <?php echo $clase_sin_stock; ?>" for="<?php echo $id_unico; ?>" style="width: 55px; height: 45px; font-weight: 500;">
                            <?php echo $talle; ?>
                        </label>
                        
                        <?php
                    }
                    ?>
                    
                  </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 mt-3">Confirmar y Agregar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
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
<script>
document.querySelectorAll('form[action="agregar_carrito.php"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        const modalElement = this.closest('.modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }

        const formData = new FormData(this);

        fetch('agregar_carrito.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                actualizarMenuCarrito(data.carrito);
                location.reload()
            } else {
                alert(data.mensaje);
            }
        })
        .catch(error => console.error('Error en la petición:', error));
    });
});

function actualizarMenuCarrito(carrito) {
    const container = document.getElementById('cart-items-container');
    const badge = document.getElementById('cart-badge');
    
    container.innerHTML = ''; 
    let totalCantidad = 0;

    if (!carrito || Object.keys(carrito).length === 0) {
        container.innerHTML = '<li class="text-center text-muted my-2 py-2" id="cart-empty-msg">El carrito está vacío</li>';
        badge.textContent = '0';
        badge.classList.add('d-none');
        return;
    }

    Object.keys(carrito).forEach(key => {
        const item = carrito[key];
        totalCantidad += parseInt(item.cantidad);
        
        const precioFormateado = new Intl.NumberFormat('es-AR', { minimumFractionDigits: 0 }).format(item.precio * item.cantidad);

        const htmlItem = `
            <li class="d-flex align-items-center mb-3 pb-2 border-bottom">
                <img src="${item.imagen}" style="width: 50px; height: 50px; object-fit: contain;" class="me-2">
                <div class="flex-grow-1" style="font-size: 0.9rem;">
                    <h6 class="mb-0 fw-bold" style="font-size: 0.95rem;">${item.nombre}</h6>
                    <small class="text-muted">Talle: ${item.talle} | Cant: ${item.cantidad}</small>
                    <div class="fw-semibold text-dark">$${precioFormateado}</div>
                </div>
            </li>
        `;
        container.insertAdjacentHTML('beforeend', htmlItem);
    });

    
    if (totalCantidad > 0) {
        badge.textContent = totalCantidad;
        badge.classList.remove('d-none');
    } else {
        badge.classList.add('d-none');
    }
    const dropdownToggle = document.getElementById('cartDropdown');
    const dropdownInstance = bootstrap.Dropdown.getOrCreateInstance(dropdownToggle);
    dropdownInstance.show();
}
</script>
</body>
</html>