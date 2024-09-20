<?php
include('../../app/config.php'); 
include('../../admin/layout/parte1.php'); 

include('../../app/controllers/cohortes/listado_cohortes.php'); // Incluye el controlador para obtener los datos

?>


<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
        <div class="row">
           <h1>Listado de Cohortes</h1>
        </div>
        <br>
        <div  class="row">
            <div class="col-md-15">
            <div class="card card-outline card-primary" style="border-color: #28a745;">
                    <div class="card-header">
                        <h3 class="card-title">Cohortes Registradas</h3>
                            <div class="card-tools">
                                <!-- Botón para crear un nuevo programa -->
                                <a href="create_cohorte.php" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    <i class="bi bi-plus-square"></i> Crear nueva cohorte</a>
                            </div>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                            <thead>
                                <tr>
                                    <th><center>Código</center></th>
                                    <th><center>Nombre</center></th>
                                    <th><center>Fecha de Inicio</center></th>
                                    <th><center>Fecha de Finalizacion</center></th>
                                    <th><center>Estudiantes Matriculados</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $contador_cohortes =0;
                                    foreach ($cohorte as $cohorte){
                                            $cod_cohorte = $cohorte['cod_cohorte'];// Usa el campo `cod_cohorte` como identificador
                                            $contador_cohortes++; ?>
                                            <tr>
                                                <td><?= $cohorte['cod_cohorte']; ?></td>
                                                <td><?= $cohorte['nombre_cohorte']; ?></td>
                                                <td><?= $cohorte['fecha_inicio']; ?></td>
                                                <td><?= $cohorte['fecha_finalizacion']; ?></td>
                                                <td><?= $cohorte['N_estudiantes']; ?></td>

                                                <td style="text-align: center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="show.php?id=<?= $cod_cohorte; ?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>

                                                        <a href="edit_cohorte.php?cod_cohorte=<?= htmlspecialchars($cohorte['cod_cohorte']) ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>

                                                <!-- Botón para eliminar -->
                                                <form action="<?= APP_URL; ?>/app/controllers/cohortes/delete_cohorte.php" method="post" id="miFormulario<?= htmlspecialchars($cod_cohorte); ?>">
                                                    <input type="hidden" name="cod_cohorte" value="<?= htmlspecialchars($cod_cohorte); ?>">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="preguntar<?= htmlspecialchars($cod_cohorte); ?>()">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                                              
                                                <script>
                                                    function preguntar<?= htmlspecialchars($cod_cohorte); ?>() {
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
                                                                document.getElementById('miFormulario<?= htmlspecialchars($cod_cohorte); ?>').submit();
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