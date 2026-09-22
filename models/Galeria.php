<?php
class Galeria {
    private $conn;
    private $table = "galerias";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function crear($id_artista, $titulo, $descripcion, $estilo_tema) {
        $query = "INSERT INTO " . $this->table . " (id_artista, titulo, descripcion, estilo_tema) VALUES (:id_artista, :titulo, :descripcion, :estilo_tema)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id_artista', $id_artista);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estilo_tema', $estilo_tema);

        return $stmt->execute();
    }

    public function obtenerPorArtista($id_artista) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_artista = :id_artista ORDER BY creado_en DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_artista', $id_artista);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerPorId($id, $id_artista) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id AND id_artista = :id_artista LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_artista', $id_artista);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function eliminar($id, $id_artista) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id AND id_artista = :id_artista";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_artista', $id_artista);
        return $stmt->execute();
    }
}