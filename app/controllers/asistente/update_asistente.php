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

// Obtén los datos del formulario
$id_asistente = $_POST['id_asistente'] ?? '';
$nombre_asistente = $_POST['nombre_asistente'] ?? '';
$dir_asistente = $_POST['dir_asistente'] ?? '';
$tel_asistente = $_POST['tel_asistente'] ?? '';
$email_asistente = $_POST['email_asistente'] ?? '';
$genero_asistente = $_POST['genero_asistente'] ?? '';
$fecha_nacimiento_asistente = $_POST['fecha_nacimiento_asistente'] ?? '';
$fecha_vinculacion_asistente = $_POST['fecha_vinculacion_asistente'] ?? '';

// Validaciones básicas
if (empty($id_asistente) || empty($nombre_asistente) || empty($dir_asistente) || empty($tel_asistente) || empty($email_asistente) || empty($genero_asistente) || empty($fecha_nacimiento_asistente) || empty($fecha_vinculacion_asistente)) {
    redirigirConMensaje("Todos los campos son obligatorios", "error", "/admin/asistente/edit_asistente.php?id_asistente=$id_asistente");
}

// Verificación de duplicados (excluyendo el asistente actual)
$sentencia_verificacion = $pdo->prepare("SELECT COUNT(*) FROM asistente WHERE (email_asistente = :email_asistente) AND id_asistente != :id_asistente");
$sentencia_verificacion->bindParam(':email_asistente', $email_asistente);
$sentencia_verificacion->bindParam(':id_asistente', $id_asistente);
$sentencia_verificacion->execute();

if ($sentencia_verificacion->fetchColumn() > 0) {
    redirigirConMensaje("El correo electrónico ya está registrado con otro asistente", "error", "/admin/asistente/edit_asistente.php?id_asistente=$id_asistente");
}

// Obtener los datos actuales del asistente
$sentencia = $pdo->prepare("SELECT * FROM asistente WHERE id_asistente = :id_asistente");
$sentencia->bindParam(':id_asistente', $id_asistente);
$sentencia->execute();
$asistente = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$asistente) {
    redirigirConMensaje("Asistente no encontrado", "error", "/admin/asistente");
}

// Manejo del archivo PDF
$acuerdo_nombramiento_asistente = $asistente['acuerdo_nombramiento_asistente'] ?? '';

if (isset($_FILES['acuerdo_nombramiento_asistente']) && $_FILES['acuerdo_nombramiento_asistente']['error'] == 0) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $_FILES['acuerdo_nombramiento_asistente']['tmp_name']);
    finfo_close($finfo);

    if ($fileType === 'application/pdf') {
        if ($_FILES['acuerdo_nombramiento_asistente']['size'] > 5 * 1024 * 1024) {
            redirigirConMensaje("El archivo PDF es demasiado grande. Máximo 5 MB.", "error", "/admin/asistente/edit_asistente.php?id_asistente=$id_asistente");
        }

        $archivo_nombre = $_FILES['acuerdo_nombramiento_asistente']['name'];
        $upload_dir = '../../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $archivo_destino = $upload_dir . uniqid() . '_' . $archivo_nombre;

        if (move_uploaded_file($_FILES['acuerdo_nombramiento_asistente']['tmp_name'], $archivo_destino)) {
            $acuerdo_nombramiento_asistente = basename($archivo_destino); // Solo guardar el nombre del archivo
        } else {
            redirigirConMensaje("Error al subir el archivo", "error", "/admin/asistente/edit_asistente.php?id_asistente=$id_asistente");
        }
    } else {
        redirigirConMensaje("Solo se permiten archivos PDF", "error", "/admin/asistente/edit_asistente.php?id_asistente=$id_asistente");
    }
}

// Actualización del asistente
$sentencia = $pdo->prepare("UPDATE asistente 
    SET nombre_asistente = :nombre_asistente, dir_asistente = :dir_asistente, tel_asistente = :tel_asistente, email_asistente = :email_asistente, genero_asistente = :genero_asistente, fecha_nacimiento_asistente = :fecha_nacimiento_asistente, fecha_vinculacion_asistente = :fecha_vinculacion_asistente, acuerdo_nombramiento_asistente = :acuerdo_nombramiento_asistente 
    WHERE id_asistente = :id_asistente");

$sentencia->bindParam(':nombre_asistente', $nombre_asistente);
$sentencia->bindParam(':dir_asistente', $dir_asistente);
$sentencia->bindParam(':tel_asistente', $tel_asistente);
$sentencia->bindParam(':email_asistente', $email_asistente);
$sentencia->bindParam(':genero_asistente', $genero_asistente);
$sentencia->bindParam(':fecha_nacimiento_asistente', $fecha_nacimiento_asistente);
$sentencia->bindParam(':fecha_vinculacion_asistente', $fecha_vinculacion_asistente);
$sentencia->bindParam(':acuerdo_nombramiento_asistente', $acuerdo_nombramiento_asistente);
$sentencia->bindParam(':id_asistente', $id_asistente);

try {
    $pdo->beginTransaction();
    $sentencia->execute();
    $pdo->commit();
    redirigirConMensaje("Asistente actualizado con éxito", "success", "/admin/asistente");
} catch (PDOException $e) {
    $pdo->rollBack();
    redirigirConMensaje("Error en la base de datos: " . $e->getMessage(), "error", "/admin/asistente/edit_asistente.php?id_asistente=$id_asistente");
}
?>
