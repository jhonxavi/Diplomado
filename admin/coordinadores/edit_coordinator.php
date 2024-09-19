<?php
ob_start(); // Inicia el buffering de salida

include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario

// Obtener el id_cordi del coordinador a editar
$id_cordi = $_GET['id_cordi'] ?? '';
if (empty($id_cordi)) {
    header('Location: ' . APP_URL . '/admin/coordinadores'); // Redirige si no se proporciona id_cordi
    exit();
}

// Obtener los datos del coordinador desde la base de datos
$sentencia = $pdo->prepare("SELECT * FROM coordinadores WHERE id_cordi = :id_cordi");
$sentencia->bindParam(':id_cordi', $id_cordi);
$sentencia->execute();
$coordinador = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$coordinador) {
    header('Location: ' . APP_URL . '/admin/coordinadores'); // Redirige si no se encuentra el coordinador
    exit();
}
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar coordinador</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Edición</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/coordinadores/update_coordinator.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Campo id_cordi (solo lectura) -->
                                <div class="form-group">
                                    <label for="id_cordi">Identificación</label>
                                    <input type="text" class="form-control" id="id_cordi" name="id_cordi" value="<?= htmlspecialchars($coordinador['id_cordi']) ?>" readonly>
                                </div>

                                <!-- Campo Nombre del coordinador -->
                                <div class="form-group">
                                    <label for="nombre_cordi">Nombre del Coordinador</label>
                                    <input type="text" class="form-control" id="nombre_cordi" name="nombre_cordi" value="<?= htmlspecialchars($coordinador['nombre_cordi']) ?>" required>
                                </div>

                                <!-- Campo dirección del coordinador -->
                                <div class="form-group">
                                    <label for="dir_cordi">Dirección</label>
                                    <input type="text" class="form-control" id="dir_cordi" name="dir_cordi" value="<?= htmlspecialchars($coordinador['dir_cordi']) ?>" required>
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="form-group">
                                    <label for="tel_cordi">Teléfono</label>
                                    <input type="text" class="form-control" id="tel_cordi" name="tel_cordi" value="<?= htmlspecialchars($coordinador['tel_cordi']) ?>" required>
                                </div>

                                <!-- Campo Correo -->
                                <div class="form-group">
                                    <label for="email_cordi">Correo</label>
                                    <input type="email" class="form-control" id="email_cordi" name="email_cordi" value="<?= htmlspecialchars($coordinador['email_cordi']) ?>" required>
                                </div>

                                <!-- Campo Género -->
                                <div class="form-group">
                                    <label for="genero_cordi">Género</label>
                                    <select class="form-control" id="genero_cordi" name="genero_cordi" required>
                                        <option value="Masculino" <?= $coordinador['genero_cordi'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                                        <option value="Femenino" <?= $coordinador['genero_cordi'] === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                                        <option value="Otro" <?= $coordinador['genero_cordi'] === 'Otro' ? 'selected' : '' ?>>Otro</option>
                                    </select>
                                </div>

                                <!-- Campo Fecha de Nacimiento -->
                                <div class="form-group">
                                    <label for="fecha_nacimiento_cordi">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_cordi" name="fecha_nacimiento_cordi" value="<?= htmlspecialchars($coordinador['fecha_nacimiento_cordi']) ?>" required>
                                </div>

                                <!-- Campo Fecha de Vinculación -->
                                <div class="form-group">
                                    <label for="fecha_vinculacion_cordi">Fecha de Vinculación</label>
                                    <input type="date" class="form-control" id="fecha_vinculacion_cordi" name="fecha_vinculacion_cordi" value="<?= htmlspecialchars($coordinador['fecha_vinculacion_cordi']) ?>" required>
                                </div>

                                <!-- Campo Acuerdo de Nombramiento -->
                                <div class="form-group">
                                    <label for="acuerdo_nombramiento_cordi">Acuerdo de Nombramiento (Archivo) (dejar en blanco si no deseas cambiar)</label><br>
                                    <input type="file" id="acuerdo_nombramiento_cordi" name="acuerdo_nombramiento_cordi" accept="application/pdf">
                                    <?php if (!empty($coordinador['acuerdo_nombramiento_cordi'])): ?>
                                        <?php
                                        // Ajusta la ruta al directorio correcto donde se almacenan los archivos PDF
                                        $archivoPdfUrl = APP_URL . '/uploads/' . htmlspecialchars(basename($coordinador['acuerdo_nombramiento_cordi']));
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
                                    Actualizar Coordinador
                                </button>
                                <a href="<?= APP_URL; ?>/admin/coordinadores" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
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
