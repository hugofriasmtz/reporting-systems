<?php

namespace App\Helpers;

class Helpers  {

    /**
     * Valida que todos los campos requeridos estén presentes y no estén vacíos en $_POST.
     *
     * @param array $required_values Lista de nombres de campos requeridos.
     * @return array Un array con dos elementos:
     *               - 'valid' (bool): Retorna true si todos los campos están presentes y no están vacíos, false en caso contrario.
     *               - 'missing' (array): Array con los nombres de los campos que están faltando o vacíos.
     */
    public static function validatePost(array $required_values): array {
        $missing = [];

        foreach ($required_values as $value) {
            if (!isset($_POST[$value]) || empty(trim($_POST[$value]))) {
                $missing[] = $value;
            }
        }

        return [
            'valid'     => empty($missing),
            'missing'   => $missing
        ];
    }

    /**
     * Acorta una cadena de texto
     *
     * @param string $text Texto a recortar
     * @param string $maximum_length # Máximo de caracteres
     * @param string $suffix Texto que ira al final
     * @return string Texto acortado
     */
    public static function ShortenText($text, $maximum_length = 100, $suffix = '...') {
        if (strlen($text) > $maximum_length) {
            $shorten_text = substr($text, 0, $maximum_length);
            return $shorten_text . $suffix;
        }
        return $text;
    }

    public static function authnUser(array $user): array {
        return [
            'user_id'   => $user['id'],
            'role_id'   => $user['role_id'],
            'username'  => $user['username'],
            'status'    => $user['status'],
        ];
    }

    public static function LoadEnv($file_path) {
        
        if (!file_exists($file_path)) {
            throw new \Exception("El archivo .env no se encuentra en la ruta especificada.");
        }
    
        $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignorar líneas que comiencen con # (comentarios)
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
    
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
    
            // Establecer las variables de entorno
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
   


    

}