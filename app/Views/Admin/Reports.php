<?php
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Authentication;
use App\Controllers\GenerateReports;
use App\Controllers\Structure;

$auth      = new Authentication();
$reports   = new GenerateReports();
$structure = new Structure();

$reports->CreateReport();
$reports->ProgreesReports();

if (!$auth->IsAuth()) {
    header('location:../Home/auth-login.php');
}

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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
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
                            <h3>Reportes📄</h3>
                            <p class="text-subtitle text-muted">Explora y analiza los datos clave para tomar decisiones informadas y estratégicas</p>
                        </div>
                        <?php echo $structure->PagesTitle('Reportes'); ?>
                    </div>
                </div>
                <section id="content-types">
                    <div class="row">
                        <div class="col-xl-8 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">

                                    <table class='table table-striped' id="table1">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Prioridad</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php echo $reports->DataTableReports(); ?>
                                        </tbody>
                                        <div class="modal fade text-left" id="updateProgress" tabindex="-1" role="dialog" aria-labelledby="updateProgressLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-dark white">
                                                        <span class="modal-title" id="updateProgressLabel">En Proceso</span>
                                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="update_progress">
                                                        <!-- El contenido del modal se cargará aquí -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade text-left" id="FinishReport" tabindex="-1" role="dialog" aria-labelledby="FinishReportLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="FinishReportLabel">Marcar como Terminado</h5>
                                                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" id="Finish_report">
                                                        <!-- El contenido del modal se cargará aquí dinámicamente -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-4 col-md-2 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h1 class="card-title pl-1">Nivel de Importancia del Reporte</h1>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="badge bg-danger rounded-pill me-3" style="width: 20px; height: 20px;">&nbsp;</span>
                                                <span><strong>Alta:</strong> Este nivel indica que el reporte requiere atención inmediata debido a su criticidad.</span>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="badge bg-warning rounded-pill me-3" style="width: 20px; height: 20px;">&nbsp;</span>
                                                <span><strong>Media:</strong> Este nivel indica que el reporte es importante pero no requiere atención inmediata.</span>
                                            </li>
                                            <li class="list-group-item d-flex align-items-center">
                                                <span class="badge bg-success rounded-pill me-3" style="width: 20px; height: 20px;">&nbsp;</span>
                                                <span><strong>Baja:</strong> Este nivel indica que el reporte es informativo y no requiere acción urgente.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <h4 class="card-title">Reportar un Imperfecto</h4>
                                        <p class="card-text">
                                            Por favor, completa los detalles para reportar un imperfecto.
                                        </p>
                                        <form class="form" method="post">
                                            <div class="form-body">
                                                <input type="hidden" name="generate_report">
                                                <!-- Campo para el área de trabajo -->
                                                <fieldset class="form-group">
                                                    <label for="userArea">Colaborador</label>
                                                    <?php echo $reports->SelectUserById(); ?>
                                                </fieldset>
                                                <!-- Campo para el tipo de imperfecto -->
                                                <fieldset class="form-group">
                                                    <label for="issueType">Tipo de Imperfecto</label>
                                                    <select class="form-select" id="issueType" name="issueType">
                                                        <option value="maintenance">Mantenimiento</option>
                                                        <option value="cleaning">Limpieza</option>
                                                        <option value="system">Sistemas</option>
                                                    </select>
                                                </fieldset>
                                                <!-- Campo para la ubicación -->
                                                <div class="form-group">
                                                    <label for="location">Ubicación del imperfecto </label>
                                                    <input type="text" id="location" class="form-control" name="location" placeholder="Ejemplo: Habitación 101, Pasillo 3">
                                                </div>
                                                <!-- Campo para la descripción -->
                                                <div class="form-group">
                                                    <label for="description">Descripción</label>
                                                    <textarea id="description" class="form-control" name="description" rows="4" placeholder="Describe el imperfecto con detalle"></textarea>
                                                </div>
                                                <!-- Campo para la prioridad -->
                                                <div class="form-group">
                                                    <label for="priority">Prioridad</label>
                                                    <select class="form-select" id="priority" name="priority" class="form-control">
                                                        <option value="high">Alta</option>
                                                        <option value="medium">Media</option>
                                                        <option value="low">Baja</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-actions d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1">Reportar</button>
                                                <button type="reset" class="btn btn-light-primary">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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

    <script type="text/javascript">
        $(document).on("click", "#updateReport", function() {
            var report_id = $(this).data('id'); // Obtener el ID del reporte
            $.ajax({
                url: '../Modals/progress_report.php', // Ruta al archivo PHP
                type: 'POST',
                data: {
                    report_id: report_id // Enviar el ID del reporte
                },
                success: function(data) {
                    $("#update_progress").html(data); // Cargar el contenido en el modal
                    $('#updateProgress').modal('show');
                }
            })
        });

        $(document).on("click", "#FinishReport", function() {
            var report_id = $(this).data('id');
            $.ajax({
                url: '../Modals/finish_report.php',
                type: 'POST',
                data: {
                    report_id: report_id
                },
                success: function(data) {
                    $("#Finish_report").html(data);
                    $('#FinishReport').modal('show');
                }
            })
        });
    </script>
</body>

</html>