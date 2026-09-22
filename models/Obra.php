<?php
require_once __DIR__ . '/../config/database.php';

class Obra {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Obtener todas las obras
    public function obtenerTodas() {
        $stmt = $this->db->query("
            SELECT o.*, u.nombre AS artista_nombre 
            FROM obras o 
            LEFT JOIN usuarios u ON o.usuario_id = u.id 
            ORDER BY o.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Insertar una nueva obra
    public function insertar($titulo, $descripcion, $precio, $imagen, $usuario_id) {
        $stmt = $this->db->prepare("
            INSERT INTO obras (titulo, descripcion, precio, imagen, usuario_id) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$titulo, $descripcion, $precio, $imagen, $usuario_id]);
    }

    // Obtener obras según intereses/categoría para la página de inicio
    public function obtenerPorInteres($categoria, $limite = 4) {
        $stmt = $this->db->prepare("
            SELECT o.*, u.nombre AS artista_nombre 
            FROM obras o 
            LEFT JOIN usuarios u ON o.usuario_id = u.id 
            WHERE o.descripcion LIKE ? OR o.titulo LIKE ? 
            ORDER BY o.id DESC 
            LIMIT ?
        ");
        
        $param = '%' . $categoria . '%';
        $stmt->bindValue(1, $param, PDO::PARAM_STR);
        $stmt->bindValue(2, $param, PDO::PARAM_STR);
        $stmt->bindValue(3, (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}