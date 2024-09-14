<?php
include('../../app/config.php'); // Asegúrate de ajustar la ruta según tu estructura de carpetas

// Consulta para obtener todos los asistentes de la tabla correcta 'asistente'
$sql_asistentes = "SELECT * FROM asistente";
$query_asistentes = $pdo->prepare($sql_asistentes);
$query_asistentes->execute();
$asistentes = $query_asistentes->fetchAll(PDO::FETCH_ASSOC);
?>
