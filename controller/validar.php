<?php
// Desactivar errores para evitar corrupción del JSON
error_reporting(0);
ob_start();

header('Content-Type: application/json');

try {
    include('../conexion.php');
    $con = conectaDB();

    $username = $_POST['loginUsername'] ?? '';
    $password = $_POST['loginPassword'] ?? '';

    $sql = "SELECT idUser, NomUser, Passwd, NiveUser FROM tb_usuarios WHERE NomUser = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    if (!$stmt) {
        throw new Exception("Error en preparación: " . mysqli_error($con));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        
        if (password_verify($password, $fila['Passwd'])) {
            session_start();
            $_SESSION['login'] = "true";
            $_SESSION['nomusuario'] = $fila['NomUser'];
            $_SESSION['nivel'] = $fila['NiveUser'];
            
            // Respuesta limpia
            ob_end_clean();
            die(json_encode(['success' => 1]));
        } else {
            ob_end_clean();
            die(json_encode(['success' => 0, 'message' => 'Contraseña incorrecta']));
        }
    } else {
        ob_end_clean();
        die(json_encode(['success' => 0, 'message' => 'Usuario no encontrado']));
    }

} catch (Exception $e) {
    ob_end_clean();
    die(json_encode([
        'success' => 0,
        'message' => 'Error interno: ' . $e->getMessage()
    ]));
}
?>