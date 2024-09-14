<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén los datos del formulario y realiza la validación correspondiente
$cod_cohorte = $_POST['cod_cohorte'] ?? '';
$nombre_cohorte = $_POST['nombre_cohorte'] ?? '';
$fecha_inicio = $_POST['fecha_inicio'] ?? '';
$fecha_finalizacion = $_POST['fecha_finalizacion'] ?? '';
$N_estudiantes = $_POST['N_estudiantes'] ?? '';

// Validaciones básicas
if (empty($cod_cohorte) || empty($nombre_cohorte) || empty($fecha_inicio) || empty($fecha_finalizacion) || empty($N_estudiantes)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/cohortes/create_cohorte.php");
    exit();
}



// Prepara la sentencia SQL para insertar un nuevo coordinador
$sentencia = $pdo->prepare("INSERT INTO cohorte
    (cod_cohorte, nombre_cohorte, fecha_inicio, fecha_finalizacion, N_estudiantes) 
    VALUES (:cod_cohorte, :nombre_cohorte, :fecha_inicio, :fecha_finalizacion, :N_estudiantes)");

$sentencia->bindParam(':cod_cohorte', $cod_cohorte);
$sentencia->bindParam(':nombre_cohorte', $nombre_cohorte);
$sentencia->bindParam(':fecha_inicio', $fecha_inicio);
$sentencia->bindParam(':fecha_finalizacion', $fecha_finalizacion);
$sentencia->bindParam(':N_estudiantes', $N_estudiantes);

try {
    // Ejecuta la sentencia SQL
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Cohorte registrada con éxito";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . "/admin/cohortes");
        exit();
    }
} catch (PDOException $e) {
    // Maneja posibles errores
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/cohortes/create_cohorte.php");
    exit();
}
?>
