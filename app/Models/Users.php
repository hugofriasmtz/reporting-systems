<?php
namespace App\Models;
use App\Models\Database;

class Users extends Database
{
    public function Add( $values ){
        $id = $this->InsertPreparedAndReturnID("INSERT INTO users ( username , password , departament_id, role_id , status) VALUES (?,?,?,?,?)" , $values );
        return $id;
    }

    public function GetUsersByDepartament( $role_id, $departament_id ){
        $values = [$role_id, $departament_id];
        $request = $this->ConsultaPreparada("SELECT user_profiles.names AS name, user_profiles.last_names AS last_name, user_profiles.gener AS gener, departaments.names AS 
        departament, user_profiles.shift AS shift, 
        roles.names AS rNames , users.status AS status, users.created AS created 
        FROM users 
        INNER JOIN user_profiles ON users.id = user_profiles.id 
        LEFT JOIN departaments ON users.departament_id = departaments.id 
        LEFT JOIN roles ON users.role_id = roles.id 
        WHERE users.role_id = ?  AND users.departament_id= ?", $values); 
        return $request;
    }

    public function UserById($id) {
        $values = $this->ConsultaPreparada("SELECT * FROM users WHERE id = ?", [$id]);
        return $values;
    }
    
}
?>