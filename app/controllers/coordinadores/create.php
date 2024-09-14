<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén los datos del formulario y realiza la validación correspondiente
$nombre_cordi = $_POST['nombre_cordi'] ?? '';
$id_cordi = $_POST['id_cordi'] ?? '';
$dir_cordi = $_POST['dir_cordi'] ?? '';
$tel_cordi = $_POST['tel_cordi'] ?? '';
$email_cordi = $_POST['email_cordi'] ?? '';
$genero_cordi = $_POST['genero_cordi'] ?? '';
$fecha_nacimiento_cordi = $_POST['fecha_nacimiento_cordi'] ?? '';
$fecha_vinculacion_cordi = $_POST['fecha_vinculacion_cordi'] ?? '';

// Validaciones básicas
if (empty($nombre_cordi) || empty($id_cordi) || empty($dir_cordi) || empty($tel_cordi) || empty($email_cordi) || empty($genero_cordi) || empty($fecha_nacimiento_cordi) || empty($fecha_vinculacion_cordi)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/coordinadores/create_coordinador.php");
    exit();
}

// Manejo del archivo de Acuerdo de Nombramiento
$acuerdo_nombramiento_cordi = '';
if (isset($_FILES['acuerdo_nombramiento_cordi']) && $_FILES['acuerdo_nombramiento_cordi']['error'] == 0) {
    // Verificar que sea un archivo PDF
    $fileType = mime_content_type($_FILES['acuerdo_nombramiento_cordi']['tmp_name']);
    if ($fileType === 'application/pdf') {
        $archivo_nombre = $_FILES['acuerdo_nombramiento_cordi']['name'];

        // Crear la carpeta uploads si no existe
        $upload_dir = '../../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Asegurar un nombre único para el archivo para evitar sobrescrituras
        $archivo_destino = $upload_dir . uniqid() . '_' . $archivo_nombre;

        // Mover el archivo a la carpeta uploads
        if (move_uploaded_file($_FILES['acuerdo_nombramiento_cordi']['tmp_name'], $archivo_destino)) {
            $acuerdo_nombramiento_cordi = $archivo_destino;
        } else {
            $_SESSION['mensaje'] = "Error al subir el archivo";
            $_SESSION['icono'] = "error";
            header('Location:' . APP_URL . "/admin/coordinadores/create_coordinador.php");
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Solo se permiten archivos PDF";
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . "/admin/coordinadores/create_coordinador.php");
        exit();
    }
} else {
    $acuerdo_nombramiento_cordi = '';  // En caso de no subir archivo
}

// Prepara la sentencia SQL para insertar un nuevo coordinador
$sentencia = $pdo->prepare("INSERT INTO coordinadores 
    (nombre_cordi, id_cordi, dir_cordi, tel_cordi, email_cordi, genero_cordi, fecha_nacimiento_cordi, fecha_vinculacion_cordi, acuerdo_nombramiento_cordi) 
    VALUES (:nombre_cordi, :id_cordi, :dir_cordi, :tel_cordi, :email_cordi, :genero_cordi, :fecha_nacimiento_cordi, :fecha_vinculacion_cordi, :acuerdo_nombramiento_cordi)");

$sentencia->bindParam(':nombre_cordi', $nombre_cordi);
$sentencia->bindParam(':id_cordi', $id_cordi);
$sentencia->bindParam(':dir_cordi', $dir_cordi);
$sentencia->bindParam(':tel_cordi', $tel_cordi);
$sentencia->bindParam(':email_cordi', $email_cordi);
$sentencia->bindParam(':genero_cordi', $genero_cordi);
$sentencia->bindParam(':fecha_nacimiento_cordi', $fecha_nacimiento_cordi);
$sentencia->bindParam(':fecha_vinculacion_cordi', $fecha_vinculacion_cordi);
$sentencia->bindParam(':acuerdo_nombramiento_cordi', $acuerdo_nombramiento_cordi);

try {
    // Ejecuta la sentencia SQL
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Coordinador registrado con éxito";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . "/admin/coordinadores");
        exit();
    }
} catch (PDOException $e) {
    // Maneja posibles errores
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/coordinadores/create_coordinador.php");
    exit();
}
?>
