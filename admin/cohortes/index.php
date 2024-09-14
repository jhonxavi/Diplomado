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
                                            $cod_cohorte = $cohorte['cod_cohorte'];// Usa el campo `id_cordi` como identificador
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
                                                         <!-- <a href="edit.php?id=<?= $cod_cohorte; ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                        <form action="<?= APP_URL; ?>/app/controllers/coordinadores/delete.php" onclick="preguntar<?= $cod_cohorte; ?>(event)" method="post" id="miFormulario<?= $cod_cohorte; ?>">
                                                        <input type="text" name="id_cordi" value="<?= $cod_cohorte; ?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                        </form> -->
                                                        <script>
                                                            function preguntar<?= $cod_cohorte; ?>(event) {
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
                                                                        var form = $('#miFormulario<?= $cod_cohorte; ?>');
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Programas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Programas",
                "infoFiltered": "(Filtrado de _MAX_ total Programas)",
                "lengthMenu": "Mostrar _MENU_ Programas",
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
            /*buttons: [{
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
            }],*/
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