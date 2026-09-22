<?php

class Database {
    private static $host = 'localhost';
    private static $db_name = 'arte_en_vivo';
    private static $username = 'root';
    private static $password = '';
    private static $conn;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "Error de conexión: " . $exception->getMessage();
            }
        }
        return self::$conn;
    }

    // Alias para compatibilidad con ObraModel.php
    public static function getConnection() {
        return self::connect();
    }
}

