<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén y valida los datos del docente
$id_docente = $_POST['id_docente'] ?? '';  // Nuevo campo de identificación
$nombre_docente = $_POST['nombre_docente'] ?? '';
$dir_docente = $_POST['dir_docente'] ?? '';
$tel_docente = $_POST['tel_docente'] ?? '';
$email_docente = $_POST['email_docente'] ?? '';
$genero_docente = $_POST['genero_docente'] ?? '';
$fecha_nacimiento_docente = $_POST['fecha_nacimiento_docente'] ?? '';
$formacion_academica = $_POST['formacion_academica'] ?? '';
$areas_conocimiento = $_POST['areas_conocimiento'] ?? [];

// Convertir áreas de conocimiento a un string
$areas_conocimiento_str = implode(', ', $areas_conocimiento);

// Validar campos obligatorios
if (empty($id_docente) || empty($nombre_docente) || empty($dir_docente) || empty($tel_docente) || empty($email_docente) ||
    empty($genero_docente) || empty($fecha_nacimiento_docente) || empty($formacion_academica)) {
    $_SESSION['mensaje'] = "Por favor, llene todos los campos obligatorios.";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/docentes/create.php");
    exit();  // Termina la ejecución después de redirigir
}

// Inicializa las variables
$fechaHora = date('Y-m-d H:i:s');  // Fecha y hora actual
$estado_de_registro = 1;            // Estado activo por defecto

// Prepara la sentencia SQL para insertar los datos, incluyendo el campo id_docente
$sentencia = $pdo->prepare("INSERT INTO docentes 
    (id_docente, nombre_docente, dir_docente, tel_docente, email_docente, genero_docente, fecha_nacimiento_docente, 
    formacion_academica, areas_conocimiento) 
    VALUES (:id_docente, :nombre_docente, :dir_docente, :tel_docente, :email_docente, :genero_docente, 
    :fecha_nacimiento_docente, :formacion_academica, :areas_conocimiento)");

$sentencia->bindParam(':id_docente', $id_docente);  // Asignar el valor del campo id_docente
$sentencia->bindParam(':nombre_docente', $nombre_docente);
$sentencia->bindParam(':dir_docente', $dir_docente);
$sentencia->bindParam(':tel_docente', $tel_docente);
$sentencia->bindParam(':email_docente', $email_docente);
$sentencia->bindParam(':genero_docente', $genero_docente);
$sentencia->bindParam(':fecha_nacimiento_docente', $fecha_nacimiento_docente);
$sentencia->bindParam(':formacion_academica', $formacion_academica);
$sentencia->bindParam(':areas_conocimiento', $areas_conocimiento_str);

try {
    // Ejecuta la sentencia y verifica si fue exitosa
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Docente registrado con éxito";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . "/admin/docentes");
        exit(); // Termina la ejecución después de redirigir
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja (puedes personalizar este mensaje si lo deseas)
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/docentes/create.php");
    exit(); // Termina la ejecución después de redirigir
}
