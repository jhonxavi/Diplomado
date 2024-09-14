<?php
include('../../app/config.php'); 

// Consulta para obtener todos los programas activos
$sql_programas = "SELECT * FROM programas";
$query_programas = $pdo->prepare($sql_programas);
$query_programas->execute();
$programas = $query_programas->fetchAll(PDO::FETCH_ASSOC);
