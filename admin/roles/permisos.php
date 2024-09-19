<?php
include ('../../app/config.php');
include ('../../admin/layout/parte1.php');

include ('../../app/controllers/roles/listado_de_permisos.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de permisos</h1>
            </div>
            <br>
            <div class="row">

                <div class="col-md-12">
                <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Permisos registrados</h3>
                            <div class="card-tools">
                                <a href="create_permisos.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Crear nuevo permiso</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre de la URL</center></th>
                                    <th><center>URL</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador_permisos = 0;
                                    foreach ($permisos as $permiso){
                                        $id_permiso = $permiso['id_permiso'];
                                        $contador_permisos = $contador_permisos +1; ?>
                                        <tr>
                                            <td style="text-align: center"><?=$contador_permisos;?></td>
                                            <td><?=$permiso['nombre_url'];?></td>
                                            <td><?=$permiso['url'];?></td>

                                            <td style="text-align: center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="edit_permisos.php?id=<?=$id_permiso;?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                    <form action="<?=APP_URL;?>/app/controllers/roles/delete_permiso.php" onclick="preguntar<?=$id_permiso;?>(event)" method="post" id="miFormulario<?=$id_permiso;?>">
                                                        <input type="text" name="id_permiso" value="<?=$id_permiso;?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                    <script>
                                                        function preguntar<?=$id_permiso;?>(event) {
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
                                                                    var form = $('#miFormulario<?=$id_permiso;?>');
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php

include ('../../admin/layout/parte2.php');
include ('../../layout/mensajes.php');

?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Permisos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Permisos",
                "infoFiltered": "(Filtrado de _MAX_ total Permisos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Permisos",
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
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'pdf',
                    extend: 'pdf',
                },{
                    extend: 'csv'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
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