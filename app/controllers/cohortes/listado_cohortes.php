<?php
include('../../app/config.php'); // Asegúrate de ajustar la ruta según tu estructura de carpetas

// Consulta para obtener todos los coordinaadores activos
$sql_cohorte = "SELECT * FROM cohorte";
$query_cohorte = $pdo->prepare($sql_cohorte);
$query_cohorte->execute();
$cohorte = $query_cohorte->fetchAll(PDO::FETCH_ASSOC);