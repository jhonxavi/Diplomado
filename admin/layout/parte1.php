<?php
session_start();

if(isset($_SESSION['sesion_email'])){
    // $email_sesion = $_SESSION['sesion_email'];
    // $query_sesion = $pdo->prepare("SELECT * FROM usuarios WHERE email = '$email_sesion' AND estado = '1' ");
    // $query_sesion->execute();

    // $datos_sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    // foreach ($datos_sesion_usuarios as $datos_sesion_usuario){
    //    $nombre_sesion_usuario = $datos_sesion_usuario['nombres'];
    // }

    //------------------Christian Erazo-----------------------//
    
    $email_sesion = $_SESSION['sesion_email'];
    $query_sesion = $pdo->prepare("SELECT * FROM usuarios as usu 
                                            INNER JOIN roles as rol ON rol.id_rol = usu.rol_id
                                            WHERE usu.email = '$email_sesion' AND usu.estado = '1' ");
    $query_sesion->execute();

    $datos_sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos_sesion_usuarios as $datos_sesion_usuario){
        $nombre_sesion_usuario = $datos_sesion_usuario['email'];
        $id_rol_sesion_usuario = $datos_sesion_usuario['id_rol'];
        $rol_sesion_usuario = $datos_sesion_usuario['nombre_rol'];
        $nombres_sesion_usuario = $datos_sesion_usuario['nombres'];
    }




    $url = $_SERVER["PHP_SELF"];
    $conta = strlen($url);
    $rest = substr($url, 10, $conta);

    
    $sql_roles_permisos = "SELECT * FROM roles_permisos AS rolper
            INNER JOIN permisos AS per ON per.id_permiso = rolper.permiso_id
            INNER JOIN roles AS rol ON rol.id_rol = rolper.rol_id  ";
    $query_roles_permisos = $pdo->prepare($sql_roles_permisos);
    $query_roles_permisos->execute();
    $roles_permisos = $query_roles_permisos->fetchAll(PDO::FETCH_ASSOC);

    $contadorpermiso = 0;
    foreach($roles_permisos as $roles_permiso){
      if($id_rol_sesion_usuario == $roles_permiso['rol_id']){
          // echo $roles_permiso['url'];
          // echo "<br>";

          if($rest == $roles_permiso['url']){
            $contadorpermiso = $contadorpermiso + 1;
            //echo "Permiso Autorizado";
          }else{
            //echo "No Autorizado";
          }
      }
        
      // echo $roles_permiso['url'];
    }
    // if($contadorpermiso>0){
    //   echo "Ruta habilitada";
    // }else{
    //   echo "Ruta inhabilitada";
    // }
    

    
  //--------------------------------------------------------//
    

}else{
    echo "el usuario no paso por el login";
    header('Location:'.APP_URL."/login");
}
?>

<!DOCTYPE html>

