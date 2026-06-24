<?php
include("conexion.php");
 
if(isset($_POST["guardar"])){
    $id = $_POST["id_pedido"];
    $estado = $_POST["estado_pedido"];
    $fecha_entrega = $_POST["fecha_entrega_estimada"];
    $transporte = $_POST["empresa_transporte_fk"];
    mysqli_query($conexion, "UPDATE pedido SET estado_pedido = '$estado', fecha_entrega_estimada = '$fecha_entrega', empresa_transporte_fk = '$transporte' WHERE id_pedido = '$id'");
    header("Location: pedidos.php");
    exit();
}

$id = $_GET["id"];
$resultado = mysqli_query($conexion, "SELECT * FROM pedido WHERE id_pedido = $id");
$pedido = mysqli_fetch_assoc($resultado);

$resultado_transporte = mysqli_query($conexion, "SELECT * FROM transporte");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Pedido</title>
</head>
<body>
    <h1>Editar Pedido #<?= $pedido['id_pedido'] ?></h1>
    <form method="POST" action="editar_pedido.php">
        <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">

        <label>Estado</label>
        <select name="estado_pedido">
            <?php
            $estados = ['pendiente', 'preparacion', 'viaje', 'completado', 'devolucion', 'cancelado'];
            foreach ($estados as $estado) {
                $selected = ($pedido['estado_pedido'] == $estado) ? "selected" : "";
                echo "<option value='$estado' $selected>$estado</option>";
            }
            ?>
        </select>

        <label>Fecha de entrega estimada</label>
        <input type="date" name="fecha_entrega_estimada" value="<?= $pedido['fecha_entrega_estimada'] ?>">

        <label>Transporte</label>
        <select name="empresa_transporte_fk">
            <?php while($transporte = mysqli_fetch_assoc($resultado_transporte)) {
                $selected = ($pedido['empresa_transporte_fk'] == $transporte['id_transporte']) ? "selected" : "";
                echo "<option value='" . $transporte['id_transporte'] . "' $selected>" . $transporte['empresa'] . "</option>";
            } ?>
        </select>

        <button type="submit" name="guardar">Guardar</button>
    </form>
</body>
</html>