<?php
require_once __DIR__ . '/../models/Venta.php';

class PagoController {
    private $db;
    private $ventaModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?c=auth&a=showLogin");
            exit();
        }
        $database = new Database();
        $this->db = $database->getConnection();
        $this->ventaModel = new Venta($this->db);
    }

    // Pantalla de checkout
    public function checkout() {
        $id_obra = $_GET['id_obra'] ?? null;

        $query = "SELECT * FROM obras WHERE id = :id_obra AND estado = 'disponible' LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_obra', $id_obra);
        $stmt->execute();
        $obra = $stmt->fetch();

        if (!$obra) {
            echo "La obra no está disponible para la compra.";
            return;
        }

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/pago/checkout.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Procesar pago (Simulado)
    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_obra = $_POST['id_obra'];
            $monto = $_POST['monto'];
            
            // Generar ID de transacción simulado (ej. integración PayPal/Stripe)
            $transaccion_id = "TXN-" . strtoupper(uniqid());

            if ($this->ventaModel->registrarVenta($_SESSION['user_id'], $id_obra, $monto, $transaccion_id)) {
                require_once __DIR__ . '/../views/layouts/header.php';
                require_once __DIR__ . '/../views/pago/confirmacion.php';
                require_once __DIR__ . '/../views/layouts/footer.php';
            } else {
                echo "Error al procesar el pago.";
            }
        }
    }
}