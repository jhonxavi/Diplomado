<?php
include ('../app/config.php');
session_start();

// Recuperar valores de sesión si están disponibles
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$password = isset($_SESSION['password']) ? $_SESSION['password'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=APP_NAME;?></title> 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= APP_URL;?>/public/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo">
      <center>    
        <img src="https://www.udenar.edu.co/recursos/wp-content/uploads/2021/09/logo-udenar-blanco.png" width="115px" alt="">
      </center>
      <a href=""><span style="font-size: 18px; font-weight: bold; color: #fff;">SISTEMA DE GESTIÓN DE POSGRADOS</span></a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">INICIO DE SESIÓN</p>
      <hr>
      <form action="controller_login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($email); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" value="<?= htmlspecialchars($password); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <p class="text-danger">
            <?php if(isset($_SESSION['mensaje'])): ?>
              <?=$_SESSION['mensaje'];?>
              <?php unset($_SESSION['mensaje']); ?>
            <?php endif; ?>
          </p>
        </div>
        <hr>
        <div class="input-group mb-3">
          <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
        </div>
        <?php if(isset($_GET['step']) && $_GET['step'] == 'verification'): ?>
        <div class="form-group">
          <label for="verification_code">Código de Verificación</label>
          <input type="text" name="verification_code" id="verification_code" class="form-control" placeholder="Ingrese el código" required>
        </div>
        <div class="form-group">
          <p class="text-danger">
            <?php if(isset($_SESSION['mensaje'])): ?>
              <?=$_SESSION['mensaje'];?>
              <?php unset($_SESSION['mensaje']); ?>
            <?php endif; ?>
          </p>
        </div>
        <div class="input-group mb-3">
          <button class="btn btn-success btn-block" type="submit" formaction="verify_code.php">Verificar Código</button>
        </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= APP_URL;?>/public/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= APP_URL;?>/public/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= APP_URL;?>/public/dist/js/adminlte.min.js"></script>
</body>
</html>

<style>
  body {
    background: linear-gradient(135deg, #ffffff 0%, #e0f7e9 100%);
    color: #004b23; /* Verde oscuro */
    font-family: 'Source Sans Pro', sans-serif;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .login-box {
    width: 400px;
    margin: 0 auto;
  }

  .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    background: #ffffff;
    padding: 20px;
    position: relative;
    z-index: 1;
  }

  .card::before {
    content: "";
    position: absolute;
    top: -15px;
    left: -15px;
    right: -15px;
    bottom: -15px;
    background: linear-gradient(135deg, #004b23, #00a64d);
    z-index: -1;
    border-radius: 15px;
  }

  .card-body {
    background-color: #ffffff;
    border-radius: 15px;
    padding: 30px;
  }

  .btn-primary,
  .btn-success { 
    background: linear-gradient(135deg, #00a64d 0%, #004b23 100%);
    border: none;
    border-radius: 25px;
    padding: 10px;
    color: #fff;
    font-weight: bold;
    transition: background 0.3s ease;
  }

  .btn-primary:hover,
  .btn-success:hover { 
    background: linear-gradient(135deg, #004b23 0%, #00a64d 100%);
    color: #fff;
  }

  .input-group-text {
    background-color: #004b23;
    color: #ffffff;
    border-radius: 0 25px 25px 0;
  }

  .form-control {
    border-radius: 25px 0 0 25px;
    border: 2px solid #004b23;
    padding: 10px;
  }

  .form-control:focus {
    border-color: #00a64d;
    box-shadow: none;
  }

  .login-box-msg {
  color: #004b23;
  font-size: 18px;
  font-weight: bold;
  margin-top: 0px; /* Ajusta el margen superior */
  margin-bottom: 0px; /* Ajusta el margen inferior */
}

  hr {
    border-top: 1px solid #004b23;
    margin: 12px 0; /* Ajusta el margen superior e inferior */
  }

  a {
    color: #004b23;
  }
</style>
