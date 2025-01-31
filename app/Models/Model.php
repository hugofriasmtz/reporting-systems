<?php

namespace App\Models;

use App\Models\Database;

/**
 * Clase Model que extiende de Database para realizar operaciones específicas en la base de datos.
 */
class Model extends DataBase
{

    /**
     * Busca un usuario por nombre de usuario y estado activo.
     * @param string $username El nombre de usuario a buscar.
     * @return array|null Los datos del usuario si se encuentra, null en caso contrario.
     */
    public function SearchUser($username)
    {
        return $this->ConsultaPreparada("SELECT * FROM users WHERE username = ? AND status = ?", [$username, 'ACTIVE']);
    }

    /**
     * Encuentra un usuario por nombre de usuario.
     * @param string $username El nombre de usuario a buscar.
     * @return array|null Los datos del usuario si se encuentra, null en caso contrario.
     */
    public function FindUserByUsername($username)
    {
        $dato = $this->ConsultaPreparada("SELECT * FROM users WHERE username = ?", [ $username ] ); 
        return $dato;
    }

    /**
     * Inserta un nuevo usuario en la base de datos.
     * @param array $datos Los datos del usuario a insertar.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function InsertUserDataBase($datos)
    {
        $estado = $this->InsertarRegistrosPreparada("INSERT INTO users (username, password, role_id, status) VALUES (?,?,?,?)",$datos);
        return $estado;
    }

    /**
     * Añade un nuevo usuario con su perfil a la base de datos.
     * @param array $user Los datos del usuario a insertar.
     * @param array $profile Los datos del perfil del usuario.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function AddUser($user, $profile)
    {
        $request = $this->InsertarRegistrosPreparada("INSERT INTO users (role_id, email, password, first_names, last_names, status) VALUES (?,?,?,?,?,?)", $user);
        return $request;
    }
}