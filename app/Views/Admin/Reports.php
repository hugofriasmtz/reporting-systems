<?php
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Authentication;
use App\Controllers\Administrator;
use App\Controllers\Structure;

$auth      = new Authentication();
$admin     = new Administrator();
$structure = new Structure();

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
</head>

<body>
    <div id="app">
        <div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="../../../assets/images/logo.svg" alt="" srcset="">
                </div>
                <?php echo $structure->Navbar('Reportes'); ?>
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
                            <h3>Input Group</h3>
                            <p class="text-subtitle text-muted">A group for input to display information in before or after input</p>
                        </div>
                        <?php echo $structure->PagesTitle('Reportes'); ?>
                    </div>


                </div>
                

            </div>

        </div>
    </div>
    <script src="../../../assets/js/feather-icons/feather.min.js"></script>
    <script src="../../../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/app.js"></script>

    <script src="../../../assets/js/main.js"></script>
</body>

</html>