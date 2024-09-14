<?php

// Incluimos el archivo de configuración, donde se encuentra APP_URL
include ('../app/config.php');

// Iniciamos la sesión para poder manipular las variables de sesión
session_start();

// Verificamos si existe una sesión activa para el usuario
if(isset($_SESSION['sesion_email'])){
    
    // Si hay una sesión activa, la destruimos para cerrar la sesión del usuario
    session_destroy();
    
    // Redirigimos al usuario a la página de inicio de sesión después de cerrar la sesión
    // APP_URL es una constante que está definida en config.php y apunta a la URL base de la aplicación
    header('Location: '.APP_URL.'/login');
}

?>