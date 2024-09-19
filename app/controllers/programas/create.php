<?php
include ('../../../app/config.php');

// Inicia la sesión solo una vez
session_start();

// Obtén los datos del formulario y realiza la validación correspondiente
$snies = $_POST['snies'] ?? '';
$nombre_program = $_POST['nombre_program'] ?? '';
$des_program = $_POST['des_program'] ?? '';
$email_program = $_POST['email_program'] ?? '';
$lineas_trabajo = $_POST['lineas_trabajo'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$no_resolucion = $_POST['no_resolucion'] ?? ''; 

// Validaciones básicas
if (empty($snies) || empty($nombre_program) || empty($des_program) || empty($email_program) || empty($lineas_trabajo) || empty($fecha) || empty($no_resolucion)) {
    $_SESSION['mensaje'] = "Todos los campos son obligatorios";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/programas/create_program.php");
    exit(); 
}

// Verificación de duplicados
$sentencia_verificacion = $pdo->prepare("SELECT COUNT(*) FROM programas WHERE snies = :snies OR email_program = :email_program OR no_resolucion = :no_resolucion");
$sentencia_verificacion->bindParam(':snies', $snies);
$sentencia_verificacion->bindParam(':email_program', $email_program);
$sentencia_verificacion->bindParam(':no_resolucion', $no_resolucion);
$sentencia_verificacion->execute();

if ($sentencia_verificacion->fetchColumn() > 0) {
    $_SESSION['mensaje'] = "El SNIES, el correo electrónico o el número de resolución ya están registrados";
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/programas/create_program.php");
    exit();
}

// Manejo del archivo PDF
$archivo_pdf = '';
if (isset($_FILES['archivo_pdf']) && $_FILES['archivo_pdf']['error'] == 0) {
    // Verificar que sea un archivo PDF
    $fileType = mime_content_type($_FILES['archivo_pdf']['tmp_name']);
    if ($fileType === 'application/pdf') {
        $archivo_nombre = $_FILES['archivo_pdf']['name'];

        // Crear la carpeta uploads si no existe
        $upload_dir = '../../../docpro/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Asegurar un nombre único para el archivo para evitar sobrescrituras
        $archivo_destino = $upload_dir . uniqid() . '_' . $archivo_nombre;

        // Mover el archivo a la carpeta uploads
        if (move_uploaded_file($_FILES['archivo_pdf']['tmp_name'], $archivo_destino)) {
            $archivo_pdf = $archivo_destino;
        } else {
            $_SESSION['mensaje'] = "Error al subir el archivo";
            $_SESSION['icono'] = "error";
            header('Location:' . APP_URL . "/admin/programas/create_program.php");
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Solo se permiten archivos PDF";
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . "/admin/programas/create_program.php");
        exit();
    }
} else {
    $archivo_pdf = '';  // En caso de no subir archivo
}

// Manejo del archivo de imagen
$logo = '';
if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
    // Verificar que sea una imagen
    $fileType = mime_content_type($_FILES['logo']['tmp_name']);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Tipos de imagen permitidos

    if (in_array($fileType, $allowedTypes)) {
        $imagen_nombre = $_FILES['logo']['name'];

        // Crear la carpeta uploads si no existe
        $upload_dir = '../../../docpro/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        //Asegurar un nombre único para el archivo para evitar sobrescrituras
        $imagen_destino = $upload_dir . uniqid() . '_' . $imagen_nombre;

        // Mover el archivo a la carpeta uploads
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $imagen_destino)) {
            $logo = $imagen_destino;
        } else {
            $_SESSION['mensaje'] = "Error al subir la imagen";
            $_SESSION['icono'] = "error";
            header('Location:' . APP_URL . "/admin/programas/create_program.php");
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "Solo se permiten archivos de imagen (JPEG, PNG, GIF)";
        $_SESSION['icono'] = "error";
        header('Location:' . APP_URL . "/admin/programas/create_program.php");
        exit();
    }
} else {
    $logo = '';  // En caso de no subir archivo
}

// Prepara la sentencia SQL para insertar un nuevo programa
$sentencia = $pdo->prepare("INSERT INTO programas 
    (snies, nombre_program, des_program, email_program, lineas_trabajo, fecha, no_resolucion, logo, archivo_pdf) 
    VALUES (:snies, :nombre_program, :des_program, :email_program, :lineas_trabajo, :fecha, :no_resolucion, :logo, :archivo_pdf)");

$sentencia->bindParam(':snies', $snies);
$sentencia->bindParam(':nombre_program', $nombre_program);
$sentencia->bindParam(':des_program', $des_program);
$sentencia->bindParam(':email_program', $email_program);
$sentencia->bindParam(':lineas_trabajo', $lineas_trabajo);
$sentencia->bindParam(':fecha', $fecha);
$sentencia->bindParam(':no_resolucion', $no_resolucion);
$sentencia->bindParam(':logo', $logo);
$sentencia->bindParam(':archivo_pdf', $archivo_pdf);

try {
    // Ejecuta la sentencia SQL
    if ($sentencia->execute()) {
        $_SESSION['mensaje'] = "Programa registrado con éxito";
        $_SESSION['icono'] = "success";
        header('Location:' . APP_URL . "/admin/programas");
        exit();
    }
} catch (PDOException $e) {
    // Maneja posibles errores
    $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location:' . APP_URL . "/admin/programas/create_program.php");
    exit();
}
?>
