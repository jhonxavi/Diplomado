<?php
include('../../../app/config.php');

session_start();

// Verifica si se ha recibido el cod_cohorte a eliminar
if (!isset($_POST['cod_cohorte']) || empty($_POST['cod_cohorte'])) {
    $_SESSION['mensaje'] = "ID de la cohorte no proporcionado.";
    $_SESSION['icono'] = "error";
    header('Location: ' . APP_URL . '/admin/cohortes/index.php');
    exit();
}

// Obtén el cod_cohorte
$cod_cohorte = intval($_POST['cod_cohorte']);

// Prepara la sentencia SQL para eliminar el cohortes
$sql = "DELETE FROM cohorte WHERE cod_cohorte = :cod_cohorte"; // Asegúrate de que la tabla sea la correcta
$sentencia = $pdo->prepare($sql);
$sentencia->bindParam(':cod_cohorte', $cod_cohorte, PDO::PARAM_INT);

try {
    // Ejecuta la sentencia
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Cohorte eliminado con éxito.";
        $_SESSION['icono'] = "success";
    } else {
        $_SESSION['mensaje'] = "No se pudo eliminar el Cohorte.";
        $_SESSION['icono'] = "error";
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
}

// Redirige al listado de cohortes
header('Location: ' . APP_URL . '/admin/cohortes/index.php');
exit();
?>
