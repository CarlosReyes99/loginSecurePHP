<?php
    include('../conexion.php');
    $con = conectaDB();

    $idp = $_POST['idp'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];

    $sql = "UPDATE tb_productos SET Nombre = '$nombre', Precio = '$precio', Existencia = '$existencia' WHERE idPro = ".$idp;

    if (mysqli_query($con, $sql)) {
        echo "<div class='alert alert-success' role='alert'>Producto actualizado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar el producto: " . mysqli_error($con) . "</div>";
    }

    mysqli_close($con);
?>
