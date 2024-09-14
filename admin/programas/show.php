<?php
// Obtener el ID del programa desde la URL
$id_programa = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_programa === null) {
    echo "ID del programa no especificado.";
    exit; // Detén la ejecución si no se especifica un ID
}

// Incluir configuración de la base de datos
include('../../app/config.php');

try {
    // Consulta para obtener los detalles del programa
    $sql = "SELECT * FROM programas WHERE snies = :id_programa";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id_programa', $id_programa, PDO::PARAM_INT);
    $query->execute();

    $programa = $query->fetch(PDO::FETCH_ASSOC);

    if ($programa) {
        // Asignar los valores a las variables
        $snies = htmlspecialchars($programa['snies']);
        $nombre_programa = htmlspecialchars($programa['nombre_program']);
        $des_program = htmlspecialchars($programa['des_program']);
        $email_program = htmlspecialchars($programa['email_program']);
        $lineas_trabajo = htmlspecialchars($programa['lineas_trabajo']);
        $fecha = htmlspecialchars($programa['fecha']);
        $no_resolucion = htmlspecialchars($programa['no_resolucion']);
        $archivo_pdf = htmlspecialchars($programa['archivo_pdf']);
        $logo = htmlspecialchars($programa['logo']);
        $fyh_creacion = htmlspecialchars($programa['fyh_creacion']);
        $fyh_actualizacion = htmlspecialchars($programa['fyh_actualizacion']);
    } else {
        echo "No se encontró el programa.";
        exit; // Detén la ejecución si no se encuentra el programa
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
                <h1>Programa: <?= $nombre_programa; ?></h1>
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
                                        <label>SNIES</label>
                                        <p><?= $snies; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre del programa</label>
                                        <p><?= $nombre_programa; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <p><?= $des_program; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <p><?= $email_program; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Líneas de trabajo</label>
                                        <p><?= $lineas_trabajo; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Logo</label><br>
                                    <?php if (!empty($logo)): ?>
                                        <?php 
                                        // Ajusta la ruta al directorio correcto donde se almacenan las imágenes
                                        $logoUrl = APP_URL . '/docpro/' . htmlspecialchars(basename($logo));
                                        ?>
                                        <img src="<?= $logoUrl; ?>" alt="Logo" style="max-width: 60%; height: auto; text-align: center; border-radius: 8px;">
                                    <?php else: ?>
                                        <p>No se ha subido ninguna imagen.</p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <p><?= $fecha; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Número de resolución</label>
                                        <p><?= $no_resolucion; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label>Resolución de registro</label><br>
                                    <td style="text-align: center">
                                            <?php if (!empty($programa['archivo_pdf'])): ?>
                                                <a href="uploads/<?= $programa
                                                ['archivo_pdf']; ?>" class="btn btn-sm btn-secondary" download>
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