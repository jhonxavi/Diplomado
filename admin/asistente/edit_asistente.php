<?php
include('../../app/config.php'); 
include('../../admin/layout/parte1.php'); 

// Obtener el id_asistente del asistente a editar
$id_asistente = $_GET['id_asistente'] ?? '';
if (empty($id_asistente)) {
    header('Location: ' . APP_URL . '/admin/asistente'); // Redirige si no se proporciona id_asistente
    exit();
}

// Obtener los datos del asistente desde la base de datos
$sentencia = $pdo->prepare("SELECT * FROM asistente WHERE id_asistente = :id_asistente");
$sentencia->bindParam(':id_asistente', $id_asistente);
$sentencia->execute();
$asistente = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$asistente) {
    header('Location: ' . APP_URL . '/admin/asistente'); // Redirige si no se encuentra el asistente
    exit();
}
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar Asistente</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Edición</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/asistente/update_asistente.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Campo id_asistente (solo lectura) -->
                                <div class="form-group">
                                    <label for="id_asistente">Identificación</label>
                                    <input type="text" class="form-control" id="id_asistente" name="id_asistente" value="<?= htmlspecialchars($asistente['id_asistente']) ?>" readonly>
                                </div>

                                <!-- Otros campos -->
                                <!-- Campo Nombre del asistente -->
                                <div class="form-group">
                                    <label for="nombre_asistente">Nombre del Asistente</label>
                                    <input type="text" class="form-control" id="nombre_asistente" name="nombre_asistente" value="<?= htmlspecialchars($asistente['nombre_asistente']) ?>" required>
                                </div>

                                <!-- Campo Dirección -->
                                <div class="form-group">
                                    <label for="dir_asistente">Dirección</label>
                                    <input type="text" class="form-control" id="dir_asistente" name="dir_asistente" value="<?= htmlspecialchars($asistente['dir_asistente']) ?>" required>
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="form-group">
                                    <label for="tel_asistente">Teléfono</label>
                                    <input type="text" class="form-control" id="tel_asistente" name="tel_asistente" value="<?= htmlspecialchars($asistente['tel_asistente']) ?>" required>
                                </div>

                                <!-- Campo Correo -->
                                <div class="form-group">
                                    <label for="email_asistente">Correo</label>
                                    <input type="email" class="form-control" id="email_asistente" name="email_asistente" value="<?= htmlspecialchars($asistente['email_asistente']) ?>" required>
                                </div>

                                <!-- Campo Género -->
                                <div class="form-group">
                                    <label for="genero_asistente">Género</label>
                                    <select class="form-control" id="genero_asistente" name="genero_asistente" required>
                                        <option value="Masculino" <?= $asistente['genero_asistente'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                                        <option value="Femenino" <?= $asistente['genero_asistente'] === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                                        <option value="Otro" <?= $asistente['genero_asistente'] === 'Otro' ? 'selected' : '' ?>>Otro</option>
                                    </select>
                                </div>

                                <!-- Campo Fecha de Nacimiento -->
                                <div class="form-group">
                                    <label for="fecha_nacimiento_asistente">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_asistente" name="fecha_nacimiento_asistente" value="<?= htmlspecialchars($asistente['fecha_nacimiento_asistente']) ?>" required>
                                </div>

                                <!-- Campo Fecha de Vinculación -->
                                <div class="form-group">
                                    <label for="fecha_vinculacion_asistente">Fecha de Vinculación</label>
                                    <input type="date" class="form-control" id="fecha_vinculacion_asistente" name="fecha_vinculacion_asistente" value="<?= htmlspecialchars($asistente['fecha_vinculacion_asistente']) ?>" required>
                                </div>

                                <!-- Campo Acuerdo de Nombramiento -->
                                <div class="form-group">
                                    <label for="acuerdo_nombramiento_asistente">Acuerdo de Nombramiento (Archivo) (dejar en blanco si no deseas cambiar)</label><br>
                                    <input type="file" id="acuerdo_nombramiento_asistente" name="acuerdo_nombramiento_asistente" accept="application/pdf">
                                    <?php if (!empty($asistente['acuerdo_nombramiento_asistente'])): ?>
                                        <?php
                                        // Ajusta la ruta al directorio correcto donde se almacenan los archivos PDF
                                        $archivoPdfUrl = APP_URL . '/uploads/' . htmlspecialchars(basename($asistente['acuerdo_nombramiento_asistente']));
                                        ?>
                                        <a href="<?= $archivoPdfUrl; ?>" class="btn btn-sm btn-secondary" download>
                                            Descargar PDF
                                        </a>
                                    <?php else: ?>
                                        No disponible
                                    <?php endif; ?>
                                </div>

                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Actualizar Asistente
                                </button>
                                <a href="<?= APP_URL; ?>/admin/asistente" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
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
?>
