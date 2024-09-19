<?php
ob_start(); // Inicia el almacenamiento en búfer de salida

include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario

// Obtener el ID del estudiante desde la URL
$id_estudiante = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_estudiante === null) {
    echo "ID del estudiante no especificado.";
    exit; // Detén la ejecución si no se especifica un ID
}

try {
    // Consulta para obtener los detalles del estudiante
    $sql = "SELECT * FROM estudiante WHERE id_estudiante = :id_estudiante";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
    $query->execute();

    $estudiante = $query->fetch(PDO::FETCH_ASSOC);

    if (!$estudiante) {
        echo "No se encontró el estudiante.";
        exit; // Detén la ejecución si no se encuentra el estudiante
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit;
}

// Lista de opciones para Cohorte
$cohorte_opciones = [
    "Cohorte1",
    "Cohorte2",
    "Cohorte3",
    "Cohorte4"
];

// Si el formulario se ha enviado, actualizar los datos del estudiante
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $Cod_estudiante = $_POST['Cod_estudiante'];
    $dir_estudiante = $_POST['dir_estudiante'];
    $tel_estudiante = $_POST['tel_estudiante'];
    $email_estudiante = $_POST['email_estudiante'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $semestre_estudiante = $_POST['semestre_estudiante'];
    $estado_civil = $_POST['estado_civil'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $fecha_egreso = $_POST['fecha_egreso'];
    $estado_cohorte = $_POST['estado_cohorte'];

    $foto_estudiante = $estudiante['foto_estudiante']; // Mantén la foto actual si no se carga una nueva

    if (isset($_FILES['foto_estudiante']) && $_FILES['foto_estudiante']['error'] === UPLOAD_ERR_OK) {
        $foto_tmp_name = $_FILES['foto_estudiante']['tmp_name'];
        $foto_name = basename($_FILES['foto_estudiante']['name']);
        $foto_destino = 'ruta/a/tu/directorio/' . $foto_name;

        if (move_uploaded_file($foto_tmp_name, $foto_destino)) {
            $foto_estudiante = $foto_destino; // Actualiza con la nueva foto
        } else {
            echo "Error al cargar la foto.";
            exit;
        }
    }

    // Actualizar los datos del estudiante
    $sql_update = "UPDATE estudiante SET 
        nombre_estudiante = :nombre_estudiante, 
        Cod_estudiante = :Cod_estudiante, 
        dir_estudiante = :dir_estudiante, 
        tel_estudiante = :tel_estudiante, 
        email_estudiante = :email_estudiante, 
        fecha_nacimiento = :fecha_nacimiento, 
        semestre_estudiante = :semestre_estudiante, 
        estado_civil = :estado_civil, 
        fecha_ingreso = :fecha_ingreso, 
        fecha_egreso = :fecha_egreso, 
        estado_cohorte = :estado_cohorte,
        foto_estudiante = :foto_estudiante
        WHERE id_estudiante = :id_estudiante";

    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->bindParam(':nombre_estudiante', $nombre_estudiante);
    $stmt_update->bindParam(':Cod_estudiante', $Cod_estudiante);
    $stmt_update->bindParam(':dir_estudiante', $dir_estudiante);
    $stmt_update->bindParam(':tel_estudiante', $tel_estudiante);
    $stmt_update->bindParam(':email_estudiante', $email_estudiante);
    $stmt_update->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt_update->bindParam(':semestre_estudiante', $semestre_estudiante);
    $stmt_update->bindParam(':estado_civil', $estado_civil);
    $stmt_update->bindParam(':fecha_ingreso', $fecha_ingreso);
    $stmt_update->bindParam(':fecha_egreso', $fecha_egreso);
    $stmt_update->bindParam(':estado_cohorte', $estado_cohorte);
    $stmt_update->bindParam(':foto_estudiante', $foto_estudiante);
    $stmt_update->bindParam(':id_estudiante', $id_estudiante);

    if ($stmt_update->execute()) {
        // Redirige a la lista de estudiantes con un mensaje de éxito
        header('Location: index.php?mensaje=Datos actualizados correctamente&icono=success');
        exit;
    } else {
        echo "Error al actualizar el estudiante.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Estudiante</title>
    <!-- Incluye aquí tus estilos CSS -->
    <link rel="stylesheet" href="../../path/to/your/styles.css"> <!-- Ajusta la ruta si es necesario -->
</head>
<body>
<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar Estudiante: <?= htmlspecialchars($estudiante['nombre_estudiante']); ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Edición de Estudiante</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_estudiante" value="<?= htmlspecialchars($estudiante['id_estudiante']); ?>">

                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label for="nombre_estudiante">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" value="<?= htmlspecialchars($estudiante['nombre_estudiante']); ?>" required>
                                </div>

                                <!-- Campo Código Estudiantil -->
                                <div class="form-group">
                                    <label for="Cod_estudiante">Código</label>
                                    <input type="text" class="form-control" id="Cod_estudiante" name="Cod_estudiante" value="<?= htmlspecialchars($estudiante['Cod_estudiante']); ?>" required>
                                </div>

                                <!-- Campo Foto
                                <div class="form-group">
                                    <label for="foto_estudiante">Foto</label><br>
                                    <img src="<?= htmlspecialchars($estudiante['foto_estudiante']); ?>" alt="Foto del estudiante" style="max-width: 200px; max-height: 200px;">
                                    <label class="custom-file-upload">
                                        <input type="file" id="foto_estudiante" name="foto_estudiante" accept="image/*">
                                    </label>
                                </div> -->

                                <!-- Campo Dirección -->
                                <div class="form-group">
                                    <label for="dir_estudiante">Dirección</label>
                                    <input type="text" class="form-control" id="dir_estudiante" name="dir_estudiante" value="<?= htmlspecialchars($estudiante['dir_estudiante']); ?>" required>
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="form-group">
                                    <label for="tel_estudiante">Teléfono</label>
                                    <input type="text" class="form-control" id="tel_estudiante" name="tel_estudiante" value="<?= htmlspecialchars($estudiante['tel_estudiante']); ?>" required>
                                </div>

                                <!-- Campo Correo Electrónico -->
                                <div class="form-group">
                                    <label for="email_estudiante">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email_estudiante" name="email_estudiante" value="<?= htmlspecialchars($estudiante['email_estudiante']); ?>" required>
                                </div>

                                <!-- Campo Fecha de Nacimiento -->
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= htmlspecialchars($estudiante['fecha_nacimiento']); ?>" required>
                                </div>

                                <!-- Campo Semestre -->
<div class="form-group">
    <label for="semestre_estudiante">Semestre</label>
    <select class="form-control" id="semestre_estudiante" name="semestre_estudiante" required>
        <option value="Semestre 7" <?= $estudiante['semestre_estudiante'] === 'Semestre 7' ? 'selected' : ''; ?>>Semestre 7</option>
        <option value="Semestre 8" <?= $estudiante['semestre_estudiante'] === 'Semestre 8' ? 'selected' : ''; ?>>Semestre 8</option>
        <option value="Semestre 9" <?= $estudiante['semestre_estudiante'] === 'Semestre 9' ? 'selected' : ''; ?>>Semestre 9</option>
        <option value="Semestre 10" <?= $estudiante['semestre_estudiante'] === 'Semestre 10' ? 'selected' : ''; ?>>Semestre 10</option>
        <option value="Egresado" <?= $estudiante['semestre_estudiante'] === 'Egresado' ? 'selected' : ''; ?>>Egresado</option>
    </select>
</div>

<!-- Campo Estado Civil -->
<div class="form-group">
    <label for="estado_civil">Estado Civil</label>
    <select class="form-control" id="estado_civil" name="estado_civil" required>
        <option value="Soltero" <?= $estudiante['estado_civil'] === 'Soltero' ? 'selected' : ''; ?>>Soltero</option>
        <option value="Casado" <?= $estudiante['estado_civil'] === 'Casado' ? 'selected' : ''; ?>>Casado</option>
        <option value="Divorciado" <?= $estudiante['estado_civil'] === 'Divorciado' ? 'selected' : ''; ?>>Divorciado</option>
        <option value="UnionLibre" <?= $estudiante['estado_civil'] === 'UnionLibre' ? 'selected' : ''; ?>>Unión Libre</option>
        <option value="Viudo" <?= $estudiante['estado_civil'] === 'Viudo' ? 'selected' : ''; ?>>Viudo</option>
    </select>
</div>

                                <!-- Campo Fecha de Ingreso -->
                                <div class="form-group">
                                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" value="<?= htmlspecialchars($estudiante['fecha_ingreso']); ?>" required>
                                </div>

                                <!-- Campo Fecha de Egreso -->
                                <div class="form-group">
                                    <label for="fecha_egreso">Fecha de Egreso</label>
                                    <input type="date" class="form-control" id="fecha_egreso" name="fecha_egreso" value="<?= htmlspecialchars($estudiante['fecha_egreso']); ?>" required>
                                </div>

                                <!-- Campo Estado Cohorte -->
                                <div class="form-group">
                                    <label for="estado_cohorte">Estado Cohorte</label>
                                    <select class="form-control" id="estado_cohorte" name="estado_cohorte" required>
                                        <?php foreach ($cohorte_opciones as $opcion): ?>
                                            <option value="<?= htmlspecialchars($opcion); ?>" <?= $estudiante['estado_cohorte'] === $opcion ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($opcion); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Botón de Guardar Cambios -->
                                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
<?php include('../../admin/layout/parte2.php'); // Ajusta la ruta si es necesario ?>
<?php
ob_end_flush(); // Envía el contenido del búfer y apaga el almacenamiento en búfer de salida
?>
</body>
</html>
