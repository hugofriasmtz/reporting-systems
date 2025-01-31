<?php
require_once __DIR__ . '../../../../autoload.php';

use App\Controllers\Administrator;
$controller = new Administrator();


if (isset($_POST['user_id'])) {
    $user = $controller->GetUser($_POST['user_id']);
    $genero = '';
    $shift = '';
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
                    <input type="hidden" name="update_user" value="'.$user['id'].'">
                    <input type="hidden" name="user_id" value="'.$user['id'].'">
                    
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="names">Nombre</label>
                                <input type="text" id="names" class="form-control" name="'.$user['names'].'">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="last_name">Apellidos</label>
                                <input type="text" id="last_names" class="form-control" name="'.$user['last_names'].'">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" class=" form-control" name="'.$user['username'].'">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" id="password" class="form-control" name="'.$user['password'].'">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="gener">Genero</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="gener" id="inputGroupSelect01">
                                        <option selected>Seleccionar...</option>
                                        '.$genero.'
                                    </select>
                                    <label class="input-group-text" for="inputGroupSelect01">Generos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="user_rol">Cargo</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="user_rol" id="inputGroupSelect01">
                                        <option selected>Seleccionar...</option>
                                        <option value="2">Encargado</option>
                                        <option value="3">Colaborador</option>
                                    </select>
                                    <label class="input-group-text" for="inputGroupSelect01">Cargos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="shift">Turno</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="shift" id="inputGroupSelect01">
                                        '.$shift.'
                                    </select>
                                    <label class="input-group-text" for="inputGroupSelect01">Turnos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">Registrar</button>
                    </div>
                </form> ';

        echo $payload;
    } 
}
?>
