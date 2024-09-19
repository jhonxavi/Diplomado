<?php
include('../../../app/config.php');

session_start();

// Verifica si se ha recibido el snies a eliminar
if (!isset($_POST['snies']) || empty($_POST['snies'])) {
    $_SESSION['mensaje'] = "ID del programa no proporcionado.";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . '/admin/programas/index.php');
    exit();
}

// Obtén el snies
$snies = intval($_POST['snies']);

// Prepara la sentencia SQL para eliminar el programa
$sql = "DELETE FROM programas WHERE snies = :snies"; // Asegúrate de que la tabla sea la correcta
$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':snies', $snies, PDO::PARAM_INT);

try {
    // Ejecuta la sentencia
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Programa eliminado con éxito.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar el programa.";
        $_SESSION['icono'] = "error";
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

// Redirige al listado de programas
header('Location: ' . APP_URL . '/admin/programas/index.php');
exit();
?>
