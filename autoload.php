<?php

/**
 * Este archivo define una función de autoloading para cargar automáticamente las clases de PHP
 * cuando se utilizan. El propósito de este archivo es simplificar la inclusión de archivos de clase
 * en el proyecto, evitando la necesidad de incluir manualmente cada archivo de clase.
*/
spl_autoload_register(function ($class) {
    $prefix = 'App\\';  // Prefijo del namespace
    $base_dir = __DIR__ . '/app/';  // Base de la ruta del proyecto

    // Comprueba si la clase usa el namespace "App"
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) === 0) {
        // Obtén el nombre de la clase sin el prefijo del namespace
        $relative_class = substr($class, $len);
        // Construye la ruta al archivo
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Depuración: muestra la ruta que intenta cargar
        //echo "Intentando cargar la clase: -$class- desde $file <br>";

        // Verifica si el directorio existe antes de intentar escanearlo
        $dir = dirname($file);
        if (!is_dir($dir)) {
            echo "Directorio no encontrado: $dir<br>";
            throw new Exception("Directorio no encontrado: $dir");
        }

        // Si el archivo existe, inclúyelo
        if (file_exists($file)) {
            require_once $file;
        } else {
            // Lanza una excepción si no encuentra la clase
            echo "El archivo no existe: $file<br>";
            echo "Contenido del directorio: " . print_r(scandir($dir), true) . "<br>";
            throw new Exception("No se pudo cargar la clase: $class");
        }
        
    }
});