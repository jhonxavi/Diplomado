<?php
include('../app/config.php');
session_start();

// Verificar si el código de verificación se ha enviado
if (isset($_POST['verification_code'])) {
    $inputCode = $_POST['verification_code'];
    $sessionCode = $_SESSION['verification_code'];
    $email = $_SESSION['email'];

    if ($inputCode == $sessionCode) {
        // Código correcto: Actualizar el estado del usuario y redirigir
        $sql = "UPDATE usuarios SET primer_ingreso = 0 WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->execute(['email' => $email]);

        // Iniciar sesión del usuario
        $_SESSION['sesion_email'] = $email;
        $_SESSION['mensaje'] = "Bienvenido al sistema";
        header('Location: '.APP_URL.'/admin');
        exit();
    } else {
        $_SESSION['mensaje'] = "Código de verificación incorrecto. Intente nuevamente.";
        header('Location: '.APP_URL.'/login/index.php?step=verification');
        exit();
    }
}

// Redirigir a login si no se accede con POST
header('Location: '.APP_URL.'/login');
exit();
?>
