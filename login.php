<?php 
include("conexion.php");
$error = "";
if (isset($_POST["usuario"])) {
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];

  $chequeo = mysqli_query($conexion,"SELECT nombre_usuario FROM usuario");
  $chequeo_contra=mysqli_query($conexion,"SELECT password_hash FROM usuario WHERE nombre_usuario = '$usuario'");
  $fila_usuario = mysqli_fetch_array($chequeo);
  $fila_contra= mysqli_fetch_array($chequeo_contra);
  if ($usuario != $fila_usuario["nombre_usuario"]) {
    $error = "Ese nombre de usuario no existe.";
  } elseif ($contrasena != $fila_contra["password_hash"]) {
    $error = "Contraseña incorrecta.";
  } else {
        session_start();
        $_SESSION['usuario_logueado'] = $fila_usuario['nombre_usuario']; 
        header("Location: index.php");
        exit();
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Zapatilla, zapatos y más</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div id="login" class="d-flex justify-content-center align-items-center vh-100" style="background-color: #a88a69;">
      <div class="col-11 col-sm-8 col-md-5 col-lg-4 px-3">
        
        <div class="card shadow-sm border-0 p-4 bg-white rounded-4" style="background-color: #b99e7f !important;">
        <form method="POST" action="login.php">
          <div class="text-center mb-4">
            <h4 class="fw-bold text-dark">Iniciar Sesión</h4>
            <small class="text-muted">Accede a Palomino-Alvarez Gran Calzado</small>
          </div>

          <div class="mb-3">
            <label for="usuario" class="form-label fw-semibold text-secondary">Nombre de usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="ejemplo@correo.com">
          </div>
          
          <div class="mb-4">
            <label for="inputPassword5" class="form-label fw-semibold text-secondary">Contraseña</label>
            <div class="input-group">
              <input type="password" name="contrasena" id="inputPassword5" class="form-control">
              <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword(this)">
                <i class="bi bi-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="btn btn-dark w-100 py-2 rounded-3 mb-3">Ingresar</button>
          <?php if ($error != ""): ?>
              <p style="color: red; font-weight: bold; margin-top: 15px;">
                  <?php echo $error; ?>
              </p>
          <?php endif; ?>
          <p class="text-center small text-muted mb-0">
            ¿No tienes cuenta? <a href="crear.html" class="text-decoration-none fw-bold text-dark">Regístrate</a>
          </p>
        </form>
        </div>

      </div>
    </div>

<script>
  function togglePassword(btn) {
    const input = document.getElementById('inputPassword5');
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
      input.type = 'text';
      icon.className = 'bi bi-eye-slash';
    } else {
      input.type = 'password';
      icon.className = 'bi bi-eye';
    }
  }
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>





