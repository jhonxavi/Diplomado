<?php
$id_permiso = $_GET['id'];
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario

// Supongo que aquí se obtiene la información del permiso con el ID proporcionado
include('../../app/controllers/roles/datos_permisos.php'); // Ajusta la ruta si es necesario

// Asegúrate de que $nombre_url y $url estén correctamente definidas en 'datos_permisos.php'

?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Editar permiso</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-success" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/roles/update_permisos.php" method="post" enctype="multipart/form-data">
                                <!-- Campo oculto para el ID del permiso -->
                                <input type="hidden" name="id_permiso" value="<?= $id_permiso; ?>">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Nombre de la URL</label>
                                            <input type="text" value="<?= $id_permiso; ?>" name="id_permiso" hidden>
                                            <input type="text" value="<?= $nombre_url; ?>" name="nombre_url" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">URL</label>
                                            <input type="text" value="<?= $url; ?>" name="url" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Actualizar
                                </button>
                                <a href="<?= APP_URL; ?>/admin/roles/permisos.php" class="btn" style="background-color: #6c757d; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
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
