<?php 
namespace App\Controllers;
use App\Models\Users;
use App\Models\UserProfile;
use App\Models\Reports;
use App\Helpers\Helpers;
use App\Helpers\Alerts;
use App\Helpers\UserAttributes; 
use \DateTime;

class GenerateReports {

    private $_users;
    private $_user_profile;
    private $_reports;
    private $_helper;
    private $_user_attributes;
    private $_alerts;
    private $_dataTime;

    function __construct()
    {
        $this->_users = new Users();
        $this->_user_profile = new UserProfile();
        $this->_reports = new Reports();
        $this->_helper = new Helpers();
        $this->_user_attributes = new UserAttributes();
        $this->_alerts = new Alerts();
        $this->_dataTime = new DateTime();
    }
    private function GetCurrentDateTime(){
        $this->_dataTime->setTimezone(new \DateTimeZone('America/Mexico_City'));
        return $this->_dataTime->format('Y-m-d H:i:s');
    }

    public function DepartamentSelect()
    {
        $options = '';
        $departaments = $this->_reports->FindDepartmament();

        foreach ($departaments as $key  =>  $departament) {
            $options .= '<option value="' . $departament['id'] . '">' . $departament['Full_Name'] . '</option>';
            
        }
        return '<select class="form-select"  form-control-user" id="departments" name="departament_id" onchange="selectDepartament()" required>
                    <option selected disabled value="0">Selecciona el Colaborador</option>
                    ' . $options . '
                </select>';
    }

    public function CreateReport($user_id)
    {
        $alert = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];

        if (isset($_POST['generate_report'])) {

            $response = $this->_helper->validatePost(['issueType','location', 'description','priority']);
            
            if ($response['valid']) {
                $reports_value = [$user_id,$_POST['issueType'], $_POST['description'],'PENDING', $_POST['location'], $_POST['priority']];
                $reports = $this->_reports->AddReport($reports_value);

                if ($reports) {
                    $alert['title'] = 'Reporte Generado';
                    $alert['body'] = 'El reporte ha sido generado con exito';
                    $alert['type'] = 'success';
                    $alert['location'] = '/admin/reports';
                } else {
                    $alert['title'] = 'Error al generar el reporte';
                    $alert['body'] = 'No se pudo generar el reporte, intente nuevamente';
                    $alert['type'] = 'error';
                }
            }else {
                $alert['title'] = 'Error al generar el reporte';
                $alert['body'] = 'Por favor completa todos los campos';
                $alert['type'] = 'error';
            }

            $this->_alerts->showAlert($alert);

        }

    }

}



?>