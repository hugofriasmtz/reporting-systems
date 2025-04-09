<?php
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Authentication;
use App\Controllers\Administrator;
use App\Controllers\Structure;

$auth      = new Authentication();
$admin     = new Administrator();
$structure = new Structure();
$user      = $auth->AuthUser();
$admin->AddCollaborator();
$admin->UpdateCollaborator();
$admin->DeleteCollaborator();

if (!$auth->IsAuth()) {
    header('location:../Home/auth-login.php');
}

$authn_user   = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Group - Voler Admin Dashboard</title>

    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../../assets/css/app.css">
    <link rel="shortcut icon" href="../../../assets/images/favicon.svg" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="../../../assets/images/logo.svg" alt="" srcset="">
                </div>
                <?php echo $structure->Navbar('Áreas Públicas'); ?>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <?php echo $structure->Topbar(); ?>
            </nav>
            <div class="main-content container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Colaboradores de Áreas Públicas. 🏙️</h3>
                            <p class="text-subtitle text-muted">¿Quiénes integran el equipo de Áreas Públicas?</p>
                        </div>
                        <?php echo $structure->PagesTitle('Áreas Públicas'); ?>
                    </div>
                    <!-- Hoverable rows start -->
                    <div class="row" id="table-hover-row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Lista de Colaboradores de Áreas Públicas </h4>
                                    <div class="form-actions d-flex justify-content-end">
                                        <button type="button" class="btn icon icon-left btn-success open-modal" data-department="9" data-bs-toggle="modal" data-bs-target="#Add-collaborator">
                                            <i data-feather="user-plus"></i> Agregar
                                        </button>
                                        <?php include_once '../Modals/add_user_collaborator.php' ?>
                                    </div>

                                </div>
                                <div class="card-content">
                                    <!-- table hover -->
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Genero</th>
                                                    <th>Turno</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo $admin->TableUsersByDepartament(3, 9); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Hoverable rows end -->
                    <!-- Modal Edit -->
                    <div class="modal fade text-left" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="updateUserLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <h4 class="modal-title white" id="updateUserLabel">Actualizar Colaborador </h4>
                                    <button type="button" class="close black" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body" id="update_user">

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit end -->
                </div>

            </div>

        </div>
    </div>
    <script src="../../../assets/js/feather-icons/feather.min.js"></script>
    <script src="../../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/app.js"></script>
    <script src="../../../assets/js/main.js"></script>

    <script type="text/javascript">
        // Actualizar dinámicamente el valor del departamento en el modal para Áreas Públicas
        $(document).on("click", ".open-modal", function() {
            var department = $(this).data("department"); // Obtener el valor del departamento del botón
            $("#user_departament").val(department); // Actualizar el valor del campo oculto en el modal
        });
        $(document).on("click", "#updateAction", function() {
            var user_id = $(this).data('id');
            $.ajax({
                url: '../Modals/update_user_collaborator.php',
                type: 'POST',
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    $("#update_user").html(data);
                    $('#updateUser').modal('show');
                }
            })
        });

        $(document).on("click", ".deletedUser", function() {
            var user_id = $(this).data('id');
            $.ajax({
                url: 'modals/deleted-user.php',
                type: 'POST',
                data: {
                    user_id: user_id
                },
                success: function(data) {
                    $("#deleted_user").html(data);
                    $('#deletedUser').modal('show');
                }
            })
        });
    </script>
</body>

</html>