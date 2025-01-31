<?php
namespace App\Models;

use App\Models\Database;

class UserProfile extends Database
{
    public function Add( $values ){
        $profileUser = $this->InsertPreparedAndReturnID("INSERT INTO user_profiles (names,last_names,gener,shift, user_id) VALUES (?,?,?,?,?)" , $values );
        return $profileUser;
    }
}


?>