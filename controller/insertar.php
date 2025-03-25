<?php
    require '../conexion.php';
    $conexion = conectaDB();

    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];
    $ext = $_POST['ext'];

    $sql = "INSERT INTO tb_productos (Nombre, Precio, Ext, existencia) VALUES ('$nombre', '$precio', '$ext', '$existencia')";

    if (mysqli_query($conexion, $sql)) {
        echo json_encode(array('success' => 1, 'message' => 'Producto registrado correctamente'));
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Error al registrar el producto: ' . mysqli_error($conexion)));
    }

    mysqli_close($conexion);
?>
