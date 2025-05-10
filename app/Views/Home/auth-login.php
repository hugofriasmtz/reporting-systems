<?php

/**
 * Este script maneja el proceso de autenticación para la página de inicio de sesión.
 * 
 * Incluye el archivo autoload para cargar las clases necesarias y utiliza el 
 * controlador de Autenticación para gestionar la autenticación del usuario.
 * 
 * @archivo holyDay_Reports/app/Views/Home/auth-login.php
 * 
 * @requiere holyDay_Reports/autoload.php
 * 
 * @usa \App\Controllers\Authentication
 * 
 * @var \App\Controllers\Authentication $auth_controller Instancia del controlador de Autenticación.
 * @var mixed $user La información del usuario autenticado.
 * 
 * El script realiza las siguientes acciones:
 * - Crea una instancia del controlador de Autenticación.
 * - Autentica al usuario.
 * - Verifica si el usuario está autenticado.
 * - Redirige al usuario si está autenticado.
 */
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Authentication;

$auth_controller    = new Authentication();
$user               = $auth_controller->AuthUser();
if ($auth_controller->IsAuth()) {
    $auth_controller->Redirect();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Holyday Inn</title>
    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">

    <link rel="shortcut icon" href="../../../assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="../../../assets/images/favicon.svg" height="48" class='mb-4'>
                                <h3>Iniciar sesión</h3>
                                <p>Inicie sesión para continuar.</p>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="is_login" value="true" />
                                <div class="form-group position-relative has-icon-left">
                                    <label for="username">Username</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control"  name="username">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <div class="clearfix">
                                        <label for="password">Contraseña</label>

                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control"  name="password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="clearfix d-grid gap-2 col-6 mx-auto">
                                    <button type="submit" class="btn btn-lg btn-success float-end">Iniciar sesión</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script src="../../../assets/js/feather-icons/feather.min.js"></script>
    <script src="../../../assets/js/app.js"></script>

    <script src="../../../assets/js/main.js"></script>
</body>

</html>