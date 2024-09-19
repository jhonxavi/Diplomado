<?php
ob_start(); // Inicia el buffering de salida

include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario

// Obtener el SNIES del programa a editar
$snies = $_GET['snies'] ?? '';
if (empty($snies)) {
    header('Location: ' . APP_URL . '/admin/programas'); // Redirige si no se proporciona SNIES
    exit();
}

// Obtener los datos del programa desde la base de datos
$sentencia = $pdo->prepare("SELECT * FROM programas WHERE snies = :snies");
$sentencia->bindParam(':snies', $snies);
$sentencia->execute();
$programa = $sentencia->fetch(PDO::FETCH_ASSOC);

if (!$programa) {
    header('Location: ' . APP_URL . '/admin/programas'); // Redirige si no se encuentra el programa
    exit();
}
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar Programa</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Edición</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/programas/update_program.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Campo SNIES (solo lectura) -->
                                <div class="form-group">
                                    <label for="snies">Código SNIES</label>
                                    <input type="text" class="form-control" id="snies" name="snies" value="<?= htmlspecialchars($programa['snies']) ?>" readonly>
                                </div>

                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label for="nombre_program">Nombre del Programa</label>
                                    <input type="text" class="form-control" id="nombre_program" name="nombre_program" value="<?= htmlspecialchars($programa['nombre_program']) ?>" required>
                                </div>

                                <!-- Campo descripción del programa -->
                                <div class="form-group">
                                    <label for="des_program">Descripción</label>
                                    <input type="text" class="form-control" id="des_program" name="des_program" value="<?= htmlspecialchars($programa['des_program']) ?>" required>
                                </div>

                                <!-- Campo Correo -->
                                <div class="form-group">
                                    <label for="email_program">Correo</label>
                                    <input type="email" class="form-control" id="email_program" name="email_program" value="<?= htmlspecialchars($programa['email_program']) ?>" required>
                                </div>

                                <!-- Campo Lineas de trabajo -->
                                <div class="form-group">
                                    <label for="lineas_trabajo">Líneas de trabajo</label>
                                    <input type="text" class="form-control" id="lineas_trabajo" name="lineas_trabajo" value="<?= htmlspecialchars($programa['lineas_trabajo']) ?>" required>
                                </div>

                                <!-- Campo Fecha -->
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($programa['fecha']) ?>" required>
                                </div>

                                <!-- Campo No Resolución -->
                                <div class="form-group">
                                    <label for="no_resolucion">Número de resolución</label>
                                    <input type="text" class="form-control" id="no_resolucion" name="no_resolucion" value="<?= htmlspecialchars($programa['no_resolucion']) ?>" required>
                                </div>

                                <!-- Campo Logo -->
                                <div class="form-group">
                                    <label for="logo">Logo (dejar en blanco si no deseas cambiar)</label><br>
                                    <input type="file" id="logo" name="logo" accept="image/*">
                                    <?php if (!empty($programa['logo'])): ?>
                                        <?php 
                                        // Ajusta la ruta al directorio correcto donde se almacenan las imágenes
                                        $logoUrl = APP_URL . '/docpro/' . htmlspecialchars(basename($programa['logo']));
                                        ?>
                                        <img src="<?= $logoUrl; ?>" alt="Logo Actual" style="max-width: 150px; margin-top: 10px;">
                                    <?php endif; ?>
                                </div>

                                <!-- Campo Resolución de registro (Archivo) -->
                                <div class="form-group">
                                    <label for="archivo_pdf">Resolución de registro (Archivo) (dejar en blanco si no deseas cambiar)</label><br>
                                    <input type="file" id="archivo_pdf" name="archivo_pdf" accept="application/pdf">
                                    <?php if (!empty($programa['archivo_pdf'])): ?>
                                        <?php
                                        // Ajusta la ruta al directorio correcto donde se almacenan los archivos PDF
                                        $archivoPdfUrl = APP_URL . '/uploads/' . htmlspecialchars(basename($programa['archivo_pdf']));
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
                                    Actualizar Programa
                                </button>
                                <a href="<?= APP_URL; ?>/admin/programas" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
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
