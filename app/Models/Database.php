<?php

namespace App\Models;

use App\Helpers\Helpers;
use PDO;
use PDOException;

/**
 * Clase Database para manejar la conexión y operaciones con la base de datos.
 */
class Database
{
    private $_helper;
    private $dsn = '';
    private $username = '';
    private $password = '';
    private $conn;
    private $depuracion = true;

    /**
     * Constructor de la clase Database.
     * Carga las variables de entorno y configura la cadena de conexión (DSN).
     */
    public function __construct()
    {
        $file_env = dirname(__DIR__) . '/Core/.env';
        $this->_helper = new Helpers();
        $this->_helper->LoadEnv($file_env);
        $this->dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'] . ";charset=" . $_ENV['DB_CHARSET'] . ";";
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->depuracion = $_ENV['DB_DEBUG'];
    }

    /**
     * Abre una conexión a la base de datos.
     */
    function open()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set character set utf8");
        } catch (PDOException $e) {
            if ($this->depuracion)
                echo $e->getMessage();
            $this->conn = NULL;
            die();
        }
    }

    /**
     * Cierra la conexión a la base de datos.
     */
    function CerrarConexion()
    {
        $this->conn = null;
    }

    /**
     * Ejecuta una consulta preparada con parámetros.
     * @param string $sql La consulta SQL.
     * @param array $parametros Los parámetros para la consulta.
     * @return array|null Los resultados de la consulta o null en caso de error.
     */
    function ConsultaPreparada($sql, $parametros)
    {
        if ($this->conn == NULL) {
            $this->open();
        }
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            if ($this->depuracion) {
                echo "Error en la consulta: " . $sql . "\n";
                echo "Errores: " . var_dump($sentencia->errorInfo());
            }
            return null;
        }
    }

    /**
     * Ejecuta una consulta normal sin parámetros.
     * @param string $sql La consulta SQL.
     * @return array|false Los resultados de la consulta o false en caso de error.
     */
    public function ConsultaNormal($sql)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute()) {
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            if ($this->depuracion) {
                return FALSE;
            }
        }
    }

    /**
     * Inserta registros usando una consulta normal.
     * @param string $sql La consulta SQL.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function normalInsertion($sql)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute()) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                print_r($sentencia->errorInfo());
                exit;
                return FALSE;
            }
        }
    }

    /**
     * Inserta registros usando una consulta preparada con parámetros.
     * @param string $sql La consulta SQL.
     * @param array $parametros Los parámetros para la consulta.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function InsertarRegistrosPreparada($sql, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                echo var_dump($sentencia->errorInfo());
                exit;
                return FALSE;
            }
        }
    }

    /**
     * Inserta registros usando una consulta preparada y retorna el último ID insertado.
     * @param string $sql La consulta SQL.
     * @param array $parametros Los parámetros para la consulta.
     * @return int|bool El último ID insertado o FALSE en caso de error.
     */
    public function InsertPreparedAndReturnID($sql, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();

        try {
            $sentencia = $this->conn->prepare($sql);
            if ($sentencia->execute($parametros)) {
                return $this->conn->lastInsertId();
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            if ($this->depuracion) {
                echo "Error en la inserción: " . $e->getMessage();
            }
            return FALSE;
        }
    }

    /**
     * Modifica registros usando una consulta preparada con parámetros.
     * @param string $sql La consulta SQL.
     * @param array $parametros Los parámetros para la consulta.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function ModificarRegistrosPreparada($sql, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                echo var_dump($sentencia->errorInfo());
                exit;
                return FALSE;
            }
        }
    }

    /**
     * Elimina registros usando una consulta preparada con parámetros.
     * @param string $sql La consulta SQL.
     * @param array $parametros Los parámetros para la consulta.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function EliminarRegistrosPreparada($sql, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare($sql);
        if ($sentencia->execute($parametros)) {
            return TRUE;
        } else {
            if ($this->depuracion) {
                return FALSE;
            }
        }
    }

    /**
     * Ejecuta una consulta asociativa ordenada.
     * @param string $tabla La tabla a consultar.
     * @param string $filtro El filtro de la consulta.
     * @param string $orden El orden de la consulta.
     * @param array $parametros Los parámetros para la consulta.
     * @return array|null Los resultados de la consulta o null en caso de error.
     */
    function ConsultaAsociativaOrdenada($tabla, $filtro, $orden, $parametros)
    {
        if ($this->conn == NULL)
            $this->open();
        $sentencia = $this->conn->prepare("SELECT * FROM " . $tabla . " where " . $filtro . "ORDER BY " . $orden);
        if ($sentencia->execute($parametros)) {
            return $sentencia->fetchAll(PDO::FETCH_ASSOC);
        } else {
            if ($this->depuracion)
                echo var_dump($sentencia->errorInfo());
            return null;
        }
    }

    /**
     * Ejecuta múltiples consultas en una transacción.
     * @param array $queries Las consultas a ejecutar.
     * @return bool TRUE en caso de éxito, FALSE en caso de error.
     */
    public function Multiple_transaction($queries)
    {
        if ($this->conn == NULL)
            $this->open();

        try {
            $this->conn->beginTransaction();
            foreach ($queries as $query) {
                $sql = $query['sql'];
                $parametros = $query['parametros'];
                $sentencia = $this->conn->prepare($sql);
                if (!$sentencia->execute($parametros)) {
                    throw new PDOException("Error ejecutando consulta: " . $sql);
                }
            }
            $this->conn->commit();
            return TRUE;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            if ($this->depuracion) {
                echo "Error en la transacción: " . $e->getMessage();
            }
            return FALSE;
        }
    }
}