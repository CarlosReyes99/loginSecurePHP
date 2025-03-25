<?php
    include('../conexion.php');
    $con = conectaDB();

    $idp = $_GET['idp'];

    $sql = "DELETE FROM tb_productos WHERE idPro = ".$idp;
    $resultado = mysqli_query($con,$sql);

    if ($resultado){
        header("Location: ../dashboard.php");
    } else {
        echo "Error al eliminar el producto";
    }
?>
