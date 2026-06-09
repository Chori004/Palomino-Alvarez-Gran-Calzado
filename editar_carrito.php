<?php 
include("conexion.php");

$id = $_GET["id"] ?? $_POST["id_carrito"];

if (isset($_POST["guardar"])) {
    $id_variante = $_POST["id_variante_fk"];
    mysqli_query($conexion, "UPDATE carrito SET id_variante_fk = '$id_variante' WHERE id_carrito = '$id'");
    header("Location: carrito.php");
    exit();
}
$resultado = mysqli_query($conexion, "SELECT carrito.id_carrito, productos.nombre_producto, producto_variante.talle, producto_variante.id_variante FROM carrito 
                                        JOIN producto_variante ON carrito.id_variante_fk = producto_variante.id_variante
                                        JOIN productos ON producto_variante.id_producto_fk = productos.id_producto
                                        WHERE carrito.id_carrito = '$id'");

$carrito= mysqli_fetch_assoc($resultado);

$resultado_variantes = mysqli_query($conexion, "SELECT producto_variante.id_variante, producto_variante.talle
                                                FROM producto_variante
                                                JOIN productos ON producto_variante.id_producto_fk = productos.id_producto
                                                JOIN carrito ON productos.id_producto = producto_variante.id_producto_fk
                                                WHERE carrito.id_carrito = '$id' AND producto_variante.activo = 'S' AND producto_variante.vendido = 'N'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Editar Carrito #<?= $carrito['id_carrito'] ?></h1>
    <p>Producto: <?= $carrito['nombre_producto'] ?></p>

    <form method="POST" action="editar_carrito.php">
        <input type="hidden" name="id_carrito" value="<?= $carrito['id_carrito'] ?>">

        <label>Talle</label>
        <select name="id_variante_fk">
            <?php while($variante = mysqli_fetch_assoc($resultado_variantes)) {
                $selected = ($carrito['id_variante'] == $variante['id_variante']) ? "selected" : "";
                echo "<option value='" . $variante["id_variante"] . "' $selected>". $variante['talle'] . "</option>";
            } ?>
        </select>
        
        <button type="submit" name="guardar">Guardar</button>
    </form>
</body>
</html>