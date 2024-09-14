<?php
// Obtener el ID del coordinador desde la URL
$id_cordi = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_cordi === null) {
    echo "ID del coordinador no especificado.";
    exit; // Detén la ejecución si no se especifica un ID
}

// Incluir configuración de la base de datos
include('../../app/config.php');

try {
    // Consulta para obtener los detalles del coordinador
    $sql = "SELECT * FROM coordinadores WHERE id_cordi = :id_cordi";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_cordi', $id_cordi, PDO::PARAM_INT);
    $query->execute();

    $coordinador = $query->fetch(PDO::FETCH_ASSOC);

    if ($coordinador) {
        // Asignar los valores a las variables
        $nombre_cordi = htmlspecialchars($coordinador['nombre_cordi']);
        $dir_cordi = htmlspecialchars($coordinador['dir_cordi']);
        $tel_cordi = htmlspecialchars($coordinador['tel_cordi']);
        $email_cordi = htmlspecialchars($coordinador['email_cordi']);
        $genero_cordi = htmlspecialchars($coordinador['genero_cordi']);
        $fecha_nacimiento_cordi = htmlspecialchars($coordinador['fecha_nacimiento_cordi']);
        $fecha_vinculacion_cordi = htmlspecialchars($coordinador['fecha_vinculacion_cordi']);
        $acuerdo_nombramiento_cordi = htmlspecialchars($coordinador['acuerdo_nombramiento_cordi']);
    } else {
        echo "No se encontró el coordinador.";
        exit; // Detén la ejecución si no se encuentra el coordinador
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit;
}

// Incluir archivos de diseño y layout
include('../../admin/layout/parte1.php');
?>


<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Coordinador: <?= $nombre_cordi; ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos del Coordinador</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <p><?= $nombre_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <p><?= $dir_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <p><?= $tel_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <p><?= $email_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Género</label>
                                        <p><?= $genero_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha de Nacimiento</label>
                                        <p><?= $fecha_nacimiento_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha de Vinculación</label>
                                        <p><?= $fecha_vinculacion_cordi; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Acuerdo de Nombramiento</label><br>
                                    <td style="text-align: center">
                                            <?php if (!empty($coordinador['acuerdo_nombramiento_cordi'])): ?>
                                                <a href="uploads/<?= $coordinador['acuerdo_nombramiento_cordi']; ?>" class="btn btn-sm btn-secondary" download>
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
