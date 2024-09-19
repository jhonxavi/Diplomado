<?php
$sql_roles_permisos = "SELECT * FROM roles_permisos AS rolper
        INNER JOIN permisos AS per ON per.id_permiso = rolper.permiso_id
        INNER JOIN roles AS rol ON rol.id_rol = rolper.rol_id  
        ORDER BY per.nombre_url ASC";
$query_roles_permisos = $pdo->prepare($sql_roles_permisos);
$query_roles_permisos->execute();
$roles_permisos = $query_roles_permisos->fetchAll(PDO::FETCH_ASSOC);



