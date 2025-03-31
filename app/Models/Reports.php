<?php
namespace App\Models;
use App\Models\Database;

class Reports extends Database
{
    public function FindDepartmament () {
        $data = $this->ConsultaNormal('SELECT users.id, CONCAT_WS(" ",departaments.names, " - ", user_profiles.names, user_profiles.last_names) AS Full_Name
        FROM users
        INNER JOIN user_profiles ON users.id = user_profiles.user_id
        INNER JOIN departaments ON users.departament_id = departaments.id;');
        return $data;
    }

    public function AddReport($values) {
        $insert = $this->InsertPreparedAndReturnID("INSERT INTO reports (issuetype , description, status, location, priority) VALUES (?,?,?,?,?)", $values );
        return $insert;
    }
}