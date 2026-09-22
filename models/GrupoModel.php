<?php
require_once __DIR__ . '/../config/database.php';

class GrupoModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // CREATE
    public function crear($nombre, $descripcion) {
        $sql = "INSERT INTO grupos (nombre, descripcion) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $descripcion]);
    }

    // READ ALL
    public function obtenerTodos() {
        $sql = "SELECT * FROM grupos ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ ONE
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM grupos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function actualizar($id, $nombre, $descripcion) {
        $sql = "UPDATE grupos SET nombre = ?, descripcion = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $descripcion, $id]);
    }

    // DELETE
    public function eliminar($id) {
        $sql = "DELETE FROM grupos WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}