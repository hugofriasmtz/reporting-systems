<?php
include_once __DIR__ . '../../../../autoload.php';
use App\Controllers\GenerateReports;

$GenerateReports = new GenerateReports();

if (isset($_POST['report_id'])) {
    $report = $GenerateReports->GetReports($_POST['report_id']); // Obtener el reporte por ID

    if (!is_null($report)) {
        $fullName = trim($report['FullName']); // Nombre completo del reporte
        $payload = '
        <form method="POST" class="form">
            <div class="card-body">
                <div class="row">
                    <div>
                        <input type="hidden" name="report_id" value="' . $report['id'] . '">
                        <input type="hidden" name="status" value="IN_PROGRESS">
                        <div class="container">
                            <h4 class="display-8">El reporte de ' . $fullName . '</h4>
                            <h5 class="text-primary">Será marcado como "En Proceso".</h5>
                        </div>
                    </div>
                    <div class="p-2 d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Confirmar</button>
                    </div>
                </div>
            </div>
        </form>
        ';

        echo $payload;
    } else {
        echo "No se encontró el reporte.";
    }
} else {
    echo "ID del reporte no proporcionado.";
}
?>