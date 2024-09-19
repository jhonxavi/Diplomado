<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/roles/listado_de_roles.php');
include ('../../app/controllers/roles/listado_de_permisos.php');
include ('../../app/controllers/roles/listado_de_roles_permisos.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de roles</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-8">
                <div class="card card-outline card-success" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Roles registrados</h3>
                            <div class="card-tools">
                                <a href="create.php" class="btn btn-success"><i class="bi bi-plus-square"></i> Crear nuevo rol</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre del rol</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_rol = 0;
                                foreach ($roles as $role){
                                    $id_rol = $role['id_rol'];
                                    $contador_rol += 1; ?>
                                    <tr>
                                        <td style="text-align: center"><?=$contador_rol;?></td>
                                        <td><?=$role['nombre_rol'];?></td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_asignacion<?=$id_rol?>">
                                                    <i class="bi bi-arrow-up-circle"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modal_asignacion<?=$id_rol?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #28a745">
                                                                <h5 class="modal-title" id="exampleModalLabel">Asignación de Roles</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                     <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <input type="text" name="rol_id" id="rol_id<?=$id_rol;?>" value="<?=$id_rol;?>" hidden>
                                                                        <label><?=$role['nombre_rol']?></label>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <select name="permiso_id" id="permiso_id<?=$id_rol;?>" class="form-control">
                                                                            <?php
                                                                                foreach($permisos as $permiso){
                                                                                    $id_permiso = $permiso['id_permiso']; ?>
                                                                                    <option value="<?=$id_permiso?>"><?=$permiso['nombre_url'];?></option>
                                                                                <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        
                                                                        <button type="submit" class="btn btn-success mb-2" id="btn_reg<?=$id_rol;?>">Asignar</button>
                                                                    </div>

                                                                   
                                                                    <div id="respuesta<?=$id_rol;?>"></div>
                                                                </div>
                                                                <hr>                    
                                                                <div class="row">
                                                                    <table class="table table-bordered  table-sm table-striped table_hover" id="tabla<?=$id_rol;?>">
                                                                        <tr>
                                                                            <th style="text-align: center; background-color: #28a745">Nro</th>
                                                                            <th style="text-align: center; background-color: #28a745">Rol</th>
                                                                            <th style="text-align: center; background-color: #28a745">Permiso</th>
                                                                            <th style="text-align: center; background-color: #28a745">Accion</th>
                                                                        </tr>
                                                                          
                                                                        <!-- error -->
                                                                        <?php
                                                                        $contador= 0;
                                                                        foreach ($roles_permisos as $roles_permiso){
                                                                            if($id_rol == $roles_permiso['rol_id']){
                                                                                $id_rol_permiso = $roles_permiso['id_rol_permiso'];
                                                                                $contador = $contador + 1; ?>
                                                                                <tr>
                                                                                    <td><center><?=$contador;?></center></td>
                                                                                    <td><center><?=$roles_permiso['nombre_rol'];?></center></td>
                                                                                    <td><?=$roles_permiso['nombre_url'];?></td>
                                                                                    <td>
                                                                                        <form action="<?=APP_URL;?>/app/controllers/roles/delete_rol_permiso.php" onclick="preguntar<?=$id_rol_permiso;?>(event)" method="post" id="miFormulario<?=$id_rol_permiso;?>">
                                                                                            <input type="text" name="id_rol_permiso" value="<?=$id_rol_permiso;?>" hidden>
                                                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                                                        </form>
                                                                                        <script>
                                                                                            function preguntar<?=$id_rol_permiso;?>(event) {
                                                                                                event.preventDefault();
                                                                                                Swal.fire({
                                                                                                    title: 'Eliminar registro',
                                                                                                    text: '¿Desea eliminar este registro?',
                                                                                                    icon: 'question',
                                                                                                    showDenyButton: true,
                                                                                                    confirmButtonText: 'Eliminar',
                                                                                                    confirmButtonColor: '#a5161d',
                                                                                                    denyButtonColor: '#270a0a',
                                                                                                    denyButtonText: 'Cancelar',
                                                                                                }).then((result) => {
                                                                                                    if (result.isConfirmed) {
                                                                                                        var form = $('#miFormulario<?=$id_rol_permiso;?>');
                                                                                                        form.submit();
                                                                                                    }
                                                                                                });
                                                                                            }
                                                                                        </script>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php

                                                                            }


                                                                            
                                                                        }
                                                                        ?>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                                
                                                <a href="show.php?id=<?=$id_rol;?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <a href="edit.php?id=<?=$id_rol;?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                <form action="<?=APP_URL;?>/app/controllers/roles/delete.php" onclick="preguntar<?=$id_rol;?>(event)" method="post" id="miFormulario<?=$id_rol;?>">
                                                    <input type="text" name="id_rol" value="<?=$id_rol;?>" hidden>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <script>
                                                    function preguntar<?=$id_rol;?>(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Eliminar registro',
                                                            text: '¿Desea eliminar este registro?',
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            confirmButtonText: 'Eliminar',
                                                            confirmButtonColor: '#a5161d',
                                                            denyButtonColor: '#270a0a',
                                                            denyButtonText: 'Cancelar',
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#miFormulario<?=$id_rol;?>');
                                                                form.submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');
?>

<script>
// Usar delegación de eventos para botones generados dinámicamente
$(document).on('click', '[id^="btn_reg"]', function () {
    var buttonId = $(this).attr('id'); // Obtener el id del botón presionado
    var idRol = buttonId.replace('btn_reg', ''); // Extraer el id_rol

    var rolId = $('#rol_id' + idRol).val();  // Obtener el valor de rol_id
    var permisoId = $('#permiso_id' + idRol).val();  // Obtener el valor de permiso_id

    // Mostrar el alert con los valores obtenidos
    alert('Rol ID: ' + rolId + ' - Permiso ID: ' + permisoId);

    // Enviar datos al controlador utilizando AJAX con el método POST
    var url = "../../app/controllers/roles/create_roles_permisos.php";
    $.ajax({
        url: url,
        type: 'POST', // Usar POST para mayor seguridad en el envío de datos
        data: {
            rol_id: rolId,
            permiso_id: permisoId
        },
        success: function(response) {
            // Actualizar la respuesta en el contenedor correspondiente
            $('#respuesta' + idRol).html(response);

            // Mostrar una alerta con SweetAlert si la asignación fue exitosa
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Permiso asignado correctamente",
                showConfirmButton: false,
                timer: 1500
            });
        },
        error: function() {
            // Mostrar una alerta de error si algo falla en la solicitud
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al asignar el permiso',
            });
        }
    });
});
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "lengthMenu": "Mostrar _MENU_ Roles",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [
                {
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [
                        { text: 'pdf', extend: 'pdf' },
                        { extend: 'csv' },
                        { text: 'Imprimir', extend: 'print' }
                    ]
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<style>
    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #001704;
        padding: 10px;
    }
</style>
