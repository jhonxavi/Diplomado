<?php
// Obtener el ID del coordinador desde la URL
$cod_cohorte = isset($_GET['id']) ? $_GET['id'] : null;

if ($cod_cohorte === null) {
    echo "ID del coordinador no especificado.";
    exit; // Detén la ejecución si no se especifica un ID
}

// Incluir configuración de la base de datos
include('../../app/config.php');

try {
    // Consulta para obtener los detalles del coordinador
    $sql = "SELECT * FROM cohorte WHERE cod_cohorte = :cod_cohorte";
    $query = $pdo->prepare($sql);
    $query->bindParam(':cod_cohorte', $cod_cohorte, PDO::PARAM_INT);
    $query->execute();

    $cohorte = $query->fetch(PDO::FETCH_ASSOC);

    if ($cohorte) {
        // Asignar los valores a las variables
        $cod_cohorte = htmlspecialchars($cohorte['cod_cohorte']);
        $nombre_cohorte = htmlspecialchars($cohorte['nombre_cohorte']);
        $fecha_inicio = htmlspecialchars($cohorte['fecha_inicio']);
        $fecha_finalizacion = htmlspecialchars($cohorte['fecha_finalizacion']);
        $N_estudiantes = htmlspecialchars($cohorte['N_estudiantes']);
        
    } else {
        echo "No se encontró el cohorte.";
        exit; // Detén la ejecución si no se encuentra el coordinador
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
                <h1>Cohorte: <?= $nombre_cohorte; ?></h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Datos de la Cohorte</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <p><?= $cod_cohorte; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <p><?= $nombre_cohorte; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha de Inicio</label>
                                        <p><?= $fecha_inicio; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Fecha de Finalizacion</label>
                                        <p><?= $fecha_finalizacion; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Numero de Inscritos</label>
                                        <p><?= $N_estudiantes; ?></p>
                                    </div>
                                </div>
                            </div>                           
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-secondary">Volver</a>
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
