<?php
// Obtener el ID del asistente desde la URL
$id_asist = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_asist === null) {
    echo "ID del asistente no especificado.";
    exit; // Detén la ejecución si no se especifica un ID
}

// Incluir configuración de la base de datos
include('../../app/config.php');

try {
    // Consulta para obtener los detalles del asistente
    $sql = "SELECT * FROM asistente WHERE id_asistente = :id_asist";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_asist', $id_asist, PDO::PARAM_INT);
    $query->execute();

    $asistente = $query->fetch(PDO::FETCH_ASSOC);

    if ($asistente) {
        // Asignar los valores a las variables
        $nombre_asist = htmlspecialchars($asistente['nombre_asistente']);
        $dir_asist = htmlspecialchars($asistente['dir_asistente']);
        $tel_asist = htmlspecialchars($asistente['tel_asistente']);
        $email_asist = htmlspecialchars($asistente['email_asistente']);
        $genero_asist = htmlspecialchars($asistente['genero_asistente']);
        $fecha_nacimiento_asist = htmlspecialchars($asistente['fecha_nacimiento_asistente']);
        $acuerdo_nombramiento_asist = htmlspecialchars($asistente['acuerdo_nombramiento_asistente']);
    } else {
        echo "No se encontró el asistente.";
        exit; // Detén la ejecución si no se encuentra el asistente
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
                <h1>Asistente: <?= $nombre_asist; ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Asistente</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <p><?= $nombre_asist; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <p><?= $dir_asist; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <p><?= $tel_asist; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p><?= $email_asist; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Género</label>
                                        <p><?= $genero_asist; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha de Nacimiento</label>
                                        <p><?= $fecha_nacimiento_asist; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Acuerdo de Nombramiento</label><br>
                                    <td style="text-align: center">
                                            <?php if (!empty($asistente['acuerdo_nombramiento_asistente'])): ?>
                                                <a href="uploads/<?= $asistente['acuerdo_nombramiento_asistente']; ?>" class="btn btn-sm btn-secondary" download>
                                                    Descargar PDF
                                                </a>
                                            <?php else: ?>
                                                No disponible
                                            <?php endif; ?>
                                        </td>
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
