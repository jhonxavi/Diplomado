<?php

include ('../../../app/config.php');
//include ('../../../app/config.php');

// Verificar si se recibieron los datos mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la solicitud
    $rol_id = $_POST['rol_id'] ?? null;  // Usar null coalesce para evitar errores si no se establece
    $permiso_id = $_POST['permiso_id'] ?? null;

    // Comprobar que ambos valores estén presentes
    if ($rol_id !== null && $permiso_id !== null) {
        // Fecha y hora de creación
        $fechaHora = date('Y-m-d H:i:s');
        $estado_de_registro = 'Activo';  // O el estado que consideres apropiado

        // Preparar la sentencia SQL
        $sentencia = $pdo->prepare("INSERT INTO roles_permisos (rol_id, permiso_id, fyh_creacion, estado) 
                                    VALUES (:rol_id, :permiso_id, :fyh_creacion, :estado)");

        // Vincular parámetros
        $sentencia->bindParam(':rol_id', $rol_id);
        $sentencia->bindParam(':permiso_id', $permiso_id);
        $sentencia->bindParam(':fyh_creacion', $fechaHora);
        $sentencia->bindParam(':estado', $estado_de_registro);

        // Ejecutar la sentencia
        if ($sentencia->execute()) {
            // Enviar una respuesta de éxito
            //echo json_encode(['status' => 'success', 'message' => 'Permiso asignado correctamente.']);
        } else {
            // En caso de error al ejecutar la sentencia
            echo json_encode(['status' => 'error', 'message' => 'Error al asignar el permiso.']);
        }
    } else {
        // Enviar un mensaje de error si faltan datos
        echo json_encode(['status' => 'error', 'message' => 'Datos faltantes.']);
    }
} else {
    // Enviar un mensaje de error si la solicitud no es POST
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}

?>
