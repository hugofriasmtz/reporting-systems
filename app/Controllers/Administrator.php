<?php

namespace App\Controllers;

use App\Models\Users;
use App\Models\UserProfile;
use App\Helpers\Helpers;
use App\Helpers\Alerts;
use App\Helpers\UserAttributes;
use \DateTime;


class Administrator
{
    private $_users;
    private $_user_profile;
    private $_helper;
    private $_alerts;
    private $_dataTime;

    function __construct()
    {
        $this->_users = new Users();
        $this->_user_profile = new UserProfile();
        $this->_helper = new Helpers();
        $this->_alerts = new Alerts();
        $this->_dataTime = new DateTime();
    }

    private function getCurrentDateTime(){
        $this->_dataTime->setTimezone(new \DateTimeZone('America/Mexico_City'));
        return $this->_dataTime->format('Y-m-d H:i:s');
    }

    Public function TableUsersByDepartament($role_id, $departament_id){
        $table  = '';
        
        $users  = $this->_users->GetUsersByDepartament($role_id, $departament_id);
        foreach ($users as $user) {

            $gener       = UserAttributes::getGenderLabel($user['gener']);
            $shift       = $user['shift'] == 'MORNING' ? 'Mañana' : 'Tarde';
            $shift = UserAttributes::getShiftLabel($user['shift']);
            $statusDetails = UserAttributes::getStatusDetails($user['status']);

            $table .= '
                <tr>
                    <td class="text-bold-500">'.$user['name'].'</td>
                    <td>'.$user['last_name'].'</td>
                    <td class="text-bold-500">'.$gener.'</td>
                    <td>'.$shift.'</td>
                    <td><span class="badge bg-'.$statusDetails['class'].'">'.$statusDetails['label'].'</span></td>
                    <td>
                        <div class="btn-group mb-2 btn-group-sm" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-warning" data-id="'.$user['id'].'" id="updateAction" ><i data-feather="edit-2"></i></button>
                            <button type="button" class="btn btn-danger" data-id="'.$user['id'].'" data-bs-toggle="modal" data-bs-target="#Add-collaborator"><i data-feather="trash"></i></button>
                        </div>
                    </td>
                </tr>
            ';
        }
        return $table;
    }

    public function DataTableAllUsers() {
        $dataTables = '';
        $dataUsers = $this->_users->AllDataUsers();
        foreach ($dataUsers as $user) {
            $rol = UserAttributes::getRolDetails($user['Rol']);
            $departament = UserAttributes::GetDepartamentDetails($user['Departaments']);
            $shift = UserAttributes::getShiftLabel($user['shift']);
            $statusDetails = UserAttributes::getStatusDetails($user['status']);
            $dataTables .= '
                <tr>
                    <td>'.$user['Name'].'</td>
                    <td>'.$user['Last_names'].'</td>
                    <td>'.$rol.'</td>
                    <td>
                        <span class="badge bg-'.$departament['class'].'">'.$departament['label'].'</span>
                    </td>
                    <td>'.$shift.'</td>
                    <td>
                        <span class="badge bg-'.$statusDetails['class'].'">'.$statusDetails['label'].'</span>
                    </td>
                </tr>
            ';
        }
        return $dataTables;

    }

    public function AddCollaborator()
    {
        $alert = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];

        if (isset($_POST['user_departament'])) {

            $response = $this->_helper->validatePost(["user_departament", "user_rol", "username", "password", "names", "last_names", "gener", "shift"]);

            if ($response['valid']) {

                $password       = password_hash($_POST['password'], PASSWORD_ARGON2I);
                $user_values    = [$_POST['username'], $password, $_POST['user_departament'], $_POST['user_rol'], 'ACTIVE'];
                $user_id        = $this->_users->Add($user_values);

                if (is_int((int)$user_id)) {
                    $profile_values = [$_POST['names'], $_POST['last_names'], $_POST['gener'], $_POST["shift"], $user_id];
                    $profile = $this->_user_profile->Add($profile_values);
                    if (is_int((int)$profile)) {
                        if ($profile == true) {
                            $alert['title']     = 'Alta exitosa';
                            $alert['body']      = 'El registro del colaborador fue correcto';
                            $alert['type']      = 'success';
                        } else {
                            $alert['title']     = 'Error en el registro';
                            $alert['body']      = 'No se logro registrar el colaborador correctamente';
                            $alert['type']      = 'error';
                            $alert['location']  = '';
                        }
                    } else {
                        $alert['title']     = 'Error en el registro';
                        $alert['body']      = 'No se logro registrar el colaborador correctamente';
                        $alert['type']      = 'error';
                        $alert['location']  = '';
                    }
                } else {
                    $alert['title']     = 'Error en el registro';
                    $alert['body']      = 'No se logro registrar el colaborador correctamente';
                    $alert['type']      = 'error';
                    $alert['location']  = '';
                }
            } else {

                $body = "";
                foreach ($response['missing'] as $key => $missing) {
                    switch($missing) {
                        case 'username': $missing = 'Username';break;
                        case 'password': $missing = 'Contraseña'; break;
                        case 'names': $missing = 'Nombre'; break;
                        case 'last_names':$missing = 'Apellidos'; break;
                        case 'gener': $missing = 'Genero'; break;
                        case 'user_rol': $missing = 'Puesto';break;
                        case 'shift': $missing = 'Turno'; break;
                    }
                    $body .= $missing . ', ';
                }

                $alert['title']     = 'Faltan campos por llenar en el formulario';
                $alert['body']      = $body;
                $alert['type']      = 'warning';
                $alert['location']  = '';

                
            }
            $this->_alerts->showAlert($alert);
        }
    }

    public function UpdateCollaborator (){
        $alert      = ['title' => '', 'body' => "", "type" => '', 'location' => ''];

        if (isset($_POST['update_user']) && isset($_POST['user_id'])) {
            $date = $this->getCurrentDateTime();
            $updateDataProfile = [$_POST['names'], $_POST['last_names'], $_POST['gener'], $_POST['shift'], $date, $_POST['user_id']];
            $resultProfileUpdate = $this->_user_profile->UpdateUserProfile($updateDataProfile);
            if ($resultProfileUpdate == true) {
                $alert['title']     = 'Felicidades';
                $alert['body']      = "La informacion fue actualizada con exito";
                $alert['type']      = "success";
                $alert['location']  = "Kitchen.php";
            } else {
                $alert['title'] = 'ERROR';
                $alert['body']  = "Intente Actualizar los datos más tarde";
                $alert['type']  = "error";
            }

            $this->_alerts->showAlert($alert);
        }
    }  

    public function DeleteCollaborator (){

        $this->_alerts->DeleteAlert();

    }
    public function GetUser( $id ) {
        
        $user = $this->_user_profile->UserProfileById( $id );
        if ( !empty( $user ) ) {
            return $user[0];
        }
        return null;
    }

    
}
