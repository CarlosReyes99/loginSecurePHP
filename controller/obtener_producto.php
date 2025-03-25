<?php
    include('../conexion.php');
    $con = conectaDB();

    $idp = $_POST['idp'];

    $sql = "SELECT Nombre, Precio, Existencia FROM tb_productos WHERE idPro = ".$idp;
    $resultado = mysqli_query($con, $sql);

    if(mysqli_num_rows($resultado) == 1){
        $fila = mysqli_fetch_assoc($resultado);
        $producto = array(
            'nombre' => $fila['Nombre'],
            'precio' => $fila['Precio'],
            'existencia' => $fila['Existencia']
        );
        echo json_encode($producto);
    } else {
        echo json_encode(array('error' => 'Producto no encontrado'));
    }
?>
