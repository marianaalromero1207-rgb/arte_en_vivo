<?php
class Mensaje {
    private $conn;
    private $table = "mensajes";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enviar($id_remitente, $id_destinatario, $id_obra, $asunto, $mensaje) {
        $query = "INSERT INTO " . $this->table . " (id_remitente, id_destinatario, id_obra, asunto, mensaje) 
                  VALUES (:id_remitente, :id_destinatario, :id_obra, :asunto, :mensaje)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_remitente', $id_remitente);
        $stmt->bindParam(':id_destinatario', $id_destinatario);
        $stmt->bindParam(':id_obra', $id_obra);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':mensaje', $mensaje);

        return $stmt->execute();
    }

    public function obtenerPorUsuario($id_usuario) {
        $query = "SELECT m.*, u.nombre AS remitente_nombre, o.titulo AS obra_titulo 
                  FROM " . $this->table . " m 
                  JOIN usuarios u ON m.id_remitente = u.id 
                  LEFT JOIN obras o ON m.id_obra = o.id 
                  WHERE m.id_destinatario = :id_usuario 
                  ORDER BY m.creado_en DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}