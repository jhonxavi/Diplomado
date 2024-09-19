<?php
$sql_permisos = "SELECT * FROM permisos where estado = '1' ORDER BY nombre_url asc ";
$query_permisos = $pdo->prepare($sql_permisos);
$query_permisos->execute();
$permisos = $query_permisos->fetchAll(PDO::FETCH_ASSOC);

// $sql_permisos = "SELECT * FROM permisos as per
//               INNER JOIN roles as rol ON rol.id_rol = per.rol_id where per.estado = '1' ORDER BY rol.nombre_rol asc ";
// $query_permisos = $pdo->prepare($sql_permisos);
// $query_permisos->execute();
// $permisos = $query_permisos->fetchAll(PDO::FETCH_ASSOC);

