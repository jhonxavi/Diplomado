<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Crear Nuevo Docente</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Nuevo Docente</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/docentes/create.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nombre_docente">Nombre del Docente</label>
                                    <input type="text" class="form-control" id="nombre_docente" name="nombre_docente" required>
                                </div>
                                <div class="form-group">
                                    <label for="dir_docente">Dirección</label>
                                    <input type="text" class="form-control" id="dir_docente" name="dir_docente" required>
                                </div>
                                <div class="form-group">
                                    <label for="tel_docente">Teléfono</label>
                                    <input type="text" class="form-control" id="tel_docente" name="tel_docente" required maxlength="10">
                                </div>
                                <div class="form-group">
                                    <label for="email_docente">Correo</label>
                                    <input type="email" class="form-control" id="email_docente" name="email_docente" required>
                                </div>
                                <div class="form-group">
                                    <label for="genero_docente">Género</label>
                                    <select class="form-control" id="genero_docente" name="genero_docente" required>
                                        <option value="">Seleccione</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_nacimiento_docente">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento_docente" name="fecha_nacimiento_docente" required>
                                </div>
                                <div class="form-group">
                                    <label for="formacion_academica">Formación Académica</label>
                                    <select class="form-control" id="formacion_academica" name="formacion_academica" required>
                                        <option value="">Seleccione</option>
                                        <option value="Pregrado">Pregrado</option>
                                        <option value="Posgrado">Posgrado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="areas_conocimiento">Áreas de Conocimiento</label>
                                    <select class="form-control" id="areas_conocimiento" name="areas_conocimiento[]" multiple required>
                                        <option value="Ingeniería de Software">Ingeniería de Software</option>
                                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                                        <option value="Bases de Datos">Bases de Datos</option>
                                        <option value="Inteligencia Artificial">Inteligencia Artificial</option>
                                        <option value="Ciencia de Datos">Ciencia de Datos</option>
                                        <option value="Redes y Seguridad">Redes y Seguridad</option>
                                        <option value="Sistemas Embebidos">Sistemas Embebidos</option>
                                        <option value="Desarrollo Web">Desarrollo Web</option>
                                    </select>
                                </div>
                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Crear Docente
                                </button>
                                <a href="<?= APP_URL; ?>/admin/docentes" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
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
