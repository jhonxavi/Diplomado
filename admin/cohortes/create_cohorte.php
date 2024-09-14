<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Crear Nueva Cohorte</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary"style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Formulario de Nueva Cohorte</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/cohortes/create.php" method="post" enctype="multipart/form-data">

                                <!-- Campo Codigo -->
                                <div class="form-group">
                                    <label for="nombre_cohorte">Código de la cohorte</label>
                                    <input type="int" class="form-control" id="cod_cohorte" name="cod_cohorte" required>
                                </div>

                                <!-- Campo Nombre -->
                                <div class="form-group">
                                    <label for="nombre_cohorte">Nombre de la cohorte</label>
                                    <input type="text" class="form-control" id="nombre_cohorte" name="nombre_cohorte" required>
                                </div>

                                <!-- Campo fecha de inicio -->
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                </div>

                                <!-- Campo fecha finalizacion -->
                                <div class="form-group">
                                    <label for="fecha_finalizacion">Fecha de Finalizacion</label>
                                    <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" required>
                                </div>


                                <!-- Campo Numero de estudiantes -->
                                <div class="form-group">
                                    <label for="N_estudiantes">Numero de Estudiantes</label>
                                    <input type="text" class="form-control" id="N_estudiantes" name="N_estudiantes" required>
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
