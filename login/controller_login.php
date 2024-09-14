<?php
include ('../app/config.php');
include ('send_verification_code.php');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Guardar valores en la sesión
session_start();
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;

// Verifica si el correo existe en la base de datos
$sql = "SELECT * FROM usuarios WHERE email = :email AND estado = '1'";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email]);

$usuario = $query->fetch(PDO::FETCH_ASSOC);

if ($usuario) {
    $password_tabla = $usuario['password'];
    
    // Verificar la contraseña
    if (password_verify($password, $password_tabla)) {
        // Comprobar si es el primer ingreso
        if ($usuario['primer_ingreso'] == 1) {
            // Generar código de verificación
            $verificationCode = rand(100000, 999999);

            // Enviar correo con el código de verificación
            $sent = sendVerificationCode($email, $verificationCode);

            if ($sent) {
                $_SESSION['verification_code'] = $verificationCode;
                $_SESSION['mensaje'] = 'Se ha enviado un código de verificación a su correo.';
                header('Location: '.APP_URL.'/login/index.php?step=verification');
                exit();
            } else {
                $_SESSION['mensaje'] = 'Error al enviar el código de verificación. Intente nuevamente.';
                header('Location: '.APP_URL.'/login');
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "Bienvenido al sistema";
            $_SESSION['sesion_email'] = $email;
            header('Location:'.APP_URL."/admin");
            exit();
        }
    } else {
        $_SESSION['mensaje'] = "<div style='color: #28a745; text-align: center; margin: 1rem 0;'>La contraseña es incorrecta. Inténtelo nuevamente.</div>";
        header('Location:'.APP_URL."/login");
        exit();
    }
} else {
    $_SESSION['mensaje'] = "<div style='color: #28a745; text-align: center; margin: 1rem 0;'>El correo ingresado no está registrado</div>";   
    header('Location:'.APP_URL."/login");
    exit();
}
?>
