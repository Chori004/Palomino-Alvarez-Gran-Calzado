<?php
include("conexion.php");

$id = $_GET["id"];

$sql= "DELETE FROM transporte WHERE id_transporte='$id'";

mysqli_query($conexion, $sql);

header('Location: transporte.php');
?>