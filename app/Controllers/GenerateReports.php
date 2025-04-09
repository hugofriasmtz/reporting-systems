<?php

namespace App\Controllers;

use App\Models\Reports;
use App\Helpers\Helpers;
use App\Helpers\Alerts;
use App\Helpers\UserAttributes;

class GenerateReports
{
    private $_reports;
    private $_helper;
    private $_alerts;
    
    function __construct()
    {
        $this->_reports = new Reports();
        $this->_helper = new Helpers();
        $this->_alerts = new Alerts();
    }

    public function SelectUserById()
    {
        $options = '';
        $departaments = $this->_reports->FindId();

        foreach ($departaments as $key  =>  $departament) {
            $departName = UserAttributes::GetDepartamentDetails($departament['department']);
            $options .= '<option value="' . $departament['id'] . '">' . $departament['Full_Name'] . ' - ' . $departName['label']  . '</option>';
        }
        return '<select class="form-select"  form-control-user" id="departments" name="departament_id" onchange="selectDepartament()" required>
                    <option selected disabled value="0">Selecciona el Colaborador</option>
                    ' . $options . '
                </select>';
    }

    public function CreateReport()
    {
        $alert = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];

        if (isset($_POST['generate_report'])) {

            $response = $this->_helper->validatePost(['issueType', 'location', 'description', 'priority']);

            if ($response['valid']) {

                $reports_value = [$_POST['departament_id'], $_POST['issueType'], $_POST['description'], 'PENDING', $_POST['location'], $_POST['priority']];
                $reports = $this->_reports->AddReport($reports_value);
                if ($reports == true) {
                    $alert['title'] = 'Reporte Generado';
                    $alert['body'] = 'El reporte ha sido generado con éxito';
                    $alert['type'] = 'success';
                    $alert['location'] = '';
                } else {
                    $alert['title'] = 'Error al generar el reporte';
                    $alert['body'] = 'No se pudo generar el reporte, intente nuevamente';
                    $alert['type'] = 'error';
                }
            } else {
                $body = "";
                foreach ($response['missing'] as $key => $missing) {
                    switch ($missing) {
                        case 'issueType':
                            $missing = 'Tipo de Problema';
                            break;
                        case 'location':
                            $missing = 'Ubicación';
                            break;
                        case 'description':
                            $missing = 'Descripción';
                            break;
                        case 'priority':
                            $missing = 'Prioridad';
                            break;
                    }
                    $body .= $missing . ', ';
                }

                $alert['title'] = 'Faltan campos por llenar en el formulario';
                $alert['body'] = rtrim($body, ', ');
                $alert['type'] = 'warning';
                $alert['location'] = '';
            }

            $this->_alerts->showAlert($alert);
        }
    }

    public function DataTableReports()
    {
        $table = '';
        $reports = $this->_reports->GetReports();
        foreach ($reports as $key => $report) {
            $issue = UserAttributes::GetIssuetypesDetails($report['issuetype']);
            $status = UserAttributes::GetStatusDetails($report['status']);
            $preority = UserAttributes::GetStatusDetails($report['priority']);
            $formattedDate = UserAttributes::FormatDate($report['created'],  'd/m/Y', 'America/Mexico_City');

            $table .= '
                    <tr>
                        <td class="text-bold-500">' . $report['FullName'] . '</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-' . $key . '">
                                <i data-feather="info" width="20"></i>
                            </button>
                        </td>
                        <td><span class="badge bg-' . $preority['class'] . '">' . $preority['label'] . '</span></td>
                        <td><span class="badge bg-' . $status['class'] . '">' . $status['label'] . '</span></td>
                        <td>
                            <div class="btn-group mb-2 btn-group-sm" role="group" aria-label="Basic example">
                                <button type="button" data-id="' . $report['id'] . '" class="btn btn-dark" id="updateReport" title="En Proceso">
                                    <i data-feather="loader" width="20"></i>
                                </button>
                                <button type="button" data-id="' . $report['id'] . '" class="btn btn-success" id="FinishReport" title="Terminado">
                                    <i data-feather="check-circle" width="20"></i>
                                </button>
                            </div>
                        </td>
                    </tr>';

            $table .= '
                <div class="modal fade text-left" id="modal-' . $key . '" tabindex="-1" role="dialog"
                    aria-labelledby="modalLabel-' . $key . '" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title white" id="modalLabel-' . $key . '">
                                    Detalles del Reporte
                                </h5>
                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <strong><i data-feather="clipboard" width="20"></i> Tipo de Reporte:</strong> ' . $issue . '
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i data-feather="message-circle" width="20"></i> Descripción:</strong> ' . $report['description'] . '
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i data-feather="map-pin" width="20"></i> Ubicación:</strong> ' . $report['location'] . '
                                    </li>
                                    <li class="list-group-item">
                                        <strong><i data-feather="calendar" width="20"></i> Fecha:</strong> ' . $formattedDate . '
                                    </li>
                                    <li class="list-group-item">
                                        <div class="progress progress-'.$status['color'].' mb-4">
                                            <div class="progress-bar" role="progressbar" style="width: '.$status['porcentage'].'" aria-valuenow="25" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                                
                            </div>

                        </div>
                    </div>
                </div>';
        }
        return $table;
    }

    public function ProgreesReports()
    {
        $alert = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];

        if (isset($_POST['report_id']) && isset($_POST['status'])) {
            $date = UserAttributes::FormatDate('now'); // Fecha actual
            $status = $_POST['status']; // Estado dinámico enviado desde el formulario
            $reportId = $_POST['report_id'];
    
            // Valores para actualizar en la base de datos
            $updateValues = [$date, $status, $reportId];
    
            // Llamar al modelo para actualizar el reporte
            $updated = $this->_reports->UpdateReport($updateValues);
            if ($updated == true) {
                $alert['title']     = 'Felicidades';
                $alert['body']      = "El Reporte fue actualizada con exito";
                $alert['type']      = "success";
                $alert['location']  = "";
            } else {
                $alert['title'] = 'ERROR';
                $alert['body']  = "Intente Actualizar el progreso más tarde";
                $alert['type']  = "error";
            }

            $this->_alerts->showAlert($alert);
        }
    }
  


    public function GetReports($report_id)
    {
        $report = $this->_reports->GetReportsById($report_id);
        if(!empty($report)){
            return $report[0];
        }
        return null;
    }


}