<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=APP_NAME;?></title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= APP_URL;?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= APP_URL;?>/public/dist/css/adminlte.min.css">
  <!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=APP_URL;?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="<?=APP_URL;?>/admin" class="nav-link"><?=APP_NAME;?></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=APP_URL;?>/admin" class="brand-link">
      <img src="https://www.udenar.edu.co/recursos/wp-content/uploads/2021/09/logo-udenar-blanco.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">POSGRADOS</span>
    </a>   
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://cdn-icons-png.flaticon.com/512/6073/6073873.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$rol_sesion_usuario;?></a>
          <a href="#" class="d-block"><?=$nombres_sesion_usuario;?></a>
        </div>
      </div>

      <!-- Sección Roles -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php
          if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE')){?>

              <li class="nav-item">
                  <a href="#" class="nav-link nav-posgrados">
                      <i class="nav-icon fas"><i class="bi bi-card-text"></i></i>
                      <p>
                          Roles
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="<?=APP_URL;?>/admin/roles" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Listado de roles</p>
                          </a>
                      </li>
                  </ul>

                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="<?=APP_URL;?>/admin/roles/permisos.php" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Permisos</p>
                          </a>
                      </li>
                  </ul>
              </li>

          <?php
          }
          ?>

        </ul>
      </nav>
      <!------------------>
      <!-- Sección Usuarios -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
          if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE')){?>

                <li class="nav-item">
                  <a href="#" class="nav-link nav-posgrados">
                      <i class="nav-icon fas"><i class="bi bi-people-fill"></i></i>
                      <p>
                          Usuarios
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="<?=APP_URL;?>/admin/usuarios" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Listado de Usuarios</p>
                          </a>
                      </li>
                  </ul>
                </li>

          <?php
          }
          ?>

        </ul>
      </nav>
      <!-- Sección Usuarios -->
      <!-- Sección Posgrados -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
          if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE') 
            || ($rol_sesion_usuario=='COORDINADOR') || ($rol_sesion_usuario=='ASISTENTE')){?>

            <li class="nav-item">
                <a href="#" class="nav-link nav-posgrados">
                  <i class="nav-icon fas"><i class="bi bi-card-text"></i></i>
                  <p>
                    Posgrados
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?=APP_URL;?>/admin/programas" class="nav-link" style="color: #ffff;">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Programas Académicos</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>

        <?php
        }
        ?>
          
      </nav>
      <!-- Sección Coordinadores -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        



          <li class="nav-item">
            <a href="#" class="nav-link nav-coordinadores">
              <i class="nav-icon fas"><i class="bi bi-person-fill"></i></i>
              <p>
                Coordinadores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

            <?php
            if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE')){?>

                <li class="nav-item">
                  <a href="<?= APP_URL; ?>/admin/coordinadores" class="nav-link" style="color: #ffff;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Coordinadores</p>
                  </a>
                </li>

            <?php
            }
            ?>
              
              <li class="nav-item">
                <a href="<?= APP_URL; ?>/admin/asistente" class="nav-link" style="color: #ffff;">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Asistentes</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>

      <!-- Sección Docentes -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
          if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE') 
            || ($rol_sesion_usuario=='COORDINADOR') || ($rol_sesion_usuario=='ASISTENTE')){?>

            <li class="nav-item">
              <a href="#" class="nav-link nav-docentes">
                <i class="nav-icon fas"><i class="bi bi-person-lines-fill"></i></i>
                <p>
                  Docentes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=APP_URL;?>/admin/docentes" class="nav-link" style="color: #ffff;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Listado de Docentes</p>
                  </a>
                </li>
              </ul>
            </li>

        <?php
        }
        ?>

          
        </ul>
      </nav>
      <!-- Sección Cohorte -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
          if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE') 
            || ($rol_sesion_usuario=='COORDINADOR') || ($rol_sesion_usuario=='ASISTENTE')){?>

            <li class="nav-item">
              <a href="#" class="nav-link nav-cohorte">
                <i class="nav-icon fas"><i class="bi bi-person-fill"></i></i>
                <p>
                  Cohorte
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=APP_URL;?>/admin/cohortes" class="nav-link" style="color: #ffff;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Listado de Cohortes</p>
                  </a>
                </li>
              </ul>
            </li>

        <?php
        }
        ?>


          
        </ul>
      </nav>
      <!-- Sección Estudiantes -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php
          if(($rol_sesion_usuario=='ADMINISTRADOR') || ($rol_sesion_usuario=='PRESIDENTE') 
            || ($rol_sesion_usuario=='COORDINADOR') || ($rol_sesion_usuario=='ASISTENTE')){?>

            <li class="nav-item">
              <a href="#" class="nav-link nav-estudiantes">
                <i class="nav-icon fas"><i class="bi bi-person-fill"></i></i>
                <p>
                  Estudiantes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?=APP_URL;?>/admin/estudiantes" class="nav-link" style="color: #ffff;">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Listado de Estudiantes</p>
                  </a>
                </li>
              </ul>
            </li>

        <?php
        }
        ?>


          
        </ul>
      </nav>
      <!-- Cerrar Sesión -->
      <li class="nav-item">
        <a href="<?=APP_URL;?>/login/logout.php" class="nav-link nav-cerrar-sesion">
          <i class="nav-icon" style="margin-right: 0.7rem;"><i class="bi bi-door-open"></i></i>
          <p style="margin: 0; font-size: 0.875rem;">Cerrar Sesión</p>
        </a>
      </li>
    </div>
  </aside>

  <style>
    /* Custom styles for sidebar and navbar */
    .main-sidebar {
        background-color: #181818; /* Dark green background */
    }
    .main-sidebar .brand-link {
        background-color: #181818; /* Even darker green for brand link */
    }

    /* Estilos para el menú con gradiente y bordes redondeados */
    .nav-posgrados {
      background: linear-gradient(135deg, #00a64d 0%, #004b23 100%);
      border: none;
      border-radius: 25px;
      padding: 10px;
      color: #fff;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .nav-posgrados:hover {
      background: linear-gradient(135deg, #004b23 0%, #00a64d 100%);
      color: #fff;
    }

    .nav-coordinadores {
      background: linear-gradient(135deg, #00a64d 0%, #004b23 100%);
      border: none;
      border-radius: 25px;
      padding: 10px;
      color: #fff;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .nav-coordinadores:hover {
      background: linear-gradient(135deg, #004b23 0%, #00a64d 100%);
      color: #fff;
    }

    .nav-docentes {
      background: linear-gradient(135deg, #00a64d 0%, #004b23 100%);
      border: none;
      border-radius: 25px;
      padding: 10px;
      color: #fff;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .nav-docentes:hover {
      background: linear-gradient(135deg, #004b23 0%, #00a64d 100%);
      color: #fff;
    }

    .nav-cohorte {
      background: linear-gradient(135deg, #00a64d 0%, #004b23 100%);
      border: none;
      border-radius: 25px;
      padding: 10px;
      color: #fff;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .nav-cohorte:hover {
      background: linear-gradient(135deg, #004b23 0%, #00a64d 100%);
      color: #fff;
    }
    .nav-estudiantes {
      background: linear-gradient(135deg, #00a64d 0%, #004b23 100%);
      border: none;
      border-radius: 25px;
      padding: 10px;
      color: #fff;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    .nav-estudiantes:hover {
      background: linear-gradient(135deg, #004b23 0%, #00a64d 100%);
      color: #fff;
    }
  /* Estilos para el botón de "Cerrar Sesión" */
  .nav-cerrar-sesion {
    background-color: #e60000; /* Rojo sólido */
    border: none;
    border-radius: 25px;
    padding: 10px;
    color: #fff;
    font-weight: bold;
    display: flex;
    align-items: center;
    width: 100%;
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }

  .nav-cerrar-sesion:hover {
    background-color: #ff4d4d; /* Rojo más oscuro para el hover */
    color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  
  </style>
