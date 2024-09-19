<?php
include('../../../app/config.php');

// Verificar si ya hay una sesión activa antes de iniciar una nueva
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirigirConMensaje($mensaje, $icono, $url) {
    $_SESSION['mensaje'] = $mensaje;
    $_SESSION['icono'] = $icono;
    header('Location: ' . APP_URL . $url);
    exit();
}

// Obtener los datos del formulario
$cod_cohorte = $_POST['cod_cohorte'] ?? '';
$nombre_cohorte = $_POST['nombre_cohorte'] ?? '';
$fecha_inicio = $_POST['fecha_inicio'] ?? '';
$fecha_finalizacion = $_POST['fecha_finalizacion'] ?? '';
$N_estudiantes = $_POST['N_estudiantes'] ?? '';

// Validaciones básicas
if (empty($cod_cohorte) || empty($nombre_cohorte) || empty($fecha_inicio) || empty($fecha_finalizacion) || empty($N_estudiantes)) {
    redirigirConMensaje("Todos los campos son obligatorios", "error", "/admin/cohortes/edit_cohorte.php?cod_cohorte=$cod_cohorte");
}

// Verificación de duplicados (excluyendo la cohorte actual)
$sentencia_verificacion = $pdo->prepare("SELECT COUNT(*) FROM cohorte WHERE (nombre_cohorte = :nombre_cohorte) AND cod_cohorte != :cod_cohorte");
$sentencia_verificacion->bindParam(':nombre_cohorte', $nombre_cohorte);
$sentencia_verificacion->bindParam(':cod_cohorte', $cod_cohorte);
$sentencia_verificacion->execute();

if ($sentencia_verificacion->fetchColumn() > 0) {
    redirigirConMensaje("El nombre de la cohorte ya está registrado", "error", "/admin/cohortes/edit_cohorte.php?cod_cohorte=$cod_cohorte");
}

// Obtener los datos actuales de la cohorte
$sentencia = $pdo->prepare("SELECT * FROM cohorte WHERE cod_cohorte = :cod_cohorte");
$sentencia->bindParam(':cod_cohorte', $cod_cohorte);
$sentencia->execute();
$cohorte = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$cohorte) {
    redirigirConMensaje("Cohorte no encontrada", "error", "/admin/cohortes");
}

// Actualización de la cohorte
$sentencia = $pdo->prepare("UPDATE cohorte
    SET nombre_cohorte = :nombre_cohorte, fecha_inicio = :fecha_inicio, fecha_finalizacion = :fecha_finalizacion, N_estudiantes = :N_estudiantes 
    WHERE cod_cohorte = :cod_cohorte");

$sentencia->bindParam(':nombre_cohorte', $nombre_cohorte);
$sentencia->bindParam(':fecha_inicio', $fecha_inicio);
$sentencia->bindParam(':fecha_finalizacion', $fecha_finalizacion);
$sentencia->bindParam(':N_estudiantes', $N_estudiantes);
$sentencia->bindParam(':cod_cohorte', $cod_cohorte);

try {
    $pdo->beginTransaction();
    $sentencia->execute();
    $pdo->commit();
    redirigirConMensaje("Cohorte actualizada con éxito", "success", "/admin/cohortes");
} catch (PDOException $e) {
    $pdo->rollBack();
    redirigirConMensaje("Error en la base de datos: " . $e->getMessage(), "error", "/admin/cohortes/edit_cohorte.php?cod_cohorte=$cod_cohorte");
}
?>
