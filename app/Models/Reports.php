<?php
namespace App\Models;
use App\Models\Database;

class Reports extends Database
{
   
    public function FindId () {
        $data = $this->ConsultaNormal('SELECT users.id, departaments.names AS department ,CONCAT_WS(" ", user_profiles.names, user_profiles.last_names) AS Full_Name
        FROM users
        INNER JOIN user_profiles ON users.id = user_profiles.user_id
        INNER JOIN departaments ON users.departament_id = departaments.id;');
        return $data;
    }

    public function AddReport($values) {
        $insert = $this->InsertPreparedAndReturnID("INSERT INTO reports (user_id,issuetype , description, status, location, priority) VALUES (?,?,?,?,?,?)", $values );
        return $insert;
    }

    public function GetReports() {
        $data = $this->ConsultaNormal('SELECT reports.id, CONCAT_WS(" ",user_profiles.names, user_profiles.last_names) AS FullName, reports.issuetype, reports.description, reports.status, reports.location, reports.priority, reports.created
        FROM reports
        INNER JOIN users ON reports.user_id = users.id
        INNER JOIN user_profiles ON users.id = user_profiles.user_id
        INNER JOIN departaments ON users.departament_id = departaments.id;');
        return $data;
    }
    public function GetReportsById($report_id){
        $data = $this->ConsultaNormal('SELECT reports.id, CONCAT_WS(" ",user_profiles.names, user_profiles.last_names) AS FullName
        FROM reports
        INNER JOIN users ON reports.user_id = users.id
        INNER JOIN user_profiles ON users.id = user_profiles.user_id
        INNER JOIN departaments ON users.departament_id = departaments.id;
        WHERE reports.id = ?;', [$report_id]);
        return $data;
    }

    public function UpdateReport($values) {
        $update = $this->ModificarRegistrosPreparada("UPDATE reports SET deleted = ?, status = ? WHERE id = ?",
            $values
        );
        return $update;
    }

}