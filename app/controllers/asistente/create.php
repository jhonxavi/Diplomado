<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén los datos del formulario y realiza la validación correspondiente
$nombre_asistente = $_POST['nombre_asistente'] ?? '';
$id_asistente = $_POST['id_asistente'] ?? '';
$dir_asistente = $_POST['dir_asistente'] ?? '';
$tel_asistente = $_POST['tel_asistente'] ?? '';
$email_asistente = $_POST['email_asistente'] ?? '';
$genero_asistente = $_POST['genero_asistente'] ?? '';
$fecha_nacimiento_asistente = $_POST['fecha_nacimiento_asistente'] ?? '';
$fecha_vinculacion_asistente = $_POST['fecha_vinculacion_asistente'] ?? '';

// Validaciones básicas
if (empty($nombre_asistente) || empty($id_asistente) || empty($dir_asistente) || empty($tel_asistente) || empty($email_asistente) || empty($genero_asistente) || empty($fecha_nacimiento_asistente) || empty($fecha_vinculacion_asistente)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/asistente/create_asistente.php");
    exit();
}

// Manejo del archivo de Acuerdo de Nombramiento
$acuerdo_nombramiento_asistente = '';
if (isset($_FILES['acuerdo_nombramiento_asistente']) && $_FILES['acuerdo_nombramiento_asistente']['error'] == 0) {
    // Verificar que sea un archivo PDF
    $fileType = mime_content_type($_FILES['acuerdo_nombramiento_asistente']['tmp_name']);
    if ($fileType === 'application/pdf') {
        $archivo_nombre = $_FILES['acuerdo_nombramiento_asistente']['name'];

        // Crear la carpeta uploads si no existe
        $upload_dir = '../../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Asegurar un nombre único para el archivo para evitar sobrescrituras
        $archivo_destino = $upload_dir . uniqid() . '_' . $archivo_nombre;

        // Mover el archivo a la carpeta uploads
        if (move_uploaded_file($_FILES['acuerdo_nombramiento_asistente']['tmp_name'], $archivo_destino)) {
            $acuerdo_nombramiento_asistente = $archivo_destino;
        } else {
            $_SESSION['mensaje'] = "Error al subir el archivo";
            $_SESSION['icono'] = "error";
            header('Location:' . APP_URL . "/admin/asistente/create_asistente.php");
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Solo se permiten archivos PDF";
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . "/admin/asistente/create_asistente.php");
        exit();
    }
} else {
    $acuerdo_nombramiento_asistente = '';  // En caso de no subir archivo
}

// Prepara la sentencia SQL para insertar un nuevo asistente
$sentencia = $pdo->prepare("INSERT INTO asistente
    (nombre_asistente, id_asistente, dir_asistente, tel_asistente, email_asistente, genero_asistente, fecha_nacimiento_asistente, fecha_vinculacion_asistente, acuerdo_nombramiento_asistente) 
    VALUES (:nombre_asistente, :id_asistente, :dir_asistente, :tel_asistente, :email_asistente, :genero_asistente, :fecha_nacimiento_asistente, :fecha_vinculacion_asistente, :acuerdo_nombramiento_asistente)");

$sentencia->bindParam(':nombre_asistente', $nombre_asistente);
$sentencia->bindParam(':id_asistente', $id_asistente);
$sentencia->bindParam(':dir_asistente', $dir_asistente);
$sentencia->bindParam(':tel_asistente', $tel_asistente);
$sentencia->bindParam(':email_asistente', $email_asistente);
$sentencia->bindParam(':genero_asistente', $genero_asistente);
$sentencia->bindParam(':fecha_nacimiento_asistente', $fecha_nacimiento_asistente);
$sentencia->bindParam(':fecha_vinculacion_asistente', $fecha_vinculacion_asistente);
$sentencia->bindParam(':acuerdo_nombramiento_asistente', $acuerdo_nombramiento_asistente);

try {
    // Ejecuta la sentencia SQL
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Asistente registrado con éxito";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . "/admin/asistente");
        exit();
    }
} catch (PDOException $e) {
    // Maneja posibles errores
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/asistente/create_asistente.php");
    exit();
}
?>
