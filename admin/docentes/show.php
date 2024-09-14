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
    $sql = "SELECT * FROM docentes WHERE id_docente = :id_docente"; // Asegúrate de que el campo ID sea correcto
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_docente', $id_docente, PDO::PARAM_INT);
    $query->execute();

    $docente = $query->fetch(PDO::FETCH_ASSOC);

    if ($docente) {
        // Asignar los valores a las variables
        $nombre_docente = htmlspecialchars($docente['nombre_docente']);
        $dir_docente = htmlspecialchars($docente['dir_docente']);
        $tel_docente = htmlspecialchars($docente['tel_docente']);
        $email_docente = htmlspecialchars($docente['email_docente']);
        $genero_docente = htmlspecialchars($docente['genero_docente']);
        $fecha_nacimiento_docente = htmlspecialchars($docente['fecha_nacimiento_docente']);
        $formacion_academica = htmlspecialchars($docente['formacion_academica']);
        $areas_conocimiento = htmlspecialchars($docente['areas_conocimiento']);
    } else {
        echo "No se encontró el docente.";
        exit; // Detén la ejecución si no se encuentra el docente
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit;
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
                <h1>Docente: <?= $nombre_docente; ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos registrados</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre del docente</label>
                                        <p><?= $nombre_docente; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <p><?= $dir_docente; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <p><?= $tel_docente; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <p><?= $email_docente; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Género</label>
                                        <p><?= $genero_docente; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento</label>
                                        <p><?= $fecha_nacimiento_docente; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Formación académica</label>
                                        <p><?= $formacion_academica; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Áreas de conocimiento</label>
                                        <p><?= $areas_conocimiento; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-secondary" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">Volver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>


<?php
// Incluir archivos de diseño y mensajes
include('../../admin/layout/parte2.php');
include('../../layout/mensajes.php');
?>
