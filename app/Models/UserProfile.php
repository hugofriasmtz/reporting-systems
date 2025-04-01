<?php
namespace App\Models;

use App\Models\Database;

class UserProfile extends Database
{
    public function Add( $values ){
        $profileUser = $this->InsertPreparedAndReturnID("INSERT INTO user_profiles (names,last_names,gener,shift, user_id) VALUES (?,?,?,?,?)" , $values );
        return $profileUser;
    }

    public function UpdateUserProfile($newData){
        $resultado = $this->ModificarRegistrosPreparada("UPDATE user_profiles SET names = ?, last_names =?, gener = ? , shift = ?, modified = ? WHERE user_id = ?", $newData );
        return $resultado;
    }
    
    public function UserProfileById($id) {
        $values = $this->ConsultaPreparada("SELECT users.id,users.username, users.password,users.role_id,user_profiles.names, user_profiles.last_names, 
        user_profiles.gener, user_profiles.shift
        FROM users 
        INNER JOIN user_profiles ON users.id = user_profiles.user_id 
        WHERE users.id = ?", [$id]);
        return $values;
    }
}


?>