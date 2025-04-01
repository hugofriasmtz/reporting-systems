<?php
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Administrator;
$controller = new Administrator();


if (isset($_POST['user_id'])) {
    $user = $controller->GetUser($_POST['user_id']);
    $genero = '';
    $shift = '';
    $role = '';
    if ($user["shift"] === 'MORNING') {
        $shift .= '<option value="MORNING" selected> Mañana </option>';
        $shift .= '<option value="AFTERNOON"> Tarde </option>';
        $shift .= '<option value="NIGHT"> Noche </option>';
    } elseif ($user["shift"] === 'AFTERNOON') {
        $shift .= '<option value="MORNING"> Mañana </option>';
        $shift .= '<option value="AFTERNOON" selected> Tarde </option>';
        $shift .= '<option value="NIGHT"> Noche </option>';
    } else {
        $shift .= '<option value="MORNING"> Mañana </option>';
        $shift .= '<option value="AFTERNOON"> Tarde </option>';
        $shift .= '<option value="NIGHT" selected> Noche </option>';
    }

    if ($user["role_id"] === '2') {
        $role .= '<option value="2" selected> Encargado </option>';
        $role .= '<option value="3"> Colaborador </option>';
    } else {
        $role .= '<option value="2"> Encargado </option>';
        $role .= '<option value="3" selected> Colaborador </option>';
    }

    if ($user["gener"] === 'MAN') {
        $genero .= '<option value="MAN" selected> Hombre </option>';
        $genero .= '<option value="WOMAN"> Mujer </option>';
    } else {
        $genero .= '<option value="MAN" > Hombre </option>';
        $genero .= '<option value="WOMAN" selected> Mujer </option>';
    }

    if (!is_null($user)) {
        $payload = '  
       <form method="POST" class="form">
                    <div class="row">
                    <input type="hidden" name="update_user" value="'.$user['id'].'">
                    <input type="hidden" name="user_id" value="'.$user['id'].'">    
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="names">Nombre</label>
                                <input type="text" id="names" class="form-control" name="names" value="'.$user['names'].'">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="last_name">Apellidos</label>
                                <input type="text" id="last_names" class="form-control" name="last_names" value="'.$user['last_names'].'">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="gener">Genero</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="gener" id="UpdateGroupGener">
                                        <option selected>Seleccionar...</option>
                                        '.$genero.'
                                    </select>
                                    <label class="input-group-text" for="UpdateGroupGener">Generos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="user_rol">Cargo</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="user_rol" id="UpdateGrouprRol">
                                        <option selected>Seleccionar...</option>
                                        '.$role.'
                                    </select>
                                    <label class="input-group-text" for="UpdateGrouprRol">Cargos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="shift">Turno</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="shift" id="UpdateGrouprShift">
                                        <option selected>Seleccionar...</option>
                                        '.$shift.'
                                    </select>
                                    <label class="input-group-text" for="UpdateGrouprRol">Turnos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">Actualizar</button>
                    </div>
                </form> ';

        echo $payload;
    } 
}
?>
