<?php
include('conexion.php');
$sql = "SELECT * FROM productos LIMIT 4";
$productos = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calzado | Zapatilla, zapatos y más</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
</style>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #9e8466;" data-bs-theme="light">
    <div class="container-fluid">
      <a class="navbar-brand fs-3 fw-bold" href="index.html">Palomino-Alvarez Gran Calzado</a>
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
            session_start();
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
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner h-100">
    <div class="carousel-item active h-100">
      <img src="https://i.ibb.co/yFSCzq86/banner-1920x800.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="...">
    </div>
    <div class="carousel-item h-100">
      <img src="https://i.ibb.co/9m9V99Nc/460e5561-aec2-4122-93b5-250454f81024.png" class="d-block w-100 h-100" style="object-fit: cover;" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <div class="logos">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
            </svg>  
    </div>
  <div class="container mt-4 mb-4">
    <h5 class="mb-3">Podría interesarte:</h5>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

      <?php while($producto = mysqli_fetch_assoc($productos)) { ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?php echo $producto['imagen']; ?>" class="card-img-top img-card" alt="...">
          <div class="card-body">
            <h6 class="card-title"><?php echo $producto['nombre_producto']; ?></h6>
            <p class="card-text">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>
            <a href="hombre.php" class="btn btn-dark btn-sm">Ver más</a>
          </div>
        </div>
      </div>
      <?php } ?>

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
          <form>
          <label for="exampleFormControlInput1" class="form-label mb-2">Ingrese su email</label>
          <input type="email" class="form-control mb-2" name="mail" id="exampleFormControlInput1" placeholder="ejemplo@ejemplo.com">
          <button type="submit" class="btn btn-outline-light btn-sm w-100">Enviar</button>
          </form>
          <?php if (isset($_POST['mail'])) {
            echo "<div class='alert alert-success mt-2 p-2 small text-center'>¡Ha sido agregado a nuestros contactos!</div>";
          }
          ?>
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