<?php
// Obtener el ID del docente desde la URL
$id_docente = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_docente === null) {
    echo "ID del docente no especificado.";
    exit; // Detén la ejecución si no se especifica un ID
}

// Incluir configuración de la base de datos
include('../../app/config.php');

try {
    // Consulta para obtener los detalles del docente
    $sql = "SELECT * FROM docentes WHERE id_docente = :id_docente";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_docente', $id_docente, PDO::PARAM_INT);
    $query->execute();

    $docente = $query->fetch(PDO::FETCH_ASSOC);

    if (!$docente) {
        echo "No se encontró el docente.";
        exit; // Detén la ejecución si no se encuentra el docente
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit;
}

// Lista de áreas de conocimiento
$areas_conocimiento_opciones = [
    "Ingeniería de Software",
    "Telecomunicaciones",
    "Bases de Datos",
    "Inteligencia Artificial",
    "Ciencia de Datos",
    "Redes y Seguridad",
    "Sistemas Embebidos",
    "Desarrollo Web"
];

// Convertir áreas de conocimiento en un array
$areas_conocimiento_seleccionadas = explode(', ', $docente['areas_conocimiento']);

// Si el formulario se ha enviado, actualizar los datos del docente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_docente = $_POST['nombre_docente'];
    $dir_docente = $_POST['dir_docente'];
    $tel_docente = $_POST['tel_docente'];
    $email_docente = $_POST['email_docente'];
    $genero_docente = $_POST['genero_docente'];
    $fecha_nacimiento_docente = $_POST['fecha_nacimiento_docente'];
    $formacion_academica = $_POST['formacion_academica'];
    $areas_conocimiento = $_POST['areas_conocimiento'];

    // Convertir áreas de conocimiento a un string
    if (is_array($areas_conocimiento)) {
        $areas_conocimiento_str = implode(', ', $areas_conocimiento);
    } else {
        $areas_conocimiento_str = $areas_conocimiento;
    }

    $sql_update = "UPDATE docentes SET 
        nombre_docente = :nombre_docente, 
        dir_docente = :dir_docente, 
        tel_docente = :tel_docente, 
        email_docente = :email_docente, 
        genero_docente = :genero_docente, 
        fecha_nacimiento_docente = :fecha_nacimiento_docente, 
        formacion_academica = :formacion_academica, 
        areas_conocimiento = :areas_conocimiento
        WHERE id_docente = :id_docente";

    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->bindParam(':nombre_docente', $nombre_docente);
    $stmt_update->bindParam(':dir_docente', $dir_docente);
    $stmt_update->bindParam(':tel_docente', $tel_docente);
    $stmt_update->bindParam(':email_docente', $email_docente);
    $stmt_update->bindParam(':genero_docente', $genero_docente);
    $stmt_update->bindParam(':fecha_nacimiento_docente', $fecha_nacimiento_docente);
    $stmt_update->bindParam(':formacion_academica', $formacion_academica);
    $stmt_update->bindParam(':areas_conocimiento', $areas_conocimiento_str);
    $stmt_update->bindParam(':id_docente', $id_docente);

    if ($stmt_update->execute()) {
        // Redirige a la lista de docentes con un mensaje de éxito
        header('Location: index.php?mensaje=Datos guardados correctamente&icono=success');
        exit;
    } else {
        echo "Error al actualizar el docente.";
    }
}

// Incluir archivos de diseño y layout
include('../../admin/layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar Docente: <?= htmlspecialchars($docente['nombre_docente']); ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Editar datos</h3>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <input type="hidden" name="id_docente" value="<?= htmlspecialchars($docente['id_docente']); ?>">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nombre del docente</label>
                                            <input type="text" name="nombre_docente" value="<?= htmlspecialchars($docente['nombre_docente']); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" name="dir_docente" value="<?= htmlspecialchars($docente['dir_docente']); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input type="text" name="tel_docente" value="<?= htmlspecialchars($docente['tel_docente']); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Correo</label>
                                            <input type="email" name="email_docente" value="<?= htmlspecialchars($docente['email_docente']); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Género</label>
                                            <select name="genero_docente" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Masculino" <?= $docente['genero_docente'] === 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                                <option value="Femenino" <?= $docente['genero_docente'] === 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
                                                <option value="Otro" <?= $docente['genero_docente'] === 'Otro' ? 'selected' : ''; ?>>Otro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Fecha de Nacimiento</label>
                                            <input type="date" name="fecha_nacimiento_docente" value="<?= htmlspecialchars($docente['fecha_nacimiento_docente']); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Formación Académica</label>
                                            <select name="formacion_academica" class="form-control" required>
                                                <option value="Pregrado" <?= $docente['formacion_academica'] === 'Pregrado' ? 'selected' : ''; ?>>Pregrado</option>
                                                <option value="Posgrado" <?= $docente['formacion_academica'] === 'Posgrado' ? 'selected' : ''; ?>>Posgrado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Áreas de Conocimiento</label>
                                            <select name="areas_conocimiento[]" class="form-control" multiple required>
                                                <?php foreach ($areas_conocimiento_opciones as $opcion): ?>
                                                    <option value="<?= htmlspecialchars($opcion); ?>" <?= in_array($opcion, $areas_conocimiento_seleccionadas) ? 'selected' : ''; ?>>
                                                        <?= htmlspecialchars($opcion); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                                        <a href="index.php" class="btn btn-secondary">Volver</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Incluir archivos de diseño y layout
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');


?>
