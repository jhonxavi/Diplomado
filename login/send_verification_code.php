<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Asegúrate de que la ruta es correcta

function sendVerificationCode($email, $verificationCode) {
    $mail = new PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Servidor SMTP de Gmail
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jeisondaneiro@gmail.com'; // Tu correo
        $mail->Password   = 'qjqe dctp sgui bwdu'; // Tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinatarios
        $mail->setFrom('jeisondaneiro@gmail.com', 'udenar');
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Código de Verificación';
        $mail->Body    = 'Tu código de verificación es: ' . $verificationCode;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
