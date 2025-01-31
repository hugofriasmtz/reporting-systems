<?php
/**
 * Este script maneja el cierre de sesión del usuario destruyendo la sesión actual
 * y redirigiendo al usuario a la página de inicio de sesión.
 *
 * Pasos:
 * 1. Iniciar la sesión.
 * 2. Destruir la sesión para cerrar la sesión del usuario.
 * 3. Redirigir al usuario a la página de inicio de sesión.
 *
 */ 
session_start();
session_destroy();
header('Location: ./auth-login.php');

?>