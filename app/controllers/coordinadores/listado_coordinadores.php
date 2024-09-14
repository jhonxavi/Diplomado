<?php
include('../../app/config.php'); // Asegúrate de ajustar la ruta según tu estructura de carpetas

// Consulta para obtener todos los coordinaadores activos
$sql_coordinadores = "SELECT * FROM coordinadores";
$query_coordinadores = $pdo->prepare($sql_coordinadores);
$query_coordinadores->execute();
$coordinadores = $query_coordinadores->fetchAll(PDO::FETCH_ASSOC);