<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario

// Inicia la sesión solo una vez
session_start();

// Obtener el ID del estudiante desde la URL
$id_estudiante = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_estudiante === null) {
    $_SESSION['mensaje'] = "ID del estudiante no especificado.";
    $_SESSION['icono'] = "error";
    header('Location: index.php'); // Redirige a la lista de estudiantes
    exit; // Termina la ejecución después de redirigir
}

try {
    // Consulta para obtener los detalles del estudiante
    $sql = "SELECT * FROM estudiantes WHERE id_estudiante = :id_estudiante";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
    $query->execute();

    $estudiante = $query->fetch(PDO::FETCH_ASSOC);

    if (!$estudiante) {
        $_SESSION['mensaje'] = "No se encontró el estudiante.";
        $_SESSION['icono'] = "error";
        header('Location: index.php'); // Redirige a la lista de estudiantes
        exit; // Termina la ejecución después de redirigir
    }
} catch (PDOException $e) {
    $_SESSION['mensaje'] = "Error en la consulta: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    header('Location: index.php'); // Redirige a la lista de estudiantes
    exit; // Termina la ejecución después de redirigir
}

// Lista de opciones para Cohorte
$cohorte_opciones = [
    "Cohorte1",
    "Cohorte2",
    "Cohorte3",
    "Cohorte4"
];

// Si el formulario se ha enviado, actualizar los datos del estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén y valida los datos del estudiante
    $nombre_estudiante = $_POST['nombre_estudiante'] ?? '';
    $Cod_estudiante = $_POST['Cod_estudiante'] ?? '';
    $dir_estudiante = $_POST['dir_estudiante'] ?? '';
    $tel_estudiante = $_POST['tel_estudiante'] ?? '';
    $email_estudiante = $_POST['email_estudiante'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $genero_estudiante = $_POST['genero_estudiante'] ?? '';
    $semestre_estudiante = $_POST['semestre_estudiante'] ?? '';
    $estado_civil = $_POST['estado_civil'] ?? '';
    $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
    $fecha_egreso = $_POST['fecha_egreso'] ?? '';
    $estado_cohorte = $_POST['estado_cohorte'] ?? '';

    // Validar campos obligatorios
    if (empty($nombre_estudiante) || empty($Cod_estudiante) || empty($dir_estudiante) || empty($tel_estudiante) ||
        empty($email_estudiante) || empty($fecha_nacimiento) || empty($genero_estudiante) || empty($semestre_estudiante) ||
        empty($estado_civil) || empty($fecha_ingreso) || empty($fecha_egreso) || empty($estado_cohorte)) {
        $_SESSION['mensaje'] = "Por favor, llene todos los campos obligatorios.";
        $_SESSION['icono'] = "error";
        header('Location: edit_estudiante.php?id=' . $id_estudiante);
        exit; // Termina la ejecución después de redirigir
    }

    // Prepara la sentencia SQL
    $sql_update = "UPDATE estudiantes SET 
        nombre_estudiante = :nombre_estudiante, 
        Cod_estudiante = :Cod_estudiante, 
        dir_estudiante = :dir_estudiante, 
        tel_estudiante = :tel_estudiante, 
        email_estudiante = :email_estudiante, 
        fecha_nacimiento = :fecha_nacimiento, 
        genero_estudiante = :genero_estudiante, 
        semestre_estudiante = :semestre_estudiante, 
        estado_civil = :estado_civil, 
        fecha_ingreso = :fecha_ingreso, 
        fecha_egreso = :fecha_egreso, 
        estado_cohorte = :estado_cohorte
        WHERE id_estudiante = :id_estudiante";

    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->bindParam(':nombre_estudiante', $nombre_estudiante);
    $stmt_update->bindParam(':Cod_estudiante', $Cod_estudiante);
    $stmt_update->bindParam(':dir_estudiante', $dir_estudiante);
    $stmt_update->bindParam(':tel_estudiante', $tel_estudiante);
    $stmt_update->bindParam(':email_estudiante', $email_estudiante);
    $stmt_update->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt_update->bindParam(':genero_estudiante', $genero_estudiante);
    $stmt_update->bindParam(':semestre_estudiante', $semestre_estudiante);
    $stmt_update->bindParam(':estado_civil', $estado_civil);
    $stmt_update->bindParam(':fecha_ingreso', $fecha_ingreso);
    $stmt_update->bindParam(':fecha_egreso', $fecha_egreso);
    $stmt_update->bindParam(':estado_cohorte', $estado_cohorte);
    $stmt_update->bindParam(':id_estudiante', $id_estudiante);

    try {
        // Ejecuta la sentencia y verifica si fue exitosa
        if ($stmt_update->execute()) {
            $_SESSION['mensaje'] = "Datos actualizados correctamente";
            $_SESSION['icono'] = "success";
            header('Location: index.php?mensaje=Datos actualizados correctamente&icono=success');
            exit; // Termina la ejecución después de redirigir
        } else {
            $_SESSION['mensaje'] = "Error al actualizar el estudiante.";
            $_SESSION['icono'] = "error";
            header('Location: edit_estudiante.php?id=' . $id_estudiante);
            exit; // Termina la ejecución después de redirigir
        }
    } catch (PDOException $e) {
        // Captura posibles errores y los maneja
        $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
        $_SESSION['icono'] = "error";
        header('Location: edit_estudiante.php?id=' . $id_estudiante);
        exit; // Termina la ejecución después de redirigir
    }
}
?>

<!-- Código HTML para el formulario de edición aquí -->

<?php include('../../admin/layout/parte2.php'); // Ajusta la ruta si es necesario ?>
