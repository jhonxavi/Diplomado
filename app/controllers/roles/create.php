<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén y valida el nombre del rol
$nombre_rol = $_POST['nombre_rol'] ?? '';
$nombre_rol = mb_strtoupper(trim($nombre_rol), 'UTF-8');

// Verifica si el nombre del rol está vacío
if ($nombre_rol == "") {
    $_SESSION['mensaje'] = "Llene el campo nombre del rol";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/roles/create.php");
    exit();  // Termina la ejecución después de redirigir
}

// Inicializa las variables faltantes
$fechaHora = date('Y-m-d H:i:s');  // Fecha y hora actual
$estado_de_registro = 1;           // Estado activo por defecto

// Prepara la sentencia SQL
$sentencia = $pdo->prepare("INSERT INTO roles 
    (nombre_rol, fyh_creacion, estado) 
    VALUES (:nombre_rol, :fyh_creacion, :estado)");

$sentencia->bindParam(':nombre_rol', $nombre_rol);
$sentencia->bindParam(':fyh_creacion', $fechaHora);
$sentencia->bindParam(':estado', $estado_de_registro);

try {
    // Ejecuta la sentencia y verifica si fue exitosa
    if ($sentencia->execute()) {
        echo "Registrado con éxito";
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja (puedes personalizar este mensaje si lo deseas)
    echo "Error en la base de datos: " . $e->getMessage();
}
