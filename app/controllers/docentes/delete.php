<?php
// Incluye la configuración para la conexión a la base de datos
include('../../../app/config.php');

// Inicia la sesión
session_start();

// Verifica si se ha recibido el ID del docente a eliminar
if (!isset($_GET['id_docente']) || empty($_GET['id_docente'])) {
    $_SESSION['mensaje'] = "ID del docente no proporcionado.";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . '/admin/docentes/index.php');
    exit();
}

// Obtén el ID del docente
$id_docente = intval($_GET['id_docente']);

// Prepara la sentencia SQL para eliminar al docente
$sql = "DELETE FROM docentes WHERE id_docente = :id_docente";
$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':id_docente', $id_docente, PDO::PARAM_INT);

try {
    // Ejecuta la sentencia
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Docente eliminado con éxito.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar el docente.";
        $_SESSION['icono'] = "error";
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

// Redirige al listado de docentes
header('Location: ' . APP_URL . '/admin/docentes/index.php');
exit();
?>
