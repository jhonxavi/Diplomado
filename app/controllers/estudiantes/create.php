<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén y valida los datos del estudiante
$nombre_estudiante = $_POST['nombre_estudiante'] ?? '';
$id_estudiante = $_POST['id_estudiante'] ?? '';
$Cod_estudiante = $_POST['Cod_estudiante'] ?? '';
$dir_estudiante = $_POST['dir_estudiante'] ?? '';
$tel_estudiante = $_POST['tel_estudiante'] ?? '';
$email_estudiante = $_POST['email_estudiante'] ?? '';
$fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
$semestre_estudiante = $_POST['semestre_estudiante'] ?? '';
$estado_civil = $_POST['estado_civil'] ?? '';
$fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
$fecha_egreso = $_POST['fecha_egreso'] ?? '';
$estado_cohorte = $_POST['estado_cohorte'] ?? '';
$genero_estudiante = $_POST['genero_estudiante'] ?? '';

// Manejo del archivo de imagen
$foto_estudiante = '';
if (isset($_FILES['foto_estudiante']) && $_FILES['foto_estudiante']['error'] == 0) {
    // Verificar que sea una imagen
    $fileType = mime_content_type($_FILES['foto_estudiante']['tmp_name']);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Tipos de imagen permitidos

    if (in_array($fileType, $allowedTypes)) {
        $imagen_nombre = $_FILES['foto_estudiante']['name'];

        // Crear la carpeta uploads si no existe
        $upload_dir = '../../../docest/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Asegurar un nombre único para el archivo para evitar sobrescrituras
        $imagen_destino = $upload_dir . uniqid() . '_' . $imagen_nombre;

        // Mover el archivo a la carpeta uploads
        if (move_uploaded_file($_FILES['foto_estudiante']['tmp_name'], $imagen_destino)) {
            $foto_estudiante = $imagen_destino;
        } else {
            $_SESSION['mensaje'] = "Error al subir la imagen";
            $_SESSION['icono'] = "error";
            header('Location:' . APP_URL . "/admin/estudiantes/create_estudiantes.php");
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Solo se permiten archivos de imagen (JPEG, PNG, GIF)";
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . "/admin/estudiantes/create_estudiantes.php");
        exit();
    }
} else {
    $foto_estudiante = '';  // En caso de no subir archivo
}

// Validar campos obligatorios
if (empty($nombre_estudiante) || empty($id_estudiante) || empty($Cod_estudiante) || empty($dir_estudiante) || 
    empty($tel_estudiante) || empty($email_estudiante) || empty($fecha_nacimiento) || empty($semestre_estudiante) 
    || empty($estado_civil) || empty($fecha_ingreso) || empty($fecha_egreso) || empty($estado_cohorte) || empty($genero_estudiante)) {
    $_SESSION['mensaje'] = "Por favor, llene todos los campos obligatorios.";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/estudiantes/create_estudiantes.php");
    exit();  // Termina la ejecución después de redirigir
}

// Prepara la sentencia SQL corregida
$sentencia = $pdo->prepare("INSERT INTO estudiante 
    (nombre_estudiante, id_estudiante, Cod_estudiante, foto_estudiante, dir_estudiante, tel_estudiante, email_estudiante, 
    fecha_nacimiento, semestre_estudiante, estado_civil, fecha_ingreso, fecha_egreso, estado_cohorte, genero_estudiante) 
    VALUES (:nombre_estudiante, :id_estudiante, :Cod_estudiante, :foto_estudiante, :dir_estudiante, :tel_estudiante, :email_estudiante, 
    :fecha_nacimiento, :semestre_estudiante, :estado_civil, :fecha_ingreso, :fecha_egreso, :estado_cohorte, :genero_estudiante)");

// Asocia las variables con sus respectivos marcadores
$sentencia->bindParam(':nombre_estudiante', $nombre_estudiante);
$sentencia->bindParam(':id_estudiante', $id_estudiante);
$sentencia->bindParam(':Cod_estudiante', $Cod_estudiante);
$sentencia->bindParam(':foto_estudiante', $foto_estudiante);
$sentencia->bindParam(':dir_estudiante', $dir_estudiante);
$sentencia->bindParam(':tel_estudiante', $tel_estudiante);
$sentencia->bindParam(':email_estudiante', $email_estudiante);
$sentencia->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$sentencia->bindParam(':semestre_estudiante', $semestre_estudiante);
$sentencia->bindParam(':estado_civil', $estado_civil);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':fecha_egreso', $fecha_egreso);
$sentencia->bindParam(':estado_cohorte', $estado_cohorte);
$sentencia->bindParam(':genero_estudiante', $genero_estudiante);

try {
    // Ejecuta la sentencia y verifica si fue exitosa
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Estudiante registrado con éxito";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . "/admin/estudiantes");
        exit(); // Termina la ejecución después de redirigir
    }
} catch (PDOException $e) {
    // Captura posibles errores y los maneja (puedes personalizar este mensaje si lo deseas)
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/estudiantes/create_estudiantes.php");
    exit(); // Termina la ejecución después de redirigir
}
