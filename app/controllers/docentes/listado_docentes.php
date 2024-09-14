<?php
include('../../app/config.php'); // Asegúrate de ajustar la ruta según tu estructura de carpetas

// Consulta para obtener todos los docentes activos
$sql_docentes = "SELECT * FROM docentes";
$query_docentes = $pdo->prepare($sql_docentes);
$query_docentes->execute();
$docentes = $query_docentes->fetchAll(PDO::FETCH_ASSOC);