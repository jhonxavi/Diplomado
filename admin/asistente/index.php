<?php
include('../../app/config.php'); 
include('../../admin/layout/parte1.php'); 

include('../../app/controllers/asistente/listado_asistentes.php'); // Incluye el controlador para obtener los datos de los asistentes
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Asistentes</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-15">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Asistentes Registrados</h3>
                            <div class="card-tools">
                                <!-- Botón para crear un nuevo asistente -->
                                <a href="create_asistente.php" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    <i class="bi bi-plus-square"></i> Crear nuevo Asistente
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre</center></th>
                                    <th><center>Identificación</center></th>
                                    <th><center>Dirección</center></th>
                                    <th><center>Teléfono</center></th>
                                    <th><center>Correo</center></th>
                                    <th><center>Género</center></th>
                                    <th><center>Fecha de nacimiento</center></th>
                                    <th><center>Acuerdo de nombramiento</center></th>
                                    <!-- Agrega o quita columnas según los datos disponibles en la tabla `asistentes` -->
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_asistente = 0;
                                foreach ($asistentes as $asistente) {
                                    $id_asistente = $asistente['id_asistente']; // Usa el campo `id_asistente` como identificador
                                    $contador_asistente++; ?>
                                    <tr>
                                        <td style="text-align: center"><?= $contador_asistente; ?></td>
                                        <td><?= htmlspecialchars($asistente['nombre_asistente']); ?></td>
                                        <td><?= htmlspecialchars($asistente['id_asistente']); ?></td>
                                        <td><?= htmlspecialchars($asistente['dir_asistente']); ?></td>
                                        <td><?= htmlspecialchars($asistente['tel_asistente']); ?></td>
                                        <td><?= htmlspecialchars($asistente['email_asistente']); ?></td>
                                        <td><?= htmlspecialchars($asistente['genero_asistente']); ?></td>
                                        <td><?= htmlspecialchars($asistente['fecha_nacimiento_asistente']); ?></td>
                                        <td style="text-align: center">
                                            <?php if (!empty($asistente['acuerdo_nombramiento_asistente'])): ?>
                                                <a href="uploads/<?= htmlspecialchars($asistente['acuerdo_nombramiento_asistente']); ?>" class="btn btn-sm btn-secondary" download>
                                                    Descargar PDF
                                                </a>
                                            <?php else: ?>
                                                No disponible
                                            <?php endif; ?>
                                        </td>           
                                        <!-- Columna para acciones -->
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="show.php?id=<?= $id_asistente; ?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>

                                                <a href="edit_asistente.php?id_asistente=<?= htmlspecialchars($asistente['id_asistente']) ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>

                                                <!-- Botón para eliminar -->
                                                <form action="<?= APP_URL; ?>/app/controllers/asistente/delete_asistente.php" method="post" id="miFormulario<?= htmlspecialchars($id_asistente); ?>">
                                                    <input type="hidden" name="id_asistente" value="<?= htmlspecialchars($id_asistente); ?>">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="preguntar<?= htmlspecialchars($id_asistente); ?>()">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                              
                                                <script>
                                                    function preguntar<?= htmlspecialchars($id_asistente); ?>() {
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
                                                                document.getElementById('miFormulario<?= htmlspecialchars($id_asistente); ?>').submit();
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Asistentes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Asistentes",
                "infoFiltered": "(Filtrado de _MAX_ total Asistentes)",
                "lengthMenu": "Mostrar _MENU_ Asistentes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
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
                }]
            }],
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
