<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
        <div class="content">
            <div class="container">
                <div class="row">
                    <h1>Inscribir Estudiante</h1>
                </div>
                <br>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card card-outline card-primary" style="border-color: #28a745;">
                            <div class="card-header">
                                <h3 class="card-title">Formulario de Inscripción de Estudiante</h3>
                            </div>

                                <div class="card-body">
                                    <form action="<?= APP_URL; ?>/app/controllers/estudiantes/create.php" method="post" enctype="multipart/form-data">
                                        
                                        <!-- Campo Nombre -->
                                        <div class="form-group">
                                            <label for="nombre_estudiante">Nombre</label>
                                            <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" required>
                                        </div>

                                        <!-- Campo Identificación -->
                                        <div class="form-group">
                                            <label for="id_estudiante">Identificación</label>
                                            <input type="text" class="form-control" id="id_estudiante" name="id_estudiante" required>
                                        </div>

                                        <!-- Campo Código Estudiantil -->
                                        <div class="form-group">
                                            <label for="Cod_estudiante">Código</label>
                                            <input type="text" class="form-control" id="Cod_estudiante" name="Cod_estudiante" required>
                                        </div>

                                        <!-- Campo Foto -->
                                        <div class="form-group">
                                            <label for="foto_estudiante">Foto</label><br>
                                            <label class="custom-file-upload">
                                                <input type="file" id="foto_estudiante" name="foto_estudiante" accept="image/*" required>
                                            </label>
                                        </div>

                                        <!-- Campo Dirección -->
                                        <div class="form-group">
                                            <label for="dir_estudiante">Dirección</label>
                                            <input type="text" class="form-control" id="dir_estudiante" name="dir_estudiante" required>
                                        </div>

                                        <!-- Campo Teléfono -->
                                        <div class="form-group">
                                            <label for="tel_estudiante">Teléfono</label>
                                            <input type="text" class="form-control" id="tel_estudiante" name="tel_estudiante" required maxlength="10">
                                        </div>

                                        <!-- Campo Correo -->
                                        <div class="form-group">
                                            <label for="email_estudiante">Correo</label>
                                            <input type="email" class="form-control" id="email_estudiante" name="email_estudiante" required>
                                        </div>

                                        <!-- Campo Fecha de Nacimiento -->
                                        <div class="form-group">
                                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                                        </div>

                                        <!-- Campo Género 
                                        <div class="form-group">
                                            <label for="genero_estudiante">Género</label>
                                            <select class="form-control" id="genero_estudiante" name="genero_estudiante" required>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>-->

                                        <!-- Campo Semestre -->
                                        <div class="form-group">
                                            <label for="semestre_estudiante">Semestre</label>
                                            <select class="form-control" id="semestre_estudiante" name="semestre_estudiante" required>
                                                <option value="Semestre 7">Semestre 7</option>
                                                <option value="Semestre 8">Semestre 8</option>
                                                <option value="Semestre 9">Semestre 9</option>
                                                <option value="Semestre 10">Semestre 10</option>
                                                <option value="Egresado">Egresado</option>
                                            </select>
                                        </div>

                                        <!-- Campo Estado Civil -->
                                        <div class="form-group">
                                            <label for="estado_civil">Estado Civil</label>
                                            <select class="form-control" id="estado_civil" name="estado_civil" required>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="UnionLibre">Unión Libre</option>
                                                <option value="Viudo">Viudo</option>
                                            </select>
                                        </div>

                                        <!-- Campo Fecha de Ingreso -->
                                        <div class="form-group">
                                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                                        </div>

                                        <!-- Campo Fecha de Egreso -->
                                        <div class="form-group">
                                            <label for="fecha_egreso">Fecha de Egreso</label>
                                            <input type="date" class="form-control" id="fecha_egreso" name="fecha_egreso" required>
                                        </div>
                                        
                                        <!-- Campo Cohorte Inscrito -->
                                        <div class="form-group">
                                            <label for="estado_cohorte">Cohorte</label>
                                            <select class="form-control" id="estado_cohorte" name="estado_cohorte" required>
                                                <option value="Cohorte1">Cohorte 1</option>
                                                <option value="Cohorte2">Cohorte 2</option>
                                                <option value="Cohorte3">Cohorte 3</option>
                                                <option value="Cohorte4">Cohorte 4</option>
                                            </select>
                                        </div>

                                        <!-- Botones para enviar o cancelar -->
                                        <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                            Crear Estudiante
                                        </button>
                                        <a href="<?= APP_URL; ?>/admin/estudiantes" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
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
