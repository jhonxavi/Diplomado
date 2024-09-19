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
$snies = $_POST['snies'] ?? '';
$nombre_program = $_POST['nombre_program'] ?? '';
$des_program = $_POST['des_program'] ?? '';
$email_program = $_POST['email_program'] ?? '';
$lineas_trabajo = $_POST['lineas_trabajo'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$no_resolucion = $_POST['no_resolucion'] ?? '';

// Validaciones básicas
if (empty($snies) || empty($nombre_program) || empty($des_program) || empty($email_program) || empty($lineas_trabajo) || empty($fecha) || empty($no_resolucion)) {
    redirigirConMensaje("Todos los campos son obligatorios", "error", "/admin/programas/edit_program.php?snies=$snies");
}

// Verificación de duplicados (excluyendo el programa actual)
$sentencia_verificacion = $pdo->prepare("SELECT COUNT(*) FROM programas WHERE (snies = :snies OR email_program = :email_program OR no_resolucion = :no_resolucion) AND snies != :snies_actual");
$sentencia_verificacion->bindParam(':snies', $snies);
$sentencia_verificacion->bindParam(':email_program', $email_program);
$sentencia_verificacion->bindParam(':no_resolucion', $no_resolucion);
$sentencia_verificacion->bindParam(':snies_actual', $snies);
$sentencia_verificacion->execute();

if ($sentencia_verificacion->fetchColumn() > 0) {
    redirigirConMensaje("El SNIES, el correo electrónico o el número de resolución ya están registrados en otro programa", "error", "/admin/programas/edit_program.php?snies=$snies");
}

// Obtener los datos actuales del programa
$sentencia = $pdo->prepare("SELECT * FROM programas WHERE snies = :snies");
$sentencia->bindParam(':snies', $snies);
$sentencia->execute();
$programa = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$programa) {
    redirigirConMensaje("Programa no encontrado", "error", "/admin/programas");
}

// Manejo del archivo PDF
$archivo_pdf = $programa['archivo_pdf'] ?? '';
if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] == 0) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $_FILES['archivo_pdf']['tmp_name']);
    finfo_close($finfo);

    if ($fileType === 'application/pdf') {
        if ($_FILES['archivo_pdf']['size'] > 5 * 1024 * 1024) {
            redirigirConMensaje("El archivo PDF es demasiado grande. Máximo 5 MB.", "error", "/admin/programas/edit_program.php?snies=$snies");
        }

        $archivo_nombre = $_FILES['archivo_pdf']['name'];
        $upload_dir = '../../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $archivo_destino = $upload_dir . uniqid() . '_' . $archivo_nombre;

        if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $archivo_destino)) {
            $archivo_pdf = $archivo_destino;
        } else {
            redirigirConMensaje("Error al subir el archivo", "error", "/admin/programas/edit_program.php?snies=$snies");
        }
    } else {
        redirigirConMensaje("Solo se permiten archivos PDF", "error", "/admin/programas/edit_program.php?snies=$snies");
    }
}

// Manejo del archivo de imagen
$logo = $programa['logo'] ?? '';
if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $fileType = finfo_file($finfo, $_FILES['logo']['tmp_name']);
    finfo_close($finfo);

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($fileType, $allowedTypes)) {
        if ($_FILES['logo']['size'] > 2 * 1024 * 1024) {
            redirigirConMensaje("El archivo de imagen es demasiado grande. Máximo 2 MB.", "error", "/admin/programas/edit_program.php?snies=$snies");
        }

        $imagen_nombre = $_FILES['logo']['name'];
        $upload_dir = '../../../docpro/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $imagen_destino = $upload_dir . uniqid() . '_' . $imagen_nombre;

        if (move_uploaded_file($_FILES['logo']['tmp_name'], $imagen_destino)) {
            $logo = $imagen_destino;
        } else {
            redirigirConMensaje("Error al subir la imagen", "error", "/admin/programas/edit_program.php?snies=$snies");
        }
    } else {
        redirigirConMensaje("Solo se permiten archivos de imagen (JPEG, PNG, GIF)", "error", "/admin/programas/edit_program.php?snies=$snies");
    }
}

// Actualización de programa
$sentencia = $pdo->prepare("UPDATE programas 
    SET nombre_program = :nombre_program, des_program = :des_program, email_program = :email_program, lineas_trabajo = :lineas_trabajo, fecha = :fecha, no_resolucion = :no_resolucion, logo = :logo, archivo_pdf = :archivo_pdf 
    WHERE snies = :snies");

$sentencia->bindParam(':nombre_program', $nombre_program);
$sentencia->bindParam(':des_program', $des_program);
$sentencia->bindParam(':email_program', $email_program);
$sentencia->bindParam(':lineas_trabajo', $lineas_trabajo);
$sentencia->bindParam(':fecha', $fecha);
$sentencia->bindParam(':no_resolucion', $no_resolucion);
$sentencia->bindParam(':logo', $logo);
$sentencia->bindParam(':archivo_pdf', $archivo_pdf);
$sentencia->bindParam(':snies', $snies);

try {
    $pdo->beginTransaction();
    $sentencia->execute();
    $pdo->commit();
    redirigirConMensaje("Programa actualizado con éxito", "success", "/admin/programas");
} catch (PDOException $e) {
    $pdo->rollBack();
    redirigirConMensaje("Error en la base de datos: " . $e->getMessage(), "error", "/admin/programas/edit_program.php?snies=$snies");
}
?>
