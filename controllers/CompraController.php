<?php
require_once __DIR__ . '/../models/ObraModel.php';

class CompraController {
    private $obraModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->obraModel = new ObraModel();
    }

    // Pantalla de Checkout / Confirmación de Compra
    public function checkout() {
        $obra_id = $_GET['id'] ?? null;
        
        if (!$obra_id) {
            header('Location: index.php?c=galeria&a=index');
            exit;
        }

        $obra = $this->obraModel->obtenerPorId($obra_id);

        if (!$obra) {
            echo "La obra no existe o no se encuentra disponible.";
            exit;
        }

        require_once __DIR__ . '/../views/compra/checkout.php';
    }

    // Procesar Pago / Confirmación final
    public function procesar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $obra_id = $_POST['obra_id'];
            $metodo_pago = $_POST['metodo_pago'];
            $comprador = $_POST['nombre_comprador'];

            // Aquí puedes registrar la transacción en la BD o simular el éxito del pago
            require_once __DIR__ . '/../views/compra/confirmacion.php';
        }
    }
}