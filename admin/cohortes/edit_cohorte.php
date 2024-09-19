<?php
ob_start(); // Inicia el buffering de salida

include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario

// Obtener el cod_cohorte de la cohorte a editar
$cod_cohorte = $_GET['cod_cohorte'] ?? '';
if (empty($cod_cohorte)) {
    header('Location: ' . APP_URL . '/admin/cohortes'); // Redirige si no se proporciona cod_cohorte
    exit();
}

// Obtener los datos de la cohorte desde la base de datos
$sentencia = $pdo->prepare("SELECT * FROM cohorte WHERE cod_cohorte = :cod_cohorte");
$sentencia->bindParam(':cod_cohorte', $cod_cohorte);
$sentencia->execute();
$cohorte = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$cohorte) {
    header('Location: ' . APP_URL . '/admin/cohortes'); // Redirige si no se encuentra la cohorte
    exit();
}
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar Cohorte</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Edición</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/cohortes/update_cohorte.php" method="post">

                                <!-- Campo Código de la cohorte (solo lectura) -->
                                <div class="form-group">
                                    <label for="cod_cohorte">Código de la cohorte</label>
                                    <input type="text" class="form-control" id="cod_cohorte" name="cod_cohorte" value="<?= htmlspecialchars($cohorte['cod_cohorte']) ?>" readonly>
                                </div>

                                <!-- Campo Nombre de la cohorte -->
                                <div class="form-group">
                                    <label for="nombre_cohorte">Nombre de la cohorte</label>
                                    <input type="text" class="form-control" id="nombre_cohorte" name="nombre_cohorte" value="<?= htmlspecialchars($cohorte['nombre_cohorte']) ?>" required>
                                </div>

                                <!-- Campo Fecha de Inicio -->
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?= htmlspecialchars($cohorte['fecha_inicio']) ?>" required>
                                </div>

                                <!-- Campo Fecha de Finalización -->
                                <div class="form-group">
                                    <label for="fecha_finalizacion">Fecha de Finalización</label>
                                    <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" value="<?= htmlspecialchars($cohorte['fecha_finalizacion']) ?>" required>
                                </div>

                                <!-- Campo Número de Estudiantes -->
                                <div class="form-group">
                                    <label for="N_estudiantes">Número de Estudiantes</label>
                                    <input type="number" class="form-control" id="N_estudiantes" name="N_estudiantes" value="<?= htmlspecialchars($cohorte['N_estudiantes']) ?>" required>
                                </div>

                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Actualizar Cohorte
                                </button>
                                <a href="<?= APP_URL; ?>/admin/cohortes" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Cancelar
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('../../admin/layout/parte2.php'); // Ajusta la ruta si es necesario
include('../../layout/mensajes.php'); // Ajusta la ruta si es necesario

ob_end_flush(); // Envía la salida del buffer al navegador
?>
