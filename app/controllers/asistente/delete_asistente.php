<?php
include('../../../app/config.php');

session_start();

// Verifica si se ha recibido el id_asistente a eliminar
if (!isset($_POST['id_asistente']) || empty($_POST['id_asistente'])) {
    $_SESSION['mensaje'] = "ID del asistente no proporcionado.";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . '/admin/asistente/index.php');
    exit();
}

// Obtén el id_asistente
$id_asistente = intval($_POST['id_asistente']);

// Prepara la sentencia SQL para eliminar el coordinador
$sql = "DELETE FROM asistente WHERE id_asistente = :id_asistente"; // Asegúrate de que la tabla sea la correcta
$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':id_asistente', $id_asistente, PDO::PARAM_INT);

try {
    // Ejecuta la sentencia
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Asistente eliminado con éxito.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar el asistente.";
        $_SESSION['icono'] = "error";
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

// Redirige al listado de asistentes
header('Location: ' . APP_URL . '/admin/asistente/index.php');
exit();
?>
