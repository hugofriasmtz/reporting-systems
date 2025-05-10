<?php       


namespace App\Helpers;

class UserAttributes
{
    public static function FormatDate($date, $format = 'Y-m-d H:i:s', $timezone = 'America/Mexico_City')
    {
        try {
            // Crear un objeto DateTime con la fecha proporcionada y la zona horaria especificada
            $dateTime = new \DateTime($date, new \DateTimeZone($timezone));
            
            // Devolver la fecha en el formato deseado
            return $dateTime->format($format);
        } catch (\Exception $e) {
            // Manejar errores y devolver un mensaje
            return 'Error al formatear la fecha: ' . $e->getMessage();
        }
    }


    public static function GetStatusDetails($status)
    {
        switch ($status) {
            case 'ACTIVE':      return ['label' => 'Activo', 'class' => 'success']; 
            case 'INACTIVE':    return ['label' => 'Suspendido', 'class' => 'warning'];
            case 'DELETED':     return ['label' => 'Eliminado', 'class' => 'danger'];
            case 'PENDING':     return ['label' => 'Pendiente', 'class' => 'info', 'color' => 'primary', 'porcentage' => '0%'];
            case 'IN_PROGRESS': return ['label' => 'En Progreso', 'class' => 'dark','color' => 'dark', 'porcentage' => '50%'];
            case 'RESOLVED':    return ['label' => 'Resuelto', 'class' => 'success', 'color' => 'success', 'porcentage' => '100%'];
            case 'LOW':         return ['label' => 'Baja', 'class' => 'success'];
            case 'MEDIUM':      return ['label' => 'Media', 'class' => 'warning'];
            case 'HIGH':        return ['label' => 'Alta', 'class' => 'danger'];
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

    public static function GetIssuetypesDetails($rol)
    {
        switch ($rol) {
            case 'CLEANING':    return 'Limpieza';      break;
            case 'MAINTENANCE': return 'Mantenimiento'; break;
            case 'SYSTEM':      return 'Sistemas';      break;
            default:            return 'Otros';         break;
        }
    }
    public static function GetDetails($rol)
    {
        switch ($rol) {
            case 'ADMINISTRATOR':      return 'Administrador';    break;
            case 'PARTNER_IN_CHARGE':  return 'Encargado';        break;
            case 'COLLABORATOR':       return 'Colaborador';      break;
            default:                   return 'Sin rol asignado'; break;
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