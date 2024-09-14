<?php
include('../../app/config.php'); // Asegúrate de ajustar la ruta según tu estructura de carpetas

// Consulta para obtener todos los coordinaadores activos
$sql_estudiante = "SELECT * FROM estudiante ";
$query_estudiante  = $pdo->prepare($sql_estudiante );
$query_estudiante ->execute();
$estudiante  = $query_estudiante ->fetchAll(PDO::FETCH_ASSOC);