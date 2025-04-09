<?php       


namespace App\Helpers;

class UserAttributes
{
    public function GetCurrentDateTime(){
        $date = new \DateTimeZone('America/Mexico_City');
        return $date = format('Y-m-d H:i:s');
    }

    public static function GetStatusDetails($status)
    {
        switch ($status) {
            case 'ACTIVE':   return ['label' => 'Activo', 'class' => 'success']; 
            case 'INACTIVE': return ['label' => 'Suspendido', 'class' => 'warning'];
            case 'DELETED':  return ['label' => 'Eliminado', 'class' => 'danger'];
        }
    }
    
    public static function GetDepartamentDetails($departament)
    {
        switch ($departament) {
            
            case 'SYSTEM':       return['label' =>'Sistemas',     'class' => 'info'];
            case 'KITCHEN':      return['label' =>'Cocina',        'class' => 'success'];
            case 'HOUSEKEEPING': return ['label' =>'Ama de LLaves',    'class' => 'primary'];
            case 'MAINTENANCE':  return ['label' =>'Mantenimiento', 'class' => 'secondary'];
            case 'SALES':        return ['label' =>'Ventas',   'class' => 'warning'];
            case 'PURCHASING':   return ['label' =>'Compras',     'class' => 'danger'];
            case 'RECEPTION':    return ['label' =>'Recepcion',       'class' => 'dark'];
            case 'RRHH':         return ['label' =>'RH', 'class' => 'light'];
            case 'PUBLIC AREAS': return ['label' =>'Areas Publicas', 'class' => 'dark'];
            default:             return ['label' => 'Sin departamento', 'class' => 'dark'];
        }
        
    }

    public static function getRolDetails($rol)
    {
        return $rol === 'Partner_in_charge' ? 'Encargado' : 'Colaboradores';
    }

    public static function getShiftLabel($shift)
    {
        return $shift === 'MORNING' ? 'Mañana' : 'Tarde';
    }

    public static function getGenderLabel($gender)
    {
        return $gender === 'MAN' ? 'Hombre' : 'Mujer';
    }
}