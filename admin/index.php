<?php
include('../app/config.php');
include('../admin/layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #fbfffb;">
    <br>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil del Presidente del Comité Curricular</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #FFFF;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 80%;
                margin: 0 auto;
                padding: 20px;
                background-color: #ffffff; /* Fondo blanco para la hoja */
                border: 1px solid #dddddd; /* Borde gris claro */
                border-radius: 8px; /* Bordes redondeados */
                box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Sombra sutil */
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }
            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #dddddd; /* Borde inferior gris claro */
            }
            th {
                background-color: #4CAF50; /* Fondo verde para los encabezados */
                color: white; /* Texto blanco en los encabezados */
                font-size: 1.1em;
            }
            td {
                background-color: #f9f9f9; /* Fondo gris claro para las celdas */
            }
            tr:hover {
                background-color: #f1f1f1; /* Color de fondo para fila al pasar el cursor */
            }
            caption {
                caption-side: top;
                font-size: 1.6em;
                margin: 10px 0;
                color: #333;
                font-weight: bold;
            }
            .img-container {
                max-width: 250px;
            }
            .img-container img {
                max-width: 100%;
                height: auto;
                border-radius: 10px;
                border: 2px solid #4CAF50; /* Bordes verdes para la imagen */
            }
            .profile-info {
                margin-top: 20px;
            }
            .profile-info h2 {
                color: #4CAF50;
                font-size: 1.5em;
                margin-bottom: 10px;
            }
            .profile-info p {
                font-size: 1.1em;
                line-height: 1.6;
                color: #333;
            }
            .contact-info {
                margin-top: 20px;
            }
            .contact-info h3 {
                color: #4CAF50;
                font-size: 1.2em;
            }
            .contact-info ul {
                list-style-type: none;
                padding: 0;
            }
            .contact-info li {
                font-size: 1.1em;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php
            // Datos ficticios del presidente del Comité Curricular
            $presidente = [
                'nombre' => 'Dr. Juan Pérez González',
                'titulo' => 'Doctorado en Ciencias de la Ingeniería',
                'facultad' => 'Facultad de Ingeniería',
                'experiencia' => 20,
                'cargo' => 5,
                'especializacion' => 'Sistemas de Control Avanzados',
                'biografia' => 'El Dr. Juan Pérez González es un académico de renombre en el campo de la ingeniería con más de 20 años de experiencia en investigación y enseñanza. Su trabajo en sistemas de control avanzados ha sido fundamental para el desarrollo de nuevas tecnologías en la industria. Además de su labor académica, ha sido miembro activo en múltiples comités y ha liderado importantes proyectos de innovación.',
                'logros' => [
                    'Implementación de un sistema de optimización para el monitoreo en tiempo real, que redujo los costos operativos en un 25%.',
                    'Liderazgo en un proyecto de investigación colaborativo que resultó en la creación de un nuevo estándar de calidad en procesos industriales.',
                    'Premio Nacional de Innovación en Tecnología en 2022.'
                ],
                'contacto' => [
                    'email' => 'juan.perez@nariño.edu.co',
                    'telefono' => '+57 123 456 7890',
                    'oficina' => 'Edificio de Ingeniería, Oficina 301'
                ],
                'foto' => 'https://media.istockphoto.com/id/1171169099/es/foto/hombre-con-brazos-cruzados-aislados-sobre-fondo-gris.jpg?s=612x612&w=0&k=20&c=8qDLKdLMm2i8DHXY6crX6a5omVh2IxqrOxJV2QGzgFg=' // URL de la imagen proporcionada
            ];
            ?>

            <h2>Perfil del Presidente del Comité Curricular</h2>
            <div class="img-container">
                <img src="<?php echo $presidente['foto']; ?>" alt="Foto del Presidente">
            </div>

            <table>
                <tr>
                    <td><strong>Nombre:</strong> <?php echo $presidente['nombre']; ?></td>
                </tr>
                <tr>
                    <td><strong>Biografía:</strong> <?php echo $presidente['biografia']; ?></td>
                </tr>
                <tr>
                    <td><strong>Título Académico:</strong> <?php echo $presidente['titulo']; ?></td>
                </tr>
                <tr>
                    <td><strong>Facultad:</strong> <?php echo $presidente['facultad']; ?></td>
                </tr>
                <tr>
                    <td><strong>Años de Experiencia:</strong> <?php echo $presidente['experiencia']; ?> años</td>
                </tr>
                <tr>
                    <td><strong>Años en el Cargo:</strong> <?php echo $presidente['cargo']; ?> años</td>
                </tr>
                <tr>
                    <td><strong>Especialización:</strong> <?php echo $presidente['especializacion']; ?></td>
                </tr>
                <tr>
                    <td><strong>Logros Destacados:</strong></td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <?php foreach ($presidente['logros'] as $logro) : ?>
                                <li><?php echo $logro; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td><strong>Información de Contacto:</strong></td>
                </tr>
                <tr>
                    <td>
                        <ul>
                            <li>Email: <?php echo $presidente['contacto']['email']; ?></li>
                            <li>Teléfono: <?php echo $presidente['contacto']['telefono']; ?></li>
                            <li>Oficina: <?php echo $presidente['contacto']['oficina']; ?></li>
                        </ul>
                    </td>
                </tr>
            </table>
        </div>
    </body>
    </html>
</div>

<?php
include('../admin/layout/parte2.php');
?>
