<?php
include ('../../../app/config.php');


// Obtén los datos del formulario y realiza la validación correspondiente

$nombre_url = $_POST['nombre_url'] ?? '';
$url = $_POST['url'] ?? '';

$sentencia = $pdo->prepare("INSERT INTO permisos
    (nombre_url, url, fyh_creacion, estado) 
    VALUES (:nombre_url, :url, :fyh_creacion, :estado)");

$sentencia->bindParam(':nombre_url', $nombre_url);
$sentencia->bindParam(':url', $url);
$sentencia->bindParam(':fyh_creacion', $fechaHora);
$sentencia->bindParam(':estado', $estado_de_registro);


// Validaciones básicas
if ($sentencia->execute()) {
    echo 'success';
    session_start();
    $_SESSION['mensaje'] = "Permiso Registrado";
    $_SESSION['icono'] = "success";
    header('Location:' . APP_URL . "/admin/roles/permisos.php");
}else{
    echo 'Error al registrar a la base de datos';
    session_start();
    $_SESSION['mensaje'] = "error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    ?><script>window.history.back();</script><?php
}



// Prepara la sentencia SQL para insertar un nuevo coordinador


// try {
//     // Ejecuta la sentencia SQL
//     if ($sentencia->execute()) {
//         $_SESSION['mensaje'] = "Cohorte registrada con éxito";
//         $_SESSION['icono'] = "success";
//         header('Location:' . APP_URL . "/admin/cohortes");
//         exit();
//     }
// } catch (PDOException $e) {
//     // Maneja posibles errores
//     $_SESSION['mensaje'] = "Error en la base de datos: " . $e->getMessage();
//     $_SESSION['icono'] = "error";
//     header('Location:' . APP_URL . "/admin/cohortes/create_cohorte.php");
//     exit();
// }

?>
