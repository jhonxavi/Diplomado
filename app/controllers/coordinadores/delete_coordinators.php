<?php
include('../../../app/config.php');

session_start();

// Verifica si se ha recibido el id_coordinador a eliminar
if (!isset($_POST['id_cordi']) || empty($_POST['id_cordi'])) {
    $_SESSION['mensaje'] = "ID del coordinador no proporcionado.";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . '/admin/coordinadores/index.php');
    exit();
}

// Obtén el id_cordi
$id_cordi = intval($_POST['id_cordi']);

// Prepara la sentencia SQL para eliminar el coordinador
$sql = "DELETE FROM coordinadores WHERE id_cordi = :id_cordi"; // Asegúrate de que la tabla sea la correcta
$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':id_cordi', $id_cordi, PDO::PARAM_INT);

try {
    // Ejecuta la sentencia
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Coordinador eliminado con éxito.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar el coordinador.";
        $_SESSION['icono'] = "error";
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

// Redirige al listado de coordinadores
header('Location: ' . APP_URL . '/admin/coordinadores/index.php');
exit();
?>
