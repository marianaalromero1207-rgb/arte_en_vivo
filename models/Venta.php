<?php
class Venta {
    private $conn;
    private $table = "ventas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function registrarVenta($id_comprador, $id_obra, $monto, $transaccion_id) {
        try {
            $this->conn->beginTransaction();

            // 1. Insertar el registro de venta
            $queryVenta = "INSERT INTO " . $this->table . " (id_comprador, id_obra, monto_total, estado_pago, transaccion_id) 
                           VALUES (:id_comprador, :id_obra, :monto, 'completado', :transaccion_id)";
            $stmtVenta = $this->conn->prepare($queryVenta);
            $stmtVenta->bindParam(':id_comprador', $id_comprador);
            $stmtVenta->bindParam(':id_obra', $id_obra);
            $stmtVenta->bindParam(':monto', $monto);
            $stmtVenta->bindParam(':transaccion_id', $transaccion_id);
            $stmtVenta->execute();

            // 2. Actualizar el estado de la obra a 'vendida'
            $queryObra = "UPDATE obras SET estado = 'vendida' WHERE id = :id_obra";
            $stmtObra = $this->conn->prepare($queryObra);
            $stmtObra->bindParam(':id_obra', $id_obra);
            $stmtObra->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}