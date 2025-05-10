<?php
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Authentication;
use App\Controllers\Administrator;
use App\Controllers\Structure;

$auth      = new Authentication();
$admin     = new Administrator();
$structure = new Structure();
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
    <title>Holyday Inn - Personal</title>

    <link rel="stylesheet" href="../../../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../../../assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="../../../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../../../assets/css/app.css">
    <link rel="shortcut icon" href="../../../assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="../../../assets/images/logo.svg" alt="" srcset="">
                </div>
                <?php echo $structure->Navbar('Personal'); ?>
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
                            <h3>Personal</h3>
                            <p class="text-subtitle text-muted">Cada miembro aporta un talento único y juntos, no hay desafío que no podamos superar</p>
                        </div>
                        <?php echo $structure->PagesTitle('Personal'); ?>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                            <table class='table table-striped' id="table1">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Puesto</th>
                                        <th>Area</th>
                                        <th>Turno</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo $admin->DataTableAllUsers(); ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="../../../assets/js/feather-icons/feather.min.js"></script>
    <script src="../../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/app.js"></script>

    <script src="../../../assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="../../../assets/js/vendors.js"></script>

    <script src="../../../assets/js/main.js"></script>
</body>

</html>