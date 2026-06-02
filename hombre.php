<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hombre | Zapatilla, zapatos y más</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
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
          <li class="nav-item">
            <a class="nav-link active fs-5" aria-current="page" href="hombre.php">Hombre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fs-5" href="#">Mujer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fs-5" href="#">Niños/as</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"> 
            <?php 
            session_start();
            if (isset($_SESSION['usuario_logueado'])) {
                echo '<span class="nav-link fs-5 d-inline-flex align-items-center" style="color: inherit;">' . $_SESSION['usuario_logueado'];
            } else {
                echo '<a class="nav-link active fs-5" href="login.php">Login</a>';
            }
            ?>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-basket3 align-middle" viewBox="0 0 16 16">
                      <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM3.394 15l-1.48-6h-.97l1.525 6.426a.75.75 0 0 0 .729.574h9.606a.75.75 0 0 0 .73-.574L15.056 9h-.972l-1.479 6z"/>
              </svg>
            </a>
          </li>
        </ul>
      </div>
  </div>
</nav>
</header>
<div class="container-fluid px-3">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
    <?php
    include("conexion.php");
    $consulta_productos = mysqli_query($conexion, "SELECT * FROM productos WHERE activo = 'S' AND id_categoria_fk = 1");

    while ($producto = mysqli_fetch_array($consulta_productos)) {
    ?>
      <div class="col">
        <div class="card h-100">
          <img src="<?php echo $producto['imagen']; ?>" class="card-img-top" alt="Foto de <?php echo $producto['nombre_producto']; ?>">
            
          <div class="card-body">
            <h5 class="card-title"><?php echo $producto['nombre_producto']; ?></h5>
              
            <p class="card-text">$<?php echo number_format($producto['precio'], 0, ',', '.'); ?></p>
              
            <a href="#" class="btn btn-dark">Agregar</a>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>