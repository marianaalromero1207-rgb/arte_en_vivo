<?php
require_once __DIR__ . '/../config/database.php';

class ObraModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // READ ALL (Nombre que solicita GaleriaController.php)
    public function obtenerTodasLasObras() {
        $stmt = $this->db->query("SELECT * FROM obras ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Alias para el CRUD
    public function obtenerTodas() {
        return $this->obtenerTodasLasObras();
    }

    // READ ONE
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM obras WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function insertar($titulo, $descripcion, $precio, $imagen, $usuario_id = null) {
        $stmt = $this->db->prepare("INSERT INTO obras (titulo, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$titulo, $descripcion, $precio, $imagen]);
    }

    // UPDATE
    public function actualizar($id, $titulo, $descripcion, $precio, $imagen = null) {
        if ($imagen) {
            $stmt = $this->db->prepare("UPDATE obras SET titulo = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?");
            return $stmt->execute([$titulo, $descripcion, $precio, $imagen, $id]);
        } else {
            $stmt = $this->db->prepare("UPDATE obras SET titulo = ?, descripcion = ?, precio = ? WHERE id = ?");
            return $stmt->execute([$titulo, $descripcion, $precio, $id]);
        }
    }

    // DELETE
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM obras WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Recomendaciones por interés
    public function obtenerPorInteres($categoria, $limite = 4) {
        $stmt = $this->db->prepare("SELECT * FROM obras WHERE descripcion LIKE ? OR titulo LIKE ? ORDER BY id DESC LIMIT ?");
        $param = '%' . $categoria . '%';
        $stmt->bindValue(1, $param, PDO::PARAM_STR);
        $stmt->bindValue(2, $param, PDO::PARAM_STR);
        $stmt->bindValue(3, (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}