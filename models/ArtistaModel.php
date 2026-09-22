<?php
require_once __DIR__ . '/../config/database.php';

class ArtistaModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // CREATE: Registrar un nuevo artista
    public function crear($nombre, $email, $password, $biografia) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password, tipo, biografia) VALUES (?, ?, ?, 'artista', ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $email, $hash, $biografia]);
    }

    // READ (Todos): Obtener lista de artistas
    public function obtenerTodos() {
        $sql = "SELECT * FROM usuarios WHERE tipo = 'artista' ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ (Uno): Obtener artista por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ? AND tipo = 'artista'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE: Actualizar datos de un artista
    public function actualizar($id, $nombre, $email, $biografia) {
        $sql = "UPDATE usuarios SET nombre = ?, email = ?, biografia = ? WHERE id = ? AND tipo = 'artista'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $email, $biografia, $id]);
    }

    // DELETE: Eliminar un artista
    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE id = ? AND tipo = 'artista'";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}