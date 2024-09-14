<?php

// Configuración de la base de datos
if (!defined('SERVIDOR')) {
    define('SERVIDOR', 'localhost');
}
if (!defined('USUARIO')) {
    define('USUARIO', 'root');
}
if (!defined('PASSWORD')) {
    define('PASSWORD', '');
}
if (!defined('BD')) {
    define('BD', 'diplomado');
}

// Configuración de la aplicación
if (!defined('APP_NAME')) {
    define('APP_NAME', 'SISTEMA DE GESTIÓN DE POSGRADOS');
}
if (!defined('APP_URL')) {
    define('APP_URL', 'http://localhost/Diplomado');
}
if (!defined('KEY_API_MAPS')) {
    define('KEY_API_MAPS', '');
}

// Configuración del servidor y conexión a la base de datos
$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo "No se pudo conectar a la base de datos: " . $e->getMessage();
    die(); // Detener la ejecución si no se puede conectar a la base de datos
}

date_default_timezone_set("America/Caracas");

$fechaHora = date('Y-m-d H:i:s');
$fecha_actual = date('Y-m-d');
$dia_actual = date('d');
$mes_actual = date('m');
$ano_actual = date('Y');

$estado_de_registro = '1'; 

