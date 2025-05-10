<?php
namespace App\Models;
use App\Models\Database;

class UserDepartament extends Database
{
    public function Add( $values ){
        $departamentUser = $this->InsertPreparedAndReturnID("INSERT INTO user_departament ( user_id , departament_id) VALUES (?,?)" , $values );
        return $departamentUser;
    }
}

?>