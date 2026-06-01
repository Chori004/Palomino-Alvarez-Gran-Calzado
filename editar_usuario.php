<?php
include("conexion.php");

$id = $_GET["id"];
$resultado = mysqli_query($conexion, "SELECT * FROM usuario WHERE id_usuario = $id");
$usuario = mysqli_fetch_assoc($resultado);

if (isset($_POST["guardar_nombre"])) {
    $nombre = $_POST["nombre"];
    mysqli_query($conexion, "UPDATE usuario SET nombre='$nombre' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_apellido"])) {
    $apellido = $_POST["apellido"];
    mysqli_query($conexion, "UPDATE usuario SET apellido='$apellido' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_email"])) {
    $email = $_POST["email"];
    mysqli_query($conexion, "UPDATE usuario SET email='$email' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_telefono"])) {
    $telefono = $_POST["telefono"];
    mysqli_query($conexion, "UPDATE usuario SET telefono='$telefono' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_direccion"])) {
    $direccion = $_POST["direccion"];
    mysqli_query($conexion, "UPDATE usuario SET direccion='$direccion' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_provincia"])) {
    $provincia = $_POST["provincia"];
    mysqli_query($conexion, "UPDATE usuario SET provincia='$provincia' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_localidad"])) {
    $localidad = $_POST["localidad"];
    mysqli_query($conexion, "UPDATE usuario SET localidad='$localidad' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_cp"])) {
    $cp = $_POST["codigo_postal"];
    mysqli_query($conexion, "UPDATE usuario SET codigo_postal='$cp' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_nacimiento"])) {
    $nacimiento = $_POST["fecha_nacimiento"];
    mysqli_query($conexion, "UPDATE usuario SET fecha_nacimiento='$nacimiento' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_nombre_usuario"])) {
    $nombre_usuario = $_POST["nombre_usuario"];
    mysqli_query($conexion, "UPDATE usuario SET nombre_usuario='$nombre_usuario' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_password"])) {
    $password = $_POST["password_hash"];
    mysqli_query($conexion, "UPDATE usuario SET password_hash='$password' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_documento"])) {
    $documento = $_POST["documento"];
    mysqli_query($conexion, "UPDATE usuario SET documento='$documento' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_tipo_documento"])) {
    $tipo_documento = $_POST["id_tipodocumento_fk"];
    mysqli_query($conexion, "UPDATE usuario SET id_tipodocumento_fk='$tipo_documento' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
if (isset($_POST["guardar_rol"])) {
    $rol = $_POST["id_rol_fk"];
    mysqli_query($conexion, "UPDATE usuario SET id_rol_fk='$rol' WHERE id_usuario=$id");
    header("Location: editar_usuario.php?id=$id");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; margin: 20px; }
        h1 { color: #333; }
        form { background: white; padding: 15px; margin-bottom: 10px; border-radius: 5px; display: flex; align-items: center; gap: 10px; }
        label { width: 180px; font-weight: bold; }
        input, select { padding: 8px; flex: 1; }
        button { padding: 8px 15px; background: #007bff; color: white; border: none; cursor: pointer; border-radius: 3px; }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <a href="usuarios.php">← Volver</a>
    <h1>Editando usuario: <?= $usuario['nombre_usuario'] ?></h1>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>">
        <button type="submit" name="guardar_nombre">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Apellido</label>
        <input type="text" name="apellido" value="<?= $usuario['apellido'] ?>">
        <button type="submit" name="guardar_apellido">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Email</label>
        <input type="text" name="email" value="<?= $usuario['email'] ?>">
        <button type="submit" name="guardar_email">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Teléfono</label>
        <input type="text" name="telefono" value="<?= $usuario['telefono'] ?>">
        <button type="submit" name="guardar_telefono">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Dirección</label>
        <input type="text" name="direccion" value="<?= $usuario['direccion'] ?>">
        <button type="submit" name="guardar_direccion">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Provincia</label>
        <select name="provincia">
            <?php
            $provincias = ["Buenos Aires", "Catamarca", "Chaco", "Chubut", "Ciudad Autónoma de Buenos Aires", "Córdoba", "Corrientes", "Entre Ríos", "Formosa", "Jujuy", "La Pampa", "La Rioja", "Mendoza", "Misiones", "Neuquén", "Río Negro", "Salta", "San Juan", "San Luis", "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", "Tucumán"];
            foreach ($provincias as $p) {
                $selected = ($usuario['provincia'] == $p) ? "selected" : "";
                echo "<option value='$p' $selected>$p</option>";
            }
            ?>
        </select>
        <button type="submit" name="guardar_provincia">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Localidad</label>
        <input type="text" name="localidad" value="<?= $usuario['localidad'] ?>">
        <button type="submit" name="guardar_localidad">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Código Postal</label>
        <input type="text" name="codigo_postal" value="<?= $usuario['codigo_postal'] ?>">
        <button type="submit" name="guardar_cp">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>">
        <button type="submit" name="guardar_nacimiento">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Nombre de Usuario</label>
        <input type="text" name="nombre_usuario" value="<?= $usuario['nombre_usuario'] ?>">
        <button type="submit" name="guardar_nombre_usuario">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Contraseña</label>
        <input type="text" name="password_hash" value="<?= $usuario['password_hash'] ?>">
        <button type="submit" name="guardar_password">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Documento</label>
        <input type="text" name="documento" value="<?= $usuario['documento'] ?>">
        <button type="submit" name="guardar_documento">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Tipo de Documento</label>
        <select name="id_tipodocumento_fk">
            <?php
            $tipos = [1=>"DNI", 2=>"Pasaporte", 3=>"CUIT", 4=>"CI", 5=>"ERRO", 6=>"LC", 7=>"LE", 8=>"LEM"];
            foreach ($tipos as $id_tipo => $nombre_tipo) {
                $selected = ($usuario['id_tipodocumento_fk'] == $id_tipo) ? "selected" : "";
                echo "<option value='$id_tipo' $selected>$nombre_tipo</option>";
            }
            ?>
        </select>
        <button type="submit" name="guardar_tipo_documento">Editar</button>
    </form>

    <form method="POST" action="editar_usuario.php?id=<?= $id ?>">
        <label>Rol</label>
        <select name="id_rol_fk">
            <?php
            $roles = [1=>"Vendedor", 2=>"Admin", 3=>"Usuario"];
            foreach ($roles as $id_rol => $nombre_rol) {
                $selected = ($usuario['id_rol_fk'] == $id_rol) ? "selected" : "";
                echo "<option value='$id_rol' $selected>$nombre_rol</option>";
            }
            ?>
        </select>
        <button type="submit" name="guardar_rol">Editar</button>
    </form>

</body>
</html>