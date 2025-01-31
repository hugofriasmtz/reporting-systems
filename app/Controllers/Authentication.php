<?php
/**
 * Controlador de Autenticación
 * 
 * Este controlador maneja la lógica de autenticación para la aplicación.
 * 
 * @package App\Controllers
*/

namespace App\Controllers;

session_start(); // Inicia la sesión para gestionar el estado de autenticación del usuario

use App\Models\Model; // Importa la clase base Model
use App\Helpers\Helpers; // Importa la clase Helpers para funciones de utilidad
use App\Helpers\Alerts; // Importa la clase Alerts para gestionar mensajes de alerta


/**
 * Clase Authentication
 * 
 * Esta clase maneja la autenticación de usuarios en la aplicación.
*/
class Authentication {
    /**
     * @var mixed $_model Instancia del modelo utilizado para la autenticación.
     * @var mixed $_helper Instancia de la clase helper utilizada para varias funciones de utilidad.
     * @var mixed $_alerts Instancia de la clase de alertas utilizada para gestionar mensajes de alerta.
     */
    private $_model;
    private $_helper;
    private $_alerts;

    /**
     * Constructor de la clase Authentication.
     * 
     * Inicializa las instancias de Model, Helpers y Alerts.
    */
    function __construct(){
        $this->_model = new Model();
        $this->_helper = new Helpers();
        $this->_alerts = new Alerts();
    }

    /**
     * Método index
     * 
     * Incluye el archivo de login.
    */
    public function index() {
        include_once '../Views/login.php';
    }

    /**
     * Método IsAuth
     * 
     * Verifica si el usuario está autenticado.
     * 
     * @return bool Retorna true si el usuario está autenticado, de lo contrario false.
     */
    public function IsAuth(){
        return (isset($_SESSION['user']));
    }

    /**
     * Método AuthUser
     * 
     * Autentica al usuario si se han enviado los datos de login.
     */
    public function AuthUser(){
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['is_login'])) {
            $this->validateAccess($_POST['username'], $_POST['password']);
        }
    }

    /**
     * Método validateAccess
     * 
     * Valida las credenciales del usuario.
     * 
     * @param string $username Nombre de usuario.
     * @param string $password Contraseña del usuario.
    */
    public function validateAccess($username, $password){
        // Inicializa un array para almacenar los detalles de la alerta
        $alert_access = ['title' => '', 'body' => '', 'type' => '', 'location' => ''];

        // Sanitiza las entradas del usuario para evitar inyecciones de código
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

        // Busca el usuario en la base de datos
        $user = $this->_model->SearchUser($username);

        // Si el usuario existe
        if ($user) {
            $authn_user = $user[0];
            // Verifica la contraseña
            if (password_verify($password, $authn_user['password'])) {
                // Si la contraseña es correcta, guarda la información del usuario en la sesión
                $_SESSION['user'] = $this->_helper->authnUser($authn_user);
                return null;
            } else {
                // Si la contraseña es incorrecta, prepara una alerta de advertencia
                $alert_access['title'] = 'La contraseña no es válida.';
                $alert_access['body'] = 'Favor de volver a intentar.';
                $alert_access['type'] = 'warning';
            }
        } else {
            // Si el usuario no existe, prepara una alerta de error
            $alert_access['title'] = 'Usuario no encontrado.';
            $alert_access['body'] = 'No tienes acceso a la plataforma.';
            $alert_access['type'] = 'error';
        }

        // Muestra la alerta correspondiente
        $this->_alerts->showAlert($alert_access);
    }

    /**
     * Método Redirect
     * 
     * Redirige al usuario a la página correspondiente según su rol.
     */
    public function Redirect(){
        ob_start(); 
        // Determina la página de redirección según el rol del usuario
        $file = ($_SESSION['user']['role_id'] == 2) ? "../Staff/contacts.php" : "../Admin/Dashboard.php";
        header("Location: {$file}");
        ob_end_flush();
        exit();
    }
}
?>