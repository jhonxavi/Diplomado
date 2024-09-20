<?php
include('../../app/config.php'); 
include('../../admin/layout/parte1.php'); 

include('../../app/controllers/programas/listado_programas.php'); // Incluye el controlador para obtener los datos
?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Programas</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <div class="card-tools">
                                <a href="create_program.php" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    <i class="bi bi-plus-square"></i> Crear nuevo programa
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th><center>Logo</center></th>
                                    <th><center>Código SNIES</center></th>
                                    <th><center>Nombre del programa</center></th>
                                    <th><center>Descripción</center></th>
                                    <th><center>Correo</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_programa = 0;
                                foreach ($programas as $programa) {
                                    $id_programa = $programa['snies']; // Usa el campo `snies` como identificador
                                    $contador_programa++; ?>
                                    <tr>
                                        <!-- Imagen del programa -->
                                        <td>
                                            <?php if (!empty($programa['logo'])): ?>
                                                <?php 
                                                // Ajusta la ruta al directorio correcto donde se almacenan las imágenes
                                                $logoUrl = APP_URL . '/docpro/' . htmlspecialchars(basename($programa['logo'])); 
                                                ?>
                                                <img src="<?= $logoUrl; ?>" alt="Logo - <?= htmlspecialchars(basename($programa['logo'])); ?>" class="img-fluid" style="max-width: 100%; height: auto; text-align: center; border-radius: 8px;">
                                            <?php else: ?>
                                                <p>No se ha subido ninguna imagen.</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($programa['snies']); ?></td>
                                        <td><?= htmlspecialchars($programa['nombre_program']); ?></td>
                                        <td><?= htmlspecialchars($programa['des_program']); ?></td>
                                        <td><?= htmlspecialchars($programa['email_program']); ?></td>
                                        
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                
                                                <a href="show.php?id=<?= htmlspecialchars($id_programa); ?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>

                                                <a href="edit_program.php?snies=<?= htmlspecialchars($programa['snies']) ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>

                                                <!-- Botón para eliminar -->
                                                <form action="<?= APP_URL; ?>/app/controllers/programas/delete_program.php" method="post" id="miFormulario<?= htmlspecialchars($id_programa); ?>">
                                                    <input type="hidden" name="snies" value="<?= htmlspecialchars($id_programa); ?>">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="preguntar<?= htmlspecialchars($id_programa); ?>()">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                              
                                                <script>
                                                    function preguntar<?= htmlspecialchars($id_programa); ?>() {
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
                                                                document.getElementById('miFormulario<?= htmlspecialchars($id_programa); ?>').submit();
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