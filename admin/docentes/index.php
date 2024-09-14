<?php
include('../../app/config.php'); 
include('../../admin/layout/parte1.php'); 

include('../../app/controllers/docentes/listado_docentes.php'); // Incluye el controlador para obtener los datos de docentes

?>

<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <div class="content">
        <div class="container">
            <div class="row">
                <h1>Listado de Docentes</h1>
            </div>
            <br>
            <div class="row">
                <div class="col-md-15">
                <div class="card card-outline card-primary" style="border-color: #28a745;">
                        <div class="card-header">
                            <h3 class="card-title">Docentes Registrados</h3>
                            <div class="card-tools">
                                <!-- Botón para crear un nuevo docente -->
                                <a href="create_docente.php" class="btn" style="background-color: #28a745; color: white; border: none; border-radius: 0.25rem; padding: 0.5rem 1rem; font-weight: bold;">
                                    <i class="bi bi-plus-square"></i> Crear nuevo docente</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover table-sm">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>ID Docente</center></th>
                                    <th><center>Nombre del Docente</center></th>
                                    <th><center>Dirección</center></th>
                                    <th><center>Teléfono</center></th>
                                    <th><center>Correo</center></th>
                                    <th><center>Género</center></th>
                                    <th><center>Fecha de Nacimiento</center></th>
                                    <th><center>Formación Académica</center></th>
                                    <th><center>Áreas de Conocimiento</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador_docente = 0;
                                foreach ($docentes as $docente){
                                    $id_docente = $docente['id_docente']; // Usa el campo `id_docente` como identificador
                                    $contador_docente++; ?>
                                    <tr>
                                        <td style="text-align: center"><?= $contador_docente; ?></td>
                                        <td><?= $docente['id_docente']; ?></td>
                                        <td><?= $docente['nombre_docente']; ?></td>
                                        <td><?= $docente['dir_docente']; ?></td>
                                        <td><?= $docente['tel_docente']; ?></td>
                                        <td><?= $docente['email_docente']; ?></td>
                                        <td><?= $docente['genero_docente']; ?></td>
                                        <td><?= $docente['fecha_nacimiento_docente']; ?></td>
                                        <td><?= $docente['formacion_academica']; ?></td>
                                        <td><?= $docente['areas_conocimiento']; ?></td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="show.php?id=<?= $id_docente; ?>" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                                                <!-- <a href="edit.php?id=<?= $id_docente; ?>" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                                                <form action="<?= APP_URL; ?>/app/controllers/docentes/delete.php" onclick="preguntar<?= $id_docente; ?>(event)" method="post" id="miFormulario<?= $id_docente; ?>">
                                                    <input type="text" name="id_docente" value="<?= $id_docente; ?>" hidden>
                                                    <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 5px 5px 0px"><i class="bi bi-trash"></i></button>
                                                </form> -->
                                                <script>
                                                    function preguntar<?= $id_docente; ?>(event) {
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
                                                                var form = $('#miFormulario<?= $id_docente; ?>');
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Docentes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Docentes",
                "infoFiltered": "(Filtrado de _MAX_ total Docentes)",
                "lengthMenu": "Mostrar _MENU_ Docentes",
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