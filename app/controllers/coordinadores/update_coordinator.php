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
$id_cordi = $_POST['id_cordi'] ?? '';
$nombre_cordi = $_POST['nombre_cordi'] ?? '';
$dir_cordi = $_POST['dir_cordi'] ?? '';
$tel_cordi = $_POST['tel_cordi'] ?? '';
$email_cordi = $_POST['email_cordi'] ?? '';
$genero_cordi = $_POST['genero_cordi'] ?? '';
$fecha_nacimiento_cordi = $_POST['fecha_nacimiento_cordi'] ?? '';
$fecha_vinculacion_cordi = $_POST['fecha_vinculacion_cordi'] ?? '';

// Validaciones básicas
if (empty($id_cordi) || empty($nombre_cordi) || empty($dir_cordi) || empty($tel_cordi) || empty($email_cordi) || empty($genero_cordi) || empty($fecha_nacimiento_cordi) || empty($fecha_vinculacion_cordi)) {
    redirigirConMensaje("Todos los campos son obligatorios", "error", "/admin/coordinadores/edit_coordinator.php?id_cordi=$id_cordi");
}

// Verificación de duplicados (excluyendo el coordinador actual)
$sentencia_verificacion = $pdo->prepare("SELECT COUNT(*) FROM coordinadores WHERE (email_cordi = :email_cordi) AND id_cordi != :id_cordi");
$sentencia_verificacion->bindParam(':email_cordi', $email_cordi);
$sentencia_verificacion->bindParam(':id_cordi', $id_cordi);
$sentencia_verificacion->execute();

if ($sentencia_verificacion->fetchColumn() > 0) {
    redirigirConMensaje("El correo electrónico ya está registrado con otro coordinador", "error", "/admin/coordinadores/edit_coordinator.php?id_cordi=$id_cordi");
}

// Obtener los datos actuales del coordinador
$sentencia = $pdo->prepare("SELECT * FROM coordinadores WHERE id_cordi = :id_cordi");
$sentencia->bindParam(':id_cordi', $id_cordi);
$sentencia->execute();
$coordinador = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$coordinador) {
    redirigirConMensaje("Coordinador no encontrado", "error", "/admin/coordinadores");
}

// Manejo del archivo PDF
$acuerdo_nombramiento_cordi = $coordinador['acuerdo_nombramiento_cordi'] ?? '';
if (isset($_FILES['acuerdo_nombramiento_cordi']) && $_FILES['acuerdo_nombramiento_cordi']['error'] == 0) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $_FILES['acuerdo_nombramiento_cordi']['tmp_name']);
    finfo_close($finfo);

    if ($fileType === 'application/pdf') {
        if ($_FILES['acuerdo_nombramiento_cordi']['size'] > 5 * 1024 * 1024) {
            redirigirConMensaje("El archivo PDF es demasiado grande. Máximo 5 MB.", "error", "/admin/coordinadores/edit_coordinator.php?id_cordi=$id_cordi");
        }

        $archivo_nombre = $_FILES['acuerdo_nombramiento_cordi']['name'];
        $upload_dir = '../../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $archivo_destino = $upload_dir . uniqid() . '_' . $archivo_nombre;

        if (move_uploaded_file($_FILES['acuerdo_nombramiento_cordi']['tmp_name'], $archivo_destino)) {
            $acuerdo_nombramiento_cordi = basename($archivo_destino); // Solo guardar el nombre del archivo
        } else {
            redirigirConMensaje("Error al subir el archivo", "error", "/admin/coordinadores/edit_coordinator.php?id_cordi=$id_cordi");
        }
    } else {
        redirigirConMensaje("Solo se permiten archivos PDF", "error", "/admin/coordinadores/edit_coordinator.php?id_cordi=$id_cordi");
    }
}

// Actualización del coordinador
$sentencia = $pdo->prepare("UPDATE coordinadores 
    SET nombre_cordi = :nombre_cordi, dir_cordi = :dir_cordi, tel_cordi = :tel_cordi, email_cordi = :email_cordi, genero_cordi = :genero_cordi, fecha_nacimiento_cordi = :fecha_nacimiento_cordi, fecha_vinculacion_cordi = :fecha_vinculacion_cordi, acuerdo_nombramiento_cordi = :acuerdo_nombramiento_cordi 
    WHERE id_cordi = :id_cordi");

$sentencia->bindParam(':nombre_cordi', $nombre_cordi);
$sentencia->bindParam(':dir_cordi', $dir_cordi);
$sentencia->bindParam(':tel_cordi', $tel_cordi);
$sentencia->bindParam(':email_cordi', $email_cordi);
$sentencia->bindParam(':genero_cordi', $genero_cordi);
$sentencia->bindParam(':fecha_nacimiento_cordi', $fecha_nacimiento_cordi);
$sentencia->bindParam(':fecha_vinculacion_cordi', $fecha_vinculacion_cordi);
$sentencia->bindParam(':acuerdo_nombramiento_cordi', $acuerdo_nombramiento_cordi);
$sentencia->bindParam(':id_cordi', $id_cordi);

try {
    $pdo->beginTransaction();
    $sentencia->execute();
    $pdo->commit();
    redirigirConMensaje("Coordinador actualizado con éxito", "success", "/admin/coordinadores");
} catch (PDOException $e) {
    $pdo->rollBack();
    redirigirConMensaje("Error en la base de datos: " . $e->getMessage(), "error", "/admin/coordinadores/edit_coordinator.php?id_cordi=$id_cordi");
}
?>
