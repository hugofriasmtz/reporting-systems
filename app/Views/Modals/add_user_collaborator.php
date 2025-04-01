<div class="modal fade text-left" id="Add-collaborator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h4 class="modal-title white" id="myModalLabel17">Registrar Colaborar </h4>
                <button type="button" class="close black" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="form">
                    <input type="hidden" name="user_departament" value="2">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="names">Nombre</label>
                                <input type="text" id="names" class="form-control" name="names">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="last_name">Apellidos</label>
                                <input type="text" id="last_names" class="form-control" name="last_names">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" id="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="gener">Genero</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="gener" id="Groupgener">
                                        <option selected>Seleccionar...</option>
                                        <option value="Man">Hombre</option>
                                        <option value="WOMAN">Mujer</option>
                                    </select>
                                    <label class="input-group-text" for="Groupgener">Generos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="user_rol">Cargo</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="user_rol" id="Groupuser_rol">
                                        <option selected>Seleccionar...</option>
                                        <option value="2">Encargado</option>
                                        <option value="3">Colaborador</option>
                                    </select>
                                    <label class="input-group-text" for="Groupuser_id">Cargos</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="shift">Turno</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="shift" id="Groupshift">
                                        <option selected>Seleccionar...</option>
                                        <option value="MORNING">Mañana</option>
                                        <option value="AFTERNOON">Tarde</option>
                                        <option value="NIGHT">Noche</option>
                                    </select>
                                    <label class="input-group-text" for="Groupshift">Turnos</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success me-1 mb-1">Registrar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>