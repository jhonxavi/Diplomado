<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario
?>


<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Crear Nuevo Programa</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Registro</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/programas/create.php" method="post" enctype="multipart/form-data">
                                
                                <!-- Campo SNIES -->
                                <div class="form-group">
                                    <label for="snies">Código SNIES</label>
                                    <input type="int" class="form-control" id="snies" name="snies" required>
                                </div>

                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label for="nombre_program">Nombre del Programa</label>
                                    <input type="text" class="form-control" id="nombre_program" name="nombre_program" required>
                                </div>

                                <!-- Campo descripcion programa -->
                                <div class="form-group">
                                    <label for="des_program">Descripción</label>
                                    <input type="text" class="form-control" id="des_program" name="des_program" required>
                                </div>

                                <!-- Campo Correo -->
                                <div class="form-group">
                                    <label for="email_program">Correo</label>
                                    <input type="email" class="form-control" id="email_program" name="email_program" required>
                                </div>

                                <!-- Campo Lineas de trabajo -->
                                <div class="form-group">
                                    <label for="lineas_trabajo">Lineas de trabajo</label>
                                    <input type="text" class="form-control" id="lineas_trabajo" name="lineas_trabajo" required>
                                </div>

                                <!-- Campo fecha -->
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                </div>

                                <!-- Campo No resolucion -->
                                <div class="form-group">
                                    <label for="no_resolucion">Número de resolución</label>
                                    <input type="int" class="form-control" id="no_resolucion" name="no_resolucion" required>
                                </div>

                                <!-- Campo Logo-->
                                <div class="form-group">
                                    <label for="logo">Logo</label><br>
                                    <label class="custom-file-upload">
                                        <input type="file" id="logo" name="logo" accept="image/*" required>
                                    </label>
                                </div>

                                <!-- Campo Resolucion de registro (Archivo) -->
                                <div class="form-group">
                                    <label for="archivo_pdf">Resolución de registro (Archivo)</label><br>
                                    <label class="custom-file-upload">
                                        <input type="file" id="archivo_pdf" name="archivo_pdf" accept="application/pdf" required>
                                    </label>
                                </div>

                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Crear Programa
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
?>