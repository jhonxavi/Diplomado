<?php
include ('../../../app/config.php'); // Incluye la configuración de la base de datos

// Obtener el ID del permiso
$id_rol_permiso = $_POST['id_rol_permiso'];

// Preparar la consulta para eliminar el permiso
$sentencia = $pdo->prepare("DELETE FROM roles_permisos WHERE id_rol_permiso = :id_rol_permiso");

// Vincular el parámetro con bindParam (en la sentencia preparada)
$sentencia->bindParam(':id_rol_permiso', $id_rol_permiso, PDO::PARAM_INT);

// Ejecutar la sentencia y manejar el resultado
if ($sentencia->execute()) {
    // Iniciar la sesión si no está iniciada
    session_start();
    // Guardar mensaje de éxito en la sesión
    $_SESSION['mensaje'] = "Se eliminó la asignacion correctamente en la base de datos";
    $_SESSION['icono'] = "success";
    // Redirigir a la página de permisos
    header('Location:'.APP_URL."/admin/roles");
} else {
    // Iniciar la sesión si no está iniciada
    session_start();
    // Guardar mensaje de error en la sesión
    $_SESSION['mensaje'] = "Error, no se pudo eliminar en la base de datos. Comuníquese con el administrador.";
    $_SESSION['icono'] = "error";
    // Redirigir a la página de permisos
    header('Location:'.APP_URL."/admin/roles");
}
?>








