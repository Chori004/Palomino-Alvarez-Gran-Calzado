<?php
include("conexion.php");

$id = $_GET["id"] ?? $_POST["id_reserva"];
$resultado = mysqli_query($conexion, "SELECT * FROM reserva WHERE id_reserva = $id");
$reserva = mysqli_fetch_assoc($resultado);

if(isset($_POST["guardar"])){
    $estado = $_POST["estado_reserva"];
    mysqli_query($conexion, "UPDATE reserva SET estado_reserva = '$estado' WHERE id_reserva = '$id'");
    header("Location: reserva.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Editar Reserva #<?= $reserva['id_reserva'] ?></h1>
    <form method="POST" action="editar_reserva.php">
        <input type="hidden" name="id_reserva" value="<?= $reserva['id_reserva'] ?>">

        <label>Estado</label>
        <select name="estado_reserva">
            <?php
            $estados = ['pendiente', 'cancelado', 'retirado', 'expirado'];
            foreach ($estados as $estado) {
                $selected = ($reserva['estado_reserva'] == $estado) ? "selected" : "";
                echo "<option value='$estado' $selected>$estado</option>";
            }
            ?>
        </select>

        <button type="submit" name="guardar">Guardar</button>
    </form>
</body>
</html>