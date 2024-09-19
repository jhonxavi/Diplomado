<?php
include('../../app/config.php'); // Ajusta la ruta si es necesario
include('../../admin/layout/parte1.php'); // Ajusta la ruta si es necesario

// include('../../app/controllers/roles/listado_de_roles.php'); // Ajusta la ruta si es necesario

?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Registro de un nuevo permiso</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= APP_URL; ?>/app/controllers/roles/create_permisos.php" method="post" enctype="multipart/form-data">
                                <!-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Roles">Roles</label>
                                            <select name="rol_id" id="" class="form-control">
                                                <?php
                                                /*foreach ($roles as $role){
                                                    ?>
                                                    <option value="<?role['id_rol'];?>"><?=$role['nombre_rol'];?></option>
                                                    <?php
                                                }*/
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Roles">Nombre de la URL</label>
                                            <input type="text" name="nombre_url" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Roles">URL</label>
                                            <input type="text" name="url" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                


                                
                                <!-- Botones para enviar o cancelar -->
                                <button type="submit" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    Crear Permiso
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
