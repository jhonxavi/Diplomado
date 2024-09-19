<?php
// Incluye la configuración para la conexión a la base de datos
include('../../../app/config.php');

// Inicia la sesión
session_start();

// Verifica si se ha recibido el ID del estudiante a eliminar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_estudiante']) && !empty($_POST['id_estudiante'])) {
    // Obtén el ID del estudiante
    $id_estudiante = intval($_POST['id_estudiante']);

    // Prepara la sentencia SQL para eliminar al estudiante
    $sql = "DELETE FROM estudiante WHERE id_estudiante = :id_estudiante";
    $sentencia = $pdo->prepare($sql);
    $sentencia->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);

    try {
        // Ejecuta la sentencia
        if ($sentencia->execute()) {
            $_SESSION['mensaje'] = "Estudiante eliminado con éxito.";
            $_SESSION['icono'] = "success";
        } else {
            $_SESSION['mensaje'] = "No se pudo eliminar el estudiante.";
            $_SESSION['icono'] = "error";
        }
    } catch (PDOException $e) {
        // Captura posibles errores y los maneja
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
        $_SESSION['icono'] = "error";
    }
} else {
    $_SESSION['mensaje'] = "ID del estudiante no proporcionado.";
    $_SESSION['icono'] = "error";
}

// Redirige al listado de estudiantes
header('Location: ' . APP_URL . '/admin/estudiantes/index.php');
exit();
?>
