<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Crear Nuevo Asistente</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Nuevo Asistente</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/asistente/create.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label for="nombre_asistente">Nombre del Asistente</label>
                                    <input type="text" class="form-control" id="nombre_asistente" name="nombre_asistente" required>
                                </div>

                                <!-- Campo Identificación -->
                                <div class="form-group">
                                    <label for="id_asistente">Identificación</label>
                                    <input type="text" class="form-control" id="id_asistente" name="id_asistente" required>
                                </div>

                                <!-- Campo Dirección -->
                                <div class="form-group">
                                    <label for="dir_asistente">Dirección</label>
                                    <input type="text" class="form-control" id="dir_asistente" name="dir_asistente" required>
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="form-group">
                                    <label for="tel_asistente">Teléfono</label>
                                    <input type="text" class="form-control" id="tel_asistente" name="tel_asistente" required>
                                </div>

                                <!-- Campo Correo -->
                                <div class="form-group">
                                    <label for="email_asistente">Correo</label>
                                    <input type="email" class="form-control" id="email_asistente" name="email_asistente" required>
                                </div>

                                <!-- Campo Género -->
                                <div class="form-group">
                                    <label for="genero_asistente">Género</label>
                                    <select class="form-control" id="genero_asistente" name="genero_asistente" required>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>

                                <!-- Campo Fecha de Nacimiento -->
                                <div class="form-group">
                                    <label for="fecha_nacimiento_asistente">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_asistente" name="fecha_nacimiento_asistente" required>
                                </div>

                                <!-- Campo Fecha de Vinculación -->
                                <div class="form-group">
                                    <label for="fecha_vinculacion_asistente">Fecha de Vinculación</label>
                                    <input type="date" class="form-control" id="fecha_vinculacion_asistente" name="fecha_vinculacion_asistente" required>
                                </div>

                                <!-- Campo Acuerdo de Nombramiento (Archivo) -->
                                <div class="form-group">
                                    <label for="acuerdo_nombramiento_asistente">Acuerdo de Nombramiento (Archivo)</label><br>
                                    <label class="custom-file-upload">
                                        <input type="file" id="acuerdo_nombramiento_asistente" name="acuerdo_nombramiento_asistente" accept="application/pdf" required>
                                    </label>
                                </div>

                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Crear Asistente 
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
