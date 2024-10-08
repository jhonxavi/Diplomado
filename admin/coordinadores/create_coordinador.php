<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario
?>


<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Crear Nuevo Coordinador</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Nuevo Coordinador</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/coordinadores/create.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label for="nombre_cordi">Nombre del Coordinador</label>
                                    <input type="text" class="form-control" id="nombre_cordi" name="nombre_cordi" required>
                                </div>

                                <!-- Campo Identificación -->
                                <div class="form-group">
                                    <label for="id_cordi">Identificación</label>
                                    <input type="text" class="form-control" id="id_cordi" name="id_cordi" required>
                                </div>

                                <!-- Campo Dirección -->
                                <div class="form-group">
                                    <label for="dir_cordi">Dirección</label>
                                    <input type="text" class="form-control" id="dir_cordi" name="dir_cordi" required>
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="form-group">
                                    <label for="tel_cordi">Teléfono</label>
                                    <input type="text" class="form-control" id="tel_cordi" name="tel_cordi" required>
                                </div>

                                <!-- Campo Correo -->
                                <div class="form-group">
                                    <label for="email_cordi">Correo</label>
                                    <input type="email" class="form-control" id="email_cordi" name="email_cordi" required>
                                </div>

                                <!-- Campo Género -->
                                <div class="form-group">
                                    <label for="genero_cordi">Género</label>
                                    <select class="form-control" id="genero_cordi" name="genero_cordi" required>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>

                                <!-- Campo Fecha de Nacimiento -->
                                <div class="form-group">
                                    <label for="fecha_nacimiento_cordi">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_cordi" name="fecha_nacimiento_cordi" required>
                                </div>

                                <!-- Campo Fecha de Vinculación -->
                                <div class="form-group">
                                    <label for="fecha_vinculacion_cordi">Fecha de Vinculación</label>
                                    <input type="date" class="form-control" id="fecha_vinculacion_cordi" name="fecha_vinculacion_cordi" required>
                                </div>

                                <!-- Campo Acuerdo de Nombramiento (Archivo) -->
                                <div class="form-group">
                                    <label for="acuerdo_nombramiento_cordi">Acuerdo de Nombramiento (Archivo)</label><br>
                                    <label class="custom-file-upload">
                                        <input type="file" id="acuerdo_nombramiento_cordi" name="acuerdo_nombramiento_cordi" accept="application/pdf" required>
                                    </label>
                                </div>

                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Crear Coordinador
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
?>