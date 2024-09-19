<?php
// Obtener el ID del estudiante desde la URL
$id_estudiante = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_estudiante === null) {
    echo "ID del estudiante no especificado.";
    exit; // Detener la ejecución si no se especifica un ID
}

include('../../app/config.php');

try {
    // Consulta para obtener los detalles del estudiante
    $sql = "SELECT * FROM estudiante WHERE id_estudiante = :id_estudiante"; // Asegúrate de que el campo ID sea correcto
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
    $query->execute();

    $estudiante = $query->fetch(PDO::FETCH_ASSOC);

    if ($estudiante) {
        $Cod_estudiante = htmlspecialchars($estudiante['Cod_estudiante']);
        $nombre_estudiante = htmlspecialchars($estudiante['nombre_estudiante']);
        $id_estudiante = htmlspecialchars($estudiante['id_estudiante']);
        $foto_estudiante = htmlspecialchars($estudiante['foto_estudiante']);
        $dir_estudiante = htmlspecialchars($estudiante['dir_estudiante']);
        $tel_estudiante = htmlspecialchars($estudiante['tel_estudiante']);
        $email_estudiante = htmlspecialchars($estudiante['email_estudiante']);
        $fecha_estudiante = htmlspecialchars($estudiante['fecha_nacimiento']);
        $semestre_estudiante = htmlspecialchars($estudiante['semestre_estudiante']);
        $estado_civil = htmlspecialchars($estudiante['estado_civil']);
        $fecha_ingreso = htmlspecialchars($estudiante['fecha_ingreso']);
        $fecha_egreso = htmlspecialchars($estudiante['fecha_egreso']); // Corregido aquí
        $estado_cohorte = htmlspecialchars($estudiante['estado_cohorte']);
    } else {
        echo "No se encontró estudiante";
        exit;
    }

} catch (PDOException $e) {
    echo "Error en la Consulta: " . $e->getMessage();
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
                <h1>Estudiante: <?= $nombre_estudiante; ?></h1>
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
                                        <label>Código</label>
                                        <p><?= $Cod_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <p><?= $nombre_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Identificación</label>
                                        <p><?= $id_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Foto</label><br>
                                        <?php if (!empty($foto_estudiante)): ?>
                                            <?php 
                                            // Ajusta la ruta al directorio correcto donde se almacenan las imágenes
                                            $foto_estudianteUrl = APP_URL . '/docest/' . htmlspecialchars(basename($foto_estudiante));
                                            ?>
                                            <img src="<?= $foto_estudianteUrl; ?>" alt="foto_estudiante" 
                                            style="max-width: 30%; height: auto; text-align: center; border-radius: 8px;">
                                        <?php else: ?>
                                            <p>No se ha subido ninguna imagen.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <p><?= $dir_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <p><?= $tel_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <p><?= $email_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha Nacimiento</label>
                                        <p><?= $fecha_estudiante; ?></p> <!-- Corregido aquí -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Semestre</label>
                                        <p><?= $semestre_estudiante; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Estado Civil</label>
                                        <p><?= $estado_civil; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha Ingreso</label>
                                        <p><?= $fecha_ingreso; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha Egreso</label>
                                        <p><?= $fecha_egreso; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Cohorte</label>
                                        <p><?= $estado_cohorte; ?></p>
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
