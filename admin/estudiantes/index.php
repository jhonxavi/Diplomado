<?php
include('../../app/config.php'); 
include('../../admin/layout/parte1.php'); 

include('../../app/controllers/estudiantes/listado_estudiantes.php'); // Incluye el controlador para obtener los datos
?>


<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Estudiantes</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-15">
                <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Estudiantes Registrados</h3>
                            <div class="card-tools">
                                <!-- Botón para crear un nuevo estudiante -->
                                <a href="create_estudiantes.php" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    <i class="bi bi-plus-square"></i> Crear Nuevo Estudiante</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                        <th>Nro</th>
                                        <th><center>Foto</center></th>
                                        <th><center>Identificación</center></th>
                                        <th><center>Nombre</center></th>
                                        <th><center>Código</center></th>
                                        <th><center>Correo</center></th>
                                        <th><center>Semestre</center></th>
                                        <th><center>Cohorte</center></th>
                                        <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_estudiante = 0;
                                foreach ($estudiante as $estudiante) {
                                    $id_estudiante = $estudiante['id_estudiante']; // Usa el campo `id_estudiante` como identificador
                                    $contador_estudiante++; ?>
                                    <tr>
                                        <td style="text-align: center"><?= $contador_estudiante; ?></td>

                                        <td>
                                            <?php if (!empty($estudiante['foto_estudiante'])): ?>
                                                <?php 
                                                // Ajusta la ruta al directorio correcto donde se almacenan las imágenes
                                                $estudianteUrl = APP_URL . '/docest/' . htmlspecialchars(basename($estudiante['foto_estudiante'])); 
                                                ?>
                                                <img src="<?= $estudianteUrl; ?>" alt="foto_estudiante - <?= htmlspecialchars(basename($estudiante['foto_estudiante'])); ?>" class="img-fluid"
                                                 style="max-width: 100%; height: 150px; text-align: center; border-radius: 8px;;">
                                            <?php else: ?>
                                                <p>No se ha subido ninguna imagen.</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $estudiante['id_estudiante']; ?></td>
                                        <td><?= $estudiante['nombre_estudiante']; ?></td>
                                        <td><?= $estudiante['Cod_estudiante']; ?></td>
                                        <td><?= $estudiante['email_estudiante']; ?></td>
                                        <td><?= $estudiante['semestre_estudiante']; ?></td>
                                        <td><?= $estudiante['estado_cohorte']; ?></td>
                                         
                                        <td style="text-align: center">
    <div class="btn-group" role="group" aria-label="Basic example">
        <!-- Botón de Visualizar -->
        <a href="show.php?id=<?= $id_estudiante; ?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>

        <!-- Botón de Editar -->
        <a href="edit_estudiante.php?id=<?= $id_estudiante; ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>

        <!-- Botón de Eliminar -->
        <form action="<?= APP_URL; ?>/app/controllers/estudiantes/delete.php" method="POST" id="miFormulario<?= $id_estudiante; ?>" style="display:inline;">
            <input type="hidden" name="id_estudiante" value="<?= $id_estudiante; ?>">
            <button type="button" class="btn btn-danger btn-sm" onclick="preguntar<?= $id_estudiante; ?>(event)" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
        </form>

        <!-- Script para la confirmación de eliminación -->
        <script>
            function preguntar<?= $id_estudiante; ?>(event) {
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
                        var form = $('#miFormulario<?= $id_estudiante; ?>');
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
include('../../admin/layout/parte2.php'); // Ajusta la ruta si es necesario
include('../../layout/mensajes.php'); // Ajusta la ruta si es necesario
?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
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
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
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
</script>
<style>
    h1 {
        font-size: 2.5rem; 
        font-weight: bold; 
        color: #001704; 
        padding: 10px; 
    }
</style>