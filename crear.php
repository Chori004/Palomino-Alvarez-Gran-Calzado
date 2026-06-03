<?php
include("conexion.php");
if (isset($_POST["nombre"])) {
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $email = $_POST["email"];
  $telefono = $_POST["telefono"];
  $direccion = $_POST["direccion"];
  $provincia = $_POST["provincia"];
  $localidad = $_POST["localidad"];
  $codigo_postal = $_POST["cp"];
  $fecha_nacimiento = $_POST["nacimiento"];
  $tipo_documento = $_POST["documentos"];
  $documento = $_POST["documento"];
  $nombre_usuario = $_POST["usuario2"];
  $password_hash = $_POST["contrasena2"];
  $repetir_contrasen = $_POST["contrasena3"];
  
  if ($password_hash != $repetir_contrasen) {
    echo "Las contraseñas no coinciden";
  } else {
      $resultado=mysqli_query($conexion, "INSERT INTO usuario
        (documento, id_tipodocumento_fk, nombre, apellido, email, telefono, direccion, provincia, localidad, codigo_postal, fecha_nacimiento, nombre_usuario, password_hash, id_rol_fk)
        VALUES ('$documento', '$tipo_documento', '$nombre', '$apellido', '$email', '$telefono', '$direccion', '$provincia', '$localidad', '$codigo_postal', '$fecha_nacimiento', '$nombre_usuario', '$password_hash', 3)");
      if (!$resultado) {
        $texto_error=mysqli_error($conexion);
        if (strpos($texto_error,"email") !== false) {
          echo "El email ya esta registrado. Intente con otro.";
        } elseif (strpos($texto_error,"nombre_usuario") !== false) {
          echo "El nombre de usuario ya está en uso. Elija uno diferente";
        } elseif (strpos($texto_error,"documento") !== false) {
          echo "El número de documento ya pertenece a un usuario registrado.";
        } else {
          echo "Alguno de los datos ingresados ya se encuentra registrado.";
        }

      } else {
        header("Location: login.php");
      }
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
  
<div class="d-flex justify-content-center align-items-center min-vh-100 py-5" style="background-color: #a88a69;">
  <div class="card shadow-sm border-0 p-4 bg-white rounded-4 col-11 col-sm-10 col-md-8 col-lg-6" style="background-color: #b99e7f !important;">
    
    <div class="text-center mb-4">
      <h4 class="fw-bold text-dark">Crear Cuenta</h4>
      <small class="text-muted">Completa tus datos para registrarte en Alvarez y Asociados</small>
    </div>

    <form method="POST" action="crear.php">
      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="nombre" class="form-label fw-semibold text-secondary">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control">
        </div>
        <div class="col-12 col-md-6">
          <label for="apellido" class="form-label fw-semibold text-secondary">Apellido</label>
          <input type="text" name="apellido" id="apellido" class="form-control">
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="email" class="form-label fw-semibold text-secondary">Email</label>
          <input type="text" name="email" id="email" class="form-control" placeholder="ejemplo@empresa.com">
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold text-secondary">Género</label>
          <div class="d-flex align-items-center gap-3 py-2">
            <div class="form-check">
              <input class="form-check-input" name="genero" type="radio" name="radioDefault" id="radioDefault1">
              <label class="form-check-label" href="#radioDefault1">Hombre</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" name="genero" type="radio" name="radioDefault" id="radioDefault2">
              <label class="form-check-label" for="radioDefault2">Mujer</label>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="telefono" class="form-label fw-semibold text-secondary">Teléfono</label>
          <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="Ej: 1112345678">
        </div>
        <div class="col-12 col-md-6">
          <label for="direccion" class="form-label fw-semibold text-secondary">Dirección</label>
          <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ej: Av. Cabildo 1979">
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="provincia" class="form-label fw-semibold text-secondary">Provincia</label>
          <select name="provincia" id="provincia" class="form-select">
            <option selected>Seleccione una provincia</option>
            <option value="Buenos Aires">Buenos Aires</option>
            <option value="Catamarca">Catamarca</option>
            <option value="Chaco">Chaco</option>
            <option value="Chubut">Chubut</option>
            <option value="Ciudad Autónoma de Buenos Aires">Ciudad Autónoma de Buenos Aires</option>
            <option value="Córdoba">Córdoba</option>
            <option value="Corrientes">Corrientes</option>
            <option value="Entre Ríos">Entre Ríos</option>
            <option value="Formosa">Formosa</option>
            <option value="Jujuy">Jujuy</option>
            <option value="La Pampa">La Pampa</option>
            <option value="La Rioja">La Rioja</option>
            <option value="Mendoza">Mendoza</option>
            <option value="Misiones">Misiones</option>
            <option value="Neuquén">Neuquén</option>
            <option value="Río Negro">Río Negro</option>
            <option value="Salta">Salta</option>
            <option value="San Juan">San Juan</option>
            <option value="San Luis">San Luis</option>
            <option value="Santa Cruz">Santa Cruz</option>
            <option value="Santa Fe">Santa Fe</option>
            <option value="Santiago del Estero">Santiago del Estero</option>
            <option value="Tierra del Fuego">Tierra del Fuego</option>
            <option value="Tucumán">Tucumán</option>
          </select>
        </div>
        <div class="col-12 col-md-6">
          <label for="localidad" class="form-label fw-semibold text-secondary">Localidad</label>
          <input type="text" name="localidad" id="localidad" class="form-control">
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="codigo_postal" class="form-label fw-semibold text-secondary">Codigo Postal</label>
          <input type="text" name="cp" id="codigo_postal" class="form-control">
        </div>
        <div class="col-12 col-md-6">
          <label for="fecha_nacimiento" class="form-label fw-semibold text-secondary">Fecha de nacimiento</label>
          <input type="date" name="nacimiento" id="fecha_nacimiento" class="form-control">
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="documentos" class="form-label fw-semibold text-secondary">Documentos</label>
          <select name="documentos" id="documentos" class="form-select" aria-label="Default select example">
            <option selected>Seleccione el tipo de documento</option>
            <option value="1">DNI</option>
            <option value="2">Pasaporte</option>
            <option value="3">CUIT</option>
            <option value="4">CI</option>
            <option value="5">ERRO</option>
            <option value="6">LC</option>
            <option value="7">LE</option>
            <option value="8">LEM</option>
          </select>
        </div>
        <div class="col-12 col-md-6">
          <label for="documento" class="form-label fw-semibold text-secondary">Documento</label>
          <input type="text" name="documento" id="documento" class="form-control" oninput="soloNumeros(this)">
        </div>
      </div>

      <div class="row g-3 mb-3">
        <div class="col-12 col-md-6">
          <label for="usuario2" class="form-label fw-semibold text-secondary">Nombre de usuario</label>
          <input type="text" name="usuario2" id="usuario2" class="form-control">
        </div>
        <div class="col-12 col-md-6">
          <label for="contrasena2" class="form-label fw-semibold text-secondary">Nueva contraseña</label>
          <div class="input-group">
            <input type="password" name="contrasena2" id="contrasena2" class="form-control">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword(this)">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-12 col-md-6">
          <label for="contrasena3" class="form-label fw-semibold text-secondary">Repetir contraseña</label>
          <div class="input-group">
            <input type="password" name="contrasena3" id="contrasena3" class="form-control">
            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword2(this)">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-dark w-100 py-2 rounded-3">Crear</button>
      </div>
    </form>

  </div>
</div>
<script>
  function togglePassword(btn) {
    const input = document.getElementById('contrasena2');
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
  function soloNumeros(input) {
  input.value = input.value.replace(/[^0-9]/g, '');
}
</script>
<script>
  function togglePassword2(btn) {
    const input = document.getElementById('contrasena3');
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